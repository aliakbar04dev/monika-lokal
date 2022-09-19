<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Models\EmitenipoModel;
use CodeIgniter\Controller;

class Emitenipo extends BaseController {

    public function __construct() {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->model = new EmitenipoModel();
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

                $searchEmitenipo = $this->request->getGet('searchEmitenipo', FILTER_SANITIZE_STRING);

                $EmitenIpos = $this->model->getIpoDataSearchText($searchEmitenipo);
                $pager = $this->model->pager;

                $kategoriIB = $this->db->query("SELECT * FROM kategori_pengumuman WHERE kode_jenis_pengumuman='JEPM004'")->getResultArray();
                $nm_kode = ' ';

                // var_dump($searchTagsBursa);

                $data = [
                    'title' => 'Bedah Emiten IPO',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'ipos'	=> $EmitenIpos,
                    'pager'     => $pager,
                    'sEmIpo'      => $searchEmitenipo, 
                    'nm_kode'     => $nm_kode,
                    'lvl'	=> $lvl,
                    'kategoriIB'	=> $kategoriIB,
                ];
                return view('emitenipo/emitenipo_view', $data);
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

                $searchEmitenipo = $this->request->getGet('searchEmitenipo', FILTER_SANITIZE_STRING);

                $kategoriIB = $this->db->query("SELECT * FROM kategori_pengumuman WHERE kode_jenis_pengumuman='JEPM004'")->getResultArray();

                if ($searchEmitenipo) {
                    $query3 = $this->model->getIpoDataSearchText($searchEmitenipo);
                    $pager = $this->model->pager;
                } else {
                    $query3 = $this->model->getDataBursa($nm_kode);
                    $pager = $this->model->pager;
                }

                // var_dump($query2); die;

                $data = [
                    'title' => 'Bedah Emiten IPO',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'ipos'	=> $query3,
                    'pager'     => $pager,
                    'nm_kode'     => $nm_kode,
                    'sEmIpo'      => $searchEmitenipo, 
                    'lvl'	=> $lvl,
                    'kategoriIB'	=> $kategoriIB,
                ];
                return view('emitenipo/emitenipo_view', $data);
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

                $bursaEmiten = $this->model->getBEDetail($kode);
                $query3 = $this->model->getBEDetailAll();
                $pager = $this->model->pager;

                // var_dump($query3); die; 

                $data = [
                    'title' => 'Bedah Emiten IPO',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'news'	=> $bursaEmiten,
                    'lvl'	=> $lvl,
                    'ipos'	=> $query3,
                    'pager'     => $pager,
                ];
                return view('emitenipo/emitenipo_view_detail', $data);
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

                $bursaEmiten = $this->model->getBEDetail($kode);
                $query3 = $this->model->getBEDetailAll();
                $pager = $this->model->pager;

                // var_dump($query3); die; 

                $data = [
                    'title' => 'Bedah Emiten IPO',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'news'	=> $bursaEmiten,
                    'lvl'	=> $lvl,
                    'ipos'	=> $query3,
                    'pager'     => $pager,
                ];
                return view('emitenipo/emitenipo_view_pdf', $data);
			}
		}
    }


}
