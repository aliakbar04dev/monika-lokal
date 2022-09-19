<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;
use App\Models\NewsModel;
use App\Models\SmartwatchlistModel;
use Config\Services;
use CodeIgniter\Controller;

class Smartwatchlist extends BaseController {

    public function __construct() {
        $this->email = \Config\Services::email();
        $this->ntf = new NotificationModel();
        $this->usr = new UserModel();
        $this->model = new NewsModel();
        $this->smartmodel = new SmartwatchlistModel();
        $this->db = db_connect();
        $this->dbmonikasecret = \Config\Database::connect("tests");
    }

    public function index(){
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

                $kode_user = getsession('kode_user');

                $codeNames = $this->dbmonikasecret->query("SELECT code, codename FROM `quotes`")->getResult();

                $dataResult = $this->dbmonikasecret->query("SELECT a.id, a.kode_user, b.code, b.timeframe, b.lastupdate, b.close, b.dsl, b.pivot_r2, b.sig_dsl, b.prev_sig_dsl, b.chg 
                                    FROM trx_smartwatchlist a 
                                    LEFT JOIN data_pasar b ON a.code=b.code AND a.timeframe=b.timeframe 
                                    WHERE kode_user='$kode_user'
                                    ORDER BY a.id DESC, b.lastupdate DESC")->getResultArray();
                $dataCount = $this->dbmonikasecret->query("SELECT COUNT(id) AS jumlah FROM trx_smartwatchlist WHERE kode_user='$kode_user'")->getRowArray();
                $jumlah = $dataCount['jumlah'];

                // $emailSaya = getsession('email');

                // echo json_encode($dataResult); die;

                $data = [
                    'title' => 'Smartwatchlist',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'dataResult' => $dataResult, 
                    'jumlah'     => $jumlah,
                    'lvl'	=> $lvl,
                    'codeNames'	=> $codeNames,
                ];
                return view('smartwatchlist/smartwatchlist_view', $data);
			}
		}
    }

    public function prosesAdd(){
        if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                if (!$this->validate([
                    'kode_user' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'code' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'timeframe' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],

                ])) {
                    session()->setFlashdata('error', $this->validator->listErrors());
                    return redirect()->back()->withInput();
                }

                $kodeUser = $this->request->getVar('kode_user');
                $code = $this->request->getVar('code');
                $timeframe = $this->request->getVar('timeframe');

                $tabelTujuan = $this->dbmonikasecret->query("INSERT INTO `tr_smartwatchlist` (`id`, `kode_user`, `code`, `timeframe`) VALUES (NULL, '$kodeUser', '$code', '$timeframe')");

                $dataCount = $this->dbmonikasecret->query("SELECT COUNT(id) AS jumlah FROM trx_smartwatchlist WHERE kode_user='$kodeUser' AND code='$code'AND timeframe='$timeframe'")->getRowArray();
                $jumlah = $dataCount['jumlah'];

                // echo json_encode($jumlah); die;

                if ($jumlah > 0) {
                    if ($tabelTujuan) {
                        session()->setFlashdata('error', 'Data sudah ada pada WATCHLIST anda');
                        return redirect()->to('/smartwatchlist');
                    }
                } else {
                    $sementaraRows = $this->dbmonikasecret->query("SELECT a.id, a.kode_user, b.code, b.timeframe, b.lastupdate, b.close, b.dsl, b.pivot_r2, b.sig_dsl 
                                                                    FROM tr_smartwatchlist a 
                                                                    LEFT JOIN data_pasar b ON a.code=b.code AND a.timeframe=b.timeframe
                                                                    WHERE a.kode_user='$kodeUser' AND b.code='$code' AND b.timeframe='$timeframe'
                                                                    ORDER BY a.id DESC, b.lastupdate DESC
                                                                    LIMIT 1")->getRowArray();

                    $kodeUserFix = $sementaraRows['kode_user'];
                    $codeFix = $sementaraRows['code'];
                    $timeframeFix = $sementaraRows['timeframe'];
                    $lastupdateFix = $sementaraRows['lastupdate'];
                    $closeFix = $sementaraRows['close'];
                    $dslFix = $sementaraRows['dsl'];
                    $pivot_r2Fix = $sementaraRows['pivot_r2'];
                    $sig_dslFix = $sementaraRows['sig_dsl'];

                    $this->dbmonikasecret->query("INSERT INTO `trx_smartwatchlist` (`id`, `kode_user`, `code`, `timeframe`, `last_update`, `close`, `dsl`, `pivot_r2`, `sig_dsl`) VALUES (NULL, '$kodeUserFix', '$codeFix', '$timeframeFix', '$lastupdateFix', '$closeFix', '$dslFix', '$pivot_r2Fix', '$sig_dslFix')");

                    session()->setFlashdata('message', 'Data telah terinput');
                    return redirect()->to('/smartwatchlist');
                }
                
			}
		}
    }

    public function prosesDelete($id){
        if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                $delete = $this->dbmonikasecret->query("DELETE FROM `trx_smartwatchlist` WHERE `trx_smartwatchlist`.`id` = $id");
                if ($delete) {
                    $this->dbmonikasecret->query("DELETE FROM `tr_smartwatchlist` WHERE `tr_smartwatchlist`.`id` = $id");
                    session()->setFlashdata('message', 'Data telah terhapus');
                    return redirect()->to('/smartwatchlist');
                } else {
                    echo 'error';
                }
			}
		}
    }

    public function prosesDeleteSWberanda($id){
        if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
                $delete = $this->dbmonikasecret->query("DELETE FROM `trx_smartwatchlist` WHERE `trx_smartwatchlist`.`id` = $id");
                if ($delete) {
                    $this->dbmonikasecret->query("DELETE FROM `tr_smartwatchlist` WHERE `tr_smartwatchlist`.`id` = $id");
                    session()->setFlashdata('message', 'Data telah terhapus');
                    return redirect()->to('/pengumuman');
                } else {
                    echo 'error';
                }
			}
		}
    }

    public function tes(){
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

                $kode_user = getsession('kode_user');
                $emailSaya = getsession('email');

                $codeNames = $this->dbmonikasecret->query("SELECT code, codename FROM `quotes`")->getResultArray();
                

                $dataResult = $this->dbmonikasecret->query("SELECT a.id, c.codename, a.kode_user, b.code, b.timeframe, b.lastupdate, b.close, b.dsl, b.pivot_r2, b.sig_dsl, b.prev_sig_dsl, b.chg 
                                    FROM trx_smartwatchlist a 
                                    LEFT JOIN data_pasar b ON a.code=b.code AND a.timeframe=b.timeframe
                                    LEFT JOIN quotes c ON a.code=c.code 
                                    WHERE kode_user='$kode_user'
                                    ORDER BY a.id DESC, b.lastupdate DESC")->getResultArray();


                $dataCount = $this->dbmonikasecret->query("SELECT COUNT(id) AS jumlah FROM trx_smartwatchlist WHERE kode_user='$kode_user'")->getRowArray();
                $jumlah = $dataCount['jumlah'];

                $cekJikaAdaSinyal = $this->dbmonikasecret->query("SELECT COUNT(DISTINCT a.id) AS TotalSaham,
                                            COUNT(DISTINCT IF(b.sig_dsl = 'Buy',
                                                    a.id,
                                                    NULL)) AS jumlah_buy,
                                            COUNT(DISTINCT IF(b.sig_dsl = 'Sell',
                                                    a.id,
                                                    NULL)) AS jumlah_sell,
                                            COUNT(DISTINCT IF(b.sig_dsl = 'Avg Up',
                                                    a.id,
                                                    NULL)) AS jumlah_avgup
                                        FROM trx_smartwatchlist a 
                                        LEFT JOIN data_pasar b ON a.code=b.code AND a.timeframe=b.timeframe 
                                        WHERE kode_user='$kode_user'
                                        ORDER BY a.id DESC, b.lastupdate DESC")->getRowArray();

                // echo json_encode($codeNames); die;

                $dataEmail = [
                    'title' => 'Smartwatchlist',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'dataResult' => $dataResult, 
                    'jumlah'     => $jumlah,
                    'lvl'	=> $lvl,
                    'codeNames'	=> $codeNames,
                ];

                $msg = view('email/email_mywatchlist', $dataEmail);

                if ($cekJikaAdaSinyal['jumlah_buy'] == 0) {
                    $this->email->setFrom('support.monika@panensaham.com', 'Monika Panensaham');
                    $this->email->setTo($emailSaya);
                    $this->email->setSubject('My Watchlist');
                    $this->email->setMessage($msg);
                    $this->email->send();
                } elseif ($cekJikaAdaSinyal['jumlah_sell'] == 1) {
                    # code...
                } elseif ($cekJikaAdaSinyal['jumlah_avgup'] == 1) {
                    # code...
                } else {
                    # code...
                }

                $data = [
                    'title' => 'Smartwatchlist',
                    'ntf'	=> $ntf,
                    'npy'	=> $npy,
                    'cnt'	=> $cnt,
                    'dataResult' => $dataResult, 
                    'jumlah'     => $jumlah,
                    'lvl'	=> $lvl,
                    'codeNames'	=> $codeNames,
                ];
                return view('smartwatchlist/tes', $data);
			}
		}
    }

}
