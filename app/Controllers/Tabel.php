<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NotificationModel;
use App\Models\UserModel;

class Tabel extends BaseController
{
	public function __construct()
	{
		$this->ntf = new NotificationModel();
		$this->usr = new UserModel();
	}

	public function index()
	{
		if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
				$this->session->destroy();
				return redirect()->to('/');
			} else {
				$this->usr->upusrlvl(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));

				$lvl	= $this->usr->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);

				$data = array(
					'title'    => 'Tabel Teknikal Analisis',
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
				);
				return view('tabel/view_tabel', $data);
			}
		}
	}

	public function tabel_fa()
	{
		if (!hassession('email')) {
			return redirect()->to('/');
		} else {
			if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
				$this->session->destroy();
				return redirect()->to('/');
			} else {
				$this->usr->upusrlvl(getsession('email'));
				$lvl	= $this->usr->getuserlvl(getsession('email'));

				$lvl	= $this->usr->getuserlvl(getsession('email'));
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);

				$data = array(
					'title' => 'Tabel Fundamental Analysis',
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
				);
				return view('tabel_fa/view_tabel_fa', $data);
			}
		}
	}

	public function showtableuser()
	{
		if ($this->request->isAJAX()) {
			if (hassession('email')) {
				if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
					$this->session->destroy();

					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Session Failed',
						'description'	=> 'Silahkan Refresh Page to Continue'
					]);
				} else {
					$input			= $this->request->getPost('commandtable', FILTER_SANITIZE_STRING);
					$data			= explode(" ", $input);
					$command		= $data[0];
					$kode			= '';
					$intvl			= '';
					$date 			= new \DateTime();
					$tmp 			= $date->getTimestamp();
					$lvl			= $this->usr->getuserlvl(getsession('email'));
					$kodedaily		= array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "ps200", "rg3", "stoup", "swb", "ungu", "hold", "ps20", "asin", "warkop");
					$kodeintra		= array("fan15", "fan050", "swb15", "tektok");
					$trial 			= array("ps20");

					$this->usr->update_lastaccess(getsession('email'));

					if ($command == strtolower('/f')) {
						if ($lvl != '' && $lvl != 'MULV004') {
							if (isset($data[1])) {
								$kode = '%20' . $data[1];
							}

							if ($lvl == 'MULV002') {
								if (!in_array(strtolower($data[1]), $trial)) {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Gagal Cari',
										'reason'		=> 'Tidak memiliki akses perintah tersebut',
										'description'	=> 'Silahkan berlangganan paket terlebuh dahulu'
									]);
								}
							}

							if (in_array(strtolower($data[1]), $kodedaily)) {

								// $content = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot.php?command=' . $command . $kode));
								$content = json_decode(file_get_contents('http://192.168.23.148/botaps01/custombot.php?command=' . $command . $kode));

								if (isset($content->data) && $content->data != '') {
									$bs64 = base64_decode($content->data);

									//Hapus Gapenting
									$bs64 = strstr($bs64, '<TABLE border=0>');
									$bs64 = strstr($bs64, '</BODY>', true);

									//Insert <thead> sama </thead>
									$pos1 = stripos($bs64, '<tr>');
									$bs64 = substr_replace($bs64, '<thead>', $pos1, 0);

									$pos2 = stripos($bs64, '</tr>');
									$bs64 = substr_replace($bs64, '</thead>', $pos2 + 5, 0);

									//Insert <tbody> sama </tbody>
									//gajadi

									return json_encode([
										'success'		=> '1',
										'result'		=> $bs64,
										'reason'		=> 'Search Success',
										'description'	=> 'Search Success, Showing data....'
									]);
								} else {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Gagal Cari',
										'reason'		=> 'Gagal Mencari',
										'description'	=> 'Gagal mencari data, Silahkan coba lagi atau contact administrator'
									]);
								}
							} else if (in_array(strtolower($data[1]), $kodeintra)) {
								// $content = json_decode(file_get_contents('http://192.168.21.134/botaps01/custombot.php?command=' . $command . $kode));
								// $content = json_decode(file_get_contents('http://lb-lokal:10180/botaps01/custombotfilh.php?command=' . $command . $kode));
								$content = json_decode(file_get_contents('http://192.168.23.141/botaps01/custombotfilh.php?command=' . $command . $kode));

								if (isset($content->data) && $content->data != '') {
									$bs64 = base64_decode($content->data);

									//Hapus Gapenting
									$bs64 = strstr($bs64, '<TABLE border=0>');
									$bs64 = strstr($bs64, '</BODY>', true);

									//Insert <thead> sama </thead>
									$pos1 = stripos($bs64, '<tr>');
									$bs64 = substr_replace($bs64, '<thead>', $pos1, 0);

									$pos2 = stripos($bs64, '</tr>');
									$bs64 = substr_replace($bs64, '</thead>', $pos2 + 5, 0);

									//Insert <tbody> sama </tbody>
									//gajadi

									return json_encode([
										'success'		=> '1',
										'result'		=> $bs64,
										'reason'		=> 'Search Success',
										'description'	=> 'Search Success, Showing data....'
									]);
								} else {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Gagal Cari',
										'reason'		=> 'Gagal Mencari',
										'description'	=> 'Gagal mencari data, Silahkan coba lagi atau contact administrator'
									]);
								}
							} else {
								return json_encode([
									'success'		=> '0',
									'result'		=> 'Invalid Command',
									'reason'		=> 'Invalid Command',
									'description'	=> 'Command yang anda masukkan salah, silahkan coba lagi'
								]);
							}
						} else {
							return json_encode([
								'success'		=> '0',
								'result'		=> 'Gagal Cari',
								'reason'		=> 'Gagal Mencari',
								'description'	=> 'Gagal mencari data, Level akses anda kurang'
							]);
						}
					} else {
						return json_encode([
							'success'		=> '0',
							'result'		=> 'Invalid Command',
							'reason'		=> 'Invalid Command',
							'description'	=> 'Command yang anda masukkan salah, silahkan coba lagi'
						]);
					}
				}
			}
		}
	}

	public function showtableuserfa()
	{
		if ($this->request->isAJAX()) {
			if (hassession('email')) {
				if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
					$this->session->destroy();

					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Session Failed',
						'description'	=> 'Silahkan Refresh Page to Continue'
					]);
				} else {
					$input			= $this->request->getPost('commandtable', FILTER_SANITIZE_STRING);
					$data			= explode(" ", $input);
					$command		= $data[0];
					$kode			= '';
					$intvl			= '';
					$date 			= new \DateTime();
					$tmp 			= $date->getTimestamp();
					$lvl			= $this->usr->getuserlvl(getsession('email'));
					$kodear			= array("pebv5", "grow", "bara", "per", "pbv", "peg", "npm", "roe", "der");

					$this->usr->update_lastaccess(getsession('email'));

					if ($command == strtolower('/fa')) {
						if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV003') {
							if (isset($data[1])) {
								$kode = '%20' . $data[1];
							}

							if ($lvl == 'MULV001') {
								$trial = array("pebv5", "grow", "bara", "per", "pbv", "peg", "npm", "roe", "der");

								if (!in_array(strtolower($data[1]), $trial)) {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Gagal Cari',
										'reason'		=> 'Anda tidak memiliki akses perintah tersebut',
										'description'	=> 'Silahkan Berlangganan Paket terlebih dahulu.'
									]);
								}
							}

							if (in_array(strtolower($data[1]), $kodear)) {

								//$content = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot.php?command=' . $command . $kode));
								//$content = json_decode(file_get_contents('https://b368cf66fa9f.ngrok.io/botpsb/custombotfil.php?command=' . $command . $kode));
								// $content = json_decode(file_get_contents('http://lb-lokal:10380/botpsb/custombotfil.php?command=' . $command . $kode));
								$content = json_decode(file_get_contents('http://192.168.23.145/botpsb/custombotfil.php?command=' . $command . $kode));

								if (isset($content->data) && $content->data != '') {
									$bs64 = base64_decode($content->data);

									//Hapus Gapenting
									$bs64 = strstr($bs64, '<TABLE border=0>');
									$bs64 = strstr($bs64, '</BODY>', true);

									//Insert <thead> sama </thead>
									$pos1 = stripos($bs64, '<tr>');
									$bs64 = substr_replace($bs64, '<thead>', $pos1, 0);

									$pos2 = stripos($bs64, '</tr>');
									$bs64 = substr_replace($bs64, '</thead>', $pos2 + 5, 0);

									//Insert <tbody> sama </tbody>
									//gajadi

									return json_encode([
										'success'		=> '1',
										'result'		=> $bs64,
										'reason'		=> 'Search Success',
										'description'	=> 'Search Success, Showing data....'
									]);
								} else {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Gagal Cari',
										'reason'		=> 'Gagal Mencari',
										'description'	=> 'Gagal mencari data, Silahkan coba lagi atau contact administrator'
									]);
								}
							} else {
								return json_encode([
									'success'		=> '0',
									'result'		=> 'Invalid Code',
									'reason'		=> 'Invalid Code',
									'description'	=> 'Code yang anda masukkan salah, silahkan coba lagi'
								]);
							}
						} else {
							return json_encode([
								'success'		=> '0',
								'result'		=> 'Gagal Cari',
								'reason'		=> 'Gagal Mencari',
								'description'	=> 'Gagal mencari data, Level akses anda kurang'
							]);
						}
					} else {
						return json_encode([
							'success'		=> '0',
							'result'		=> 'Invalid Command',
							'reason'		=> 'Invalid Command',
							'description'	=> 'Command yang anda masukkan salah, silahkan coba lagi'
						]);
					}
				}
			}
		}
	}
}
