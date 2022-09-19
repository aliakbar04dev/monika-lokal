<?php 
namespace App\Controllers\Career;
use App\Controllers\BaseController;
use App\Models\Career\LocationcarModel;
use Config\Services;

class LocationcarController extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menucareer/view_careerlocation');
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
                $m_loc = new LocationcarModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_loc->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editcareerlocation('" .$list->id_lokasi_pekerjaan. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletecareerlocation('" .$list->id_lokasi_pekerjaan. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->id_lokasi_pekerjaan;
                                $row[] = $list->lokasi_pekerjaan;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_loc->count_all(),
                            "recordsFiltered" => $m_loc->count_filtered(),
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
                $m_loc = new LocationcarModel($request);

                $getdata = $m_loc->getLastData();
                $kode = substr($getdata->kode, 4) + 1;
                $gen  = "TLOP" . str_pad($kode, 3, 0, STR_PAD_LEFT);

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
                    'careerlocation_kode' => [
                        'label' => 'Kode lokasi pekerjaan',
                        'rules' => [
                            'required',
                            'is_unique[t_lokasi_pekerjaan.id_lokasi_pekerjaan]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'careerlocation_nama' => [
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
						"careerlocation_kode" => $this->validation->getError('careerlocation_kode'),
						"careerlocation_nama" => $this->validation->getError('careerlocation_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'id_lokasi_pekerjaan' => $this->request->getVar('careerlocation_kode'),
                    'lokasi_pekerjaan' => $this->request->getVar('careerlocation_nama'),
                ];

                $request = Services::request();
                $m_loc = new LocationcarModel($request);

                $m_loc->insert($data);;

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admcareerlocation'
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
                $m_loc = new LocationcarModel($request);

                $item = $m_loc->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_lokasi_pekerjaan'],
                        'nama' => $item['lokasi_pekerjaan'],
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
                    'careerlocation_namaubah' => [
                        'label' => 'Ubah lokasi pekerjaan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "careerlocation_namaubah" => $this->validation->getError(careerlocation_namaubah),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'lokasi_pekerjaan' => $this->request->getVar('careerlocation_namaubah'),
                    ];
    
                    $kode = $this->request->getVar('careerlocation_kodeubah');

                    $request = Services::request();
                    $m_loc = new LocationcarModel($request);
    
                    $m_loc->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admcareerlocation'
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
                $m_loc = new LocationcarModel($request);

                $m_loc->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data type dengan kode ' . $kode,
                        'link' => '/admcareerlocation'
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