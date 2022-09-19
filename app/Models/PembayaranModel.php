<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PembayaranModel extends Model {
	protected $table			= 't_pembayaran';
	protected $primaryKey		= 'kode_pembayaran';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['kode_pembayaran', 'id_user', 'email_user', 'kode_paket', 'nama_paket', 'harga_paket', 'disc_per',
									'disc_val', 'langganan', 'total', 'created_at', 'pay_method', 'bank', 'number_code', 'expire_date',
									'status_pembayaran', 'description', 'bank_code', 'ref_code', 'extend_stats', 'service_charge', 'bulan'];
	protected $request;
    protected $db;
    protected $dt;
	
	public function getorderid(){
		$orderid = '';
		$cek = true;
		
		do{
			$date	= date('ymd');
			$prefix = 'APS'.$date;
			$kode 	=  '001';
			$get 	= $this->select('kode_pembayaran')->where('date(created_at)',$date)->countAll();
			
			$kode 	= intval($kode)+$get;
			$kode 	= str_pad($kode,3,"0",STR_PAD_LEFT);
			
			$orderid = $prefix.$kode;
			
			//$data = $this->where('kode_pembayaran',$orderid)->findAll();
			
			$data = [
				'kode_pembayaran' => $orderid,
			];
			
			$this->insert($data);
			$insert = $this->affectedRows();
			
			if ($insert > 0) {
				$cek = false;
			}
		}while($cek);
		
		return $orderid;
    }
	
	public function getallbilling($email, $status){
		if($email != ''){
			if($status != ''){
				if($status == 'pending'){
					$this->where('status_pembayaran',$status);
					$this->orWhere('status_pembayaran','payment');
				}else{
					$this->where('status_pembayaran',$status);
				}
				
			}

			return $this->select('kode_pembayaran, kode_paket, created_at, nama_paket, status_pembayaran, expire_date, number_code')
						->where('email_user',$email)
						->orderBy('created_at','DESC')->findAll();
		}
	}

	public function getdetailbiling($email, $kode){
		if($email != ''){
			return $this->select('kode_pembayaran, status_pembayaran, nama_paket, kode_paket, langganan, harga_paket, service_charge, total, t_pembayaran.expire_date, u.kode_referal, pay_method, bank, number_code, bank_code')
						->join('t_user u','u.alamat_email = t_pembayaran.email_user')
						->where('email_user',$email)
						->where('kode_pembayaran', $kode)->first();
		}
	}
	
	public function cekpendingsammepayment($iduser, $emailuser, $paket, $langganan){
		$date	= date('Y-m-d H:i:s');

		if ($langganan == 'tahun' || $langganan == 'bulan'){
			$get = $this->where('id_user',$iduser)
					->where('email_user',$emailuser)
					->where('kode_paket',$paket)
					->where('langganan',$langganan)
					->where('expire_date >=',$date)
					->where('status_pembayaran','payment')->first();
					
			return $get;
		}else{
			if($langganan == 'tigabulan'){
				$get = $this->where('id_user',$iduser)
					->where('email_user',$emailuser)
					->where('kode_paket',$paket)
					->where('langganan',$langganan)
					->where('bulan',3)
					->where('expire_date >=',$date)
					->where('status_pembayaran','payment')->first();
					
				return $get;
			}else if($langganan == 'enambulan'){
				$get = $this->where('id_user',$iduser)
					->where('email_user',$emailuser)
					->where('kode_paket',$paket)
					->where('langganan',$langganan)
					->where('bulan',6)
					->where('expire_date >=',$date)
					->where('status_pembayaran','payment')->first();
					
				return $get;
			}
		}
	}
	
	public function getuserlvl($orderid){
		return $this->select('langganan, id_user, kode_user_level, email_user, kode_paket, extend_stats, t_pembayaran.bulan')
					->join('harga_paket h', 'h.kode_harga_paket = t_pembayaran.kode_paket')
					->where('kode_pembayaran',$orderid)->first();
	}
}
?>