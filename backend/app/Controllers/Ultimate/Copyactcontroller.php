<?php 
namespace App\Controllers\Ultimate;
use App\Controllers\BaseController;
use App\Models\Ultimate\CopyactModel;
use Config\Services;

class Copyactcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
            
			return view('view_login');
        }
        else
        {
            return view('menuultimate/view_ultimatecopyact');
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
                $m_copyact = new CopyactModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_copyact->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editultimatecopyact('" .$list->kode_copyact. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteultimatecopyact('" .$list->kode_copyact. "')\"> 
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
                                $row[] = $list->kode_copyact;
                                $row[] = $list->alias;
								$row[] = $isactive;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_copyact->count_all(),
                            "recordsFiltered" => $m_copyact->count_filtered(),
                            "data" => $data
                        ];

                        // var_dump($output);
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
                $m_copyact = new CopyactModel($request);

                $getdata = $m_copyact->findAll();
                $max  = count($getdata) + 1;
                /*$gen  = "TBNR" . str_pad($max, 3, 0, STR_PAD_LEFT); */
				//$gen  = "KDSR" . str_pad($max, 3, 0, STR_PAD_LEFT);
				$gen  = "KDCT" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT);

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
	
	function compressImg($filename) {
        $thumbnail = \Config\Services::image()
        ->withFile('public/assets/img/copyactarticle/' . $filename)
        ->fit(900, 400, 'center')
		->save('public/assets/img/banner/copyactarticle/' . $filename, 75);
    }
	
	public function uploadGambar()
    {
        if ($this->request->getFile('image')) {
            $dataFile = $this->request->getFile('image');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("public/assets/img/copyactarticle/", $fileName);
            echo base_url("public/assets/img/copyactarticle/$fileName");
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
                    'ultimatecopyact_kode' => [
                        'label' => 'Kode Copy Article',
                        'rules' => [
                            'required',
                            'is_unique[t_copyact.kode_copyact]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
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
                        "ultimatecopyact_kode" => $this->validation->getError('ultimatecopyact_kode'),
					]
				];
			}
			else
			{       
				$isactive = $this->request->getVar('ultimatecopyact_isactive');
                $alias = $this->request->getVar('ultimatecopyact_jenis');

                $data = [
                    'kode_copyact' => $this->request->getVar('ultimatecopyact_kode'),
                    'alias' => $this->request->getVar('ultimatecopyact_jenis'),
                    'content' => $this->request->getVar('ultimatecopyact_deskripsi'),
                    'is_active' => $isactive,
                ];

                $request = Services::request();
                $m_copyact = new CopyactModel($request);
				

                if ($isactive == 1)
                {
                    $m_copyact->set('is_active', '0')->where('alias', $alias)->update();
                }

                $m_copyact->insert($data);
				

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
                $m_copyact = new CopyactModel($request);

                $item = $m_copyact->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_copyact'],
                        'content' => $item['content'],
                        'alias' => $item['alias'],
                        'active' => $item['is_active'],
                    ]
                ];

                // var_dump($data); die;
    
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
                $validationCheck = $this->validate([
                    'ultimatecopyact_kodeedit' => [
                        'label' => 'Kode Copy Article',
                        'rules' => [
                            'required'
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
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
                        "ultimatecopyact_kodeedit" => $this->validation->getError('ultimatecopyact_kodeedit'),
					]
				];
			}
			else
			{       
                $kode_copyact = $this->request->getVar('ultimatecopyact_kodeedit');
				$isactiveedit = $this->request->getVar('ultimatecopyact_isactiveedit');
                $aliasUbah = $this->request->getVar('ultimatecopyact_jenisedit');


                $data = [
                    'kode_copyact' => $this->request->getVar('ultimatecopyact_kodeedit'),
                    'alias' => $this->request->getVar('ultimatecopyact_jenisedit'),
                    'content' => $this->request->getVar('ultimatecopyact_deskripsiedit'),
                    'is_active' => $isactiveedit,
                ];

                $request = Services::request();
                $m_copyact = new CopyactModel($request);
				
				 if ($isactiveedit == 1)
                {
                    $m_copyact->set('is_active', '0')->where('alias', $aliasUbah)->update();
                }

                $m_copyact->update($kode_copyact, $data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil memperbarui data',
                       'link' => '/admsettingbenefit'
                    ]
                ];
            }

            echo json_encode($msg);
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
                $m_copyact = new CopyactModel($request);
    
                $m_copyact->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus article copy trades dengan kode ' . $kode,
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