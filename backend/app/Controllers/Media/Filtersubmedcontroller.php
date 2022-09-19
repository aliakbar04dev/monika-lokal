<?php 
namespace App\Controllers\Media;
use App\Controllers\BaseController;
use App\Models\Media\FiltersubmedModel;
use Config\Services;

class Filtersubmedcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menumedia/view_submediafilter');
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
                $m_submed = new FiltersubmedModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_submed->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsubmediafilter('" .$list->kode_filter_submedia. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletesubmediafilter('" .$list->kode_filter_submedia. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_filter_submedia;
                                $row[] = $list->keterangan_submedia;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_submed->count_all(),
                            "recordsFiltered" => $m_submed->count_filtered(),
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
                $m_submed = new FiltersubmedModel($request);

                $getdata = $m_submed->findAll();
                $max  = count($getdata) + 1;
                $gen  = "FSMED" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'submediafilter_kode' => [
                        'label' => 'Kode filter submedia',
                        'rules' => [
                            'required',
                            'is_unique[filter_submedia.kode_filter_submedia]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'submediafilter_keterangan' => [
                        'label' => 'Keterangan filter',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'submediafilter_desc' => [
                        'label' => 'Deskripsi filter',
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
						"submediafilter_kode" => $this->validation->getError('submediafilter_kode'),
						"submediafilter_keterangan" => $this->validation->getError('submediafilter_keterangan'),
                        "submediafilter_desc" => $this->validation->getError('submediafilter_desc'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_filter_submedia' => $this->request->getVar('submediafilter_kode'),
                    'keterangan_submedia' => $this->request->getVar('submediafilter_keterangan'),
                    'desc_submedia' => $this->request->getVar('submediafilter_desc'),
                ];

                $request = Services::request();
                $m_submed = new FiltersubmedModel($request);

                $m_submed->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admmediafilter'
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
                $m_submed = new FiltersubmedModel($request);

                $item = $m_submed->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_filter_submedia'],
                        'judul' => $item['keterangan_submedia'],
                        'desc' => $item['desc_submedia'],
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
                    'submediafilter_keteranganubah' => [
                        'label' => 'Ubah keterangan filter',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                    'submediafilter_descubah' => [
                        'label' => 'Ubah Deskripsi filter',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "submediafilter_keteranganubah" => $this->validation->getError('submediafilter_keteranganubah'),
                            "submediafilter_descubah" => $this->validation->getError('submediafilter_descubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'keterangan_submedia' => $this->request->getVar('submediafilter_keteranganubah'),
                        'submediafilter_descubah' => $this->request->getVar('submediafilter_descubah'),
                        'desc_submedia' => $this->request->getVar('submediafilter_descubah'),
                    ];
    
                    $kode = $this->request->getVar('submediafilter_kodeubah');
    
                    $request = Services::request();
                    $m_submed = new FiltersubmedModel($request);

                    $m_submed->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admfiltermed'
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
                $m_submed = new FiltersubmedModel($request);
    
                $m_submed->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data submedia filter dengan kode ' . $kode,
                        'link' => '/admmediafilter'
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

    public function uploadGambar(){
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/subkategori_media/", $fileName);
            echo base_url("public/assets/img/subkategori_media/$fileName");
        }
    }

    public function deleteGambar(){
        $src = $this->request->getVar('src');
        if ($src) {
            $file_name = str_replace(base_url() . "/", "", $src);
            if (unlink($file_name)) {
                echo "Delete file berhasil";
            }
        }
    }
}