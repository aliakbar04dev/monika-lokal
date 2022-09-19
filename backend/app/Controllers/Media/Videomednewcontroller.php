<?php 
namespace App\Controllers\Media;
use App\Controllers\BaseController;
use App\Models\Media\VideomednewModel;
use App\Models\Media\FiltermedModel;
use App\Models\Media\FiltersubmedModel;
use Config\Services;

class Videomednewcontroller extends BaseController
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
            $m_sub = new FiltersubmedModel($request);
			
			$data = [
                'filtercode' => $m_img->getkodefilternew(),
                'submedia' => $m_sub->getAllData(),
            ];
            return view('menumedia/view_medianewvideo', $data);
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
                $m_newvideo = new VideomednewModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_newvideo->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editmedianewvideo('" .$list->kode_media. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletemedianewvideo('" .$list->kode_media. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";
								
								//$loc   = base_url() . "/public/assets/img/allimg/" . $list->link_media;
								//$media = "<img src='" . $loc. "' width=100/>";

                                if ($list->is_populer == 1) {
                                    $populer = "<span class='badge badge-primary'>Populer</span>";
                                } elseif ($list->is_populer == 0) {
                                    $populer = "<span class='badge badge-danger'>Tidak Populer</span>";
                                } else {
                                    $populer = " - ";
                                }

                                if ($list->is_berbayar == 1) {
                                    $berbayar = "<span class='badge badge-primary'>Berbayar</span>";
                                } elseif ($list->is_berbayar == 0) {
                                    $berbayar = "<span class='badge badge-danger'>Gratis</span>";
                                } else {
                                    $berbayar = " - ";
                                }

                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $row[] = $list->judul_filter;
                                $row[] = $list->keterangan_submedia;
                                $row[] = $list->judul;
								$row[] = $list->link_media;
                                $row[] = $populer;
                                $row[] = $berbayar;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_newvideo->count_all(),
                            "recordsFiltered" => $m_newvideo->count_filtered(),
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
                $m_newvideo = new VideomednewModel($request);

               /*  $getdata = $m_newvideo->findAll();
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
                    'medianewvideo_kode' => [
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
    
                    'medianewvideo_link' => [
                        'label' => 'Link media',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'medianewvideo_thumbs' => [
                        'label' => 'Thumbnails Video',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'medianewvideo_judul' => [
                        'label' => 'Judul media',
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
						"medianewvideo_kode" => $this->validation->getError('medianewvideo_kode'),
						"medianewvideo_link" => $this->validation->getError('medianewvideo_link'),
						"medianewvideo_thumbs" => $this->validation->getError('medianewvideo_thumbs'),
						"medianewvideo_judul" => $this->validation->getError('medianewvideo_judul'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_media' => $this->request->getVar('medianewvideo_kode'),
                    'link_media' => $this->request->getVar('medianewvideo_link'),
					'thumbnails_video' => $this->request->getVar('medianewvideo_thumbs'),
					'judul' => $this->request->getVar('medianewvideo_judul'),
					'deskripsi' => $this->request->getVar('medianewvideo_deskripsi'),
					'kode_filter_media' => $this->request->getVar('medianewvideo_filter'),
                    'kode_filter_submedia' => $this->request->getVar('medianewvideo_subfilter'),
                    'is_populer' => $this->request->getVar('medianewvideo_populer'),
                    'is_berbayar' => $this->request->getVar('medianewvideo_berbayar'),
                    'link_api' => $this->request->getVar('medianewvideo_linkapi'),
                ];

                $request = Services::request();
                $m_newvideo = new VideomednewModel($request);

                $m_newvideo->insert($data);

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
                $m_newvideo = new VideomednewModel($request);

                $item = $m_newvideo->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_media'],
                        'kode_filter' => $item['kode_filter_media'],
                        'kode_filter_submedia' => $item['kode_filter_submedia'],
                        'judul' => $item['judul'],
                        'link'  => $item['link_media'],
						'deskripsi' => $item['deskripsi'],
						'thumbs' => $item['thumbnails_video'],
                        'is_populer' => $item['is_populer'],
                        'is_berbayar' => $item['is_berbayar'],
                        'link_api' => $item['link_api'],
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
                    'medianewvideo_judulubah' => [
                        'label' => 'Ubah judul media',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'medianewvideo_linkubah' => [
                        'label' => 'Ubah link media',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'medianewvideo_thumbsubah' => [
                        'label' => 'Ubah thumbnail video',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "medianewvideo_judulubah" => $this->validation->getError('medianewvideo_judulubah'),
                            "medianewvideo_linkubah" => $this->validation->getError('medianewvideo_linkubah'),
							"medianewvideo_thumbsubah" => $this->validation->getError('medianewvideo_thumbsubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'link_media' => $this->request->getVar('medianewvideo_linkubah'),
                        'thumbnails_video' => $this->request->getVar('medianewvideo_thumbsubah'),
                        'judul' => $this->request->getVar('medianewvideo_judulubah'),
						'deskripsi' => $this->request->getVar('medianewvideo_deskripsiubah'),
                        'kode_filter_media' => $this->request->getVar('medianewvideo_filterubah'),
                        'kode_filter_submedia' => $this->request->getVar('medianewvideo_subfilterubah'),
                        'is_populer' => $this->request->getVar('medianewvideo_populerubah'),
                        'is_berbayar' => $this->request->getVar('medianewvideo_berbayarubah'),
                        'link_api' => $this->request->getVar('medianewvideo_linkapiubah'),
                    ];
    
                    $kode = $this->request->getVar('medianewvideo_kodeubah');
    
                    $request = Services::request();
                    $m_newvideo = new VideomednewModel($request);

                    $m_newvideo->update($kode, $data);
    
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
                $m_newvideo = new VideomednewModel($request);
				
                $m_newvideo->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data video dengan kode ' . $kode,
                        'link' => '/admmedianewvideo'
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

    public function uploadGambar(){
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/video_tutorial/", $fileName);
            echo base_url("public/assets/img/video_tutorial/$fileName");
        }
    }

    public function deleteGambar(){
        $src = $this->request->getVar('src');
        if ($src) {
            $file_name = str_replace(base_url() . "/", "", $src);
            if (unlink($file_name)) {
                echo "Delete file berhasil";
            }
        }
    }
}