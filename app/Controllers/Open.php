<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\OpenModel;
use App\Models\CopyactModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;

class Open extends BaseController
{
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->modelOpen = new OpenModel();
    }

    public function index()
    {
        if (!hassession('email')) {
            $model = new OpenModel();
            $copy = new CopyactModel();
            $data = [
                'all_data' => $model->where("is_active", 1)
                                    ->orderBy("kode_openpos", 'ASC')
                                    ->find(),
                'content' => $copy->where("is_active", 1)
                                    ->where("alias", "Open Position")
                                    ->orderBy("kode_copyact", 'ASC')
                                    ->find(),
            ];

            return view('open/open_view', $data);
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

                $model = new OpenModel();
                $copy = new CopyactModel();
                $data = [
                    'title' => 'Open Position',
                    'all_data' => $model->where("is_active", 1)
                                        ->orderBy("kode_openpos", 'ASC')
                                        ->paginate(10, 'btaction'),
                                        //  ->find(),
                    'content' => $copy->where("is_active", 1)
                                        ->where("alias", "Open Position")
                                        ->orderBy("kode_copyact", 'ASC')
                                        ->find(),
                    'pager' => $model->pager,
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'lvl'	=> $lvl
                ];
                return view('open/open_web_template', $data);
			}
		}
    }


    public function get_item() {
        $id = $this->request->getVar('id');
        $item = $this->modelOpen->find($id);

        $data = [
            'success' => [
                'kode_openpos' => $item['kode_openpos'],
                'stock' => $item['stock'],
                'buydate' => $item['buy_date'],
                'buyprice' => $item['buy_price'],
                'targetprice' => $item['target_price'],
                'lastprice' => $item['last_price'],
                'lossprofit' => $item['loss_profit'],
                'narration' => $item['narration'],
                'desc_narration' => $item['desc_narration'],
                'stoploss' => $item['stop_loss'],
                'active' => $item['is_active'],
            ]
        ];

        // var_dump($item);
        echo json_encode($data);
    }

}
