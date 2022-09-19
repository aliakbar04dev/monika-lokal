<?php
namespace App\Controllers;

use App\Models\RegisModel;
use App\Models\RefModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
//use App\Libraries\Facebook;

require_once 'public/assets/google-api-php-client/vendor/autoload.php';
require_once 'public/assets/facebook-api-client/src/Facebook/autoload.php';

class Newreg extends BaseController
{
    protected $regisModel;
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->regisModel = new RegisModel();
        $this->user = new UserModel();
        $this->ref = new RefModel();
    }

    public function index()
    {
        if (!hassession('email')) {
            if (!session_id()) {
				session_start();
			}

            $fb = new \Facebook\Facebook([
                'app_id' => FB_APP_ID, // Replace {app-id} with your app id
                'app_secret' => FB_APP_SECRET,
                'default_graph_version' => 'v11.0',
            ]);
              
            $helper = $fb->getRedirectLoginHelper();
              
            $permissions = ['email']; // Optional permissions
            $callbackUrl = htmlspecialchars(base_url('regisfacebookcalback'));
            $loginUrl = $helper->getLoginUrl($callbackUrl,$permissions);
              
            $data['authURL'] =  $loginUrl;

            if (getsession('fb_failed_account') != '') {
				$data['fb_failed_account'] = true;

				$this->session->remove('fb_failed_account');
			}

			if (getsession('fb_failed_email') != '') {
				$data['fb_failed_email'] = true;

				$this->session->remove('fb_failed_email');
			}

            if (getsession('fb_registered_account') != '') {
				$data['fb_registered_account'] = true;

				$this->session->remove('fb_registered_account');
			}

            if(getsession('reference_id') != ''){
                $data['reference_id'] = getsession('reference_id');

				$this->session->remove('reference_id');
            }

            $this->session->remove('viapembelian');

            return view('register/register', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function reference($idref){
        if (!hassession('email')) {
            if($idref != ''){
                $newdata = [
                    'reference_id' => $idref,
                ];
                
                $this->session->set($newdata);

                return redirect()->to('/newreg');
            }
            
        } else {
            return redirect()->to('/');
        }
    }

    public function reg(){
        if (!hassession('email')) {
            if(hassession('regis_after_auto')){

                $data = array(
                    'title' => 'Register',
                    'nameregis' => getsession('nameregis'),
                    'emailregis' => getsession('emailregis'),
                    'usernameregis' => getsession('usernameregis'),
                );

                return view('register/reg', $data);
            }else{
                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function verifikasi()
    {
        if (!hassession('email')) {
            if(hassession('regis_phone_input')){
                return view('register/number');
            }else{
                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function otp()
    {
        if (!hassession('email')) {
            if(hassession('regis_otp_input')){
                $nohp = getsession('regis_otp_phone');
                $nohp = substr($nohp, 1, 2) . '*******' . substr($nohp, -2);

                $data = array(
                    'nohp' => $nohp,
                );
                
                return view('register/otp', $data);
            }else{
                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function otpregisphone(){
        if ($this->request->isAJAX()) {
            if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			}else{
                if(!hassession('regis_phone_code_user') && !hassession('regis_phone_input')){
                    return json_encode([
                        'success'		=> 0,
                        'reason'		=> 'Error (2)',
                        'description'	=> 'Error (2)',
                    ]);
                }else{
                    $phone 		= $this->request->getPost('notelp', FILTER_SANITIZE_STRING);
                    $phone		= preg_replace("/[^0-9]/", "", $phone);
                    $phone		= (int)$phone;
                    $viapemb    = '';
                    $kodepaket  = '';

                    if(hassession('viapembelian')){
                        $viapemb = 'Yes';
                        $kodepaket = getsession('kodepaketpembelian');
                    }

                    if(strlen($phone) < 9|| strlen($phone) > 12){
                        return json_encode([
                            'success'		=> 0,
                            'reason'		=> 'Gagal Kirim OTP',
                            'description'	=> 'Masukkan nomor hp yang benar'
                            ,
                        ]);
                    }

                    $phonedb	= '0'.$phone;
                    $phone		= '+62'.$phone;

                    $nohpdata	= $this->regisModel->select('no_hp')->where('no_hp', $phonedb)->findAll();

                    if(count($nohpdata) > 0){
                        return json_encode([
                            'success'		=> 0,
                            'reason'		=> 'Gagal Kirim OTP',
                            'description'	=> 'No Handphone sudah terdaftar, silahkan gunakan nomor lain.'
                            ,
                        ]);
                    }

                    $kode_user	= getsession('regis_phone_code_user');
                    $otp 		= rand(100000, 999999);
                    $exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));

                    $data = [
                        'regis_no_hp'	=> $phonedb,
                        'regis_otp'		=> $otp,
                        'regis_otp_exp'	=> $exp,
                    ];
    
                    $this->regisModel->update($kode_user, $data);
    
                    $this->sendotptouser($otp, $phone);

                    $this->session->remove('viapembelian');
                    $this->session->remove('regis_phone_input');
					$this->session->remove('regis_phone_code_user');
                    $this->session->remove('kodepaketpembelian');

                    $newdata = [
						'regis_otp_input'	    => 'Yes',
                        'regis_otp_phone'	    =>  $phonedb,
						'regis_otp_code_user'	=>  $kode_user,
					];

                    if($viapemb != ''){
                        $newdata['viapembelian'] = 'Yes';
                        $newdata['kodepaketpembelian'] = $kodepaket;
                    }

					$this->session->set($newdata);
                    
                    return json_encode([
                        'success'		=> 1,
                        'reason'		=> 'Pengiriman OTP Berhasil',
                        'description'	=> 'Silahkan masukkan kode OTP anda.',
                    ]);
                }
            }
        }
    }

    public function verifyregisotpcode(){
        if ($this->request->isAJAX()) {
            if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			}else{
                if(!hassession('regis_otp_input') && !hassession('regis_otp_phone') && !hassession('regis_otp_code_user')){
                    return json_encode([
                        'success'		=> 0,
                        'reason'		=> 'Error (2)',
                        'description'	=> 'Error (2)',
                    ]);
                }else{
                    $code1 	= $this->request->getPost('code1', FILTER_SANITIZE_STRING);
                    $code2 	= $this->request->getPost('code2', FILTER_SANITIZE_STRING);
                    $code3 	= $this->request->getPost('code3', FILTER_SANITIZE_STRING);
                    $code4 	= $this->request->getPost('code4', FILTER_SANITIZE_STRING);
                    $code5 	= $this->request->getPost('code5', FILTER_SANITIZE_STRING);
                    $code6 	= $this->request->getPost('code6', FILTER_SANITIZE_STRING);

                    $otpcode = $code1.$code2.$code3.$code4.$code5.$code6;

                    $kode_user	= getsession('regis_otp_code_user');
                    $usr		= $this->regisModel->select('regis_no_hp, regis_otp, regis_otp_exp')->where('kode_user', $kode_user)->first();

                    $regisotp	= $usr['regis_otp'];
                    $no_hp      = $usr['regis_no_hp'];
                    $otpexp		= strtotime($usr['regis_otp_exp']);
                    $now		= strtotime(date('Y-m-d H:i:s'));
                    $viapemb    = '';
                    $kodepaket  = '';

                    if(hassession('viapembelian')){
                        $viapemb = 'Yes';
                        $kodepaket = getsession('kodepaketpembelian');
                    }

                    if($regisotp != '' && $otpexp != ''){
                        if($otpexp >= $now){
                            if($otpcode == $regisotp){

                                $data = [
                                    'no_hp'         => $no_hp,
                                    'is_verif'		=> 1,
                                    'regis_no_hp'   => '',
                                    'regis_otp'		=> '',
                                    'trial_expire'	=> date('Y-m-d', strtotime('+14 day')),
                                ];
                
                                $this->regisModel->update($kode_user, $data);
                                
                                if($viapemb != ''){
                                    $this->session->remove('viapembelian');
                                    $this->session->remove('kodepaketpembelian');
                                    $this->session->remove('regis_otp_input');
                                    $this->session->remove('regis_otp_phone');
                                    $this->session->remove('regis_otp_code_user');

                                    $dataUser = $this->regisModel->where('kode_user', $kode_user)
                                                    ->where('kode_user_level !=', 'MULV006')
                                                    ->first();
                                    
                                    if (!is_null($dataUser) && count($dataUser) > 0) {
                                        $email      = $dataUser['alamat_email'];

                                        $newdata = [
                                            'loginpembelian'    => 'Yes',
                                            'pembemail'         => $email,
                                        ];
                
                                        $this->session->set($newdata);

                                        return json_encode([
                                            'success'		=> 2,
                                            'reason'		=> 'Berhasil Verify OTP',
                                            'description'	=> 'Registrasi berhasil',
                                            'kodepaket'     => $kodepaket,
                                        ]);
                                    }else{

                                        $newdata = [
                                            'otpberhasil'       => 'Yes',
                                        ];
                
                                        $this->session->set($newdata);

                                        return json_encode([
                                            'success'		=> 1,
                                            'reason'		=> 'Berhasil Verify OTP',
                                            'description'	=> 'Registrasi berhasil',
                                        ]);
                                    }
                                }else{
                                    $this->session->destroy();

                                    return json_encode([
                                        'success'		=> 1,
                                        'reason'		=> 'Berhasil Verify OTP',
                                        'description'	=> 'Registrasi berhasil',
                                    ]);
                                }
                            }else{
                                return json_encode([
                                    'success'		=> 0,
                                    'reason'		=> 'Gagal Verifikasi OTP',
                                    'description'	=> 'OTP salah, silahkan cek kembali kode OTP anda'
                                ]);
                            }
                        }else{
                            return json_encode([
                                'success'		=> 0,
                                'reason'		=> 'Gagal Verify OTP',
                                'description'	=> 'OTP sudah expired silahkan request OTP lagi.'
                                ,
                            ]);
                        }
                    }else{
                        return json_encode([
                            'success'		=> 0,
                            'reason'		=> 'Error (3)',
                            'description'	=> 'Error (3)',
                        ]);
                    }
                }
            }
        }
    }

    public function resendregisotp(){
        if ($this->request->isAJAX()) {
            if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			}else{
                if(!hassession('regis_otp_input') && !hassession('regis_otp_phone') && !hassession('regis_otp_code_user')){
                    return json_encode([
                        'success'		=> 0,
                        'reason'		=> 'Error (2)',
                        'description'	=> 'Error (2)',
                    ]);
                }else{
                    $kode_user	= getsession('regis_otp_code_user');
                    $usr		= $this->regisModel->select('regis_no_hp, regis_otp_exp')->where('kode_user', $kode_user)->first();

                    $now = date("Y-m-d H:i:s");
                    $datetime1 = strtotime($now);
                    $datetime2 = strtotime($usr['regis_otp_exp']);

                    $interval  = $datetime2 - $datetime1;
                    $minutes   = round($interval / 60);

                    if($minutes <= 8){

                        $otp 		= rand(100000, 999999);

                        $phone		= (int)$usr['regis_no_hp'];
                        $phone		= '+62'.$phone;
                        $exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));

                        $data = [
                            'regis_otp'		=> $otp,
                            'regis_otp_exp'	=> $exp,
                        ];

                        $this->regisModel->update($kode_user, $data);

                        $this->sendotptouser($otp, $phone);

                        return json_encode([
                            'success'		=> 1,
                            'reason'		=> 'Pengiriman OTP berhasil.',
                            'description'	=> 'Silahkan masukkan kode OTP anda.',
                        ]);
                    }else{
                        return json_encode([
                            'success'		=> 0,
                            'reason'		=> 'Gagal mengirim pesan OTP',
                            'description'	=> 'Harap menunggu 10 menit untuk Kirim Ulang.',
                        ]);
                    }
                }
            }
        }
    }

    public function changeregisphone(){
        if ($this->request->isAJAX()) {
            if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			}else{
                $kode_user = getsession('regis_otp_code_user');

                $this->session->remove('regis_otp_input');
				$this->session->remove('regis_otp_phone');
				$this->session->remove('regis_otp_code_user');

				$newdata = [
					'regis_phone_input'	=> 'Yes',
					'regis_phone_code_user'	=>  $kode_user,
				];
				
                $this->session->set($newdata);

                return json_encode([
                    'success'		=> 1,
                ]);
            }
        }
    }

    public function regisgoogleprocess(){
        if ($this->request->isAJAX()) {
            if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			}else{
                $id_token 	= $this->request->getPost('id_token', FILTER_SANITIZE_STRING);

                if($id_token){
                    $client = new \Google_Client(['client_id' => CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
                    $payload = $client->verifyIdToken($id_token);

                    if ($payload) {
                        $fullname = $payload['name'];
                        $email = $payload['email'];

                        $dataUser = count($this->regisModel->where('alamat_email', $email)
                            ->findAll());

                        if ($dataUser > 0) {
                            return json_encode([
                                'success'		=> '0',
                                'reason'		=> 'Email sudah Terdaftar',
                                'description'	=> 'Registrasi gagal, Silahkan gunakan email lain.'
                            ]);
                        } else {

                            $username = strtolower(str_replace(' ', '', $fullname));
                            $invalid = true;

                            do{
                                $dusr = $this->regisModel->like('username', $username)->findAll();

                                if (count($dusr) == 0) {
                                    $invalid = false;
                                }else{
                                    $rand = rand(100, 999);
                                    $username = $username.$rand;
                                }

                            }while($invalid);

                            $newdata = [
                                'regis_after_auto'	=> 'Yes',
                                'nameregis' => $fullname,
                                'emailregis' => $email,
                                'usernameregis' => $username,
                            ];
        
                            $this->session->set($newdata);

                            return json_encode([
                                'success'		=> '1',
                                'reason'		=> 'Regis Google Success',
                                'description'	=> 'Redirecting You....'
                            ]);
                        }
                    }else{
                        $this->session->set('google_failed_account', 'true');
                        return redirect()->to('/');
                    }
                }else{
                    $this->session->set('google_failed_account', 'true');
                    return redirect()->to('/');
                }
            }
        }
    }

    public function regisfacebookprocess(){
        if (!session_id()) {
            session_start();
        }

        $fb = new \Facebook\Facebook([
            'app_id' => FB_APP_ID, // Replace {app-id} with your app id
            'app_secret' => FB_APP_SECRET,
            'default_graph_version' => 'v11.0',
        ]);
          
        $helper = $fb->getRedirectLoginHelper();
		
        try {
            $accessToken = $helper->getAccessToken('https://dev-monika-ps.cac-office.com/regisfacebookcalback');
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,email,name', $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = $response->getGraphUser();

        if (isset($user['name']) && isset($user['email'])) {
            $fullname = $user['name'];
            $email = $user['email'];

            $dataUser = count($this->regisModel->where('alamat_email', $email)
                        ->findAll());

            if ($dataUser > 0) {
                $this->session->set('fb_registered_account', 'true');
                return redirect()->to('/newreg');
            } else {
                $username = strtolower(str_replace(' ', '', $fullname));
                $invalid = true;

                 do{
                    $dusr = $this->regisModel->like('username', $username)->findAll();
                    if (count($dusr) == 0) {
                        $invalid = false;
                    }else{
                        $rand = rand(100, 999);
                        $username = $username.$rand;
                    }

                }while($invalid);

                $newdata = [
                    'regis_after_auto'	=> 'Yes',
                    'nameregis' => $fullname,
                    'emailregis' => $email,
                    'usernameregis' => $username,
                ];

                $this->session->set($newdata);

                return redirect()->to('/regiscallback');
            }
        }else{
            $this->session->set('fb_failed_account', 'true');
            return redirect()->to('/newreg');
        }
    }

    public function testAja()
    {
        $masuk = true;
        $coba = 1;
        $kode_user = '';

        /*
		do{
			$prefix 	= 'TUSR';
			$get		= $this->regisModel->select('kode_user')->orderBy('kode_user',"desc")->first();
			$int 		= str_pad(filter_var($get['kode_user'], FILTER_SANITIZE_NUMBER_INT)+1, 3, "0", STR_PAD_LEFT);
			$kode_user	= $prefix.$int;
			
			$data = [
				'kode_user'	=> $kode_user,
			];
			
			$this->regisModel->insert($data);
			$insert = $this->regisModel->affectedRows();
			
			if ($insert > 0) {
				$masuk = false;
			}
		}while($masuk);
		
		echo $insert.' ok '.$kode_user;*/

        $data = [
            'alamat_email'    => 'test@gmail.com',
        ];

        $this->regisModel->update('TUSR023', $data);
        $insert = $this->regisModel->affectedRows();

        echo $insert;
    }

    public function checkEmail()
    {
        if ($this->request->isAJAX()) {
            $valid    = TRUE;
            $email     = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);

            $dataUser = $this->regisModel->where('alamat_email', $email)
                ->findAll();

            $count = count($dataUser);

            if ($count > 0) {
                $valid = FALSE;
            }

            return json_encode([
                'valid'        => $valid,
                'email '    => $email,
            ]);
        }
    }

    public function cekrefcode()
    {
        if ($this->request->isAJAX()) {
            $ref     = $this->request->getPost('ref', FILTER_SANITIZE_STRING);

            $refcek = $this->ref->where('kode_referal', $ref)->findAll();

            if (!is_null($refcek) && count($refcek) < 1) {
                return json_encode([
                    'success'        => 0,
                    'reason'        => 'Gagal memasukkan Kode Referal',
                    'description'    => 'Kode Referal Tidak Ditemukan!'
                ]);
            } else {
                return json_encode([
                    'success'        => 1,
                    'reason'        => 'Berhasil!',
                    'description'    => 'Kode Referal Dapat Digunakan'
                ]);
            }
        }
    }

    public function aktivasi($kode)
    {
        $dataUser = $this->regisModel->where('verif_kode', $kode)
            ->where('is_verif', 0)
            ->first();

        if (!is_null($dataUser) && count($dataUser) > 0) {
            $kode_user    = $dataUser['kode_user'];
            $create        = date('Y-m-d', strtotime($dataUser['created_at']));
            $nama        = $dataUser['nama_lengkap'];
            $email        = $dataUser['alamat_email'];

            $today        = date('Y-m-d');
            $cekmonth    = date('Y-m-d', strtotime($create . '+1 month'));

            if ($today != $cekmonth) {
                $data = [
                    'is_verif'        => 1,
                    'verif_kode'    => '',
                ];

                $this->regisModel->update($kode_user, $data);

                $this->email->setFrom('support.monika@panensaham.com', 'Monika Panensaham');
                $this->email->setTo($email);

                $data = array(
                    'nama'        => $nama,
                    'email'        => $email,
                    'create'    => $create,
                );

                $msg = view('email/email2', $data);

                $this->email->setSubject('Say Hi to Monika!');
                $this->email->setMessage($msg);

                $this->email->send();

                $this->session->set('aktivasi', 'true');
                return redirect()->to('/');
            } else {
                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
    }

    function sendotptouser($otp, $phone){
		$from       = "PanenSaham"; //Sender ID or SMS Masking Name, if leave blank, it will use default from telco
		$apikey     = "03f0394d9437b3e5c9163cd236e8a686-a97c4265-b5a1-4c45-a039-687ecc7397e1"; //get your API KEY from our sms dashboard
		$postUrl    = "https://api.smsviro.com/restapi/sms/1/text/advanced"; # DO NOT CHANGE THIS

		// $text		= 'Kami menerima permintaan registrasi akun monika PanenSaham menggunaan nomor anda. Masukkan kode otp untuk melanjutkan proses perubahan nomor handphone (Berlaku 10 Menit)'.$otp;

        $text		= 'Kami menerima permintaan registrasi akun monika PanenSaham menggunakan nomor anda. Kode OTP Monika PanenSaham :'.$otp.' berlaku selama 10 menit.';

		$destination = array("to" => $phone);
		$message     = array("from" => $from,
							"destinations" => $destination,
							"text" => $text);
		$postData           = array("messages" => array($message));
		$postDataJson       = json_encode($postData);
		$ch                 = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Accept:application/json", 
													'Authorization: App '.$apikey)); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$responseBody = json_decode($response);
		
		/*
		$data = array(
			"responseCode" => 200,
			"responseDescription" => "Sms has been sent",
		);*/
		
		//echo json_encode($data);
		curl_close($ch);
	}
}
