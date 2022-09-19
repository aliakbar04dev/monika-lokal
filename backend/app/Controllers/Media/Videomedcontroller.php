<?php 
namespace App\Controllers\Media;
use App\Controllers\BaseController;
use App\Models\Media\VideomedModel;
use App\Models\Media\FiltermedModel;
use Config\Services;

class Videomedcontroller extends BaseController
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
                'filtercode' => $m_img->getkodefilter('Video'),
            ];
            return view('menumedia/view_mediavideo', $data);
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
                $m_video = new VideomedModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_video->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editmediavideo('" .$list->kode_media. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletemediavideo('" .$list->kode_media. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";
								
								//$loc   = base_url() . "/public/assets/img/allimg/" . $list->link_media;
								//$media = "<img src='" . $loc. "' width=100/>";

                                $row[] = $no;
                                $row[] = $list->judul_filter;
                                $row[] = $list->judul;
								$row[] = $list->link_media;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_video->count_all(),
                            "recordsFiltered" => $m_video->count_filtered(),
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
                $m_video = new VideomedModel($request);

               /*  $getdata = $m_video->findAll();
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
                    'mediavideo_kode' => [
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
    
                    'mediavideo_link' => [
                        'label' => 'Link media',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'mediavideo_thumbs' => [
                        'label' => 'Thumbnails Video',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'mediavideo_judul' => [
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
						"mediavideo_kode" => $this->validation->getError('mediavideo_kode'),
						"mediavideo_link" => $this->validation->getError('mediavideo_link'),
						"mediavideo_thumbs" => $this->validation->getError('mediavideo_thumbs'),
						"mediavideo_judul" => $this->validation->getError('mediavideo_judul'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_media' => $this->request->getVar('mediavideo_kode'),
                    'link_media' => $this->request->getVar('mediavideo_link'),
					'thumbnails_video' => $this->request->getVar('mediavideo_thumbs'),
					'judul' => $this->request->getVar('mediavideo_judul'),
					'deskripsi' => $this->request->getVar('mediavideo_deskripsi'),
					'kode_filter_media' => $this->request->getVar('mediavideo_filter'),
                ];

                $request = Services::request();
                $m_video = new VideomedModel($request);

                $m_video->insert($data);

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
                $m_video = new VideomedModel($request);

                $item = $m_video->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_media'],
                        'judul' => $item['judul'],
						'deskripsi' => $item['deskripsi'],
                        'kode_filter' => $item['kode_filter_media'],
                        'link'  => $item['link_media'],
						'thumbs' => $item['thumbnails_video'],
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
                    'mediavideo_judulubah' => [
                        'label' => 'Ubah judul media',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'mediavideo_linkubah' => [
                        'label' => 'Ubah link media',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'mediavideo_thumbsubah' => [
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
                            "mediavideo_judulubah" => $this->validation->getError('mediavideo_judulubah'),
                            "mediavideo_linkubah" => $this->validation->getError('mediavideo_linkubah'),
							"mediavideo_thumbsubah" => $this->validation->getError('mediavideo_thumbsubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'judul' => $this->request->getVar('mediavideo_judulubah'),
						'deskripsi' => $this->request->getVar('mediavideo_deskripsiubah'),
                        'kode_filter_media' => $this->request->getVar('mediavideo_filterubah'),
                        'link_media' => $this->request->getVar('mediavideo_linkubah'),
						'thumbnails_video' => $this->request->getVar('mediavideo_thumbsubah'),
                    ];
    
                    $kode = $this->request->getVar('mediavideo_kodeubah');
    
                    $request = Services::request();
                    $m_video = new VideomedModel($request);

                    $m_video->update($kode, $data);
    
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
                $m_video = new VideomedModel($request);
				
                $m_video->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data video dengan kode ' . $kode,
                        'link' => '/admmediavideo'
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