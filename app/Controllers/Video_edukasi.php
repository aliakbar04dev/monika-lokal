<?php

namespace App\Controllers;

use App\Models\VideoModel;
use App\Models\NotificationModel;
use App\Models\UserModel;

class Video_edukasi extends BaseController
{
	protected $videoModel;

	public function __construct()
	{
		$this->videoModel = new VideoModel();
		$this->ntf = new NotificationModel();
		$this->usr = new UserModel();
	}

	public function index()
	{
		if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$this->usr->upusrlvl(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));

				$videoutama = $this->videoModel->getVideo('Video Utama');
				$videorekomendasi = $this->videoModel->getVideo('Rekomendasi Video');
				$videoapps = $this->videoModel->getVideo('Tutorial PanenSaham Apps');

				$lvl	= $this->usr->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);

				$data = array(
					'title'    => 'Video Edukasi',
					'video_utama' => $videoutama,
					'video_rekomendasi' => $videorekomendasi,
					'video_apps' => $videoapps,
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
				);
				return view('video_edukasi/view_video_edukasi', $data);
			}
		}
	}
	//--------------------------------------------------------------------

}
