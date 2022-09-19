<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\FactsheetModel;
use Config\Services;

class Factsheetcontroller extends BaseController {
    public function index() {
        if(!$this->session->get('islogin'))
		{
            
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatefactsheet');
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
                $m_factsheet = new FactsheetModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_factsheet->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatefactsheet('" .$list->kode_factsheet. "')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombollihatberkas  = "<button type=\"button\" class=\"btn btn-dark btn-sm\"
                                                onclick=\"changepdfultimatefactsheet('" .$list->kode_factsheet. "')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lihat Berkas\">
                                                <i class=\"fa fa-file-pdf\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatefactsheet('" .$list->kode_factsheet. "')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                $row[] = $tomboledit  . $tombollihatberkas . $tombolhapus;

                                $row[] = $no;
                                $row[] = $list->kode_factsheet;
                                $row[] = substr($list->bulan, 2);
                                $row[] = $list->tahun;
                                // $row[] = $isactive;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_factsheet->count_all(),
                            "recordsFiltered" => $m_factsheet->count_filtered(),
                            "data" => $data
                        ];

                        // var_dump($output);
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
                $m_factsheet = new factsheetModel($request);

                $getdata = $m_factsheet->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KDSR" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KDFS" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                $bulan = $this->request->getVar('ultimatefactsheet_bulan');
                $tahun = $this->request->getVar('ultimatefactsheet_tahun');
				$isactive = $this->request->getVar('ultimatefactsheet_isactive');

                $this->db = db_connect();
                $builder = $this->db->table('factsheet');
                $countBuilder = $builder->select('*')
                                ->where('bulan', $bulan)
                                ->where('tahun', $tahun)
                                ->countAllResults();

                if ($countBuilder > 0) {
                    $validationCheck = $this->validate([
                        'ultimatefactsheet_kode' => [
                            'label' => 'Kode Factsheet',
                            'rules' => [
                                'required',
                                'is_unique[factsheet.kode_factsheet]',
                            ],
                            'errors' => [
                                'required' 		=> '{field} wajib terisi',
                                'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                            ],
                        ],
                        'ultimatefactsheet_bulan' => [
                            'label' => 'Bulan',
                            'rules' => [
                                'required',
                                'is_unique[factsheet.bulan]',
                            ],
                            'errors' => [
                                'required' 		=> '{field} wajib terisi',
                                'is_unique'	    => '{field} tidak boleh sama, coba dengan bulan yang lain'
                            ],
                        ],
                        'ultimatefactsheet_tahun' => [
                            'label' => 'Tahun',
                            'rules' => [
                                'required',
                                'is_unique[factsheet.tahun]',
                            ],
                            'errors' => [
                                'required' 		=> '{field} wajib terisi',
                                'is_unique'	    => '{field} tidak boleh sama, coba dengan tahun yang lain'
                            ],
                        ],
                        'ultimatefactsheet_berkas' => [
                            'label' => 'Berkas',
                            'rules' => [
                                'uploaded[ultimatefactsheet_berkas]',
                                'mime_in[ultimatefactsheet_berkas,application/pdf]',
                                'max_size[ultimatefactsheet_berkas,10000]',
                            ],
                            'errors' => [
                                'uploaded'      => '{field} wajib diisi',
                                'mime_in' 		=> '{field} tidak sesuai format standar',
                                'max-size'      => '{field} melebihi ukuran yang ditentukan',
                            ],
                        ]
                    ]);
                } else {
                    $validationCheck = $this->validate([
                        'ultimatefactsheet_kode' => [
                            'label' => 'Kode Factsheet',
                            'rules' => [
                                'required',
                                'is_unique[factsheet.kode_factsheet]',
                            ],
                            'errors' => [
                                'required' 		=> '{field} wajib terisi',
                                'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                            ],
                        ],
                        'ultimatefactsheet_berkas' => [
                            'label' => 'Berkas',
                            'rules' => [
                                'uploaded[ultimatefactsheet_berkas]',
                                'mime_in[ultimatefactsheet_berkas,application/pdf]',
                                'max_size[ultimatefactsheet_berkas,10000]',
                            ],
                            'errors' => [
                                'uploaded'      => '{field} wajib diisi',
                                'mime_in' 		=> '{field} tidak sesuai format standar',
                                'max-size'      => '{field} melebihi ukuran yang ditentukan',
                            ],
                        ]
                    ]);
                }
            }
            else
            {
                return view('errors/html/error_404');
            }

            if (!$validationCheck) {
                $msg = [
                    'error' => [
                        "ultimatefactsheet_kode" => $this->validation->getError('ultimatefactsheet_kode'),
                        "ultimatefactsheet_bulan" => $this->validation->getError('ultimatefactsheet_bulan'),
                        "ultimatefactsheet_tahun" => $this->validation->getError('ultimatefactsheet_tahun'),
                    ]
                ];
			} else {    
                $filePdf = $this->request->getFile('ultimatefactsheet_berkas');
                if ($filePdf->isValid() && ! $filePdf->hasMoved()) {
                    $imageNamePdf = $filePdf->getRandomName();
                    $filePdf->move('public/assets/img/factsheet/', $imageNamePdf);
                } else {
                    $imageNamePdf = '';
                }

                //  echo json_encode($countBuilder); die;
                
                $data = [
                    'kode_factsheet' => $this->request->getVar('ultimatefactsheet_kode'),
                    'bulan' => $this->request->getVar('ultimatefactsheet_bulan'),
                    'tahun' => $this->request->getVar('ultimatefactsheet_tahun'),
                    'berkas' => $imageNamePdf,
                    'is_active' => $isactive,
                ];

                $request = Services::request();
                $m_factsheet = new factsheetModel($request);

                $m_factsheet->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => base_url() . '/admultimatefactsheet'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function pilihpdf() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');

                $request = Services::request();
                $m_factsheet = new factsheetModel($request);

                $item = $m_factsheet->find($kode);
                // var_dump($item); die;
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_factsheet'],
                        'berkas' => $item['berkas'],
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

    public function perbaruipdf() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'ultimatefactsheet_berkasubah' => [
                        'label' => 'PDF',
                        'rules' => [
                            'uploaded[ultimatefactsheet_berkasubah]',
                            'mime_in[ultimatefactsheet_berkasubah,application/pdf]',
                            'max_size[ultimatefactsheet_berkasubah,10000]',
                        ],
                        'errors' => [
                            'uploaded'      => '{field} wajib diisi',
                            'mime_in' 		=> '{field} tidak sesuai format standar',
                            'max-size'      => '{field} melebihi ukuran yang ditentukan',
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "ultimatefactsheet_berkasubah" => $this->validation->getError('ultimatefactsheet_berkasubah'),
                        ]
                    ];
                }
                else
                {
                    $request = Services::request();
                    $m_factsheet = new factsheetModel($request);
                    $kode = $this->request->getVar('ultimatefactsheet_editkodeubahpdf');

                    $item = $m_factsheet->find($kode);
                    $oldPdf = $item['berkas'];
                    
                    $file = $this->request->getFile('ultimatefactsheet_berkasubah');

                    if ($file->isValid() && ! $file->hasMoved()) {
                        if (file_exists('public/assets/img/factsheet/'.$oldPdf)) {
                            unlink('public/assets/img/factsheet/'.$oldPdf);
                        }
                        $pdfName = $file->getRandomName();
                        $file->move('public/assets/img/factsheet/', $pdfName);
                    } else {
                        $pdfName = $item['berkas'];
                    }

                    $data = [
                        'berkas' => $pdfName,
                    ];

                    $m_factsheet->update($kode, $data);
    
                    $msg = [
                        'success' => [
                            'data' => 'Berhasil memperbarui PDF',
                            'link' => base_url() . '/admultimatefactsheet'
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
                $m_factsheet = new factsheetModel($request);

                $item = $m_factsheet->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_factsheet'],
                        'bulan' => $item['bulan'],
                        'tahun' => $item['tahun'],
                        'active' => $item['is_active'],
                    ]
                ];

                // var_dump($data); die;
    
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
                $kodefactsheetubah = $this->request->getVar('ultimatefactsheet_kodeubah');
                $bulanubah = $this->request->getVar('ultimatefactsheet_bulanubah');
                $tahunubah = $this->request->getVar('ultimatefactsheet_tahunubah');
				$activeubah = $this->request->getVar('ultimatefactsheet_isactiveubah');

                $this->db = db_connect();
                $builder = $this->db->table('factsheet');
                $countBuilder = $builder->select('*')
                                ->where('bulan', $bulanubah)
                                ->where('tahun', $tahunubah)
                                ->countAllResults();

                $rowBuilder = $builder->select('*')
                                ->where('kode_factsheet', $kodefactsheetubah)
                                ->get()
                                ->getRowArray();  

                $bulanRow = $rowBuilder['bulan'];
                $tahunRow = $rowBuilder['tahun'];
    
                // echo json_encode($rowBuilder);
         
                if ($countBuilder > 0) {
                    if ($bulanubah == $bulanRow && $tahunubah == $tahunRow) {
                        $validationCheck = $this->validate([
                            'ultimatefactsheet_kodeubah' => [
                                'label' => 'Kode Factsheet',
                                'rules' => [
                                    'required',
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                ],
                            ],
                        ]);
                    } else {
                        $validationCheck = $this->validate([
                            'ultimatefactsheet_kodeubah' => [
                                'label' => 'Kode Factsheet',
                                'rules' => [
                                    'required',
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                ],
                            ],
                            'ultimatefactsheet_bulanubah' => [
                                'label' => 'Bulan',
                                'rules' => [
                                    'required',
                                    'is_unique[factsheet.bulan]',
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                    'is_unique'	    => '{field} tidak boleh sama, coba dengan bulan yang lain'
                                ],
                            ],
                            'ultimatefactsheet_tahunubah' => [
                                'label' => 'Tahun',
                                'rules' => [
                                    'required',
                                    'is_unique[factsheet.tahun]',
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                    'is_unique'	    => '{field} tidak boleh sama, coba dengan tahun yang lain'
                                ],
                            ],
                        ]);
                    } 
                } else {
                    $validationCheck = $this->validate([
                        'ultimatefactsheet_kodeubah' => [
                            'label' => 'Kode Factsheet',
                            'rules' => [
                                'required',
                            ],
                            'errors' => [
                                'required' 		=> '{field} wajib terisi',
                            ],
                        ],
                    ]);
                }
            }
            else
            {
                return view('errors/html/error_404');
            }

            if (!$validationCheck) {
				$msg = [
					'error' => [
                        "ultimatefactsheet_kodeubah" => $this->validation->getError('ultimatefactsheet_kodeubah'),
                        "ultimatefactsheet_bulanubah" => $this->validation->getError('ultimatefactsheet_bulanubah'),
                        "ultimatefactsheet_tahunubah" => $this->validation->getError('ultimatefactsheet_tahunubah'),
					]
				];
			}
			else
			{       
                $data = [
                    'kode_factsheet' => $this->request->getVar('ultimatefactsheet_kodeubah'),
                    'bulan' => $this->request->getVar('ultimatefactsheet_bulanubah'),
                    'tahun' => $this->request->getVar('ultimatefactsheet_tahunubah'),
                    'is_active' => $activeubah,
                ];

                $request = Services::request();
                $m_factsheet = new factsheetModel($request);
				
                $m_factsheet->update($kodefactsheetubah, $data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil memperbarui data',
                       'link' => base_url() . '/admultimatefactsheet'
                     ]
                ];
            }

            echo json_encode($msg);
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
                $m_factsheet = new factsheetModel($request);

                $item = $m_factsheet->find($kode);
                $filenamepDF = $item['berkas'];

                if (!empty($filenamepDF)) {
                    unlink('public/assets/img/factsheet/'.$filenamepDF);
                } else {
                    # code...
                }
    
                $m_factsheet->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data factsheet dengan kode ' . $kode,
                        'link' => base_url() . '/admultimatefactsheet'
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