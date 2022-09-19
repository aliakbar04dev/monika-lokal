<?php 
namespace App\Controllers\Features;
use App\Controllers\BaseController;
use App\Models\Features\TsaktiModel;
use App\Models\Features\JenistsaktiModel;
use Config\Services;

class Tsakticontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $request = Services::request();
            $m_jenistsakti = new JenistsaktiModel($request);

            $data = [
                'jenis_tsakti' => $m_jenistsakti->getkodejenistsakti(),
            ];

            return view('menufeatures/view_tsakti', $data);
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
                $m_tsakti = new TsaktiModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_tsakti->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editfeaturestsakti('" .$list->kode_tsakti. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $changefile  = "<button type=\"button\" class=\"btn btn-info btn-sm\"
                                                onclick=\"changefilefeaturestsakti('" .$list->kode_tsakti. "')\">
                                                <i class=\"fa fa-file\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletefeaturestsakti('" .$list->kode_tsakti. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->jenis_t_sakti;
                                $row[] = $list->judul_tsakti;
                                $row[] = $list->link;
                                $row[] = date("d-M-Y", strtotime($list->tanggal_input));
                                $row[] = $tomboledit . ' ' . $changefile . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_tsakti->count_all(),
                            "recordsFiltered" => $m_tsakti->count_filtered(),
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
                $m_tsakti = new TsaktiModel($request);

                /* $getdata = $m_tsakti->findAll();
                $max  = count($getdata) + 1;
                $gen  = "TSAK" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				
				//$gen  = "TSAK" . str_pad(time(), 3, 0, STR_PAD_LEFT);
                $gen  = "TSAK" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                    'featurestsakti_kode' => [
                        'label' => 'Kode tabel sakti',
                        'rules' => [
                            'required',
                            'is_unique[t_sakti.kode_tsakti]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'featurestsakti_nama' => [
                        'label' => 'Judul tabel sakti',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ], 

                    'featurestsakti_files' => [
                        'label' => 'File',
                        'rules' => [
                            'uploaded[featurestsakti_files]',
                            'mime_in[featurestsakti_files,application/pdf, application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                            'max_size[featurestsakti_files,4096]',
                        ],
                        'errors' => [
                            'uploaded'      => '{field} wajib diisi',
                            'mime_in' 		=> '{field} tidak sesuai format standar',
                            'max-size'      => '{field} melebihi ukuran yang ditentukan',
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
						"featurestsakti_kode" => $this->validation->getError('featurestsakti_kode'),
                        "featurestsakti_nama" => $this->validation->getError('featurestsakti_nama'),
                        "featurestsakti_files" => $this->validation->getError('featurestsakti_files'),
					]
				];
			}
			else
			{
                $kode = $this->request->getVar('featurestsakti_kode');
                $file = $this->request->getFile('featurestsakti_files');
                $filename = $kode . '.' . $file->getExtension();

                $file->move('public/assets/files/tabel_sakti/', $filename);
                $location = base_url() . "/public/assets/files/tabel_sakti/" . $filename;

                $filesize = $file->getSize('mb') / 1000000;

                $data = [
                    'kode_tsakti' => $this->request->getVar('featurestsakti_kode'),
                    'kode_jenis_tsakti' => $this->request->getVar('featurestsakti_jenis'),
                    'judul_tsakti' => $this->request->getVar('featurestsakti_nama'),
                    //'tanggal_input' => date("Y-m-d"),
					'tanggal_input' => date("Y-m-d", strtotime($this->request->getVar('featurestsakti_tanggal'))),
                    'link' => $location,
                    'filename' => $file->getName(),
                    'ukuran' => number_format($filesize, 2, ',', '') . " Mb",
                ];

                $request = Services::request();
                $m_tsakti = new TsaktiModel($request);

                $m_tsakti->insert($data);

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
                $m_tsakti = new TsaktiModel($request);

                $item = $m_tsakti->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_tsakti'],
                        'jenis' => $item['kode_jenis_tsakti'],
                        'judul' => $item['judul_tsakti'],
						'tanggal' => $item['tanggal_input'],
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

    public function pilihfile() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_tsakti = new TsaktiModel($request);

                $item = $m_tsakti->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_tsakti'],
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
                    'featurestsakti_namaubah' => [
                        'label' => 'Ubah tabel sakti',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "featurestsakti_namaubah" => $this->validation->getError('featurestsakti_namaubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'kode_jenis_tsakti' => $this->request->getVar('featurestsakti_jenisubah'),
                        'judul_tsakti' => $this->request->getVar('featurestsakti_namaubah'),
						'tanggal_input' => date("Y-m-d", strtotime($this->request->getVar('featurestsakti_tanggalubah'))),
                    ];
    
                    $kode = $this->request->getVar('featurestsakti_kodeubah');
    
                    $request = Services::request();
                    $m_tsakti = new TsaktiModel($request);

                    $m_tsakti->update($kode, $data);
    
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

    public function perbaruifile() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'featurestsakti_filesubahfile' => [
                        'label' => 'File',
                        'rules' => [
                            'uploaded[featurestsakti_filesubahfile]',
                            'mime_in[featurestsakti_filesubahfile,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                            'max_size[featurestsakti_filesubahfile,4096]',
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
                            "featurestsakti_filesubahfile" => $this->validation->getError('featurestsakti_filesubahfile'),
                        ]
                    ];
                }
                else
                {
                    $request = Services::request();
                    $m_tsakti = new TsaktiModel($request);

                    $kode = $this->request->getVar('featurestsakti_kodeubahfile');
                    $file = $this->request->getFile('featurestsakti_filesubahfile');
                    $filename = $kode . '.' . $file->getExtension();

                    $item = $m_tsakti->find($kode);
                    $dtname = $item['filename'];
        
                    unlink('public/assets/files/tabel_sakti/' . $dtname);

                    $file->move('public/assets/files/tabel_sakti/', $filename);
                    $location = base_url() . "/public/assets/files/tabel_sakti/" . $filename;

                    $filesize = $file->getSize('mb') / 1000000;

                    $data = [
                        'link' => $location,
                        'filename' => $file->getName(),
                        'ukuran' => number_format($filesize, 2, ',', '') . " Mb",
                    ];
    
                    $m_tsakti->update($kode, $data);
    
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
                $m_tsakti = new TsaktiModel($request);

                $item = $m_tsakti->find($kode);
                $filename = $item['filename'];
    
                unlink('public/assets/files/tabel_sakti/' . $filename);
                $m_tsakti->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data category dengan kode ' . $kode,
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