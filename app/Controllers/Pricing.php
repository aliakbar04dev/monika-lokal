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

	public function price()
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

		if (hassession('email')) {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$this->usr->upusrlvl(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);
				
				$data['usrlvl'] = $lvl;
				$data['ntf'] = $ntf;
				$data['npy'] = $npy;
				$data['cnt'] = $cnt;
				$data['lvl'] = $lvl;
				
				return view('pricing/view_price', $data);
			}
		} else {
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
			
			return view('pricing/view_pricing', $data);
		}
	}

	public function newprice($slug){
		if (hassession('email')) {
			return redirect()->to('/');
		}else{
			$data = array(
				'title'	=> 'Pricing',
			);

			switch ($slug) {
				case 'paket-ta':
					$data['kodePaket'] =  'HPKT002';
					$view_id = 1;
					break;
				case 'paket-fa':
					$data['kodePaket'] =  'HPKT003';
					$view_id = 2;
					break;
				case 'paket-ultimate':
					$data['kodePaket'] =  'HPKT004';
					$view_id = 3;
					break;
				default:
					$data['kodePaket'] =  'HPKT002';
					$view_id = 1;
					break;
			}

			return view('pricing/view_price_'.$view_id, $data);
		}
	}
}
