<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Lupa extends BaseController
{
	public function __construct()
	{
		$this->email = \Config\Services::email();
		$this->usr = new UserModel();
	}

	public function index()
	{
		if (!hassession('email')) {
			return view('lupa/view_lupa');
		} else {
			return redirect()->to('/');
		}
	}

	public function changepass($code)
	{
		if (!hassession('email')) {
			$usr = $this->usr->select('forget_expire')->where('forget_kode', $code)->first();

			if (!is_null($usr) && count($usr) > 0) {
				$exp = strtotime($usr['forget_expire']);
				$now = strtotime(date('Y-m-d H:i:s'));

				if ($exp > $now) {
					$data = ['code' => $code];
					return view('lupa/view_new_password', $data);
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

	public function updateforgetpass()
	{
		if ($this->request->isAJAX()) {
			$code		= $this->request->getPost('code', FILTER_SANITIZE_STRING);
			$password	= $this->request->getPost('password', FILTER_SANITIZE_STRING);
			$repeat		= $this->request->getPost('repeat', FILTER_SANITIZE_STRING);

			if ($password == $repeat) {
				$usr = $this->usr->select('kode_user, nama_lengkap, forget_expire')->where('forget_kode', $code)->first();

				if (!is_null($usr) && count($usr) > 0) {
					$kode_user = $usr['kode_user'];

					$data = [
						'password'		=> md5($password),
						'forget_kode'	=> '',
					];

					$this->usr->update($kode_user, $data);

					return json_encode([
						'success'		=> 1,
						'reason'		=> 'Update Password Berhasil',
						'description'	=> 'Silahkan login kembali menggunakan password baru'
					]);
				} else {
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'No data found',
						'description'	=> 'Please rechek the link'
					]);
				}
			} else {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Password Mismatch',
					'description'	=> 'Please match the password'
				]);
			}
		}
	}

	public function forgetpass()
	{
		if ($this->request->isAJAX()) {
			$email 	= $this->request->getPost('forget', FILTER_SANITIZE_EMAIL);

			$usr = $this->usr->select('kode_user, nama_lengkap, no_hp')->where('alamat_email', $email)->where('is_verif', 1)->first();

			if (!is_null($usr) && count($usr) > 0) {
				$kode_user	= $usr['kode_user'];
				$nama		= $usr['nama_lengkap'];
				$rand 		= mt_rand();
				$code		= md5($email . $usr['no_hp'] . $rand);

				$data = [
					'forget_kode'	=> $code,
					'forget_expire'	=> date('Y-m-d H:i:s', strtotime('+1 day')),
				];

				$this->usr->update($kode_user, $data);

				$this->email->setFrom('support.monika@panensaham.com', 'Monika Panensaham');
				$this->email->setTo($email);

				$data = array(
					'nama'		=> $nama,
					'email'		=> $email,
					'link'		=> base_url('changepassword/' . $code),
				);

				$msg = view('email/emailresetpassword', $data);

				$this->email->setSubject('Permintaan Perubahan Password');
				$this->email->setMessage($msg);

				$this->email->send();

				return json_encode([
					'success'		=> 1,
					'reason'		=> 'Permintan Berhasil',
					'description'	=> 'Silahkan cek email anda untuk melanjutkan'
				]);
			} else {
				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Email salah!',
					'description'	=> 'Email tidak ditemukan atau email belum terdaftar, silahkan masukan email yang benar.'
				]);
			}
		}
	}
}
