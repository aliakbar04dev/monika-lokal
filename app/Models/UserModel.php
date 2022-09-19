<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table			= 't_user';
	protected $primaryKey		= 'kode_user';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['kode_user_level', 'kode_user_level_temp', 'kode_jenis_member', 'client_id_komunitas', 'email_anggota', 
									'expire_date', 'expire_date_temp', 'username', 'tentang_saya', 'kota', 'password', 'jenis_kelamin', 
									'tanggal_lahir', 'website', 'alamat', 'forget_kode', 'photo', 'forget_expire', 'session_login', 
									'change_phone', 'phone_otp', 'phone_otp_exp', 'no_hp', 'paket_user', 'paket_user_temp', 'last_access'];
	protected $request;
	protected $db;
	protected $dt;

	public function getjenismember($email)
	{
		$data = $this->select('m.kode_jenis_member, m.jenis_member, disc_val')
			->join('m_jenis_member m', 'm.kode_jenis_member = t_user.kode_jenis_member')
			->join('disc_member d', 'd.kode_jenis_member = m.kode_jenis_member')
			->where('alamat_email', $email)->first();
		return $data;
	}

	public function getdetailuser($email)
	{
		return $this->select('nama_lengkap, alamat_email, email_anggota, client_id_komunitas, created_at, website, username, 
								tentang_saya, jenis_kelamin, alamat, tanggal_lahir, no_hp, kota, kode_referal, trial_expire')
			->where('alamat_email', $email)->first();
	}

	public function getuserlvl($email)
	{
		$data = $this->select('kode_user_level, kode_user_level_temp, expire_date, expire_date_temp, kode_referal')->where('alamat_email', $email)->first();

		return $data['kode_user_level'];
	}

	public function getallpackage($email){
		$data = array();

		$active = $this->select('m.alias_level, h.kode_harga_paket, t_user.kode_user_level, p.harga_paket, paket_user as nama_paket, t_user.expire_date as exp_date, trial_expire, "nontemp" as tipe')
						->join('m_user_level m', 'm.kode_user_level = t_user.kode_user_level')
						->join('t_pembayaran p', 'p.kode_pembayaran = t_user.paket_user','left')
						->join('harga_paket h', 'h.kode_user_level = t_user.kode_user_level')
						->where('alamat_email', $email)->first();

		$temp = $this->select('m.alias_level, h.kode_harga_paket, t_user.kode_user_level, p.harga_paket, paket_user_temp as nama_paket, t_user.expire_date_temp as exp_date, "temp" as tipe')
						->join('m_user_level m', 'm.kode_user_level = t_user.kode_user_level_temp')
						->join('t_pembayaran p', 'p.kode_pembayaran = t_user.paket_user','left')
						->join('harga_paket h', 'h.kode_user_level = t_user.kode_user_level')
						->where('alamat_email', $email)->first();
		
		array_push($data, $active);

		if (isset($temp['alias_level'])) {
			array_push($data, $temp);
		}

		return $data;
	}

	public function getusrdetaillvl($email)
	{
		$data = $this->select('kode_user, kode_user_level, kode_user_level_temp, expire_date, expire_date_temp, kode_referal, paket_user, paket_user_temp')->where('alamat_email', $email)->first();

		return $data;
	}

	public function getlocation()
	{
		$db = \Config\Database::connect();
		$builder = $db->table('wilayah_2020');

		return $builder->orderBy('nama', 'ASC')->get()->getResult();
	}

	public function updateuserpayment($kode_user, $kode_user_level, $expire_date, $kode_user_level_temp, $expire_date_temp, $paket_user, $paket_user_temp){
		$db = \Config\Database::connect();
		$builder = $db->table('t_user');
		
		$builder->set('kode_user_level', $kode_user_level);

		if($expire_date != ''){
			$builder->set('expire_date', $expire_date);
		}

		if($kode_user_level_temp != ''){
			$builder->set('kode_user_level_temp', $kode_user_level_temp);
		}

		if($expire_date_temp != ''){
			$builder->set('expire_date_temp', $expire_date_temp);
		}

		if($paket_user != ''){
			$builder->set('paket_user', $paket_user);
		}

		if($paket_user_temp != ''){
			$builder->set('paket_user_temp', $paket_user_temp);
		}

		$builder->where('kode_user', $kode_user);
		$builder->update();
	}

	public function updateRefCode($email, $refcode){
		$db = \Config\Database::connect();
		$builder = $db->table('t_user');

		$builder->set('kode_referal', $refcode);

		$builder->where('alamat_email', $email);
		$builder->update();
	}

	public function update_session($email, $sess){
		$ini = $this;

		$ini->set('session_login',$sess);
		$ini->where('alamat_email', $email);
		$ini->update();
	}
	
	public function update_lastaccess($email){
		date_default_timezone_set('Asia/Jakarta');
		
		$ini = $this;
		$ini->set('last_access', date('Y-m-d H:i:s'));
		$ini->where('alamat_email', $email);
		$ini->update();
	}

	public function upusrlvl($email)
	{
		$ini = $this;
		$usr = $ini->select('kode_user, kode_user_level, expire_date, kode_user_level_temp, expire_date_temp, trial_expire')->where('alamat_email', $email)->first();

		if ($usr['kode_user_level'] == 'MULV001') {
			$now = date('Y-m-d');

			if ($now > $usr['trial_expire']) {
				$data = [
					'kode_user_level' => 'MULV002',
				];

				$kode_user = $usr['kode_user'];

				$ini->update($kode_user, $data);
			}
		}else{
			$now 		= date('Y-m-d');
			$expire		= date('Y-m-d', strtotime($usr['expire_date']));
			$exptemp	= date('Y-m-d', strtotime($usr['expire_date_temp']));
			
			if($now > $expire){
				if($usr['kode_user_level_temp'] != ''){
					if($exptemp >= $now){
						$kode_user = $usr['kode_user_level_temp'];
						$expire_date = $exptemp;

						$data = [
							'kode_user_level'		=> $kode_user,
							'kode_user_level_temp'	=> '',
							'expire_date'			=> $expire_date,
						];
						
						$kode_user = $usr['kode_user'];
		
						$ini->update($kode_user, $data);
					}else{
						$data = [
							'kode_user_level' => 'MULV002',
						];
						
						$kode_user = $usr['kode_user'];
		
						$ini->update($kode_user, $data);
					}
				}else{
					$data = [
						'kode_user_level' => 'MULV002',
					];
					
					$kode_user = $usr['kode_user'];
	
					$ini->update($kode_user, $data);
				}
			}
		}
	}

	public function checksessionuser($email, $sess){
		$ini = $this;

		if($email != '' && $sess != ''){
			$usr = $ini->select('session_login')->where('alamat_email', $email)->first();

			if($usr['session_login'] != $sess){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
}