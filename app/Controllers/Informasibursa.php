<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Models\InformasibursaModel;
use CodeIgniter\Controller;

class Informasibursa extends BaseController {

    public function __construct() {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->model = new InformasibursaModel();
        $this->db = db_connect();
    }

    public function index(){
        if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                $this->usr->upusrlvl(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));
                $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt	= $this->ntf->getcount($ntf, $npy);

                $searchInformasibursa = $this->request->getGet('searchInformasibursa', FILTER_SANITIZE_STRING);

                $InformasiBursas = $this->model->getBursaDataSearchText($searchInformasibursa);
                $pager = $this->model->pager;

                $kategoriIB = $this->db->query("SELECT * FROM kategori_pengumuman WHERE kode_jenis_pengumuman='JEPM003'")->getResultArray();
                
                $nm_kode = ' ';

                // var_dump($kategoriIB); die;

                $data = [
                    'title' => 'Informasi Bursa',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'bursas'	=> $InformasiBursas,
                    'pager'     => $pager,
                    'nm_kode'     => $nm_kode,
                    'sInbur'      => $searchInformasibursa, 
                    'lvl'	=> $lvl,
                    'kategoriIB'	=> $kategoriIB,
                ];
                return view('informasibursa/informasibursa_view', $data);
			}
		}
    }


    public function tags($nm_kode){
        if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                $this->usr->upusrlvl(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));
                $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt	= $this->ntf->getcount($ntf, $npy);

                $searchInformasibursa = $this->request->getGet('searchInformasibursa', FILTER_SANITIZE_STRING);

                $kategoriIB = $this->db->query("SELECT * FROM kategori_pengumuman WHERE kode_jenis_pengumuman='JEPM003'")->getResultArray();
                
                if ($searchInformasibursa) {
                    $query2 = $this->model->getBursaDataSearchText($searchInformasibursa);
                    $pager = $this->model->pager;
                } else {
                    $query2 = $this->model->getDataBursa($nm_kode);
                    $pager = $this->model->pager;
                }
                
                // echo json_encode($query2); die;

                $data = [
                    'title' => 'Informasi Bursa',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'bursas'	=> $query2,
                    'pager'     => $pager,
                    'nm_kode'     => $nm_kode,
                    'sInbur'      => $searchInformasibursa, 
                    'lvl'	=> $lvl,
                    'kategoriIB'	=> $kategoriIB,
                ];
                return view('informasibursa/informasibursa_view', $data);
			}
		}
    }

    public function detail($kode){
        if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                $this->usr->upusrlvl(getsession('email'));
                $lvl	= $this->usr->getuserlvl(getsession('email'));
                $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt	= $this->ntf->getcount($ntf, $npy);

                $InformasiBursa = $this->model->getInformasiBursaDetail($kode);
                $query3 = $this->model->getInformasiBursaDetailAll();
                $pager = $this->model->pager;

                // var_dump($query3); die; 

                $data = [
                    'title' => 'Informasi Bursa',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'news'	=> $InformasiBursa,
                    'lvl'	=> $lvl,
                    'ipos'	=> $query3,
                    'pager'     => $pager,
                ];
                return view('informasibursa/informasibursa_view_detail', $data);
			}
		}
    }

    public function pdf($kode){
        if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                $this->usr->upusrlvl(getsession('email'));
                $lvl	= $this->usr->getuserlvl(getsession('email'));
                $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt	= $this->ntf->getcount($ntf, $npy);

                $InformasiBursa = $this->model->getInformasiBursaDetail($kode);
                $query3 = $this->model->getInformasiBursaDetailAll();
                $pager = $this->model->pager;

                // var_dump($query3); die; 

                $data = [
                    'title' => 'Informasi Bursa',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'news'	=> $InformasiBursa,
                    'lvl'	=> $lvl,
                    'ipos'	=> $query3,
                    'pager'     => $pager,
                ];
                return view('informasibursa/informasibursa_view_pdf', $data);
			}
		}
    }


}
