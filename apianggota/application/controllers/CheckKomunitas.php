<?php
defined('BASEPATH') OR exit('No direct script access are allowed');

class CheckKomunitas extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('KomunitasModel');
	}
	
	public function index()
	{
		$data = $this->input->post('client_id');
		
		$result = $this->KomunitasModel->check($data);
		
		if (!empty($result) > 0)
		{
			$response = [
				'status' => 200,
				'error' => FALSE,
				'messages' => 'Account verified',
				'data' => $result,
			];
						
			echo json_encode($response);
		}
		else
		{
			$response = [
				'status' => 500,
				'error' => FALSE,
				'messages' => 'Account not found',
			];
			
			echo json_encode($response);
		}
	}
}