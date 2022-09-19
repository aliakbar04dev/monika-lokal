<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DailyModel;
use App\Models\DailyactModel;
use App\Models\DailychartwebModel;
use App\Models\DailyclosedwebModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;

class Daily extends BaseController
{
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->db = db_connect();
    }

    public function index()
    {
        // echo json_encode(hassession('email')); die;

        if (!hassession('email')) {
            $model1 = new DailyModel();
            $model = new DailyactModel();
            $model2 = new DailychartwebModel();
            $data = [
                'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->find(),
                'content' => $model->where("is_active", 1)
                                    ->orderBy("kode_dailyact", 'ASC')
                                    ->find(),
                'content2' => $model2->where("is_active", 1)
                                    ->orderBy("kode_dailychart", 'ASC')
                                    ->find(),
            ];

            // dd($data);
            return view('daily/view_daily', $data);
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

                $item = $this->db->query("SELECT * FROM tgl_dailystock WHERE id='1'")->getRowArray();
                $tgl = $item['tgl'];

                // echo json_encode($tgl); die;

                $model = new DailyactModel();
                $model1 = new DailyModel();	
                $model2 = new DailychartwebModel();
                $data = [
                    'title'    => 'Daily Stock',
                    'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->paginate(10, 'btaction'),
                    'content' => $model->where("is_active", 1)
                                        ->orderBy("kode_dailyact", 'ASC')
                                        ->find(),
                    'content2' => $model2->where("is_active", 1)
                                        ->orderBy("kode_dailychart", 'ASC')
                                        ->find(),
                    // 'count' => $mode2->where("is_active", 1)
                    //                     ->orderBy("kode_dailychart", 'ASC')
                    //                     ->get()->getcountAll(),
                    'pager' => $model1->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'tgl'	=> $tgl,
                    'lvl'	=> $lvl
                ];

                // echo json_encode($data['count']); die;
                return view('daily/daily_web_template', $data);
			}
		}
    }

    public function webdailyihsg()
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

                $item = $this->db->query("SELECT * FROM tgl_dailystock WHERE id='1'")->getRowArray();
                $tgl = $item['tgl'];

                // echo json_encode($tgl); die;

                $model = new DailyactModel();
                $model1 = new DailyModel();	
                $model2 = new DailychartwebModel();
                $data = [
                    'title'    => 'Daily Stock',
                    'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->paginate(10, 'btaction'),
                    'content' => $model->where("is_active", 1)
                                        ->orderBy("kode_dailyact", 'ASC')
                                        ->find(),
                    'content2' => $model2->where("is_active", 1)
                                        ->orderBy("kode_dailychart", 'ASC')
                                        ->find(),
                    // 'count' => $mode2->where("is_active", 1)
                    //                     ->orderBy("kode_dailychart", 'ASC')
                    //                     ->get()->getcountAll(),
                    'pager' => $model1->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'tgl'	=> $tgl,
                    'lvl'	=> $lvl
                ];

                // echo json_encode($data['count']); die;
                return view('daily/daily_web_ihsg_template', $data);
			}
		}
    }

    public function mobdailyihsg()
    {
        // echo json_encode(hassession('email')); die;

        if (!hassession('email')) {
            $model1 = new DailyModel();
            $model = new DailyactModel();
            $model2 = new DailychartwebModel();
            $data = [
                'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->find(),
                'content' => $model->where("is_active", 1)
                                    ->orderBy("kode_dailyact", 'ASC')
                                    ->find(),
                'content2' => $model2->where("is_active", 1)
                                    ->orderBy("kode_dailychart", 'ASC')
                                    ->find(),
            ];

            // dd($data);
            return view('daily/view_daily_mobile_ihsg', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function webdailyopen()
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

                $item = $this->db->query("SELECT * FROM tgl_dailystock WHERE id='1'")->getRowArray();
                $tgl = $item['tgl'];

                // echo json_encode($tgl); die;

                $model = new DailyactModel();
                $model1 = new DailyModel();	
                $model2 = new DailychartwebModel();
                $data = [
                    'title'    => 'Daily Stock',
                    'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->paginate(10, 'btaction'),
                    'content' => $model->where("is_active", 1)
                                        ->orderBy("kode_dailyact", 'ASC')
                                        ->find(),
                    'content2' => $model2->where("is_active", 1)
                                        ->orderBy("kode_dailychart", 'ASC')
                                        ->find(),
                    // 'count' => $mode2->where("is_active", 1)
                    //                     ->orderBy("kode_dailychart", 'ASC')
                    //                     ->get()->getcountAll(),
                    'pager' => $model1->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'tgl'	=> $tgl,
                    'lvl'	=> $lvl
                ];

                // echo json_encode($data['all_data']); die;
                return view('daily/daily_web_open_template', $data);
			}
		}
    }

    public function mobdailyopen()
    {
        // echo json_encode(hassession('email')); die;

        if (!hassession('email')) {
            $model1 = new DailyModel();
            $model = new DailyactModel();
            $model2 = new DailychartwebModel();
            $data = [
                'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->find(),
                'content' => $model->where("is_active", 1)
                                    ->orderBy("kode_dailyact", 'ASC')
                                    ->find(),
                'content2' => $model2->where("is_active", 1)
                                    ->orderBy("kode_dailychart", 'ASC')
                                    ->find(),
            ];

            // dd($data);
            return view('daily/view_daily_mobile_open', $data);

        } else {
            return redirect()->to('/');
        }
    }

    public function webdailyclosed()
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
                $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt	= $this->ntf->getcount($ntf, $npy);

                $item = $this->db->query("SELECT * FROM tgl_dailystock WHERE id='1'")->getRowArray();
                $tgl = $item['tgl'];

                // echo json_encode($tgl); die;

                $model = new DailyactModel();
                $model1 = new DailyclosedwebModel();	
                $model2 = new DailychartwebModel();
                $data = [
                    'title'    => 'Daily Stock | Closed Position',
                    'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("sell_date", 'DESC')
                                        ->paginate(10, 'btaction'),
                    'content' => $model->where("is_active", 1)
                                        ->orderBy("kode_dailyact", 'ASC')
                                        ->find(),
                    'content2' => $model2->where("is_active", 1)
                                        ->orderBy("kode_dailychart", 'ASC')
                                        ->find(),
                    // 'count' => $mode2->where("is_active", 1)
                    //                     ->orderBy("kode_dailychart", 'ASC')
                    //                     ->get()->getcountAll(),
                    'pager' => $model1->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'tgl'	=> $tgl,
                    'lvl'	=> $lvl
                ];

                // echo json_encode($data['count']); die;
                return view('daily/daily_web_closed_template', $data);
			}
		}
    }

    public function mobdailyclosed()
    {
        // echo json_encode(hassession('email')); die;

        if (!hassession('email')) {
            $model1 = new DailyclosedwebModel();
            $model = new DailyactModel();
            $model2 = new DailychartwebModel();
            $data = [
                'all_data' => $model1->where("is_active", 1)
                                        ->orderBy("buy_date", 'DESC')
                                        ->find(),
                'content' => $model->where("is_active", 1)
                                    ->orderBy("kode_dailyact", 'ASC')
                                    ->find(),
                'content2' => $model2->where("is_active", 1)
                                    ->orderBy("kode_dailychart", 'ASC')
                                    ->find(),
            ];

            // dd($data);
            return view('daily/view_daily_mobile_closed', $data);
        } else {
            return redirect()->to('/');
        }
    }
}
