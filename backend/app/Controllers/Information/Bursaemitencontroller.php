<?php 
namespace App\Controllers\Information;
use App\Controllers\BaseController;
use App\Models\Information\BursaemitenModel;
use App\Models\Information\CategoryModel;
use App\Models\Information\TypeModel;
use Config\Services;

class Bursaemitencontroller extends BaseController
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
            $kode_jenis_pengumuman = ['JEPM003', 'JEPM004'];
            $kode_jenis_pengumuman2 = ['JEPM003', 'JEPM004'];

            $this->db = db_connect();
            $dataResult = $this->db->query("SELECT a.*, b.nama_kategori_pengumuman, c.jenis_pengumuman FROM bursaemiten a 
                                LEFT JOIN kategori_pengumuman b ON a.kode_kategori_pengumuman=b.kode_kategori_pengumuman
                                LEFT JOIN jenis_pengumuman c ON a.kode_jenis_pengumuman=c.kode_jenis_pengumuman
                                ORDER BY a.tgl_pengumuman DESC")->getResultArray();

            $data = [
                'type'     => $m_type->whereIn('kode_jenis_pengumuman', $kode_jenis_pengumuman)->find(),
                'category' =>  $m_cat->whereIn('kode_jenis_pengumuman', $kode_jenis_pengumuman2)->find(),
                'dataResult' => $dataResult
            ];

            // echo json_encode($data['category']); die;

            return view('menuinformation/view_infobursaemiten', $data);
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
                $m_bursaemiten = new BursaemitenModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_bursaemiten->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editinfobursaemiten('" .$list->kode_pengumuman. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $changePdf  = "<button type=\"button\" class=\"btn btn-dark btn-sm\"
                                                onclick=\"changepdfinfobursaemiten('" .$list->kode_pengumuman. "')\">
                                                <i class=\"fa fa-file-pdf\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteinfobursaemiten('" .$list->kode_pengumuman. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1) {
                                    $isactive = "<span style='color:#2dce89;'>Active</span";
                                } else {
                                    $isactive = "<span style='color:#f5365c;'>Not Active</span";
                                }

                                if ($list->status == 'NEW') {
                                    $statusNewHot = "<span class='badge badge-primary'>NEW</span>";
                                } elseif ($list->status == 'HOT') {
                                    $statusNewHot = "<span class='badge badge-danger'>HOT</span>";
                                } else {
                                    $statusNewHot = " - ";
                                }

                                $row[] = $no;
                                $row[] = date("d/m/Y H:i", strtotime($list->tgl_pengumuman));
                                $row[] = $list->jenis_pengumuman;
                                $row[] = $list->nama_kategori_pengumuman;
                                $row[] = $statusNewHot;
                                $row[] = strlen($list->judul) <= 40 ? substr($list->judul, 0, 40) : substr($list->judul, 0, 40). ' ...';
                                $row[] = $isactive;
                                $row[] = $tomboledit  . $changePdf . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_bursaemiten->count_all(),
                            "recordsFiltered" => $m_bursaemiten->count_filtered(),
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
                $m_bursaemiten  = new BursaemitenModel($request);

                /* $getdata = $m_bursaemiten->findAll();
                $max  = count($getdata) + 1;
                $gen  = "PENG" . str_pad($max, 3, 0, STR_PAD_LEFT); 
				
				$gen  = "PENG" . str_pad(time(), 3, 0, STR_PAD_LEFT); */

                $acak = rand();

                $gen  = "BSEM" . (date("dmy")) . $acak;

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
        ->withFile('public/assets/img/bursaemiten/' . $filename)
        ->fit(728, 300, 'center')
		->save('public/assets/img/bursaemiten/thumbs/' . $filename, 75);
    }

    public function uploadGambar(){
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/bursaemiten/", $fileName);
            echo base_url("public/assets/img/bursaemiten/$fileName");
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

    public function simpandata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $berkas = $this->request->getFile('infobursaemiten_berkas');
                // var_dump($berkas); die;

                $validationCheck = $this->validate([
                    'infobursaemiten_kode' => [
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
    
                    'infobursaemiten_judul' => [
                        'label' => 'Judul pengumuman',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    // 'infobursaemiten_gambar' => [
                    //     'label' => 'Gambar',
                    //     'rules' => [
                    //         'uploaded[infobursaemiten_gambar]',
                    //         'mime_in[infobursaemiten_gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    //         'is_image[infobursaemiten_gambar]',
                    //         'max_size[infobursaemiten_gambar,4096]',
                    //     ],
                    //     'errors' => [
                    //         'uploaded'      => '{field} wajib diisi',
                    //         'mime_in' 		=> '{field} tidak sesuai format standar',
                    //         'is_image'      => '{field} tidak sesuai',
                    //         'max-size'      => '{field} melebihi ukuran yang ditentukan',
                    //     ],
                    // ],
                    // 'infobursaemiten_berkas' => [
                    //     'label' => 'Berkas',
                    //     'rules' => [
                    //         'uploaded[infobursaemiten_berkas]',
                    //         'mime_in[infobursaemiten_berkas,application/pdf]',
                    //         'max_size[infobursaemiten_berkas,5000]',
                    //     ],
                    //     'errors' => [
                    //         'uploaded'      => '{field} wajib diisi',
                    //         'mime_in' 		=> '{field} tidak sesuai format standar',
                    //         'max-size'      => '{field} melebihi ukuran yang ditentukan',
                    //     ],
                    // ]
                ]);
            }
            else
            {
                return view('errors/html/error_404');
            }

            if (!$validationCheck) {
				$msg = [
					'error' => [
						"infobursaemiten_kode" => $this->validation->getError('infobursaemiten_kode'),
                        "infobursaemiten_judul" => $this->validation->getError('infobursaemiten_judul'),
                        // "infobursaemiten_gambar" => $this->validation->getError('infobursaemiten_gambar'),
                        // "infobursaemiten_berkas" => $this->validation->getError('infobursaemiten_berkas'),
					]
				];
			}
			else
			{
                date_default_timezone_set('Asia/Jakarta'); 
                $kode = $this->request->getVar('infobursaemiten_kode');

                // $fileImage = $this->request->getFile('infobursaemiten_gambar');
                // if ($fileImage->isValid() && ! $fileImage->hasMoved()) {
                //     $imageName = $fileImage->getRandomName();
                //     $fileImage->move('public/assets/img/bursaemiten/', $imageName);
                // }

                $filePdf = $this->request->getFile('infobursaemiten_berkas');
                if ($filePdf->isValid() && ! $filePdf->hasMoved()) {
                    $imageNamePdf = $filePdf->getRandomName();
                    $filePdf->move('public/assets/img/bursaemiten/', $imageNamePdf);
                } else {
                    $imageNamePdf = '';
                }

                $isactive = $this->request->getVar('infobursaemiten_isactive');
                $judul = $this->request->getVar('infobursaemiten_judul');
                $kode_kategori_pengumuman = $this->request->getVar('infobursaemiten_kategoripengumuman');

                $db = db_connect();
                $hasilKatPeng = $db->table('kategori_pengumuman')
                                    ->select('nama_kategori_pengumuman')
                                    ->where('kode_kategori_pengumuman', $kode_kategori_pengumuman)
                                    ->get()->getRowArray();
                $nmKatPeng = $hasilKatPeng['nama_kategori_pengumuman'];

                if ($this->request->getVar('infobursaemiten_statusnotif') == 1) {

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
                    'kode_jenis_pengumuman' => $this->request->getVar('infobursaemiten_jenispengumuman'),
                    'kode_kategori_pengumuman' => $this->request->getVar('infobursaemiten_kategoripengumuman'),
                    'status' => $this->request->getVar('infobursaemiten_statuspengumuman'),
                    'tgl_pengumuman' => date("Y-m-d H:i:s"),
                    'judul' => $this->request->getVar('infobursaemiten_judul'),
                    'isi_pengumuman' => $this->request->getVar('infobursaemiten_isi'),
                    // 'gambar' => $imageName,
                    'berkas' => $imageNamePdf,
                    'status_notif' => $this->request->getVar('infobursaemiten_statusnotif'),
                    'is_active' => $isactive,
                ];

                $request = Services::request();
                $m_bursaemiten = new BursaemitenModel($request);

                $m_bursaemiten->insert($dataInsert);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => base_url() . '/adminfobursaemiten'
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
                $m_bursaemiten = new BursaemitenModel($request);

                $item = $m_bursaemiten->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_pengumuman'],
                        'kode_pengumuman' => $item['kode_jenis_pengumuman'],
                        'kode_kategori' => $item['kode_kategori_pengumuman'],
                        'status' => $item['status'],
                        'judul' => $item['judul'],
                        'isi' => $item['isi_pengumuman'],
                        'gambar' => $item['gambar'],
                        'status_notif' => $item['status_notif'],
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
                $m_bursaemiten = new BursaemitenModel($request);

                $item = $m_bursaemiten->find($kode);
                // var_dump($item); die;
    
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
                $m_bursaemiten = new BursaemitenModel($request);

                $item = $m_bursaemiten->find($kode);
                // var_dump($item); die;
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_pengumuman'],
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
                    'infobursaemiten_judulubah' => [
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
                            "infobursaemiten_judulubah" => $this->validation->getError('infobursaemiten_judulubah'),
                        ]
                    ];
                }
                else
                {
                    date_default_timezone_set('Asia/Jakarta'); 
                    $kode = $this->request->getVar('infobursaemiten_kodeubah');
                    $kode_kategori_pengumuman = $this->request->getVar('infobursaemiten_kategoripengumumanubah');
                    $judul = $this->request->getVar('infobursaemiten_judulubah');

                    $db = db_connect();
                    $hasilKatPeng = $db->table('kategori_pengumuman')
                                        ->select('nama_kategori_pengumuman')
                                        ->where('kode_kategori_pengumuman', $kode_kategori_pengumuman)
                                        ->get()->getRowArray();
                    $nmKatPeng = $hasilKatPeng['nama_kategori_pengumuman'];

                    if ($this->request->getVar('infobursaemiten_statusnotifubah') == 1) {

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

                    $dataUpdate = [
                        'kode_jenis_pengumuman' => $this->request->getVar('infobursaemiten_jenispengumumanubah'),
                        'kode_kategori_pengumuman' => $this->request->getVar('infobursaemiten_kategoripengumumanubah'),
                        'status' => $this->request->getVar('infobursaemiten_statuspengumumanubah'),
                        'tgl_pengumuman' => date("Y-m-d H:i:s"),
                        'judul' => $this->request->getVar('infobursaemiten_judulubah'),
                        'isi_pengumuman' => $this->request->getVar('infobursaemiten_isiubah'),
                        'status_notif' => $this->request->getVar('infobursaemiten_statusnotifubah'),
                        'is_active' => $this->request->getVar('infobursaemiten_isactiveubah'),
                    ];
        
                    $request = Services::request();
                    $m_bursaemiten = new BursaemitenModel($request);

                    $m_bursaemiten->update($kode, $dataUpdate);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => base_url() . '/adminfobursaemiten'
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
                    'infobursaemiten_editgambarubah' => [
                        'label' => 'Gambar',
                        'rules' => [
                            'uploaded[infobursaemiten_editgambarubah]',
                            'mime_in[infobursaemiten_editgambarubah,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[infobursaemiten_editgambarubah]',
                            'max_size[infobursaemiten_editgambarubah,4096]',
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
                            "infobursaemiten_editgambarubah" => $this->validation->getError('infobursaemiten_editgambarubah'),
                        ]
                    ];
                }
                else
                {
                    $kode = $this->request->getVar('infobursaemiten_editkodeubah'); 
                    $request = Services::request();
                    $m_bursaemiten = new BursaemitenModel($request);
                    
                    $item = $m_bursaemiten->find($kode);
                    $oldImage = $item['gambar'];

                    $file = $this->request->getFile('infobursaemiten_editgambarubah');

                    if ($file->isValid() && ! $file->hasMoved()) {
                        if (file_exists('public/assets/img/bursaemiten/'.$oldImage)) {
                            unlink('public/assets/img/bursaemiten/'.$oldImage);
                        }
                        $imageName = $file->getRandomName();
                        $file->move('public/assets/img/bursaemiten/', $imageName);
                    } else {
                        $imageName = $item['gambar'];
                    }

                    $data = [
                        'gambar' => $imageName,
                    ];

                    $m_bursaemiten->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui gambar',
                           'link' => base_url() . '/adminfobursaemiten'
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
                    'infobursaemiten_editpdfubah' => [
                        'label' => 'PDF',
                        'rules' => [
                            'uploaded[infobursaemiten_editpdfubah]',
                            'mime_in[infobursaemiten_editpdfubah,application/pdf]',
                            'max_size[infobursaemiten_editpdfubah,5000]',
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
                            "infobursaemiten_editpdfubah" => $this->validation->getError('infobursaemiten_editpdfubah'),
                        ]
                    ];
                }
                else
                {
                    $request = Services::request();
                    $m_bursaemiten = new BursaemitenModel($request);
                    $kode = $this->request->getVar('infobursaemiten_editkodeubahpdf');

                    $item = $m_bursaemiten->find($kode);
                    $oldPdf = $item['berkas'];
                    
                    $file = $this->request->getFile('infobursaemiten_editpdfubah');

                    if ($file->isValid() && ! $file->hasMoved()) {
                        if (file_exists('public/assets/img/bursaemiten/'.$oldPdf)) {
                            unlink('public/assets/img/bursaemiten/'.$oldPdf);
                        }
                        $pdfName = $file->getRandomName();
                        $file->move('public/assets/img/bursaemiten/', $pdfName);
                    } else {
                        $pdfName = $item['berkas'];
                    }

                    $data = [
                        'berkas' => $pdfName,
                    ];

                    $m_bursaemiten->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui PDF',
                           'link' => base_url() . '/adminfobursaemiten'
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
                $m_bursaemiten = new BursaemitenModel($request);

                $item = $m_bursaemiten->find($kode);
                $filenamepDF = $item['berkas'];

                if (!empty($filenamepDF)) {
                    unlink('public/assets/img/bursaemiten/'.$filenamepDF);
                } else {
                    # code...
                }

                $m_bursaemiten->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data pengumuman dengan kode ' . $kode,
                        'link' => '/adminfobursaemiten'
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