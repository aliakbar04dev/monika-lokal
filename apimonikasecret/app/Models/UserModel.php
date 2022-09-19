<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 't_user';
    protected $primaryKey = 'kode_user';
	protected $allowedFields = ['kode_user', 'kode_user_level', 'kode_jenis_member', 'username', 'nama_lengkap', 'kota',
								'alamat_email', 'password', 'no_hp', 'kode_referal', 'client_id_komunitas', 'email_anggota',
								'photo', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'website', 'alamat', 'tentang_saya',
								'is_verif', 'trial_expire', 'expire_date', 'forget_kode', 'forget_expire', 'verif_kode', 'imei_code', 'decode',
								'regis_no_hp', 'regis_otp', 'regis_otp_exp'];
}
