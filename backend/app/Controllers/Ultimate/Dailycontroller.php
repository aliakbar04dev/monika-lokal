<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\DailyModel;
use Config\Services;

class Dailycontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatedaily');
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
                $m_daily = new DailyModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_daily->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatedaily('" .$list->kode_daily. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatedaily('" .$list->kode_daily. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                // $row[] = $no;
                                $row[] = '<div style="text-align: center;">'.$tomboledit . ' ' . $tombolhapus.'</div>';
                                $row[] = $list->stock;
                                $row[] = date('d/m/Y', strtotime($list->buy_date));
								$row[] = number_format($list->buy_price, 0, ',', '.');
                                $row[] = number_format($list->closed, 0, ',', '.');
                                $row[] = $list->gain_loss;
                                $row[] = $list->area_beli;
                                $row[] = $list->area_jual;
                                $row[] = $list->stop_loss;
                                $row[] = $list->jarak_sl;
                                // $row[] = $list->type;
								$row[] = $isactive;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_daily->count_all(),
                            "recordsFiltered" => $m_daily->count_filtered(),
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
                $m_daily  = new DailyModel($request);

                $getdata = $m_daily->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KDSR" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KDSR" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                    'ultimatedaily_kode' => [
                        'label' => 'Kode daily',
                        'rules' => [
                            'required',
                            'is_unique[t_daily.kode_daily]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    'ultimatedaily_stock' => [
                        'label' => 'Stock',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_buydate' => [
                        'label' => 'Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_buyprice' => [
                        'label' => 'Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_closed' => [
                        'label' => 'Closed',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_gainloss' => [
                        'label' => 'Gain/Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_areabeli' => [
                        'label' => 'Resistance 1',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_areajual' => [
                        'label' => 'Resistance 2',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_stoploss' => [
                        'label' => 'Stop Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_jaraksl' => [
                        'label' => 'Jarak SL',
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
                        "ultimatedaily_kode" => $this->validation->getError('ultimatedaily_kode'),
						"ultimatedaily_stock" => $this->validation->getError('ultimatedaily_stock'),
                        "ultimatedaily_buydate" => $this->validation->getError('ultimatedaily_buydate'),
						"ultimatedaily_buyprice" => $this->validation->getError('ultimatedaily_buyprice'),
                        "ultimatedaily_closed" => $this->validation->getError('ultimatedaily_closed'),
                        "ultimatedaily_gainloss" => $this->validation->getError('ultimatedaily_gainloss'),
                        "ultimatedaily_areabeli" => $this->validation->getError('ultimatedaily_areabeli'),
						"ultimatedaily_areajual" => $this->validation->getError('ultimatedaily_areajual'),
                        "ultimatedaily_stoploss" => $this->validation->getError('ultimatedaily_stoploss'),
                        "ultimatedaily_jaraksl" => $this->validation->getError('ultimatedaily_jaraksl'),
					]
				];
			}
			else
			{              
                $data = [
                    'kode_daily' => $this->request->getVar('ultimatedaily_kode'),
                    'stock' => $this->request->getVar('ultimatedaily_stock'),
                    'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimatedaily_buydate'))),
                    'buy_price' => $this->request->getVar('ultimatedaily_buyprice'),
                    'closed' => $this->request->getVar('ultimatedaily_closed'),
                    'gain_loss' => $this->request->getVar('ultimatedaily_gainloss'),
                    'area_beli' => $this->request->getVar('ultimatedaily_areabeli'),
                    'area_jual' => $this->request->getVar('ultimatedaily_areajual'),
                    'stop_loss' => $this->request->getVar('ultimatedaily_stoploss'),
                    'jarak_sl' => $this->request->getVar('ultimatedaily_jaraksl'),
                    'is_active' => 1,
                ];

                $request = Services::request();
                $m_daily = new DailyModel($request);

                $m_daily->insert($data);

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
                $m_daily = new DailyModel($request);

                $item = $m_daily->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_daily'],
                        'stock' => $item['stock'],
                        'buydate' => $item['buy_date'],
                        'buyprice' => $item['buy_price'],
                        'closed' => $item['closed'],
                        'gainloss' => $item['gain_loss'],
                        'areabeli' => $item['area_beli'],
                        'areajual' => $item['area_jual'],
						'stoploss' => $item['stop_loss'],
                        'jaraksl' => $item['jarak_sl'],
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
                    'ultimatedaily_stockubah' => [
                        'label' => 'Ubah Stock',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_buydateubah' => [
                        'label' => 'Ubah Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_buypriceubah' => [
                        'label' => 'Ubah Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_closedubah' => [
                        'label' => 'Ubah Closed',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_gainlossubah' => [
                        'label' => 'Ubah Gain/Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_areabeliubah' => [
                        'label' => 'Ubah Area Beli',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_areajualubah' => [
                        'label' => 'Ubah Area Jual',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatedaily_stoplossubah' => [
                        'label' => 'Ubah Stop Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatedaily_jarakslubah' => [
                        'label' => 'Ubah Jarak SL',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
				
				if (!$check) {
                    $msg = [
                       'error' => [
							"ultimatedaily_stockubah" => $this->validation->getError('ultimatedaily_stockubah'),
                            "ultimatedaily_buydateubah" => $this->validation->getError('ultimatedaily_buydateubah'),
							"ultimatedaily_buypriceubah" => $this->validation->getError('ultimatedaily_buypriceubah'),
                            "ultimatedaily_closedubah" => $this->validation->getError('ultimatedaily_closedubah'),
                            "ultimatedaily_gainlossubah" => $this->validation->getError('ultimatedaily_gainlossubah'),
							"ultimatedaily_areabeliubah" => $this->validation->getError('ultimatedaily_areabeliubah'),
							"ultimatedaily_areajualubah" => $this->validation->getError('ultimatedaily_areajualubah'),
							"ultimatedaily_stoplossubah" => $this->validation->getError('ultimatedaily_stoplossubah'),
                            "ultimatedaily_jarakslubah" => $this->validation->getError('ultimatedaily_jarakslubah'),
                       ]
                    ];
                }
                else
                {
                    $a = date("Y-m-d", strtotime($this->request->getVar('ultimatedaily_buydateubah')));

                    // echo json_encode($a); die;

                    $data = [
                        'stock' => $this->request->getVar('ultimatedaily_stockubah'),
                        'buy_date' => $a,
                        'buy_price' => $this->request->getVar('ultimatedaily_buypriceubah'),
                        'closed' => $this->request->getVar('ultimatedaily_closedubah'),
                        'gain_loss' => $this->request->getVar('ultimatedaily_gainlossubah'),
						'area_beli' => $this->request->getVar('ultimatedaily_areabeliubah'),
						'area_jual' => $this->request->getVar('ultimatedaily_areajualubah'),
						'stop_loss' => $this->request->getVar('ultimatedaily_stoplossubah'),
                        'jarak_sl' => $this->request->getVar('ultimatedaily_jarakslubah'),
						'is_active' => $this->request->getVar('ultimatedaily_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('ultimatedaily_kodeubah');
    
                    $request = Services::request();
                    $m_daily = new DailyModel($request);

                    $m_daily->update($kode, $data);
    
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
                $m_daily = new DailyModel($request);
    
                $m_daily->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data daily dengan kode ' . $kode,
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

    public function pilihdatatgl() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $id = $this->request->getVar('id');

                $this->db = db_connect();
                $item = $this->db->query("SELECT * FROM tgl_dailystock WHERE id='$id'")->getRowArray();
    
                $data = [
                    'success' => [
                        'id' => $item['id'],
                        'tgl' => $item['tgl'],
                        'is_active' => $item['is_active'],
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

    public function perbaruidatatgl() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'ultimatedaily_edittgl' => [
                        'label' => 'Ubah Tgl Daily Stock',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
				
				if (!$check) {
                    $msg = [
                       'error' => [
							"ultimatedaily_edittgl" => $this->validation->getError('ultimatedaily_edittgl'),
                       ]
                    ];
                }
                else
                {
                    $tgl = $this->request->getVar('ultimatedaily_edittgl');
                    $id = $this->request->getVar('ultimatedaily_idtgl');

                    $this->db = db_connect();
                    $this->db->query("UPDATE `tgl_dailystock` SET `tgl` = '$tgl' WHERE `tgl_dailystock`.`id` = '$id'");
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data tanggal',
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
}