<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\TrailingModel;
use Config\Services;

class Trailingcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatetrail');
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
                $m_trail = new TrailingModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_trail->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatetrail('" .$list->kode_trailing. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatetrail('" .$list->kode_trailing. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                $row[] = $no;
                                $row[] = $list->stock;
                                $row[] = date('d/m/Y', strtotime($list->buy_date));
								$row[] = number_format($list->buy_price, 0, ',', '.');
								$row[] = number_format($list->close_price, 0, ',', '.');
								$row[] = $list->gain_loss;
								$row[] = number_format($list->trailing_stop, 0, ',', '.');
								$row[] = $list->jarak_ts;
								$row[] = $list->is_syariah;
								$row[] = $isactive;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_trail->count_all(),
                            "recordsFiltered" => $m_trail->count_filtered(),
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
                $m_trail  = new TrailingModel($request);

                $getdata = $m_trail->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KTSM" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KTSM" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                    'ultimatetrail_kode' => [
                        'label' => 'Kode trailing',
                        'rules' => [
                            'required',
                            'is_unique[t_trailing.kode_trailing]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    'ultimatetrail_stock' => [
                        'label' => 'Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_buydate' => [
                        'label' => 'Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_buyprice' => [
                        'label' => 'Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_closeprice' => [
                        'label' => 'Close Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_gainloss' => [
                        'label' => 'Gain Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_trailingstop' => [
                        'label' => 'Trailing Stop',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_jarakts' => [
                        'label' => 'Jarak TS',
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
                        "ultimatetrail_kode" => $this->validation->getError('ultimatetrail_kode'),
						"ultimatetrail_stock" => $this->validation->getError('ultimatetrail_stock'),
                        "ultimatetrail_buydate" => $this->validation->getError('ultimatetrail_buydate'),
						"ultimatetrail_buyprice" => $this->validation->getError('ultimatetrail_buyprice'),
                        "ultimatetrail_closeprice" => $this->validation->getError('ultimatetrail_closeprice'),
						"ultimatetrail_gainloss" => $this->validation->getError('ultimatetrail_gainloss'),
                        "ultimatetrail_trailingstop" => $this->validation->getError('ultimatetrail_trailingstop'),
						"ultimatetrail_jarakts" => $this->validation->getError('ultimatetrail_jarakts'),
					]
				];
			}
			else
			{              
                $data = [
                    'kode_trailing' => $this->request->getVar('ultimatetrail_kode'),
                    'stock' => $this->request->getVar('ultimatetrail_stock'),
                    'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimatetrail_buydate'))),
                    'buy_price' => $this->request->getVar('ultimatetrail_buyprice'),
                    'close_price' => $this->request->getVar('ultimatetrail_closeprice'),
                    'gain_loss' => $this->request->getVar('ultimatetrail_gainloss'),
                    'trailing_stop' => $this->request->getVar('ultimatetrail_trailingstop'),
					'jarak_ts' => $this->request->getVar('ultimatetrail_jarakts'),
                    'is_syariah' => $this->request->getVar('ultimatetrail_syariah'),
                    'is_active' => $this->request->getVar('ultimatetrail_isactive'),
                ];

                $request = Services::request();
                $m_trail = new TrailingModel($request);

                $m_trail->insert($data);

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
                $m_trail = new TrailingModel($request);

                $item = $m_trail->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_trailing'],
                        'stock' => $item['stock'],
                        'buydate' => $item['buy_date'],
                        'buyprice' => $item['buy_price'],
						'closeprice' => $item['close_price'],
                        'gainloss' => $item['gain_loss'],
                        'ts' => $item['trailing_stop'],
                        'jarakts' => $item['jarak_ts'],
						'syariah' => $item['is_syariah'],
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
                    'ultimatetrail_stockubah' => [
                        'label' => 'Ubah Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_buydateubah' => [
                        'label' => 'Ubah Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_buypriceubah' => [
                        'label' => 'Ubah Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_closepriceubah' => [
                        'label' => 'Ubah Close Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_gainlossubah' => [
                        'label' => 'Ubah Gain Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_trailingstopubah' => [
                        'label' => 'Ubah Trailing Stop',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatetrail_jaraktsubah' => [
                        'label' => 'Ubah Jarak TS',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
				
				if (!$check) {
                    $msg = [
                       'error' => [
							"ultimatetrail_stockubah" => $this->validation->getError('ultimatetrail_stockubah'),
							"ultimatetrail_buydateubah" => $this->validation->getError('ultimatetrail_buydateubah'),
							"ultimatetrail_buypriceubah" => $this->validation->getError('ultimatetrail_buypriceubah'),
							"ultimatetrail_closepriceubah" => $this->validation->getError('ultimatetrail_closepriceubah'),
							"ultimatetrail_gainlossubah" => $this->validation->getError('ultimatetrail_gainlossubah'),
							"ultimatetrail_trailingstopubah" => $this->validation->getError('ultimatetrail_trailingstopubah'),
							"ultimatetrail_jaraktsubah" => $this->validation->getError('ultimatetrail_jaraktsubah'),
                       ]
                    ];
                }
                else
                {
                    $data = [
                        'stock' => $this->request->getVar('ultimatetrail_stockubah'),
						'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimatetrail_buydateubah'))),
						'buy_price' => $this->request->getVar('ultimatetrail_buypriceubah'),
						'close_price' => $this->request->getVar('ultimatetrail_closepriceubah'),
						'gain_loss' => $this->request->getVar('ultimatetrail_gainlossubah'),
						'trailing_stop' => $this->request->getVar('ultimatetrail_trailingstopubah'),
						'jarak_ts' => $this->request->getVar('ultimatetrail_jaraktsubah'),
						'is_syariah' => $this->request->getVar('ultimatetrail_syariahubah'),
						'is_active' => $this->request->getVar('ultimatetrail_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('ultimatetrail_kodeubah');
    
                    $request = Services::request();
                    $m_trail = new TrailingModel($request);

                    $m_trail->update($kode, $data);
    
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
                $m_trail = new TrailingModel($request);
    
                $m_trail->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data trailing dengan kode ' . $kode,
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