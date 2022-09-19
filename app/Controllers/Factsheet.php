<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\FactsheetwebModel;
use App\Models\CopyactModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;

class Factsheet extends BaseController
{
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->modelFactsheet = new FactsheetwebModel();
    }

    public function index()
    {
      
    }

    public function web()
    {
        // echo json_encode(hassession('email')); die;

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

                $model = new FactsheetwebModel();
                $copy = new CopyactModel();
                $data = [
                    'title' => 'Performa Copy Trade',
                    'all_data' => $model->where("is_active", 1)
                                        ->orderBy('tahun DESC')
                                        ->orderBy('bulan DESC')
                                        ->paginate(5, 'btaction'),
                                        //  ->find(),
                    'pager' => $model->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'lvl'	=> $lvl
                ];
                return view('factsheet/factsheet_web_template', $data);
			}
		}
    }

    public function periode()
    {
        // echo json_encode(hassession('email')); die;

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

                $tahun = $this->request->getVar('factsheet_tahun');

                $model = new FactsheetwebModel();
                $data = [
                    'title' => 'Open Position',
                    'all_data' => $model->where("tahun", $tahun)
                                        ->orderBy('tahun DESC')
                                        ->orderBy('bulan DESC')
                                        ->paginate(10, 'btaction'),
                                        //  ->find(),
                    'pager' => $model->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'lvl'	=> $lvl
                ];
                return view('factsheet/factsheet_web_template', $data);
			}
		}
    }
}
