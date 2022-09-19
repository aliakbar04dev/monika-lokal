<?php 
namespace App\Controllers\Package;
use App\Controllers\BaseController;
use App\Models\Package\DiscountModel;
//use App\Models\Account\UserlevelModel;
use Config\Services;

class Disccontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
			return view('menupackage/view_packagedisc');
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
                $m_diskon = new DiscountModel($request);

                // $m_cat = $this->infocategorymodel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_diskon->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editpackagedisc('" .$list->kode_jenis_member. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletepackagedisc('" .$list->kode_jenis_member. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->disc_val . " %";
                                $row[] = $list->description;
                                $row[] = $tomboledit;
                                //$row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_diskon->count_all(),
                            "recordsFiltered" => $m_diskon->count_filtered(),
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
                $m_diskon = new DiscountModel($request);

                $getdata = $m_diskon->findAll();
                $max  = count($getdata) + 1;
                $gen  = "JMBR" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'packagedisc_kode' => [
                        'label' => 'Kode Diskon paket',
                        'rules' => [
                            'required',
                            'is_unique[disc_member.kode_jenis_member]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
					
					'packagedisc_diskon' => [
                        'label' => 'Diskon',
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
						"packagedisc_kode" => $this->validation->getError('packagedisc_kode'),
						"packagedisc_diskon" => $this->validation->getError('packagedisc_diskon'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_jenis_member' => $this->request->getVar('packagedisc_kode'),
                    'disc_val' => $this->request->getVar('packagedisc_diskon'),
					'description' => $this->request->getVar('packagedisc_keterangan'),
                ];

                $request = Services::request();
                $m_diskon = new DiscountModel($request);

                $m_diskon->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admpackagefeature'
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
                $m_diskon = new DiscountModel($request);

                $item = $m_diskon->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_jenis_member'],
						'disc' => $item['disc_val'],
                        'description' => $item['description'],
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
                    'packagedisc_diskonubah' => [
                        'label' => 'Diskon',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
							"packagedisc_diskonubah" => $this->validation->getError('packagedisc_diskonubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'disc_val' => $this->request->getVar('packagedisc_diskonubah'),
                        'description' => $this->request->getVar('packagedisc_keteranganubah'),
                    ];
    
                    $kode = $this->request->getVar('packagedisc_kodeubah');
    
                    $request = Services::request();
                    $m_diskon = new DiscountModel($request);

                    $m_diskon->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admpackagefeature'
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
                $m_diskon = new DiscountModel($request);
    
                $m_diskon->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data diskon paket dengan kode ' . $kode,
                        'link' => '/admpackagefeature'
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