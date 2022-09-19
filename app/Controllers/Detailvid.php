<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Models\VideonewModel;

class Detailvid extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->usr = new UserModel();
        $this->ntf = new NotificationModel();
        $this->vidm = new VideonewModel();
        $this->request = \Config\Services::request();
        $this->db = \Config\Database::connect();
    }

    public function webview($kode, $kodeuserlevel)
    {
        // echo json_encode(hassession('email')); die;

        if (!hassession('email')) {
            $rows = $this->vidm->getRowsVideo($kode);
            $filterMed = $rows['kode_filter_media'];
            $subFilterMed = $rows['kode_filter_submedia'];

            $detail = $this->vidm->getAllVideonew($filterMed, $subFilterMed);

            if (!is_null($detail) && count($detail) > 0) {

                $populers    = $this->vidm->mGetPopuler();
                $terbarus    = $this->vidm->mGetTerbaru();

                $segment3 = $this->request->uri->getSegment(2);

                $countDetailVideo = $this->db->table('new_media')->where('kode_filter_media', $filterMed)->where('kode_filter_submedia', $subFilterMed)->countAllResults();

                // echo json_encode($detail); die;

                $data = array(
                    'title' => 'Video',
                    'detail' => $detail,
                    'jdl'    => $rows,
                    'populers'    => $populers,
                    'terbarus'    => $terbarus,
                    'segment3'    => $segment3,
                    'kodeuserlevel'    => $kodeuserlevel,
                    'countDetailVideo'    => $countDetailVideo,
                );

                return view('video/view_video_detailwebview', $data);
        }
            return redirect()->to('/');
        }
    }

    public function index($kode)
    {
        if (hassession('email')) {
            if ($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))) {
                $this->session->destroy();
                return redirect()->to('/');
            } else {
                $rows = $this->vidm->getRowsVideo($kode);
                $filterMed = $rows['kode_filter_media'];
                $subFilterMed = $rows['kode_filter_submedia'];

                $detail = $this->vidm->getAllVideonew($filterMed, $subFilterMed);

                if (!is_null($detail) && count($detail) > 0) {
                    $this->UserModel->upusrlvl(getsession('email'));
                    $usr    = $this->UserModel->getdetailuser(getsession('email'));
                    $lvl    = $this->UserModel->getuserlvl(getsession('email'));
                    $ntf    = $this->ntf->getnotifserver(getsession('email'), $lvl);
                    $npy    = $this->ntf->getnotifpayment(getsession('email'), $lvl);
                    $cnt    = $this->ntf->getcount($ntf, $npy);

                    $populers    = $this->vidm->mGetPopuler();
                    $terbarus    = $this->vidm->mGetTerbaru();

                    $segment3 = $this->request->uri->getSegment(2);

                    $countDetailVideo = $this->db->table('new_media')->where('kode_filter_media', $filterMed)->where('kode_filter_submedia', $subFilterMed)->countAllResults();

                    // echo json_encode($detail); die;

                    $data = array(
                        'title' => 'Video',
                        'd'        => $usr,
                        'ntf'    => $ntf,
                        'npy'    => $npy,
                        'cnt'    => $cnt,
                        'lvl'    => $lvl,
                        'detail' => $detail,
                        'jdl'    => $rows,
                        'populers'    => $populers,
                        'terbarus'    => $terbarus,
                        'segment3'    => $segment3,
                        'countDetailVideo'    => $countDetailVideo,
                    );

                    return view('video/view_video_detail_new', $data);
                }else{
                    return redirect()->to('/');
                }
            }
        } else {
            return redirect()->to('/');
        }

        
    }


    public function onplay($kode)
    {
        if (hassession('email')) {
            if ($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))) {
                $this->session->destroy();
                return redirect()->to('/');
            } else {
                $rows = $this->vidm->getRowsVideo($kode);
                $filterMed = $rows['kode_filter_media'];
                $subFilterMed = $rows['kode_filter_submedia'];

                $detail = $this->vidm->getAllVideonew($filterMed, $subFilterMed);

                if (!is_null($detail) && count($detail) > 0) {
                    $this->UserModel->upusrlvl(getsession('email'));
                    $usr    = $this->UserModel->getdetailuser(getsession('email'));
                    $lvl    = $this->UserModel->getuserlvl(getsession('email'));
                    $ntf    = $this->ntf->getnotifserver(getsession('email'), $lvl);
                    $npy    = $this->ntf->getnotifpayment(getsession('email'), $lvl);
                    $cnt    = $this->ntf->getcount($ntf, $npy);

                    $populers    = $this->vidm->mGetPopuler();
                    $terbarus    = $this->vidm->mGetTerbaru();

                    $segment3 = $this->request->uri->getSegment(2);

                    $countDetailVideo = $this->db->table('new_media')->where('kode_filter_media', $filterMed)->where('kode_filter_submedia', $subFilterMed)->countAllResults();

                    // echo json_encode($detail); die;

                    $data = array(
                        'title' => 'Video',
                        'd'        => $usr,
                        'ntf'    => $ntf,
                        'npy'    => $npy,
                        'cnt'    => $cnt,
                        'lvl'    => $lvl,
                        'detail' => $detail,
                        'jdl'    => $rows,
                        'populers'    => $populers,
                        'terbarus'    => $terbarus,
                        'segment3'    => $segment3,
                        'countDetailVideo'    => $countDetailVideo,
                    );

                    return view('video/view_video_onplay', $data);
                }else{
                    return redirect()->to('/');
                }
            }
        } else {
            return redirect()->to('/');
        }
    }


    //--------------------------------------------------------------------

}
