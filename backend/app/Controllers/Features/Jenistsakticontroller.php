<?php 
namespace App\Controllers\Features;
use App\Controllers\BaseController;
use App\Models\Features\JenistsaktiModel;
use Config\Services;

class Jenistsakticontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menufeatures/view_jenistsakti');
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
                $m_jenistsakti = new JenistsaktiModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_jenistsakti->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editfeaturesjenistsakti('" .$list->kode_jenis_tsakti. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletefeaturesjenistsakti('" .$list->kode_jenis_tsakti. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_jenis_tsakti;
                                $row[] = $list->jenis_t_sakti;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
								// $row[] = $tomboledit;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_jenistsakti->count_all(),
                            "recordsFiltered" => $m_jenistsakti->count_filtered(),
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

    public function getdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $request = Services::request();
                $m_jenistsakti = new JenistsaktiModel($request);

                $getdata = $m_jenistsakti->getLastData();
                $kode = substr($getdata->kode, 4) + 1;
                $gen  = "JSAK" . str_pad($kode, 3, 0, STR_PAD_LEFT);

                $data = [
                    'kodegen' => $gen
                ];

                echo json_encode($data);
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
                    'featuresjenistsakti_kode' => [
                        'label' => 'Kode jenis tabel sakti',
                        'rules' => [
                            'required',
                            'is_unique[jenis_tsakti.kode_jenis_tsakti]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'featuresjenistsakti_nama' => [
                        'label' => 'Judul jenis tabel sakti',
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
						"featuresjenistsakti_kode" => $this->validation->getError('featuresjenistsakti_kode'),
						"featuresjenistsakti_nama" => $this->validation->getError('featuresjenistsakti_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_jenis_tsakti' => $this->request->getVar('featuresjenistsakti_kode'),
                    'jenis_t_sakti' => $this->request->getVar('featuresjenistsakti_nama'),
                ];

                $request = Services::request();
                $m_jenistsakti = new JenistsaktiModel($request);

                $m_jenistsakti->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admcattype'
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
                $m_jenistsakti = new JenistsaktiModel($request);

                $item = $m_jenistsakti->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_jenis_tsakti'],
                        'jenis' => $item['jenis_t_sakti'],
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
                    'featuresjenistsakti_namaubah' => [
                        'label' => 'Ubah judul jenis tabel sakti',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "featuresjenistsakti_namaubah" => $this->validation->getError('featuresjenistsakti_namaubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'jenis_t_sakti' => $this->request->getVar('featuresjenistsakti_namaubah'),
                    ];
    
                    $kode = $this->request->getVar('featuresjenistsakti_kodeubah');
    
                    $request = Services::request();
                    $m_jenistsakti = new JenistsaktiModel($request);

                    $m_jenistsakti->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admcattype'
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
                $m_jenistsakti = new JenistsaktiModel($request);
    
                $m_jenistsakti->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data jenis tabel sakti dengan kode ' . $kode,
                        'link' => '/admcattype'
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
}