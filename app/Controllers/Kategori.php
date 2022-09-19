<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Models\VideoModel;

class Kategori extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->ntf = new NotificationModel();
        $this->vidm = new VideoModel();
    }

    public function index()
    {
        if (hassession('email')) {
            if ($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))) {
                $this->session->destroy();
                return redirect()->to('/');
            } else {
                $this->UserModel->upusrlvl(getsession('email'));
                $usr    = $this->UserModel->getdetailuser(getsession('email'));
                $lvl    = $this->UserModel->getuserlvl(getsession('email'));
                $ntf    = $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy    = $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt    = $this->ntf->getcount($ntf, $npy);
                // $vide2  = $this->vidm->getVideoTranding();
                // $vide1  = $this->vidm->getVideo('Video Utama')->paginate(3, 'video1');
                // $pager  = $this->vidm->pager;

                $data = array(
                    'title'     => 'Kategori',
                    'd'         => $usr,
                    'ntf'       => $ntf,
                    'npy'       => $npy,
                    'cnt'       => $cnt,
                    'lvl'       => $lvl,
                    // 'vid'       => $vide1,
                    // 'vidt'      => $vide2,
                    // 'pager'     => $pager
                );
                return view('video/view_kategori', $data);
            }
        } else {
            return redirect()->to('/');
        }
    }

    //--------------------------------------------------------------------

}
