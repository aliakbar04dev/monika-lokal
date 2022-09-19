<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;

class Profile extends BaseController
{

	public function __construct()
	{
		$this->UserModel = new UserModel();
		$this->ntf = new NotificationModel();
	}

	public function index()
	{
		if (hassession('email')) {
			if($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$this->UserModel->upusrlvl(getsession('email'));
				$usr 	= $this->UserModel->getdetailuser(getsession('email'));
				$lvl	= $this->UserModel->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);

				$data = array(
					'title' => 'Profile',
					'd'		=> $usr,
					'ntf'	=> $ntf,
					'npy'    => $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
				);
				return view('profile/view_profile', $data);
			}
		} else {
			return redirect()->to('/');
		}
	}

	//--------------------------------------------------------------------

}
