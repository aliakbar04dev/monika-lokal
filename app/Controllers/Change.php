<?php

namespace App\Controllers;

use App\Models\RegisModel;
use App\Models\RefModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Change extends BaseController
{
    protected $regisModel;
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->regisModel = new RegisModel();
        $this->ref = new RefModel();
        $this->usr = new UserModel();
    }

    public function index()
    {
        if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
            $this->session->destroy();
            return redirect()->to('/');
        }else{
            return view('change/phone');
        }
    }

    public function phoneotp()
    {
        if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
            $this->session->destroy();
            return redirect()->to('/');
        }else{
            $email		= getsession('email');
			$usr		= $this->usr->select('change_phone, phone_otp, phone_otp_exp')->where('alamat_email', $email)->first();

            if($usr['change_phone'] != '' && $usr['phone_otp'] != '' && $usr['phone_otp_exp'] != ''){
                $nohp = (int)$usr['change_phone'];
                $nohp = substr($nohp, 0, 2) . '******' . substr($nohp, -2);

                $data = array(
                    'nohp' => $nohp,
                );
    
                return view('change/phoneotp', $data);
            }else{
                return redirect()->to('/');
            }
        }
    }
}
