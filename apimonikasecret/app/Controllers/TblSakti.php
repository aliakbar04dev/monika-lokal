<?php namespace App\Controllers;

use App\Models\TblSaktiModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class TblSakti extends BaseController
{
	use ResponseTrait;
	
	public function getByDate()
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
				$tblSaktiModel = new TblSaktiModel();
				$kode = $this->request->getGet("kode_jenis_tsakti");
                $stdate = $this->request->getGet("tgl_awal");
                $endate = $this->request->getGet("tgl_akhir");
				
				if ($kode != '') {
					$data = $tblSaktiModel->where("kode_jenis_tsakti", $kode)
                                          ->where("tanggal_input >=", $stdate)
                                          ->where("tanggal_input <=", $endate)
                                          ->orderBy("tanggal_input", 'DESC')
									      ->findAll();
									
					if (!empty($data))
					{
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Tabel Sakti',
							'data' => $data
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Data tidak ditemukan'
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Incorrect username or password'
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

	public function getByLimit()
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
				$tblSaktiModel = new TblSaktiModel();
				$kode = $this->request->getGet("kode_jenis_tsakti");
                $limit = $this->request->getGet("limit");
                $offset = $this->request->getGet("offset");
				
				if ($kode != '') {
					$data = $tblSaktiModel->where("kode_jenis_tsakti", $kode)
                                          ->orderBy("tanggal_input", 'DESC')
										  ->limit($limit, $offset)
									      ->find();
									
					if (!empty($data))
					{
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Tabel Sakti',
							'data' => $data
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Data tidak ditemukan'
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Incorrect username or password'
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