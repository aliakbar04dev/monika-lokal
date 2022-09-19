<?php namespace App\Controllers;

use App\Models\ListChartFaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class ListChartFa extends BaseController
{
	use ResponseTrait;
	
	function getAll(){
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
				$chartfaModel = new ListChartFaModel();

				$data = $chartfaModel->findAll();
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Kode FA',
                    'data' => $data
                ];
                return $this->respondCreated($response);
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