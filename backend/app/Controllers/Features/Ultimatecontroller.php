<?php 
namespace App\Controllers\Features;
use App\Controllers\BaseController;
use App\Models\Features\UltimateModel;
use Config\Services;

class Ultimatecontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $request = Services::request();
            return view('menufeatures/view_ultimate');
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
                $m_ulti = new UltimateModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_ulti->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editfeaturesultimate('" .$list->kode_fitur. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletefeaturesultimate('" .$list->kode_fitur. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->status == 1)
                                {
                                    $isactive = "<span style='color:#2dce89;'>Aktif</span";
                                }
                                else
                                {
                                    $isactive = "<span style='color:#f5365c;'>Non Aktif</span";
                                }

                                $row[] = $no;
                                $row[] = $list->kode_fitur;
                                $row[] = date("d-M-Y", strtotime($list->tanggal));
                                $row[] = $list->jenis_fitur;
                                $row[] = $isactive;
                                
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_ulti->count_all(),
                            "recordsFiltered" => $m_ulti->count_filtered(),
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
                $kode = $this->request->getVar('kode');
                $date = date("Y-m-d", strtotime($this->request->getVar('date')));
                $request = Services::request();
                $m_ulti = new UltimateModel($request);

                $getdata = $m_ulti->where('abbr_fitur', $kode)
                                  ->where('tanggal', $date)
                                  ->find();
                $max  = count($getdata) + 1;

                if (empty($kode))
                {
                    $gen  = "CT" . str_pad($max, 2, 0, STR_PAD_LEFT) . "-" . date("dmy", strtotime($date));
                }
                else
                {
                    $gen  = $kode . str_pad($max, 2, 0, STR_PAD_LEFT) . "-" . date("dmy", strtotime($date));
                }
            
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
                    'featuresultimate_kode' => [
                        'label' => 'Kode fitur',
                        'rules' => [
                            'required',
                            'is_unique[fitur_ultimate.kode_fitur]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'featuresultimate_isi' => [
                        'label' => 'Isi',
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
						"featuresultimate_kode" => $this->validation->getError('featuresultimate_kode'),
                        "featuresultimate_isi" => $this->validation->getError('featuresultimate_isi'),
					]
				];
			}
			else
			{
                $abbr = $this->request->getVar('featuresultimate_jenis');
                $isactive = $this->request->getVar('featuresultimate_isactive');

                if ($abbr == 'CT')
                {
                    $jenis = 'Copy Trade';
                }
                else if ($abbr == 'DS')
                {
                    $jenis = 'Daily Stock';
                }
                else
                {
                    $jenis = 'Trailling Stock';
                }

                $data = [
                    'kode_fitur' => $this->request->getVar('featuresultimate_kode'),
                    'jenis_fitur' => $jenis,
                    'abbr_fitur' => $abbr,
					'tanggal' => date("Y-m-d", strtotime($this->request->getVar('featuresultimate_tanggal'))),
                    'isi' => $this->request->getVar('featuresultimate_isi'),
                    'status' => $isactive,
                ];

                $request = Services::request();
                $m_ulti = new UltimateModel($request);

                if ($isactive == 1)
                {
                    $m_ulti->set('status', '0')->where('abbr_fitur', $abbr)->update();
                }

                $m_ulti->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admcattype'
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
                $m_ulti = new UltimateModel($request);

                $item = $m_ulti->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_fitur'],
                        'jenis' => $item['abbr_fitur'],
                        'tanggal' => $item['tanggal'],
						'isi' => $item['isi'],
                        'status' => $item['status'],
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
                    'featuresultimate_isiubah' => [
                        'label' => 'Ubah isi',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "featuresultimate_isiubah" => $this->validation->getError('featuresultimate_isiubah'),
                        ]
                    ];
                }
                else
                {
                    $abbr = $this->request->getVar('featuresultimate_jenisubah');
                    $isactive = $this->request->getVar('featuresultimate_isactiveubah');

                    $data = [
                        'tanggal' => date("Y-m-d", strtotime($this->request->getVar('featuresultimate_tanggalubah'))),
                        'isi' => $this->request->getVar('featuresultimate_isiubah'),
						'status' => $isactive,
                    ];
    
                    $kode = $this->request->getVar('featuresultimate_kodeubah');
    
                    $request = Services::request();
                    $m_ulti = new UltimateModel($request);

                    if ($isactive == 1)
                    {
                        $m_ulti->set('status', '0')->where('abbr_fitur', $abbr)->update();
                    }

                    $m_ulti->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admcattype'
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
                $m_ulti = new UltimateModel($request);

                $m_ulti->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data dengan kode ' . $kode,
                        'link' => '/admcattype'
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