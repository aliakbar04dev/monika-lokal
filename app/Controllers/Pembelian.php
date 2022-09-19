<?php

namespace App\Controllers;

use App\Models\RegisModel;
use App\Models\UserModel;
use App\Models\RefModel;
use CodeIgniter\Controller;
use App\Models\PricingModel;
use App\Models\PembayaranModel;

require_once 'public/assets/google-api-php-client/vendor/autoload.php';
require_once 'public/assets/facebook-api-client/src/Facebook/autoload.php';

class Pembelian extends BaseController
{
    protected $regisModel;
    protected $email;

    public function __construct()
    {
        $this->pricingModel = new PricingModel();
        $this->email = \Config\Services::email();
        $this->regisModel = new RegisModel();
        $this->user = new UserModel();
        $this->ref = new RefModel();
        $this->pay = new PembayaranModel();
    }

    public function index($kodepaket)
    {
        if (!hassession('email')) {
            $detail = $this->pricingModel->getpaketdetail($kodepaket);
            $paket = $this->pricingModel->findAll();

            if (!is_null($detail) && count($detail) > 0) {
                $data = array(
                    'title' => 'Paket Detail',
                    'd'		=> $detail,
                    'paket'	=> $paket,
                    'kodepaket' => $kodepaket,
                    'loginpemb' => 'No',
                    'fbregis'   => 'No',
                );

                if(hassession('loginpembelian')){
                    $email = getsession('pembemail');
                    $dataUser = $this->regisModel->where('alamat_email', $email)
                                    ->where('kode_user_level !=', 'MULV006')
                                    ->first();
                    
                    if (!is_null($dataUser) && count($dataUser) > 0) {
                        $nama       = $dataUser['nama_lengkap'];
                        $nohp       = (int)$dataUser['no_hp'];
                        $nohp       = '+62'.substr($nohp, 0, 2) . '******' . substr($nohp, -2);
                        $koderef    = $dataUser['kode_referal'];
                        $member     = $dataUser['email_anggota'];

                        $data['loginpemb'] = 'Yes';
                        $data['email'] = getsession('pembemail');
                        $data['fullname'] = $nama;
                        $data['nohp'] =  $nohp;
                        $data['refcode'] = $koderef;
                        $data['member'] = $member;
                    }else{
                        $this->session->remove('loginpembelian');
                        $this->session->remove('loginpemb');
                        $this->session->remove('pembemail');
                    }
                }

                $fb = new \Facebook\Facebook([
                    'app_id' => FB_APP_ID, // Replace {app-id} with your app id
                    'app_secret' => FB_APP_SECRET,
                    'default_graph_version' => 'v11.0',
                ]);
                
                $helper = $fb->getRedirectLoginHelper();
                
                $permissions = ['email']; // Optional permissions
                $callbackUrl = htmlspecialchars(base_url('pembelianfacebookcalback'));
                $regcallbackUrl = htmlspecialchars(base_url('pembelianregisfacebookcalback'));
                $loginUrl = $helper->getLoginUrl($callbackUrl);
                $regisurl = $helper->getLoginUrl($regcallbackUrl);
                
                $data['authURL'] =  $loginUrl;
                $data['regisurl'] =  $regisurl;

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

                if (getsession('fb_failed_email_verifikasi') != '') {
                    $data['fb_failed_email_verifikasi'] = true;
    
                    $this->session->remove('fb_failed_email_verifikasi');
                }

                if (getsession('fb_success_account') != '') {
                    $data['fbregis'] = 'Yes';
                    $data['fb_email'] = getsession('fb_email');
                    $data['fb_fullname'] = getsession('fb_fullname');

                    $this->session->remove('fb_success_account');
                    $this->session->remove('fb_email');
                    $this->session->remove('fb_fullname');
                }

                $newdata = [
                    'pembkodepaket' => $kodepaket,
                ];

                $this->session->set($newdata);

                return view('pembelian/v_pembelian', $data);
            } else {
                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function gethargapaket(){
        if ($this->request->isAJAX()) {
            $kodepaket 	= $this->request->getPost('kodepaket', FILTER_SANITIZE_STRING);

            $hargapaket = $this->pricingModel->getpaketdetail($kodepaket);

            if (!is_null($hargapaket) && count($hargapaket) > 0) {
                return json_encode([
                    'success'		=> 1,
                    'bulanan'		=> rupiah($hargapaket['harga_paket']),
                    'tahunan'	    => rupiah($hargapaket['harga_paket_tahunan'])
                ]);
            }else{
                return json_encode([
                    'success'		=> 0,
                    'reason'		=> 'Terjadi Kesalahan',
                    'description'	=> 'Silahkan hubungi administrator'
                ]);
            }
        }
    }

    public function getrightpriceprocess(){
        if ($this->request->isAJAX()) {
			if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			} else {
                $paket 	= $this->request->getPost('paket', FILTER_SANITIZE_STRING);
                $plan 	= $this->request->getPost('plan', FILTER_SANITIZE_STRING);

                $hargapaket = $this->pricingModel->getpaketdetail($paket);

                if(!is_null($hargapaket) && count($hargapaket) > 0){
                    $email  = getsession('pembemail');
                    $usr	= $this->user->select('client_id_komunitas, email_anggota, kode_jenis_member')->where('alamat_email', $email)->first();
                    $harga  = ($plan == 'bulan')? $hargapaket['harga_paket']:$hargapaket['harga_paket_tahunan'];
                    $diskon = '';
                    $total  = $harga+5000;

                    if ($plan == 'tahun') {
                        if ($usr['kode_jenis_member'] != '') {
                            if ($usr['kode_jenis_member'] == 'JMBR002') {
                                $diskon = rupiah($hargapaket['harga_koperasi_tahunan']);
                                $total = $hargapaket['harga_koperasi_tahunan']+5000;
                            } else if ($usr['kode_jenis_member'] == 'JMBR003') {
                                $diskon = rupiah($hargapaket['harga_komunitas_tahunan']);
                                $total = $hargapaket['harga_komunitas_tahunan']+5000;
                            } else if ($usr['kode_jenis_member'] == 'JMBR004') {
                                $diskon = rupiah($hargapaket['harga_dual_tahunan']);
                                $total = $hargapaket['harga_dual_tahunan']+5000;
                            }
                        }
                    } else if ($plan == 'bulan') {
                        if ($usr['kode_jenis_member'] != '') {
                            if ($usr['kode_jenis_member'] == 'JMBR002') {
                                $diskon = rupiah($hargapaket['harga_koperasi']);
                                $total = $hargapaket['harga_koperasi']+5000;
                            } else if ($usr['kode_jenis_member'] == 'JMBR003') {
                                $diskon = rupiah($hargapaket['harga_komunitas']);
                                $total = $hargapaket['harga_komunitas']+5000;
                            } else if ($usr['kode_jenis_member'] == 'JMBR004') {
                                $diskon = rupiah($hargapaket['harga_dual']);
                                $total = $hargapaket['harga_dual']+5000;
                            }
                        }
                    }

                    return json_encode([
                        'success'		=> 1,
                        'harga'         => rupiah($harga),
                        'diskon'	    => $diskon,
                        'total'         => rupiah($total),
                    ]);
                }else{
                    return json_encode([
						'success'		=> 0,
						'reason'		=> 'Invalid Paket',
						'description'	=> 'Paket tidak ditemukan',
					]);
                }
            }
        }
    }

    public function loginpembelianuser(){
        if ($this->request->isAJAX()) {
			$email 	= $this->request->getPost('emaillogin', FILTER_SANITIZE_EMAIL);
			$pass 	= md5($this->request->getPost('passwordlogin', FILTER_SANITIZE_STRING));
            $kodepaket = $this->request->getPost('kodepaket', FILTER_SANITIZE_STRING);

            $dataUser = $this->regisModel->where('alamat_email', $email)
				->where('password', $pass)
				->where('kode_user_level !=', 'MULV006')
				->first();

			if (!is_null($dataUser) && count($dataUser) > 0) {
                if ($dataUser['is_verif'] == 1) {
                    $email      = $dataUser['alamat_email'];
                    $nama       = $dataUser['nama_lengkap'];
                    $nohp       = (int)$dataUser['no_hp'];
                    $nohp       = '+62'+substr($nohp, 0, 2) . '******' . substr($nohp, -2);
                    $koderef    = $dataUser['kode_referal'];
                    $member     = $dataUser['email_anggota'];

                    $newdata = [
                        'loginpembelian'    => 'Yes',
                        'pembemail'         => $email,
                    ];

                    $this->session->set($newdata);

                    return json_encode([
                        'success'	=> '1',
                        'email'     => $email,
                        'nama'      => $nama,
                        'nohp'      => $nohp,
                        'koderef'   => $koderef,
                        'member'    => $member
                    ]);
                }else{
                    return json_encode([
						'success'		=> '0',
						'reason'		=> 'Akun Belum Terverifikasi',
						'description'	=> 'Silahkan cek email untuk proses verifikasi.'
					]);
                }
            } else {
				return json_encode([
					'success'		=> '0',
					'reason'		=> 'Email / Password Salah',
					'description'	=> 'Silahkan coba lagi dengan email & password yang benar.'
				]);
			}
        }
    }

    public function logingoogleprocess(){
        if ($this->request->isAJAX()) {
			if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			} else {
                $id_token 	= $this->request->getPost('id_token', FILTER_SANITIZE_STRING);
                $kodepaket  = $this->request->getPost('kodepaket', FILTER_SANITIZE_STRING);

				$client = new \Google_Client(['client_id' => CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
				$payload = $client->verifyIdToken($id_token);

                if ($payload) {
                    $email = $payload['email'];

					$dataUser = $this->regisModel->where('alamat_email', $email)
						->where('kode_user_level !=', 'MULV006')
						->first();

					if (!is_null($dataUser) && count($dataUser) > 0) {
                        if ($dataUser['is_verif'] == 1) {
                            $email      = $dataUser['alamat_email'];
                            $nama       = $dataUser['nama_lengkap'];
                            $nohp       = (int)$dataUser['no_hp'];
                            $nohp       = '+62'.substr($nohp, 0, 2) . '******' . substr($nohp, -2);
                            $koderef    = $dataUser['kode_referal'];
                            $member     = $dataUser['email_anggota'];
        
                            $newdata = [
                                'loginpembelian'    => 'Yes',
                                'pembemail'         => $email,
                            ];
        
                            $this->session->set($newdata);
        
                            return json_encode([
                                'success'	=> '1',
                                'email'     => $email,
                                'nama'      => $nama,
                                'nohp'      => $nohp,
                                'koderef'   => $koderef,
                                'member'    => $member
                            ]);
                        }else{
                            return json_encode([
                                'success'		=> '0',
                                'reason'		=> 'Akun Belum Terverifikasi',
                                'description'	=> 'Silahkan cek email untuk proses verifikasi.'
                            ]);
                        }
                    } else {
						return json_encode([
							'success'		=> '0',
							'reason'		=> 'Email anda Salah',
							'description'	=> 'Email yang anda masukkan salah atau Email belum terdaftar.'
						]);
					}
                } else {
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Invalid Token',
						'description'	=> 'Invalid Token',
					]);
				}
            }
        }
    }

    public function loginfacebookprocess(){
		if (hassession('email')) {
			return redirect()->to('/');
		} else {
            if (!session_id()) {
                session_start();
            }
            echo 'Hai';
    
            $fb = new \Facebook\Facebook([
                'app_id' => FB_APP_ID, // Replace {app-id} with your app id
                'app_secret' => FB_APP_SECRET,
                'default_graph_version' => 'v11.0',
            ]);
            $kodepaket = getsession('pembkodepaket');
              
            $helper = $fb->getRedirectLoginHelper();
            
            try {
                $accessToken = $helper->getAccessToken('https://dev-monika-ps.cac-office.com/pembelianfacebookcalback');
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
                $email = $user['email'];
				$dataUser = $this->regisModel->where('alamat_email', $email)
					->where('kode_user_level !=', 'MULV006')
					->first();
				if (!is_null($dataUser) && count($dataUser) > 0) {
                    if ($dataUser['is_verif'] == 1) {
                        $email      = $dataUser['alamat_email'];
                        $nama       = $dataUser['nama_lengkap'];
                        $nohp       = (int)$dataUser['no_hp'];
                        $nohp       = '+62'.substr($nohp, 0, 2) . '******' . substr($nohp, -2);
                        $koderef    = $dataUser['kode_referal'];
                        $member     = $dataUser['email_anggota'];
    
                        $newdata = [
                            'loginpembelian'    => 'Yes',
                            'pembemail'         => $email,
                        ];
    
                        $this->session->set($newdata);
    
                        return redirect()->to('/pembelian/'.$kodepaket);
                    }else{
                        $this->session->set('fb_failed_email_verifikasi', 'true');
            		    return redirect()->to('/pembelian/'.$kodepaket);
                    }
                } else {
                    $this->session->set('fb_failed_email', 'true');
                    return redirect()->to('/pembelian/'.$kodepaket);
				}
            }else{
                $this->session->set('fb_failed_account', 'true');
                return redirect()->to('/pembelian/'.$kodepaket);
            }
        }
    }

    public function registerprocess(){
        if ($this->request->isAJAX()) {
			if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			} else {
                $usrlvl			= 'MULV001';
                $jns            = 'JMBR001';
                $nama 			= $this->request->getPost('nama', FILTER_SANITIZE_STRING);
                $kota 			= $this->request->getPost('kota', FILTER_SANITIZE_STRING);
                $email 			= $this->request->getPost('email', FILTER_SANITIZE_STRING);
                $pass 			= $this->request->getPost('password', FILTER_SANITIZE_STRING);
                $phone 			= $this->request->getPost('nohp', FILTER_SANITIZE_STRING);
                $kodepaket      = $this->request->getPost('kodepaket', FILTER_SANITIZE_STRING);
                $phone		    = preg_replace("/[^0-9]/", "", $phone);
                $phone		    = (int)$phone;
                $phonedb	    = '0'.$phone;
                $phone		    = '+62'.$phone;

                $dataUser = count($this->regisModel->where('alamat_email', $email)
				->findAll());

                $nohpdata	= $this->regisModel->select('no_hp')->where('no_hp', $phonedb)->findAll();

                if(count($nohpdata) > 0){
                    return json_encode([
                        'success'		=> 0,
                        'reason'		=> 'Gagal Daftar',
                        'description'	=> 'No Hp Sudah Terdaftar, silahkan gunakan nomor lain',
                    ]);
                }

                if ($dataUser > 0) {
                    return json_encode([
                        'success'		=> '0',
                        'reason'		=> 'Registered Email',
                        'description'	=> 'Registrasi gagal, Akun sudah teregistrasi'
                    ]);
                } else {
                    $otp 		= rand(100000, 999999);
                    $exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));
                    $masuk      = true;

                    do {
                        $prefix 	= 'TUSR';
                        $get		= $this->regisModel->select('kode_user, CAST(SUBSTR(kode_user FROM 5) AS SIGNED) as kode')->orderBy('kode', "desc")->first();

                        if (!is_null($get) && count($get) > 0) {
                            $int 		= str_pad(filter_var($get['kode_user'], FILTER_SANITIZE_NUMBER_INT) + 1, 3, "0", STR_PAD_LEFT);
                            $kode_user	= $prefix . $int;
                        } else {
                            $int = '001';
                            $kode_user	= $prefix . $int;
                        }

                        $data = [
                            'kode_user'		=> $kode_user,
                            'alamat_email'	=> $email,
                        ];

                        $this->regisModel->insert($data);
                        $insert = $this->regisModel->affectedRows();

                        if ($insert > 0) {
                            $masuk = false;
                        }
                    } while ($masuk);

                    $aktiv 	= md5($email . $kode_user);

                    $data = [
                        'kode_user_level'		=> $usrlvl,
                        'kode_jenis_member' 	=> $jns,
                        'nama_lengkap'			=> $nama,
                        'nohp'                  => $phonedb,
                        'password'				=> md5($pass),
                        'created_at'			=> date('Y-m-d H:i:s'),
                        'trial_expire'			=> date('Y-m-d', strtotime('+7 day')),
                        'verif_kode'			=> $aktiv
                    ];

                    $this->regisModel->update($kode_user, $data);
                    $insert = $this->regisModel->affectedRows();

                    if ($insert > 0) {
                        $this->sendotptouser($otp, $phone);
                        
                        $newdata = [
                            'regis_otp_input'	    => 'Yes',
                            'regis_otp_phone'	    =>  $phonedb,
                            'regis_otp_code_user'	=>  $kode_user,
                            'viapembelian'          => 'Yes',
                            'kodepaketpembelian'    => $kodepaket,
                        ];

                        $this->session->set($newdata);

                        return json_encode([
                            'success'		=> $insert,
                            'reason'		=> 'Apply Berhasil',
                            'description'	=> 'Silahkan lakukan proses selanjutnya untuk aktivasi'
                        ]);
                    } else {
                        return json_encode([
                            'success'		=> $insert,
                            'reason'		=> 'Apply Failed',
                            'description'	=> 'Please Contact Administrator'
                        ]);
                    }
                }
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
			} else {
                $id_token 	= $this->request->getPost('id_token', FILTER_SANITIZE_STRING);

				$client = new \Google_Client(['client_id' => CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
				$payload = $client->verifyIdToken($id_token);

                if ($payload) {
                    $fullname = $payload['name'];
                    $email = $payload['email'];

					$dataUser = $this->regisModel->where('alamat_email', $email)
						->where('kode_user_level !=', 'MULV006')
						->first();

                    if ($dataUser > 0) {
                        return json_encode([
                            'success'		=> '0',
                            'reason'		=> 'Registered Email',
                            'description'	=> 'Registrasi gagal, Akun sudah teregistrasi'
                        ]);
                    } else {
                        return json_encode([
                            'success'		=> '0',
                            'email'         => $email,
                            'fullname'      => $fullname,
                        ]);
                    }
                } else {
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Invalid Token',
						'description'	=> 'Invalid Token',
					]);
				}
            }
        }
    }

    public function regisfacebookprocess(){
			if (hassession('email')) {
				return redirect()->to('/');
			} else {
                if (!session_id()) {
                    session_start();
                }

                $kodepaket = getsession('pembkodepaket');
        
                $fb = new \Facebook\Facebook([
                    'app_id' => FB_APP_ID, // Replace {app-id} with your app id
                    'app_secret' => FB_APP_SECRET,
                    'default_graph_version' => 'v11.0',
                ]);
                  
                $helper = $fb->getRedirectLoginHelper();
                
                try {
                    $accessToken = $helper->getAccessToken('https://dev-monika-ps.cac-office.com/pembelianregisfacebookcalback');
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

					$dataUser = $this->regisModel->where('alamat_email', $email)
						->where('kode_user_level !=', 'MULV006')
						->first();

                    if ($dataUser > 0) {
                        $this->session->set('fb_registered_account', 'true');
                        return redirect()->to('/pembelian/'.$kodepaket);
                    } else {
                        $this->session->set('fb_success_account', 'true');
                        $this->session->set('fb_email', $email);
                        $this->session->set('fb_fullname', $fullname);

                        return redirect()->to('/pembelian/'.$kodepaket);
                    }
                } else{
                    $this->session->set('fb_failed_account', 'true');
                    return redirect()->to('/pembelian/'.$kodepaket);
                }
            }
    }

    public function membersubmitprocess(){
        if ($this->request->isAJAX()) {
			if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			} else {
                $komu 	= $this->request->getPost('emailanggotapembelian', FILTER_SANITIZE_STRING);

                if(hassession('loginpembelian')){
                    $email  = getsession('pembemail');
                    $usr	= $this->user->select('client_id_komunitas, email_anggota, kode_user')->where('alamat_email', $email)->first();

                    if (!is_null($usr) && count($usr) > 0) {
                        if ($komu != '' && !empty($komu)) {
                            $anoncheck = $this->user->select('client_id_komunitas')->where('client_id_komunitas', $komu)->first();

                            if ($anoncheck['client_id_komunitas'] != '') {
								return json_encode([
									'success'		=> 0,
									'reason'		=> 'Integration Failed',
									'description'	=> $komu . " Sudah terpakai, Jika anda merasa data anda belum terpakai silahkan Hubungi kami via Live Chat atau Email"
								]);
							} else {
                                $url	= 'https://dev-web-cac-advisory.cac-office.com/api/cek_email_komunitas';

								$ch = curl_init( $url );

								curl_setopt_array($ch, array(
									CURLOPT_URL => $url,
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => '',
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 0,
									CURLOPT_FOLLOWLOCATION => true,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => 'POST',
									CURLOPT_POSTFIELDS => array('email' => $komu),
								));

								$response = curl_exec( $ch );
								$response = json_decode($response);

								curl_close($ch);

								$check = $response->messages;
								
								$kode_user = $usr['kode_user'];

                                if (!is_null($check) && $check == 'Account verified') {
                                    $member = false;
									$jns = '';

									if ($usr['email_anggota'] != '') {
										$jns = 'JMBR004';
									} else {
										$jns = 'JMBR003';
									}

									$updata = [
										'client_id_komunitas' => $komu,
										'kode_jenis_member' => $jns,
									];

									$this->user->update($kode_user, $updata);
                                    
									return json_encode([
										'success'		=> 1,
										'reason'		=> 'Integration Successfull',
										'description'	=> 'Email Komunitas Telah Berhasil Integrasi'
									]);
                                } else {
									//?email=ferdihub@gmail.com
                                    $url	= 'https://panensaham.com/api/check_email_member';

                                    $ch = curl_init( $url );

                                    curl_setopt_array($ch, array(
                                        CURLOPT_URL => $url,
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 0,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => 'POST',
                                        CURLOPT_POSTFIELDS => array('email' => $komu),
                                    ));

                                    $response = curl_exec( $ch );
                                    $response = json_decode($response);

                                    curl_close($ch);

                                    $check = $response->messages;

                                    if (!is_null($check) && $check == 'Account verified') {
                                        $member = false;
                                        $jns = '';
    
                                        if ($usr['email_anggota'] != '') {
                                            $jns = 'JMBR004';
                                        } else {
                                            $jns = 'JMBR003';
                                        }
    
                                        $updata = [
                                            'client_id_komunitas' => $komu,
                                            'kode_jenis_member' => $jns,
                                        ];
    
                                        $this->user->update($kode_user, $updata);
                                        
                                        return json_encode([
                                            'success'		=> 1,
                                            'reason'		=> 'Integration Successfull',
                                            'description'	=> 'Email Komunitas Telah Berhasil Integrasi'
                                        ]);
                                    } else {

                                        return json_encode([
                                            'success'		=> 0,
                                            'reason'		=> 'Integration Failed',
                                            'description'	=> 'Email Komunitas Tidak Ditemukan!!'
                                        ]);
                                    }
								}
                            }
                        } else {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Integration Failed',
								'description'	=> 'Email Komunitas Tidak Diinput!!'
							]);
						}
                    } else {
                        return json_encode([
                            'success'		=> 0,
                            'reason'		=> "Failed to get data",
                            'description'	=> "Can't find user details",
                        ]);
                    }
                } else {
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Not Logged In',
						'description'	=> 'Please log in first',
					]);
				}
            }
        }
    }

    public function refcodeprocess(){
        if ($this->request->isAJAX()) {
			if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			} else {
                $referal 	= $this->request->getPost('pembrefcode', FILTER_SANITIZE_STRING);

                if(hassession('loginpembelian')){
                    $email  = getsession('pembemail');
                    $usr	= $this->user->select('kode_referal,kode_user')->where('alamat_email', $email)->first();

                    if (!is_null($usr) && count($usr) > 0) {
                        if ($referal != '' && !empty($referal)) {
                            if ($usr['kode_referal'] != '') {
                                return json_encode([
                                    'success'		=> 0,
                                    'reason'		=> 'Integration Failed',
                                    'description'	=> "Already integrated, can't integration more than once"
                                ]);
                            } else {
                                $refcek = $this->ref->where('kode_referal',$referal)->findAll();

                                if (!is_null($refcek) && count($refcek) < 1) {
                                    return json_encode([
                                        'success'		=> 0,
                                        'reason'		=> 'Integration Failed',
                                        'description'	=> 'Kode Referal Tidak Ditemukan!!'
                                    ]);
                                }

                                $this->user->updateRefCode($email, $referal);

                                return json_encode([
                                    'success'		=> 1,
                                    'reason'		=> 'Integration Success',
                                    'description'	=> 'Kode Referal berhasil disimpan'
                                ]);
                            }
                        } else {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Integration Failed',
								'description'	=> 'Kode Referal Tidak Diinput!!'
							]);
						}
                    } else {
                        return json_encode([
                            'success'		=> 0,
                            'reason'		=> "Failed to get data",
                            'description'	=> "Can't find user details",
                        ]);
                    }
                } else {
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Not Logged In',
						'description'	=> 'Please log in first',
					]);
				}
            }
        }
    }

    public function processpembelianpayment(){
        if ($this->request->isAJAX()) {
			if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			} else {
                if(hassession('loginpembelian')){
                    $email  = getsession('pembemail');
                    $usr	= $this->user->getdetailuser($email);

                    if (!is_null($usr) && count($usr) > 0) {
                        $usrlvl = $this->user->getuserlvl($email);
                        $paket 	= $this->request->getPost('paket', FILTER_SANITIZE_STRING);
                        $plan 	= $this->request->getPost('plan', FILTER_SANITIZE_STRING);
                        $terms  = $this->request->getPost('termsagree', FILTER_SANITIZE_STRING);
                        $detail = $this->pricingModel->getpaketdetail($paket);
                        $extnd	= 'normal';
                        $orderid = '';

                        if($terms != 'true'){
                            return json_encode([
                                'success'		=> 0,
                                'reason'		=> "Failed to process payment",
                                'description'	=> "Please agree to our terms and condition",
                            ]);
                        }

                        if ($plan != 'tahun' && $plan != 'bulan') {
                            $plan = 'bulan';
                        }

                        if (!is_null($detail) && count($detail) > 0) {
                            $rankusr    = (int)substr($usrlvl, -1);
							$rankpkt    = (int)substr($detail['kode_user_level'], -1);

                            if($rankpkt > $rankusr || $rankpkt == $rankusr){

                                if($rankpkt == $rankusr){
									$extnd = 'extendnontemp';
								}
                                
                                $kode_user = $usr['kode_user'];
                                //$cek		= $this->pay->cekpendingsammepayment($kode_user, $email, $paket, $plan);
                                $AUTH_STRING = 'Basic ' . base64_encode(SERVERKEY . ':');

                                /*
                                if (!is_null($cek) && count($cek) > 0) {
                                    $orderid = $cek['kode_pembayaran'];

                                    $data = array(
                                        'transaction_details' => array(
                                            'id_user'		=> $kode_user,
                                            'email_user' 	=> $email,
                                            'kode_paket'	=> $cek['kode_paket'],
                                            'nama_paket'	=> $cek['nama_paket'],
                                            'order_id' 		=> $cek['kode_pembayaran'],
                                            'gross_amount'	=> $cek['total'],
                                        ),
                                        'credit_card' => array(
                                            'secure' => true
                                        ),
                                        'customer_details' => array(
                                            'first_name' => getsession('nama'),
                                            'email' => $email,
                                            'phone' => getsession('nohp'),
                                        ),
                                    );
                                }else{
                                */
                                
                                $jnis		= $this->user->getjenismember($email);
                                $price 		= '';
                                $total		= '';
                                $referal    = $usr['kode_referal'];
                                if ($plan == 'tahun') {
                                    if ($jnis['kode_jenis_member'] != '') {
                                        if ($jnis['kode_jenis_member'] == 'JMBR001') {
                                            $total = $detail['harga_paket_tahunan'];
                                        } else if ($jnis['kode_jenis_member'] == 'JMBR002') {
                                            $total = $detail['harga_koperasi_tahunan'];
                                        } else if ($jnis['kode_jenis_member'] == 'JMBR003') {
                                            $total = $detail['harga_komunitas_tahunan'];
                                        } else if ($jnis['kode_jenis_member'] == 'JMBR004') {
                                            $total = $detail['harga_dual_tahunan'];
                                        }
                                    }else{
                                        $total = $detail['harga_paket_tahunan'];
                                    }
                                } else if ($plan == 'bulan') {
                                    if ($jnis['kode_jenis_member'] != '') {
                                        if ($jnis['kode_jenis_member'] == 'JMBR001') {
                                            $total = $detail['harga_paket'];
                                        } else if ($jnis['kode_jenis_member'] == 'JMBR002') {
                                            $total = $detail['harga_koperasi'];
                                        } else if ($jnis['kode_jenis_member'] == 'JMBR003') {
                                            $total = $detail['harga_komunitas'];
                                        } else if ($jnis['kode_jenis_member'] == 'JMBR004') {
                                            $total = $detail['harga_dual'];
                                        }
                                    }else{
                                        $total = $detail['harga_paket'];
                                    }
                                }
                                $harga_paket = $total;
                                $total = (int)$total+5000;
                                $orderid 	= $this->pay->getorderid();
                                $data = [
                                    'id_user'			=> $kode_user,
                                    'email_user' 		=> $email,
                                    'kode_paket'		=> $paket,
                                    'ref_code'			=> $referal,
                                    'extend_stats'		=> $extnd,
                                    'nama_paket'		=> $detail['title'],
                                    'harga_paket'		=> $harga_paket,
                                    'disc_per'			=> 0,
                                    'disc_val'			=> 0,
                                    'service_charge'	=> 5000,
                                    'langganan'			=> $plan,
                                    'total'				=> $total,
                                    'created_at'		=> date('Y-m-d H:i:s'),
                                    'expire_date'		=> date('Y-m-d H:i:s', strtotime('+1 day')),
                                    'status_pembayaran'	=> 'payment',
                                ];
                                $this->pay->update($orderid, $data);
                                $insert = $this->pay->affectedRows();
                                if ($insert > 0) {
                                    $result = '';
                                    $httpcode = '';
                                    $data = array(
                                        'transaction_details' => array(
                                            'id_user'		=> $kode_user,
                                            'email_user' 	=> $email,
                                            'kode_paket'	=> $paket,
                                            'nama_paket'	=> $detail['title'],
                                            'order_id' 		=> $orderid,
                                            'gross_amount'	=> $total,
                                        ),
                                        'credit_card' => array(
                                            'secure' => true
                                        ),
                                        'customer_details' => array(
                                            'first_name' => getsession('nama'),
                                            'email' => getsession('email'),
                                            'phone' => getsession('nohp'),
                                        ),
                                    );
                                } else {
                                    return json_encode([
                                        'success'		=> '0',
                                        'reason'		=> 'Terjadi Kesalahan',
                                        'description'	=> 'Gagal Insert Data.'
                                    ]);
                                }
                                //}

                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, MIDTRANSURL);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                    'Authorization: ' . $AUTH_STRING,
                                    'Accept: application/json',
                                    'Content-Type: application/json',
                                ));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, 1);

                                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                                $result = curl_exec($ch);
                                $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                curl_close($ch);

                                $result = json_decode($result);

                                if ($httpcode == 201) {
                                    return json_encode([
                                        'success'		=> '1',
                                        'token'			=> $result->token,
                                        'orderid'       => $orderid,
                                        'reason'		=> 'Search Success',
                                        'description'	=> 'Search Success'
                                    ]);
                                } else {
                                    return json_encode([
                                        'success'		=> '0',
                                        'checkthis'		=> $result,
                                        'reason'		=> 'Payment failed',
                                        'description'	=> 'Something Wrong.....',
                                    ]);
                                }
                            }else{
                                return json_encode([
                                    'success'		=> '0',
                                    'reason'		=> 'Terjadi Kesalahan',
                                    'description'	=> 'Paket yang dipilih lebih kecil dari paket yang sedang berjalan'
                                ]);
                            }
                        } else {
                            return json_encode([
                                'success'		=> '0',
                                'reason'		=> 'Terjadi Kesalahan',
                                'description'	=> 'Paket tidak ditemukan.'
                            ]);
                        }
                    } else {
                        return json_encode([
                            'success'		=> 0,
                            'reason'		=> "Failed to get data",
                            'description'	=> "Can't find user details",
                        ]);
                    }
                }else{
                    return json_encode([
						'success'		=> 0,
						'reason'		=> 'Not Logged In',
						'description'	=> 'Please log in first',
					]);
                }
            }
        }
    }

    public function logoutprocess(){
        $kodepaket = getsession('pembkodepaket');
        $this->session->destroy();
		return redirect()->to('/pembelian/'.$kodepaket);
    }

    public function thanks()
	{
		$data = array(
			'title' => 'Thanks'
		);

		$fb = new \Facebook\Facebook([
			'app_id' => FB_APP_ID, // Replace {app-id} with your app id
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => 'v3.2',
		]);
		  
		$helper = $fb->getRedirectLoginHelper();
		  
		$permissions = ['email']; // Optional permissions
		$callbackUrl = htmlspecialchars(base_url('facebookcalback'));
		$loginUrl = $helper->getLoginUrl($callbackUrl);
		  
		$data['authURL'] =  $loginUrl;
		
		return view('thanks/view_thanksland', $data);
	}

    function sendotptouser($otp, $phone){
		$from       = "PanenSaham"; //Sender ID or SMS Masking Name, if leave blank, it will use default from telco
		$apikey     = "03f0394d9437b3e5c9163cd236e8a686-a97c4265-b5a1-4c45-a039-687ecc7397e1"; //get your API KEY from our sms dashboard
		$postUrl    = "https://api.smsviro.com/restapi/sms/1/text/advanced"; # DO NOT CHANGE THIS

		$text		= 'Kami menerima permintaan registrasi akun monika panen saham menggunaan nomor anda. Masukkan kode otp untuk melanjutkan proses perubahan nomor handphone (Berlaku 10 Menit)'.$otp;

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