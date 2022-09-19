<?php 
namespace App\Controllers\Career;
use App\Controllers\BaseController;
use App\Models\Career\TestimonicarModel;
use App\Models\Career\DepartmentcarModel;
use Config\Services;

class Testimonicontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menucareer/view_careertestimoni');
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
                $m_testimoni = new TestimonicarModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_testimoni->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editcareertestimoni('" .$list->id_testimoni. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $changeimg  = "<button type=\"button\" class=\"btn btn-info btn-sm\"
                                                onclick=\"changeimgcareertestimoni('" .$list->id_testimoni. "')\">
                                                <i class=\"fa fa-image\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletecareertestimoni('" .$list->id_testimoni. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->publish == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }
								
								if ($list->is_highlight == 1)
                                {
                                    $ishighlight = "<span style='color:#2dce89;'>Iya</span";
                                }
                                else
                                {
                                    $ishighlight = "<span style='color:#f5365c;'>Tidak</span";
                                }

                                $media = "<img src='" .$list->foto. "' width=50/>";

                                $row[] = $no;
								$row[] = $media;
								$row[] = $list->nama;
								$row[] = $list->divisi;
								$row[] = $ishighlight;
                                $row[] = $isactive;

                                $row[] = $tomboledit. ' ' . $changeimg . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_testimoni->count_all(),
                            "recordsFiltered" => $m_testimoni->count_filtered(),
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
                $m_testimoni = new TestimonicarModel($request);

                $getdata = $m_testimoni->getLastData();
                $kode = substr($getdata->kode, 4) + 1;
                $gen  = "TTSK" . str_pad($kode, 3, 0, STR_PAD_LEFT);

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
        ->withFile('public/assets/img/testimoni/' . $filename)
		//->withFile(WRITEPATH.'uploads/' . $filename)
        ->fit(400, 400, 'center')
		->save('public/assets/img/testimoni/thumbs/' . $filename, 75);
        //->save(WRITEPATH.'uploads/thumbs/' . $filename, 75);
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
                    'careertestimoni_kode' => [
                        'label' => 'Kode testimoni',
                        'rules' => [
                            'required',
                            'is_unique[t_testimoni_karir.id_testimoni]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    'careertestimoni_nama' => [
						'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                       ],
                    ],
					
					'careertestimoni_divisi' => [
						'label' => 'Divisi',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                       ],
                    ],
					
					'careertestimoni_content' => [
						'label' => 'Isi testimoni',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                       ],
                    ],

                    'careertestimoni_gambar' => [
                        'label' => 'Gambar',
                        'rules' => [
                            'uploaded[careertestimoni_gambar]',
                            'mime_in[careertestimoni_gambar,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[careertestimoni_gambar]',
                            'max_size[careertestimoni_gambar,4096]',
                        ],
                        'errors' => [
                            'uploaded'      => '{field} wajib diisi',
                            'mime_in' 		=> '{field} tidak sesuai format standar',
                            'is_image'      => '{field} tidak sesuai',
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
                        "careertestimoni_kode" => $this->validation->getError('careertestimoni_kode'),
						"careertestimoni_nama" => $this->validation->getError('careertestimoni_nama'),
                        "careertestimoni_divisi" => $this->validation->getError('careertestimoni_divisi'),
						"careertestimoni_content" => $this->validation->getError('careertestimoni_content'),
						"careertestimoni_gambar" => $this->validation->getError('careertestimoni_gambar'),
					]
				];
			}
			else
			{
                $kode = $this->request->getVar('careertestimoni_kode');
                $gambar = $this->request->getFile('careertestimoni_gambar');
                $filename = $kode . '.' . $gambar->getExtension();

                $gambar->move('public/assets/img/testimoni/', $filename);
                $location = '/backend/public/assets/img/testimoni/thumbs/' . $filename;
                $this->compressImg($filename);
                
                $data = [
                    'id_testimoni' => $this->request->getVar('careertestimoni_kode'),
                    'nama' => $this->request->getVar('careertestimoni_nama'),
                    'divisi' => $this->request->getVar('careertestimoni_divisi'),
					'testimoni' => $this->request->getVar('careertestimoni_content'),
                    'foto' => $location,
                    'is_highlight' => $this->request->getVar('careertestimoni_ishighlight'),
                    'publish' => $this->request->getVar('careertestimoni_isactive'),
                ];

                $request = Services::request();
                $m_testimoni = new TestimonicarModel($request);

                $m_testimoni->insert($data);

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
                $m_testimoni = new TestimonicarModel($request);

                $item = $m_testimoni->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_testimoni'],
                        'nama' => $item['nama'],
                        'divisi' => $item['divisi'],
                        'testimoni' => $item['testimoni'],
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

    public function pilihgambar() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_testimoni = new TestimonicarModel($request);

                $item = $m_testimoni->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_testimoni'],
                        'gambar' => $item['foto'],
						'is_highlight' => $item['is_highlight'],
						'publish' => $item['publish'],
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
                     'careertestimoni_namaubah' => [
                        'label' => 'Ubah Nama',
                        'rules' => 'required',
                        'errors' => [
                             'required' 		=> '{field} wajib terisi'
                        ],
                     ],
					 
					 'careertestimoni_divisiubah' => [
                        'label' => 'Ubah Divisi',
                        'rules' => 'required',
                        'errors' => [
                             'required' 		=> '{field} wajib terisi'
                        ],
                     ],
					 
					 'careertestimoni_contentubah' => [
                        'label' => 'Ubah Isi Testimoni',
                        'rules' => 'required',
                        'errors' => [
                             'required' 		=> '{field} wajib terisi'
                        ],
                     ],
                ]);

                if (!$check) {
                    $msg = [
                         'error' => [
                            "careertestimoni_namaubah" => $this->validation->getError('careertestimoni_namaubah'),
							"careertestimoni_divisiubah" => $this->validation->getError('careertestimoni_divisiubah'),
							"careertestimoni_contentubah" => $this->validation->getError('careertestimoni_contentubah'),
                         ]
                    ];
                }
                else
                {
                    $data = [
                        'nama' => $this->request->getVar('careertestimoni_namaubah'),
                        'divisi' => $this->request->getVar('careertestimoni_divisiubah'),
                        'testimoni' => $this->request->getVar('careertestimoni_contentubah'),
                    ];
    
                    $kode = $this->request->getVar('careertestimoni_kodeubah');
    
                    $request = Services::request();
                    $m_testimoni = new TestimonicarModel($request);

                    $m_testimoni->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admsettingbenefit'
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

    public function perbaruigambar() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'careertestimoniimg_gambarubah' => [
                        'label' => 'Gambar',
                        'rules' => [
                            'uploaded[careertestimoniimg_gambarubah]',
                            'mime_in[careertestimoniimg_gambarubah,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[careertestimoniimg_gambarubah]',
                            'max_size[careertestimoniimg_gambarubah,4096]',
                        ],
                        'errors' => [
                            'uploaded'      => '{field} wajib diisi',
                            'mime_in' 		=> '{field} tidak sesuai format standar',
                            'is_image'      => '{field} tidak sesuai',
                            'max-size'      => '{field} melebihi ukuran yang ditentukan',
                        ],
                    ]
                ]);

                if (!$check) {
                    // $msg = [
                    //     'error' => [
                    //         "settingbannerimg_gambar" => $this->validation->getError('settingbannerimg_gambar'),
                    //     ]
                    // ];

                    $request = Services::request();
                    $m_testimoni = new TestimonicarModel($request);

                    $kode = $this->request->getVar('careertestimoniimg_kodeubah');

                    $data = [
                        'is_highlight' => $this->request->getVar('careertestimoniimg_ishighlightubah'),
						'publish' => $this->request->getVar('careertestimoniimg_isactiveubah'),
                    ];
    

                    $m_testimoni->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => base_url() . '/admcareertestimoni'
                        ]
                    ];
                }
                else
                {
                    $request = Services::request();
                    $m_testimoni = new TestimonicarModel($request);

                    $kode = $this->request->getVar('careertestimoniimg_kodeubah');
                    $item = $m_testimoni->find($kode);
                    $tbname = $item['foto'];

                    unlink(str_replace('/backend/', '', $tbname));
                    //unlink('public/assets/img/testimoni/thumbs/' . $tbname);

                    $gambar = $this->request->getFile('careertestimoniimg_gambarubah');
                    $filename = $kode . '.' . $gambar->getExtension();
    
                    $gambar->move('public/assets/img/testimoni/', $filename);
                    $location = '/backend/public/assets/img/testimoni/thumbs/' . $filename;
                    $this->compressImg($filename);

                    $data = [
                        'foto' => $location,
                        'is_highlight' => $this->request->getVar('careertestimoniimg_ishighlightubah'),
                        'publish' => $this->request->getVar('careertestimoniimg_isactiveubah'),
                    ];
    

                    $m_testimoni->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => base_url() . '/admcareertestimoni'
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
                $m_testimoni = new TestimonicarModel($request);

                $item = $m_testimoni->find($kode);
                $filename = $item['foto'];

				unlink(str_replace('/backend/', '', $filename));
               // unlink('public/assets/img/banner/thumbs/' . $filename);
    
                $m_testimoni->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data banner dengan kode ' . $kode,
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