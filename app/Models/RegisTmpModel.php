<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class RegisTmpModel extends Model {
	protected $table			= 't_user_temp';
	protected $primaryKey		= 'kode_user';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['kode_user', 'kode_user_level', 'kode_jenis_member', 'username', 'client_id_komunitas', 'email_anggota',
									'nama_lengkap', 'photo', 'alamat_email', 'password', 'no_hp', 'kota', 'kode_referal', 'jenis_kelamin',
									'tempat_lahir', 'tanggal_lahir', 'website', 'alamat', 'tentang_saya', 'created_at', 'verif_kode',
									'is_verif', 'trial_expire', 'expire_date', 'regis_no_hp', 'regis_otp', 'regis_otp_exp'];
	protected $request;
    protected $db;
    protected $dt;
}
?>