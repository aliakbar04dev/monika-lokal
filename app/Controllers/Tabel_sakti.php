<?php

namespace App\Controllers;

use App\Models\SaktiModel;
use App\Models\NotificationModel;
use App\Models\UserModel;

class Tabel_sakti extends BaseController
{

	public function __construct()
	{
		$this->sakti = new SaktiModel();
		$this->ntf = new NotificationModel();
		$this->usr = new UserModel();
	}

	public function index()
	{
		if (hassession('email')) {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$jns 	= $this->sakti->getalljnssakti();
				$lvl	= $this->usr->getuserlvl(getsession('email'));
			
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);
				$skti	= $this->sakti->getnewdata();
				
				$data = array(
					'jns'	=> $jns,
					'title'	=> 'Tabel Sakti',
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
					'skti'	=> $skti,
				);
				return view('tabel_sakti/view_tabel_sakti', $data);
			}
		} else {
			return redirect()->to('/');
		}
	}

	public function getdata()
	{
		if ($this->request->isAJAX()) {
			if (hassession('email')) {
				if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
					$this->session->destroy();

					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Session Failed',
						'description'	=> 'Silahkan Refresh Page to Continue'
					]);
				}else{
					$jns 	= $this->request->getPost('jnstable', FILTER_SANITIZE_STRING);
					$start 	= date('Y-m-d', strtotime($this->request->getPost('startdate', FILTER_SANITIZE_STRING)));
					$end 	= date('Y-m-d', strtotime($this->request->getPost('enddate', FILTER_SANITIZE_STRING)));
					$lvl	= $this->usr->getuserlvl(getsession('email'));
					
					if($lvl != '' && ($lvl == 'MULV003' || $lvl == 'MULV005')){
						if ($end >= $start) {
							$data = $this->sakti->where('kode_jenis_tsakti', $jns)->where('tanggal_input >=', $start)->where('tanggal_input <=', $end)->findAll();
							$query = $this->sakti->getLastQuery()->getQuery();

							if (!is_null($data) && count($data) > 0) {
								$tbl = '';

								foreach ($data as $d) {
									$tbl .= '<tr>
												<td>' . $d['judul_tsakti'] . '</td>
												<td>' . $d['tanggal_input'] . '</td>
												<td>' . $d['ukuran'] . '</td>
												<td><a href="#" id="tabledownload" value="' . $d['filename'] . '"><i class="fas fa-download"></i></a></td>
											</tr>';
								}

								return json_encode([
									'success'		=> '1',
									'data'			=> $tbl,
									'reason'		=> 'Success',
									'description'	=> 'Table data ditemukan.'
								]);
							} else {
								return json_encode([
									'success'		=> '0',
									'reason'		=> 'Data Not Found',
									'description'	=> 'Table data sakti tidak ditemukan.'
								]);
							}
						} else {
							return json_encode([
								'success'		=> '0',
								'reason'		=> 'Invalid Date',
								'description'	=> 'Please set the right date.'
							]);
						}
						
					} else {
						return json_encode([
							'success'		=> '0',
							'result'		=> 'Low Level Access (2)',
							'reason'		=> 'Gagal Mencari',
							'description'	=> 'Gagal mencari data, Level akses anda kurang'
						]);
					}
				}
			}
		}
	}
}
