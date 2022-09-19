<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;

class Integration extends BaseController
{
	public function __construct()
	{
		$this->usr = new UserModel();
		$this->ntf = new NotificationModel();
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
				$usr 	= $this->usr->getdetailuser(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);

				$data = array(
					'title'	=> 'Integration',
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
					'usr'	=> $usr,
				);

				return view('integration/view_integration', $data);
			}
		}
	}

	public function komuintegrate()
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
					$email	= getsession('email');
					$usr	= $this->usr->select('client_id_komunitas, email_anggota, kode_user')->where('alamat_email', $email)->first();

					if (!is_null($usr) && count($usr) > 0) {
						$komu	= $this->request->getPost('clientid', FILTER_SANITIZE_STRING);

						if ($komu != '' && !empty($komu)) {
							$anoncheck = $this->usr->select('client_id_komunitas')->where('client_id_komunitas', $komu)->first();

							if ($anoncheck['client_id_komunitas'] != '') {
								return json_encode([
									'success'		=> 0,
									'reason'		=> 'Integration Failed',
									'description'	=> $komu . " Sudah terpakai, Jika anda merasa data anda belum terpakai silahkan Hubungi kami via Live Chat atau Email"
								]);
							} else {
								$komu	= $this->request->getPost('clientid', FILTER_SANITIZE_STRING);
								$url	= 'https://cac-advisory.com/api/cek_email_komunitas';

								$ch = curl_init( $url );

								curl_setopt_array($ch, array(
									CURLOPT_URL => $url,
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => '',
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 0,
									CURLOPT_FOLLOWLOCATION => true,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => 'POST',
									CURLOPT_POSTFIELDS => array('email' => $komu),
								));

								$response = curl_exec( $ch );
								$response = json_decode($response);

								curl_close($ch);

								$check = $response->messages;
								
								$kode_user = $usr['kode_user'];

								if (!is_null($check) && $check == 'Account verified') {
									$member = false;
									$jns = '';

									if ($usr['email_anggota'] != '') {
										$jns = 'JMBR004';
									} else {
										$jns = 'JMBR003';
									}

									$data = [
										'client_id_komunitas' => $komu,
										'kode_jenis_member' => $jns,
									];
									$this->usr->update($kode_user, $data);
									return json_encode([
										'success'		=> 1,
										'reason'		=> 'Integration Successfull',
										'description'	=> 'Email Komunitas Telah Berhasil Integrasi'
									]);
								} else {
									$url	= 'https://panensaham.com/api/check_email_member?email=' . $komu;

									$ch = curl_init( $url );

									curl_setopt_array($ch, array(
										CURLOPT_URL => $url,
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => '',
										CURLOPT_MAXREDIRS => 10,
										CURLOPT_TIMEOUT => 0,
										CURLOPT_FOLLOWLOCATION => true,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									));

									$response = curl_exec( $ch );
									$response = json_decode($response);

									curl_close($ch);

									$check = $response->messages;

									if (!is_null($check) && $check == 'Account verified') {
										$member = false;
										$jns = '';
	
										if ($usr['email_anggota'] != '') {
											$jns = 'JMBR004';
										} else {
											$jns = 'JMBR003';
										}
	
										$data = [
											'client_id_komunitas' => $komu,
											'kode_jenis_member' => $jns,
										];
										$this->usr->update($kode_user, $data);
										return json_encode([
											'success'		=> 1,
											'reason'		=> 'Integration Successfull',
											'description'	=> 'Email Komunitas Telah Berhasil Integrasi'
										]);
									} else {

										return json_encode([
											'success'		=> 0,
											'reason'		=> 'Integration Failed',
											'description'	=> 'Email Komunitas Tidak Ditemukan!!'
										]);
									}
								}
							}
						} else {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Integration Failed',
								'description'	=> 'Email Komunitas Tidak Ditemukan!!'
							]);
						}
					}
				}
			}
		}
	}

	public function koperintegrate()
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
					$email	= getsession('email');
					$usr	= $this->usr->select('email_anggota, kode_user, client_id_komunitas')->where('alamat_email', $email)->first();

					if (!is_null($usr) && count($usr) > 0) {
						if ($usr['email_anggota'] != '') {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Integration Failed',
								'description'	=> "Already integrated, can't integration more than once"
							]);
						} else {
							$kope	= $this->request->getPost('emailid', FILTER_SANITIZE_EMAIL);

							if ($kope != '' && !empty($kope)) {
								$kode_user = $usr['kode_user'];

								$check = $this->usr->from('m_anggota')
									->where('email', $kope)
									->first();

								if (!is_null($check) && count($check) > 0) {
									$member = false;
									$jns = '';
									
									if($usr['client_id_komunitas'] != ''){
										/*
										$getjenismember = $this->usr->from('m_jenis_member')
											->like('jenis_member', 'koperasi')
											->like('jenis_member', 'komunitas')
											->first();

										if (!is_null($getjenismember) && count($getjenismember) > 0) {
											$jns = $getjenismember['kode_jenis_member'];
										}*/

										$jns = 'JMBR004';
									}else{
										/*
										$getjenismember = $this->usr->from('m_jenis_member')
											->like('jenis_member', 'koperasi')
											->first();

										if (!is_null($getjenismember) && count($getjenismember) > 0) {
											$jns = $getjenismember['kode_jenis_member'];
										}*/

										$jns = 'JMBR002';
									}
									
									$data = [
										'email_anggota' => $kope,
										'kode_jenis_member' => $jns,
									];

									$this->usr->update($kode_user, $data);

									return json_encode([
										'success'		=> 1,
										'reason'		=> 'Integration Successfull',
										'description'	=> 'Email Anggota Telah Berhasil Integrasi'
									]);
								} else {
									return json_encode([
										'success'		=> 0,
										'reason'		=> 'Integration Failed',
										'description'	=> 'Email Anggota Tidak Ditemukan!!'
									]);
								}
							} else {
								return json_encode([
									'success'		=> 0,
									'reason'		=> 'Integration Failed',
									'description'	=> 'Email Anggota Tidak Ditemukan!!'
								]);
							}
						}
					}
				}
			}
		}
	}
}
