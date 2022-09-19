<?php

namespace App\Controllers;

use App\Models\PricingModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\NotificationModel;

// require_once 'public/assets/facebook-api-client/src/Facebook/autoload.php';

class Pricing extends BaseController
{

	public function __construct()
	{
		$this->pricingModel = new PricingModel();
		$this->usr = new UserModel();
		$this->ntf = new NotificationModel();
	}

	public function price($slug)
	{
		$paket = $this->pricingModel->findAll();
		$cek = array("MULV001", "MULV002");
		$faq = $this->pricingModel->getFaq();
		$disc = $this->pricingModel->getmemberdisc();

		$data = array(
			'title'	=> 'Pricing',
			'paket'	=> $paket,
			'cek'	=> $cek,
			'faq'	=> $faq,
			'disc'	=> $disc,
		);

		
		// $fb = new \Facebook\Facebook([
		// 	'app_id' => FB_APP_ID, // Replace {app-id} with your app id
		// 	'app_secret' => FB_APP_SECRET,
		// 	'default_graph_version' => 'v3.2',
		// ]);
			
		// $helper = $fb->getRedirectLoginHelper();
			
		$permissions = ['email']; // Optional permissions
		$callbackUrl = htmlspecialchars(base_url('facebookcalback'));
		// $loginUrl = $helper->getLoginUrl($callbackUrl);
			
		// $data['authURL'] =  $loginUrl;
		
		switch ($slug) {
			case 'paket-ta':
				$view_id = 1;
				break;
			case 'paket-fa':
				$view_id = 2;
				break;
			case 'paket-ultimate':
				$view_id = 3;
				break;
			
			default:
				$view_id = 1;
				break;
		}

		return view('pricing/view_price_'.$view_id, $data);
	}
}
