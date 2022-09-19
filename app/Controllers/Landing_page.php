<?php

namespace App\Controllers;

use App\Models\PricingModel;
use CodeIgniter\Controller;
use App\Models\PengumumanModel;
use App\Models\UserModel;
use App\Models\NotificationModel;
use CodeIgniter\HTTP\UserAgent;
use App\Models\VideoModel;
use App\Models\InformasibursaModel;


require_once 'public/assets/facebook-api-client/src/Facebook/autoload.php';

class Landing_page extends BaseController
{
	protected $pengumumanModel;
	public function __construct()
	{
		$this->pricingModel = new PricingModel();
		$this->pengumumanModel = new PengumumanModel();
		$this->usr = new UserModel();
		$this->ntf = new NotificationModel();
		$this->videoModel = new VideoModel();
		$this->bursaoModel = new InformasibursaModel();
		$this->db = db_connect();
		$this->dbmonikasecret = \Config\Database::connect("tests");
	}

	public function index() {
		$data = array(
			'title' => 'Home'
		);

		if (!hassession('email')) {
			if (!session_id()) {
				session_start();
			}
			
			$fb = new \Facebook\Facebook([
                'app_id' => FB_APP_ID, // Replace {app-id} with your app id
                'app_secret' => FB_APP_SECRET,
                'default_graph_version' => 'v11.0',
            ]);
              
            $helper = $fb->getRedirectLoginHelper();
              
            $permissions = ['email']; // Optional permissions
            $callbackUrl = htmlspecialchars(base_url('facebookcalback'));
            $loginUrl = $helper->getLoginUrl($callbackUrl,$permissions);
              
            $data['authURL'] =  $loginUrl;
			
			$paket = $this->pricingModel->findAll();
			$data['paket'] = $paket;

			if (getsession('aktivasi') != '') {
				$data['aktiv'] = true;

				$this->session->remove('aktivasi');
			}

			if (getsession('fb_failed_account') != '') {
				$data['fb_failed_account'] = true;

				$this->session->remove('fb_failed_account');
			}

			if (getsession('fb_failed_email') != '') {
				$data['fb_failed_email'] = true;

				$this->session->remove('fb_failed_email');
			}

			if(getsession('otpberhasil') != ''){
				$data['otpberhasil'] = true;

				$this->session->remove('otpberhasil');
			}

			$this->session->remove('viapembelian');

			$agent = $this->request->getUserAgent();
			$data['buatHP'] = $agent->isMobile();
			// echo json_encode($data['buatHP']); die;

			return view('/landingpage/view_landing_page', $data);
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$searchNews = $this->request->getGet('searchNews', FILTER_SANITIZE_STRING);

				$this->usr->upusrlvl(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);

				$agent = $this->request->getUserAgent();
				$news = $this->pengumumanModel->getNews3($searchNews);
                $keterbukaaninformasis = $this->bursaoModel->getBursaDataSearchTextBeranda($searchNews);
                $banner = $this->pengumumanModel->getBanner();
                $pager = $this->pengumumanModel->pager;

				$videoapps = $this->videoModel->getVideo3('Tutorial PanenSaham Apps');
				$pagerVideo = $this->videoModel->pager;

                $kode_user = getsession('kode_user');

				$dataResult = $this->dbmonikasecret->query("SELECT a.id, a.kode_user, b.code, b.timeframe, b.lastupdate, b.close, b.dsl, b.pivot_r2, b.sig_dsl, b.prev_sig_dsl, b.chg  
                                FROM trx_smartwatchlist a 
                                LEFT JOIN data_pasar b ON a.code=b.code AND a.timeframe=b.timeframe 
                                WHERE kode_user='$kode_user'
                                ORDER BY a.id DESC, b.lastupdate DESC")->getResultArray();
                $dataCount = $this->dbmonikasecret->query("SELECT COUNT(id) AS jumlah FROM trx_smartwatchlist WHERE kode_user='$kode_user'")->getRowArray();
                $jumlah = $dataCount['jumlah'];


				$data = array(
					'title'   => 'Pengumuman',
					'news' => $news,
					'pagerVideo'     => $pagerVideo,
					'video_apps' => $videoapps,
					'banner' => $banner,
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
					'pager'     => $pager,
                    'sNws'      => $searchNews,
					'buatHP'      => $agent->isMobile(),
					'keterbukaaninformasis' => $keterbukaaninformasis,
					'dataResult' => $dataResult, 
                    'jumlah'     => $jumlah,
				);

                return view('landingpage/view_landing_pagetes', $data);
			}
		}
	}


	public function tes(){
		if (!hassession('email')) {
            return redirect()->to('/');
        } else {
            if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
			    $this->session->destroy();
			    return redirect()->to('/');
			}else{
                $searchNews = $this->request->getGet('searchNews', FILTER_SANITIZE_STRING);
                
                $this->usr->upusrlvl(getsession('email'));
                $lvl    = $this->usr->getuserlvl(getsession('email'));
                $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt    = $this->ntf->getcount($ntf, $npy);

                $news = $this->pengumumanModel->getNews3($searchNews);
                $keterbukaaninformasis = $this->bursaoModel->getBursaDataSearchTextBeranda($searchNews);
                $banner = $this->pengumumanModel->getBanner();
                $pager = $this->pengumumanModel->pager;

				$videoapps = $this->videoModel->getVideo3('Tutorial PanenSaham Apps');
				$pagerVideo = $this->videoModel->pager;

                $kode_user = getsession('kode_user');

				$dataResult = $this->dbmonikasecret->query("SELECT a.id, a.kode_user, b.code, b.timeframe, b.lastupdate, b.close, b.dsl, b.pivot_r2, b.sig_dsl, b.prev_sig_dsl  
                                FROM trx_smartwatchlist a 
                                LEFT JOIN data_pasar b ON a.code=b.code AND a.timeframe=b.timeframe 
                                WHERE kode_user='$kode_user'
                                ORDER BY a.id DESC, b.lastupdate DESC")->getResultArray();
                $dataCount = $this->dbmonikasecret->query("SELECT COUNT(id) AS jumlah FROM trx_smartwatchlist WHERE kode_user='$kode_user'")->getRowArray();
                $jumlah = $dataCount['jumlah'];

                // echo json_encode($keterbukaaninformasis); die;

                $data = array(
                    'title'   => 'Pengumuman',
                    'news' => $news,
                    'keterbukaaninformasis' => $keterbukaaninformasis,
                    'banner' => $banner,
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'pager'     => $pager,
					'pagerVideo'     => $pagerVideo,
					'video_apps' => $videoapps,
                    'sNws'      => $searchNews, 
					'dataResult' => $dataResult, 
                    'jumlah'     => $jumlah,
                );

                return view('landingpage/view_landing_pagetes', $data);
            }
        }
	}

	public function tampil(){
		$data = $this->db->query("SELECT * FROM factsheet")->getResultArray();
		echo json_encode($data);
	}
}

?>