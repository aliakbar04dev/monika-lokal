<?php

namespace App\Controllers;

class Api extends BaseController
{

	public function __construct()
	{
	}

	public function gettachart()
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
					$trial = array("/ctlmm");

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

	public function gettatable()
	{
		$commandchart	= $this->request->getGet('commandchart');
		$data			= explode(" ", $commandchart);
		$command		= $data[0];
		$lvl			= $this->request->getGet('kode');
		$kodear			= array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "pita", "rg3", "stoup", "swb", "ma510", "hold", "asin", "warkop");

		if ($command == strtolower('/f')) {
			if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV004') {
				if (isset($data[1])) {
					$kode = '%20' . $data[1];
				}

				if ($lvl == 'MULV001') {
					$trial = array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "pita", "rg3", "stoup", "swb", "ma510", "hold", "asin", "warkop");

					if (!in_array(strtolower($data[1]), $trial)) {
						return json_encode([
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Gagal mencari data, Level akses anda kurang',
						]);
					}
				}

				if (in_array(strtolower($data[1]), $kodear)) {
					$DOM = new \DOMDocument();
					//$content = json_decode(file_get_contents('https://9ea246ccc946.ngrok.io/botaps01/custombot1.php?command=' . $command . $kode));
					$content = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot1.php?command=' . $command . $kode));

					$bs64 = base64_decode($content->data);

					$column_name = array();

					$final_data = array();

					$data_array = array_map("str_getcsv", explode("\n", $bs64));

					$labels = array_shift($data_array);

					foreach ($labels as $label) {
						$column_name[] = $label;
					}

					$count = count($data_array) - 1;

					for ($j = 0; $j < $count; $j++) {
						$data = array_combine($column_name, $data_array[$j]);

						$final_data[$j] = $data;
					}

					echo json_encode($final_data);
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

	public function gettatable1()
	{
		$commandchart	= $this->request->getGet('commandchart');
		$data			= explode(" ", $commandchart);
		$command		= $data[0];
		$lvl			= $this->request->getGet('kode');
		$kodear			= array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "pita", "rg3", "stoup", "swb", "ma510", "hold");

		if ($command == strtolower('/f')) {
			if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV004') {
				if (isset($data[1])) {
					$kode = '%20' . $data[1];
				}

				if ($lvl == 'MULV001') {
					$trial = array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "pita", "rg3", "stoup", "swb", "ma510", "hold");

					if (!in_array(strtolower($data[1]), $trial)) {
						return json_encode([
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Gagal mencari data, Level akses anda kurang',
						]);
					}
				}

				if (in_array(strtolower($data[1]), $kodear)) {
					// $content = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot.php?command=' . $command . $kode));

					// if (isset($content->data) && $content->data != '') {
					// $bs64 = base64_decode($content->data);

					// //Hapus Gapenting
					// $bs64 = strstr($bs64, '<TABLE border=0>');
					// $bs64 = strstr($bs64, '</BODY>', true);

					// //Insert <thead> sama </thead>
					// $pos1 = stripos($bs64, '<tr>');
					// $bs64 = substr_replace($bs64, '<thead>', $pos1, 0);

					// $pos2 = stripos($bs64, '</tr>');
					// $bs64 = substr_replace($bs64, '</thead>', $pos2 + 5, 0);

					// 	/*return json_encode([
					// 		'status' => 200,
					// 		'error' => FALSE,
					// 		'messages' => $bs64,
					// 	]);*/

					// 	echo $bs64;
					// } else {
					// 	return json_encode([
					// 		'status' => 500,
					// 		'error' => TRUE,
					// 		'messages' => 'Gagal mencari data, Silahkan coba lagi atau contact administrator',
					// 	]);
					// }


					// $htmlContent = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot.php?command=' . $command . $kode));
					// $result = base64_decode($htmlContent->data);
					// echo $result;

					$html = <<<HTML
<TABLE>
	<thead>
		<TR>
			<TH>Ticker</TH>
			<TH>Date/Time</TH>
			<TH>Close</TH>
			<TH>Persen</TH>
			<TH>Continuation</TH>
			<TH>Spike Vol-1 %</TH>
			<TH>Stokastik</TH>
			<TH>Syariah</TH>
		</TR>
	</thead>
	<TR>
		<TD>AMOR</TD>
		<TD>30/04/2021</TD>
		<TD>3,990</TD>
		<TD>1.79</TD>
		<TD>2</TD>
		<TD>111</TD>
		<TD> UP more than 50 </TD> 
		<TD></TD>
	</TR>
	<TR>
		<TD>BRMS</TD>
		<TD>30/04/2021</TD>
		<TD>90</TD>
		<TD>1.12</TD>
		<TD>2</TD>
		<TD>114</TD>
		<TD> UP below than 50 </TD>
		<TD></TD>
	</TR>
	<TR>
		<TD>DOID</TD>
		<TD>30/04/2021</TD>
		<TD>370</TD>
		<TD>0.54</TD>
		<TD>3</TD>
		<TD>65</TD>
		<TD> UP more than 50 </TD>
		<TD></TD>
	</TR>
	<TR>
		<TD>ZINC</TD>
		<TD>30/04/2021</TD>
		<TD>137</TD>
		<TD>3.79</TD>
		<TD>2</TD>
		<TD>76</TD>
		<TD> UP more than 50 </TD>
		<TD></TD>
	</TR>
</TABLE>
HTML;


					$DOM = new \DOMDocument();
					// $DOM->loadHTML($html);
					//$content = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot.php?command=' . $command . $kode));
					$content = json_decode(file_get_contents('https://9ea246ccc946.ngrok.io/botaps01/custombot1.php?command=' . $command . $kode));

					$bs64 = base64_decode($content->data);

					$column_name = array();

					$final_data = array();

					$data_array = array_map("str_getcsv", explode("\n", $bs64));

					$labels = array_shift($data_array);

					foreach ($labels as $label) {
						$column_name[] = $label;
					}

					$count = count($data_array) - 1;

					for ($j = 0; $j < $count; $j++) {
						$data = array_combine($column_name, $data_array[$j]);

						$final_data[$j] = $data;
					}

					echo json_encode($final_data);

					/* //Hapus Gapenting
							$bs64 = strstr($bs64, '<TABLE border=0>');
							$bs64 = strstr($bs64, '</BODY>', true);

							//Insert <thead> sama </thead>
							$pos1 = stripos($bs64, '<tr>');
							$bs64 = substr_replace($bs64, '<thead>', $pos1, 0);

							$pos2 = stripos($bs64, '</tr>');
							$bs64 = substr_replace($bs64, '</thead>', $pos2 + 5, 0); */

					//echo $bs64;

					/* $array = array_map("str_getcsv", explode("\n", $bs64));
							$json = json_encode($array);
							print_r($json); */

					// $DOM->loadHTML($html);

					// $Header = $DOM->getElementsByTagName('th');
					// $Detail = $DOM->getElementsByTagName('td');

					// //#Get header name of the table
					// foreach($Header as $NodeHeader) 
					// {
					// 	$aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
					// }
					// //print_r($aDataTableHeaderHTML); die();

					// //#Get row data/detail table without header name as key
					// $i = 0;
					// $j = 0;
					// foreach($Detail as $sNodeDetail) 
					// {
					// 	$aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
					// 	$i = $i + 1;
					// 	$j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
					// }

					// //#Get row data/detail table with header name as key and outer array index as row number
					// for($i = 0; $i < count($aDataTableDetailHTML); $i++)
					// {
					// 	for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
					// 	{
					// 		$aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
					// 	}
					// }
					// echo json_encode($aTempData);
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
