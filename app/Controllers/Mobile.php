<?php

namespace App\Controllers;

use App\Models\SaktiModel;
use App\Models\VideoModel;
use App\Models\NotificationModel;
use App\Models\UserModel;

class Mobile extends BaseController
{

	public function __construct()
	{
		$this->videoModel = new VideoModel();
		$this->sakti = new SaktiModel();
		$this->ntf = new NotificationModel();
		$this->usr = new UserModel();
	}

	public function tabelsakti()
	{
		//if (hassession('email')) {
		$jns = $this->sakti->getalljnssakti();
		$lvl    = $this->usr->getuserlvl(getsession('email'));
		$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
		$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
		$cnt    = $this->ntf->getcount($ntf, $npy);
		$data = array(
			'jns'    => $jns,
			'title'    => 'Tabel Sakti',
			'ntf'    => $ntf,
			'npy'    => $npy,
			'cnt'    => $cnt,
			'lvl'    => $lvl,
		);
		return view('mobile/view_tabel_sakti', $data);
		// } else {
		//     return redirect()->to('/');
		// }
	}

	public function getdatam()
	{
		if ($this->request->isAJAX()) {
			$jns     = $this->request->getPost('jnstable', FILTER_SANITIZE_STRING);
			$start     = date('Y-m-d', strtotime($this->request->getPost('startdate', FILTER_SANITIZE_STRING)));
			$end     = date('Y-m-d', strtotime($this->request->getPost('enddate', FILTER_SANITIZE_STRING)));

			if ($end >= $start) {
				$data = $this->sakti->where('kode_jenis_tsakti', $jns)->where('tanggal_input >=', $start)->where('tanggal_input <=', $end)->findAll();

				if (!is_null($data) && count($data) > 0) {
					$tbl = '';

					foreach ($data as $d) {
						$tbl .= '
                        
                                    <div style="overflow-x:auto;">
                                        <table class="" width="100%" style="border: 1px dotted #D49400;">
                                            <tr>
                                                <th class="pl-2">Chart</th>
                                                <td class="">: ' . $d['judul_tsakti'] . '</td>
                                            </tr>
                                            <tr>
                                                <th class="pl-2">Tanggal</th>
                                                <td class="tg-0pky">: ' . $d['tanggal_input'] . '</td>
                                            </tr>
                                            <tr>
                                                <th class="pl-2">Ukuran</th>
                                                <td class="">: ' . $d['ukuran'] . '</td>
                                            </tr>
                                            <tr>
                                                <th class="pl-2">Download</th>
                                                <td class="">: <a href="#" id="tabledownload" value="' . $d['filename'] . '"><i class="fas fa-download"></i></a></td>
                                            </tr>
                                        </table>
                                    </div><br>
                                    
                    ';
					}

					return json_encode([
						'success'        => '1',
						'data'            => $tbl,
						'reason'        => 'Success',
						'description'    => 'Table data ditemukan.'
					]);
				} else {
					return json_encode([
						'success'        => '0',
						'reason'        => 'Data Not Found',
						'description'    => 'Table data sakti tidak ditemukan.'
					]);
				}
			} else {
				return json_encode([
					'success'        => '0',
					'reason'        => 'Invalid Date',
					'description'    => 'Please set the right date.'
				]);
			}
		}
	}

	public function videotutor($kode)
	{
		//echo $email;
		$videoutama = $this->videoModel->getVideo('Video Utama');
		$videorekomendasi = $this->videoModel->getVideo('Rekomendasi Video');
		$videoapps = $this->videoModel->getVideo('Tutorial PanenSaham Apps');

		$lvl = $kode;
		//$lvl	= $this->usr->getuserlvl($email);
		$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
		$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
		$cnt	= $this->ntf->getcount($ntf, $npy);

		$data = array(
			'title'    => 'Video Edukasi',
			'video_utama' => $videoutama,
			'video_rekomendasi' => $videorekomendasi,
			'video_apps' => $videoapps,
			'ntf'	=> $ntf,
			'npy'	=> $npy,
			'cnt'	=> $cnt,
			'lvl'	=> $lvl,
		);
		return view('mobile/view_video_edukasi', $data);
	}

	public function chart($kode)
	{
		$lvl	= $kode;
		$ntf	= $this->ntf->getnotifserver(getsession('email'), $lvl);
		$npy	= $this->ntf->getnotifpayment(getsession('email'), $lvl);
		$cnt	= $this->ntf->getcount($ntf, $npy);

		$data = array(
			'title'    => 'Chart Teknikal Analisis',
			'ntf'	=> $ntf,
			'npy'	=> $npy,
			'cnt'	=> $cnt,
			'lvl'	=> $lvl,
		);
		return view('mobile/view_chart', $data);
	}

