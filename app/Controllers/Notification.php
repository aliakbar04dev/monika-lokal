<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PembayaranModel;
use App\Models\PricingModel;
use App\Models\NotificationModel;
use App\Models\SeenModel;
use App\Models\PoinModel;
use CodeIgniter\Controller;

class Notification extends BaseController
{
	public function __construct()
	{
		$this->pay = new PembayaranModel();
		$this->notif = new NotificationModel();
		$this->price = new PricingModel();
		$this->user = new UserModel();
		$this->seen = new SeenModel();
		$this->poin = new PoinModel();
	}
	
	public function marksnotifread(){
		if ($this->request->isAJAX()) {
			$list	= $this->request->getPost('list', FILTER_SANITIZE_STRING);
			$email	= getsession('email');
			$user 	= $this->user->where('alamat_email', $email)->first();
			$kode 	= 'NTF-'.$user['kode_user'].'-';
			$count	= $this->seen->select('id_seen')->like('id_seen',$kode)->countAll();
			
			foreach($list as $l){
				$cek = $this->seen->select('id_seen')->where('id_notif',$l['itemId'])->where('email',$email)->first();
				
				if(!isset($cek['id_seen'])){
					$id = $kode.$total;
				
					$seen = [
						'id_seen' 	=> $id,
						'id_notif'	=> $l['itemId'],
						'email'		=> $email,
						'is_seen'	=> 1,
					];
					
					$this->seen->insert($seen);
					
					$total+=1;
				}
			}
			
			return json_encode([
				'success'		=> $total,
			]);
		}
	}
	
