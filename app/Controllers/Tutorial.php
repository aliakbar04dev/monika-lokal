<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TutorialModel;
use App\Models\NotificationModel;

class Tutorial extends BaseController
{
    protected $videoModel;
    public function __construct()
    {
        $this->tutorialModel = new TutorialModel();
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
                $lvl    = $this->usr->getuserlvl(getsession('email'));
                $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt    = $this->ntf->getcount($ntf, $npy);

                $dataResult = $this->tutorialModel->semuaData()->getResultArray();

                $pager = \Config\Services::pager();
                $cari = $this->request->getVar('cari');

                if ($cari) {
                    $query = $this->tutorialModel->pencarian($cari);
                    $jumlah = "Ditemukan ".$query->affectedRows()." Tutorial";
                } else {
                    $query = $this->tutorialModel;
                    $jumlah = "";
                }

                // echo json_encode($dataResult); die;

                $data = [
                    'title'    => 'Tutorial',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'cari'    => $cari,
                    'dataResult'    => $dataResult,
                    'konten_tutorial' => $query->paginate(6),
                    'pager' => $this->tutorialModel->pager,
                    'page' => $this->request->getVar('page') ? $this->request->getVar('page') : 1,
                    'jumlah' => $jumlah
                ];

                return view('tutorial/view_tutorial', $data);
            }
        }
    }


    public function detail($id)
    {
        if (!hassession('email')) {
            return redirect()->to('/');
        } else {
            if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                $lvl    = $this->usr->getuserlvl(getsession('email'));
                $ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt    = $this->ntf->getcount($ntf, $npy);

                // $dataResult = $this->tutorialModel->semuaData()->getResultArray();
                $dataDetail = $this->tutorialModel->find($id);

                // echo json_encode($dataResult); die;

                $data = array(
                    'title'    => 'Tutorial',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'dataDetail'    => $dataDetail,
                );

                return view('tutorial/view_tutorialdetail', $data);
            }
        }
    }

    //--------------------------------------------------------------------

}
