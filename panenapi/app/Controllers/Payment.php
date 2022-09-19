<?php namespace App\Controllers;

use App\Models\PaymentModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Payment extends BaseController
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
				$payModel = new PaymentModel();
                $inputan  = $this->request->getGet("inputan");

				$data = $payModel->where("id_user", $inputan)->orWhere("email_user", $inputan)->orderBy('created_at', 'DESC')->find();
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Pembayaran',
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
	
	function getAllByLimit(){
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
				$payModel = new PaymentModel();
                $keyword = $this->request->getGet("inputan");
				$status  = $this->request->getGet("filter");
                $limit = $this->request->getGet("limit");
                $offset = $this->request->getGet("offset");

                if (!empty($status))
                {
                    $data = $payModel->where("email_user", $keyword)
											->where("status_pembayaran", $status)
											->orderBy('created_at','DESC')
                                            ->limit($limit, $offset)
                                            ->find();
                }
                else
                {
					$sts = ['settlement', 'pending', 'expire'];
                    $data = $payModel->where("email_user", $keyword)
											->whereIn("status_pembayaran", $sts)
											->orderBy('created_at','DESC')
                                            ->limit($limit, $offset)
                                            ->find();
                }

                if (empty($data)) {
                    $response = [
                        'status' => 401,
                        'error' => TRUE,
                        'messages' => 'Data not found'
                    ];
                    return $this->respondCreated($response);
                }
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Pembayaran',
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

    function getByInv(){
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
				$payModel = new PaymentModel();
                $inputan  = $this->request->getGet("inputan");
                $noinv    = $this->request->getGet("kode_pembayaran");

				$data = $payModel->where("kode_pembayaran", $noinv)->where("id_user", $inputan)->orWhere("email_user", $inputan)->first();
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Pembayaran',
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
				$payModel = new PaymentModel();
                date_default_timezone_set("Asia/Jakarta");
				
				//$kode_pembayaran = $this->request->getVar('kode_pembayaran');
                $id_user = $this->request->getVar('id_user');
                $email_user = $this->request->getVar('email_user');
				$kode_paket = $this->request->getVar('kode_paket');
				$nama_paket = $this->request->getVar('nama_paket');
				$harga_paket = $this->request->getVar('harga_paket');
				$disc_per = 0;
				$disc_val = 0;
				$langganan = $this->request->getVar('langganan');
				$total = $this->request->getVar('total');
				$created_at = date("Y-m-d H:i:s");
				//$expire_date = $this->request->getVar('expire_date');
				$expire_date = date("Y-m-d H:i:s", strtotime('+1 days'));
				$status_pembayaran = $this->request->getVar('status_pembayaran');
				$description = $this->request->getVar('description');

                $kode = "APSM" . date('dmY') . rand(100,999);
				
				if ($id_user != '' && $email_user != '' && $kode_paket != '' && $total != '')
				{
					$data = array(
                        'kode_pembayaran' => $kode,
                        'id_user' => $id_user,
                        'email_user' => $email_user,
                        'kode_paket' => $kode_paket,
                        'nama_paket' => $nama_paket,
						'harga_paket' => $harga_paket,
                        'disc_per' => $disc_per,
                        'disc_val' => $disc_val,
                        'langganan' => $langganan,
                        'total' => $total,
						'created_at' => $created_at,
                        'expire_date' => $expire_date,
						'status_pembayaran' => $status_pembayaran,
                        'description' => $description,
					);
					
					$payModel->insert($data);
			
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data has created',
						'data' => $data
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
	
	public function edit($kode = null) {
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
				$payModel = new PaymentModel();
				$data = $this->request->getRawInput();
				
				if ($data != '' && $kode != '')
				{
					$data = array(
						'status_pembayaran' => $data['status_pembayaran'],
						'number_code' => $data['number_code'],
						'pay_method' => $data['pay_method'],
                        'bank' => $data['bank'],
					);
					
					$payModel->update($kode, $data);
			
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Data has update',
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
	
	public function editlink($kode = null) {
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
				$payModel = new PaymentModel();
				$data = $this->request->getRawInput();
				
				if ($data != '' && $kode != '')
				{
					$data = array(
						'link_midtrans' => $data['link_midtrans']
					);
					
					$payModel->update($kode, $data);
			
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Link has update',
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
	
	public function getFilter()
	{
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
				$returnDat = array(
					array(
						'name' => 'Semua',
						'code' => '',
					),
					array(
						'name' => 'Telah Dibayar',
						'code' => 'settlement',
					),
					array(
						'name' => 'Menunggu Pembayaran',
						'code' => 'pending',
					),
					array(
						'name' => 'Expired',
						'code' => 'expire',
					),
				);
				
				if ($returnDat) {
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data Filter Pembayaran',
						'data' => $returnDat,
					];
					return $this->respondCreated($response);
				} 
				else {
					$response = [
						'status' => 401,
						'error' => TRUE,
						'messages' => 'Access denied'
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