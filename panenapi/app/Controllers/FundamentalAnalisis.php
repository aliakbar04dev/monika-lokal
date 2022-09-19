<?php

namespace App\Controllers;

use App\Models\TblSaktiModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class FundamentalAnalisis extends BaseController
{
	use ResponseTrait;

	public function getChart()
	{
		$key = $this->myKey();

		$authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '') {
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		} else {
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
				$kodear			= array("/ps1", "/ps2", "/ps3", "/ps4", "/ps5", "/ps6", "/ps7", "/ps8", "/ps9", "/ps10");

				if ($command != '/f' || $command != '/fa') {
					if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV003') {

						if ($lvl == 'MULV001') {
							$trial = array("/ps1", "/ps2", "/ps3", "/ps4", "/ps5", "/ps7", "/ps8", "/ps9", "/ps10");

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
							$content = json_decode(file_get_contents('http://192.168.23.145/botpsb/custombot1.php?command=' . $command . $kode));
							// $content = json_decode(file_get_contents('http://lb-lokal:10380/botpsb/custombot.php?command=' . $command . $kode));
							//$content = json_decode(file_get_contents('https://bot2.panensaham.com/botaps01/custombot.php?command=' . $command . $kode));

							if (isset($content->data)) {
								$bs64 = explode(',', $content->data);
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
		if ($authHeader != '') {
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		} else {
			$response = [
				'status' => 401,
				'error' => TRUE,
				'type' => 'request',
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
				$kodear			= array("ps1", "ps2", "ps3", "ps4", "ps5", "ps6", "ps7", "ps8", "ps9", "ps10");

				if ($command != '/f' || $command != '/fa') {
					if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV003') {

						if ($lvl == 'MULV001') {
							//$trial = array("/ps1", "/ps2", "/ps3", "/ps4", "/ps5", "/ps7", "/ps8", "/ps9", "/ps10");
							$trial = $kodear;

							if (!in_array(strtolower($daftar), $trial)) {
								return json_encode([
									'status' => 500,
									'error' => TRUE,
									'type' => 'akses',
									//'messages' => 'Gagal mencari data, Level akses anda kurang',
									'messages' => 'Maaf Anda belum berlangganan Fitur ini Silahkan klik disini untuk berlangganan',
								]);
							}
						}

						if (in_array(strtolower($daftar), $kodear)) {
							if (isset($data[1])) {
								$kode = '%20' . $data[1];
							}

							//$content = json_decode(file_get_contents('http://lb-lokal:10380/botpsb/custombot.php?command=' . $command . $kode));
							//$content = json_decode(file_get_contents('https://bot2.panensaham.com/botaps01/custombot.php?command=' . $command . $kode));
							// $content = json_decode(file_get_contents('https://devfa.panensaham.com/botpsb/custombot1.php?command='.$daftar.'&interval='.$interval.'&ticker='.$simbol));
							//$content = json_decode(file_get_contents('https://devfa.panensaham.com/botpsb/custombot1.php?command=ps1&interval=dd&ticker=asii'));
							$content = json_decode(file_get_contents('http://192.168.23.145/botpsb/custombot1.php?command=' . $daftar . '&interval=' . $interval . '&ticker=' . $simbol));

							if (isset($content->data)) {
								$bs64 = explode(',', $content->data);
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
									'type' => 'request',
									'messages' => 'Gagal mencari data, Silahkan coba lagi atau contact administrator',
								];
								return $this->respondCreated($response);
							}
						} else {
							$response = [
								'status' => 500,
								'error' => TRUE,
								'type' => 'request',
								'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
							];
							return $this->respondCreated($response);
						}
					} else {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'type' => 'request',
							'messages' => 'Gagal mencari data, Level akses anda kurang',
						];
						return $this->respondCreated($response);
					}
				} else {
					$response = [
						'status' => 500,
						'error' => TRUE,
						'type' => 'request',
						'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
					];
					return $this->respondCreated($response);
				}
			}
		} catch (Exception $ex) {
			$response = [
				'status' => 401,
				'error' => TRUE,
				'type' => 'request',
				'messages' => 'Access denied'
			];
			return $this->respondCreated($response);
		}
	}

	function getTable()
	{
		$key = $this->myKey();

		$authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '') {
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		} else {
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
				$kodear			= array("pebv5", "grow", "bara", "per", "pbv");

				if ($command == strtolower('/fa')) {
					if ($lvl != '' && $lvl != 'MULV002' && $lvl != 'MULV003') {
						if (isset($data[1])) {
							$kode = '%20' . $data[1];
						}

						if ($lvl == 'MULV001') {
							$trial = array("pebv5", "grow", "potensi", "bara");

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
							// $content = json_decode(file_get_contents('http://lb-lokal:10380/botpsb/custombotfil1.php?command=' . $command . $kode));
							$content = json_decode(file_get_contents('http://192.168.23.145/botpsb/custombotfil.php?command=' . $command . $kode));

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

							$response = [
								'status' => 200,
								'error' => FALSE,
								'messages' => $final_data,
							];
							return $this->respondCreated($response);
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
}
