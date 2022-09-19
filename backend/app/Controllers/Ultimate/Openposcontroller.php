<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\OpenposModel;
use Config\Services;

class Openposcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimateopenpos');
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
                $m_openpos = new OpenposModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_openpos->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimateopenpos('" .$list->kode_openpos. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                             
                                $tomboleditgambar = "<button type=\"button\" class=\"btn btn-dark btn-sm\"
                                                onclick=\"changeimgultimateopenpos('" .$list->kode_openpos. "')\">
                                                <i class=\"fa fa-file-pdf\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimateopenpos('" .$list->kode_openpos. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->is_active == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Tidak Aktif</span";
                                }

                                $row[] = $tombolhapus . ' ' . $tomboleditgambar . ' ' . $tomboledit;
                                $row[] = $no;
                                $row[] = $list->stock;
                                $row[] = date('d/m/Y', strtotime($list->buy_date));
                                $row[] = $list->buy_price;
                                $row[] = $list->target_price;
                                $row[] = $list->last_price;
                                $row[] = $list->loss_profit;
                                $row[] = $list->narration;
                                $row[] = $list->stop_loss;
								$row[] = $isactive;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_openpos->count_all(),
                            "recordsFiltered" => $m_openpos->count_filtered(),
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
                $m_openpos  = new OpenposModel($request);

                $getdata = $m_openpos->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KUOP" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KUOP" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
                    'ultimateopenpos_kode' => [
                        'label' => 'Kode Open Position',
                        'rules' => [
                            'required',
                            'is_unique[t_openpos.kode_openpos]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],

                    'ultimateopenpos_stock' => [
                        'label' => 'Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_buydate' => [
                        'label' => 'Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_buyprice' => [
                        'label' => 'Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_targetprice' => [
                        'label' => 'Target Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimateopenpos_lastprice' => [
                        'label' => 'Last Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimateopenpos_lostprofit' => [
                        'label' => 'Loss Profit',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_narration' => [
                        'label' => 'Narration',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                   'ultimateopenpos_gambar' => [
                        'label' => 'Berkas',
                        'rules' => [
                            'uploaded[ultimateopenpos_gambar]',
                            'mime_in[ultimateopenpos_gambar,application/pdf]',
                            'max_size[ultimateopenpos_gambar,5120]',
                        ],
                        'errors' => [
                            'uploaded'      => '{field} wajib diisi',
                            'mime_in' 		=> '{field} tidak sesuai format standar',
                            'max-size'      => '{field} melebihi ukuran yang ditentukan',
                        ],
                    ],

                    'ultimateopenpos_stoploss' => [
                        'label' => 'Stop Loss',
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
                        "ultimateopenpos_kode" => $this->validation->getError('ultimateopenpos_kode'),
						"ultimateopenpos_stock" => $this->validation->getError('ultimateopenpos_stock'),
                        "ultimateopenpos_buydate" => $this->validation->getError('ultimateopenpos_buydate'),
						"ultimateopenpos_buyprice" => $this->validation->getError('ultimateopenpos_buyprice'),
                        "ultimateopenpos_targetprice" => $this->validation->getError('ultimateopenpos_targetprice'),
                        "ultimateopenpos_lastprice" => $this->validation->getError('ultimateopenpos_lastprice'),
                        "ultimateopenpos_lostprofit" => $this->validation->getError('ultimateopenpos_lostprofit'),
                        "ultimateopenpos_narration" => $this->validation->getError('ultimateopenpos_narration'),
                        "ultimateopenpos_gambar" => $this->validation->getError('ultimateopenpos_gambar'),
                        "ultimateopenpos_stoploss" => $this->validation->getError('ultimateopenpos_stoploss'),
					]
				];
			}
			else
			{           
                
                $fileImage = $this->request->getFile('ultimateopenpos_gambar');
                if ($fileImage->isValid() && ! $fileImage->hasMoved()) {
                    $imageName = $fileImage->getRandomName();
                    $fileImage->move('public/assets/img/openposition/', $imageName);
                }

                $data = [
                    'kode_openpos' => $this->request->getVar('ultimateopenpos_kode'),
                    'stock' => $this->request->getVar('ultimateopenpos_stock'),
                    'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimateopenpos_buydate'))),
                    'buy_price' => $this->request->getVar('ultimateopenpos_buyprice'),
                    'target_price' => $this->request->getVar('ultimateopenpos_targetprice'),
                    'last_price' => $this->request->getVar('ultimateopenpos_lastprice'),
                    'loss_profit' => $this->request->getVar('ultimateopenpos_lostprofit'),
                    'narration' => $this->request->getVar('ultimateopenpos_narration'),
                    'desc_narration' => $this->request->getPost('ultimateopenpos_descnarration'),
                    'stop_loss' => $this->request->getVar('ultimateopenpos_stoploss'),
                    'gambar' => $imageName,
                    'is_active' => $this->request->getVar('ultimateopenpos_isactive'),
                ];

                $request = Services::request();
                $m_openpos = new OpenposModel($request);

                $m_openpos->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => base_url() . '/admultimateopenpos'
                       ]
                ];
            }

            echo json_encode($msg);
        }
    }

    
    public function pilihgambar() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_openpos = new OpenposModel($request);

                $item = $m_openpos->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_openpos'],
                        'stock' => $item['stock'],
                        'gambar' => $item['gambar'],
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

    public function perbaruigambar() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'ultimateopenpos_editgambarubah' => [
                        'label' => 'Berkas',
                        'rules' => [
                            'uploaded[ultimateopenpos_editgambarubah]',
                            'mime_in[ultimateopenpos_editgambarubah,application/pdf]',
                            'max_size[ultimateopenpos_editgambarubah,5120]',
                        ],
                        'errors' => [
                            'uploaded'      => '{field} wajib diisi',
                            'mime_in' 		=> '{field} tidak sesuai format standar',
                            'is_image'      => '{field} tidak sesuai',
                            'max-size'      => '{field} melebihi ukuran yang ditentukan',
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "ultimateopenpos_editgambarubah" => $this->validation->getError('ultimateopenpos_editgambarubah'),
                        ]
                    ];
                }
                else
                {
                    $kode = $this->request->getVar('ultimateopenpos_kodeubahgambar');
                    $request = Services::request();
                    $m_openpos = new OpenposModel($request);

                    $item = $m_openpos->find($kode);
                    $oldImage = $item['gambar'];
                    $file = $this->request->getFile('ultimateopenpos_editgambarubah');

                    if ($oldImage == null || $oldImage == " " || $oldImage == "" || empty($oldImage)) {
                        if ($file->isValid() && ! $file->hasMoved()) {
                            $imageName = $file->getRandomName();
                            $file->move('public/assets/img/openposition/', $imageName);
                        }
                    } else {
                        if ($file->isValid() && ! $file->hasMoved()) {
                            if (file_exists('public/assets/img/openposition/'.$oldImage)) {
                                unlink('public/assets/img/openposition/'.$oldImage);
                            }
                            $imageName = $file->getRandomName();
                            $file->move('public/assets/img/openposition/', $imageName);
                        } else {
                            $imageName = $item['gambar'];
                        }
                    }

                    $data = [
                        'gambar' => $imageName,
                    ];

                    $m_openpos->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui berkas',
                           'link' => base_url() . '/admultimateopenpos'
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
                $m_openpos = new OpenposModel($request);

                $item = $m_openpos->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_openpos'],
                        'stock' => $item['stock'],
                        'buydate' => $item['buy_date'],
                        'buyprice' => $item['buy_price'],
						'targetprice' => $item['target_price'],
                        'lastprice' => $item['last_price'],
                        'lossprofit' => $item['loss_profit'],
						'narration' => $item['narration'],
                        'desc_narration' => $item['desc_narration'],
                        'stoploss' => $item['stop_loss'],
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
                    'ultimateopenpos_stockubah' => [
                        'label' => 'Ubah Kode Saham',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_buydateubah' => [
                        'label' => 'Ubah Buy Date',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_buypriceubah' => [
                        'label' => 'Ubah Buy Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_targetpriceubah' => [
                        'label' => 'Ubah Target Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimateopenpos_lastpriceubah' => [
                        'label' => 'Ubah Last Price',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_lostprofitubah' => [
                        'label' => 'Ubah Loss Profit',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'ultimateopenpos_narrationubah' => [
                        'label' => 'Ubah Narration',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'ultimateopenpos_stoplossubah' => [
                        'label' => 'Ubah Stop Loss',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
				
				if (!$check) {
                    $msg = [
                       'error' => [
							"ultimateopenpos_stockubah" => $this->validation->getError('ultimateopenpos_stockubah'),
							"ultimateopenpos_buydateubah" => $this->validation->getError('ultimateopenpos_buydateubah'),
							"ultimateopenpos_buypriceubah" => $this->validation->getError('ultimateopenpos_buypriceubah'),
							"ultimateopenpos_targetpriceubah" => $this->validation->getError('ultimateopenpos_targetpriceubah'),
                            "ultimateopenpos_lastpriceubah" => $this->validation->getError('ultimateopenpos_lastpriceubah'),
							"ultimateopenpos_lostprofitubah" => $this->validation->getError('ultimateopenpos_lostprofitubah'),
							"ultimateopenpos_narrationubah" => $this->validation->getError('ultimateopenpos_narrationubah'),
                            "ultimateopenpos_stoplossubah" => $this->validation->getError('ultimateopenpos_stoplossubah'),
                       ]
                    ];
                }
                else
                {
                    $data = [
                        'stock' => $this->request->getVar('ultimateopenpos_stockubah'),
                        'buy_date' => date("Y-m-d", strtotime($this->request->getVar('ultimateopenpos_buydateubah'))),
                        'buy_price' => $this->request->getVar('ultimateopenpos_buypriceubah'),
                        'target_price' => $this->request->getVar('ultimateopenpos_targetpriceubah'),
                        'last_price' => $this->request->getVar('ultimateopenpos_lastpriceubah'),
                        'loss_profit' => $this->request->getVar('ultimateopenpos_lostprofitubah'),
                        'narration' => $this->request->getVar('ultimateopenpos_narrationubah'),
                        'desc_narration' => $this->request->getPost('ultimateopenpos_descnarrationubah'),
                        'stop_loss' => $this->request->getVar('ultimateopenpos_stoplossubah'),
                        'is_active' => $this->request->getVar('ultimateopenpos_isactiveubah'),
                    ];
    
                    $kode = $this->request->getVar('ultimateopenpos_kodeubah');
    
                    $request = Services::request();
                    $m_openpos = new OpenposModel($request);

                    $m_openpos->update($kode, $data);
    
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
                $m_openpos = new OpenposModel($request);
    
                $m_openpos->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data open position dengan kode ' . $kode,
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
        ->withFile('public/assets/img/openposarticle/' . $filename)
        ->fit(900, 400, 'center')
		->save('public/assets/img/openposarticle/' . $filename, 7);
    }
	
	public function uploadGambar()
    {
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/openposarticle/", $fileName);
            echo base_url("public/assets/img/openposarticle/$fileName");
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