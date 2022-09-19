<?php 
namespace App\Controllers\Package;
use App\Controllers\BaseController;
use App\Models\Package\PriceModel;
use App\Models\Account\UserlevelModel;
use App\Models\Account\MemberModel;
use Config\Services;

class Pricecontroller extends BaseController
{
    public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $request = Services::request();
            $m_usrlvl = new UserlevelModel($request);
            $m_member = new MemberModel($request);

            $data = [
                'usrlevel' => $m_usrlvl->getkodeuser(),
                'mbrlevel' => $m_member->getkodemember(),
            ];

            return view('menupackage/view_packageprice', $data);
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
                $m_price = new PriceModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_price->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editpackageprice('" .$list->kode_harga_paket. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletepackageprice('" .$list->kode_harga_paket. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $harga_paket = $list->harga_paket > 0 ? "Rp. " . number_format($list->harga_paket, 0, ',', '.') : "Free";
                                $harga_koperasi = $list->harga_koperasi > 0 ? "Rp. " . number_format($list->harga_koperasi, 0, ',', '.') : "Free";
                                $harga_komunitas = $list->harga_komunitas > 0 ? "Rp. " . number_format($list->harga_komunitas, 0, ',', '.') : "Free";
                                $harga_dual = $list->harga_dual > 0 ? "Rp. " . number_format($list->harga_dual, 0, ',', '.') : "Free";
                                $harga_paket_tahunan = $list->harga_paket_tahunan > 0 ? "Rp. " . number_format($list->harga_paket_tahunan, 0, ',', '.') : "Free";
                                $harga_koperasi_tahunan = $list->harga_koperasi_tahunan > 0 ? "Rp. " . number_format($list->harga_koperasi_tahunan, 0, ',', '.') : "Free";
                                $harga_komunitas_tahunan = $list->harga_komunitas_tahunan > 0 ? "Rp. " . number_format($list->harga_komunitas_tahunan, 0, ',', '.') : "Free";
                                $harga_dual_tahunan = $list->harga_dual_tahunan > 0 ? "Rp. " . number_format($list->harga_dual_tahunan, 0, ',', '.') : "Free";
        
								if ($list->is_ready == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }
								
                                $row[] = $no;
                                $row[] = $isactive;
                                $row[] = $list->title;
								$row[] = $list->poin . ' Poin';
                                $row[] = $harga_paket;
                                $row[] = $harga_koperasi;
                                $row[] = $harga_komunitas;
                                $row[] = $harga_dual;
                                $row[] = $harga_paket_tahunan;
                                $row[] = $harga_koperasi_tahunan;
                                $row[] = $harga_komunitas_tahunan;
                                $row[] = $harga_dual_tahunan;
								$row[] = $tomboledit;
                                //$row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_price->count_all(),
                            "recordsFiltered" => $m_price->count_filtered(),
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
                $m_price = new PriceModel($request);

                $getdata = $m_price->findAll();
                $max  = count($getdata) + 1;
                $gen  = "HPKT" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'packageprice_kode' => [
                        'label' => 'Kode harga paket',
                        'rules' => [
                            'required',
                            'is_unique[harga_paket.kode_harga_paket]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'packageprice_poin' => [
                        'label' => 'Poin paket',
                        'rules' => ['required', 'is_natural'],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
							'is_natural'	=> '{field} tidak valid, angka minus tidak diizinkan'
                        ],
                    ],
					
					'packageprice_harganonmemberbulanan' => [
                        'label' => 'Harga Non Member Bulanan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargakoperasibulanan' => [
                        'label' => 'Harga Member Koperasi Bulanan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargakomunitasbulanan' => [
                        'label' => 'Harga Member Komunitas Bulanan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargamemberdualbulanan' => [
                        'label' => 'Harga Member Keduanya Bulanan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_harganonmembertahunan' => [
                        'label' => 'Harga Non Member Tahunan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargakoperasitahunan' => [
                        'label' => 'Harga Member Koperasi Tahunan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargakomunitastahunan' => [
                        'label' => 'Harga Member Komunitas Tahunan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargamemberdualtahunan' => [
                        'label' => 'Harga Member Keduanya Tahunan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'packageprice_level' => [
                        'label' => 'Level paket',
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
						"packageprice_kode" => $this->validation->getError('packageprice_kode'),
						"packageprice_harganonmemberbulanan" => $this->validation->getError('packageprice_harganonmemberbulanan'),
                        "packageprice_hargakoperasibulanan" => $this->validation->getError('packageprice_hargakoperasibulanan'),
                        "packageprice_hargakomunitasbulanan" => $this->validation->getError('packageprice_hargakomunitasbulanan'),
                        "packageprice_hargamemberdualbulanan" => $this->validation->getError('packageprice_hargamemberdualbulanan'),
                        "packageprice_harganonmembertahunan" => $this->validation->getError('packageprice_harganonmembertahunan'),
                        "packageprice_hargakoperasitahunan" => $this->validation->getError('packageprice_hargakoperasitahunan'),
                        "packageprice_hargakomunitastahunan" => $this->validation->getError('packageprice_hargakomunitastahunan'),
                        "packageprice_hargamemberdualtahunan" => $this->validation->getError('packageprice_hargamemberdualtahunan'),
						"packageprice_poin" => $this->validation->getError('packageprice_poin'),
						"packageprice_level" => $this->validation->getError('packageprice_level'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_harga_paket'  => $this->request->getVar('packageprice_kode'),
                    'kode_user_level'   => $this->request->getVar('packageprice_kodeuser'),
					'title'       		=> $this->request->getVar('packageprice_level'),
					'description'       => $this->request->getVar('packageprice_deskripsi'),
					'feature'       	=> $this->request->getVar('packageprice_fitur'),
                    'harga_paket'       => $this->request->getVar('packageprice_hargatmpnonmemberbulanan'),
                    'harga_koperasi'    => $this->request->getVar('packageprice_hargatmpkoperasibulanan'),
                    'harga_komunitas'   => $this->request->getVar('packageprice_hargatmpkomunitasbulanan'),
                    'harga_dual'        => $this->request->getVar('packageprice_hargatmpmemberdualbulanan'),
                    'harga_paket_tahunan'       => $this->request->getVar('packageprice_hargatmpnonmembertahunan'),
                    'harga_koperasi_tahunan'    => $this->request->getVar('packageprice_hargatmpkoperasitahunan'),
                    'harga_komunitas_tahunan'   => $this->request->getVar('packageprice_hargatmpkomunitastahunan'),
                    'harga_dual_tahunan'        => $this->request->getVar('packageprice_hargatmpmemberdualtahunan'),
					'poin'				=> $this->request->getVar('packageprice_poin'),
                    'bulan'             => $this->request->getVar('packageprice_durasi'),
					'is_ready'          => $this->request->getVar('packageprice_isactive'),
                ];

                $request = Services::request();
                $m_price = new PriceModel($request);

                $m_price->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admpackageprice'
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
                $m_price = new PriceModel($request);

                $item = $m_price->find($kode);
    
                $data = [
                    'success' => [
                        'kode'          => $item['kode_harga_paket'],
                        'user_level'    => $item['kode_user_level'],
						'title'			=> $item['title'],
						'deskripsi'		=> $item['description'],
                        'harga_nonmember_bulanan'  => $item['harga_paket'],
                        'harga_koperasi_bulanan'   => $item['harga_koperasi'],
                        'harga_komunitas_bulanan'  => $item['harga_komunitas'],
                        'harga_dualmember_bulanan' => $item['harga_dual'],
                        'harga_nonmember_tahunan'  => $item['harga_paket_tahunan'],
                        'harga_koperasi_tahunan'   => $item['harga_koperasi_tahunan'],
                        'harga_komunitas_tahunan'  => $item['harga_komunitas_tahunan'],
                        'harga_dualmember_tahunan' => $item['harga_dual_tahunan'],
						'poin'         	=> $item['poin'],
                        'bulan'         => $item['bulan'],
						'is_ready'		=> $item['is_ready'],
						'fitur'			=> $item['feature']
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
					'packageprice_poinubah' => [
                        'label' => 'Poin paket',
                        'rules' => ['required', 'is_natural'],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
							'is_natural'	=> '{field} tidak valid, angka minus tidak diizinkan'
                        ],
                    ],

                    'packageprice_harganonmemberbulananubah' => [
                        'label' => 'Harga Non Member Bulanan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargakoperasibulananubah' => [
                        'label' => 'Harga Member Koperasi Bulanan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargakomunitasbulananubah' => [
                        'label' => 'Harga Member Komunitas Bulanan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargamemberdualbulananubah' => [
                        'label' => 'Harga Member Keduanya Bulanan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_harganonmembertahunanubah' => [
                        'label' => 'Harga Non Member Tahunan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargakoperasitahunanubah' => [
                        'label' => 'Harga Member Koperasi Tahunan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargakomunitastahunanubah' => [
                        'label' => 'Harga Member Komunitas Tahunan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'packageprice_hargamemberdualtahunanubah' => [
                        'label' => 'Harga Member Keduanya Tahunan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'packageprice_levelubah' => [
                        'label' => 'Level Paket',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
							"packageprice_poinubah" => $this->validation->getError('packageprice_poinubah'),
                            "packageprice_harganonmemberbulananubah" => $this->validation->getError('packageprice_harganonmemberbulananubah'),
                            "packageprice_hargakoperasibulananubah" => $this->validation->getError('packageprice_hargakoperasibulananubah'),
                            "packageprice_hargakomunitasbulananubah" => $this->validation->getError('packageprice_hargakomunitasbulananubah'),
                            "packageprice_hargamemberdualbulananubah" => $this->validation->getError('packageprice_hargamemberdualbulananubah'),
                            "packageprice_harganonmembertahunanubah" => $this->validation->getError('packageprice_harganonmembertahunanubah'),
                            "packageprice_hargakoperasitahunanubah" => $this->validation->getError('packageprice_hargakoperasitahunanubah'),
                            "packageprice_hargakomunitastahunanubah" => $this->validation->getError('packageprice_hargakomunitastahunanubah'),
                            "packageprice_hargamemberdualtahunanubah" => $this->validation->getError('packageprice_hargamemberdualtahunanubah'),
							"packageprice_levelubah" => $this->validation->getError('packageprice_levelubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'kode_user_level'   => $this->request->getVar('packageprice_kodeuserubah'),
						'title'       		=> $this->request->getVar('packageprice_levelubah'),
						'description'       => $this->request->getVar('packageprice_deskripsiubah'),
						//'feature'       	=> $this->request->getVar('packageprice_fiturubah'),
						'feature'       	=> $this->request->getVar('packageprice_plaintextubah'),
                        'harga_paket'       => $this->request->getVar('packageprice_hargatmpnonmemberbulananubah'),
                        'harga_koperasi'    => $this->request->getVar('packageprice_hargatmpkoperasibulananubah'),
                        'harga_komunitas'   => $this->request->getVar('packageprice_hargatmpkomunitasbulananubah'),
                        'harga_dual'        => $this->request->getVar('packageprice_hargatmpmemberdualbulananubah'),
                        'harga_paket_tahunan'       => $this->request->getVar('packageprice_hargatmpnonmembertahunanubah'),
                        'harga_koperasi_tahunan'    => $this->request->getVar('packageprice_hargatmpkoperasitahunanubah'),
                        'harga_komunitas_tahunan'   => $this->request->getVar('packageprice_hargatmpkomunitastahunanubah'),
                        'harga_dual_tahunan'        => $this->request->getVar('packageprice_hargatmpmemberdualtahunanubah'),
						'poin'       		=> $this->request->getVar('packageprice_poinubah'),
                        'bulan'             => $this->request->getVar('packageprice_durasiubah'),
						'is_ready'          => $this->request->getVar('packageprice_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('packageprice_kodeubah');
    
                    $request = Services::request();
                    $m_price = new PriceModel($request);

                    $m_price->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admpackageprice'
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
                $m_price = new PriceModel($request);
    
                $m_price->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data harga paket dengan kode ' . $kode,
                        'link' => '/admpackageprice'
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