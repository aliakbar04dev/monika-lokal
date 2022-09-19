<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\DailyactModel;
use Config\Services;

class Dailyactcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatedailyact');
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
                $m_dailyact = new DailyactModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_dailyact->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatedailyact('" .$list->kode_dailyact. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatedailyact('" .$list->kode_dailyact. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                // $row[] = $no;
                                $row[] = '<div style="text-align: center;">'.$tomboledit . ' ' . $tombolhapus.'</div>';
                                $row[] = $list->kode_dailyact;
								$row[] = $isactive;
								// $row[] = $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_dailyact->count_all(),
                            "recordsFiltered" => $m_dailyact->count_filtered(),
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
                $m_dailyact = new DailyactModel($request);

                $getdata = $m_dailyact->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KDSR" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KDSA" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
        ->withFile('public/assets/img/dailyarticlenew/' . $filename)
        ->fit(900, 400, 'center')
		->save('public/assets/img/dailyarticlenew/' . $filename, 75);
    }
	
	public function uploadGambar()
    {
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/dailyarticlenew/", $fileName);
            echo base_url("public/assets/img/dailyarticlenew/$fileName");
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
                    'ultimatedailyact_kode' => [
                        'label' => 'Kode daily',
                        'rules' => [
                            'required',
                            'is_unique[t_dailyact.kode_dailyact]',
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
                        "ultimatedailyact_kode" => $this->validation->getError('ultimatedailyact_kode'),
					]
				];
			}
			else
			{       
				$isactive = $this->request->getVar('ultimatedailyact_isactive');
                $data = [
                    'kode_dailyact' => $this->request->getVar('ultimatedailyact_kode'),
                    'content' => $this->request->getVar('ultimatedailyact_deskripsi'),
                    'is_active' => $isactive,
                ];

                $request = Services::request();
                $m_dailyact = new DailyactModel($request);
				
				if ($isactive == 1)
                {
                    $m_dailyact->set('is_active', '0')->where('status', 0)->update();
                }

                $m_dailyact->insert($data);
				

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
                $m_dailyact = new DailyactModel($request);

                $item = $m_dailyact->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_dailyact'],
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
                    $isactiveubah = $this->request->getVar('ultimatedailyact_isactiveubah');

                    $data = [
                        'content' => $this->request->getVar('ultimatedailyact_deskripsiubah'),
						'is_active' => $this->request->getVar('ultimatedailyact_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('ultimatedailyact_kodeubah');
    
                    $request = Services::request();
                    $m_dailyact = new DailyactModel($request);

                    if ($isactiveubah == 1)
                    {
                        $m_dailyact->set('is_active', '0')->where('status', 0)->update();
                    }

                    $m_dailyact->update($kode, $data);
    
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
                $m_dailyact = new DailyactModel($request);
    
                $m_dailyact->delete($kode);
    
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