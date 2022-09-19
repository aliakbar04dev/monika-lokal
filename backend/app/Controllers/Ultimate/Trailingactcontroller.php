<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\TrailingactModel;
use Config\Services;

class Trailingactcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatetrailingact');
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
                $m_trailact = new TrailingactModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_trailact->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatetrailact('" .$list->kode_trailingact. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatetrailact('" .$list->kode_trailingact. "')\"> 
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
                                $row[] = $list->kode_trailingact;
                                $row[] = $list->alias;
								$row[] = $isactive;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
								// $row[] = $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_trailact->count_all(),
                            "recordsFiltered" => $m_trailact->count_filtered(),
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
                $m_trailact = new TrailingactModel($request);

                $getdata = $m_trailact->findAll();
                $max  = count($getdata) + 1;
				$gen  = "KTSA" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
        ->withFile('public/assets/img/trailingarticle/' . $filename)
        ->fit(900, 400, 'center')
		->save('public/assets/img/trailingarticle/' . $filename, 75);
    }
	
	public function uploadGambar()
    {
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/trailingarticle/", $fileName);
            echo base_url("public/assets/img/trailingarticle/$fileName");
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
                    'ultimatetrailingact_kode' => [
                        'label' => 'Kode article trailing',
                        'rules' => [
                            'required',
                            'is_unique[t_trailingact.kode_trailingact]',
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
                        "ultimatetrailingact_kode" => $this->validation->getError('ultimatetrailingact_kode'),
					]
				];
			}
			else
			{       
				$isactive = $this->request->getVar('ultimatetrailingact_isactive');
                $alias = $this->request->getVar('ultimatetrailingact_jenis');

                $data = [
                    'kode_trailingact' => $this->request->getVar('ultimatetrailingact_kode'),
                    'content' => $this->request->getVar('ultimatetrailingact_deskripsi'),
                    'alias' => $this->request->getVar('ultimatetrailingact_jenis'),
                    'is_active' => $isactive,
                ];

                $request = Services::request();
                $m_trailact = new TrailingactModel($request);
				
				if ($isactive == 1)
                {
                    $m_trailact->set('is_active', '0')->where('alias', $alias)->update();
                }

                $m_trailact->insert($data);
				

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
                $m_trailact = new TrailingactModel($request);

                $item = $m_trailact->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_trailingact'],
                        'content' => $item['content'],
                        'alias' => $item['alias'],
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
                    $kode = $this->request->getVar('ultimatetrailingact_kodeubah');
                    $isactiveubah = $this->request->getVar('ultimatetrailingact_isactiveubah');
                    $aliasUbah = $this->request->getVar('ultimatetrailingact_jenisubah');

                    $data = [
                        'content' => $this->request->getVar('ultimatetrailingact_deskripsiubah'),
                        'alias' => $this->request->getVar('ultimatetrailingact_jenisubah'),
						'is_active' => $this->request->getVar('ultimatetrailingact_isactiveubah'),
                    ];
    
    
                    $request = Services::request();
                    $m_trailact = new TrailingactModel($request);

                    if ($isactiveubah == 1)
                    {
                        $m_trailact->set('is_active', '0')->where('alias', $aliasUbah)->update();
                    }

                    $m_trailact->update($kode, $data);
    
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
                $m_trailact = new TrailingactModel($request);
    
                $m_trailact->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus article trailing dengan kode ' . $kode,
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