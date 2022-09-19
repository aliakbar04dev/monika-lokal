<?php

namespace App\Controllers;

use App\Models\PricingModel;
use App\Models\UserModel;
use App\Models\PembayaranModel;
use CodeIgniter\Controller;
use App\Models\NotificationModel;
use App\Models\RefModel;

class Abs_pricing extends BaseController
{
	public function __construct()
	{
		$this->pricingModel = new PricingModel();
		$this->UserModel = new UserModel();
		$this->pay = new PembayaranModel();
		$this->ntf = new NotificationModel();
		$this->ref = new RefModel();
	}

	public function getorderid()
	{
		return $this->pay->getorderid();
	}

	public function cart($paket)
	{
		if (hassession('email')) {
			if($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$cek 	= array("MULV001", "MULV002");
				$usrlvl = $this->UserModel->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $usrlvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $usrlvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);


				$usr	= $this->UserModel->getdetailuser(getsession('email'));
				$detail = $this->pricingModel->getpaketdetail($paket);
				$jnis	= $this->UserModel->getjenismember(getsession('email'));

				if (!is_null($detail) && count($detail) > 0) {
					if ($detail['is_ready'] > 0) {
						$rankusr    = (int)substr($usrlvl, -1);
						$rankpkt    = (int)substr($detail['kode_user_level'], -1);

						if($rankpkt > $rankusr){
							$data = array(
								'title'	=> 'Cart',
								'd'		=> $detail,
								'jnis'	=> $jnis,
								'ntf'	=> $ntf,
								'npy'	=> $npy,
								'cnt'	=> $cnt,
								'lvl'	=> $usrlvl,
								'koref'	=> $usr['kode_referal'],
								'extnd'	=> 'normal',
								'respay'=> 'no',
							);
							return view('abs_pricing/view_abs', $data);
						} else {
							return redirect()->to('/');
						}
					} else {
						return redirect()->to('/');
					}
				} else {
					return redirect()->to('/');
				}
			}
		} else {
			return redirect()->to('/');
		}
	}

	public function packageextender($paket){
		if (hassession('email')) {
			if($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$cek 	= array("MULV001", "MULV002");
				$usrlvl = $this->UserModel->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $usrlvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $usrlvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);
				$usr	= $this->UserModel->getdetailuser(getsession('email'));
				$detail = $this->pricingModel->getpaketdetail($paket);
				$jnis	= $this->UserModel->getjenismember(getsession('email'));

				if (!is_null($detail) && count($detail) > 0) {
					if ($detail['is_ready'] > 0) {
						$rankusr    = (int)substr($usrlvl, -1);
						$rankpkt    = (int)substr($detail['kode_user_level'], -1);

						if($rankpkt == $rankusr){
							$data = array(
								'title'	=> 'Cart',
								'd'		=> $detail,
								'jnis'	=> $jnis,
								'ntf'	=> $ntf,
								'npy'	=> $npy,
								'cnt'	=> $cnt,
								'lvl'	=> $usrlvl,
								'koref'	=> $usr['kode_referal'],
								'extnd'	=> 'extendnontemp',
								'respay'=> 'no',
							);
							return view('abs_pricing/view_abs', $data);
						} else {
							return redirect()->to('/');
						}
					} else {
						return redirect()->to('/');
					}
				} else {
					return redirect()->to('/');
				}
			}
		} else {
			return redirect()->to('/');
		}
	}

	public function packagecontinuer($paket){
		if (hassession('email')) {
			if($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$cek 	= array("MULV001", "MULV002");
				$usrlvl = $this->UserModel->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $usrlvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $usrlvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);
				$extnd	= 'normal';

				$usr	= $this->UserModel->getdetailuser(getsession('email'));
				$pkg 	= $this->pay->getdetailbiling(getsession('email'), $paket);
				$detail = $this->pricingModel->getpaketdetail($pkg['kode_paket']);
				$jnis	= $this->UserModel->getjenismember(getsession('email'));
				$now	= date('Y-m-d H:i:s');

				if($pkg['expire_date'] > $now){
					if (!is_null($detail) && count($detail) > 0) {
						if ($detail['is_ready'] > 0) {
							$rankusr    = (int)substr($usrlvl, -1);
							$rankpkt    = (int)substr($detail['kode_user_level'], -1);
	
							if($rankpkt > $rankusr || $rankpkt == $rankusr){
								if($rankpkt == $rankusr){
									$extnd = 'extendnontemp';
								}

								$data = array(
									'title'	=> 'Cart',
									'd'		=> $detail,
									'jnis'	=> $jnis,
									'ntf'	=> $ntf,
									'npy'	=> $npy,
									'cnt'	=> $cnt,
									'lvl'	=> $usrlvl,
									'koref'	=> $usr['kode_referal'],
									'extnd'	=> $extnd,
									'langg'	=> $pkg['langganan'],
									'langg2'=> $pkg['bulan'],
									'respay'=> 'yes',
								);
								return view('abs_pricing/view_abs', $data);
							} else {
								return redirect()->to('/');
							}
						} else {
							return redirect()->to('/');
						}
					} else {
						return redirect()->to('/');
					}
				} else {
					return redirect()->to('/');
				}
			}
		} else {
			return redirect()->to('/');
		}
	}

	public function process()
	{
		if ($this->request->isAJAX()) {
			if (hassession('email')) {
				if($this->UserModel->checksessionuser(getsession('email'), getsession('sesskode'))){
					$this->session->destroy();

					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Session Failed',
						'description'	=> 'Silahkan Refresh Page to Continue'
					]);
				}else{
					$paket 		= $this->request->getPost('paket', FILTER_SANITIZE_STRING);
					$langganan 	= $this->request->getPost('langganan', FILTER_SANITIZE_STRING);
					$referal 	= $this->request->getPost('referal', FILTER_SANITIZE_STRING);
					$extnd		= $this->request->getPost('extnd', FILTER_SANITIZE_STRING);
					$data		= '';
					$detail 	= $this->pricingModel->getpaketdetail($paket);
					$bulan		= 1;

					if ($langganan != 'tahun' && $langganan != 'bulan' && $langganan != 'tigabulan' && $langganan != 'enambulan') {
						$langganan = 'bulan';
					}

					if (!is_null($detail) && count($detail) > 0) {
						$kode_user	= getsession('kode_user');
						$email		= getsession('email');
						$usr		= $this->UserModel->getdetailuser($email);
						$cek		= $this->pay->cekpendingsammepayment($kode_user, $email, $paket, $langganan);
						$AUTH_STRING = 'Basic ' . base64_encode(SERVERKEY . ':');

						if (!is_null($cek) && count($cek) > 0) {
							$data = array(
								'transaction_details' => array(
									'id_user'		=> $kode_user,
									'email_user' 	=> $email,
									'kode_paket'	=> $cek['kode_paket'],
									'nama_paket'	=> $cek['nama_paket'],
									'order_id' 		=> $cek['kode_pembayaran'],
									'gross_amount'	=> $cek['total'],
								),
								'credit_card' => array(
									'secure' => true
								),
								'customer_details' => array(
									'first_name' => getsession('nama'),
									'email' => $email,
									'phone' => getsession('nohp'),
								),
							);
						} else {
							$jnis		= $this->UserModel->getjenismember($email);
							//$disc		= $jnis['disc_val'];
							//$discval	= ($price * ($disc / 100));
							//$price	= $price - $discval;
							$price 		= '';
							$total		= '';
							
							if($usr['kode_referal'] != ''){
								$referal = $usr['kode_referal'];
							}else{
								if($referal != ''){
									$refcek = $this->ref->where('kode_referal',$referal)->findAll();
									
									if (!is_null($refcek) && count($refcek) < 1) {
										return json_encode([
											'success'		=> 0,
											'reason'		=> 'Buy Failed',
											'description'	=> 'Kode Referal Tidak Ditemukan!!'
										]);
									}
									$this->UserModel->updateRefCode($email, $referal);
								}
							}

							if ($langganan == 'tahun') {
								$bulan = 12;

								if ($jnis['kode_jenis_member'] != '') {
									if ($jnis['kode_jenis_member'] == 'JMBR001') {
										$total = $detail['harga_paket_tahunan'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR002') {
										$total = $detail['harga_koperasi_tahunan'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR003') {
										$total = $detail['harga_komunitas_tahunan'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR004') {
										$total = $detail['harga_dual_tahunan'];
									}
								}else{
									$total = $detail['harga_paket_tahunan'];
								}
							} else if ($langganan == 'bulan') {
								$bulan = 1;

								if ($jnis['kode_jenis_member'] != '') {
									if ($jnis['kode_jenis_member'] == 'JMBR001') {
										$total = $detail['harga_paket'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR002') {
										$total = $detail['harga_koperasi'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR003') {
										$total = $detail['harga_komunitas'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR004') {
										$total = $detail['harga_dual'];
									}
								}else{
									$total = $detail['harga_paket'];
								}
							} else if ($langganan == 'tigabulan') {
								$bulan = 3;
								$langganan = 'lainnya';

								if ($jnis['kode_jenis_member'] != '') {
									if ($jnis['kode_jenis_member'] == 'JMBR001') {
										$total = $detail['harga_paket']*3;
									} else if ($jnis['kode_jenis_member'] == 'JMBR002') {
										$total = $detail['harga_koperasi']*3;
									} else if ($jnis['kode_jenis_member'] == 'JMBR003') {
										$total = $detail['harga_komunitas']*3;
									} else if ($jnis['kode_jenis_member'] == 'JMBR004') {
										$total = $detail['harga_dual']*3;
									}
								}else{
									$total = $detail['harga_paket']*3;
								}
							} else if ($langganan == 'enambulan') {
								$bulan = 6;
								$langganan = 'lainnya';

								if ($jnis['kode_jenis_member'] != '') {
									if ($jnis['kode_jenis_member'] == 'JMBR001') {
										$total = $detail['harga_paket']*6;
									} else if ($jnis['kode_jenis_member'] == 'JMBR002') {
										$total = $detail['harga_koperasi']*6;
									} else if ($jnis['kode_jenis_member'] == 'JMBR003') {
										$total = $detail['harga_komunitas']*6;
									} else if ($jnis['kode_jenis_member'] == 'JMBR004') {
										$total = $detail['harga_dual']*6;
									}
								}else{
									$total = $detail['harga_paket']*6;
								}
							}else{
								$bulan = 1;
								$langganan = 'bulan';

								if ($jnis['kode_jenis_member'] != '') {
									if ($jnis['kode_jenis_member'] == 'JMBR001') {
										$total = $detail['harga_paket'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR002') {
										$total = $detail['harga_koperasi'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR003') {
										$total = $detail['harga_komunitas'];
									} else if ($jnis['kode_jenis_member'] == 'JMBR004') {
										$total = $detail['harga_dual'];
									}
								}else{
									$total = $detail['harga_paket'];
								}
							}

							$harga_paket = $total;
							$total = (int)$total+5000;
							$orderid 	= $this->pay->getorderid();
							$data = [
								'id_user'			=> $kode_user,
								'email_user' 		=> $email,
								'kode_paket'		=> $paket,
								'ref_code'			=> $referal,
								'extend_stats'		=> $extnd,
								'nama_paket'		=> $detail['title'],
								'harga_paket'		=> $harga_paket,
								'disc_per'			=> 0,
								'disc_val'			=> 0,
								'service_charge'	=> 5000,
								'langganan'			=> $langganan,
								'bulan'				=> $bulan,
								'total'				=> $total,
								'created_at'		=> date('Y-m-d H:i:s'),
								'expire_date'		=> date('Y-m-d H:i:s', strtotime('+1 day')),
								'status_pembayaran'	=> 'payment',
							];

							$this->pay->update($orderid, $data);
							$insert = $this->pay->affectedRows();

							if ($insert > 0) {
								$result = '';
								$httpcode = '';
								
								$data = array(
									'transaction_details' => array(
										'id_user'		=> $kode_user,
										'email_user' 	=> $email,
										'kode_paket'	=> $paket,
										'nama_paket'	=> $detail['title'],
										'order_id' 		=> $orderid,
										'gross_amount'	=> $total,
									),
									'credit_card' => array(
										'secure' => true
									),
									'customer_details' => array(
										'first_name' => getsession('nama'),
										'email' => getsession('email'),
										'phone' => getsession('nohp'),
									),
								);
							} else {
								return json_encode([
									'success'		=> '0',
									'reason'		=> 'Terjadi Kesalahan',
									'description'	=> 'Gagal Insert Data.'
								]);
							}
						}

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, MIDTRANSURL);
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							'Authorization: ' . $AUTH_STRING,
							'Accept: application/json',
							'Content-Type: application/json',
						));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POST, 1);

						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
						$result = curl_exec($ch);
						$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						curl_close($ch);

						$result = json_decode($result);

						if ($httpcode == 201) {
							return json_encode([
								'success'		=> '1',
								'token'			=> $result->token,
								'orderid'		=> $orderid,
								'reason'		=> 'Search Success',
								'description'	=> 'Search Success'
							]);
						} else {
							return json_encode([
								'success'		=> '0',
								'checkthis'		=> $result,
								'reason'		=> 'Payment failed',
								'description'	=> 'Something Wrong.....',
							]);
						}
					} else {
						return json_encode([
							'success'		=> '0',
							'reason'		=> 'Terjadi Kesalahan',
							'description'	=> 'Paket tidak ditemukan.'
						]);
					}
				}
			}
		} else {
			return redirect()->to('/');
		}
	}

	public function midtrans()
	{
		if ($this->request->isAJAX()) {
			if (hassession('email')) {
			}
		}
	}
}
