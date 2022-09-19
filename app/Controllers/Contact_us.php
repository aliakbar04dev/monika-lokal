<?php

namespace App\Controllers;

use App\Models\ContactModel;
use Config\Services;

class Contact_us extends BaseController
{
	public function index()
	{
		// if (!hassession('email')) {
		// 	$data = array(
		// 		'title' => 'Contact Us'
		// 	);
		// 	return view('contact_us/view_contact_us', $data);
		// } else {
		// 	return redirect()->to('/');
		// }
		$data = array(
			'title' => 'Contact Us'
		);
		return view('contact_us/view_contact_us', $data);
	}

	public function uploadpesan()
	{
		//echo "test";
		if ($this->request->isAJAX()) {
			$validationCheck = $this->validate([
				'nama' => [
					'label' => 'Nama',
					'rules' => [
						'required'
					],
					'errors' => [
						'required' 		=> '{field} Wajib terisi'
					],
				],

				'email' => [
					'label' => 'Email',
					'rules' => [
						'required',
						'valid_email',
					],
					'errors' => [
						'required' 		=> '{field} Wajib terisi',
						'valid_email'	=> '{field} Tidak valid'
					],
				],

				'phone' => [
					'label' => 'Phone Number',
					'rules' => 'required',
					'errors' => [
						'required' 		=> '{field} Wajib terisi'
					],
				],
				'isi_pesan' => [
					'label' => 'Pesan',
					'rules' => 'required',
					'errors' => [
						'required' 		=> '{field} Wajib terisi'
					],
				],
			]);

			if (!$validationCheck) {
				$msg = [
					'error' => [
						"nama" => $this->validation->getError('nama'),
						"email" => $this->validation->getError('email'),
						"phone" => $this->validation->getError('phone'),
						"isi_pesan" => $this->validation->getError('isi_pesan'),
					]
				];
			} else {
				$data = [
					'nama' => $this->request->getVar('nama'),
					'email' => $this->request->getVar('email'),
					'no_hp' => $this->request->getVar('phone'),
					'isi_pesan' => $this->request->getVar('isi_pesan'),
				];

				$request = Services::request();
				$upload = new ContactModel($request);

				$upload->insert($data);

				$msg = [
					'success' => [
						'data' => 'Berhasil menambahkan data',
						'link' => '/contactus'
					]
				];
			}

			echo json_encode($msg);
		}
	}

	//--------------------------------------------------------------------

}
