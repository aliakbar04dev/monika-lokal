<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\UserModel;

class About_us extends BaseController
{
	protected $aboutModel;

	public function __construct()
	{
		$this->aboutModel = new AboutModel();
		$this->usr = new UserModel();
	}

	public function index()
	{
		if (!hassession('email')) {
			$data = array(
				'title' => 'About Us',
				'about' => $this->aboutModel->getAbout('Galeri'),
			);


			return view('about_us/view_about_us', $data);
		} else {
			if ($this->usr->checksessionuser(getsession('email'), getsession('sesskode'))) {
				$this->session->destroy();
				return redirect()->to('/');
			} else {
				return redirect()->to('/pengumuman');
			}
		}
	}

	//--------------------------------------------------------------------

}
