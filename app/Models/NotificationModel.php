<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class NotificationModel extends Model {
	protected $table			= 't_notif';
	protected $primaryKey		= 'kode_notif';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['kode_notif', 'email_user', 'tittle', 'description', 'created_at', 'is_seen'];
	protected $request;
    protected $db;
    protected $dt;
	
	public function getnotifid(){
		$date	= date('ymd');
		$prefix = 'NTF-'.$date;
		$kode 	=  '001';
        $get 	= $this->select('kode_notif')->where('created_at',$date)->countAll();
		
		$kode 	= intval($kode)+$get;
		$kode 	= str_pad($kode,3,"0",STR_PAD_LEFT);
		return $prefix.$kode;
	}
	
	public function getnotifserver($email, $lvl){
		if($lvl != 'MULV001' && $lvl != 'MULV002'){
			return $this->select('tittle, t_notif.id_notif, description, created_at, IFNULL(s.is_seen,0) AS seen', FALSE)
					->join('t_seen_notif s', 's.id_notif = t_notif.id_notif and s.email = "'.$email.'"', 'left')
					->where('email_user','')
					->orderBy('t_notif.created_at','DESC')->findAll(10,0);
		}else{
			return array();
		}
	}
	
	public function getnotifpayment($email, $lvl){
		if($lvl != 'MULV001' && $lvl != 'MULV002'){
			return $this->select('tittle, t_notif.id_notif, description, created_at, IFNULL(s.is_seen,0) AS seen', FALSE)
						->join('t_seen_notif s', 's.id_notif = t_notif.id_notif', 'left')
						->where('email_user',$email)
						->orderBy('t_notif.created_at','DESC')->findAll(10,0);
		}else{
			return array();
		}
	}
	
	public function getcount($ntf, $npy){
		$total = 0;
		
		if(!is_null($ntf) && count($ntf) > 0){
			foreach($ntf as $n){
				if($n['seen'] < 1){
					$total += 1;
				}
			}
		}
		
		if(!is_null($npy) && count($npy) > 0){
			foreach($npy as $n){
				if($n['seen'] < 1){
					$total += 1;
				}
			}
		}
		
		return $total;
		
		/*
		return $this->select('SUM(IFNULL(s.is_seen,0)) AS seen', FALSE)
					->join('t_seen_notif s', 's.id_notif = t_notif.id_notif', 'left')
					->where("(email_user='$email' or email_user='')")
					->orderBy('t_notif.created_at','DESC')
					->find(10,0);
		*/
	}
}
?>