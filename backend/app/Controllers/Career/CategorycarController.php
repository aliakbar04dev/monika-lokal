<?php 
namespace App\Controllers\Career;
use App\Controllers\BaseController;
use App\Models\Career\CategorycarModel;
use Config\Services;

class CategorycarController extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menucareer/view_careercategory');
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
                $m_category = new CategorycarModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_category->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editcareercategory('" .$list->id_kategori_pekerjaan. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletecareercategory('" .$list->id_kategori_pekerjaan. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->id_kategori_pekerjaan;
                                $row[] = $list->kategori_pekerjaan;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_category->count_all(),
                            "recordsFiltered" => $m_category->count_filtered(),
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
                $m_cat = new CategorycarModel($request);

                $getdata = $m_cat->getLastData();
                $kode = substr($getdata->kode, 4) + 1;
                $gen  = "TKTP" . str_pad($kode, 3, 0, STR_PAD_LEFT);

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
                    'careercategory_kode' => [
                        'label' => 'Kode kategori pekerjaan',
                        'rules' => [
                            'required',
                            'is_unique[t_kategori_pekerjaan.id_kategori_pekerjaan]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'careercategory_nama' => [
                        'label' => 'Kategori pekerjaan',
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
						"careercategory_kode" => $this->validation->getError('careercategory_kode'),
						"careercategory_nama" => $this->validation->getError('careercategory_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'id_kategori_pekerjaan' => $this->request->getVar('careercategory_kode'),
                    'kategori_pekerjaan' => $this->request->getVar('careercategory_nama'),
                ];

                $request = Services::request();
                $m_cat = new CategorycarModel($request);

                $m_cat->insert($data);;

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admcareercategory'
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
                $m_cat = new CategorycarModel($request);

                $item = $m_cat->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_kategori_pekerjaan'],
                        'nama' => $item['kategori_pekerjaan'],
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
                    'careercategory_namaubah' => [
                        'label' => 'Ubah kategori pekerjaan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "careercategory_namaubah" => $this->validation->getError(careercategory_namaubah),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'kategori_pekerjaan' => $this->request->getVar('careercategory_namaubah'),
                    ];
    
                    $kode = $this->request->getVar('careercategory_kodeubah');

                    $request = Services::request();
                    $m_cat = new CategorycarModel($request);
    
                    $m_cat->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admcareercategory'
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
                $m_cat = new CategorycarModel($request);

                $m_cat->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data type dengan kode ' . $kode,
                        'link' => '/admcareercategory'
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
	//--------------------------------------------------------------------
	
}