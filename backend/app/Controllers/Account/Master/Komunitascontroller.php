<?php 
namespace App\Controllers\Account\Master;
use App\Controllers\BaseController;
use App\Models\Account\Master\KomunitasModel;
use Config\Services;

class Komunitascontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuaccount/submenumaster/view_masterkomunitas');
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
                $m_komunitas = new KomunitasModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_komunitas->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editaccountmember('" .$list->client_id. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                // $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                //                 onclick=\"deleteaccountmember('" .$list->kode_jenis_member. "')\"> 
                                //                 <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->client_id;
                                $row[] = $list->email;
                                $row[] = $list->name;
                                $row[] = $list->status_nasabah;
                                // $row[] = $tomboledit;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_komunitas->count_all(),
                            "recordsFiltered" => $m_komunitas->count_filtered(),
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
            $m_komunitas = new KomunitasModel($request);
            $file = $this->request->getFile('masterkomunitas_file');

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

            if ($totalColumn != 62)
            {
                // echo "Format file tidak sesuai";
                session()->setFlashdata('error', "Excel yang dimasukkan tidak sesuai");
                return redirect()->to(base_url('admmasterkomunitas'));
            }
            else
            {
                // echo "Proses";
                if (!empty($sheet)) {
                    foreach ($sheet as $x => $excel) {
                        if ($x == 0){
                            continue;
                        }
        
                        $cek = $m_komunitas->cekData($excel['1']);
                        if ($excel['1'] == $cek['client_id']){
                            continue;
                        }
        
                        $data = [
                            'client_id' => $excel['1'],
                            'user_id' => $excel['2'],
                            'kode_account' => $excel['3'],
                            'client_id_date' => $excel['4'],
                            'mtbi_id' => $excel['5'],
                            'mtbi_date' => $excel['6'],
                            'name' => $excel['7'],
                            'address' => $excel['8'],
                            'office_address' => $excel['9'],
                            'office_name' => $excel['10'],
                            'birth_date' => $excel['11'],
                            'mothers_name' => $excel['12'],
                            'email' => $excel['13'],
                            'phone' => $excel['14'],
                            'cellular' => $excel['15'],
                            'no_rek_tsi' => $excel['16'],
                            'opening_date' => $excel['17'],
                            'remark' => $excel['18'],
                            'send_date' => $excel['19'],
                            'id_no' => $excel['20'],
                            'sid_no' => $excel['21'],
                            'npwp_no' => $excel['22'],
                            'branch_id' => $excel['23'],
                            'cabang_induk_id' => $excel['24'],
                            'others' => $excel['25'],
                            'marketing_id' => $excel['26'],
                            'marketing_id_2' => $excel['27'],
                            'marketing_id_3' => $excel['28'],
                            'marketing' => $excel['29'],
                            'pendapatan_kotor' => $excel['30'],
                            'sumber_dana' => $excel['31'],
                            'jenis_kelamin' => $excel['32'],
                            'tanggal_pengiriman_oa' => $excel['33'],
                            'resi_pengiriman' => $excel['34'],
                            'ekspedisi_pengiriman' => $excel['35'],
                            'tanggal_retur' => $excel['36'],
                            'ket_tanggal_retur' => $excel['37'],
                            'tanggal_retur_kirim' => $excel['38'],
                            'oa_keterangan' => $excel['39'],
                            'status_transaksi' => $excel['40'],
                            'status_edukasi' => $excel['41'],
                            'nilai_cash' => $excel['42'],
                            'nilai_portofolio' => $excel['43'],
                            'tgl_transaksi_terakhir' => $excel['44'],
                            'status_nasabah' => $excel['45'],
                            'tenaga_edukasi' => $excel['46'],
                            'fu1_date' => $excel['47'],
                            'fu1_ket' => $excel['48'],
                            'fu2_date' => $excel['49'],
                            'fu2_ket' => $excel['50'],
                            'fu3_date' => $excel['51'],
                            'fu3_ket' => $excel['52'],
                            'setor_dana' => $excel['53'],
                            'terima_email_awal' => $excel['54'],
                            'sosmed' => $excel['55'],
                            'status' => $excel['56'],
                            'create_user' => $excel['57'],
                            'create_date' => $excel['58'],
                            'update_user' => $excel['59'],
                            'update_date' => $excel['60'],
                            'email_subscribe' => $excel['61'],
                        ];
        
                        $m_komunitas->insert($data);
                    }
                }
                
                session()->setFlashdata('message', 'Import success');
                return redirect()->to(base_url('admmasterkomunitas'));
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
            return redirect()->to(base_url('admmasterkomunitas'));

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