<?php namespace App\Models;
use CodeIgniter\Model;

class ApiModel extends Model {
    protected $table = 't_notif';
	protected $primaryKey = 'kode_notif';
    protected $allowedFields = ['kode_notif', 'tittle', 'description', 'created_at', 'is_broadcast'];

    /* public function login($mail){
        return $this->join('m_user_level', 't_user.kode_user_level = m_user_level.kode_user_level', 'left')
                    ->where(['t_user.alamat_email' => $mail])->find();
    } */
}