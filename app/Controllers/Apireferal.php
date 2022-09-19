<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Apireferal extends BaseController
{
	use ResponseTrait;
	
	function getAll($kode){
        $db      = \Config\Database::connect();
        $builder = $db->table('t_user');
        $builder->select('t_user.kode_referal, t_user.nama_lengkap, t_user.alamat_email, t_user.no_hp, t_user.created_at, t_user.trial_expire, m_user_level.alias_level, t_user.expire_date');
        $builder->join('m_user_level', 'm_user_level.kode_user_level = t_user.kode_user_level', 'left');
        $builder->join('m_jenis_member', 'm_jenis_member.kode_jenis_member = t_user.kode_jenis_member', 'left');
        $builder->where('t_user.kode_referal', $kode);
        $query   = $builder->get()->getResultArray();

        if ($query) {
            $response = [
                'status' => 200,
                'messages' => 'Data API Kode Referal User',
                'data' => $query
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}


    function mGetTokenFr($kode_user, $token_fr){
        $db      = \Config\Database::connect();
        $builder = $db->table('t_user');
        $builder->select('t_user.kode_user, t_user.token_fr');
        $builder->where('t_user.kode_user', $kode_user);
        $query   = $builder->countAllResults();

        $data = [
            'kode_user' => $kode_user,
            'token_fr' => $token_fr
        ];

        if ($query > 0) {
            $tabelUser = $db->table('t_user');
            $tabelUser->where('kode_user', $kode_user);
            $tabelUser->update($data);

            $response = [
                'status' => 200,
                'error' => FALSE,
                'messages' => 'Token Firebase Berhasil Diperbarui',
                'data' => $data
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'User Tidak Ditemukan'
            ];
            return $this->respondCreated($response);
        }
	}
}