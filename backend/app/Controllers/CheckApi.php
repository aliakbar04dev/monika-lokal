<?php namespace App\Controllers;

use App\Models\KomunitasModel;

class CheckApi extends BaseController
{
	protected $komunitasModel;
	
	public function __construct()
	{
		$this->komunitasModel = new KomunitasModel();
	}
	
	public function checkKomunitas()
	{
		$clientid = $this->request->getVar("client_id");
		
		//echo "Test";
		//echo $clientid;
		
		if ($clientid != '')
		{
			$data = $komunitasModel->check($clientid);
			
			$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Success',
							'data' => $data[0]
						];
					
			echo json_encode($response);
		}
		else
		{
			$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'User not found'
						];
			echo json_encode($response);
		}
	}
}