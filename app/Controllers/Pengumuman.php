<?php

namespace App\Controllers;

use App\Models\PricingModel;
use App\Models\PengumumanModel;
use App\Models\NotificationModel;
use App\Models\UserModel;
use App\Models\VideoModel;
use App\Models\InformasibursaModel;

class Pengumuman extends BaseController
{
    protected $pengumumanModel;

    public function __construct()
    {
        $this->pricingModel = new PricingModel();
        $this->pengumumanModel = new PengumumanModel();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->videoModel = new VideoModel();
		$this->bursaoModel = new InformasibursaModel();
		$this->db = db_connect();
		$this->dbmonikasecret = \Config\Database::connect("tests");
    }

    // public function index(){
    //     if (!hassession('email')) {
    //         return redirect()->to('/');
    //     } else {
    //         if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
	// 		    $this->session->destroy();
	// 		    return redirect()->to('/');
	// 		}else{
    //             $searchNews = $this->request->getGet('searchNews', FILTER_SANITIZE_STRING);
                
    //             $this->usr->upusrlvl(getsession('email'));
    //             $lvl    = $this->usr->getuserlvl(getsession('email'));
    //             $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
    //             $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
    //             $cnt    = $this->ntf->getcount($ntf, $npy);

    //             $news = $this->pengumumanModel->getNews($searchNews);
    //             $event = $this->pengumumanModel->getData('Events');
    //             $banner = $this->pengumumanModel->getBanner();
    //             $pager = $this->pengumumanModel->pager;
    //             //dd($pengumuman);

    //             $data = array(
    //                 'title'   => 'Pengumuman',
    //                 'news' => $news,
    //                 'event' => $event,
    //                 'banner' => $banner,
    //                 'ntf'    => $ntf,
    //                 'npy'    => $npy,
    //                 'cnt'    => $cnt,
    //                 'lvl'    => $lvl,
    //                 'pager'     => $pager,
    //                 'sNws'      => $searchNews, 
    //             );

    //             return view('pengumuman/view_pengumuman', $data);

    //         }
    //     }
    // }

    public function index(){
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

				$dataResult = $this->dbmonikasecret->query("SELECT a.id, a.kode_user, b.code, b.timeframe, b.lastupdate, b.close, b.dsl, b.pivot_r2, b.sig_dsl, b.prev_sig_dsl, b.chg  
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
}
