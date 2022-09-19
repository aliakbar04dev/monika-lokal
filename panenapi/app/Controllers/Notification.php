<?php namespace App\Controllers;

use App\Models\NotificationModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Notification extends BaseController
{
	use ResponseTrait;
	
	function getAllBroadcast(){
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
				$notifModel = new NotificationModel();

				$data = $notifModel->where("is_broadcast", 1)->orderBy("id_notif", "DESC")->findAll();
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Notification Broadcast',
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

    function getRecentBroadcast(){
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
				$notifModel = new NotificationModel();

				$data = $notifModel->where("is_broadcast", 1)->limit(50)->orderBy("id_notif", "DESC")->find();
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Notification Broadcast',
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

    function getPaymentNotif(){
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
				$notifModel = new NotificationModel();
                $email  = $this->request->getGet("email_user");

				$data = $notifModel->where("email_user", $email)->orderBy("id_notif", "DESC")->find();
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Notification Payment',
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
				$notifModel = new NotificationModel();
                date_default_timezone_set("Asia/Jakarta");
				
				$kode_pembayaran = $this->request->getVar('kode_pembayaran');
                $email= $this->request->getVar('email');
                $status = $this->request->getVar('status');

                $kode = "NTF-" . time() . date('hms');

                if ($status == "success")
                {
                    $judul = "Pembayaran dengan nomor : " . $kode_pembayaran . " telah berhasil!!";
                }
                else
                {
                    $judul = "Pembayaran dengan nomor : " . $kode_pembayaran . " dalam status " . $status . "!!";
                }

                if ($status == "success")
                {
                    $desc = "Terimakasih telah mempercayai Monika sebagai platform saham anda!!, Selamat menikmati berbagai fitur dari kami.";
                }
                else if ($status == "expired")
                {
                    $desc = "Invoice telah expired";
                }
                else
                {
                    $desc = "Pembayaran anda dengan nomor : " . $kode_pembayaran . " dalam status pending, silahkan lakukan pembayaran.";
                }
				
				if ($kode_pembayaran != '' && $email != '' && $status != '')
				{
					$data = array(
                        'kode_notif' => $kode,
                        'email_user' => $email,
                        'tittle' => $judul,
                        'description' => $desc,
                        'is_broadcast' => 0,
					);
					
					$notifModel->insert($data);
			
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