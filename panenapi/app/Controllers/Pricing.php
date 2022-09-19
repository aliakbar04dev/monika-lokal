<?php namespace App\Controllers;

use App\Models\PricingModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Pricing extends BaseController
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
				$pricingModel = new PricingModel();

				// $data = $pricingModel->findAll();
                $data = $pricingModel->where('kode_user_level !=', 'MULV002')->findAll();
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Pricing',
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
	
	function getAllNew(){
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
				$pricingModel = new PricingModel();

				// $data = $pricingModel->findAll();
                $data = $pricingModel->where('kode_user_level !=', 'MULV002')->findAll();
				
				$thrmon = $data;
				$sixmon = $data;
				$oneyear = $data;
				
				foreach($thrmon as $key => $value) {
					$poin = 3 * $value['poin'];
					$harga_paket = 3 * $value['harga_paket'];
					
					$thrmon[$key]['bulan'] = '3';
					$thrmon[$key]['poin'] = (string) $poin;
					$thrmon[$key]['harga_paket'] = (string) $harga_paket;
				}
				
				foreach($sixmon as $key => $value) {
					$poin = 6 * $value['poin'];
					$harga_paket = 6 * $value['harga_paket'];
					
					$sixmon[$key]['bulan'] = '6';
					$sixmon[$key]['poin'] = (string) $poin;
					$sixmon[$key]['harga_paket'] = (string) $harga_paket;
				}
				
				foreach($oneyear as $key => $value) {
					$poin = 12 * $value['poin'];
					//$harga_paket = $value['kode_harga_paket'] == 'HPKT004' ? 1800000 : 12 * $value['harga_paket'];
					$harga_paket = $value['kode_harga_paket'] == 'HPKT004' ? 1800000 :900000;
					
					$oneyear[$key]['bulan'] = '12';
					$oneyear[$key]['poin'] = (string) $poin;
					$oneyear[$key]['harga_paket'] = (string) $harga_paket;
				}
				
				$output = array_merge($data, $thrmon, $sixmon, $oneyear);
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Pricing',
                    'data' => $output,
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

    function getByLevel(){
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
				$pricingModel = new PricingModel();
                $level  = $this->request->getGet("level");

				$data = $pricingModel->where("kode_user_level", $level)->first();
		
                if (!empty($data))
				{
                    $response = [
                        'status' => 200,
                        'error' => FALSE,
                        'messages' => 'Pricing Detail',
                        'data' => $data
                    ];
                    return $this->respondCreated($response);
                }
                else
                {
                    $response = [
                        'status' => 500,
                        'error' => TRUE,
                        'messages' => 'Data not found',
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