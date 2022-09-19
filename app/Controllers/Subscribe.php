<?php

namespace App\Controllers;

use App\Models\SubscribeModel;
use Config\Services;

class Subscribe extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {
            $validationCheck = $this->validate([
                'input_subscribe' => [
                    'label' => 'Alamat Email',
                    'rules' => [
                        'required',
                        'valid_email',
                    ],
                    'errors' => [
                        'required'         => '{field} Wajib terisi',
                        'valid_email'    => '{field} Tidak valid'
                    ],
                ],

            ]);

            if (!$validationCheck) {
                $msg = [
                    'error' => [
                        "input_subscribe" => $this->validation->getError('input_subscribe')
                    ]
                ];
            } else {
                $data = [
                    'email_address' => $this->request->getVar('input_subscribe')
                ];

                $request = Services::request();
                $upload = new SubscribeModel($request);
                $upload->insert($data);

                // $mailCheck = $this->loginModel->login($emailaddr);

                // $result = $mailCheck->getResult();
                $msg = [
                    'success' => [
                        "subscribe_footer" => "Email berhasil ditambahkan",
						"link" => base_url() . "",
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }
}

    //--------------------------------------------------------------------
// }
