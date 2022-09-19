<?php namespace App\Controllers;

use App\Models\ApiModel;

class MyApi extends BaseController
{
	protected $apiModel;

	public function __construct()
	{
		$this->apiModel = new ApiModel();
	}
	
	public function index()
	{	
		date_default_timezone_set("Asia/Bangkok");
		$desc = $this->request->getGet('message');
		//echo $desc;
		$data = [
                    'kode_notif' => "NTF-" . time() . date('hms'),
                    'tittle' => 'Auto notification from AMI',
                    'description' => $desc,
					'created_at' => date('Y-m-d'),
					'is_broadcast' => 1,
                ];
		
		$this->apiModel->insert($data);
		
		$json = array(
			'status_code' => 200,
			'status' => 'Sukses',
		);
		
		echo json_encode($json);
	}
	
	public function otpsms($to, $text)
	{
		//$to = $this-uri->segment(3);
		//$text = $this->uri->segment(4);
		
		$pecah              = explode(",",$to);
		$jumlah             = count($pecah);
		$from               = "PanenSaham"; //Sender ID or SMS Masking Name, if leave blank, it will use default from telco
		$apikey             = "03f0394d9437b3e5c9163cd236e8a686-a97c4265-b5a1-4c45-a039-687ecc7397e1"; //get your API KEY from our sms dashboard
		$postUrl            = "https://api.smsviro.com/restapi/sms/1/text/advanced"; # DO NOT CHANGE THIS
		
		for($i=0; $i<$jumlah; $i++){
			if(substr($pecah[$i],0,2) == "62" || substr($pecah[$i],0,3) == "+62"){
				$pecah = $pecah;
			}elseif(substr($pecah[$i],0,1) == "0"){
				$pecah[$i][0] = "X";
				$pecah = str_replace("X", "62", $pecah);
			}else{
				echo "Invalid mobile number format";
			}
			$destination = array("to" => $pecah[$i]);
			$message     = array("from" => $from,
								 "destinations" => $destination,
								 "text" => $text);
			$postData           = array("messages" => array($message));
			$postDataJson       = json_encode($postData);
			$ch                 = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $postUrl);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Accept:application/json", 
														   'Authorization: App '.$apikey)); 
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
				
				echo json_encode($data);
				curl_close($ch);
		}   
	}
}