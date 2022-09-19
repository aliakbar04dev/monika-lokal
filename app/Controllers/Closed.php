<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CloseModel;
use App\Models\CopyactModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;

class Closed extends BaseController
{
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
    }

    public function index()
    {
        if (!hassession('email')) {
            $model = new CloseModel();
            $copy = new CopyactModel();
            $data = [
                'title' => 'Closed Position',
                'all_data' => $model->where("is_active", 1)
                                    ->orderBy("kode_closepos", 'ASC')
                                    ->find(),
                'content' => $copy->where("is_active", 1)
                                    ->where("alias", "Closed Position")
                                    ->orderBy("kode_copyact", 'ASC')
                                    ->find(),
            ];

            return view('closed/closed_view', $data);
        } else {
            return redirect()->to('/');
        }
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

                $model = new CloseModel();
                $copy = new CopyactModel();
                $data = [
                    'title' => 'Closed Position',
                    'all_data' => $model->where("is_active", 1)
                                    ->orderBy("sell_date", 'DESC')
                                    ->paginate(10, 'btaction'),
                                    //->find(),
                    'content' => $copy->where("is_active", 1)
                                        ->where("alias", "Closed Position")
                                        ->orderBy("kode_copyact", 'ASC')
                                        ->find(),
                    'pager' => $model->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'lvl'	=> $lvl
                ];
                return view('closed/closed_web_template', $data);
			}
		}
    }
}
