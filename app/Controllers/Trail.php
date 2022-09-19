<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TrailingModel;
use App\Models\TrailingCloseModel;
use App\Models\TrailingactModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;

class Trail extends BaseController
{
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (!hassession('email')) {
            $model1 = new TrailingModel();
            $model = new TrailingactModel();
            $data = [
                'all_data' => $model1->where("is_active", 1)
                                    ->orderBy("buy_date", 'DESC')
                                    ->find(),
                'content' => $model->where("is_active", 1)
                                    ->orderBy("kode_trailingact", 'ASC')
                                    ->find()
            ];

            // dd($data);
            return view('trail/view_trail', $data);
        } else {
            return redirect()->to('/');
        }
    }
	
	public function close()
    {
        if (!hassession('email')) {
            $model1 = new TrailingCloseModel();
            $model = new TrailingactModel();
            $data = [
                'all_data' => $model1->where("is_active", 1)
                                    ->orderBy("sell_date", 'ASC')
                                    ->find(),
                'content' => $model->where("is_active", 1)
                                    ->orderBy("kode_trailingact", 'ASC')
                                    ->find()
            ];

            // dd($data);
            return view('trail/view_trailclose', $data);
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

                $model1 = new TrailingModel();
                $model = new TrailingactModel();
                $data = [
                    'title'    => 'Trailling Stop',
                    'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->find(),
                    'content' => $model->where("is_active", 1)
                                        ->orderBy("kode_trailingact", 'ASC')
                                        ->find(),
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'lvl'	=> $lvl
                ];

                // echo json_encode($data['lvl']); die;

                return view('trail/trail_web_template', $data);
			}
		}
    }

    public function openweb()
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

                $model1 = new TrailingModel();
                $model = new TrailingactModel();

                $articles = $this->db->query("SELECT content, is_active FROM t_trailingact WHERE alias = 'Open Position' AND is_active = 1 ")->getRowArray();

                $data = [
                    'title'    => 'Trailling Stop',
                    'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->paginate(10, 'btaction'),
                    'content' => $model->where("is_active", 1)
                                        ->orderBy("kode_trailingact", 'ASC')
                                        ->find(),
                    'pager' => $model1->pager,
                    'articles'	=> $articles,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'lvl'	=> $lvl
                ];

                // var_dump($data['articles']); die;

                return view('trail/trail_open_template', $data);
			}
		}
    }

    public function closedweb()
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

                $model1 = new TrailingCloseModel();
                $model = new TrailingactModel();

                $articles = $this->db->query("SELECT content, is_active FROM t_trailingact WHERE alias = 'Closed Position' AND is_active = 1 ")->getRowArray();
                // $all_data = $this->db->query("SELECT * FROM t_trailingclosed WHERE is_active = 1 ORDER BY buy_date DESC")->getResultArray();

                $data = [
                    'title'    => 'Trailling Stop',
                    'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("sell_date", 'ASC')
                                        ->paginate(10, 'btaction'),
                    'content' => $model->where("is_active", 1)
                                        ->orderBy("kode_trailingact", 'ASC')
                                        ->find(),
                    'pager' => $model1->pager,
                    'articles'	=> $articles,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'lvl'	=> $lvl
                ];

                // var_dump($data['articles']); die;

                return view('trail/trail_closed_template', $data);
			}
		}
    }
}
