<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\UserModel;
use App\Models\PembayaranModel;

class Billing extends BaseController
{
    public function __construct()
    {
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->bill = new PembayaranModel();
    }
    public function index()
    {
        if (!hassession('email')) {
            return redirect()->to('/');
        } else {
            if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
                $this->session->destroy();
                return redirect()->to('/');
            } else {
                $lvl    = $this->usr->getuserlvl(getsession('email'));
                $ntf    = $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy    = $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt    = $this->ntf->getcount($ntf, $npy);

                $bill    = $this->bill->getallbilling(getsession('email'), '');

                $data = array(
                    'title'    => 'Billing',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'bill'   => $bill,
                );
                return view('billing/view_billing', $data);
            }
        }
    }
//test ebas
    public function addfunds()
    {
        if (!hassession('email')) {
            return redirect()->to('/');
        } else {
            if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
                $this->session->destroy();
                return redirect()->to('/');
            } else {
                $lvl    = $this->usr->getuserlvl(getsession('email'));
                $ntf    = $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy    = $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt    = $this->ntf->getcount($ntf, $npy);

                $bill    = $this->bill->getallbilling(getsession('email'), '');

                $data = array(
                    'title'    => 'Add Funds',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'bill'   => $bill,
                );
                return view('billing/view_addfunds', $data);
            }
        }
    }
}