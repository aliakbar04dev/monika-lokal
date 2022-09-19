<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserTmpModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Sms extends BaseController
{
	use ResponseTrait;

	function register()
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
				$userModel = new UserModel();
				$userTmpModel = new UserTmpModel();

				$nohp = $this->request->getVar('no_hp');
				//$otp  = $this->get_random_number();
				$otp  = $this->generateNumericOTP(6);
				$pesan = "Terima kasih sudah registrasi ke Monika PanenSaham. Verikasi akunmu dengan memasukkan kode " . $otp . " untuk menyelesaikan registrasi";

				if ($nohp != '') {
					$usr = $userTmpModel->select('kode_user')->where('regis_no_hp', $nohp)->where('is_verif', 0)->first();

					if (!is_null($usr) && count($usr) > 0) {
						$data = [
							'regis_otp'	=> $otp,
						];

						$userTmpModel->update($usr['kode_user'], $data);

						$this->otpsms($nohp, $pesan);

						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Sms has sent succesfully',
						];
						return $this->respondCreated($response);
					} else {
						$response = [
							'status' => 500,
							'error' => FALSE,
							'messages' => 'Phone not registered',
						];
						return $this->respondCreated($response);
					}
				} else {
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Process has refused'
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

	function resetphone()
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
				$userModel = new UserModel();

				$nohp = $this->request->getVar('no_hp');
				$pass = md5($this->request->getVar('password'));
				//$otp  = $this->get_random_number();
				$otp  = $this->generateNumericOTP(6);
				$pesan = "Kami menerima permintaan perubahan password akun Monika PanenSaham anda. Masukkan kode " . $otp . " untuk melanjutkan proses perubahan password";

				if ($nohp != '' && $pass != '') {
					$usr = $userModel->select('kode_user')->where('no_hp', $nohp)->where('is_verif', 1)->where('password', $pass)->first();

					if (!empty($usr)) {
						if (!is_null($usr) && count($usr) > 0) {
							$data = [
								'verif_kode'	=> $otp,
							];

							$userModel->update($usr['kode_user'], $data);

							$this->otpsms($nohp, $pesan);

							$response = [
								'status' => 200,
								'error' => FALSE,
								'messages' => 'Sms has sent succesfully',
							];
							return $this->respondCreated($response);
						} else {
							$response = [
								'status' => 500,
								'error' => FALSE,
								'messages' => 'Phone not registered',
							];
							return $this->respondCreated($response);
						}
					} else {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Incorrect password'
						];
						return $this->respondCreated($response);
					}
				} else {
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Process has refused'
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

	private function get_random_number()
	{
		$today = date('YmdHi');
		$startDate = date('YmdHi', strtotime('-10 days'));
		$range = $today - $startDate;
		$rand1 = rand(0, $range);
		$rand2 = rand(0, 600000);
		return $value = ($rand1 + $rand2);
	}

	private function generateNumericOTP($n)
	{
		// Take a generator string which consist of 
		// all numeric digits 
		$generator = "1357902468";

		// Iterate for n-times and pick a single character 
		// from generator and append it to $result 

		// Login for generating a random character from generator 
		//     ---generate a random number 
		//     ---take modulus of same with length of generator (say i) 
		//     ---append the character at place (i) from generator to result 

		$result = "";

		for ($i = 1; $i <= $n; $i++) {
			$result .= substr($generator, (rand() % (strlen($generator))), 1);
		}

		// Return result 
		return $result;
	}

	private function otpsms($to, $text)
	{
		//$to = $this-uri->segment(3);
		//$text = $this->uri->segment(4);

		$pecah              = explode(",", $to);
		$jumlah             = count($pecah);
		$from               = "PanenSaham"; //Sender ID or SMS Masking Name, if leave blank, it will use default from telco
		$apikey             = "03f0394d9437b3e5c9163cd236e8a686-a97c4265-b5a1-4c45-a039-687ecc7397e1"; //get your API KEY from our sms dashboard
		$postUrl            = "https://api.smsviro.com/restapi/sms/1/text/advanced"; # DO NOT CHANGE THIS

		for ($i = 0; $i < $jumlah; $i++) {
			if (substr($pecah[$i], 0, 2) == "62" || substr($pecah[$i], 0, 3) == "+62") {
				$pecah = $pecah;
			} elseif (substr($pecah[$i], 0, 1) == "0") {
				$pecah[$i][0] = "X";
				$pecah = str_replace("X", "62", $pecah);
			} else {
				echo "Invalid mobile number format";
			}
			$destination = array("to" => $pecah[$i]);
			$message     = array(
				"from" => $from,
				"destinations" => $destination,
				"text" => $text
			);
			$postData           = array("messages" => array($message));
			$postDataJson       = json_encode($postData);
			$ch                 = curl_init();

			curl_setopt($ch, CURLOPT_URL, $postUrl);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json', "Accept:application/json",
				'Authorization: App ' . $apikey
			));
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$responseBody = json_decode($response);

			$data = array(
				"responseCode" => 200,
				"responseDescription" => "Sms has been sent",
			);

			//echo json_encode($data);
			curl_close($ch);
		}
	}
}
