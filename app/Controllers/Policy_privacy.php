<?php

namespace App\Controllers;

class Policy_privacy extends BaseController
{
	public function index()
	{
		if (!hassession('email')) {

			$data = array(
				'title' => 'Policy Privacy'
			);
			return view('policy_privacy/view_policy_privacy_web', $data);
		} else {
			return redirect()->to('/');
		}
	}

	public function mob()
	{
		if (!hassession('email')) {
			$data = array(
				'title' => 'Policy Privacy'
			);
			return view('policy_privacy/view_policy_privacy', $data);
		}else{
			return redirect()->to('/');
		}
	}

	//--------------------------------------------------------------------

}
