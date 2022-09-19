<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserTmpModel;
use App\Models\AnggotaModel;
use App\Models\KomunitasModel;
use App\Models\ReferalModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class User extends BaseController
{
	use ResponseTrait;

	public function get()
    {
        $key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$email = $this->request->getGet("inputan");
				$pass  = $this->request->getGet("password");
				
				if ($email != '' && $pass != '') {
					$data = $userModel->where("alamat_email", $email)
									  ->orWhere("no_hp", $email)
									  ->first();
									
					if (!empty($data))
					{
						$dt = array(
							'decode' => $pass,
						);
						
						$userModel->update($data['kode_user'], $dt);
				
						if ($data['kode_user_level'] == "MULV006")
						{
							$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'User unauthorized acess this feature'
							];
							return $this->respondCreated($response);
						}
						else
						{
							if (md5($pass) != $data['password'])
							{
								$response = [
									'status' => 500,
									'error' => TRUE,
									'messages' => 'Invalid password'
								];
								return $this->respondCreated($response);
							}
							else
							{
								$response = [
									'status' => 200,
									'error' => FALSE,
									'messages' => 'User detail',
									'data' => $data
								];
								return $this->respondCreated($response);
							}
						}
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'User not found'
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Incorrect username or password'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
    }
	
	public function getByMail()
    {
        $key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$email = $this->request->getGet("email");
				
				if ($email != '') {
					$data = $userModel->where("alamat_email", $email)
									  ->orWhere("no_hp", $email)
									  ->first();
									
					if (!empty($data))
					{
						if ($data['kode_user_level'] == "MULV006")
						{
							$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'User unauthorized acess this feature'
							];
							return $this->respondCreated($response);
						}
						else
						{
							$response = [
									'status' => 200,
									'error' => FALSE,
									'messages' => 'User detail',
									'data' => $data
							];
							return $this->respondCreated($response);
						}
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'User not found'
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Incorrect email address'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
    }

	public function getProfile()
    {
        $key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$kode = $this->request->getGet("kodeuser");
				
				if ($kode != '') {
					$data = $userModel->where("kode_user", $kode)
									  ->first();
									
					if (!empty($data))
					{
						$today = Date('Y-m-d');
						$level = $data['kode_user_level'];
						$expdate = $data['expire_date'];
						
						if ($level == 'MULV001')
						{
							if ($today > $data['trial_expire'])
							{
								$item = array(
									'kode_user_level' => 'MULV002',
								);
								
								$userModel->update($kode, $item);
							}
						}
						else
						{
							if ($today > $expdate)
							{
								$item = array(
									'kode_user_level' => 'MULV002',
								);
								
								$userModel->update($kode, $item);
							}
						}
					
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'User detail',
							'data' => $data
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'User not found'
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Incorrect username or password'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
    }
	
	public function getExpDate()
    {
        $key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$kode = $this->request->getGet("kodeuser");
				
				if ($kode != '') {
					$data = $userModel->where("kode_user", $kode)
									  ->first();
									
					if (!empty($data))
					{
						$user    = $data['nama_lengkap'];
						if ($data['expire_date'] != '0000-00-00')
						{
							$expdate = date("d-m-Y", strtotime($data['expire_date']));
						}
						else
						{
							$expdate = $data['expire_date'];
						}
						
						$pesan = "Hei " . $user . ", masa berlaku paketmu sampai dengan tgl " . $expdate;
						$tgl = date("Y-m-d H:i:s");
						
						$output = array(
							'pesan' => $pesan,
							'tanggal' => $tgl,
						);

						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Notifikasi exp date',
							'data' => $output,
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'User not found'
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Incorrect username or password'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
    }
	
	function getAnggota(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$anggotaModel = new AnggotaModel();
				$email = $this->request->getGet("email");
				$data = $anggotaModel->where("email", $email)->first();
				
				if (!empty($data)){
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data found',
					];
						
					return $this->respondCreated($response);
					}
				else {
					$response = [
						'status' => 500,
						'error' => FALSE,
						'messages' => 'Data not found',
					];
						
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	function getKomunitas(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$komunitasModel = new KomunitasModel();
				$clientid = $this->request->getGet("client_id");
				$data = $komunitasModel->where("client_id", $clientid)->first();
				
				if (!empty($data)){
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data found',
					];
						
					return $this->respondCreated($response);
					}
				else {
					$response = [
						'status' => 500,
						'error' => FALSE,
						'messages' => 'Data not found',
					];
						
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	function getReferal(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$referalModel = new ReferalModel();
				$koderef = $this->request->getGet("kode_referal");
				$data = $referalModel->where("kode_referal", $koderef)->first();
				
				if (!empty($data)){
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data found',
					];
						
					return $this->respondCreated($response);
					}
				else {
					$response = [
						'status' => 500,
						'error' => FALSE,
						'messages' => 'Data not found',
					];
						
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	/*public function insert()
	{
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$anggotaModel = new AnggotaModel();
				$komunitasModel = new KomunitasModel();
				$referalModel = new ReferalModel();

                $gen  = "TUSR" . str_pad(time(), 3, 0, STR_PAD_LEFT);
				
				$today = date('Y-m-d');
				$j_member = $this->request->getVar('kode_jenis_member');
				$username = $this->request->getVar('username');
				$nama = $this->request->getVar('nama');
				$kota= $this->request->getVar('kota');
				$email = $this->request->getVar('email');
				$password = $this->request->getVar('password');
				$no_hp = $this->request->getVar('no_hp');
				$kode_referal = $this->request->getVar('kode_referal');
				$client_id = $this->request->getVar('client_id');
				$email_anggota = $this->request->getVar('email_anggota');
				
				if ($j_member != '' && $username != '' && $nama != '' && $email != '' && $password != '' && $no_hp != '')
				{
					$verifyhp = $userModel->select('*')->where('no_hp', $no_hp)->first();
					$verifymail = $userModel->select('*')->where('alamat_email', $email)->first();

					if (!empty($verifyhp)){
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Phone Number has been registered'
						];
						return $this->respondCreated($response);
					}
					else if (!empty($verifymail)) {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Email address has been registered'
						];
						return $this->respondCreated($response);
					}
					else {
						if ($kode_referal != '')
						{
							if ($email_anggota != '')
							{
								if ($client_id != '')
								{
									//return $this->respondCreated("Anggota keduanya dengan kode referal");
									$verifyreferal = $referalModel->select('*')->where('kode_referal', $kode_referal)->first();
									$verifycoperation = $anggotaModel->select('*')->where('email', $email_anggota)->first();
									$verifycommunity = $komunitasModel->select('*')->where('client_id', $client_id)->first();

									if (empty($verifyreferal)){
										$response = [
											'status' => 500,
											'error' => TRUE,
											'messages' => 'Referal code not verified'
										];
										return $this->respondCreated($response);
									}
									else if (empty($verifycoperation)){
										$response = [
											'status' => 500,
											'error' => TRUE,
											'messages' => 'Member coperation not verified'
										];
										return $this->respondCreated($response);
									}
									else if (empty($verifycommunity)){
										$response = [
											'status' => 500,
											'error' => TRUE,
											'messages' => 'Member community not verified'
										];
										return $this->respondCreated($response);
									} 
									else {
										$data = array(
											'kode_user' => $gen,
											'kode_user_level' => 'MULV001',
											'kode_jenis_member' => $j_member,
											'username' => $username,
											'nama_lengkap' => $nama,
											'kota' => $kota,
											'alamat_email' => $email,
											'password' => md5($password),
											'no_hp' => $no_hp,
											'kode_referal' => $kode_referal,
											'client_id_komunitas' => $client_id,
											'email_anggota' => $email_anggota,
											'trial_expire' => date('Y-m-d', strtotime($today . ' + 3 days')),
											'is_verif' => 0,
										);
																
										$userModel->insert($data);
														
										$response = [
											'status' => 200,
											'error' => FALSE,
												'messages' => 'Data has created',
											];
										return $this->respondCreated($response);
									}
								}
							
								//return $this->respondCreated("Anggota dengan kode referal");
								$verifyreferal = $referalModel->select('*')->where('kode_referal', $kode_referal)->first();
								$verifycoperation = $anggotaModel->select('*')->where('email', $email_anggota)->first();

								if (empty($verifyreferal)){
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Referal code not verified'
									];
									return $this->respondCreated($response);
								}
								else if (empty($verifycoperation)){
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Member coperation not verified'
									];
									return $this->respondCreated($response);
								}
								else {
									$data = array(
										'kode_user' => $gen,
										'kode_user_level' => 'MULV001',
										'kode_jenis_member' => $j_member,
										'username' => $username,
										'nama_lengkap' => $nama,
										'kota' => $kota,
										'alamat_email' => $email,
										'password' => md5($password),
										'no_hp' => $no_hp,
										'kode_referal' => $kode_referal,
										'client_id_komunitas' => $client_id,
										'email_anggota' => $email_anggota,
										'trial_expire' => date('Y-m-d', strtotime($today . ' + 3 days')),
										'is_verif' => 0,
									);
															
									$userModel->insert($data);
													
									$response = [
										'status' => 200,
										'error' => FALSE,
											'messages' => 'Data has created',
										];
									return $this->respondCreated($response);
								}
							}
							else if ($client_id != '')
							{
								//return $this->respondCreated("Komunitas dengan kode referal");
								$verifyreferal = $referalModel->select('*')->where('kode_referal', $kode_referal)->first();
								$verifycommunity = $komunitasModel->select('*')->where('client_id', $client_id)->first();

								if (empty($verifyreferal)){
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Referal code not verified'
									];
									return $this->respondCreated($response);
								}
								else if (empty($verifycommunity)){
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Member community not verified'
									];
									return $this->respondCreated($response);
								} 
								else {
									$data = array(
										'kode_user' => $gen,
										'kode_user_level' => 'MULV001',
										'kode_jenis_member' => $j_member,
										'username' => $username,
										'nama_lengkap' => $nama,
										'kota' => $kota,
										'alamat_email' => $email,
										'password' => md5($password),
										'no_hp' => $no_hp,
										'kode_referal' => $kode_referal,
										'client_id_komunitas' => $client_id,
										'email_anggota' => $email_anggota,
										'trial_expire' => date('Y-m-d', strtotime($today . ' + 3 days')),
										'is_verif' => 0,
									);
									
									//return $this->respondCreated($data);
									$userModel->insert($data);
							
									$response = [
										'status' => 200,
										'error' => FALSE,
										'messages' => 'Data has created',
									];
									return $this->respondCreated($response);
								}					
							}
							
							//return $this->respondCreated("kode referal only");
							$verifyreferal = $referalModel->select('*')->where('kode_referal', $kode_referal)->first();

							if (empty($verifyreferal)){
								$response = [
									'status' => 500,
									'error' => TRUE,
									'messages' => 'Referal code not verified'
								];
								return $this->respondCreated($response);
							}
							else {
								$data = array(
									'kode_user' => $gen,
									'kode_user_level' => 'MULV001',
									'kode_jenis_member' => $j_member,
									'username' => $username,
									'nama_lengkap' => $nama,
									'kota' => $kota,
									'alamat_email' => $email,
									'password' => md5($password),
									'no_hp' => $no_hp,
									'kode_referal' => $kode_referal,
									'client_id_komunitas' => $client_id,
									'email_anggota' => $email_anggota,
									'trial_expire' => date('Y-m-d', strtotime($today . ' + 3 days')),
									'is_verif' => 0,
								);
														
								$userModel->insert($data);
												
								$response = [
									'status' => 200,
									'error' => FALSE,
										'messages' => 'Data has created',
									];
								return $this->respondCreated($response);
							}
						}
						else if ($email_anggota != '')
						{
							if ($client_id != '')
							{
								//return $this->respondCreated("Anggota keduanya");
								$verifycoperation = $anggotaModel->select('*')->where('email', $email_anggota)->first();
								$verifycommunity = $komunitasModel->select('*')->where('client_id', $client_id)->first();

								if (empty($verifycoperation)){
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Member coperation not verified'
									];
									return $this->respondCreated($response);
								}
								else if (empty($verifycommunity)){
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Member community not verified'
									];
									return $this->respondCreated($response);
								} 
								else {
									$data = array(
										'kode_user' => $gen,
										'kode_user_level' => 'MULV001',
										'kode_jenis_member' => $j_member,
										'username' => $username,
										'nama_lengkap' => $nama,
										'kota' => $kota,
										'alamat_email' => $email,
										'password' => md5($password),
										'no_hp' => $no_hp,
										'kode_referal' => $kode_referal,
										'client_id_komunitas' => $client_id,
										'email_anggota' => $email_anggota,
										'trial_expire' => date('Y-m-d', strtotime($today . ' + 3 days')),
										'is_verif' => 0,
									);
									
									//return $this->respondCreated($data);
									$userModel->insert($data);
							
									$response = [
										'status' => 200,
										'error' => FALSE,
										'messages' => 'Data has created',
									];
									return $this->respondCreated($response);
								}
							}
							
							// return $this->respondCreated("Anggota only");
							$verifycoperation = $anggotaModel->select('*')->where('email', $email_anggota)->first();

							if (empty($verifycoperation)){
								$response = [
									'status' => 500,
									'error' => TRUE,
									'messages' => 'Member coperation not verified'
								];
								return $this->respondCreated($response);
							}
							else {
								$data = array(
									'kode_user' => $gen,
									'kode_user_level' => 'MULV001',
									'kode_jenis_member' => $j_member,
									'username' => $username,
									'nama_lengkap' => $nama,
									'kota' => $kota,
									'alamat_email' => $email,
									'password' => md5($password),
									'no_hp' => $no_hp,
									'kode_referal' => $kode_referal,
									'client_id_komunitas' => $client_id,
									'email_anggota' => $email_anggota,
									'trial_expire' => date('Y-m-d', strtotime($today . ' + 3 days')),
									'is_verif' => 0,
								);
								
								//return $this->respondCreated($data);
								$userModel->insert($data);
						
								$response = [
									'status' => 200,
									'error' => FALSE,
									'messages' => 'Data has created',
								];
								return $this->respondCreated($response);
							}
						}
						else if ($client_id != '')
						{
							//return $this->respondCreated("Komunitas only");

							$verifycommunity = $komunitasModel->select('*')->where('client_id', $client_id)->first();

							if (empty($verifycommunity)){
								$response = [
									'status' => 500,
									'error' => TRUE,
									'messages' => 'Member community not verified'
								];
								return $this->respondCreated($response);
							}
							else {
								$data = array(
									'kode_user' => $gen,
									'kode_user_level' => 'MULV001',
									'kode_jenis_member' => $j_member,
									'username' => $username,
									'nama_lengkap' => $nama,
									'kota' => $kota,
									'alamat_email' => $email,
									'password' => md5($password),
									'no_hp' => $no_hp,
									'kode_referal' => $kode_referal,
									'client_id_komunitas' => $client_id,
									'email_anggota' => $email_anggota,
									'trial_expire' => date('Y-m-d', strtotime($today . ' + 3 days')),
									'is_verif' => 0,
								);
								
								//return $this->respondCreated($data);
								$userModel->insert($data);
						
								$response = [
									'status' => 200,
									'error' => FALSE,
									'messages' => 'Data has created',
								];
								return $this->respondCreated($response);
							}
						}						
						else {
							//return $this->respondCreated("Insert langsung");
							
							$data = array(
									'kode_user' => $gen,
									'kode_user_level' => 'MULV001',
								 	'kode_jenis_member' => $j_member,
								 	'username' => $username,
								 	'nama_lengkap' => $nama,
								 	'kota' => $kota,
								 	'alamat_email' => $email,
								 	'password' => md5($password),
								 	'no_hp' => $no_hp,
								 	'kode_referal' => $kode_referal,
								 	'client_id_komunitas' => $client_id,
								 	'email_anggota' => $email_anggota,
								 	'trial_expire' => date('Y-m-d', strtotime($today . ' + 3 days')),
									'is_verif' => 0,
								);
				
								$userModel->insert($data);
						
								$response = [
									'status' => 200,
									'error' => FALSE,
									'messages' => 'Data has created',
								];
							return $this->respondCreated($response);
						}
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Insert data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}*/
	
	public function insert()
	{
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$usertmpModel = new UserTmpModel();
				$anggotaModel = new AnggotaModel();
				$komunitasModel = new KomunitasModel();
				$referalModel = new ReferalModel();

                $gen  = "TUSR" . str_pad(time(), 3, 0, STR_PAD_LEFT);
				
				$today = date('Y-m-d');
				$j_member = $this->request->getVar('kode_jenis_member');
				$username = $this->request->getVar('username');
				$nama = $this->request->getVar('nama');
				$kota= $this->request->getVar('kota');
				$email = $this->request->getVar('email');
				$password = $this->request->getVar('password');
				$no_hp = $this->request->getVar('no_hp');
				$kode_referal = $this->request->getVar('kode_referal');
				$client_id = $this->request->getVar('client_id');
				$email_anggota = $this->request->getVar('email_anggota');
				
				if ($j_member != '' && $username != '' && $nama != '' && $email != '' && $password != '' && $no_hp != '')
				{
					$verifyhp = $userModel->select('*')->where('no_hp', $no_hp)->first();
					$verifymail = $userModel->select('*')->where('alamat_email', $email)->first();

					if (!empty($verifyhp)){
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Phone Number has been registered'
						];
						return $this->respondCreated($response);
					}
					else if (!empty($verifymail)) {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Email address has been registered'
						];
						return $this->respondCreated($response);
					}
					else {
						if ($kode_referal != '')
						{
							$otp 		= rand(100000, 999999);
							$exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));
							
							$data = array(
								'kode_user' => $gen,
								'kode_user_level' => 'MULV001',
								'kode_jenis_member' => $j_member,
								'username' => $username,
								'nama_lengkap' => $nama,
								'kota' => $kota,
								'alamat_email' => $email,
								'password' => md5($password),
								'no_hp' => $no_hp,
								'kode_referal' => $kode_referal,
								'client_id_komunitas' => $client_id,
								'email_anggota' => $email_anggota,
								'trial_expire' => date('Y-m-d', strtotime($today . ' + 14 days')),
								'is_verif' => 0,
								'regis_no_hp' => $no_hp,
								'regis_otp_exp' => $exp,
							);
														
							// $userModel->insert($data);
							$usertmpModel->insert($data);
												
							$response = [
								'status' => 200,
								'error' => FALSE,
									'messages' => 'Data has created',
								];
							return $this->respondCreated($response);
						}		
						else {
							//return $this->respondCreated("Insert langsung");
							$otp 		= rand(100000, 999999);
							$exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));
							
							$data = array(
									'kode_user' => $gen,
									'kode_user_level' => 'MULV001',
								 	'kode_jenis_member' => $j_member,
								 	'username' => $username,
								 	'nama_lengkap' => $nama,
								 	'kota' => $kota,
								 	'alamat_email' => $email,
								 	'password' => md5($password),
								 	'no_hp' => $no_hp,
								 	'kode_referal' => $kode_referal,
								 	'client_id_komunitas' => $client_id,
								 	'email_anggota' => $email_anggota,
								 	'trial_expire' => date('Y-m-d', strtotime($today . ' + 14 days')),
									'is_verif' => 0,
									'regis_no_hp' => $no_hp,
									'regis_otp_exp' => $exp,
								);
				
								// $userModel->insert($data);
								$usertmpModel->insert($data);
						
								$response = [
									'status' => 200,
									'error' => FALSE,
									'messages' => 'Data has created',
								];
							return $this->respondCreated($response);
						}
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Insert data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function insertWithMail()
	{
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$anggotaModel = new AnggotaModel();
				$komunitasModel = new KomunitasModel();
				$referalModel = new ReferalModel();

                $gen  = "TUSR" . str_pad(time(), 3, 0, STR_PAD_LEFT);
				
				$today = date('Y-m-d');
				$j_member = $this->request->getVar('kode_jenis_member');
				$username = $this->request->getVar('username');
				$nama = $this->request->getVar('nama');
				$kota= $this->request->getVar('kota');
				$email = $this->request->getVar('email');
				$password = $this->request->getVar('password');
				$no_hp = $this->request->getVar('no_hp');
				$kode_referal = $this->request->getVar('kode_referal');
				$client_id = $this->request->getVar('client_id');
				$email_anggota = $this->request->getVar('email_anggota');
				
				if ($j_member != '' && $username != '' && $nama != '' && $email != '' && $password != '' && $no_hp != '')
				{
					$verifyhp = $userModel->select('*')->where('no_hp', $no_hp)->first();
					$verifymail = $userModel->select('*')->where('alamat_email', $email)->first();

					if (!empty($verifyhp)){
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Phone Number has been registered'
						];
						return $this->respondCreated($response);
					}
					else if (!empty($verifymail)) {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Email address has been registered'
						];
						return $this->respondCreated($response);
					}
					else {
						if ($kode_referal != '')
						{
							$aktiv = md5($email . $gen);
							$otp 		= rand(100000, 999999);
							$exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));
						
							$data = array(
								'kode_user' => $gen,
								'kode_user_level' => 'MULV001',
								'kode_jenis_member' => $j_member,
								'username' => $username,
								'nama_lengkap' => $nama,
								'kota' => $kota,
								'alamat_email' => $email,
								'password' => md5($password),
								//'no_hp' => $no_hp,
								'kode_referal' => $kode_referal,
								'client_id_komunitas' => $client_id,
								'email_anggota' => $email_anggota,
								'trial_expire' => date('Y-m-d', strtotime($today . ' + 14 days')),
								'is_verif' => 0,
								//'verif_kode' => $otp,
								'regis_no_hp' => $no_hp,
								'regis_otp' => $otp,
								'regis_otp_exp' => $exp,
							);
														
							$userModel->insert($data);
							
							$mail = \Config\Services::email();
							$mail->setFrom('no-reply@panensaham.com', 'No-reply Panensaham');
							$mail->setTo($email);

							$data = array(
								'nama'		=> $nama,	
								'email'		=> $email,
								'link'		=> 'https://monika.panensaham.com/aktivasi/'. $aktiv,
							);

							$msg = view('v_emailactivate', $data);

							$mail->setSubject('Aktivasi Akun Monika');
							$mail->setMessage($msg);

							$mail->send();
												
							$response = [
								'status' => 200,
								'error' => FALSE,
									'messages' => 'Data has created',
								];
							return $this->respondCreated($response);
						}		
						else {
							//return $this->respondCreated("Insert langsung");

							$aktiv = md5($email . $gen);
							$otp 		= rand(100000, 999999);
							$exp		= date('Y-m-d H:i:s',strtotime("+10 minutes"));
							
							$data = array(
									'kode_user' => $gen,
									'kode_user_level' => 'MULV001',
								 	'kode_jenis_member' => $j_member,
								 	'username' => $username,
								 	'nama_lengkap' => $nama,
								 	'kota' => $kota,
								 	'alamat_email' => $email,
								 	'password' => md5($password),
								 	//'no_hp' => $no_hp,
								 	'kode_referal' => $kode_referal,
								 	'client_id_komunitas' => $client_id,
								 	'email_anggota' => $email_anggota,
								 	'trial_expire' => date('Y-m-d', strtotime($today . ' + 14 days')),
									'is_verif' => 0,
									//'verif_kode' => $otp,
									'regis_no_hp' => $no_hp,
									'regis_otp' => $otp,
									'regis_otp_exp' => $exp,
								);
				
								$userModel->insert($data);
								
								$mail = \Config\Services::email();
								$mail->setFrom('no-reply@panensaham.com', 'No-reply Panensaham');
								$mail->setTo($email);

								$data = array(
									'nama'		=> $nama,	
									'email'		=> $email,
									'link'		=> 'https://monika.panensaham.com/aktivasi/'. $aktiv,
								);

								$msg = view('v_emailactivate', $data);

								$mail->setSubject('Aktivasi Akun Monika');
								$mail->setMessage($msg);

								$mail->send();
						
								$response = [
									'status' => 200,
									'error' => FALSE,
									'messages' => 'Data has created',
								];
							return $this->respondCreated($response);
						}
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Insert data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function activateuser($nohp = null) {
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$usertmpModel = new UserTmpModel();
				$input = $this->request->getRawInput();
				
				if ($input != '' && $nohp != '')
				{
					//$usr = $usertmpModel->select('kode_user, nama_lengkap, verif_kode')->where('no_hp', $nohp)->first();
					$usr = $usertmpModel->select('kode_user, nama_lengkap, regis_otp')->where('regis_no_hp', $nohp)->first();
					
					if ($input['otp'] == $usr['regis_otp'])
					{
						$data = array(
							'is_verif' => 1,
							'regis_otp' => '',
							'regis_no_hp'   => '',
                            'trial_expire'	=> date('Y-m-d', strtotime('+14 day')),
						);
						
						$usertmpModel->update($usr['kode_user'], $data);
						
						$query = $usertmpModel->select('*')->where('kode_user', $usr['kode_user'])->first();
						$userModel->insert($query);
				
						$response = [
							'status' => 201,
							'error' => FALSE,
							'messages' => 'User activated successfully',
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => FALSE,
							'messages' => 'OTP code not match',
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update user status refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function changePhone($kode = null) {
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$input = $this->request->getRawInput();
				
				if ($input != '' && $kode != '')
				{
					$usr = $userModel->select('kode_user, nama_lengkap, verif_kode')->where('kode_user', $kode)->where('is_verif', 1)->first();
					
					if ($input['otp'] == $usr['verif_kode'])
					{
						$data = array(
							'no_hp' => $input['no_hp'],
							'verif_kode' => '',
						);
						
						$userModel->update($kode, $data);
				
						$response = [
							'status' => 201,
							'error' => FALSE,
							'messages' => 'Data has update',
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
							'status' => 500,
							'error' => FALSE,
							'messages' => 'OTP code not match',
						];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function changePassword($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		$old  = md5($data['oldpassword']);
		$pass = md5($data['password']);
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				if ($pass != '' && $kode != '' && $old != '')
				{
					$usr = $userModel->select('*')->where('kode_user', $kode)->where('password', $old)->first();
					
					if (!empty($usr)){
						$data = array(
							'password' => $pass,
						);
							
						//return $this->respondCreated($data);
							
						$userModel->update($kode, $data);
					
						$response = [
							'status' => 201,
							'error' => FALSE,
							'messages' => 'Data has update',
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Incorrect password'
							];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function changeToken($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		$firetoken = $data['firetoken'];
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				if ($firetoken != '' && $kode != '')
				{
					$data = [
							'token_fr' => $firetoken,
						];
							
					$userModel->updateData($data, $kode);
					$output = $userModel->select('*')->where('kode_user', $kode)->first();
					
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Token firebase has update',
						'data' => $output,
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function changeNotif($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		$status = $data['status'];
		$tipe = $data['tipenotif'];
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				if ($status != '' && $kode != '')
				{
					$field = '';
					$sts = '';
					
					switch ($tipe) {
						case "email" :
						$field = "notif_email";
						break;
						case "wa" :
						$field = "notif_wa";
						break;
						case "news" :
						$field = "notif_news";
						break;
						case "promo" :
						$field = "notif_promo";
						break;
						case "edu" :
						$field = "notif_edu";
						break;
					}
					
					if ($status == "true")
					{
						$sts = 1;
					}
					else {
						$sts = 0;
					}
					
					$data = [
							$field => $sts,
						];
							
					$userModel->updateData($data, $kode);
					$output = $userModel->select('*')->where('kode_user', $kode)->first();
					
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Notifikasi ' . $tipenotif . ' has update',
						'data' => $output,
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function changePin($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		$pin = $data['pincode'];
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				if ($pin != '' && $kode != '')
				{
					$data = [
							'pin_code' => $pin,
						];
							
					$userModel->updateData($data, $kode);
					$output = $userModel->select('*')->where('kode_user', $kode)->first();
					
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Pincode has update',
						'data' => $output,
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

	public function changeEmail($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		$email  = $data['new_email'];
		$pass = md5($data['password']);
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				if ($pass != '' && $kode != '' && $email != '')
				{
					$usr = $userModel->select('*')->where('kode_user', $kode)->where('password', $pass)->first();
					
					if (!empty($usr)){
						$data = array(
							'alamat_email' => $email,
						);
							
						//return $this->respondCreated($data);
							
						$userModel->update($kode, $data);
					
						$response = [
							'status' => 201,
							'error' => FALSE,
							'messages' => 'Email has change',
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Incorrect password'
							];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

	public function deleteAnggota($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$anggotaModel = new AnggotaModel();
				

				if ($kode != '')
				{
					$data = array(
						'email_anggota' => '',
					);
						
					//return $this->respondCreated($data);
						
					$userModel->update($kode, $data);
					
					$this->updateMember($kode);
				
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Successfully delete member coperation',
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

	public function updateAnggota($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		$email  = $data['email_anggota'];
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$anggotaModel = new AnggotaModel();

				if ($kode != '' && $email != '')
				{
					/*$usr = $anggotaModel->select('*')->where('email', $email)->first();
					
					if (!empty($usr)){
						$data = array(
							'email_anggota' => $email,
						);
							
						//return $this->respondCreated($data);
							
						$userModel->update($kode, $data);
					
						$response = [
							'status' => 201,
							'error' => FALSE,
							'messages' => 'Successfully integrated member coperation',
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Member coperation not register'
							];
						return $this->respondCreated($response);
					}*/
					
					$data = array(
						'email_anggota' => $email,
					);
							
					$userModel->update($kode, $data);
					
					$this->updateMember($kode);
					
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Successfully integrated member coperation',
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

	public function deleteKomunitas($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				
				$data = array(
					'client_id_komunitas' => '',
				);
					
				//return $this->respondCreated($data);
					
				$userModel->update($kode, $data);
				
				$this->updateMember($kode);
			
				$response = [
					'status' => 201,
					'error' => FALSE,
					'messages' => 'Successfully integrated member community',
				];
				return $this->respondCreated($response);
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

	public function updateKomunitas($kode = null) {
		$key = $this->myKey();
		$data = $this->request->getRawInput();
		$id  = $data['client_id'];
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$komunitasModel = new KomunitasModel();

				if ($kode != '' && $id != '')
				{
					/*$usr = $komunitasModel->select('*')->where('client_id', $id)->first();
					
					if (!empty($usr)){
						$data = array(
							'client_id_komunitas' => $id,
						);
							
						//return $this->respondCreated($data);
							
						$userModel->update($kode, $data);
					
						$response = [
							'status' => 201,
							'error' => FALSE,
							'messages' => 'Successfully integrated member community',
						];
						return $this->respondCreated($response);
					}
					else
					{
						$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Member community not register'
							];
						return $this->respondCreated($response);
					}*/
					
					$data = array(
						'client_id_komunitas' => $id,
					);
							
					$userModel->update($kode, $data);
					
					$this->updateMember($kode);
					
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Successfully integrated member community',
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function updateMember($kode = null)
	{
		$userModel = new UserModel();
		
		$data = $userModel->where("kode_user", $kode)->first();
		
		if ($data['client_id_komunitas'] != "")
		{
			if ($data['email_anggota'] != "")
			{
				$data = array(
						'kode_jenis_member' => "JMBR004",
					);
							
				$userModel->update($kode, $data);
			}
			else
			{
				$data = array(
						'kode_jenis_member' => "JMBR003",
					);
							
				$userModel->update($kode, $data);
			}
		}
		else if ($data['email_anggota'] != "")
		{
			$data = array(
					'kode_jenis_member' => "JMBR002",
				);
							
			$userModel->update($kode, $data);
		}
		else {
			$data = array(
					'kode_jenis_member' => "JMBR001",
				);
							
			$userModel->update($kode, $data);
		}
	}
	
	public function edit($kode = null) {
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				$data = $this->request->getRawInput();
				
				if ($data != '' && $kode != '')
				{
					$data = array(
						'username' => $data['username'],
						'tentang_saya' => $data['tentang_saya'],
						'kota' => $data['kota'],
						'jenis_kelamin' => $data['jenis_kelamin'],
						'tanggal_lahir' => $data['tanggal_lahir'],
						'website' => $data['website'],
						'alamat' => $data['alamat'],
					);
					
					$userModel->update($kode, $data);
			
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Data has update',
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function editLastAccess($kode = null) {
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();
				
				if ($kode != '')
				{
					date_default_timezone_set('Asia/Jakarta');
					
					$data = array(
						'last_access' => date('Y-m-d H:i:s'),
					);
					
					$userModel->update($kode, $data);
			
					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Data has update',
					];
					return $this->respondCreated($response);
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Update data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function deleteUser($kode = null) {
		$key = $this->myKey();
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$userModel = new UserModel();

				if ($kode != '')
				{
					$existData 	= $userModel->where("kode_user", $kode)->first();

					if ($existData){
						$userModel->delete($kode);
				
						$response = [
							'status' => 201,
							'error' => FALSE,
							'messages' => 'Successfully delete user data',
						];

						
						return $this->respondCreated($response);
					}
					else {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'User not found',
						];
						
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Delete data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

	public function editPhotoProfile() {
		{
			$key = $this->myKey();
			
			$authHeader = $this->request->getHeader("X-Auth");
			if ($authHeader != ''){
				$authHeader = $authHeader->getValue();
				$token = $authHeader;
			}
			else{
				$response = [
					'status' => 401,
					'error' => TRUE,
					'messages' => 'Gak ada Token'
				];
				return $this->respondCreated($response);
			}
	
			try {
				$decoded = JWT::decode($token, $key, array("HS256"));
				
	
				if ($decoded) {

					$inputKodeUser = $this->request->getVar('kode_user');
					$inputPhoto = $this->request->getFile('photo');
					$getNamaPoto = $inputPhoto->getName();
					$ext = pathinfo($getNamaPoto, PATHINFO_EXTENSION);
					$tmp 		= $inputPhoto->getTempName();

					if (! $inputPhoto->isValid()) {
						throw new \RuntimeException($inputPhoto->getErrorString() . '(' . $inputPhoto->getError() . ')');
					}

					$userModel = new UserModel();					
					$usr = $userModel->select('kode_user, alamat_email, nama_lengkap')->where('kode_user', $inputKodeUser)->first();
					$nama_lengkap = $usr['nama_lengkap'];
					$kode_user = $usr['kode_user'];
					$email = $usr['alamat_email'];
					$namaPoto = $email.'.'.$ext;
					$folder 	= hash('sha512', $email . $kode_user);

					if (file_exists('../public/assets/img/profil/'.$folder.'/'.$namaPoto)) {
						unlink('../public/assets/img/profil/'.$folder.'/'.$namaPoto);
					}

					$inputPhoto->move('../public/assets/img/profil/'.$folder, $namaPoto);
					$realpath = 'public/assets/img/profil/' . $folder . '/' . $email . '.' . $ext;

					$data = [
						'photo'	=> $realpath,
					];

					$user = [
						'kode_user'	=> $kode_user,
						'email'	=> $email,
						'nama_lengkap'	=> $nama_lengkap,
						'photo'	=> $realpath,
					];

					$userModel->update($kode_user, $data);

					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Foto Profile Berhasil Di Update',
						'data' => $user
					];

					return $this->respondCreated($response);

				}
			} catch (Exception $ex) {
				$response = [
					'status' => 401,
					'error' => TRUE,
					'messages' => 'Error pas Decode Token'
				];
				return $this->respondCreated($response);
			}
		}
	}

	public function isVeriefiedEmail() {
		{
			$key = $this->myKey();
			
			$authHeader = $this->request->getHeader("X-Auth");
			if ($authHeader != ''){
				$authHeader = $authHeader->getValue();
				$token = $authHeader;
			}
			else{
				$response = [
					'status' => 401,
					'error' => TRUE,
					'messages' => 'Gak ada Token'
				];
				return $this->respondCreated($response);
			}
	
			try {
				$decoded = JWT::decode($token, $key, array("HS256"));
				
	
				if ($decoded) {

					$inputCodeUser = $this->request->getPost('kode_user');
					
					$userModel = new UserModel();					
					$usr = $userModel->select('kode_user, alamat_email, nama_lengkap')->where('kode_user', $inputCodeUser)->first();
					$nama_lengkapC = $usr['nama_lengkap'];
					$kode_userC = $usr['kode_user'];
					$emailC = $usr['alamat_email'];
					$is_verifiemailC = $usr['is_verifiemail'];

					$data = [
						'is_verifiemail'	=> 1,
					];

					$DataUser = [
						'kode_user'	=> $kode_userC,
						'email'	=> $emailC,
						'nama_lengkap'	=> $nama_lengkapC,
						'is_verifiemail'	=> $is_verifiemailC,
					];

					$userModel->update($inputCodeUser, $data);

					$response = [
						'status' => 201,
						'error' => FALSE,
						'messages' => 'Email Berhasil Di Verifikasi',
						'data' => $DataUser
					];

					return $this->respondCreated($response);

				}
			} catch (Exception $ex) {
				$response = [
					'status' => 401,
					'error' => TRUE,
					'messages' => 'Error pas Decode Token'
				];
				return $this->respondCreated($response);
			}
		}
	}
}