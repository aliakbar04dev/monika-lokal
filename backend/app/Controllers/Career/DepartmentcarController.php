<?php 
namespace App\Controllers\Career;
use App\Controllers\BaseController;
use App\Models\Career\DepartmentcarModel;
use Config\Services;

class DepartmentcarController extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menucareer/view_careerdepartment');
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
                $m_dep = new DepartmentcarModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_dep->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editcareerdepartment('" .$list->id_departemen. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletecareerdepartment('" .$list->id_departemen. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->id_departemen;
                                $row[] = $list->nama_departemen;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_dep->count_all(),
                            "recordsFiltered" => $m_dep->count_filtered(),
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
                $m_dep = new DepartmentcarModel($request);

                $getdata = $m_dep->getLastData();
                $kode = substr($getdata->kode, 4) + 1;
                $gen  = "TDEP" . str_pad($kode, 3, 0, STR_PAD_LEFT);

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
                    'careerdepartment_kode' => [
                        'label' => 'Kode Departemen pekerjaan',
                        'rules' => [
                            'required',
                            'is_unique[t_departemen.id_departemen]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'careerdepartment_nama' => [
                        'label' => 'Departemen pekerjaan',
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
						"careerdepartment_kode" => $this->validation->getError('careerdepartment_kode'),
						"careerdepartment_nama" => $this->validation->getError('careerdepartment_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'id_departemen' => $this->request->getVar('careerdepartment_kode'),
                    'nama_departemen' => $this->request->getVar('careerdepartment_nama'),
                ];

                $request = Services::request();
                $m_dep = new DepartmentcarModel($request);

                $m_dep->insert($data);;

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admcareerdepartment'
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
                $m_dep = new DepartmentcarModel($request);

                $item = $m_dep->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_departemen'],
                        'nama' => $item['nama_departemen'],
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
                    'careerdepartment_namaubah' => [
                        'label' => 'Ubah departemen pekerjaan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "careerdepartment_namaubah" => $this->validation->getError(careerdepartment_namaubah),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'nama_departemen' => $this->request->getVar('careerdepartment_namaubah'),
                    ];
    
                    $kode = $this->request->getVar('careerdepartment_kodeubah');

                    $request = Services::request();
                    $m_dep = new DepartmentcarModel($request);
    
                    $m_dep->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admcareerdepartment'
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
                $m_dep = new DepartmentcarModel($request);

                $m_dep->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data type dengan kode ' . $kode,
                        'link' => '/admcareerdepartment'
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