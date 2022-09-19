<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = array(
			'title' => 'Home'
		);
		return view('welcome_message');
	}

	//--------------------------------------------------------------------

}
