<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\CloseposModel;
use Config\Services;

class Closeposcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimateclosepos');
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
                $m_closepos = new CloseposModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_closepos->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimateclosepos('" .$list->kode_closepos. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimateclosepos('" .$list->kode_closepos. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                $row[] = $tombolhapus . ' ' . $tomboledit;
                                $row[] = $list->stock;
                                $row[] = $list->buy_price;
                                $row[] = $list->sell_price;
                                $row[] = date('d/m/Y', strtotime($list->buy_date));
                                $row[] = date('d/m/Y', strtotime($list->sell_date));
                                $row[] = $list->profit;
                                $row[] = $list->days_hold;
								$row[] = $isactive;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_closepos->count_all(),
                            "recordsFiltered" => $m_closepos->count_filtered(),
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
                $m_closepos  = new CloseposModel($request);

                $getdata = $m_closepos->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KUCP" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KUCP" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                    'ultimateclosepos_kode' => [
                        'label' => 'Kode Open Position',
                        'rules' => [
                            'required',
                            'is_unique[t_closepos.kode_closepos]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    'ultimateclosepos_stock' => [
                        'label' => 'Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateclosepos_buyprice' => [
                        'label' => 'Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateclosepos_sellprice' => [
                        'label' => 'Sell Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateclosepos_buydate' => [
                        'label' => 'Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimateclosepos_selldate' => [
                        'label' => 'Sell Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimateclosepos_profit' => [
                        'label' => 'Profit',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateclosepos_dayshold' => [
                        'label' => 'Days Hold',
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
                        "ultimateclosepos_kode" => $this->validation->getError('ultimateclosepos_kode'),
						"ultimateclosepos_stock" => $this->validation->getError('ultimateclosepos_stock'),
                        "ultimateclosepos_buyprice" => $this->validation->getError('ultimateclosepos_buyprice'),
						"ultimateclosepos_sellprice" => $this->validation->getError('ultimateclosepos_sellprice'),
                        "ultimateclosepos_buydate" => $this->validation->getError('ultimateclosepos_buydate'),
                        "ultimateclosepos_selldate" => $this->validation->getError('ultimateclosepos_selldate'),
                        "ultimateclosepos_profit" => $this->validation->getError('ultimateclosepos_profit'),
                        "ultimateclosepos_dayshold" => $this->validation->getError('ultimateclosepos_dayshold'),
					]
				];
			}
			else
			{              
                $data = [
                    'kode_closepos' => $this->request->getVar('ultimateclosepos_kode'),
                    'stock' => $this->request->getVar('ultimateclosepos_stock'),
                    'buy_price' => $this->request->getVar('ultimateclosepos_buyprice'),
                    'sell_price' => $this->request->getVar('ultimateclosepos_sellprice'),
                    'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimateclosepos_buydate'))),
                    'sell_date' => date("Y-m-d", strtotime($this->request->getVar('ultimateclosepos_selldate'))),
                    'profit' => $this->request->getVar('ultimateclosepos_profit'),
                    'days_hold' => $this->request->getVar('ultimateclosepos_dayshold'),
                    'is_active' => 1,
                ];

                $request = Services::request();
                $m_closepos = new CloseposModel($request);

                $m_closepos->insert($data);

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
                $m_closepos = new CloseposModel($request);

                $item = $m_closepos->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_closepos'],
                        'stock' => $item['stock'],
                        'buyprice' => $item['buy_price'],
						'sellprice' => $item['sell_price'],
                        'buydate' => $item['buy_date'],
                        'selldate' => $item['sell_date'],
						'profit' => $item['profit'],
                        'dayshold' => $item['days_hold'],
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
                    'ultimateclosepos_stockubah' => [
                        'label' => 'Ubah Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateclosepos_buypriceubah' => [
                        'label' => 'Ubah Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateclosepos_sellpriceubah' => [
                        'label' => 'Ubah Sell Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimateclosepos_buydateubah' => [
                        'label' => 'Ubah Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateclosepos_selldateubah' => [
                        'label' => 'Ubah Sell Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateclosepos_profitubah' => [
                        'label' => 'Ubah Profit',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimateclosepos_daysholdubah' => [
                        'label' => 'Ubah Days Hold',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
				
				if (!$check) {
                    $msg = [
                       'error' => [
							"ultimateclosepos_stockubah" => $this->validation->getError('ultimateclosepos_stockubah'),
							"ultimateclosepos_buypriceubah" => $this->validation->getError('ultimateclosepos_buypriceubah'),
							"ultimatewtcdata_buypriceubah" => $this->validation->getError('ultimatewtcdata_buypriceubah'),
							"ultimateclosepos_sellpriceubah" => $this->validation->getError('ultimateclosepos_sellpriceubah'),
                            "ultimateclosepos_buydateubah" => $this->validation->getError('ultimateclosepos_buydateubah'),
							"ultimateclosepos_selldateubah" => $this->validation->getError('ultimateclosepos_selldateubah'),
							"ultimateclosepos_profitubah" => $this->validation->getError('ultimateclosepos_profitubah'),
                            "ultimateclosepos_daysholdubah" => $this->validation->getError('ultimateclosepos_daysholdubah'),
                       ]
                    ];
                }
                else
                {
                    $data = [
                        'stock' => $this->request->getVar('ultimateclosepos_stockubah'),
                        'buy_price' => $this->request->getVar('ultimateclosepos_buypriceubah'),
                        'sell_price' => $this->request->getVar('ultimateclosepos_sellpriceubah'),
                        'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimateclosepos_buydateubah'))),
                        'sell_date' => date("Y-m-d", strtotime($this->request->getVar('ultimateclosepos_selldateubah'))),
                        'profit' => $this->request->getVar('ultimateclosepos_profitubah'),
                        'days_hold' => $this->request->getVar('ultimateclosepos_daysholdubah'),
                        'is_active' => 1,
                    ];
    
                    $kode = $this->request->getVar('ultimateclosepos_kodeubah');
    
                    $request = Services::request();
                    $m_closepos = new CloseposModel($request);

                    $m_closepos->update($kode, $data);
    
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
                $m_closepos = new CloseposModel($request);
    
                $m_closepos->delete($kode);
    
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