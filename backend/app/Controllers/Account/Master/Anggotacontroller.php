<?php 
namespace App\Controllers\Account\Master;
use App\Controllers\BaseController;
use App\Models\Account\Master\AnggotaModel;
use Config\Services;

class Anggotacontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuaccount/submenumaster/view_masteranggota');
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
                $m_anggota = new AnggotaModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_anggota->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editaccountmember('" .$list->username. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                // $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                //                 onclick=\"deleteaccountmember('" .$list->kode_jenis_member. "')\"> 
                                //                 <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->username;
                                $row[] = $list->email;
                                $row[] = $list->full_name;
                                $row[] = $list->jenis_kelamin;
                                // $row[] = $tomboledit;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_anggota->count_all(),
                            "recordsFiltered" => $m_anggota->count_filtered(),
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

    function alphabet_to_number($string) {
        $string = strtoupper($string);
        $length = strlen($string);
        $number = 0;
        $level = 1;
        while ($length >= $level ) {
            $char = $string[$length - $level];
            $c = ord($char) - 64;        
            $number += $c * (26 ** ($level-1));
            $level++;
        }
        return $number;
    }

    public function proses() {
        try
        {
            $request = Services::request();
            $m_anggota = new AnggotaModel($request);
            $file = $this->request->getFile('masteranggota_file');

            $ext  = $file->getClientExtension();
            // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            // $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($ext);

            if ($ext == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }
            else
            {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($file);
            $actsheet = $spreadsheet->getActiveSheet();
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            $highestColumn = $actsheet->getHighestColumn();
            $totalColumn   = $this->alphabet_to_number($highestColumn);

            // echo $totalColumn;

            if ($totalColumn != 28)
            {
                // echo "Format file tidak sesuai";
                session()->setFlashdata('error', "Excel yang dimasukkan tidak sesuai");
                return redirect()->to(base_url('admmasteranggota'));
            }
            else
            {
                if (!empty($sheet)) {
                    foreach ($sheet as $x => $excel) {
                        if ($x == 0){
                            continue;
                        }
        
                        $cek = $m_anggota->cekData($excel['4']);
                        if ($excel['4'] == $cek['email']){
                            continue;
                        }
        
                        $data = [
                            'username' => $excel['1'],
                            'password' => $excel['2'],
                            'salt' => $excel['3'],
                            'email' => $excel['4'],
                            'activation_code' => $excel['5'],
                            'forgotten_password_code' => $excel['6'],
                            'forgotten_password_time' => $excel['7'],
                            'remember_code' => $excel['8'],
                            'created_on' => $excel['9'],
                            'last_login' => $excel['10'],
                            'active' => $excel['11'],
                            'full_name' => $excel['12'],
                            'photo' => $excel['13'],
                            'foto_ktp' => $excel['14'],
                            'ektp' => $excel['15'],
                            'jenis_kelamin' => $excel['16'],
                            'tempat_lahir' => $excel['17'],
                            'foto_kk' => $excel['18'],
                            'no_kk' => $excel['19'],
                            'no_hp' => $excel['20'],
                            'tanggal_lahir' => $excel['21'],
                            'alamat' => $excel['22'],
                            'foto_ktp_ahli_waris' => $excel['23'],
                            'additional' => $excel['24'],
                            'sudah_member' => $excel['25'],
                            'member' => $excel['26'],
                            'alamat_rumah' => $excel['27'],
                        ];
        
                        $m_anggota->insert($data);
                    }
                }
                
                session()->setFlashdata('message', 'Import success');
                return redirect()->to(base_url('admmasteranggota'));
            }

            // dd($sheet);

            // $msg = [
            //     'success' => [
            //        'data' => 'Import data telah berhasil',
            //        'link' => '/admaccountadministrator'
            //     ]
            // ];
        }
        catch(\Exception $e)
        {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->to(base_url('admmasteranggota'));

            // $msg = [
            //     'error' => [
            //        'data' => $e->getMessage(),
            //        'link' => '/admaccountadministrator'
            //     ]
            // ];
        }

        // echo json_encode($msg);
    }
}