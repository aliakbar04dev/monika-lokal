<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\UserModel;
use App\Models\PembayaranModel;

class Status extends BaseController
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

                $bill    = $this->bill->getallbilling(getsession('email'), 'settlement');

                $data = array(
                    'title'    => 'Paid',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'bill'   => $bill,
                );
                return view('status/view_status', $data);
            }
        }
    }

    public function unpaid()
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

                $bill    = $this->bill->getallbilling(getsession('email'), 'pending');

                $data = array(
                    'title'    => 'Unpaid',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'bill'   => $bill,
                );
                return view('status/view_unpaid', $data);
            }
        }
    }

    public function cancel()
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

                $bill    = $this->bill->getallbilling(getsession('email'), 'expire');

                $data = array(
                    'title'    => 'Cancelled',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'bill'   => $bill,
                );
                return view('status/view_cancel', $data);
            }
        }
    }
}