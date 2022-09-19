<?php 
namespace App\Controllers\Setting;
use App\Controllers\BaseController;
use App\Models\Setting\BannerModel;
use Config\Services;

class Bannercontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menusetting/view_settingbanner');
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
                $m_banner = new BannerModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_banner->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsettingbanner('" .$list->id_banner. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $changeimg  = "<button type=\"button\" class=\"btn btn-info btn-sm\"
                                                onclick=\"changeimgsettingbanner('" .$list->id_banner. "')\">
                                                <i class=\"fa fa-image\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletesettingbanner('" .$list->id_banner. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->status == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                $media = "<img src='" .$list->gambar_banner. "' width=100/>";

                                $row[] = $no;
                                $row[] = $isactive;
                                $row[] = $list->header_banner;
                                $row[] = $media;
                                $row[] = $tomboledit. ' ' . $changeimg . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_banner->count_all(),
                            "recordsFiltered" => $m_banner->count_filtered(),
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
                $m_banner  = new BannerModel($request);

               /*  $getdata = $m_banner->findAll();
                $max  = count($getdata) + 1;
                $gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				// $gen  = "TBNR" . str_pad(time(), 3, 0, STR_PAD_LEFT);
                $gen  = "TBNR" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
        ->withFile('public/assets/img/banner/' . $filename)
		//->withFile(WRITEPATH.'uploads/' . $filename)
        ->fit(900, 400, 'center')
		->save('public/assets/img/banner/thumbs/' . $filename, 75);
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
                    'settingbanner_kode' => [
                        'label' => 'Kode banner',
                        'rules' => [
                            'required',
                            'is_unique[banner.id_banner]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    // 'settingbanner_nama' => [
                    //     'label' => 'Judul Banner',
                    //     'rules' => 'required',
                    //     'errors' => [
                    //         'required' 		=> '{field} wajib terisi'
                    //     ],
                    // ],

                    'settingbanner_gambar' => [
                        'label' => 'Gambar Banner',
                        'rules' => [
                            'uploaded[settingbanner_gambar]',
                            'mime_in[settingbanner_gambar,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[settingbanner_gambar]',
                            'max_size[settingbanner_gambar,4096]',
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
                        "settingbanner_kode" => $this->validation->getError('settingbanner_kode'),
						// "settingbanner_nama" => $this->validation->getError('settingbanner_nama'),
                        "settingbanner_gambar" => $this->validation->getError('settingbanner_gambar'),
					]
				];
			}
			else
			{
                $kode = $this->request->getVar('settingbanner_kode');
                $gambar = $this->request->getFile('settingbanner_gambar');
                $filename = $kode . '.' . $gambar->getExtension();

                $gambar->move('public/assets/img/banner/', $filename);
                $location = base_url() . '/public/assets/img/banner/thumbs/' . $filename;
				//$gambar->move(WRITEPATH.'uploads/', $filename);
                $this->compressImg($filename);
                
                $data = [
                    'id_banner' => $this->request->getVar('settingbanner_kode'),
                    'header_banner' => $this->request->getVar('settingbanner_nama'),
                    'content_banner' => $this->request->getVar('settingbanner_deskripsi'),
                    'gambar_banner' => $location,
                    'filename' => $gambar->getName(),
                    'link_banner' => $this->request->getVar('settingbanner_link'),
                    'status' => $this->request->getVar('settingbanner_isactive'),
                ];

                $request = Services::request();
                $m_banner = new BannerModel($request);

                $m_banner->insert($data);

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
                $m_banner = new BannerModel($request);

                $item = $m_banner->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_banner'],
                        'judul' => $item['header_banner'],
                        'deskripsi' => $item['content_banner'],
                        'link' => $item['link_banner'],
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
                $m_banner = new BannerModel($request);

                $item = $m_banner->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_banner'],
                        'status' => $item['status'],
                        'gambar' => $item['gambar_banner'],
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
                // $check = $this->validate([
                //     'settingbanner_namaubah' => [
                //         'label' => 'Ubah Judul',
                //         'rules' => 'required',
                //         'errors' => [
                //             'required' 		=> '{field} wajib terisi'
                //         ],
                //     ],
                // ]);

                // if (!$check) {
                //     $msg = [
                //         'error' => [
                //             "settingbanner_namaubah" => $this->validation->getError('settingbanner_namaubah'),
                //         ]
                //     ];
                // }
                // else
                // {
                    $data = [
                        'header_banner' => $this->request->getVar('settingbanner_namaubah'),
                        'content_banner' => $this->request->getVar('settingbanner_deskripsiubah'),
                        'link_banner' => $this->request->getVar('settingbanner_linkubah'),
                    ];
    
                    $kode = $this->request->getVar('settingbanner_kodeubah');
    
                    $request = Services::request();
                    $m_banner = new BannerModel($request);

                    $m_banner->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admsettingbenefit'
                        ]
                    ];
                // }
    
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
                    'settingbannerimg_gambar' => [
                        'label' => 'Gambar Banner',
                        'rules' => [
                            'uploaded[settingbannerimg_gambar]',
                            'mime_in[settingbannerimg_gambar,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[settingbannerimg_gambar]',
                            'max_size[settingbannerimg_gambar,4096]',
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
                    $m_banner = new BannerModel($request);

                    $kode = $this->request->getVar('settingbannerimg_kodeubah');

                    $data = [
                        'status' => $this->request->getVar('settingbannerimg_isactive'),
                    ];
    

                    $m_banner->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => base_url() . '/admsettingbanner'
                        ]
                    ];
                }
                else
                {
                    $request = Services::request();
                    $m_banner = new BannerModel($request);

                    $kode = $this->request->getVar('settingbannerimg_kodeubah');
                    $item = $m_banner->find($kode);
                    $tbname = $item['filename'];

                    unlink('public/assets/img/banner/' . $tbname);
                    unlink('public/assets/img/banner/thumbs/' . $tbname);

                    $gambar = $this->request->getFile('settingbannerimg_gambar');
                    $filename = $kode . '.' . $gambar->getExtension();
    
                    $gambar->move('public/assets/img/banner/', $filename);
                    $location = base_url() . '/public/assets/img/banner/thumbs/' . $filename;
                    //$gambar->move(WRITEPATH.'uploads/', $filename);
                    $this->compressImg($filename);

                    $data = [
                        'gambar_banner' => $location,
                        'filename' => $gambar->getName(),
                        'status' => $this->request->getVar('settingbannerimg_isactive'),
                    ];
    

                    $m_banner->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => base_url() . '/admsettingbanner'
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
                $m_banner = new BannerModel($request);

                $item = $m_banner->find($kode);
                $filename = $item['filename'];

                unlink('public/assets/img/banner/' . $filename);
                unlink('public/assets/img/banner/thumbs/' . $filename);
    
                $m_banner->delete($kode);
    
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