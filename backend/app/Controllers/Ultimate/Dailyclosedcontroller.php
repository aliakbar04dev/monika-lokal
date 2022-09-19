<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\DailyclosedModel;
use Config\Services;

class Dailyclosedcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatedailyclosed');
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
                $m_dailyclosed = new DailyclosedModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_dailyclosed->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatedailyclosed('" .$list->kode_dailyclosed. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatedailyclosed('" .$list->kode_dailyclosed. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                
                                if ($list->hit_miss == 'hit')
                                {
                                    $hit_miss = "<span style='color:#2dce89;'>Hit</span";
                                }
                                else
                                {
                                    $hit_miss = "<span style='color:#f5365c;'>Miss</span";
                                }



                                // $row[] = $no;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $row[] = $list->stock;
                                $row[] = $list->buy_price;
                                $row[] = $list->sell_price;
                                $row[] = date('d/m/Y', strtotime($list->buy_date));
                                $row[] = date('d/m/Y', strtotime($list->sell_date));
                                $row[] = $list->gain_loss;
                                $row[] = $list->target;
                                $row[] = $hit_miss;
                                $row[] = $list->highest;
								$row[] = $isactive;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_dailyclosed->count_all(),
                            "recordsFiltered" => $m_dailyclosed->count_filtered(),
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
                $m_dailyclosed  = new DailyclosedModel($request);

                $getdata = $m_dailyclosed->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KUCP" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KDCC" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                    'ultimatedailyclosed_kode' => [
                        'label' => 'Kode Open Position',
                        'rules' => [
                            'required',
                            'is_unique[t_Dailyclosed.kode_dailyclosed]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    'ultimatedailyclosed_stock' => [
                        'label' => 'Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedailyclosed_buyprice' => [
                        'label' => 'Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedailyclosed_sellprice' => [
                        'label' => 'Sell Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedailyclosed_buydate' => [
                        'label' => 'Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedailyclosed_selldate' => [
                        'label' => 'Sell Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedailyclosed_gainloss' => [
                        'label' => 'Gain/Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedailyclosed_target' => [
                        'label' => 'Target',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedailyclosed_hitmiss' => [
                        'label' => 'Hit/Miss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedailyclosed_highest' => [
                        'label' => 'Highest',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
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
                        "ultimatedailyclosed_kode" => $this->validation->getError('ultimatedailyclosed_kode'),
						"ultimatedailyclosed_stock" => $this->validation->getError('ultimatedailyclosed_stock'),
                        "ultimatedailyclosed_buyprice" => $this->validation->getError('ultimatedailyclosed_buyprice'),
						"ultimatedailyclosed_sellprice" => $this->validation->getError('ultimatedailyclosed_sellprice'),
                        "ultimatedailyclosed_buydate" => $this->validation->getError('ultimatedailyclosed_buydate'),
                        "ultimatedailyclosed_selldate" => $this->validation->getError('ultimatedailyclosed_selldate'),
                        "ultimatedailyclosed_gainloss" => $this->validation->getError('ultimatedailyclosed_gainloss'),
                        "ultimatedailyclosed_target" => $this->validation->getError('ultimatedailyclosed_target'),
                        "ultimatedailyclosed_hitmiss" => $this->validation->getError('ultimatedailyclosed_hitmiss'),
                        "ultimatedailyclosed_highest" => $this->validation->getError('ultimatedailyclosed_highest'),
					]
				];
			}
			else
			{              
                $data = [
                    'kode_dailyclosed' => $this->request->getVar('ultimatedailyclosed_kode'),
                    'stock' => $this->request->getVar('ultimatedailyclosed_stock'),
                    'buy_price' => $this->request->getVar('ultimatedailyclosed_buyprice'),
                    'sell_price' => $this->request->getVar('ultimatedailyclosed_sellprice'),
                    'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimatedailyclosed_buydate'))),
                    'sell_date' => date("Y-m-d", strtotime($this->request->getVar('ultimatedailyclosed_selldate'))),
                    'gain_loss' => $this->request->getVar('ultimatedailyclosed_gainloss'),
                    'target' => $this->request->getVar('ultimatedailyclosed_target'),
                    'hit_miss' => $this->request->getVar('ultimatedailyclosed_hitmiss'),
                    'highest' => $this->request->getVar('ultimatedailyclosed_highest'),
                    'is_active' => $this->request->getVar('ultimatedailyclosed_isactive'),
                ];


                $request = Services::request();
                $m_dailyclosed = new DailyclosedModel($request);

                $m_dailyclosed->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admsettingbenefit'
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
                $m_dailyclosed = new DailyclosedModel($request);

                $item = $m_dailyclosed->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_dailyclosed'],
                        'stock' => $item['stock'],
                        'buyprice' => $item['buy_price'],
						'sellprice' => $item['sell_price'],
                        'buydate' => $item['buy_date'],
                        'selldate' => $item['sell_date'],
						'gainloss' => $item['gain_loss'],
                        'target' => $item['target'],
                        'hitmiss' => $item['hit_miss'],
                        'highest' => $item['highest'],
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
                    'ultimatedailyclosed_stockubah' => [
                        'label' => 'Ubah Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedailyclosed_buypriceubah' => [
                        'label' => 'Ubah Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedailyclosed_sellpriceubah' => [
                        'label' => 'Ubah Sell Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedailyclosed_buydateubah' => [
                        'label' => 'Ubah Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedailyclosed_selldateubah' => [
                        'label' => 'Ubah Sell Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedailyclosed_gainlossubah' => [
                        'label' => 'Ubah gainloss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedailyclosed_targetubah' => [
                        'label' => 'Ubah Days Hold',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedailyclosed_hitmissubah' => [
                        'label' => 'Hit/Miss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedailyclosed_highestubah' => [
                        'label' => 'Highest',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
				
				if (!$check) {
                    $msg = [
                       'error' => [
							"ultimatedailyclosed_stockubah" => $this->validation->getError('ultimatedailyclosed_stockubah'),
							"ultimatedailyclosed_buypriceubah" => $this->validation->getError('ultimatedailyclosed_buypriceubah'),
							"ultimatewtcdata_buypriceubah" => $this->validation->getError('ultimatewtcdata_buypriceubah'),
							"ultimatedailyclosed_sellpriceubah" => $this->validation->getError('ultimatedailyclosed_sellpriceubah'),
                            "ultimatedailyclosed_buydateubah" => $this->validation->getError('ultimatedailyclosed_buydateubah'),
							"ultimatedailyclosed_selldateubah" => $this->validation->getError('ultimatedailyclosed_selldateubah'),
							"ultimatedailyclosed_gainlossubah" => $this->validation->getError('ultimatedailyclosed_gainlossubah'),
                            "ultimatedailyclosed_targetubah" => $this->validation->getError('ultimatedailyclosed_targetubah'),
                            "ultimatedailyclosed_hitmissubah" => $this->validation->getError('ultimatedailyclosed_hitmissubah'),
                            "ultimatedailyclosed_highestubah" => $this->validation->getError('ultimatedailyclosed_highestubah'),
                       ]
                    ];
                }
                else
                {
                    $data = [
                        'stock' => $this->request->getVar('ultimatedailyclosed_stockubah'),
                        'buy_price' => $this->request->getVar('ultimatedailyclosed_buypriceubah'),
                        'sell_price' => $this->request->getVar('ultimatedailyclosed_sellpriceubah'),
                        'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimatedailyclosed_buydateubah'))),
                        'sell_date' => date("Y-m-d", strtotime($this->request->getVar('ultimatedailyclosed_selldateubah'))),
                        'gain_loss' => $this->request->getVar('ultimatedailyclosed_gainlossubah'),
                        'days_hold' => $this->request->getVar('ultimatedailyclosed_targetubah'),
                        'hit_miss' => $this->request->getVar('ultimatedailyclosed_hitmissubah'),
                        'highest' => $this->request->getVar('ultimatedailyclosed_highestubah'),
                        'is_active' => $this->request->getVar('ultimatedailyclosed_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('ultimatedailyclosed_kodeubah');
    
                    $request = Services::request();
                    $m_dailyclosed = new DailyclosedModel($request);

                    $m_dailyclosed->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admsettingbenefit'
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
                $m_dailyclosed = new DailyclosedModel($request);
    
                $m_dailyclosed->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data close position dengan kode ' . $kode,
                        'link' => '/admsettingbenefit'
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