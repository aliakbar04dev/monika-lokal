<?php namespace App\Controllers;

use App\Models\TblSaktiModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class TeknikalAnalisis extends BaseController
{
	use ResponseTrait;
	
	public function getChart()
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
					"/chamm", "/chaww", "/chadd", "/chahh", "/cha30", "/cha15", "/cha05",
					"/apsmm", "/apsww", "/apsdd", "/apshh", "/aps30", "/aps15", "/aps05"
				);

				if ($command != '/f' || $command != '/fa') {
					if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV004') {

						if ($lvl == 'MULV001') {
							$trial = array(
							"/cmamm", "/cmaww", "/cmadd",
							"/ccomm", "/ccoww", "/ccodd",
							"/cahmm", "/cahww", "/cahdd",
							"/casmm", "/casww", "/casdd",
							"/cfrdd",
							"/ctlmm", "/ctlww", "/ctldd",
							"/odtmm", "/odtww", "/odtdd",
							"/pslmm", "/pslww", "/psldd",
							"/cfnmm", "/cfnww", "/cfndd",
							"/chamm", "/chaww", "/chadd",
							"/apsmm", "/apsww", "/apsdd");

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

							//$content = json_decode(file_get_contents('http://lb-lokal:10280/botaps01/custombot.php?command=' . $command . $kode));

							//$content = json_decode(file_get_contents('https://bot2.panensaham.com/botaps01/custombot.php?command=' . $command . $kode));
								if ($interval == "dd" || $interval == "ww" || $interval == "mm")
								{
									$endpoint = 'http://lb.carmel.local:8081';
								}
								else if ($interval == "hh" || $interval == "05")
								{
									$endpoint = 'http://192.168.5.143:8081';
								}
								else
								{
									$endpoint = 'http://192.168.5.146:8081';
								}
								
								$content = json_decode(file_get_contents($endpoint.'/'.$daftar.'/'.$interval.'/'.$simbol));
								
							if (isset($content->Data)) {
								$bs64 = explode(',', $content->Data);
								$gambar = base64_decode($bs64[1]);
								$email = md5($lvl) . date('YmdHms');

								if (!write_file('./public/assets/img/chart/' . $email . '.jpg', $gambar)) {
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Terjadi kesalahan saat mengambil data, silahkan coba lagi',
									];
									return $this->respondCreated($response);
								} else {
									$data = array(
										'gambar' => base_url() . '/public/assets/img/chart/' . $email . '.jpg',
									);
			
									$response = [
										'status' => 200,
										'error' => FALSE,
										'messages' => $data,
									];
									return $this->respondCreated($response);
								}
							} else {
								$response = [
									'status' => 500,
									'error' => TRUE,
									'messages' => 'Gagal mencari data, Silahkan coba lagi atau contact administrator',
								];
								return $this->respondCreated($response);
							}
						} else {
							$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
							];
							return $this->respondCreated($response);
						}
					} else {
						$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Gagal mencari data, Level akses anda kurang',
							];
						return $this->respondCreated($response);
					}
				} else {
					$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
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

	public function getChartNew()
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
				$commandchart	= $this->request->getVar('commandchart');
				$daftar			= $this->request->getPost('perintah', FILTER_SANITIZE_STRING);
				$simbol			= $this->request->getPost('simbol', FILTER_SANITIZE_STRING);
				$interval		= $this->request->getPost('interval', FILTER_SANITIZE_STRING);
				$data			= explode(" ", $commandchart);
				$command		= $data[0];
				$lvl			= $this->request->getVar('kode');
				$kodefa			= array("/ps1", "/ps2", "/ps3", "/ps4", "/ps5", "/ps6", "/ps7", "/ps8", "/ps9","/ps10");
				$kodear			= array("cma", "cco", "cal", "cah", "cas", "cfn", "ctl", "odt", "psl", "cfr", "aps", "cha");
				//$trial			= array("cma", "cco", "cal", "cah", "cas", "cfn", "ctl", "odt", "psl", "cfr", "aps", "cha");
				$trial			= array("cah", "cma");

				if ($command != '/f' || $command != '/fa') {
					if ($lvl != '' && $lvl != 'MULV004') {

						if ($lvl == 'MULV002') {
							if (!in_array(strtolower($daftar), $trial)) {
								return json_encode([
									'status' => 500,
									'error' => TRUE,
									'messages' => 'Gagal mencari data, Level akses anda kurang',
								]);
							}
							
							if (strtolower($interval) != "dd" ){
									return json_encode([
										'success'		=> '0',
										'result'		=> 'Low Level Access (1)',
										'reason'		=> 'Gagal Mencari',
										'description'	=> 'Gagal mencari data, Level akses anda kurang',
										'lvl'			=> $lvl
									]);
								}
						}

						if (in_array(strtolower($daftar), $kodear)) {
							if (isset($data[1])) {
								$kode = '%20' . $data[1];
							}

							//$content = json_decode(file_get_contents('http://lb-lokal:10280/botaps01/custombot.php?command=' . $command . $kode));
							//$content = json_decode(file_get_contents('https://bot2.panensaham.com/botaps01/custombot1.php?command='.$daftar.'&interval='.$interval.'&ticker='.$simbol));
							//$content = json_decode(file_get_contents('https://bot2.panensaham.com/botaps01/custombot.php?command=' . $command . $kode));
							
							//$content = json_decode(file_get_contents('http://lb.local:10180/botaps01/custombot1.php?command='.$daftar.'&interval='.$interval.'&ticker='.$simbol));

							if ($interval == "dd" || $interval == "ww" || $interval == "mm")
								{
									$endpoint = 'http://192.168.5.142:8081';
								}
								else if ($interval == "hh" || $interval == "05")
								{
									$endpoint = 'http://192.168.5.143:8081';
								}
								else
								{
									$endpoint = 'http://192.168.5.146:8081';
								}
								
								$content = json_decode(file_get_contents($endpoint.'/'.$daftar.'/'.$interval.'/'.$simbol));
								
							if (isset($content->Data)) {
								$bs64 = explode(',', $content->Data);
								$gambar = base64_decode($bs64[1]);
								$email = md5($lvl) . date('YmdHms');

								if (!write_file('./public/assets/img/chart/' . $email . '.jpg', $gambar)) {
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Terjadi kesalahan saat mengambil data, silahkan coba lagi',
									];
									return $this->respondCreated($response);
								} else {
									$data = array(
										'gambar' => base_url() . '/public/assets/img/chart/' . $email . '.jpg',
									);
			
									$response = [
										'status' => 200,
										'error' => FALSE,
										'messages' => $data,
									];
									return $this->respondCreated($response);
								}
							} else {
								$response = [
									'status' => 500,
									'error' => TRUE,
									'messages' => 'Gagal mencari data, Silahkan coba lagi atau contact administrator',
								];
								return $this->respondCreated($response);
							}
						} else {
							$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
							];
							return $this->respondCreated($response);
						}
					} else {
						$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Gagal mencari data, Level akses anda kurang',
							];
						return $this->respondCreated($response);
					}
				} else {
					$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
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

	function getDescChartTa() {
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
				$html = "<div class=\"col-lg-6 pt-2\">
							<span>Swing Trade Min Trend :<span><br><br>
							<span>/CMA = Chart yang menyajikan Moving Average sebagai overlay Indikator di padukan dengan Stokastik dan volume</span><br>
							<span>/CAL = Chart dengan Indikator alligator yang dicombine dengan indikator Stokastik dan histogram asing</span><br>
							<span>/CTL = Chart multiple trendline yang dicombine dengan indikator stokastik, ADX dan volume</span><br>
							<span>/PSL = Chart diagonal trendline yang dicombine dengan indikator MACD dan volume</span><br><br>
							<span?>Swing Trend Following :</span><br><br>
							<span>/CAH = Chart dynamic trailing ovelay awan ichimoku yang dicombine dengan indikator stokastik dan volume</span><br>
							<span>/CAS = Chart Guppy Moving Average overlay awan ichimoku yang di combine dengan indikator stokastik dan histogram asing</span><br>
						</div>
						<div class=\"col-lg-6 pt-2\">
							<span>Fast Trade :<span><br><br>
							<span>/CFN = Chart spike analizer yang dicombine dengan indikator stokastik, effective player dan volume</span><br>
							<span>/ODT = Chart Moving Average optimize overlay probability indikator yang di combine dengan stokastik dan volume</span><br><br>

							<span>Bottom Fish :<span><br><br>
							<span>/CCO = Chart trend standart deviasi yg ditambahkan overlay flow asing dan dicombine dengan GPS</span><br>
							<span>/APS = Chart gerak putaran saham yang di compare dengan IHSG sebagai base line</span><br>

							<span>Cycle emiten :<span><br><br>
							<span>/CFR = Chart performance saham untuk melihat siklus emiten</span><br><br>
							
							<span>Reversal :<span><br><br>
							<span>/CHA = Chart heiken ashi overlay parabolic SAR yang di combine dengan indikator stokastik, RSI dan volume</span><br>
						</div>";

				$response = [
					'status' => 200,
					'error' => FALSE,
					'messages' => $html,
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
	
	function getTable() {
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
				$commandchart	= $this->request->getGet('commandchart');
				$data			= explode(" ", $commandchart);
				$command		= $data[0];
				$lvl			= $this->request->getGet('kode');
				//$kodear			= array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "pita", "rg3", "stoup", "swb", "ma510", "hold");
				$kodear			= array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "ps200", "rg3", "stoup", "swb", "ungu", "hold", "ps20", "asin", "warkop");
				
				if ($command == strtolower('/f')) 
				{
					if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV004') 
					{
						if (isset($data[1])) {
								$kode = '%20' . $data[1];
						}

							if ($lvl == 'MULV001') {
								$trial = array("bpjs", "bsjp", "bulang", "bull", "gps", "mcd", "ps200", "rg3", "stoup", "swb", "ungu", "hold", "ps20", "asin", "warkop");

								if (!in_array(strtolower($data[1]), $trial)) {
									$response = [
										'status' => 500,
										'error' => TRUE,
										'messages' => 'Gagal mencari data, Level akses anda kurang',
									];
									return $this->respondCreated($response);
								}
							}
						
							if (in_array(strtolower($data[1]), $kodear)) {
								$content = json_decode(file_get_contents('http://ami-filter-ta/botaps01/custombot1.php?command=' . $command . $kode));
									
								$bs64 = base64_decode($content->data);
								
								$column_name = array();

								$final_data = array();

								$data_array = array_map("str_getcsv", explode("\n", $bs64));

								$labels = array_shift($data_array);

								foreach($labels as $label)
								{
									$column_name[] = $label;
								}

								$count = count($data_array) - 1;

								for($j = 0; $j < $count; $j++)
								{
									$data = array_combine($column_name, $data_array[$j]);

									$final_data[$j] = $data;
								}
								
								$response = [
										'status' => 200,
										'error' => FALSE,
										'messages' => $final_data,
									];
								return $this->respondCreated($response);
							} 
							else {
								$response = [
									'status' => 500,
									'error' => TRUE,
									'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
								];
								return $this->respondCreated($response);
							}
					} else {
						$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Gagal mencari data, Level akses anda kurang',
							];
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
								'status' => 500,
								'error' => TRUE,
								'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
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
}