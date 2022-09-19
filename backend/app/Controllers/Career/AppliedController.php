<?php 
namespace App\Controllers\Career;
use App\Controllers\BaseController;
use App\Models\Career\AppliedModel;
use Config\Services;

class AppliedController extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menucareer/view_careerapplied');
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
                $m_app = new AppliedModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_app->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];
												
								$tomboldownload = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"downloadcareerapplied('" .$list->id_pelamar. "')\">
                                                <i class=\"fa fa-download\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->id_pelamar;
                                $row[] = $list->nama_pelamar;
								$row[] = $list->karir;
								$row[] = $list->no_hp;
								$row[] = $list->email;
								$row[] = date("d-m-Y h:m:s", strtotime($list->create_at));
								$row[] = $tomboldownload;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_app->count_all(),
                            "recordsFiltered" => $m_app->count_filtered(),
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
                $m_cat = new CategorycarModel($request);

                $getdata = $m_cat->getLastData();
                $kode = substr($getdata->kode, 4) + 1;
                $gen  = "TKTP" . str_pad($kode, 3, 0, STR_PAD_LEFT);

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
                    'careercategory_kode' => [
                        'label' => 'Kode kategori pekerjaan',
                        'rules' => [
                            'required',
                            'is_unique[t_kategori_pekerjaan.id_kategori_pekerjaan]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'careercategory_nama' => [
                        'label' => 'Kategori pekerjaan',
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
						"careercategory_kode" => $this->validation->getError('careercategory_kode'),
						"careercategory_nama" => $this->validation->getError('careercategory_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'id_kategori_pekerjaan' => $this->request->getVar('careercategory_kode'),
                    'kategori_pekerjaan' => $this->request->getVar('careercategory_nama'),
                ];

                $request = Services::request();
                $m_cat = new CategorycarModel($request);

                $m_cat->insert($data);;

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admcareercategory'
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
                $m_app = new AppliedModel($request);

                $item = $m_app->find($kode);
    
                $data = [
                    'success' => [
						'name' => $item['dokumen'],
                        'dokumen' => str_replace('/backend', '', base_url()) . $item['dokumen'],
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
	//--------------------------------------------------------------------
	
}