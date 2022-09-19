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

class Imei extends BaseController
{
	use ResponseTrait;
	
	function getImei(){
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
				$inputan    = $this->request->getGet("kodeuser");

				if($inputan != '')
				{
					$data = $userModel->where("kode_user", $inputan)
									  ->first();
					if (!empty($data))
					{
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data User',
							'imei' => $data['imei_code'],
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => FALSE,
							'messages' => 'User not found',
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => FALSE,
						'messages' => 'Required kode user'
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
	
	public function changeImei($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		$imei = $data['imei'];
		
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
				if ($imei != '')
				{
					$data = array(
							'imei_code' => $imei,
						);
							
					//return $this->respondCreated($data);
							
					$userModel->update($kode, $data);
					
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Imei has update',
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
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