<?php 
namespace App\Controllers\Career;
use App\Controllers\BaseController;
use App\Models\Career\VacancyModel;
use App\Models\Career\DepartmentcarModel;
use App\Models\Career\CategorycarModel;
use App\Models\Career\LocationcarModel;
use Config\Services;

class VacancyController extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
			$request = Services::request();
            $m_dep = new DepartmentcarModel($request);
            $m_cat = new CategorycarModel($request);
			$m_loc = new LocationcarModel($request);

            $data = [
                'departemen' => $m_dep->getkodetype(),
				'kategori'   => $m_cat->getkodetype(),
                'lokasi'     => $m_loc->getkodetype(),
            ];
			
            return view('menucareer/view_careervacancy', $data);
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
                $m_vac = new VacancyModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_vac->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editcareervacancy('" .$list->id_karir. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletecareervacancy('" .$list->id_karir. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";
												
								if ($list->publish == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Iya</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak</span";
                                }

                                $row[] = $no;
                                $row[] = $list->id_karir;
                                $row[] = $list->karir;
								$row[] = $list->lokasi_pekerjaan;
								$row[] = $list->nama_departemen;
								$row[] = $list->kategori_pekerjaan;
								/*$row[] = $list->deskripsi_karir;
								$row[] = $list->benefit_karir;*/
								$row[] = $isactive;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_vac->count_all(),
                            "recordsFiltered" => $m_vac->count_filtered(),
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
                $m_vac = new VacancyModel($request);

                $getdata = $m_vac->getLastData();
                $kode = substr($getdata->kode, 4) + 1;
                $gen  = "TKAR" . str_pad($kode, 3, 0, STR_PAD_LEFT);

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
                    'careervacancy_kode' => [
                        'label' => 'Kode karir',
                        'rules' => [
                            'required',
                            'is_unique[t_karir.id_karir]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'careervacancy_posisi' => [
                        'label' => 'Posisi',
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
						"careervacancy_kode" => $this->validation->getError('careervacancy_kode'),
						"careervacancy_posisi" => $this->validation->getError('careervacancy_posisi'),
					]
				];
			}
			else
			{
                $data = [
                    'id_karir' => $this->request->getVar('careervacancy_kode'),
                    'karir' => $this->request->getVar('careervacancy_posisi'),
					'id_lokasi_pekerjaan' => $this->request->getVar('careervacancy_lokasi'),
					'id_departemen' => $this->request->getVar('careervacancy_departemen'),
					'id_kategori_pekerjaan' => $this->request->getVar('careervacancy_kategori'),
					'deskripsi_karir' => $this->request->getVar('careervacancy_deskripsi'),
					'requirement' => $this->request->getVar('careervacancy_requirement'),
					'benefit_karir' => $this->request->getVar('careervacancy_benefit'),
					'publish' => $this->request->getVar('careervacancy_isactive'),
                ];

                $request = Services::request();
                $m_vac = new VacancyModel($request);

                $m_vac->insert($data);;

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
                $m_vac = new VacancyModel($request);

                $item = $m_vac->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_karir'],
                        'nama' => $item['karir'],
						'lokasi' => $item['id_lokasi_pekerjaan'],
						'departemen' => $item['id_departemen'],
						'kategori' => $item['id_kategori_pekerjaan'],
						'deskripsi' => $item['deskripsi_karir'],
						'requirement' => $item['requirement'],
						'benefit' => $item['benefit_karir'],
						'publish' => $item['publish'],
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
                    'careervacancy_posisiubah' => [
                        'label' => 'Ubah posisi',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "careervacancy_posisiubah" => $this->validation->getError('careervacancy_posisiubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'karir' => $this->request->getVar('careervacancy_posisiubah'),
						'id_lokasi_pekerjaan' => $this->request->getVar('careervacancy_lokasiubah'),
						'id_departemen' => $this->request->getVar('careervacancy_departemenubah'),
						'id_kategori_pekerjaan' => $this->request->getVar('careervacancy_kategoriubah'),
						'deskripsi_karir' => $this->request->getVar('careervacancy_deskripsiubah'),
						'requirement' => $this->request->getVar('careervacancy_requirementubah'),
						'benefit_karir' => $this->request->getVar('careervacancy_benefitubah'),
						'publish' => $this->request->getVar('careervacancy_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('careervacancy_kodeubah');

                    $request = Services::request();
                    $m_vac = new VacancyModel($request);
    
                    $m_vac->update($kode, $data);
    
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
                $m_vac = new VacancyModel($request);

                $m_vac->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data type dengan kode ' . $kode,
                        'link' => '/admcareervacancy'
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