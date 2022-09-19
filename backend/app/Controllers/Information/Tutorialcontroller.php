<?php 
namespace App\Controllers\Information;
use App\Controllers\BaseController;
use App\Models\Information\TutorialModel;
use Config\Services;

class Tutorialcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $request = Services::request();
            $m_tutor = new TutorialModel($request);

            $data = [
                'filters'     => $m_tutor->dataFilterAll()
            ];

            // dd($data['filters']);

            return view('menuinformation/view_infotutorial', $data);
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
                $m_tutor = new TutorialModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_tutor->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editinfotutorial('" .$list->id_tutorial. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $changeimg  = "<button type=\"button\" class=\"btn btn-info btn-sm\"
                                                onclick=\"changeimginfotutorial('" .$list->id_tutorial. "')\">
                                                <i class=\"fa fa-image\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteinfotutorial('" .$list->id_tutorial. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $row[] = $no;
                                $row[] = $list->id_tutorial;
                                $row[] = $list->category;
                                $row[] = $list->title;
                                $row[] = strlen($list->sub_title) < 30 ? substr($list->sub_title, 0, 30) : substr($list->sub_title, 0, 30)." ...";
                                // $row[] = $list->slug;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_tutor->count_all(),
                            "recordsFiltered" => $m_tutor->count_filtered(),
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
                $m_tutor  = new TutorialModel($request);


                /* $getdata = $m_news->findAll();
                $max  = count($getdata) + 1;
                $gen  = "PENG" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				
				//$gen  = "TUTOR" . str_pad(time(), 3, 0, STR_PAD_LEFT);
                $gen  = "TUTOR" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
        ->withFile('public/assets/img/tutorial/' . $filename)
        ->fit(728, 300, 'center')
		->save('public/assets/img/tutorial/thumbs/' . $filename, 75);
    }

    public function uploadGambar(){
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/tutorial/", $fileName);
            echo base_url("public/assets/img/tutorial/$fileName");
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
                $validationCheck = $this->validate([
                    'infotutorial_judul' => [
                        'label' => 'Judul tutorial',
                        'rules' => [
                            'required',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
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
						"infotutorial_judul" => $this->validation->getError('infotutorial_judul'),
					]
				];
			}
			else
			{
                $kode = $this->request->getVar('infotutorial_kode');
                $kategori = $this->request->getVar('infotutorial_kategori');
				$jdul = $this->request->getVar('infotutorial_judul');
                $subJdul = $this->request->getVar('infotutorial_subjudul');
				$slug = preg_replace('/\s+/', '-', $jdul);

                $data = [
                    'id_tutorial' => $this->request->getVar('infotutorial_kode'),
                    'category' => $kategori,
                    'title' => $jdul,
                    'sub_title' => $subJdul,
					'slug' => $slug,
                    'content' => $this->request->getPost('infotutorial_isi'),
                ];

                $request = Services::request();
                $m_tutor = new TutorialModel($request);

                $m_tutor->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => base_url() . '/adminfotutorial'
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
                $m_tutor = new TutorialModel($request);

                $item = $m_tutor->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_tutorial'],
                        'kategori' => $item['category'],
                        'judul' => $item['title'],
                        'subjudul' => $item['sub_title'],
                        'isi' => $item['content'],
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
                    'infotutorial_judulubah' => [
                        'label' => 'Judul tutorial',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "infotutorial_judulubah" => $this->validation->getError('infotutorial_judulubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'category' => $this->request->getVar('infotutorial_kategoriubah'),
                        'title' => $this->request->getVar('infotutorial_judulubah'),
                        'sub_title' => $this->request->getVar('infotutorial_subjudulubah'),
                        'content' => $this->request->getPost('infotutorial_isiubah'),
                    ];
    
                    $kode = $this->request->getVar('infotutorial_kodeubah');
    
                    $request = Services::request();
                    $m_tutor = new TutorialModel($request);

                    $m_tutor->update($kode, $data);
    
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
                $m_tutor = new TutorialModel($request);
                $m_tutor->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data tutorial dengan kode ' . $kode,
                        'link' => '/adminfotutorial'
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