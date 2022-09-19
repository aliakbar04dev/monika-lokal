<?php 
namespace App\Controllers\Account;
use App\Controllers\BaseController;
use App\Models\Account\UserModel;
use App\Models\Account\UserlevelModel;
use App\Models\Account\MemberModel;
use Config\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Usercontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
			$request = Services::request();
            $m_lvl = new UserlevelModel($request);
			$m_mbr = new MemberModel($request);

            $data = [
                'level' => $m_lvl->getlvlall(),
				'member' => $m_mbr->getkodeall(),
            ];
			
            return view('menuaccount/view_accountuser', $data);
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
                $m_user  = new UserModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_user->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editaccountuser('" .$list->kode_user. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                // $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                //                 onclick=\"deleteaccountmember('" .$list->kode_user. "')\"> 
                                //                 <i class=\"fa fa-trash\"></i></button>";
								
								if ($list->is_verif == 1)
                                {
                                    $isverif = "<span style='color:#2dce89;'>Verified</span";
                                }
                                else
                                {
                                    $isverif = "<span style='color:#f5365c;'>Not yet</span";
                                }
								
								if ($list->request_changepass == 1)
                                {
                                    $isrequest = "<span style='color:#2dce89;'>Requested</span";
                                }
                                else
                                {
                                    $isrequest = "<span style='color:#f5365c;'>Not yet</span";
                                }

                                $row[] = $tomboledit;
                                $row[] = $no;
                                $row[] = $list->kode_user;
                                $row[] = $list->kode_user_level;
								$row[] = $list->kode_user_level_temp;
                                $row[] = $list->kode_jenis_member;
                                $row[] = $list->username;
                                $row[] = $list->client_id_komunitas;
                                $row[] = $list->email_anggota;
                                $row[] = $list->nama_lengkap;
                                $row[] = $list->alamat_email;
                                $row[] = $list->no_hp;
                                $row[] = $list->kota;
                                $row[] = $list->kode_referal;
                                $row[] = $list->jenis_kelamin;
                                $row[] = $list->tempat_lahir;
                                $row[] = $list->tanggal_lahir;
                                $row[] = $list->website;
                                $row[] = $list->alamat;
                                $row[] = $list->tentang_saya;
                                $row[] = $list->created_at;
                                $row[] = $list->verif_kode;
                                $row[] = $list->forget_kode;
                                $row[] = $list->forget_expire;
                                $row[] = $isverif;
                                $row[] = $list->trial_expire;
                                $row[] = $list->expire_date;
								$row[] = $list->expire_date_temp;
								$row[] = $list->regis_no_hp;
								$row[] = $list->regis_otp;
								$row[] = $list->regis_otp_exp;
								$row[] = $list->change_phone;
								$row[] = $list->phone_otp;
								$row[] = $list->phone_otp_exp;
								$row[] = $list->session_login;
								$row[] = $isrequest;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_user->count_all(),
                            "recordsFiltered" => $m_user->count_filtered(),
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
                $m_user  = new UserModel($request);

                $item = $m_user->find($kode);
    
                $data = [
                    'success' => [
                        'username' => $item['username'],
                        'nama_lengkap' => $item['nama_lengkap'],
                        'alamat_email' => $item['alamat_email'],
                        'no_hp' => $item['no_hp'],
                        'kota' => $item['kota'],
                        'kode_referal' => $item['kode_referal'],

                        'kodeuser' => $item['kode_user'],
						'kodelevel' => $item['kode_user_level'],
						'jenismember' => $item['kode_jenis_member'],
                        'expdate'  => $item['expire_date'],
                        'status' => $item['request_changepass'],
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
                $this->db = \Config\Database::connect();
                $request = Services::request();
                $m_user = new UserModel($request);

                $kodeInput = $this->request->getVar('accountuser_kodeubah');
                $username = $this->request->getVar('accountuser_username');
                $alamat_email = $this->request->getVar('accountuser_email');
                $no_hp = $this->request->getVar('accountuser_nohp');

                $query = $m_user->getWhere(['kode_user' => $kodeInput])->getRowArray();
                $kodeUserDb = $query['kode_user'];
                $usernameDb = $query['username'];
                $emailDb = $query['alamat_email'];
                $nohpDb = $query['no_hp'];

                $countUserTerpilih = $this->db->table('t_user')
                                                ->where('kode_user', $kodeInput)
                                                ->countAllResults();

                // if($username != $usernameDb) {
                //     $is_uniqueUsername =  'is_unique[t_user.username]';
                // } else {
                //     $is_uniqueUsername =  ' ';
                // }

                // if($alamat_email != $emailDb) {
                //     $is_uniqueEmail =  'is_unique[t_user.alamat_email]';
                // } else {
                //     $is_uniqueEmail =  '';
                // }

                // if($no_hp != $nohpDb) {
                //     $is_uniqueNohp =  'is_unique[t_user.no_hp]';
                // } else {
                //     $is_uniqueNohp =  '';
                // }

                // echo json_encode($query); die;

                if ($countUserTerpilih > 0) {
                    if ($kodeInput == $kodeUserDb) {
                        $check = $this->validate([
                            'accountuser_changedate' => [
                                'label' => 'Exp date',
                                'rules' => 'required',
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi'
                                ],
                            ],
                            'accountuser_username' => [
                                'label' => 'Username',
                                'rules' => [
                                    'required',
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                ],
                            ],
                            'accountuser_email' => [
                                'label' => 'Email',
                                'rules' => [
                                    'required',
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                ],
                            ],
                            'accountuser_nohp' => [
                                'label' => 'No. HP',
                                'rules' => [
                                    'required',
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                ],
                            ],
                        ]);
                    } else {
                        $check = $this->validate([
                            'accountuser_changedate' => [
                                'label' => 'Exp date',
                                'rules' => 'required',
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi'
                                ],
                            ],
                            'accountuser_username' => [
                                'label' => 'Username',
                                'rules' => [
                                    'required',
                                    'is_unique[t_user.username]'
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                    'is_unique'	    => '{field} sudah terpakai'
                                ],
                            ],
                            'accountuser_email' => [
                                'label' => 'Email',
                                'rules' => [
                                    'required',
                                    'is_unique[t_user.alamat_email]'
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                    'is_unique'	    => '{field} sudah terpakai'
                                ],
                            ],
                            'accountuser_nohp' => [
                                'label' => 'No. HP',
                                'rules' => [
                                    'required',
                                    'is_unique[t_user.no_hp]'
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                    'is_unique'	    => '{field} sudah terpakai'
                                ],
                            ],
                        ]);
                    }
                } else {
                    $check = $this->validate([
                        'accountuser_changedate' => [
                            'label' => 'Exp date',
                            'rules' => 'required',
                            'errors' => [
                                'required' 		=> '{field} wajib terisi'
                            ],
                        ],
                        'accountuser_username' => [
                            'label' => 'Username',
                            'rules' => [
                                'required',
                            ],
                            'errors' => [
                                'required' 		=> '{field} wajib terisi',
                            ],
                        ],
                        'accountuser_email' => [
                            'label' => 'Email',
                            'rules' => [
                                'required',
                            ],
                            'errors' => [
                                'required' 		=> '{field} wajib terisi',
                            ],
                        ],
                        'accountuser_nohp' => [
                            'label' => 'No. HP',
                            'rules' => [
                                'required',
                            ],
                            'errors' => [
                                'required' 		=> '{field} wajib terisi',
                            ],
                        ],
                    ]);
                }


                if (!$check) {
                    $msg = [
                        'error' => [
                            "accountuser_changedate" => $this->validation->getError('accountuser_changedate'),
                            "accountuser_username" => $this->validation->getError('accountuser_username'),
                            "accountuser_email" => $this->validation->getError('accountuser_email'),
                            "accountuser_nohp" => $this->validation->getError('accountuser_nohp'),
                        ]
                    ];

                    echo json_encode($msg);
                }
                else
                {
                    $data = [
						'kode_referal' => $this->request->getVar('accountuser_kodereferal'),
                        'username' => $this->request->getVar('accountuser_username'),
						'nama_lengkap' => $this->request->getVar('accountuser_nmlengkap'),
						'alamat_email' => $this->request->getVar('accountuser_email'),
						'no_hp' => $this->request->getVar('accountuser_nohp'),
						'kota' => $this->request->getVar('accountuser_kota'),
						'kode_user_level' => $this->request->getVar('accountuser_kodelevel'),
						'kode_jenis_member' => $this->request->getVar('accountuser_jenismember'),
                        'expire_date' => date("Y-m-d", strtotime($this->request->getVar('accountuser_changedate'))),
                        'request_changepass' => $this->request->getVar('accountuser_changepass'),
                    ];

                    // $query = $m_user->getWhere(['username' => $username])->countAll();
                    // var_dump($query); die;

                    // if ($username == 1) {

                    // }
    
                    $m_user->update($kodeInput, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                        //    'link' => '/admcattype'
                        ]
                    ];
        
                    echo json_encode($msg);
                }
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }


    public function getexcelview() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
			$request = Services::request();

            $m_user = new UserModel($request);

            // $users = $m_user->getResultArray();

            $db      = \Config\Database::connect();
            $builder = $db->table('t_user');
            $builder->select('kode_user, client_id_komunitas, nama_lengkap, alamat_email, no_hp, kota, jenis_kelamin');
            $users   = $builder->get(15000)->getResultArray();

            // echo json_encode($users); die;
            
            $m_lvl = new UserlevelModel($request);
			$m_mbr = new MemberModel($request);

            $data = [
                'level' => $m_lvl->getlvlall(),
				'member' => $m_mbr->getkodeall(),
            ];

            return view('menuaccount/view_accountuserexport', $data);

        }
    }


    public function getexcel() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $passw = $this->request->getVar('password');
            if ($passw == 'irfan') {
                $request = Services::request();

                $m_user = new UserModel($request);
                // $users = $m_user->getResultArray();
    
                $db      = \Config\Database::connect();
                $builder = $db->table('t_user');
                $builder->select('t_user.kode_user, m_user_level.nama_level, m_jenis_member.jenis_member, t_user.client_id_komunitas, t_user.nama_lengkap, t_user.alamat_email, t_user.no_hp, t_user.kota, t_user.jenis_kelamin, t_user.created_at, t_user.trial_expire, t_user.expire_date, t_user.kode_referal');
                $builder->join('m_user_level', 'm_user_level.kode_user_level = t_user.kode_user_level', 'left');
                $builder->join('m_jenis_member', 'm_jenis_member.kode_jenis_member = t_user.kode_jenis_member', 'left');
                $users   = $builder->get()->getResultArray();
    
                // echo json_encode($users); die;

                $filename = 'Data_user_'.date('dmY').'.csv'; 
                header("Content-Description: File Transfer"); 
                header("Content-Disposition: attachment; filename=$filename"); 
                header("Content-Type: application/csv; ");
    
                // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                // $writer->save('php://output');

                $file = fopen('php://output', 'w');

                $header = array("Kode User", "Level User", "Jenis Member", "Client ID", "Nama Lengkap", "Email", "No. HP", "Kota", "Jenis Kelamin", "Created", "Trial Expire", "Expire Date", "Kode Referal"); 
                fputcsv($file, $header);
                foreach ($users as $key=>$line){ 
                   fputcsv($file,$line); 
                }
                fclose($file); 
                exit; 
            } else {
                echo "<script>
                    alert('Salah Password!');
                    window.location.href='https://monika.panensaham.com/backend/index.php/admaccountuser';
                </script>";
            }
            
        
        }
    }
}