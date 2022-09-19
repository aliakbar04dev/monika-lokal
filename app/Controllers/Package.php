<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\UserModel;
use App\Models\PembayaranModel;

class Package extends BaseController
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
                $this->usr->upusrlvl(getsession('email'));
                $lvl    = $this->usr->getuserlvl(getsession('email'));
                $ntf    = $this->ntf->getnotifserver(getsession('email'), $lvl);
                $npy    = $this->ntf->getnotifpayment(getsession('email'), $lvl);
                $cnt    = $this->ntf->getcount($ntf, $npy);

                $pkg    = $this->usr->getallpackage(getsession('email'));

                $data = array(
                    'title'    => 'Paket Saya',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'pkg'    => $pkg,
                );
                return view('package/view_package', $data);
            }
        }
    }
    public function invoice()
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
                    'title'    => 'My Invoice',
                    'ntf'    => $ntf,
                    'npy'    => $npy,
                    'cnt'    => $cnt,
                    'lvl'    => $lvl,
                    'bill'   => $bill,
                );
                return view('package/view_invoice', $data);
            }
        }
    }

    public function detail($slug)
    {
        if (!hassession('email')) {
            return redirect()->to('/');
        } else {
            if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
                $this->session->destroy();
                return redirect()->to('/');
            } else {
                $bill    = $this->bill->getdetailbiling(getsession('email'), $slug);

                if (!is_null($bill) && count($bill) > 0) {
                    $lvl    = $this->usr->getuserlvl(getsession('email'));
                    $ntf    = $this->ntf->getnotifserver(getsession('email'), $lvl);
                    $npy    = $this->ntf->getnotifpayment(getsession('email'), $lvl);
                    $cnt    = $this->ntf->getcount($ntf, $npy);

                    $data = array(
                        'title'    => 'Detail Order',
                        'ntf'    => $ntf,
                        'npy'    => $npy,
                        'cnt'    => $cnt,
                        'lvl'    => $lvl,
                        'bill'   => $bill,
                    );
                    return view('package/view_detail', $data);
                }else{
                    return redirect()->to('/');
                }
            }
        }
    }

    public function deletepacketnontemp(){
        if ($this->request->isAJAX()) {
			if (hassession('email')) {
                $usr = $this->usr->getusrdetaillvl(getsession('email'));
                $kode_user = $usr['kode_user'];

                if($usr['kode_user_level_temp'] != ''){
                    $expire_date = $usr['expire_date_temp'];
                    
                    $usrdata = [
						'kode_user_level'       => $usr['kode_user_level_temp'],
                        'kode_user_level_temp'  => '',
                        'expire_date'           => $expire_date,
					];

                    $this->usr->update($kode_user, $usrdata);

                    return json_encode([
                        'success'		=> '1',
                        'reason'		=> 'Delete Berhasil',
                        'description'	=> 'Berhasil Delete Package'
                    ]);

                }else{
                    $usrdata = [
						'kode_user_level' => 'MULV002'
					];

                    $this->usr->update($kode_user, $usrdata);

                    return json_encode([
                        'success'		=> '1',
                        'reason'		=> 'Delete Berhasil',
                        'description'	=> 'Berhasil Delete Package'
                    ]);
                }
            }
        }else {
			return redirect()->to('/');
		}
    }
}