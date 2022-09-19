<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DailyModel;
use App\Models\DailyactModel;
use CodeIgniter\Controller;

class Dailyact extends BaseController
{
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->usr = new UserModel();
    }

    public function index()
    {
        if (!hassession('email')) {
			$model1 = new DailyModel();	
            $model = new DailyactModel();
            $data = [
				'all_data' => $model1->where("is_active", 1)
                                    ->orderBy("kode_daily", 'ASC')
                                    ->find(),
                'content' => $model->where("is_active", 1)
                                    ->orderBy("kode_dailyact", 'ASC')
                                    ->find(),
            ];

            return view('daily/view_dailyact', $data);
        } else {
            return redirect()->to('/');
        }
    }
}
