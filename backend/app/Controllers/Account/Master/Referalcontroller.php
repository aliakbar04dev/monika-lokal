<?php 
namespace App\Controllers\Account\Master;
use App\Controllers\BaseController;
use App\Models\Account\Master\ReferalModel;
use Config\Services;

class Referalcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuaccount/submenumaster/view_masterreferal');
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
                $m_referal = new ReferalModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_referal->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editaccountmember('" .$list->kode_referal. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                // $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                //                 onclick=\"deleteaccountmember('" .$list->kode_jenis_member. "')\"> 
                                //                 <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_referal;
                                $row[] = $list->nama;
                                $row[] = $list->jabatan;
                                // $row[] = $tomboledit;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_referal->count_all(),
                            "recordsFiltered" => $m_referal->count_filtered(),
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
            $m_referal = new ReferalModel($request);
            $file = $this->request->getFile('masterreferal_file');

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

            if ($totalColumn != 4)
            {
                // echo "Format file tidak sesuai";
                session()->setFlashdata('error', "Excel yang dimasukkan tidak sesuai");
                return redirect()->to(base_url('admmasterreferal'));
            }
            else
            {
                if (!empty($sheet)) {
                    foreach ($sheet as $x => $excel) {
                        if ($x == 0){
                            continue;
                        }
        
                        $cek = $m_referal->cekData($excel['0']);
                        if ($excel['0'] == $cek['kode_referal']){
                            continue;
                        }
        
                        $data = [
                            'kode_referal' => $excel['0'],
                            'nama' => $excel['1'],
                            'jabatan' => $excel['2'],
                            'divisi' => $excel['3'],
                        ];
        
                        $m_referal->insert($data);
                    }
                }
                
                session()->setFlashdata('message', 'Import success');
                return redirect()->to(base_url('admmasterreferal'));
            }
        }
        catch(\Exception $e)
        {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->to(base_url('admmasterreferal'));
        }
    }
}