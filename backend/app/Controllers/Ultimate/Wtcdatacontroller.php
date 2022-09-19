<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\WtcdataModel;
use Config\Services;

class Wtcdatacontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatewtcdata');
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
                $m_wtcdata = new WtcdataModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_wtcdata->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatewtcdata('" .$list->kode_wtcdata. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatewtcdata('" .$list->kode_wtcdata. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                if ($list->action == "BUY")
                                {
                                    $action = "<span style='color:#2dce89;'>BUY</span";
                                }
                                else if ($list->action == "SELL")
                                {
                                    $action = "<span style='color:#f5365c;'>SELL</span";
                                }
                                else
                                {
                                    $action = "<span style='color:#000;'>" . $list->action . "</span";
                                }

                                $row[] = $no;
                                $row[] = $list->stock;
                                $row[] = $list->market_cap;
                                $row[] = $list->buy_price;
                                $row[] = $list->target_price;
                                $row[] = $list->stop_loss;
                                $row[] = $list->risk;
                                $row[] = $list->narration;
                                $row[] = $action;
								$row[] = $isactive;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_wtcdata->count_all(),
                            "recordsFiltered" => $m_wtcdata->count_filtered(),
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
                $m_wtcdata  = new WtcdataModel($request);

                $getdata = $m_wtcdata->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KWLD" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KWLD" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                    'ultimatewtcdata_kode' => [
                        'label' => 'Kode Watchlist Action',
                        'rules' => [
                            'required',
                            'is_unique[t_wtcdata.kode_wtcdata]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    'ultimatewtcdata_stock' => [
                        'label' => 'Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_market' => [
                        'label' => 'Market',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_buyprice' => [
                        'label' => 'Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_targetprice' => [
                        'label' => 'Target Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatewtcdata_stoploss' => [
                        'label' => 'Stop Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatewtcdata_risk' => [
                        'label' => 'Risk',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_narration' => [
                        'label' => 'Narration',
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
                        "ultimatewtcdata_kode" => $this->validation->getError('ultimatewtcdata_kode'),
						"ultimatewtcdata_stock" => $this->validation->getError('ultimatewtcdata_stock'),
                        "ultimatewtcdata_market" => $this->validation->getError('ultimatewtcdata_market'),
						"ultimatewtcdata_buyprice" => $this->validation->getError('ultimatewtcdata_buyprice'),
                        "ultimatewtcdata_targetprice" => $this->validation->getError('ultimatewtcdata_targetprice'),
                        "ultimatewtcdata_stoploss" => $this->validation->getError('ultimatewtcdata_stoploss'),
                        "ultimatewtcdata_risk" => $this->validation->getError('ultimatewtcdata_risk'),
                        "ultimatewtcdata_narration" => $this->validation->getError('ultimatewtcdata_narration'),
					]
				];
			}
			else
			{              
                $data = [
                    'kode_wtcdata' => $this->request->getVar('ultimatewtcdata_kode'),
                    'stock' => $this->request->getVar('ultimatewtcdata_stock'),
                    'market_cap' => $this->request->getVar('ultimatewtcdata_market'),
                    'buy_price' => $this->request->getVar('ultimatewtcdata_buyprice'),
                    'target_price' => $this->request->getVar('ultimatewtcdata_targetprice'),
                    'stop_loss' => $this->request->getVar('ultimatewtcdata_stoploss'),
                    'risk' => $this->request->getVar('ultimatewtcdata_risk'),
                    'narration' => $this->request->getVar('ultimatewtcdata_narration'),
                    'action' => $this->request->getVar('ultimatewtcdata_action'),
                    'is_active' => $this->request->getVar('ultimatewtcdata_isactive'),
                ];

                $request = Services::request();
                $m_wtcdata = new WtcdataModel($request);

                $m_wtcdata->insert($data);

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
                $m_wtcdata = new WtcdataModel($request);

                $item = $m_wtcdata->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_wtcdata'],
                        'stock' => $item['stock'],
                        'market' => $item['market_cap'],
                        'buyprice' => $item['buy_price'],
						'targetprice' => $item['target_price'],
                        'stoploss' => $item['stop_loss'],
                        'risk' => $item['risk'],
						'narration' => $item['narration'],
                        'action' => $item['action'],
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
                    'ultimatewtcdata_stockubah' => [
                        'label' => 'Ubah Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_marketubah' => [
                        'label' => 'Ubah Market',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_buypriceubah' => [
                        'label' => 'Ubah Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_targetpriceubah' => [
                        'label' => 'Ubah Target Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatewtcdata_stoplossubah' => [
                        'label' => 'Ubah Stop Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_riskubah' => [
                        'label' => 'Ubah Risk',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcdata_narrationubah' => [
                        'label' => 'Ubah Narration',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
				
				if (!$check) {
                    $msg = [
                       'error' => [
							"ultimatewtcdata_stockubah" => $this->validation->getError('ultimatewtcdata_stockubah'),
							"ultimatewtcdata_marketubah" => $this->validation->getError('ultimatewtcdata_marketubah'),
							"ultimatewtcdata_buypriceubah" => $this->validation->getError('ultimatewtcdata_buypriceubah'),
							"ultimatewtcdata_targetpriceubah" => $this->validation->getError('ultimatewtcdata_targetpriceubah'),
                            "ultimatewtcdata_stoplossubah" => $this->validation->getError('ultimatewtcdata_stoplossubah'),
							"ultimatewtcdata_riskubah" => $this->validation->getError('ultimatewtcdata_riskubah'),
							"ultimatewtcdata_narrationubah" => $this->validation->getError('ultimatewtcdata_narrationubah'),
                       ]
                    ];
                }
                else
                {
                    $data = [
                        'stock' => $this->request->getVar('ultimatewtcdata_stockubah'),
                        'market_cap' => $this->request->getVar('ultimatewtcdata_marketubah'),
                        'buy_price' => $this->request->getVar('ultimatewtcdata_buypriceubah'),
                        'target_price' => $this->request->getVar('ultimatewtcdata_targetpriceubah'),
                        'stop_loss' => $this->request->getVar('ultimatewtcdata_stoplossubah'),
                        'risk' => $this->request->getVar('ultimatewtcdata_riskubah'),
                        'narration' => $this->request->getVar('ultimatewtcdata_narrationubah'),
                        'data' => $this->request->getVar('ultimatewtcdata_actionubah'),
                        'is_active' => $this->request->getVar('ultimatewtcdata_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('ultimatewtcdata_kodeubah');
    
                    $request = Services::request();
                    $m_wtcdata = new WtcdataModel($request);

                    $m_wtcdata->update($kode, $data);
    
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
                $m_wtcdata = new WtcdataModel($request);
    
                $m_wtcdata->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data watchlist data dengan kode ' . $kode,
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