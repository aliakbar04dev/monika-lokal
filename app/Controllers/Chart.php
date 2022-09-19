<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NotificationModel;
use App\Models\UserModel;
use App\Models\CharttaModel;
use App\Models\ChartfaModel;

class Chart extends BaseController
{
	public function __construct()
	{
		$this->ntf = new NotificationModel();
		$this->usr = new UserModel();
		$this->cmdta = new CharttaModel();
		$this->cmdfa = new ChartfaModel();
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
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);
				$cht	= $this->cmdta->findAll();

				$data = array(
					'title'    => 'Chart Teknikal Analisis',
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
					'cht'	=> $cht,
				);

				return view('chart/view_chart', $data);
			}
		}
	}

	public function chart_fa()
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
				$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
				$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
				$cnt	= $this->ntf->getcount($ntf, $npy);
				$cht	= $this->cmdfa->findAll();

				$data = array(
					'title'    => 'Chart Fundamental Analysis',
					'ntf'	=> $ntf,
					'npy'	=> $npy,
					'cnt'	=> $cnt,
					'lvl'	=> $lvl,
					'cht'	=> $cht,
				);
				return view('chart_fa/view_chart_fa', $data);
			}
		}
	}

	public function showchartuser()
	{
		if ($this->request->isAJAX()) {
			if (hassession('email')) {
				if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
					$this->session->destroy();

					return json_encode([
						'success'		=> 0,
						'reason'		=> 'Session Failed',
						'description'	=> 'Please Refresh Page to Continue'
					]);
				} else {
					$commandchart	= $this->request->getPost('commandchart', FILTER_SANITIZE_STRING);
					$daftar			= $this->request->getPost('daftar', FILTER_SANITIZE_STRING);
					$simbol			= $this->request->getPost('simbol', FILTER_SANITIZE_STRING);
					$interval		= $this->request->getPost('interval', FILTER_SANITIZE_STRING);
					$data			= explode(" ", $commandchart);
					$command		= $data[0];
					$kode			= '';
					$intvl			= '';
					$date 			= new \DateTime();
					$tmp 			= $date->getTimestamp();
					$lvl			= $this->usr->getuserlvl(getsession('email'));
					$kodefa			= array("/ps1", "/ps2", "/ps3", "/ps4", "/ps5", "/ps7", "/ps8", "/ps9", "/ps10");
					$kodear			= array("cma", "cco", "cal", "cah", "cas", "cfn", "ctl", "odt", "psl", "cfr", "aps", "cha");
					$trial			= array("cah", "ctl", "psl", "cfn");
					// $trial			= array("cah", "cma");

					$this->usr->update_lastaccess(getsession('email'));

					if ($daftar != '/f' || $daftar != '/fa') {
						if ($lvl != '' && $lvl != 'MULV004') {

							if ($lvl == 'MULV002') {

								if (!in_array(strtolower($daftar), $trial)) {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Low Level Access (1)',
										'reason'		=> 'Tidak memiliki akses perintah tersebut',
										'description'	=> 'Silahkan berlangganan paket terlebuh dahulu'
									]);
								}

								if (strtolower($interval) != "ww") {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Low Level Access (1)',
										'reason'		=> 'Tidak memiliki akses perintah tersebut',
										'description'	=> 'Silahkan berlangganan paket terlebuh dahulu',
										'lvl'			=> $lvl
									]);
								}
							}

							if (in_array(strtolower($daftar), $kodear)) {
								if (isset($data[1])) {
									$kode = '%20' . $data[1];
								}

								//$content = json_decode(file_get_contents('https://bot2.panensaham.com/botaps01/custombot1.php?command='.$daftar.'&interval='.$interval.'&ticker='.$simbol));

								//$content = json_decode(file_get_contents('http://lb.local:10180/botaps01/custombot1.php?command='.$daftar.'&ticker='.$simbol.'&interval='.$interval));

								if ($interval == "dd" || $interval == "ww" || $interval == "mm") {
									$endpoint = 'http://lb.carmel.local:8081';
									// $endpoint = 'http://192.168.23.142:8081';
								} else if ($interval == "hh" || $interval == "05") {
									// else if ($interval == "hh" || $interval == "05" || $interval == "30" || $interval == "15") {
									// $endpoint = 'http://lb-lokal:10180';
									$endpoint = 'http://192.168.21.130:11181';
									// $endpoint = 'http://192.168.23.143:8081';
								} else {
									$endpoint = 'http://192.168.21.130:10180';
									// $endpoint = 'http://lb-lokal:10180';
								}

								$content = json_decode(file_get_contents($endpoint . '/' . $daftar . '/' . $interval . '/' . $simbol));

								if (isset($content->data)) {
									$bs64 = explode(',', $content->data);
									$gambar = base64_decode($bs64[1]);
									$email = md5(getsession('email'));

									if (!write_file('./public/assets/img/chart/' . $email . '.jpg', $gambar)) {
										return json_encode([
											'success'		=> '0',
											'result'		=> 'Gagal Simpan',
											'reason'		=> 'Gagal Mengambil Data',
											'description'	=> 'Terjadi kesalahan saat mengambil data, silahkan coba lagi',
											'content'		=> $content
										]);
									} else {

										return json_encode([
											'success'		=> '1',
											'result'		=> '<a class="demo-trigger" href="' . base_url() . '/public/assets/img/chart/' . $email . '.jpg?tmp=' . $tmp . '"><img id="map" src="' . base_url() . '/public/assets/img/chart/' . $email . '.jpg?tmp=' . $tmp . '" alt="" style="width: 100%;"></a>',
											'reason'		=> 'Search Success',
											'description'	=> 'Search Success, Showing graph....'
										]);
									}
								} else {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'No Result',
										'reason'		=> 'Gagal Mencari',
										'description'	=> 'Gagal mencari data, Silahkan coba lagi atau contact administrator'
									]);
								}
							} else {
								return json_encode([
									'success'		=> '0',
									'result'		=> 'Invalid Command (2)',
									'reason'		=> 'Invalid Command',
									'description'	=> 'Command yang anda masukkan salah, silahkan coba lagi'
								]);
							}
						} else {
							return json_encode([
								'success'		=> '0',
								'result'		=> 'Low Level Access (2)',
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

	public function showchartuserfa()
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
					$commandchart	= $this->request->getPost('commandchart', FILTER_SANITIZE_STRING);
					$daftar			= $this->request->getPost('daftar', FILTER_SANITIZE_STRING);
					$simbol			= $this->request->getPost('simbol', FILTER_SANITIZE_STRING);
					$interval		= $this->request->getPost('interval', FILTER_SANITIZE_STRING);
					$data			= explode(" ", $commandchart);
					$command		= $data[0];
					$kode			= '';
					$intvl			= '';
					$date 			= new \DateTime();
					$tmp 			= $date->getTimestamp();
					$lvl			= $this->usr->getuserlvl(getsession('email'));
					$kodear			= array("ps1", "ps2", "ps3", "ps4", "ps5", "ps7", "ps8", "ps9", "ps10");

					$this->usr->update_lastaccess(getsession('email'));

					if ($daftar != 'f' || $daftar != 'fa') {
						if ($lvl != '' && $lvl != 'MULV003') {

							if ($lvl == 'MULV001') {
								$trial = array("ps1", "ps2", "ps3", "ps4", "ps5", "ps7", "ps8", "ps9", "ps10");

								if (!in_array(strtolower($daftar), $trial)) {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Low Level Access (1)',
										'reason'		=> 'Tidak memiliki akses perintah tersebut',
										'description'	=> 'Silahkan berlangganan paket terlebuh dahulu'
									]);
								}
							}

							if ($lvl == 'MULV002') {
								$trial = array("ps20");

								if (!in_array(strtolower($daftar), $trial)) {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Low Level Access (1)',
										'reason'		=> 'Tidak memiliki akses perintah tersebut',
										'description'	=> 'Silahkan berlangganan paket terlebuh dahulu'
									]);
								}
							}

							if (in_array(strtolower($daftar), $kodear)) {

								// LAMA
								$content = json_decode(file_get_contents('http://192.168.23.145/botpsb/custombot1.php?command=' . $daftar . '&interval=' . $interval . '&ticker=' . $simbol));

								if (isset($content->data)) {
									$bs64 = explode(',', $content->data);
									$gambar = base64_decode($bs64[1]);
									$email = md5(getsession('email'));

									if (!write_file('./public/assets/img/chart/' . $email . '.jpg', $gambar)) {
										return json_encode([
											'success'		=> '0',
											'result'		=> 'Gagal Simpan',
											'reason'		=> 'Gagal Mengambil Data',
											'description'	=> 'Terjadi kesalahan saat mengambil data, silahkan coba lagi',
											'content'		=> $content
										]);
									} else {

										return json_encode([
											'success'		=> '1',
											'result'		=> '<a class="demo-trigger" href="' . base_url() . '/public/assets/img/chart/' . $email . '.jpg?tmp=' . $tmp . '"><img id="map" src="' . base_url() . '/public/assets/img/chart/' . $email . '.jpg?tmp=' . $tmp . '" alt="" style="width: 100%;"></a>',
											'reason'		=> 'Search Success',
											'description'	=> 'Search Success, Showing graph....'
										]);
									}
								} else {
									return json_encode([
										'success'		=> '0',
										'result'		=> 'No Result',
										'reason'		=> 'Gagal Mencari',
										'description'	=> 'Gagal mencari data, Silahkan coba lagi atau contact administrator'
									]);
								}
							} else {
								return json_encode([
									'success'		=> '0',
									'result'		=> 'Invalid Command (2)',
									'reason'		=> 'Invalid Command',
									'description'	=> 'Command yang anda masukkan salah, silahkan coba lagi'
								]);
							}
						} else {
							return json_encode([
								'success'		=> '0',
								'result'		=> 'Low Level Access (2)',
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
