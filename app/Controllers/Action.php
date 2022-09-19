<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ActionModel;
use App\Models\CopyactModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;

class Action extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->modelAction = new ActionModel();
    }

    public function index(){
        if (!hassession('email')) {
            $model = new ActionModel();
            $copy = new CopyactModel();
            $data = [
                'title' => 'Watchlist Action',
                'all_data' => $model->where("is_active", 1)
                                    ->orderBy("kode_wtcaction", 'ASC')
									->paginate(10, 'btaction'),
                                    //->find(),
                'content' => $copy->where("is_active", 1)
                                    ->where("alias", "Watch Actions")
                                    ->orderBy("kode_copyact", 'ASC')
                                    ->find(),
				'pager' => $model->pager,
            ];

            return view('action/action_view', $data);
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

                $model = new ActionModel();
                $copy = new CopyactModel();
                $data = [
                    'title' => 'Watchlist Action',
                    'all_data' => $model->where("is_active", 1)
                                    ->orderBy("kode_wtcaction", 'ASC')
                                    ->paginate(10, 'btaction'),
                                    //->find(),
                    'content' => $copy->where("is_active", 1)
                                        ->where("alias", "Watch Actions")
                                        ->orderBy("kode_copyact", 'ASC')
                                        ->find(),
                    'pager' => $model->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'lvl'	=> $lvl
                ];
                
                return view('action/action_web_template', $data);
			}
		}
    }


    public function get_item() {
        $id = $this->request->getVar('id');
        $item = $this->modelAction->find($id);

        $data = [
            'success' => [
                'kode_wtcaction' => $item['kode_wtcaction'],
                'stock' => $item['stock'],
                'value' => $item['value'],
                'buyprice' => $item['buy_price'],
                'targetprice' => $item['target_price'],
                'stoploss' => $item['stop_loss'],
                'risk' => $item['risk'],
                'narration' => $item['narration'],
                'desc_narration' => $item['desc_narration'],
                'action' => $item['action'],
                'active' => $item['is_active'],
            ]
        ];

        // var_dump($item);
        echo json_encode($data);
    }
}
