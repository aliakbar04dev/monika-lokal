<?php namespace App\Controllers;

use App\Models\ContactusModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class ContactUs extends BaseController
{
	use ResponseTrait;
	
	function insert(){
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
				$contactModel = new ContactusModel();
				
				$nama = $this->request->getVar('nama');
				$email= $this->request->getVar('email');
				$nohp = $this->request->getVar('no_hp');
				$pesan= $this->request->getVar('isi_pesan');
				
				if ($nama != '' && $email != '' && $pesan != '')
				{
					$data = array(
					'nama' => $nama,
					'email' => $email,
					'no_hp' => $nohp,
					'isi_pesan' => $pesan,
					);
					
					$contactModel->insert($data);
			
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data has created',
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Insert data refused'
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