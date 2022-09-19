<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\UserModel;

class Change_password extends BaseController
{
    public function __construct()
    {
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
    }
    public function index()
    {
        if (!hassession('email')) {
            return redirect()->to('/');
        } else {
            if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                $ntf    = $this->ntf->getnotif(getsession('email'));
                $cnt    = $this->ntf->getcount($ntf);

                $data = [
                    'title' => 'Change Password',
                    'ntf'    => $ntf,
                    'cnt'    => $cnt,
                ];
                return view('change_password/view_change_password', $data);
                // echo 'tes landing page';
            }
        }
    }

    //--------------------------------------------------------------------
}
