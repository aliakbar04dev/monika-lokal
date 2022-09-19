<?php

namespace App\Controllers;

class Terms_conditions extends BaseController
{
	public function index()
	{
		if (!hassession('email')) {
			$data = array(
				'title' => 'Terms & Conditions'
			);
			return view('terms_conditions/view_terms_conditions', $data);
		}else{
			return redirect()->to('/');
		}
	}

	public function web()
	{
		if (!hassession('email')) {
			$data = array(
				'title' => 'Terms & Conditions'
			);
			return view('terms_conditions/view_terms_conditions_web', $data);
		}else{
			return redirect()->to('/');
		}
	}

	//--------------------------------------------------------------------

}
