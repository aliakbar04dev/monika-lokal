<?php

namespace App\Controllers;

class CustomApi extends BaseController
{

	public function __construct()
	{
		
	}
	
	public function getfachart()
	{
		$commandchart	= $this->request->getVar('commandchart');
		$data			= explode(" ", $commandchart);
		$command		= $data[0];
		$lvl			= $this->request->getVar('kode');
		$kodefa			= array("/ps1", "/ps2", "/ps3", "/ps4", "/ps5", "/ps6", "/ps7", "/ps8", "/ps9","/ps10");
		
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

					$content = json_decode(file_get_contents('http://lb-lokal:10280/botaps01/custombot.php?command=' . $command . $kode));

					//$content = json_decode(file_get_contents('https://bot2.panensaham.com/botaps01/custombot.php?command=' . $command . $kode));

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
}
