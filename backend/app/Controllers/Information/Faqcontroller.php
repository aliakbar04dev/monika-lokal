<?php 
namespace App\Controllers\Information;
use App\Controllers\BaseController;
use App\Models\Information\FaqModel;
use Config\Services;

class Faqcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuinformation/view_infofaq');
        }
    }

    public function ajax_list() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $request = Services::request();
                $m_faq = new FaqModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_faq->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editinfofaq('" .$list->id_faq. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteinfofaq('" .$list->id_faq. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->question;
                                $row[] = $list->answered;
                                // $row[] = $tomboledit;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_faq->count_all(),
                            "recordsFiltered" => $m_faq->count_filtered(),
                            "data" => $data
                        ];

                    echo json_encode($output);
                }
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function simpandata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $validationCheck = $this->validate([
                    'infofaq_soal' => [
                        'label' => 'Soal',
                        'rules' => [
                            'required',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                        ],
                    ],
    
                    'infofaq_jawab' => [
                        'label' => 'Jawaban',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);
            }
            else
            {
                return view('errors/html/error_404');
            }

            if (!$validationCheck) {
				$msg = [
					'error' => [
						"infofaq_soal" => $this->validation->getError('infofaq_soal'),
						"infofaq_jawab" => $this->validation->getError('infofaq_jawab'),
					]
				];
			}
			else
			{
                $data = [
                    'question' => $this->request->getVar('infofaq_soal'),
                    'answered' => $this->request->getVar('infofaq_jawab'),
                ];

                $request = Services::request();
                $m_faq = new FaqModel($request);

                $m_faq->insert($data);;

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/adminfofaq'
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }

    public function pilihdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_faq = new FaqModel($request);

                $item = $m_faq->find($kode);
    
                $data = [
                    'success' => [
						'kode' => $item['id_faq'],
                        'soal' => $item['question'],
                        'jawab' => $item['answered'],
                    ]
                ];
    
                echo json_encode($data);   
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function perbaruidata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'infofaq_soalubah' => [
                        'label' => 'Soal',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					'infofaq_jawabubah' => [
                        'label' => 'Jawab',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "infofaq_soalubah" => $this->validation->getError('infofaq_soalubah'),
							"infofaq_jawabubah" => $this->validation->getError('infofaq_jawabubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'question' => $this->request->getVar('infofaq_soalubah'),
						'answered' => $this->request->getVar('infofaq_jawabubah'),
                    ];
    
                    $kode = $this->request->getVar('infofaq_kodeubah');

                    $request = Services::request();
                    $m_faq = new FaqModel($request);
    
                    $m_faq->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/adminfofaq'
                        ]
                    ];
                }
    
                echo json_encode($msg);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function hapusdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_faq = new FaqModel($request);

                $m_faq->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data faq dengan kode ' . $kode,
                        'link' => '/adminfofaq'
                     ]
                ];
            }
            else
            {
                return view('errors/html/error_404');
            }
    
            echo json_encode($msg);
        }
    }    
	
	//--------------------------------------------------------------------

}
