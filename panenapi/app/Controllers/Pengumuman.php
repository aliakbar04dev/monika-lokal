<?php namespace App\Controllers;

use App\Models\PengumumanModel;
use App\Models\KategoriPengumumanModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Pengumuman extends BaseController
{
	use ResponseTrait;

    function getCategoryNews(){
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
				$kategori = new KategoriPengumumanModel();

                $nofilter['semua'] = array(
                    '0'  => array(
                        "kode_kategori_pengumuman" => "SEMUA",
                        "nama_kategori_pengumuman" => "SEMUA",
                        "kode_jenis_pengumuman" => "SEMUA",
                    ),
                );

				$data = $kategori->orderBy('kode_kategori_pengumuman','ASC')
                                 ->where("kode_jenis_pengumuman", "JEPM001")
                                 ->find();
                
                $data = array_merge($nofilter['semua'], $data);
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Kategori Pengumuman',
                    'data' => $data,
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

    function getCategoryEvent(){
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
				$kategori = new KategoriPengumumanModel();

                $nofilter['semua'] = array(
                    '0'  => array(
                        "kode_kategori_pengumuman" => "SEMUA",
                        "nama_kategori_pengumuman" => "SEMUA",
                        "kode_jenis_pengumuman" => "SEMUA",
                    ),
                );

				$data = $kategori->orderBy('kode_kategori_pengumuman','ASC')
                                 ->where("kode_jenis_pengumuman", "JEPM002")
                                 ->find();
                
                $data = array_merge($nofilter['semua'], $data);
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Kategori Pengumuman',
                    'data' => $data,
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
	
	function getAllNews(){
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
				$pengumumanModel = new PengumumanModel();
                $keyword = $this->request->getGet("keyword");
                $limit = $this->request->getGet("limit");
                $offset = $this->request->getGet("offset");

                if (!empty($keyword))
                {
                    $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                            ->like("judul", $keyword, 'both')
                                          //  ->orLike("isi_pengumuman", $keyword, 'both')
                                            ->where("kode_jenis_pengumuman", "JEPM001")
                                            ->limit($limit, $offset)
                                            ->find();
                }
                else
                {
                    $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                            ->where("kode_jenis_pengumuman", "JEPM001")->findAll();
                }

                if (empty($data)) {
                    $response = [
                        'status' => 401,
                        'error' => TRUE,
                        'messages' => 'Data not found'
                    ];
                    return $this->respondCreated($response);
                }
						
				foreach ($data as $dt) {
					$datainfo[] = array(
						"kode_pengumuman" 			=> $dt['kode_pengumuman'],
						"kode_jenis_pengumuman"		=> $dt['kode_jenis_pengumuman'],
						"kode_kategori_pengumuman"	=> $dt['kode_kategori_pengumuman'],
						"tgl_pengumuman"			=> $dt['tgl_pengumuman'],
						"judul"						=> $dt['judul'],
						"isi_pengumuman"			=> $dt['isi_pengumuman'],
						"gambar"					=> 'https://monika.panensaham.com/backend/public/assets/img/news/' . $dt['gambar'],
					);
				}
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data News',
                    //'data' => $data
					'data' => $datainfo
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
	
	function getAllEvents(){
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
				$pengumumanModel = new PengumumanModel();
                $keyword = $this->request->getGet("keyword");
                $limit = $this->request->getGet("limit");
                $offset = $this->request->getGet("offset");

                if (!empty($keyword))
                {
                    $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                            ->like("judul", $keyword, 'both')
                                           // ->orLike("isi_pengumuman", $keyword, 'both')
                                            ->where("kode_jenis_pengumuman", "JEPM002")
                                            ->limit($limit, $offset)
                                            ->find();
                }
                else
                {
                    $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                            ->where("kode_jenis_pengumuman", "JEPM002")->findAll();
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
                    'messages' => 'Data Events',
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

    function getNewsByCategory(){
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
				$pengumumanModel = new PengumumanModel();
                $category = $this->request->getGet("kode_kategori");
                $limit = $this->request->getGet("limit");
                $offset = $this->request->getGet("offset");

                if ($category != "SEMUA")
                {
                    $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                            ->where("kode_kategori_pengumuman", $category)
                                            ->limit($limit, $offset)
                                            ->find();
                }
                else
                {
                    $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                            ->where("kode_jenis_pengumuman", "JEPM001")
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
				
				foreach ($data as $dt) {
					$datainfo[] = array(
						"kode_pengumuman" 			=> $dt['kode_pengumuman'],
						"kode_jenis_pengumuman"		=> $dt['kode_jenis_pengumuman'],
						"kode_kategori_pengumuman"	=> $dt['kode_kategori_pengumuman'],
						"tgl_pengumuman"			=> $dt['tgl_pengumuman'],
						"judul"						=> $dt['judul'],
						"isi_pengumuman"			=> $dt['isi_pengumuman'],
						"gambar"					=> 'https://monika.panensaham.com/backend/public/assets/img/news/' . $dt['gambar'],
					);
				}
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data News',
                    //'data' => $data
					'data' => $datainfo
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

    function getEventsByCategory(){
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
				$pengumumanModel = new PengumumanModel();
                $category = $this->request->getGet("kode_kategori");
                $limit = $this->request->getGet("limit");
                $offset = $this->request->getGet("offset");

                if ($category != "SEMUA")
                {
                    $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                            ->where("kode_kategori_pengumuman", $category)
                                            ->limit($limit, $offset)
                                            ->find();
                }
                else
                {
                    $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                            ->where("kode_jenis_pengumuman", "JEPM002")
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
                    'messages' => 'Data Events',
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

    function getDetailNewsEvent(){
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
				$pengumumanModel = new PengumumanModel();
                $kode = $this->request->getGet("kode_pengumuman");

                $data = $pengumumanModel->orderBy('tgl_pengumuman','DESC')
                                        ->where("kode_pengumuman", $kode)
                                        ->find();

                if (empty($data)) {
                    $response = [
                        'status' => 401,
                        'error' => TRUE,
                        'messages' => 'Data not found'
                    ];
                    return $this->respondCreated($response);
                }
				
				foreach ($data as $dt) {
					$datainfo[] = array(
						"kode_pengumuman" 			=> $dt['kode_pengumuman'],
						"kode_jenis_pengumuman"		=> $dt['kode_jenis_pengumuman'],
						"kode_kategori_pengumuman"	=> $dt['kode_kategori_pengumuman'],
						"tgl_pengumuman"			=> $dt['tgl_pengumuman'],
						"judul"						=> $dt['judul'],
						"isi_pengumuman"			=> $dt['isi_pengumuman'],
						"gambar"					=> 'https://monika.panensaham.com/backend/public/assets/img/news/' . $dt['gambar'],
					);
				}
					
				$response = [
					'status' => 200,
					'error' => FALSE,
					'messages' => 'Data News',
					//'data' => $data
					'data' => $datainfo
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