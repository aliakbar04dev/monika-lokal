<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Models\NewsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\UserAgent;

class News extends BaseController {

    public function __construct() {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->model = new NewsModel();
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

                $searchNews = $this->request->getGet('searchNews', FILTER_SANITIZE_STRING);

                $Newss = $this->model->getNewsSearchText($searchNews);
                $pager = $this->model->pager;

                $kategoriIB = $this->db->query("SELECT * FROM kategori_pengumuman WHERE kode_jenis_pengumuman='JEPM001'")->getResultArray();
                $nm_kode = ' ';

                $agent = $this->request->getUserAgent();

                // var_dump($searchTagsBursa);

                $data = [
                    'title' => 'News',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'ipos'	=> $Newss,
                    'pager'     => $pager,
                    'buatHP'     => $agent->isMobile(),
                    'valueSearchNews'      => $searchNews, 
                    'nm_kode'     => $nm_kode,
                    'lvl'	=> $lvl,
                    'kategoriIB'	=> $kategoriIB,
                ];
                return view('news/news_view', $data);
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

                $searchNews = $this->request->getGet('searchNews', FILTER_SANITIZE_STRING);

                $kategoriIB = $this->db->query("SELECT * FROM kategori_pengumuman WHERE kode_jenis_pengumuman='JEPM001'")->getResultArray();

                if ($searchNews) {
                    $query3 = $this->model->getNewsSearchText($searchNews);
                    $pager = $this->model->pager;
                } else {
                    $query3 = $this->model->getDataBursa($nm_kode);
                    $pager = $this->model->pager;
                }

                // var_dump($query2); die;

                $data = [
                    'title' => 'News',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'ipos'	=> $query3,
                    'pager'     => $pager,
                    'nm_kode'     => $nm_kode,
                    'valueSearchNews'      => $searchNews, 
                    'lvl'	=> $lvl,
                    'kategoriIB'	=> $kategoriIB,
                ];
                return view('news/news_view', $data);
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

                $news = $this->model->getNewsDetail($kode);
                $query3 = $this->model->getNewsDetailAll();
                $pager = $this->model->pager;

                // var_dump($query3); die; 

                $data = [
                    'title' => 'News',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'news'	=> $news,
                    'lvl'	=> $lvl,
                    'ipos'	=> $query3,
                    'pager'     => $pager,
                ];
                return view('news/news_view_detail', $data);
			}
		}
    }


}
