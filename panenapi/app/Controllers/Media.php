<?php namespace App\Controllers;

use App\Models\MediaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Media extends BaseController
{
	use ResponseTrait;
	
	function getVideo(){
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
				$mediaModel = new MediaModel();
				$kode_fm    = $this->request->getGet("kode_filter_media");

				if($kode_fm != '')
				{
					$data = $mediaModel->video($kode_fm);
					if (!empty($data))
					{
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Video',
							'data' => $data
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => FALSE,
							'messages' => 'Incorrect kode filter',
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => FALSE,
						'messages' => 'Required kode filter'
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
	
	function getGallery(){
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
				$mediaModel = new MediaModel();
				$kode_fm    = $this->request->getGet("kode_filter_media");

				if($kode_fm != '')
				{			
					$data = $mediaModel->galery($kode_fm);
					if (!empty($data))
					{
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Gallery',
							'data' => $data
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => FALSE,
							'messages' => 'Incorrect kode filter',
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => FALSE,
						'messages' => 'Required kode filter'
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