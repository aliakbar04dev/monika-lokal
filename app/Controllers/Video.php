<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Models\VideonewModel;

class Video extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->ntf = new NotificationModel();
        $this->vidmnew = new VideonewModel();
        $this->usr = new UserModel();
    }

    public function index($kodeuserlevel = null)
    {
        // echo json_encode(hassession('email')); die;

        if (!hassession('email')) {
            $videUtama  = $this->vidmnew->getVideoUtamaTranding('Video Utama');
            $videTranding  = $this->vidmnew->getVideoUtamaTranding('Video Tranding');
            $dataWebviewAll  = $this->vidmnew->webViewAll();
            $populers    = $this->vidmnew->mGetPopuler();
            $terbarus    = $this->vidmnew->mGetTerbaru();

            $inputCariVideowebview = $this->request->getVar('carivideowebview');

            if ($inputCariVideowebview) {
                $query = $this->vidmnew->pencarianVideowebview($inputCariVideowebview);
            } else {
                $query = '';
            }

            // echo json_encode($dataWebviewAll); die;

            $data = array(
                'title'             => 'Video',
                'videUtama'         => $videUtama,
                'videTranding'      => $videTranding,
                'pager'             => $this->vidmnew->pager,
                'inputCariVideowebview'    => $inputCariVideowebview,
                'hasilCariVideowebview'    => $query,
                'dataWebviewAll'    => $dataWebviewAll,
                'populers'    => $populers,
                'terbarus'    => $terbarus,
                'kodeuserlevel'    => $kodeuserlevel,
            );

            return view('video/view_video_webview', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function web()
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
                
                $videUtama  = $this->vidmnew->getVideoUtamaTranding('Video Utama');
                $videTranding  = $this->vidmnew->getVideoUtamaTranding('Video Tranding');
                $dataWebviewAll  = $this->vidmnew->webViewAll();
                $populers    = $this->vidmnew->mGetPopuler();
                $terbarus    = $this->vidmnew->mGetTerbaru();

                $inputCariVideo = $this->request->getVar('carivideo');

                if ($inputCariVideo) {
                    $query = $this->vidmnew->pencarianVideo($inputCariVideo);
                } else {
                    $query = '';
                }

                // echo json_encode($dataWebviewAll); die;

                $data = array(
                    'title'             => 'Video',
                    'd'                 => $usr,
                    'ntf'               => $ntf,
                    'npy'               => $npy,
                    'cnt'               => $cnt,
                    'lvl'               => $lvl,
                    'videUtama'         => $videUtama,
                    'videTranding'      => $videTranding,
                    'pager'             => $this->vidmnew->pager,
                    'inputCariVideo'    => $inputCariVideo,
                    'hasilCariVideo'    => $query,
                    'dataWebviewAll'    => $dataWebviewAll,
                    'populers'          => $populers,
                    'terbarus'          => $terbarus,
                );
                // return view('video/view_video', $data);
                return view('video/view_video', $data);
            }
        } else {
            return redirect()->to('/');
        }
    }

    //--------------------------------------------------------------------

}
