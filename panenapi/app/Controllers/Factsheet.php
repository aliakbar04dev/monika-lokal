<?php namespace App\Controllers;

use App\Models\FactsheetModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Factsheet extends BaseController
{
	use ResponseTrait;
	
	public function getByYear()
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
				$factsheetModel = new FactsheetModel();
				$tahun = $this->request->getGet("tahun");
				
				if ($tahun != '') {
					$data = $factsheetModel->where("tahun", $tahun)
                                          ->where("is_active", 1)
                                          ->orderBy("tahun", 'DESC')
										  ->orderBy("bulan", 'DESC')
									      ->findAll();
										  
					foreach ($data as $dt) {
						$datainfo[] = array(
							"kode_factsheet" 			=> $dt['kode_factsheet'],
							"title"						=> 'MONIKA Copy Trade' . ' ' . substr($dt['bulan'], 2) . ' ' . $dt['tahun'],
							"berkas"					=> 'https://monika.panensaham.com/backend/public/assets/img/factsheet/' . $dt['berkas'],
						);
					}
									
					if (!empty($data))
					{
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Factsheet',
							'data' => $datainfo,
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

	/*public function getByLimit()
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
    }*/
}