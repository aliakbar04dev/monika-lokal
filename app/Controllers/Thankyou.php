<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Models\PembayaranModel;

require_once 'public/assets/facebook-api-client/src/Facebook/autoload.php';

class Thankyou extends BaseController
{

	public function __construct()
	{
		$this->UserModel = new UserModel();
		$this->ntf = new NotificationModel();
		$this->bill = new PembayaranModel();
	}

	public function index($kodepaket)
	{
		if($kodepaket != ''){
			if (hassession('email')) {
				if($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))){
					$this->session->destroy();
					return redirect()->to('/');
				}else{
					$bill    = $this->bill->getdetailbiling(getsession('email'), $kodepaket);
					$user	= $this->UserModel->getdetailuser(getsession('email'));
					$lvl    = $this->UserModel->getuserlvl(getsession('email'));
					$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
					$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
					$cnt    = $this->ntf->getcount($ntf, $npy);

					if (!is_null($bill) && count($bill) > 0 && $bill['pay_method'] != '') {
						$this->UserModel->upusrlvl(getsession('email'));

						$data = array(
							'title' => 'Thanks',
							'login'	=> 'Yes',
							'bill'	=> $bill,
							'user'	=> $user,
							'ntf'    => $ntf,
							'npy'    => $npy,
							'cnt'    => $cnt,
							'lvl'    => $lvl,
						);

						return view('thanks/view_thanks', $data);
					}else{
						return redirect()->to('/');
					}
				}
			} else if (hassession('loginpembelian')) {
				$bill	= $this->bill->getdetailbiling(getsession('pembemail'), $kodepaket);
				$user	= $this->UserModel->getdetailuser(getsession('pembemail'));

				if (!is_null($bill) && count($bill) > 0) {
					$data = array(
						'title' => 'Thanks',
						'login'	=> 'No',
						'bill'	=> $bill,
						'user'	=> $user,
					);

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

					return view('thanks/view_thanks', $data);
				}else{
					return redirect()->to('/');
				}
			}else{
				return redirect()->to('/');	
			}
		}else{
			return redirect()->to('/');
		}
	}

	//--------------------------------------------------------------------

}
