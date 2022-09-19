<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Email extends BaseController
{
	use ResponseTrait;
	
	function resetpassword(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$emailaddr = $this->request->getVar('email');
				
				if ($emailaddr != '')
				{
					//$usr = $userModel->select('kode_user, nama_lengkap, no_hp')->where('alamat_email', $emailaddr)->where('is_verif', 1)->first();
					$usr = $userModel->select('kode_user, nama_lengkap, no_hp')->where('alamat_email', $emailaddr)->first();
			
					if(!is_null($usr) && count($usr) > 0){
						$kode_user	= $usr['kode_user'];
						$nama		= $usr['nama_lengkap'];
						$rand 		= mt_rand();
						$code		= md5($emailaddr.$usr['no_hp'].$rand);
						
						$data = [
							'forget_kode'	=> $code,
							'forget_expire'	=> date('Y-m-d H:i:s', strtotime('+1 day')),
						];
						
						$userModel->update($kode_user, $data);
						
						$mail = \Config\Services::email();
						$mail->setFrom('no-reply@panensaham.com', 'No-reply Panensaham');
						$mail->setTo($emailaddr);

						$data = array(
							'nama'		=> $nama,	
							'email'		=> $emailaddr,
							'link'		=> 'https://monika.panensaham.com/changepassword/'. $code,
						);

						$msg = view('v_resetpass', $data);

						$mail->setSubject('Permintaan Perubahan Password');
						$mail->setMessage($msg);

						$mail->send();
						
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Email has sent succesfully',
						];
						return $this->respondCreated($response);
					}else{
						$response = [
							'status' => 500,
							'error' => FALSE,
							'messages' => 'Email not registered',
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Process has refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
}