<?php

namespace App\Controllers;

use App\Models\RegisModel;
use App\Models\RefModel;
use CodeIgniter\Controller;

class Register extends BaseController
{
	protected $regisModel;
	protected $email;

	public function __construct()
	{
		$this->email = \Config\Services::email();
		$this->regisModel = new RegisModel();
		$this->ref = new RefModel();
	}

	public function testAja()
	{
		$masuk = true;
		$coba = 1;
		$kode_user = '';

		$data = [
			'alamat_email'	=> 'test@gmail.com',
		];

		$this->regisModel->update('TUSR023', $data);
		$insert = $this->regisModel->affectedRows();

		echo $insert;
	}

	public function checkEmail()
	{
		if ($this->request->isAJAX()) {
			$valid	= TRUE;
			$email 	= $this->request->getPost('email', FILTER_SANITIZE_EMAIL);

			$dataUser = $this->regisModel->where('alamat_email', $email)
				->findAll();

			$count = count($dataUser);

			if ($count > 0) {
				$valid = FALSE;
			}

			return json_encode([
				'valid'		=> $valid,
				'email '	=> $email,
			]);
		}
	}

	public function cekrefcode()
	{
		if ($this->request->isAJAX()) {
			$ref 	= $this->request->getPost('ref', FILTER_SANITIZE_STRING);

			$refcek = $this->ref->where('kode_referal', $ref)->findAll();

			if (!is_null($refcek) && count($refcek) < 1) {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Kode Referal Tidak Ditemukan!',
					'description'	=> 'Silahkan dikosongkan jika tidak mempunyai kode referal.'
				]);
			} else {
				return json_encode([
					'success'		=> 1,
					'reason'		=> 'Berhasil!',
					'description'	=> 'Kode Referal Dapat Digunakan'
				]);
			}
		}
	}

	public function newRegistration()
	{
		if ($this->request->isAJAX()) {
			$member			= true;
			//$radiomember	= $this->request->getPost('radiomember', FILTER_SANITIZE_STRING);
			$usrlvl			= 'MULV001';
			$komu			= '';
			$kope			= '';
			$jns			= '';
			$nama 			= $this->request->getPost('nama', FILTER_SANITIZE_STRING);
			//$username		= $this->request->getPost('username', FILTER_SANITIZE_STRING);
			$email			= $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
			//$kota			= $this->request->getPost('kota', FILTER_SANITIZE_STRING);
			$pass			= $this->request->getPost('password', FILTER_SANITIZE_STRING);
			$ref			= $this->request->getPost('referal', FILTER_SANITIZE_STRING);
			$syarat			= $this->request->getPost('syarat', FILTER_SANITIZE_STRING);
			$phone			= $this->request->getPost('calling_code', FILTER_SANITIZE_STRING);
			$today = date('Y-m-d');

			$dataUser = count($this->regisModel->where('alamat_email', $email)
				->findAll());

			if ($dataUser > 0) {
				return json_encode([
					'success'		=> '0',
					'reason'		=> 'Registered Email',
					'description'	=> 'Registrasi gagal, Akun sudah teregistrasi'
				]);
			} else {
				if ($ref != '') {
					$refcek = $this->ref->where('kode_referal', $ref)->findAll();

					if (!is_null($refcek) && count($refcek) < 1) {
						return json_encode([
							'success'		=> 0,
							'reason'		=> 'Register Gagal',
							'description'	=> 'Kode Referal Tidak Ditemukan.'
						]);
					}
				}

				if ($member) {
					$jns = 'JMBR001';
				} else {
					if ($komu != '') {
						$jns = 'JMBR003';
					}
				}

				$masuk = true;

				do {
					$prefix 	= 'TUSR';
					$get		= $this->regisModel->select('kode_user, CAST(SUBSTR(kode_user FROM 5) AS SIGNED) as kode')->orderBy('kode', "desc")->first();

					if (!is_null($get) && count($get) > 0) {
						$int 		= str_pad(filter_var($get['kode_user'], FILTER_SANITIZE_NUMBER_INT) + 1, 3, "0", STR_PAD_LEFT);
						$kode_user	= $prefix . $int;
					} else {
						$int = '001';
						$kode_user	= $prefix . $int;
					}

					$data = [
						'kode_user'		=> $kode_user,
						'alamat_email'	=> $email,
					];

					$this->regisModel->insert($data);
					$insert = $this->regisModel->affectedRows();

					if ($insert > 0) {
						$masuk = false;
					}
				} while ($masuk);

				$aktiv 	= md5($email . $kode_user);

				$data = [
					'kode_user_level'		=> $usrlvl,
					'kode_jenis_member' 	=> $jns,
					'client_id_komunitas'	=> $komu,
					'email_anggota'			=> $kope,
					'nama_lengkap'			=> $nama,
					'password'				=> md5($pass),
					'kode_referal'			=> $ref,
					'created_at'			=> date('Y-m-d H:i:s'),
					'trial_expire'			=> date('Y-m-d', strtotime($today . '+ 14 days')),
					'verif_kode'			=> $aktiv,
				];

				$this->regisModel->update($kode_user, $data);
				$insert = $this->regisModel->affectedRows();

				if ($insert > 0) {
					$newdata = [
						'regis_phone_input'	=> 'Yes',
						'regis_phone_code_user'	=>  $kode_user,
					];

					$this->session->set($newdata);

					return json_encode([
						'success'		=> $insert,
						'reason'		=> 'Apply Berhasil',
						'description'	=> 'Silahkan masukan no hp anda untuk aktivasi'
					]);
				} else {
					return json_encode([
						'success'		=> $insert,
						'reason'		=> 'Register Failed',
						'description'	=> 'Please Contact Administrator'
					]);
				}
			}
		}
	}

	public function autonewRegistration()
	{
		if ($this->request->isAJAX()) {
			if (hassession('regis_after_auto')) {
				$member			= true;
				$usrlvl			= 'MULV001';
				$komu			= '';
				$kope			= '';
				$jns			= '';
				$nama 			= $this->request->getPost('nama', FILTER_SANITIZE_STRING);
				$email			= getsession('emailregis');
				$ref			= $this->request->getPost('referal', FILTER_SANITIZE_STRING);
				$phone			= $this->request->getPost('calling_code', FILTER_SANITIZE_STRING);
				$today = date('Y-m-d');

				$dataUser = count($this->regisModel->where('alamat_email', $email)
					->findAll());

				if ($dataUser > 0) {
					return json_encode([
						'success'		=> '0',
						'reason'		=> 'Registered Email',
						'description'	=> 'Email Already Registered'
					]);
				} else {
					if ($ref != '') {
						$refcek = $this->ref->where('kode_referal', $ref)->findAll();

						if (!is_null($refcek) && count($refcek) < 1) {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Register Gagal',
								'description'	=> 'Kode Referal Tidak Ditemukan.'
							]);
						}
					}

					if ($member) {
						$jns = 'JMBR001';
					} else {
						if ($komu != '') {
							$jns = 'JMBR003';
						}
					}

					$masuk = true;

					do {
						$prefix 	= 'TUSR';
						$get		= $this->regisModel->select('kode_user, CAST(SUBSTR(kode_user FROM 5) AS SIGNED) as kode')->orderBy('kode', "desc")->first();

						if (!is_null($get) && count($get) > 0) {
							$int 		= str_pad(filter_var($get['kode_user'], FILTER_SANITIZE_NUMBER_INT) + 1, 3, "0", STR_PAD_LEFT);
							$kode_user	= $prefix . $int;
						} else {
							$int = '001';
							$kode_user	= $prefix . $int;
						}

						$data = [
							'kode_user'		=> $kode_user,
							'alamat_email'	=> $email,
						];

						$this->regisModel->insert($data);
						$insert = $this->regisModel->affectedRows();

						if ($insert > 0) {
							$masuk = false;
						}
					} while ($masuk);

					$aktiv 	= md5($email . $kode_user);

					$data = [
						'kode_user_level'		=> $usrlvl,
						'kode_jenis_member' 	=> $jns,
						'client_id_komunitas'	=> $komu,
						'email_anggota'			=> $kope,
						'nama_lengkap'			=> $nama,
						'kode_referal'			=> $ref,
						'created_at'			=> date('Y-m-d H:i:s'),
						'trial_expire'			=> date('Y-m-d', strtotime($today . '+ 14 days')),
						'verif_kode'			=> $aktiv,
						'no_hp'					=> $phone
					];

					$this->regisModel->update($kode_user, $data);
					$insert = $this->regisModel->affectedRows();

					if ($insert > 0) {
						$this->session->remove('regis_after_auto');
						$this->session->remove('nameregis');
						$this->session->remove('emailregis');
						$this->session->remove('usernameregis');

						$newdata = [
							'regis_phone_input'	=> 'Yes',
							'regis_phone_code_user'	=>  $kode_user,
						];

						$this->session->set($newdata);

						return json_encode([
							'success'		=> $insert,
							'reason'		=> 'Register Berhasil',
							'description'	=> 'Silahkan cek email anda untuk aktivasi'
						]);
					} else {
						return json_encode([
							'success'		=> $insert,
							'reason'		=> 'Register Gagal',
							'description'	=> 'Please Contact Administrator'
						]);
					}
				}
			}
		}
	}

	public function aktivasi($kode)
	{
		$dataUser = $this->regisModel->where('verif_kode', $kode)
			->where('is_verif', 0)
			->first();

		if (!is_null($dataUser) && count($dataUser) > 0) {
			$kode_user	= $dataUser['kode_user'];
			$create		= date('Y-m-d', strtotime($dataUser['created_at']));
			$nama		= $dataUser['nama_lengkap'];
			$email		= $dataUser['alamat_email'];

			$today		= date('Y-m-d');
			$cekmonth	= date('Y-m-d', strtotime($create . '+1 month'));

			if ($today != $cekmonth) {
				$data = [
					'is_verif'		=> 1,
					'verif_kode'    => '',
				];

				$this->regisModel->update($kode_user, $data);

				$this->email->setFrom('support.monika@panensaham.com', 'Monika Panensaham');
				$this->email->setTo($email);

				$data = array(
					'nama'		=> $nama,
					'email'		=> $email,
					'create'	=> $create,
				);

				$msg = view('email/email2', $data);

				$this->email->setSubject('Say Hi to Monika!');
				$this->email->setMessage($msg);

				$this->email->send();

				$this->session->set('aktivasi', 'true');
				return redirect()->to('/');
			} else {
				return redirect()->to('/');
			}
		} else {
			return redirect()->to('/');
		}
	}
}
