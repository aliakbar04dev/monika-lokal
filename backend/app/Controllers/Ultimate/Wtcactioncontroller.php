<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\WtcactionModel;
use Config\Services;

class Wtcactioncontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatewtcaction');
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
                $m_data = new WtcactionModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_data->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatewtcaction('" .$list->kode_wtcaction. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatewtcaction('" .$list->kode_wtcaction. "')\"> 
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
                                else
                                {
                                    $action = "<span style='color:#f5365c;'>SELL</span";
                                }

                                $row[] = $no;
                                $row[] = $list->stock;
                                $row[] = $list->value;
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
                            "recordsTotal" => $m_data->count_all(),
                            "recordsFiltered" => $m_data->count_filtered(),
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
                $m_data  = new WtcactionModel($request);

                $getdata = $m_data->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KWLA" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KWLA" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                    'ultimatewtcaction_kode' => [
                        'label' => 'Kode Watchlist Action',
                        'rules' => [
                            'required',
                            'is_unique[t_wtcaction.kode_wtcaction]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    'ultimatewtcaction_stock' => [
                        'label' => 'Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_value' => [
                        'label' => 'Value',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_buyprice' => [
                        'label' => 'Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_targetprice' => [
                        'label' => 'Target Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatewtcaction_stoploss' => [
                        'label' => 'Stop Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatewtcaction_risk' => [
                        'label' => 'Risk',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_narration' => [
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
                        "ultimatewtcaction_kode" => $this->validation->getError('ultimatewtcaction_kode'),
						"ultimatewtcaction_stock" => $this->validation->getError('ultimatewtcaction_stock'),
                        "ultimatewtcaction_value" => $this->validation->getError('ultimatewtcaction_value'),
						"ultimatewtcaction_buyprice" => $this->validation->getError('ultimatewtcaction_buyprice'),
                        "ultimatewtcaction_targetprice" => $this->validation->getError('ultimatewtcaction_targetprice'),
                        "ultimatewtcaction_stoploss" => $this->validation->getError('ultimatewtcaction_stoploss'),
                        "ultimatewtcaction_risk" => $this->validation->getError('ultimatewtcaction_risk'),
                        "ultimatewtcaction_narration" => $this->validation->getError('ultimatewtcaction_narration'),
					]
				];
			}
			else
			{              
                $data = [
                    'kode_wtcaction' => $this->request->getVar('ultimatewtcaction_kode'),
                    'stock' => $this->request->getVar('ultimatewtcaction_stock'),
                    'value' => $this->request->getVar('ultimatewtcaction_value'),
                    'buy_price' => $this->request->getVar('ultimatewtcaction_buyprice'),
                    'target_price' => $this->request->getVar('ultimatewtcaction_targetprice'),
                    'stop_loss' => $this->request->getVar('ultimatewtcaction_stoploss'),
                    'risk' => $this->request->getVar('ultimatewtcaction_risk'),
                    'narration' => $this->request->getVar('ultimatewtcaction_narration'),
                    'desc_narration' => $this->request->getPost('ultimatewtcaction_descnarration'),
                    'action' => $this->request->getVar('ultimatewtcaction_action'),
                    'is_active' => $this->request->getVar('ultimatewtcaction_isactive'),
                ];

                $request = Services::request();
                $m_data = new WtcactionModel($request);

                $m_data->insert($data);

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
                $m_data = new WtcactionModel($request);

                $item = $m_data->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_wtcaction'],
                        'stock' => $item['stock'],
                        'value' => $item['value'],
                        'buyprice' => $item['buy_price'],
						'targetprice' => $item['target_price'],
                        'stoploss' => $item['stop_loss'],
                        'risk' => $item['risk'],
						'narration' => $item['narration'],
                        'desc_narration' => $item['desc_narration'],
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
                    'ultimatewtcaction_stockubah' => [
                        'label' => 'Ubah Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_valueubah' => [
                        'label' => 'Ubah Value',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_buypriceubah' => [
                        'label' => 'Ubah Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_targetpriceubah' => [
                        'label' => 'Ubah Target Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimatewtcaction_stoplossubah' => [
                        'label' => 'Ubah Stop Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_riskubah' => [
                        'label' => 'Ubah Risk',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimatewtcaction_narrationubah' => [
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
							"ultimatewtcaction_stockubah" => $this->validation->getError('ultimatewtcaction_stockubah'),
							"ultimatewtcaction_valueubah" => $this->validation->getError('ultimatewtcaction_valueubah'),
							"ultimatewtcaction_buypriceubah" => $this->validation->getError('ultimatewtcaction_buypriceubah'),
							"ultimatewtcaction_targetpriceubah" => $this->validation->getError('ultimatewtcaction_targetpriceubah'),
                            "ultimatewtcaction_stoplossubah" => $this->validation->getError('ultimatewtcaction_stoplossubah'),
							"ultimatewtcaction_riskubah" => $this->validation->getError('ultimatewtcaction_riskubah'),
							"ultimatewtcaction_narrationubah" => $this->validation->getError('ultimatewtcaction_narrationubah'),
                       ]
                    ];
                }
                else
                {
                    $data = [
                        'stock' => $this->request->getVar('ultimatewtcaction_stockubah'),
                        'value' => $this->request->getVar('ultimatewtcaction_valueubah'),
                        'buy_price' => $this->request->getVar('ultimatewtcaction_buypriceubah'),
                        'target_price' => $this->request->getVar('ultimatewtcaction_targetpriceubah'),
                        'stop_loss' => $this->request->getVar('ultimatewtcaction_stoplossubah'),
                        'risk' => $this->request->getVar('ultimatewtcaction_riskubah'),
                        'narration' => $this->request->getVar('ultimatewtcaction_narrationubah'),
                        'desc_narration' => $this->request->getPost('ultimatewtcaction_descnarrationubah'),
                        'action' => $this->request->getVar('ultimatewtcaction_actionubah'),
                        'is_active' => $this->request->getVar('ultimatewtcaction_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('ultimatewtcaction_kodeubah');
    
                    $request = Services::request();
                    $m_data = new WtcactionModel($request);

                    $m_data->update($kode, $data);
    
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
                $m_data = new WtcactionModel($request);
    
                $m_data->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data watchlist action dengan kode ' . $kode,
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

    function compressImg($filename) {
        $thumbnail = \Config\Services::image()
        ->withFile('public/assets/img/wtcarticle/' . $filename)
        ->fit(900, 400, 'center')
		->save('public/assets/img/wtcarticle/' . $filename, 7);
    }
	
	public function uploadGambar()
    {
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/wtcarticle/", $fileName);
            echo base_url("public/assets/img/wtcarticle/$fileName");
        }
    }

    public function deleteGambar()
    {
        $src = $this->request->getVar('src');
        if ($src) {
            $file_name = str_replace(base_url() . "/", "", $src);
            if (unlink($file_name)) {
                echo "Delete file berhasil";
            }
        }
    }
}