	public function midtransnotif(){
		$json 		= file_get_contents('php://input');
		$d 			= json_decode($json, true);
		
		if(!is_null($d) && count($d) > 0){
			$orderid 		= $d['order_id'];
			$status_code 	= $d['status_code'];
			$gross_amount 	= $d['gross_amount'];
			$gabung			= $orderid.$status_code.$gross_amount.SERVERKEY;
			$hash			= hash('sha512',$gabung);
			$paydata		= '';
			$ntfdata		= '';
			
			if($hash === $d['signature_key']){
				$urlvl 	= $this->pay->getuserlvl($orderid);
				$email 	= $urlvl['email_user'];
				$bank	= '-';
				$vanum 	= '-';
				$bankcode = '-';

				if(isset($d['va_numbers'])){
					$bank = $d['va_numbers'][0]['bank'];
					$vanum = $d['va_numbers'][0]['va_number'];
				}
				
				if(isset($d['bank'])){
					$bank = $d['bank'];
				}
				
				if(isset($d['payment_code'])){
					$vanum = $d['payment_code'];
				}

				if(isset($d['bill_key'])){
					$vanum = $d['bill_key'];
				}

				if(isset($d['biller_code'])){
					$bankcode = $d['biller_code'];
				}
				
				if($d['transaction_status'] == 'settlement' || $d['transaction_status'] == 'capture'){
					$iduser 			= $urlvl['id_user'];
					$datausr			= $this->user->getusrdetaillvl($email);
					$userlvl			= $datausr['kode_user_level'];
					$paketlvl			= $urlvl['kode_user_level'];
					$paketlvltemp		= '';
					$poin				= 1;
					$title 				= 'Pembayaran dengan nomor : '.$orderid.' telah berhasil!!';
					$description 		= 'Pembayaran dengan nomor : '.$orderid.' telah berhasil, Terimakasih telah mempercayai Monika sebagai platform saham anda!!, Selamat menikmati berbagai fitur dari kami.'; 
					$expire				= '';
					$expire_date		= '';
					$expire_date_temp 	= '';
					$refdata			= $this->user->select('m.kode_referal')->join('m_referal m', 'm.kode_referal = t_user.kode_referal')->where('kode_user',$iduser)->first();
					$now 				= date('Y-m-d');
					$usrexpire			= date("Y-m-d", strtotime($datausr['expire_date']));
					$paket_user			= $orderid;
					$paket_user_temp	= '';
					$extend				= $urlvl['extend_stats'];

					if($urlvl['langganan'] == 'tahun'){
						$expire = 12;
						$poin	= 12;
					}else if($urlvl['langganan'] == 'bulan'){
						$expire = 1;
					}else if($urlvl['langganan'] == 'lainnya'){
						if($urlvl['bulan'] == 3){
							$expire = 3;
							$poin	= 3;
						}else if($urlvl['bulan'] == 6){
							$expire = 6;
							$poin	= 6;
						}else{
							$expire = 1;
						}
					}
					
					$paydata = [
						'status_pembayaran' => 'settlement',
						'description'		=> $d['status_message'],
						'pay_method'		=> $d['payment_type'],
						'bank'				=> $bank,
						'number_code'		=> $vanum,
					];
					
					$this->pay->update($orderid, $paydata);

					//Cek expire paket
					if($extend == 'extendnontemp'){
						if($now > $usrexpire){
							$expire_date = $this->endCycle($now, $expire);
						}else{
							$expire_date = $this->endCycle($usrexpire, $expire);
						}
					}else{
						if($now > $usrexpire){
							//Paket Expired
							$usrkodetemp		= $datausr['kode_user_level_temp'];
							$usrexptemp			= date("Y-m-d", strtotime($datausr['expire_date_temp']));
							$paket_user_temp	= $datausr['paket_user_temp'];;
	
							//Cek kode temporary
							if($usrkodetemp != ''){
								//Cek expired temporary paket
								if($usrexptemp >= $now){
									//Temporary paket belum expired
									//ubah user level yg sudah expired ke temp yang belum expired
									$userlvl = $usrkodetemp;
									$paket_user = $paket_user_temp;
	
									//cek user level untuk free upgrade ke ultimate
									if($userlvl == 'MULV003' || $userlvl == 'MULV004'){
										//user level adalah paket TA or paket FA
										//Cek paket yang diambil untuk free upgrade ke ultimate
										if(($userlvl == 'MULV003' && $paketlvl == 'MULV004') || ($userlvl == 'MULV004' && $paketlvl == 'MULV003')){
											//dapet free upgrade ultimate dan pindahkan expired temp ke non temp (user lvel temp tidak berguna karena upgrade ke ultimate)
											$paketlvltemp			= $paketlvl;
											$paketlvl				= 'MULV005';
											$expire_date 			= $usrexptemp;
											$expire_date_temp		= $this->endCycle($now, $expire);
											$paket_user_temp		= $orderid;
										}else{
											//ga dapet free upgrade (Beli paket ultimate), hapus user level temp (karena beli ultimate), dan tambah expired temp menjadi yang dibeli
											$expire_date = $this->endCycle($usrexptemp, $expire);
										}
									}else{
										//User level adalah paket biasa or ultimate, hapus user level temp (Gaguna juga), dan tambah expired temp menjadi yang dibeli
										$expire_date = $this->endCycle($usrexptemp, $expire);
									}
								}else{
									//Temporary paket sudah expired, ibarat beli paket pada saat user biasa
									$expire_date = $this->endCycle($now, $expire);
								}
							}else{
								//Kode temporary kosong yang artinya : paket memang benar sudah expired
								$expire_date = $this->endCycle($now, $expire);
							}
						}else{
							//Paket masih berlangsung
							//cek user level untuk free upgrade ke ultimate
							if($userlvl == 'MULV003' || $userlvl == 'MULV004'){
								//user level adalah paket TA or paket FA
								//Cek paket yang diambil untuk free upgrade ke ultimate
								if(($userlvl == 'MULV003' && $paketlvl == 'MULV004') || ($userlvl == 'MULV004' && $paketlvl == 'MULV003')){
									//dapat free upgrade ke ultimate
									$paketlvltemp			= $paketlvl;
									$paketlvl				= 'MULV005';
									$expire_date_temp		= $this->endCycle($now, $expire);
									$paket_user_temp		= $orderid;
								}else{
									//Ga dapat ultimate
									$expire_date = $this->endCycle($usrexpire, $expire);
								}
							}else{
								//User level adalah paket biasa (Ultimate tidak mungkin karena gabisa beli paket yg sedang berjalan)
								$expire_date = $this->endCycle($usrexpire, $expire);
							}
						}
					}

					$kode_user_level 		= $paketlvl;
					$kode_user_level_temp	= $paketlvltemp;
					
					$this->user->updateuserpayment($iduser, $kode_user_level, $expire_date, $kode_user_level_temp, $expire_date_temp, $paket_user, $paket_user_temp);
					
					$kode_notif = $this->notif->getnotifid();
					$ntfdata = [
						'kode_notif'	=> $kode_notif,
						'email_user'	=> $email,
						'tittle' 		=> $title,
						'description'	=> $description,
						'created_at'	=> date('Y-m-d H:i:s'),
					];
					
					$this->notif->insert($ntfdata);
					
					if(!is_null($refdata) && count($refdata) > 0){
						$pointdata = [
							'kode_referal'		=> $refdata['kode_referal'],
							'kode_user'			=> $iduser,
							'kode_harga_paket' 	=> $urlvl['kode_paket'],
							'reward_poin'		=> $poin,
							'insert_date'		=> date('Y-m-d H:i:s'),
						];
						
						$this->poin->insert($pointdata);
					}

					return json_encode([
						'result'	=> 'OK Settlement',
					]);
					
				}else if($d['transaction_status'] == 'pending'){
					$title 			= 'Pembayaran dengan nomor : '.$orderid.' dalam status pending!!';
					$description 	= 'Pembayaran anda dengan nomor : '.$orderid.' dalam status pending, silahkan lakukan pembayaran.';
					
					$paydata = [
						'status_pembayaran' => 'pending',
						'pay_method'		=> $d['payment_type'],
						'description'		=> $d['status_message'],
						'bank'				=> $bank,
						'number_code'		=> $vanum,
						'bank_code'			=> $bankcode,
					];
					
					$kode_notif = $this->notif->getnotifid();
					$ntfdata = [
						'kode_notif'	=> $kode_notif,
						'email_user'	=> $email,
						'tittle' 		=> $title,
						'description'	=> $description,
						'created_at'	=> date('Y-m-d H:i:s'),
					];
					
					$this->pay->update($orderid, $paydata);
					$this->notif->insert($ntfdata);
					
				}else if($d['transaction_status'] == 'deny'){
					$title 			= 'Pembayaran dengan nomor : '.$orderid.' telah ditolak!!';
					$description 	= 'Pembayaran dengan nomor : '.$orderid.' anda telah ditolak, silahkan konsultasi dengan pihak bank anda.';
					
					$paydata = [
						'status_pembayaran' => 'deny',
						'pay_method'		=> $d['payment_type'],
						'description'		=> $d['status_message'],
						'bank'				=> $bank,
						'number_code'		=> $vanum,
					];
					
					$kode_notif = $this->notif->getnotifid();
					$ntfdata = [
						'kode_notif'	=> $kode_notif,
						'email_user'	=> $email,
						'tittle' 		=> $title,
						'description'	=> $description,
						'created_at'	=> date('Y-m-d H:i:s'),
					];
					
					$this->pay->update($orderid, $paydata);
					$this->notif->insert($ntfdata);
					
				}else if($d['transaction_status'] == 'cancel'){
					$title 			= 'Invoice dengan nomor : '.$orderid.' telah dicancel!!';
					$description 	= 'Pembayaran anda dengan nomor : '.$orderid.' telah dicancel. Maaf jika tidak ada paket yang sesuai dengan keinginan anda, semoga anda menemukan paket pilihan anda.';
					
					$paydata = [
						'status_pembayaran' => 'cancel',
						'pay_method'		=> $d['payment_type'],
						'description'		=> $d['status_message'],
						'bank'				=> $bank,
						'number_code'		=> $vanum,
					];
					
					$kode_notif = $this->notif->getnotifid();
					$ntfdata = [
						'kode_notif'	=> $kode_notif,
						'email_user'	=> $email,
						'tittle' 		=> $title,
						'description'	=> $description,
						'created_at'	=> date('Y-m-d H:i:s'),
					];
					
					$this->pay->update($orderid, $paydata);
					$this->notif->insert($ntfdata);
					
				}else if($d['transaction_status'] == 'expire'){
					$title 			= 'Invoice dengan nomor : '.$orderid.' telah Expired!!';
					$description 	= 'Invoice dengan nomor : '.$orderid.' telah expired';
					
					$paydata = [
						'status_pembayaran' => 'expire',
						'pay_method'		=> $d['payment_type'],
						'description'		=> $d['status_message'],
						'bank'				=> $bank,
						'number_code'		=> $vanum,
					];
					
					$kode_notif = $this->notif->getnotifid();
					$ntfdata = [
						'kode_notif'	=> $kode_notif,
						'email_user'	=> $email,
						'tittle' 		=> $title,
						'description'	=> $description,
						'created_at'	=> date('Y-m-d H:i:s'),
					];
					
					$this->pay->update($orderid, $paydata);
					$this->notif->insert($ntfdata);
					
				}
			}
		}
	}
	