	public function getfachart()
	{
		$commandchart	= $this->request->getVar('commandchart');
		$data			= explode(" ", $commandchart);
		$command		= $data[0];
		$lvl			= $this->request->getVar('kode');
		$kodefa			= array("/ps1", "/ps2", "/ps3", "/ps4", "/ps5", "/ps6", "/ps7", "/ps8", "/ps9", "/ps10");

		$kodear			= array(
			"/cmamm", "/cmaww", "/cmadd", "/cmahh", "/cma30", "/cma15", "/cma05",
			"/ccomm", "/ccoww", "/ccodd", "/ccohh", "/cco30", "/cco15", "/cco05",
			"/calmm", "/calww", "/caldd", "/calhh", "/cal30", "/cal15", "/cal05",
			"/cahmm", "/cahww", "/cahdd", "/cahhh", "/cah30", "/cah15", "/cah05",
			"/casmm", "/casww", "/casdd", "/cashh", "/cas30", "/cas15", "/cas05",
			"/cfrdd",
			"/ctlmm", "/ctlww", "/ctldd", "/ctlhh", "/ctl30", "/ctl15", "/ctl05",
			"/odtmm", "/odtww", "/odtdd", "/odthh", "/odt30", "/odt15", "/odt05",
			"/pslmm", "/pslww", "/psldd", "/pslhh", "/psl30", "/psl15", "/psl05",
			"/cfnmm", "/cfnww", "/cfndd", "/cfnhh", "/cfn30", "/cfn15", "/cfn05", "/cfn01",
			"/apsmm", "/apsww", "/apsdd", "/apshh", "/aps30", "/aps15", "/aps05"
		);

		if ($command != '/f' || $command != '/fa') {
			if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV004') {

				if ($lvl == 'MULV001') {
					$trial = array("/ctldd", "/ctlww");

					if (!in_array(strtolower($command), $trial)) {
						return json_encode([
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Gagal mencari data, Level akses anda kurang',
						]);
					}
				}

				if (in_array(strtolower($command), $kodear)) {
					if (isset($data[1])) {
						$kode = '%20' . $data[1];
					}

					// $content = json_decode(file_get_contents('http://192.168.21.134/botaps01/custombot.php?command=' . $command . $kode));
					$content = json_decode(file_get_contents('http://lb.local:10180/botaps01/custombot.php?command=' . $command . $kode));

					if (isset($content->data)) {
						$bs64 = explode(',', $content->data);
						$gambar = base64_decode($bs64[1]);
						$email = md5($lvl);

						if (!write_file('./public/assets/img/chart/' . $email . '.jpg', $gambar)) {
							return json_encode([
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Terjadi kesalahan saat mengambil data, silahkan coba lagi',
							]);
						} else {
							$data = array(
								'gambar' => base_url() . '/public/assets/img/chart/' . $email . '.jpg',
							);

							echo json_encode([
								'status' => 200,
								'error' => FALSE,
								'messages' => $data,
							]);
						}
					} else {
						return json_encode([
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Gagal mencari data, Silahkan coba lagi atau contact administrator',
						]);
					}
				} else {
					return json_encode([
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
					]);
				}
			} else {
				return json_encode([
					'status' => 500,
					'error' => TRUE,
					'messages' => 'Gagal mencari data, Level akses anda kurang',
				]);
			}
		} else {
			return json_encode([
				'status' => 500,
				'error' => TRUE,
				'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
			]);
		}
	}

	public function mshowchartuser()
	{
		if ($this->request->isAJAX()) {
			$commandchart	= $this->request->getPost('commandchart', FILTER_SANITIZE_STRING);
			$kodelvl		= $this->request->getPost('kode', FILTER_SANITIZE_STRING);
			$data			= explode(" ", $commandchart);
			$command		= $data[0];
			$kode			= '';
			$intvl			= '';
			$date 			= new \DateTime();
			$tmp 			= $date->getTimestamp();
			$lvl			= $kodelvl;
			$kodefa			= array("/ps1", "/ps2", "/ps3", "/ps4", "/ps5", "/ps6", "/ps7", "/ps8", "/ps9", "/ps10");
			//$kodear			= array("/cma", "/cco", "/cal", "/cah", "/cas", "/cfn", "/ctl", "/odt", "/psl", "/cfr", "/aps");
			$kodear			= array(
				"/cmamm", "/cmaww", "/cmadd", "/cmahh", "/cma30", "/cma15", "/cma05",
				"/ccomm", "/ccoww", "/ccodd", "/ccohh", "/cco30", "/cco15", "/cco05",
				"/calmm", "/calww", "/caldd", "/calhh", "/cal30", "/cal15", "/cal05",
				"/cahmm", "/cahww", "/cahdd", "/cahhh", "/cah30", "/cah15", "/cah05",
				"/casmm", "/casww", "/casdd", "/cashh", "/cas30", "/cas15", "/cas05",
				"/cfrdd",
				"/ctlmm", "/ctlww", "/ctldd", "/ctlhh", "/ctl30", "/ctl15", "/ctl05",
				"/odtmm", "/odtww", "/odtdd", "/odthh", "/odt30", "/odt15", "/odt05",
				"/pslmm", "/pslww", "/psldd", "/pslhh", "/psl30", "/psl15", "/psl05",
				"/cfnmm", "/cfnww", "/cfndd", "/cfnhh", "/cfn30", "/cfn15", "/cfn05", "/cfn01",
				"/apsmm", "/apsww", "/apsdd", "/apshh", "/aps30", "/aps15", "/aps05"
			);

			if ($command != '/f') {
				if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV004') {

					if ($lvl == 'MULV001') {
						//$trial = array("/cah", "/cco", "/odt");
						$trial = array("/ctldd", "/ctlww");

						if (!in_array(strtolower($command), $trial)) {
							return json_encode([
								'success'		=> '0',
								'result'		=> 'Low Level Access (1)',
								'reason'		=> 'Gagal Mencari',
								'description'	=> 'Gagal mencari data, Level akses anda kurang'
							]);
						}
					}

					if (in_array(strtolower($command), $kodear)) {
						if (isset($data[1])) {
							$kode = '%20' . $data[1];
						}

						$content = json_decode(file_get_contents('http://lb.local:10180/botaps01/custombot.php?command=' . $command . $kode . $intvl));

						if (isset($content->data)) {
							$bs64 = explode(',', $content->data);
							$gambar = base64_decode($bs64[1]);
							$email = md5session('email');

							if (!write_file('./public/assets/img/chart/' . $email . '.jpg', $gambar)) {
								return json_encode([
									'success'		=> '0',
									'result'		=> 'Gagal Simpan',
									'reason'		=> 'Gagal Mengambil Data',
									'description'	=> 'Terjadi kesalahan saat mengambil data, silahkan coba lagi'
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

	public function tabel($kode)
	{
		$lvl	= $kode;
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
		return view('mobile/view_tabel', $data);
	}

	public function tabel_fa($kode)
	{
		$lvl	= $kode;
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
		return view('mobile/view_tabel_fa', $data);
	}

	public function mshowtableuser()
	{
		if ($this->request->isAJAX()) {
			$input			= $this->request->getPost('commandtable', FILTER_SANITIZE_STRING);
			$kodelvl		= $this->request->getPost('kode', FILTER_SANITIZE_STRING);
			$data			= explode(" ", $input);
			$command		= $data[0];
			$kode			= '';
			$intvl			= '';
			$date 			= new \DateTime();
			$tmp 			= $date->getTimestamp();
			$lvl			= $kodelvl;
			$kodedaily		= array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "ps200", "rg3", "stoup", "swb", "ungu", "hold", "ps20", "asin", "warkop");
			$kodeintra		= array("fan15", "fan05", "swb15", "tektok");

			$this->usr->update_lastaccess(getsession('email'));

			if ($command == strtolower('/f')) {
				if ($lvl != '' && $lvl != 'MULV004') {
					if (isset($data[1])) {
						$kode = '%20' . $data[1];
					}

					if ($lvl == 'MULV001') {
						$trial = array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "ps200", "rg3", "stoup", "swb", "ungu", "hold", "ps20", "asin", "warkop", "fan15", "fan05", "swb15", "tektok");
						if (!in_array(strtolower($data[1]), $trial)) {
							return json_encode([
								'success'		=> '0',
								'result'		=> 'Gagal Cari',
								'reason'		=> 'Gagal Mencari',
								'description'	=> 'Gagal mencari data, Level akses anda kurang'
							]);
						}
					}

					if ($lvl == 'MULV002') {
						$biasa = array("ps20",);
						if (!in_array(strtolower($data[1]), $biasa)) {
							return json_encode([
								'success'		=> '0',
								'result'		=> 'Gagal Cari',
								'reason'		=> 'Gagal Mencari',
								'description'	=> 'Gagal mencari data, Level akses anda kurang'
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
						// $content = json_decode(file_get_contents('http://lb-lokal:10180/botaps01/custombotfilh.php?command=' . $command . $kode));
						// $content = json_decode(file_get_contents('http://192.168.5.145/botpsb/custombot1.php?command=' . $command . $kode));
						$content = json_decode(file_get_contents('http://192.168.23.141/botaps01/custombotfilh.php?command=' . $command . $kode));
						//$content = json_decode(file_get_contents('http://bot.panensaham.com/botaps01/custombotfilc.php?command=' . $command . $kode));

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
	// 		$kodear			= array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "ps200", "rg3", "stoup", "swb", "ungu", "hold", "ps20", "asin", "warkop");

	// 		if ($command == strtolower('/f')) {
	// 			if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV004') {
	// 				if (isset($data[1])) {
	// 					$kode = '%20' . $data[1];
	// 				}

	// 				if ($lvl == 'MULV001') {
	// 					$trial = array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "ps200", "rg3", "stoup", "swb", "ungu", "hold", "ps20", "asin", "warkop");

	// 					if (!in_array(strtolower($data[1]), $trial)) {
	// 						return json_encode([
	// 							'success'		=> '0',
	// 							'result'		=> 'Gagal Cari' . $kode,
	// 							'reason'		=> 'Gagal Mencari',
	// 							'description'	=> 'Gagal mencari data, Level akses anda kurang'
	// 						]);
	// 					}
	// 				}

	// 				if (in_array(strtolower($data[1]), $kodear)) {
	// 					$content = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot.php?command=' . $command . $kode));

	// 					if (isset($content->data) && $content->data != '') {
	// 						$bs64 = base64_decode($content->data);

	// 						//Hapus Gapenting
	// 						$bs64 = strstr($bs64, '<TABLE border=0>');
	// 						$bs64 = strstr($bs64, '</BODY>', true);

	// 						//Insert <thead> sama </thead>
	// 						$pos1 = stripos($bs64, '<tr>');
	// 						$bs64 = substr_replace($bs64, '<thead>', $pos1, 0);

	// 						$pos2 = stripos($bs64, '</tr>');
	// 						$bs64 = substr_replace($bs64, '</thead>', $pos2 + 5, 0);

	// 						//Insert <tbody> sama </tbody>
	// 						//gajadi

	// 						return json_encode([
	// 							'success'		=> '1',
	// 							'result'		=> $bs64,
	// 							'reason'		=> 'Search Success',
	// 							'description'	=> 'Search Success, Showing data....'
	// 						]);
	// 					} else {
	// 						return json_encode([
	// 							'success'		=> '0',
	// 							'result'		=> 'Gagal Cari',
	// 							'reason'		=> 'Gagal Mencari',
	// 							'description'	=> 'Gagal mencari data, Silahkan coba lagi atau contact administrator'
	// 						]);
	// 					}
	// 				} else {
	// 					return json_encode([
	// 						'success'		=> '0',
	// 						'result'		=> 'Invalid Code',
	// 						'reason'		=> 'Invalid Code',
	// 						'description'	=> 'Code yang anda masukkan salah, silahkan coba lagi'
	// 					]);
	// 				}
	// 			} else {
	// 				return json_encode([
	// 					'success'		=> '0',
	// 					'result'		=> 'Gagal Cari',
	// 					'reason'		=> 'Gagal Mencari',
	// 					'description'	=> 'Gagal mencari data, Level akses anda kurang'
	// 				]);
	// 			}
	// 		} else {
	// 			return json_encode([
	// 				'success'		=> '0',
	// 				'result'		=> 'Invalid Command',
	// 				'reason'		=> 'Invalid Command',
	// 				'description'	=> 'Command yang anda masukkan salah, silahkan coba lagi'
	// 			]);
	// 		}
	// 	}
	// }

	public function test()
	{
		// echo file_get_contents('https://bot.panensaham.com/botaps01/custombot1.php?command=cma&interval=dd&ticker=bmri');
		// echo file_get_contents('https://bot.panensaham.com/botaps01/custombotfilh.php?command=/f%20swb15');
		// echo file_get_contents('http://192.168.5.145/botpsb/custombotfil1.php?command=/fa%20pebv5');
		// echo file_get_contents('http://ami-filter-ta/botaps01/custombot1.php?command=/f%20swb');
		//echo file_get_contents('http://lb.local:10180/botaps01/custombot1.php?command=cma&ticker=bmri&interval=dd');
		echo file_get_contents('http://192.168.5.116:11181/cah/dd/asii');
	}

	public function mshowtableuserfa()
	{
		if ($this->request->isAJAX()) {
			$input			= $this->request->getPost('commandtable', FILTER_SANITIZE_STRING);
			$kodelvl		= $this->request->getPost('kode', FILTER_SANITIZE_STRING);
			$data			= explode(" ", $input);
			$command		= $data[0];
			$kode			= '';
			$intvl			= '';
			$date 			= new \DateTime();
			$tmp 			= $date->getTimestamp();
			$lvl			= $kodelvl;
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
								'reason'		=> 'Gagal Mencari',
								'description'	=> 'Gagal mencari data, Level akses anda kurang'
							]);
						}
					}

					if (in_array(strtolower($data[1]), $kodear)) {

						//$content = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot.php?command=' . $command . $kode));
						//$content = json_decode(file_get_contents('https://b368cf66fa9f.ngrok.io/botpsb/custombotfil.php?command=' . $command . $kode));
						// $content = json_decode(file_get_contents('http://192.168.5.145/botpsb/custombotfil1.php?command=' . $command . $kode));
						// $content = json_decode(file_get_contents('http://lb-lokal:10380/botpsb/custombotfil.php?command=' . $command . $kode));
						// $content = json_decode(file_get_contents('http://192.168.5.145/botpsb/custombotfil.php?command=' . $command . $kode));
						$content = json_decode(file_get_contents('http://192.168.23.145/botpsb/custombotfil.php?command=' . $command . $kode));

						if (isset($content->data) && $content->data != '') {
							$bs64 = base64_decode($content->data);
							//$bs64 = base64_decode("VGlja2VyLERhdGUvVGltZSxQZXJpb2QsRVBTIEdyb3d0aCAoUW9RKSAlLFNhbGVzIChKdXRhKSxERVIKQUNTVCwyNy8xMi8yMDIxLFEzLTIwMjEsMjE2LjM4LDEwODA2MTksMS4xNgpBU1JJLDI3LzEyLzIwMjEsUTMtMjAyMSw1OS4wMCwxNzcxODU1LDEuMzYKQkFOSywyNy8xMi8yMDIxLFEzLTIwMjEsMTE1NC4yOSwyODM5OCwwLjA0CkJJUkQsMjcvMTIvMjAyMSxRMy0yMDIxLDE4MjEuMzMsMTQ0OTg0OSwwLjMxCkJSTkEsMjQvMTIvMjAyMSxRMy0yMDIxLDIwMC4yNiw3ODU0OTQsMS42NgpDVEJOLDI3LzEyLzIwMjEsUTMtMjAyMSwxMjYuOTgsODg2NjEzLDAuMzAKRElMRCwyNy8xMi8yMDIxLFEzLTIwMjEsMTA0LjcxLDE4MjgwMDksMS45NwpHSUFBLDI0LzEyLzIwMjEsUTMtMjAyMSw0NS4wNywxMzUwMTM1OCwtMy42NApHTVRELDI0LzEyLzIwMjEsUTMtMjAyMSwxMDMuNTUsMTA5NzU1LDAuOTIKSE9NRSwyNC8xMi8yMDIxLFEzLTIwMjAsMTMzLjMzLDEwMjQ5LDAuMTYKS1JFTiwyNy8xMi8yMDIxLFEyLTIwMjEsMjIuODAsNjI1NjAyOCwwLjY0Ck1BUkksMjcvMTIvMjAyMSxRMy0yMDIxLDIyNy41OSw0ODQyMywwLjY4Ck1URk4sMjcvMTIvMjAyMSxRMy0yMDIxLDIzLjgxLDI1MDEwNywtMjUuMTQKTkFUTywyNy8xMi8yMDIxLFEzLTIwMjEsNTAuMDAsODAwLDAuMDAKUE9SVCwyNy8xMi8yMDIxLFEzLTIwMjEsMzk2LjE3LDk5NDA5MiwxLjMxClNUQVIsMjcvMTIvMjAyMSxOL0EsaW5mLDI4MjgyLGluZgpUUklPLDI0LzEyLzIwMjEsUTMtMjAyMSwxMzAwLjAwLDM0NjQwOSwtMS4wNQ==");

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
