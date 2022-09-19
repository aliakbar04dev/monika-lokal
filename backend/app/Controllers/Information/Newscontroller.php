<?php 
namespace App\Controllers\Information;
use App\Controllers\BaseController;
use App\Models\Information\NewsModel;
use App\Models\Information\CategoryModel;
use App\Models\Information\TypeModel;
use Config\Services;

class Newscontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $request = Services::request();
            $m_cat = new CategoryModel($request);
            $m_type = new TypeModel($request);

            $kode_jenis_pengumuman3 = ['JEPM001', 'JEPM002'];

            $data = [
                'category' => $m_cat->whereIn('kode_jenis_pengumuman', $kode_jenis_pengumuman3)->find(),
                'type'     => $m_type->whereIn('kode_jenis_pengumuman', $kode_jenis_pengumuman3)->find()
            ];

            return view('menuinformation/view_infonews', $data);
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
                $m_news = new NewsModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_news->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editinfonews('" .$list->kode_pengumuman. "')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $changeimg  = "<button type=\"button\" class=\"btn btn-info btn-sm\"
                                                onclick=\"changeimginfonews('" .$list->kode_pengumuman. "')\">
                                                <i class=\"fa fa-image\"></i></button>";

                                $changecover  = "<button type=\"button\" class=\"btn btn-dark btn-sm\"
                                                onclick=\"changecoverinfonews('" .$list->kode_pengumuman. "')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lihat Cover Berita\">
                                                <i class=\"fa fa-book\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteinfonews('" .$list->kode_pengumuman. "')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->status == 'NEW') {
                                    $statusNewHot = "<span class='badge badge-primary'>NEW</span>";
                                } elseif ($list->status == 'HOT') {
                                    $statusNewHot = "<span class='badge badge-danger'>HOT</span>";
                                } else {
                                    $statusNewHot = " - ";
                                }
                                
                                $row[] = $tomboledit . ' ' . $changecover . ' ' . $tombolhapus;
                                $row[] = $no;
                                $row[] = date("d/m/Y H:i", strtotime($list->tgl_pengumuman));
                                $row[] = $list->jenis_pengumuman;
                                $row[] = $list->nama_kategori_pengumuman;
                                $row[] = $statusNewHot;
                                $row[] = $list->judul;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_news->count_all(),
                            "recordsFiltered" => $m_news->count_filtered(),
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
                $m_news  = new NewsModel($request);

                /* $getdata = $m_news->findAll();
                $max  = count($getdata) + 1;
                $gen  = "PENG" . str_pad($max, 3, 0, STR_PAD_LEFT); 
				
				$gen  = "PENG" . str_pad(time(), 3, 0, STR_PAD_LEFT); */
                $gen  = "PENG" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
	
	public function filterJenis() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_cat = new CategoryModel($request);

                $item = $m_cat->where('kode_jenis_pengumuman', $kode)->find();
                echo json_encode($item);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    function compressImg($filename) {
        $thumbnail = \Config\Services::image()
        ->withFile('public/assets/img/news/' . $filename)
		//->withFile(WRITEPATH.'uploads/' . $filename)
        ->fit(728, 300, 'center')
		->save('public/assets/img/news/thumbs/' . $filename, 75);
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
                    'infonews_kode' => [
                        'label' => 'Kode pengumuman',
                        'rules' => [
                            'required',
                            'is_unique[pengumuman.kode_pengumuman]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'infonews_judul' => [
                        'label' => 'Judul pengumuman',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'infonews_cover' => [
                        'label' => 'Cover',
                        'rules' => [
                            'uploaded[infonews_cover]',
                            'mime_in[infonews_cover,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[infonews_cover]',
                            'max_size[infonews_cover,4096]',
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
						"infonews_kode" => $this->validation->getError('infonews_kode'),
                        "infonews_judul" => $this->validation->getError('infonews_judul'),
                        // "infonews_gambar" => $this->validation->getError('infonews_gambar'),
                        "infonews_cover" => $this->validation->getError('infonews_cover'),
					]
				];
			}
			else
			{
                date_default_timezone_set('Asia/Jakarta'); 

                $kode = $this->request->getVar('infonews_kode');

                $fileCover = $this->request->getFile('infonews_cover');
                if ($fileCover->isValid() && ! $fileCover->hasMoved()) {
                    $imageNameCover = $fileCover->getRandomName();
                    $fileCover->move('public/assets/img/news_cms/', $imageNameCover);
                }

                $isactive = $this->request->getVar('infonews_isactive');
                $judul = $this->request->getVar('infonews_judul');
                $kode_kategori_pengumuman = $this->request->getVar('infonews_kategoripengumuman');

                $db = db_connect();
                $hasilKatPeng = $db->table('kategori_pengumuman')
                                    ->select('nama_kategori_pengumuman')
                                    ->where('kode_kategori_pengumuman', $kode_kategori_pengumuman)
                                    ->get()->getRowArray();
                $nmKatPeng = $hasilKatPeng['nama_kategori_pengumuman'];

                if ($this->request->getVar('infonews_statusnotif') == 1) {

                    /* Endpoint */
                    $url = 'https://monika.panensaham.com/panenapi/postnotification';
            
                    /* eCurl */
                    $curl = curl_init($url);

                    $title = 'News - Monika PanenSaham';
                    $body = $judul;
                    $type_notif = 'topic';
                    $topic = 'monika-news';
                    $token = '';
                    $type = 'news';
                    $document_id = $kode;
                    $category_name = $nmKatPeng;
            
                    /* Data */
                    $data = [
                        'title' => $title, 
                        'body' => $body,
                        'type_notif' => $type_notif, 
                        'topic' => $topic, 
                        'token' => $token, 
                        'type' => $type, 
                        'document_id' => $document_id, 
                        'category_name' => $category_name,
                    ];
            
                    /* Set JSON data to POST */
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        
                    /* Define content type */
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'x-auth: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJQYW5lblNhaGFtQXBpIiwiYXVkIjoiTW9uaWthTW9iaWxlIiwiaWF0IjoxNjI4NjE0MDM3LCJuYmYiOjE2Mjg2MTQwNDcsImV4cCI6MzMxODYyMTQwMzcsImRhdGEiOnsiaWQiOiIxIiwiZW1haWwiOiJkZXZAcGFuZW4uY28iLCJwYXNzd29yZCI6IjQ5ZTFlZDlhN2UwNTQ2MmZjNDk1OWI5MjA2YTgwMDNlIn19.6d9pWz2j77S6gwXk_ycOaHsqdy00nIR_y_vBTbK6Q_M',
                    ));
                        
                    /* Return json */
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        
                    /* make request */
                    $result = curl_exec($curl);
                        
                    /* close curl */
                    curl_close($curl);
                }
                
                $dataInsert = [
                    'kode_pengumuman' => $kode,
                    'kode_jenis_pengumuman' => $this->request->getVar('infonews_jenispengumuman'),
                    'kode_kategori_pengumuman' => $this->request->getVar('infonews_kategoripengumuman'),
                    'tgl_pengumuman' => date("Y-m-d H:i:s"),
                    'judul' => $this->request->getVar('infonews_judul'),
                    'status' => $this->request->getVar('infonews_statuspengumuman'),
                    'isi_pengumuman' => $this->request->getVar('infonews_isi'),
                    // 'gambar' => $imageName,
                    'cover' => $imageNameCover,
                    'status_notif' => $this->request->getVar('infonews_statusnotif'),
                    'is_active' => $isactive,
                ];

                $request = Services::request();
                $m_news = new NewsModel($request);

                $m_news->insert($dataInsert);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => base_url() . '/adminfonews'
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
                $m_news = new NewsModel($request);
                $item = $m_news->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_pengumuman'],
                        'kode_jenis' => $item['kode_jenis_pengumuman'],
                        'kode_kategori' => $item['kode_kategori_pengumuman'],
                        'judul' => $item['judul'],
                        'isi' => $item['isi_pengumuman'],
                        'status' => $item['status'],
                        'status_notif' => $item['status_notif'],
                        // 'gambar' => $item['gambar'],
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
                $check = $this->validate([
                    'infonews_judulubah' => [
                        'label' => 'Judul pengumuman',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "infonews_judulubah" => $this->validation->getError('infonews_judulubah'),
                        ]
                    ];
                }
                else
                {
                    $kode = $this->request->getVar('infonews_kodeubah');
                    $request = Services::request();
                    $m_news = new NewsModel($request);
                    $item = $m_news->find($kode);
                    $judul = $item['judul'];
                    $kode_pengumuman = $item['kode_pengumuman'];
                    $kode_kategori_pengumuman = $item['kode_kategori_pengumuman'];

                    $db = db_connect();
                    $hasilKatPeng = $db->table('kategori_pengumuman')
                                        ->select('nama_kategori_pengumuman')
                                        ->where('kode_kategori_pengumuman', $kode_kategori_pengumuman)
                                        ->get()->getRowArray();
                    $nmKatPeng = $hasilKatPeng['nama_kategori_pengumuman'];

                    if ($this->request->getVar('infonews_statusnotifubah') == 1) {

                        /* Endpoint */
                        $url = 'https://monika.panensaham.com/panenapi/postnotification';
                
                        /* eCurl */
                        $curl = curl_init($url);

                        $title = 'News - Monika PanenSaham';
                        $body = $judul;
                        $type_notif = 'topic';
                        $topic = 'monika-news';
                        $token = '';
                        $type = 'news';
                        $document_id = $kode_pengumuman;
                        $category_name = $nmKatPeng;
                
                        /* Data */
                        $data = [
                            'title' => $title, 
                            'body' => $body,
                            'type_notif' => $type_notif, 
                            'topic' => $topic, 
                            'token' => $token, 
                            'type' => $type, 
                            'document_id' => $document_id, 
                            'category_name' => $category_name,
                        ];
                
                        /* Set JSON data to POST */
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                            
                        /* Define content type */
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                            'x-auth: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJQYW5lblNhaGFtQXBpIiwiYXVkIjoiTW9uaWthTW9iaWxlIiwiaWF0IjoxNjI4NjE0MDM3LCJuYmYiOjE2Mjg2MTQwNDcsImV4cCI6MzMxODYyMTQwMzcsImRhdGEiOnsiaWQiOiIxIiwiZW1haWwiOiJkZXZAcGFuZW4uY28iLCJwYXNzd29yZCI6IjQ5ZTFlZDlhN2UwNTQ2MmZjNDk1OWI5MjA2YTgwMDNlIn19.6d9pWz2j77S6gwXk_ycOaHsqdy00nIR_y_vBTbK6Q_M',
                        ));
                            
                        /* Return json */
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            
                        /* make request */
                        $result = curl_exec($curl);
                            
                        /* close curl */
                        curl_close($curl);
                    }

                    $dataUpdate = [
                        'kode_jenis_pengumuman' => $this->request->getVar('infonews_jenispengumumanubah'),
                        'kode_kategori_pengumuman' => $this->request->getVar('infonews_kategoripengumumanubah'),
                        'tgl_pengumuman' => date("Y-m-d"),
                        'judul' => $this->request->getVar('infonews_judulubah'),
                        'status' => $this->request->getVar('infonews_statuspengumumanubah'),
                        'isi_pengumuman' => $this->request->getVar('infonews_isiubah'),
                        'status_notif' => $this->request->getVar('infonews_statusnotifubah'),
                        'is_active' => $this->request->getVar('infonews_isactiveubah'),
                    ];
        
                    $request = Services::request();
                    $m_news = new NewsModel($request);

                    $m_news->update($kode, $dataUpdate);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => base_url() . '/adminfonews'
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
                $m_news = new NewsModel($request);

                $item = $m_news->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_pengumuman'],
                        'gambar' => $item['gambar'],
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
                    'infonews_editgambarubah' => [
                        'label' => 'Gambar',
                        'rules' => [
                            'uploaded[infonews_editgambarubah]',
                            'mime_in[infonews_editgambarubah,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[infonews_editgambarubah]',
                            'max_size[infonews_editgambarubah,4096]',
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
                            "infonews_editgambarubah" => $this->validation->getError('infonews_editgambarubah'),
                        ]
                    ];
                }
                else
                {
                    $request = Services::request();
                    $m_news = new NewsModel($request);
                    $kode = $this->request->getVar('infonews_editkodeubah');

                    $item = $m_news->find($kode);
                    $tbname = $item['gambar'];

                    unlink('public/assets/img/news/' . $tbname);
                    unlink('public/assets/img/news/thumbs/' . $tbname);

                    $gambar = $this->request->getFile('infonews_editgambarubah');
                    $filename = $kode . '.' . $gambar->getExtension();

                    $gambar->move('public/assets/img/news/', $filename);
                    $this->compressImg($filename);

                    $data = [
                        'gambar' => $gambar->getName(),
                    ];

                    $m_news->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => base_url() . '/adminfonews'
                        ]
                    ];

                    // $msg = [
                    //     'success' => [
                    //        'data' => $kode,
                    //        'link' => '/admcattype'
                    //     ]
                    // ];
                }
    
                echo json_encode($msg);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function pilihcover() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_news = new NewsModel($request);

                $item = $m_news->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_pengumuman'],
                        'cover' => $item['cover'],
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

    public function perbaruicover() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'infonews_editcoverubah' => [
                        'label' => 'Cover',
                        'rules' => [
                            'uploaded[infonews_editcoverubah]',
                            'mime_in[infonews_editcoverubah,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[infonews_editcoverubah]',
                            'max_size[infonews_editcoverubah,4096]',
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
                            "infonews_editcoverubah" => $this->validation->getError('infonews_editcoverubah'),
                        ]
                    ];
                }
                else
                {
                    $request = Services::request();
                    $m_news = new NewsModel($request);
                    $kode = $this->request->getVar('infonews_editkodeubahcover');

                    $item = $m_news->find($kode);
                    $oldCover = $item['cover']; 

                    $file = $this->request->getFile('infonews_editcoverubah');

                    if ($oldCover == null || $oldCover == "" || $oldCover == " " || empty($oldCover)) {
                        if ($file->isValid() && ! $file->hasMoved()) {
                            $coverName = $file->getRandomName();
                            // var_dump($coverName); die;
                            $file->move('public/assets/img/news_cms/', $coverName);
                        }
                    } else {
                        if ($file->isValid() && ! $file->hasMoved()) {
                            if (file_exists('public/assets/img/news_cms/'.$oldCover)) {
                                unlink('public/assets/img/news_cms/'.$oldCover);
                            }
                            $coverName = $file->getRandomName();
                            $file->move('public/assets/img/news_cms/', $coverName);
                        } else {
                            $coverName = $item['cover'];
                        }
                    }
                  
                    $data = [
                        'cover' => $coverName
                    ];

                    $m_news->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui cover berita',
                           'link' => base_url() . '/adminfonews'
                        ]
                    ];

                    // $msg = [
                    //     'success' => [
                    //        'data' => $kode,
                    //        'link' => '/admcattype'
                    //     ]
                    // ];
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
                $m_news = new NewsModel($request);

                $item = $m_news->find($kode);
                $filename = $item['cover'];
                unlink('public/assets/img/news_cms/' . $filename);

                $m_news->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data pengumuman dengan kode ' . $kode,
                        'link' => '/adminfonews'
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
            $dataFile->move("public/assets/img/news/", $fileName);
            echo base_url("public/assets/img/news/$fileName");
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