	public function midtransnotiftest(){
		$json 		= file_get_contents('php://input');
		$d 			= json_decode($json, true);
		
		if(!is_null($d) && count($d) > 0){
			$orderid 		= $d['order_id'];
			$status_code 	= $d['status_code'];
			$gross_amount 	= $d['gross_amount'];
			$gabung			= $orderid.$status_code.$gross_amount.SERVERKEY;
			$hash			= hash('sha512',$gabung);
			$paydata		= '';
			$ntfdata		= '';
			
			if($hash === $d['signature_key']){
				$urlvl 	= $this->pay->getuserlvl($orderid);
				$email 	= $urlvl['email_user'];
				$bank	= '-';
				$vanum 	= '-';
				$bankcode = '-';

				if(isset($d['va_numbers'])){
					$bank = $d['va_numbers'][0]['bank'];
					$vanum = $d['va_numbers'][0]['va_number'];
				}
				
				if(isset($d['bank'])){
					$bank = $d['bank'];
				}
				
				if(isset($d['payment_code'])){
					$vanum = $d['payment_code'];
				}

				if(isset($d['bill_key'])){
					$vanum = $d['bill_key'];
				}

				if(isset($d['biller_code'])){
					$bankcode = $d['biller_code'];
				}
				
				if($d['transaction_status'] == 'settlement' || $d['transaction_status'] == 'capture'){
					$iduser 			= $urlvl['id_user'];
					$datausr			= $this->user->getusrdetaillvl($email);
					$userlvl			= $datausr['kode_user_level'];
					$paketlvl			= $urlvl['kode_user_level'];
					$paketlvltemp		= '';
					$poin				= 1;
					$title 				= 'Pembayaran dengan nomor : '.$orderid.' telah berhasil!!';
					$description 		= 'Pembayaran dengan nomor : '.$orderid.' telah berhasil, Terimakasih telah mempercayai Monika sebagai platform saham anda!!, Selamat menikmati berbagai fitur dari kami.'; 
					$expire				= '';
					$expire_date		= '';
					$expire_date_temp 	= '';
					$refdata			= $this->user->select('m.kode_referal')->join('m_referal m', 'm.kode_referal = t_user.kode_referal')->where('kode_user',$iduser)->first();
					$now 				= date('Y-m-d');
					$usrexpire			= date("Y-m-d", strtotime($datausr['expire_date']));
					$paket_user			= $orderid;
					$paket_user_temp	= '';
					$extend				= $urlvl['extend_stats'];

					if($urlvl['langganan'] == 'tahun'){
						$expire = 12;
						$poin	= 12;
					}else{
						$expire = 1;
					}
					
					$paydata = [
						'status_pembayaran' => 'settlement',
						'description'		=> $d['status_message'],
						'pay_method'		=> $d['payment_type'],
						'bank'				=> $bank,
						'number_code'		=> $vanum,
					];
					
					//$this->pay->update($orderid, $paydata);
					
					/*
					$usrdata = [
						'kode_user_level' => $paketlvl,
						'expire_date' 	=> 'DATE_ADD( COALESCE(expire_date,CURDATE()), INTERVAL 1 '.$expire.')',
					];
					
					$this->user->update($iduser, $usrdata);
					*/

					//Cek expire paket
					if($extend == 'extendnontemp'){
						if($now > $usrexpire){
							$expire_date = $this->endCycle($now, $expire);
						}else{
							$expire_date = $this->endCycle($usrexpire, $expire);
						}
					}else{
						if($now > $usrexpire){
							//Paket Expired
							$usrkodetemp		= $datausr['kode_user_level_temp'];
							$usrexptemp			= date("Y-m-d", strtotime($datausr['expire_date_temp']));
							$paket_user_temp	= $datausr['paket_user_temp'];;
	
							//Cek kode temporary
							if($usrkodetemp != ''){
								//Cek expired temporary paket
								if($usrexptemp >= $now){
									//Temporary paket belum expired
									//ubah user level yg sudah expired ke temp yang belum expired
									$userlvl = $usrkodetemp;
									$paket_user = $paket_user_temp;
	
									//cek user level untuk free upgrade ke ultimate
									if($userlvl == 'MULV003' || $userlvl == 'MULV004'){
										//user level adalah paket TA or paket FA
										//Cek paket yang diambil untuk free upgrade ke ultimate
										if(($userlvl == 'MULV003' && $paketlvl == 'MULV004') || ($userlvl == 'MULV004' && $paketlvl == 'MULV003')){
											//dapet free upgrade ultimate dan pindahkan expired temp ke non temp (user lvel temp tidak berguna karena upgrade ke ultimate)
											$paketlvltemp			= $paketlvl;
											$paketlvl				= 'MULV005';
											$expire_date 			= $usrexptemp;
											$expire_date_temp		= $this->endCycle($now, $expire);
											$paket_user_temp		= $orderid;
										}else{
											//ga dapet free upgrade (Beli paket ultimate), hapus user level temp (karena beli ultimate), dan tambah expired temp menjadi yang dibeli
											$expire_date = $this->endCycle($usrexptemp, $expire);
										}
									}else{
										//User level adalah paket biasa or ultimate, hapus user level temp (Gaguna juga), dan tambah expired temp menjadi yang dibeli
										$expire_date = $this->endCycle($usrexptemp, $expire);
									}
								}else{
									//Temporary paket sudah expired, ibarat beli paket pada saat user biasa
									$expire_date = $this->endCycle($now, $expire);
								}
							}else{
								//Kode temporary kosong yang artinya : paket memang benar sudah expired
								$expire_date = $this->endCycle($now, $expire);
							}
						}else{
							//Paket masih berlangsung
							//cek user level untuk free upgrade ke ultimate
							if($userlvl == 'MULV003' || $userlvl == 'MULV004'){
								//user level adalah paket TA or paket FA
								//Cek paket yang diambil untuk free upgrade ke ultimate
								if(($userlvl == 'MULV003' && $paketlvl == 'MULV004') || ($userlvl == 'MULV004' && $paketlvl == 'MULV003')){
									//dapat free upgrade ke ultimate
									$paketlvltemp			= $paketlvl;
									$paketlvl				= 'MULV005';
									$expire_date_temp		= $this->endCycle($now, $expire);
									$paket_user_temp		= $orderid;
								}else{
									//Ga dapat ultimate
									$expire_date = $this->endCycle($usrexpire, $expire);
								}
							}else{
								//User level adalah paket biasa (Ultimate tidak mungkin karena gabisa beli paket yg sedang berjalan)
								$expire_date = $this->endCycle($usrexpire, $expire);
							}
						}
					}

					$kode_user_level 		= $paketlvl;
					$kode_user_level_temp	= $paketlvltemp;

					//$this->user->updateuserpayment($iduser, $kode_user_level, $expire_date, $kode_user_level_temp, $expire_date_temp, $paket_user, $paket_user_temp);

					return json_encode([
						'iduser'		=> $iduser,
						'kode_user_level'	=> $kode_user_level,
						'expire_date'		=> $expire_date,
						'kode_user_level_temp'	=> $kode_user_level_temp,
						'expire_date_temp'		=> $expire_date_temp,
					]);
				}
			}
		}
	}
	
	function endCycle($d1, $months)
    {
        $date = new \DateTime($d1);

        // call second function to add the months
		$addmonthns	= $this->add_months($months, $date);
        $newDate = $date->add($addmonthns);

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new \DateInterval('P1D')); 

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }

	function add_months($months, \DateTime $dateObject) {
        $next = new \DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new \DateInterval('P'.$months.'M');
        }
    }
}
?>