<?php

namespace App\Controllers;

use App\Models\RegisModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

require_once 'public/assets/google-api-php-client/vendor/autoload.php';
require_once 'public/assets/facebook-api-client/src/Facebook/autoload.php';

class Login extends BaseController
{
	protected $regisModel;

	public function __construct()
	{
		$this->regisModel = new RegisModel();
		$this->user = new UserModel();
	}

	public function auth()
	{
		if ($this->request->isAJAX()) {
			$email 	= $this->request->getPost('emaillogin', FILTER_SANITIZE_EMAIL);
			$pass 	= md5($this->request->getPost('passwordlogin', FILTER_SANITIZE_STRING));

			$dataUser = $this->regisModel->where('alamat_email', $email)
				->where('password', $pass)
				->where('kode_user_level !=', 'MULV006')
				->first();

			if (!is_null($dataUser) && count($dataUser) > 0) {
				if ($dataUser['is_verif'] == 1) {
					$this->session->remove('loginpemb');
                    $this->session->remove('pembemail');

					$sess = sha1(date('YmdHis'));
					$email = $dataUser['alamat_email'];

					$this->user->update_session($email, $sess);

					$newdata = [
						'kode_user'	=> $dataUser['kode_user'],
						'nama'		=> $dataUser['nama_lengkap'],
						'email'		=> $email,
						'nohp'		=> $dataUser['no_hp'],
						'usrlvl'	=> $dataUser['kode_user_level'],
						'photo'		=> $dataUser['photo'],
						'sesskode'	=> $sess,
					];

					$this->session->set($newdata);

					return json_encode([
						'success'		=> '1',
						'reason'		=> 'Login Success',
						'description'	=> 'Account Found, Reloading Page....',
						//'link'			=>  base_url() . '/pengumuman',
					]);
				} else {
					if ($dataUser['regis_no_hp'] == '') {
						$this->session->remove('viapembelian');
						$this->session->remove('kodepaketpembelian');
						$this->session->remove('regis_phone_input');
						$this->session->remove('regis_phone_code_user');

						$kode_user = $dataUser['kode_user'];

						$newdata = [
							'regis_phone_input'	=> 'Yes',
							'regis_phone_code_user'	=>  $kode_user,
						];

						$this->session->set($newdata);

						return json_encode([
							'success'		=> '5',
							'reason'		=> 'Akun Belum Terverifikasi',
							'description'	=> 'Silahkan submit no hp terlebih dahulu.'
						]);
					} else {
						$this->session->remove('viapembelian');
						$this->session->remove('kodepaketpembelian');
						$this->session->remove('regis_otp_input');
						$this->session->remove('regis_otp_phone');
						$this->session->remove('regis_otp_code_user');

						$kode_user = $dataUser['kode_user'];
						$phonedb = $dataUser['regis_no_hp'];

						$newdata = [
							'regis_otp_input'	    => 'Yes',
							'regis_otp_phone'	    =>  $phonedb,
							'regis_otp_code_user'	=>  $kode_user,
						];

						$this->session->set($newdata);

						return json_encode([
							'success'		=> '6',
							'reason'		=> 'Akun Belum Terverifikasi',
							'description'	=> 'Silahkan selesaikan OTP terlebih dahulu.'
						]);
					}
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

	public function logingoogleprocess()
	{
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
					$email = $payload['email'];

					$dataUser = $this->regisModel->where('alamat_email', $email)
						->where('kode_user_level !=', 'MULV006')
						->first();

					if (!is_null($dataUser) && count($dataUser) > 0) {
						if ($dataUser['is_verif'] == 1) {
							$sess = sha1(date('YmdHis'));
							$email = $dataUser['alamat_email'];

							$this->user->update_session($email, $sess);

							$newdata = [
								'kode_user'	=> $dataUser['kode_user'],
								'nama'		=> $dataUser['nama_lengkap'],
								'email'		=> $email,
								'nohp'		=> $dataUser['no_hp'],
								'usrlvl'	=> $dataUser['kode_user_level'],
								'photo'		=> $dataUser['photo'],
								'sesskode'	=> $sess,
							];

							$this->session->set($newdata);

							return json_encode([
								'success'		=> '1',
								'reason'		=> 'Login Success',
								'description'	=> 'Account Found, Reloading Page....',
								//'link'			=>  base_url() . '/pengumuman',
							]);
						} else {
							if ($dataUser['no_hp'] == '') {
								$this->session->remove('regis_phone_input');
								$this->session->remove('regis_phone_code_user');

								$kode_user = $dataUser['kode_user'];

								$newdata = [
									'regis_phone_input'	=> 'Yes',
									'regis_phone_code_user'	=>  $kode_user,
								];

								$this->session->set($newdata);

								return json_encode([
									'success'		=> '5',
									'reason'		=> 'Akun Belum Terverifikasi',
									'description'	=> 'Silahkan masukkan no hp terlebih dahulu.'
								]);
							} else {
								$this->session->remove('regis_otp_input');
								$this->session->remove('regis_otp_phone');
								$this->session->remove('regis_otp_code_user');

								$kode_user = $dataUser['kode_user'];
								$phonedb = $dataUser['no_hp'];

								$newdata = [
									'regis_otp_input'	    => 'Yes',
									'regis_otp_phone'	    =>  $phonedb,
									'regis_otp_code_user'	=>  $kode_user,
								];

								$this->session->set($newdata);

								return json_encode([
									'success'		=> '6',
									'reason'		=> 'Akun Belum Terverifikasi',
									'description'	=> 'Silahkan selesaikan OTP terlebih dahulu.'
								]);
							}
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
            $accessToken = $helper->getAccessToken('https://dev-monika-ps.cac-office.com/facebookcalback');
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
            $fullname   = $user['name'];
            $email      = $user['email'];

            $dataUser = $this->regisModel->where('alamat_email', $email)
						->where('kode_user_level !=', 'MULV006')
						->first();
			
			if (!is_null($dataUser) && count($dataUser) > 0) {
				if ($dataUser['is_verif'] == 1) {
					$sess = sha1(date('YmdHis'));
					$email = $dataUser['alamat_email'];
					$this->user->update_session($email, $sess);

					$newdata = [
						'kode_user'	=> $dataUser['kode_user'],
						'nama'		=> $dataUser['nama_lengkap'],
						'email'		=> $email,
						'nohp'		=> $dataUser['no_hp'],
						'usrlvl'	=> $dataUser['kode_user_level'],
						'photo'		=> $dataUser['photo'],
						'sesskode'	=> $sess,
					];
	
					$this->session->set($newdata);

					return redirect()->to('/');
				} else {
					if ($dataUser['no_hp'] == '') {
						$this->session->remove('regis_phone_input');
						$this->session->remove('regis_phone_code_user');
						
						$kode_user = $dataUser['kode_user'];
						$newdata = [
							'regis_phone_input'	=> 'Yes',
							'regis_phone_code_user'	=>  $kode_user,
						];
						$this->session->set($newdata);

						return redirect()->to('/verifikasi');
					} else {
						$this->session->remove('regis_otp_input');
						$this->session->remove('regis_otp_phone');
						$this->session->remove('regis_otp_code_user');
						$kode_user = $dataUser['kode_user'];
						$phonedb = $dataUser['no_hp'];
						$newdata = [
							'regis_otp_input'	    => 'Yes',
							'regis_otp_phone'	    =>  $phonedb,
							'regis_otp_code_user'	=>  $kode_user,
						];
						$this->session->set($newdata);

						return redirect()->to('/registrationotp');
					}
				}
			} else {
				$this->session->set('fb_failed_email', 'true');
            	return redirect()->to('/newlogin');
			}
        }else{
            $this->session->set('fb_failed_account', 'true');
            return redirect()->to('/newlogin');
        }
    }

	public function logout()
	{
		if ($this->request->isAJAX()) {
			$this->session->destroy();

			return json_encode([
				'success'		=> '1',
				'reason'		=> 'Logout Success',
				'description'	=> 'Account Logout, Reloading Page....'
			]);
		} else {
			$this->session->destroy();
			return redirect()->to('/');
		}
	}
}
