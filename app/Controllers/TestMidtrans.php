<?php

namespace App\Controllers;

class TestMidtrans extends BaseController{
	
	public function index()
	{
		if(!hassession('email')){
			return view('');
		}else{
			return view('testmidtrans/viewmidtrans');
		}
	}
	
	public function transaction(){
		$AUTH_STRING = 'Basic '.base64_encode(SERVERKEY.':');
		$result = '';
		$httpcode = '';
		
		/*
			201 = Berhasil
			400 = Udah Bayar
			401 = AUTH Salah
		*/
		
		$data = array(
			'transaction_details' => array(
				'order_id' => 'TEST-ORDER-000003',
				'gross_amount' => 567800,
			),
			'credit_card' => array(
				'secure' => true
			),
			'customer_details' => array(
				'first_name' => getsession('nama'),
				'email' => getsession('email'),
				'phone' => getsession('nohp'),
			),
		);
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, MIDTRANSURL);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: '.$AUTH_STRING,
			'Accept: application/json',
			'Content-Type: application/json',
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
		$result = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		$result = json_decode($result);
		
		if($httpcode == 201){
			return json_encode([
				'success'		=> '1',
				'token'			=> $result->token,
				'reason'		=> 'Search Success',
				'description'	=> 'Search Success, Showing graph....'
			]);
		}else{
			return json_encode([
				'success'		=> '0',
				'checkthis'		=> $result,
				'reason'		=> 'Payment failed',
				'description'	=> 'Something Wrong.....',
			]);
		}
	}
}
?>