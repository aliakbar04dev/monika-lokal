<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotificationModel;

class Edit_profile extends BaseController
{
	public function __construct()
	{
		$this->usr = new UserModel();
		$this->ntf = new NotificationModel();
	}

	public function index()
	{
		if (hassession('email')) {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$data = $this->usr->getdetailuser(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);
				$location = $this->usr->getlocation();
				$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

				$data = array(
					'title' => 'Edit Profile',
					'd'		=> $data,
					'month'	=> $months,
					'loc'	=> $location,
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
				);
				return view('edit_profile/view_edit_profile', $data);
			}
		} else {
			return redirect()->to('/');
		}
	}

	public function changepassword()
	{
		if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();
				return redirect()->to('/');
			}else{
				$lvl	= $this->usr->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);
				$data = [
					'title' => 'Change Password',
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
				];
				return view('change_password/view_change_password', $data);
			}
		}
	}

	public function usernamecheck()
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
					$valid	= TRUE;
					$username 	= str_replace(' ', '', $this->request->getPost('username', FILTER_SANITIZE_STRING));

					$dataUser = $this->usr->like('username', $username)->findAll();

					$count = count($dataUser);

					if ($count > 0) {
						$valid = FALSE;
					}

					return json_encode([
						'valid'		=> $valid,
					]);
				}
			}else{
				$valid	= TRUE;
				$username 	= str_replace(' ', '', $this->request->getPost('username', FILTER_SANITIZE_STRING));

				$dataUser = $this->usr->like('username', $username)->findAll();

				$count = count($dataUser);

				if ($count > 0) {
					$valid = FALSE;
				}

				return json_encode([
					'valid'		=> $valid,
				]);
			}
		}
	}

	public function updateuserpassword()
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
					$email		= getsession('email');
					$oldpass	= md5($this->request->getPost('oldpass', FILTER_SANITIZE_STRING));
					$password	= $this->request->getPost('password', FILTER_SANITIZE_STRING);
					$repeat		= $this->request->getPost('repeat', FILTER_SANITIZE_STRING);

					if ($password == $repeat) {
						$usr = $this->usr->select('kode_user')->where('password', $oldpass)->where('alamat_email',$email)->first();

						if (!is_null($usr) && count($usr) > 0) {
							$kode_user = $usr['kode_user'];

							$data = [
								'password'		=> md5($password),
							];

							$this->usr->update($kode_user, $data);

							return json_encode([
								'success'		=> 1,
								'reason'		=> 'Update Password Berhasil',
								'description'	=> 'Password berhasil diperbaharui'
							]);
						} else {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Password Lama Salah',
								'description'	=> 'Masukkan Password Lama kamu dengan benar.'
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
		}
	}

	public function update()
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
					$username 	= substr(str_replace(' ', '', $this->request->getPost('username', FILTER_SANITIZE_STRING)), 0, 12);
					$mybio 		= substr($this->request->getPost('mybio', FILTER_SANITIZE_STRING), 0, 160);
					$location 	= $this->request->getPost('location', FILTER_SANITIZE_STRING);
					$gender 	= $this->request->getPost('gender', FILTER_SANITIZE_STRING);
					$day 		= $this->request->getPost('day', FILTER_SANITIZE_STRING);
					$month 		= $this->request->getPost('month', FILTER_SANITIZE_STRING);
					$year 		= $this->request->getPost('year', FILTER_SANITIZE_STRING);
					$website 	= $this->request->getPost('website', FILTER_SANITIZE_STRING);
					$phone 		= $this->request->getPost('phone', FILTER_SANITIZE_STRING);
					$address 	= $this->request->getPost('address', FILTER_SANITIZE_STRING);
					$email		= getsession('email');
					$kontoru    = '';
					$date		= '';

					if($username != ''){
						if (strlen($username) < 8) {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Short Username',
								'description'	=> 'Minimum 8 Character!!'
							]);
						}
					}

					if($day != '' && $month != '' && $year != ''){
						$date = date('Y-m-d', strtotime($day . '-' . $month . '-' . $year));

						if (!$this->validateDate($date)) {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Invalid Date',
								'description'	=> 'Please Insert Valid Date!!'
							]);
						}
					}

					$usr = $this->usr->where('alamat_email', $email)->first();

					if (!is_null($usr) && count($usr) > 0) {
						$kode_user = $usr['kode_user'];
						if ($usr['username'] != '') {
							$username = $usr['username'];
						} else {
							if($username != ''){
								$dusr = $this->usr->like('username', $username)
									->findAll();
								if (count($dusr) > 0) {
									return json_encode([
										'success'		=> 0,
										'reason'		=> 'Duplicate Username',
										'description'	=> 'Username already selected, please try another'
									]);
								}
							}
						}

						$data = [
							'username'		=> $username,
							'tentang_saya'	=> $mybio,
							'kota'			=> $location,
							'jenis_kelamin'	=> $gender,
							'website'		=> $website,
							'alamat'		=> $address,
						];

						if($date != ''){
							$data['tanggal_lahir'] = $date;
						}

						$this->usr->update($kode_user, $data);

						return json_encode([
							'success'		=> 1,
							'reason'		=> 'Update Berhasil',
							'description'	=> 'Data kamu berhasil diubah.',
						]);
					}
				}
			}
		}
	}

	public function getotpforchangephone(){
		if ($this->request->isAJAX()) {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();

				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			}else{
				$phone 		= $this->request->getPost('notelp', FILTER_SANITIZE_STRING);
				$phone		= preg_replace("/[^0-9]/", "", $phone);
				$phone		= (int)$phone;

				if(strlen($phone) < 9|| strlen($phone) > 12){
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Gagal Send OTP',
						'description'	=> 'Masukkan nomor hp yang benar'
						,
					]);
				}

				$phonedb	= '0'.$phone;
				$phone		= '+62'.$phone;

				$nohpdata	= $this->usr->select('no_hp')->where('no_hp', $phonedb)->findAll();

				if(count($nohpdata) > 0){
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Gagal Send OTP',
						'description'	=> 'No Hp Sudah Terdaftar, silahkan gunakan nomor lain'
						,
					]);
				}

				$email		= getsession('email');
				$usr		= $this->usr->select('client_id_komunitas, email_anggota, kode_user')->where('alamat_email', $email)->first();

				$otp 		= rand(100000, 999999);

				$kode_user	= $usr['kode_user'];
				$exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));

				$data = [
					'change_phone'	=> $phonedb,
					'phone_otp'		=> $otp,
					'phone_otp_exp'	=> $exp,
				];

				$this->usr->update($kode_user, $data);

				$this->sendotptouser($otp, $phone);
				
				return json_encode([
					'success'		=> 1,
					'reason'		=> 'Send Successfull',
					'description'	=> 'OTP Send Successfully'
					,
				]);
			}
		}
	}

	public function verifyotpcodeuser(){
		if ($this->request->isAJAX()) {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();

				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			}else{
				$code1 	= $this->request->getPost('code1', FILTER_SANITIZE_STRING);
				$code2 	= $this->request->getPost('code2', FILTER_SANITIZE_STRING);
				$code3 	= $this->request->getPost('code3', FILTER_SANITIZE_STRING);
				$code4 	= $this->request->getPost('code4', FILTER_SANITIZE_STRING);
				$code5 	= $this->request->getPost('code5', FILTER_SANITIZE_STRING);
				$code6 	= $this->request->getPost('code6', FILTER_SANITIZE_STRING);

				$otpcode = $code1.$code2.$code3.$code4.$code5.$code6;

				$email		= getsession('email');
				$usr		= $this->usr->select('change_phone, kode_user, phone_otp, phone_otp_exp')->where('alamat_email', $email)->first();

				$kode_user	= $usr['kode_user'];
				$phone		= $usr['change_phone'];
				$otpphone	= $usr['phone_otp'];
				$otpexp		= strtotime($usr['phone_otp_exp']);
				$now		= strtotime(date('Y-m-d H:i:s'));

				if($phone != '' && $otpphone != '' && $otpexp != ''){
					if($otpexp >= $now){
						if($otpcode == $otpphone){
							$data = [
								'no_hp'			=> $phone,
								'change_phone'	=> '',
								'phone_otp'		=> '',
							];
			
							$this->usr->update($kode_user, $data);

							return json_encode([
								'success'		=> 1,
								'reason'		=> 'Berhasil Verify OTP',
								'description'	=> 'Update nomor HP berhasil'
								,
							]);
						}else{
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Gagal Verify OTP',
								'description'	=> 'OTP salah, silahkan input ulang kembali kode OTP anda'
								,
							]);
						}
					}else{
						return json_encode([
							'success'		=> 0,
							'reason'		=> 'Gagal Verify OTP',
							'description'	=> 'OTP sudah expired silahkan request OTP lain'
							,
						]);
					}
				}else{
					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Error',
						'description'	=> 'Error',
					]);
				}
			}
		}
	}

	public function otpresenduser(){
		if ($this->request->isAJAX()) {
			if($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))){
				$this->session->destroy();

				return json_encode([
					'success'		=> 0,
					'reason'		=> 'Error',
					'description'	=> 'Error',
				]);
			}else{
				$email		= getsession('email');
				$usr		= $this->usr->select('change_phone, kode_user')->where('alamat_email', $email)->first();

				$now = date("Y-m-d H:i:s");
				$datetime1 = strtotime($now);
				$datetime2 = strtotime($usr['phone_otp_exp']);

				$interval  = abs($datetime2 - $datetime1);
				$minutes   = round($interval / 60);

				if($minutes <= 8){
					$otp 		= rand(100000, 999999);
					
					$kode_user	= $usr['kode_user'];
					$phone		= (int)$usr['change_phone'];
					$phone		= '+62'.$phone;
					$exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));

					$data = [
						'phone_otp'		=> $otp,
						'phone_otp_exp'	=> $exp,
					];

					$this->usr->update($kode_user, $data);

					$this->sendotptouser($otp, $phone);

					return json_encode([
						'success'		=> 1,
						'reason'		=> 'Send Successfull',
						'description'	=> 'OTP Send Successfully'
						,
					]);
				}else{
					return json_encode([
						'success'		=> 1,
						'reason'		=> 'Failed to send OTP',
						'description'	=> 'Wait 2 Minutes to re-send OTP'
						,
					]);
				}
			}
		}
	}

	public function updateuserphoto()
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
					if ($_FILES['file']['error'] > 0) {
						return json_encode([
							'success'		=> 0,
							'reason'		=> 'Image not uploaded',
							'description'	=> "There's a problem with upload service, please try again. Error Code : 001"
						]);
					} else {
						$filename 	= $_FILES['file']['name'];

						$ext 		= pathinfo($filename, PATHINFO_EXTENSION);
						$tmp 		= $_FILES['file']['tmp_name'];

						$email		= getsession('email');
						$usr 		= $this->usr->select('kode_user')->where('alamat_email', $email)->first();

						$kode_user	= $usr['kode_user'];

						$folder 	= hash('sha512', $email . $kode_user);
						$path 		= './public/assets/img/profil/' . $folder . '/';

						if (!is_dir($path)) {
							mkdir($path);
						}

						if (move_uploaded_file($tmp, $path . $email . '.' . $ext)) {
							$realpath = '/public/assets/img/profil/' . $folder . '/' . $email . '.' . $ext;

							$data = [
								'photo'	=> $realpath,
							];

							// var_dump($data); die;


							$this->usr->update($kode_user, $data);

							$this->session->set('photo', $realpath);

							return json_encode([
								'success'		=> 1,
								'path'			=> $realpath,
								'reason'		=> 'Berhasil Upload',
								'description'	=> 'Berhasil Upload'
							]);
						} else {
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Image not uploaded',
								'description'	=> "There's a problem with upload service, please try again. Error Code : 002"
							]);
						}

						/*if (!write_file('./public/assets/img/profil/'.$folder.'/' . $email . '.jpg', $gambar)) {
							return json_encode([
								'success'		=> 1,
								'reason'		=> 'Short Username',
								'description'	=> 'Minimum 8 Character!!'
							]);
						}else{
							return json_encode([
								'success'		=> 0,
								'reason'		=> 'Short Username',
								'description'	=> 'Minimum 8 Character!!'
							]);
						}*/
					}
				}
			}
		}
	}

	function sendotptouser($otp, $phone){
		$from       = "PanenSaham"; //Sender ID or SMS Masking Name, if leave blank, it will use default from telco
		$apikey     = "03f0394d9437b3e5c9163cd236e8a686-a97c4265-b5a1-4c45-a039-687ecc7397e1"; //get your API KEY from our sms dashboard
		$postUrl    = "https://api.smsviro.com/restapi/sms/1/text/advanced"; # DO NOT CHANGE THIS

		$text		= 'Kami menerima permintaan perubahan nomor handphone dari akun Monika PanenSaham anda. Masukkan kode otp untuk melanjutkan proses perubahan nomor handphone (Berlaku 10 Menit)'.$otp;

		$destination = array("to" => $phone);
		$message     = array("from" => $from,
							"destinations" => $destination,
							"text" => $text);
		$postData           = array("messages" => array($message));
		$postDataJson       = json_encode($postData);
		$ch                 = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Accept:application/json", 
													'Authorization: App '.$apikey)); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$responseBody = json_decode($response);
		
		/*
		$data = array(
			"responseCode" => 200,
			"responseDescription" => "Sms has been sent",
		);*/
		
		//echo json_encode($data);
		curl_close($ch);
	}

	function validateDate($date, $format = 'Y-m-d')
	{
		$d = \DateTime::createFromFormat($format, $date);
		// The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
		return $d && $d->format($format) === $date;
	}
}
