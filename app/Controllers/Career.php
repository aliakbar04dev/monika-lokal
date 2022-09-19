<?php

namespace App\Controllers;

use App\Models\RegisModel;
use App\Models\RefModel;
use App\Models\LokasiModel;
use App\Models\DepartmntModel;
use App\Models\KategoriModel;
use App\Models\KarirModel;
use CodeIgniter\Controller;
use App\Models\PelamarModel;
use App\Models\TestimonikModel;

require_once 'public/assets/facebook-api-client/src/Facebook/autoload.php';

class Career extends BaseController
{
    protected $regisModel;
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->regisModel = new RegisModel();
        $this->lokasiModel = new LokasiModel();
        $this->departmntModel = new DepartmntModel();
        $this->kategoriModel = new KategoriModel();
        $this->karirModel = new KarirModel();
        $this->ref = new RefModel();
		$this->pelamarModel = new PelamarModel();
		$this->testimonikModel = new TestimonikModel();
    }

    public function index()
    {
        $lokasi = $this->lokasiModel->findAll();
        $depart = $this->departmntModel->findAll();
        $kategori = $this->kategoriModel->findAll();
        $karir = $this->karirModel->getKarirList();
		$testi = $this->testimonikModel->where('publish',1)->findAll();

		$db = \Config\Database::connect();

		$tables = $db->listTables();

        $data = array(
            'title' => 'Carrer',
            'lokasi' => $lokasi,
            'depart' => $depart,
            'kategori' => $kategori,
            'karir' => $karir,
			'testi'	=> $testi,
			'table' => $tables,
        );

        if (!hassession('email')) {
            $fb = new \Facebook\Facebook([
                'app_id' => FB_APP_ID, // Replace {app-id} with your app id
                'app_secret' => FB_APP_SECRET,
                'default_graph_version' => 'v3.2',
            ]);
              
            $helper = $fb->getRedirectLoginHelper();
              
            $permissions = ['email']; // Optional permissions
            $callbackUrl = htmlspecialchars(base_url('facebookcalback'));
            $loginUrl = $helper->getLoginUrl($callbackUrl);
              
            $data['authURL'] =  $loginUrl;

            return view('career/career', $data);
        } else {
            return redirect()->to('/');
        }
    }
	
    public function detail($id)
    {
        $data = array(
            'title' => 'Detail Karir'
        );
		
        if (!hassession('email')) {
			
			$detail = $this->karirModel->getSatukarirdetail($id);
			
			if (!is_null($detail) && count($detail) > 0) {
				$fb = new \Facebook\Facebook([
					'app_id' => FB_APP_ID, // Replace {app-id} with your app id
					'app_secret' => FB_APP_SECRET,
					'default_graph_version' => 'v3.2',
				]);
				  
				$helper = $fb->getRedirectLoginHelper();
				  
				$permissions = ['email']; // Optional permissions
				$callbackUrl = htmlspecialchars(base_url('facebookcalback'));
				$loginUrl = $helper->getLoginUrl($callbackUrl);
				
				$data['authURL'] =  $loginUrl;
				$data['detail'] = $detail;
				
				return view('career/career_detail', $data);
			}else{
				return redirect()->to('/');
			}
        } else {
            return redirect()->to('/');
        }
    }
	
	public function karirsubmitform(){
		if ($this->request->isAJAX()) {
			if (hassession('email')) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Failed to Submit',
					'description'	=> 'Silahkan Refresh Page to Continue'
				]);
			}else{
				if ($_FILES['file_karir']['error'] > 0) {
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Image not uploaded',
						'description'	=> "There's a problem with upload service, please try again. Error Code : 001"
					]);
				}else{
					$calling_code 	= $this->request->getPost('calling_code', FILTER_SANITIZE_STRING);
					
					if($calling_code != ''){
						$id_pelamar	= '';
						$idkarir	= $this->request->getPost('idkarir', FILTER_SANITIZE_STRING);
						$phone 		= $this->request->getPost('phone', FILTER_SANITIZE_STRING);
						$emailkarir = $this->request->getPost('emailkarir', FILTER_SANITIZE_STRING);
						$firstname 	= $this->request->getPost('firstname', FILTER_SANITIZE_STRING);
						$lastname 	= $this->request->getPost('lastname', FILTER_SANITIZE_STRING);
						$filename 	= $_FILES['file_karir']['name'];
						$filesize 	= $_FILES['file_karir']['size'];
						$ext 		= pathinfo($filename, PATHINFO_EXTENSION);
						$tmp 		= $_FILES['file_karir']['tmp_name'];
						$path 		= './public/assets/karirfile/';
						$namefile	= strtolower($firstname.'-'.$lastname.'-'.$emailkarir);
						
						if (!is_dir($path)) {
							mkdir($path);
						}

						if(!in_array($ext, array("pdf", "doc", "docx", "rar"))){
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Invalid Format',
								'description'	=> 'Supported Format : pdf, docx, rar'
							]);	
						}

						if($filesize > 50000000){
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Maksimum file size limit reached',
								'description'	=> 'Maksimum File Size is 50 MB',
								'size'			=> $filesize
							]);
						}
						
						if (move_uploaded_file($tmp, $path . $namefile . '.' . $ext)) {
							$realpath = '/public/assets/karirfile/' . $namefile . '.' . $ext;
							
							do {
								$prefix 	= 'TPEL';
								$get		= $this->pelamarModel->select('id_pelamar, CAST(SUBSTR(id_pelamar FROM 5) AS SIGNED) as kode')->orderBy('kode', "desc")->first();

								if (!is_null($get) && count($get) > 0) {
									$int 		= str_pad(filter_var($get['id_pelamar'], FILTER_SANITIZE_NUMBER_INT) + 1, 3, "0", STR_PAD_LEFT);
									$id_pelamar	= $prefix . $int;
								} else {
									$int = '001';
									$id_pelamar	= $prefix . $int;
								}

								$data = [
									'id_pelamar'	=> $id_pelamar,
									'email'			=> $emailkarir,
								];

								$this->pelamarModel->insert($data);
								$insert = $this->pelamarModel->affectedRows();

								if ($insert > 0) {
									$masuk = false;
								}
							} while ($masuk);
							
							$data = [
								'nama_pelamar'	=> $firstname.' '.$lastname,
								'no_hp'			=> $calling_code.$phone,
								'dokumen'		=> $realpath,
								'id_karir'		=> $idkarir,
								'create_at'		=> date('Y-m-m H:i:s'),
							];
							
							$this->pelamarModel->update($id_pelamar, $data);
							$insert = $this->pelamarModel->affectedRows();

							if ($insert > 0) {
								return json_encode([
									'success'		=> $insert,
									'reason'		=> 'Register Berhasil',
									'description'	=> 'Silahkan tunggu konfirmasi dari kami'
								]);
							}else{
								return json_encode([
									'success'		=> $insert,
									'reason'		=> 'Register Failed',
									'description'	=> 'Please Contact Administrator'
								]);
							}
						}else{
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'File not uploaded',
								'description'	=> "Please upload your file"
							]);
						}
					}else{
						return json_encode([
							'success'		=> 0,
							'reason'		=> "Country Number not selected"
						]);
					}
				}
			}
		}
	}
	
    public function list()
    {
        $data = array(
            'title' => 'List'
        );

        if (!hassession('email')) {
            $karir = $this->karirModel->findAll();
            $data['karir'] =  $karir;

            $fb = new \Facebook\Facebook([
                'app_id' => FB_APP_ID, // Replace {app-id} with your app id
                'app_secret' => FB_APP_SECRET,
                'default_graph_version' => 'v3.2',
            ]);
              
            $helper = $fb->getRedirectLoginHelper();
              
            $permissions = ['email']; // Optional permissions
            $callbackUrl = htmlspecialchars(base_url('facebookcalback'));
            $loginUrl = $helper->getLoginUrl($callbackUrl);
              
            $data['authURL'] =  $loginUrl;
            
            return view('career/career_list', $data);
        } else {
            return redirect()->to('/');
        }
    }
}
