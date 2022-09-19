<?php 
namespace App\Controllers\Media;
use App\Controllers\BaseController;
use App\Models\Media\ImagemedModel;
use App\Models\Media\FiltermedModel;
use Config\Services;

class Imagemedcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
			$request = Services::request();
            $m_img = new FiltermedModel($request);
			
			$data = [
                'filtercode' => $m_img->getkodefilter('Gambar'),
            ];
            return view('menumedia/view_mediaimage', $data);
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
                $m_img = new ImagemedModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_img->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editmediaimage('" .$list->kode_media. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletemediaimage('" .$list->kode_media. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";
												
								$changeimg  = "<button type=\"button\" class=\"btn btn-info btn-sm\"
                                                onclick=\"changeimgmediaimage('" .$list->kode_media. "')\">
                                                <i class=\"fa fa-image\"></i></button>";
								
								//$loc   = base_url() . "/public/assets/img/allimg/" . $list->link_media;
								//$media = "<img src='" . $loc. "' width=100/>";

                                $row[] = $no;
                                $row[] = $list->judul_filter;
                                $row[] = $list->judul;
								$row[] = $list->link_media;
                                $row[] = $tomboledit . ' ' . $changeimg . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_img->count_all(),
                            "recordsFiltered" => $m_img->count_filtered(),
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
                $m_img = new ImagemedModel($request);

                /* $getdata = $m_img->findAll();
                $max  = count($getdata) + 1;
                $gen  = "KMED" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				
				// $gen  = "KMED" . str_pad(time(), 3, 0, STR_PAD_LEFT);
                $gen  = "KMED" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
        ->withFile('public/assets/img/allimg/' . $filename)
		//->withFile(WRITEPATH.'uploads/' . $filename)
        ->fit(367, 298, 'center')
		->save('public/assets/img/allimg/thumbs/' . $filename, 75);
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
                    'mediaimage_kode' => [
                        'label' => 'Kode media',
                        'rules' => [
                            'required',
                            'is_unique[media.kode_media]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'mediaimage_judul' => [
                        'label' => 'Judul media',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'mediaimage_gambar' => [
                        'label' => 'Gambar',
                        'rules' => [
                            'uploaded[mediaimage_gambar]',
                            'mime_in[mediaimage_gambar,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[mediaimage_gambar]',
                            'max_size[mediaimage_gambar,4096]',
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
						"mediaimage_kode" => $this->validation->getError('mediaimage_kode'),
						"mediaimage_judul" => $this->validation->getError('mediaimage_judul'),
						"mediaimage_gambar" => $this->validation->getError('mediaimage_gambar'),
					]
				];
			}
			else
			{
				$kode = $this->request->getVar('mediaimage_kode');
				$gambar = $this->request->getFile('mediaimage_gambar');
                $filename = $kode . '.' . $gambar->getExtension();

                $gambar->move('public/assets/img/allimg/', $filename);
				$location = base_url() . '/public/assets/img/allimg/thumbs/' . $filename;
				$this->compressImg($filename);
				
                $data = [
                    'kode_media' => $this->request->getVar('mediaimage_kode'),
                    'link_media' => $location,
					'judul' => $this->request->getVar('mediaimage_judul'),
					'deskripsi' => $this->request->getVar('mediaimage_deskripsi'),
					'kode_filter_media' => $this->request->getVar('mediaimage_filter'),
					'thumbnails_video' => $gambar->getName(),
                ];

                $request = Services::request();
                $m_img = new ImagemedModel($request);

                $m_img->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => base_url() . '/admmediaimage'
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
                $m_img = new ImagemedModel($request);

                $item = $m_img->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_media'],
                        'judul' => $item['judul'],
						'deskripsi' => $item['deskripsi'],
						'kode_filter' => $item['kode_filter_media'],
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
                $m_img = new ImagemedModel($request);

                $item = $m_img->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_media'],
                        'gambar' => $item['thumbnails_video'],
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
                    'mediaimage_judulubah' => [
                        'label' => 'Ubah judul media',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "mediaimage_judulubah" => $this->validation->getError('mediaimage_judulubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'judul' => $this->request->getVar('mediaimage_judulubah'),
						'deskripsi' => $this->request->getVar('mediaimage_deskripsiubah'),
						'kode_filter_media' => $this->request->getVar('mediaimage_filterubah'),
                    ];
    
                    $kode = $this->request->getVar('mediaimage_kodeubah');
    
                    $request = Services::request();
                    $m_img = new ImagemedModel($request);

                    $m_img->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admfiltermed'
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
                    'mediaimage_editgambarubah' => [
                        'label' => 'Gambar',
                        'rules' => [
                            'uploaded[mediaimage_editgambarubah]',
                            'mime_in[mediaimage_editgambarubah,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[mediaimage_editgambarubah]',
                            'max_size[mediaimage_editgambarubah,4096]',
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
                    $msg = [
                        'error' => [
                            "mediaimage_editgambarubah" => $this->validation->getError('mediaimage_editgambarubah'),
                        ]
                    ];
                }
                else
                {
                    $request = Services::request();
                    $m_img = new ImagemedModel($request);
                    $kode = $this->request->getVar('mediaimage_kodeubahgambar');

                    $item = $m_img->find($kode);
                    $tbname = $item['thumbnails_video'];

                    unlink('public/assets/img/allimg/' . $tbname);
                    unlink('public/assets/img/allimg/thumbs/' . $tbname);

                    $gambar = $this->request->getFile('mediaimage_editgambarubah');
                    $filename = $kode . '.' . $gambar->getExtension();

                    $gambar->move('public/assets/img/allimg/', $filename);
					$location = base_url() . '/public/assets/img/allimg/thumbs/' . $filename;
                    $this->compressImg($filename);

                    $data = [
						'thumbnails_video' => $gambar->getName(),
                        'link_media' => $location,
                    ];

                    $m_img->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => base_url() . '/admmediaimage'
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
                $m_img = new ImagemedModel($request);
				
				$item = $m_img->find($kode);
                $filename = $item['thumbnails_video'];
    
				unlink('public/assets/img/allimg/' . $filename);
                unlink('public/assets/img/allimg/thumbs/' . $filename);
                $m_img->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data media dengan kode ' . $kode,
                        'link' => '/admmediafilter'
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