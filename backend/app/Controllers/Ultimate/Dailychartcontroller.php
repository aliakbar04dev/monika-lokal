<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\DailychartModel;
use Config\Services;

class Dailychartcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatedailychart');
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
                $m_dailychart = new DailychartModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_dailychart->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatedailychart('" .$list->kode_dailychart. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatedailychart('" .$list->kode_dailychart. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                $row[] = $no;
                                $row[] = $list->kode_dailychart;
								$row[] = $isactive;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
								// $row[] = $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_dailychart->count_all(),
                            "recordsFiltered" => $m_dailychart->count_filtered(),
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
                $m_dailychart = new DailychartModel($request);

                $getdata = $m_dailychart->findAll();
                $max  = count($getdata) + 1;
                // $gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT);
				// $gen  = "KDSR" . str_pad($max, 3, 0, STR_PAD_LEFT);
				// $gen  = "KDSA" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);
                $acak = rand();
                $gen  = "AD" . (date("dmy")) . $acak;

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
	
	function compressImg($filename) {
        $thumbnail = \Config\Services::image()
        ->withFile('public/assets/img/dailychart/' . $filename)
        ->fit(900, 400, 'center')
		->save('public/assets/img/dailychart/' . $filename, 75);
    }
	
	public function uploadGambar()
    {
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/dailychart/", $fileName);
            echo base_url("public/assets/img/dailychart/$fileName");
        }
    }

    public function deleteGambar()
    {
        $src = $this->request->getVar('src');
        if ($src) {
            $file_name = str_replace(base_url() . "/", "", $src);
            if (unlink($file_name)) {
                echo "Delete file berhasil";
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
                    'ultimatedailychart_kode' => [
                        'label' => 'Kode daily',
                        'rules' => [
                            'required',
                            'is_unique[t_dailychart.kode_dailychart]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
                ]);
            }
            else
            {
                return view('errors/html/error_404');
            }

            if (!$validationCheck) {
				$msg = [
					'error' => [
                        "ultimatedailychart_kode" => $this->validation->getError('ultimatedailychart_kode'),
					]
				];
			}
			else
			{       
				$isactive = $this->request->getVar('ultimatedailychart_isactive');
                $data = [
                    'kode_dailychart' => $this->request->getVar('ultimatedailychart_kode'),
                    'content' => $this->request->getVar('ultimatedailychart_deskripsi'),
                    'is_active' => $isactive,
                ];

                $request = Services::request();
                $m_dailychart = new DailychartModel($request);
				
				if ($isactive == 1)
                {
                    $m_dailychart->set('is_active', '0')->where('status', 0)->update();
                }

                $m_dailychart->insert($data);
				

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admsettingbenefit'
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
                $m_dailychart = new DailychartModel($request);

                $item = $m_dailychart->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_dailychart'],
                        'content' => $item['content'],
                        'active' => $item['is_active'],
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
                /*$check = $this->validate([
                    'ultimatedaily_stockubah' => [
                        'label' => 'Ubah Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_areabeliubah' => [
                        'label' => 'Ubah Area Beli',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_areajualubah' => [
                        'label' => 'Ubah Area Jual',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_stoplossubah' => [
                        'label' => 'Ubah Stop Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
				
				if (!$check) {
                    $msg = [
                       'error' => [
							"ultimatedaily_stockubah" => $this->validation->getError('ultimatedaily_stockubah'),
							"ultimatedaily_areabeliubah" => $this->validation->getError('ultimatedaily_areabeliubah'),
							"ultimatedaily_areajualubah" => $this->validation->getError('ultimatedaily_areajualubah'),
							"ultimatedaily_stoplossubah" => $this->validation->getError('ultimatedaily_stoplossubah'),
                       ]
                    ];
                }
                else
                {*/
                    $isactiveubah = $this->request->getVar('ultimatedailychart_isactiveubah');

                    $data = [
                        'content' => $this->request->getVar('ultimatedailychart_deskripsiubah'),
						'is_active' => $this->request->getVar('ultimatedailychart_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('ultimatedailychart_kodeubah');
    
                    $request = Services::request();
                    $m_dailychart = new DailychartModel($request);

                    if ($isactiveubah == 1)
                    {
                        $m_dailychart->set('is_active', '0')->where('status', 0)->update();
                    }

                    $m_dailychart->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admsettingbenefit'
                        ]
                    ];
                //}
    
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
                $m_dailychart = new DailychartModel($request);
    
                $m_dailychart->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus article daily dengan kode ' . $kode,
                        'link' => '/admsettingbenefit'
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