<?php 
namespace App\Controllers\Feedback;
use App\Controllers\BaseController;
use App\Models\Feedback\QuestionModel;
use Config\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Questioncontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menufeedback/view_feedbackquestion');
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
                $m_question = new QuestionModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_question->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tombolview = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editfeedbackquestion('" .$list->id_contact_us. "')\">
                                                <i class=\"fa fa-eye\"></i></button>";

                                // $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                //                 onclick=\"deletefeedbackquestion('" .$list->id_contact_us. "')\"> 
                                //                 <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->nama;
                                $row[] = $list->email;
                                $row[] = $list->no_hp;
                                $row[] = $list->insert_date;
                                $row[] = $tombolview;
                                // $row[] = $tombolview . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_question->count_all(),
                            "recordsFiltered" => $m_question->count_filtered(),
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
                $m_question = new QuestionModel($request);

                $item = $m_question->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_contact_us'],
                        'nama' => $item['nama'],
                        'email' => $item['email'],
                        'hp' => $item['no_hp'],
                        'pesan' => $item['isi_pesan'],
                        'tgl' => $item['insert_date'],
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

    function proses() {
        $request = Services::request();
        $m_question = new QuestionModel($request);
        $alldata = $m_question->findAll();

        $styleJudul = [
            'font' => [
                'color' => [
                    'rgb' => 'FFFFFF'
                ],
                'bold'=>true,
                'size'=>11
            ],
            'fill'=>[
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'e74c3c'
                ]
            ],
            'alignment'=>[
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
         
        ];

        $spreadsheet = new Spreadsheet();
        // style lebar kolom
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setWidth(5);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setWidth(20);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(25);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(18);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(50);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setWidth(25);

        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Alamat Email')
                    ->setCellValue('D1', 'No Hp')
                    ->setCellValue('E1', 'Isi Pesan')
                    ->setCellValue('F1', 'Tanggal Submit');

        // STYLE judul table
        $spreadsheet->getActiveSheet()
                    ->getStyle('A1:F1')
                    ->applyFromArray($styleJudul);
        
        $no = 1;
        $column = 2;
        // tulis data ke cell
        foreach($alldata as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no)
                        ->setCellValue('B' . $column, $data['nama'])
                        ->setCellValue('C' . $column, $data['email'])
                        ->setCellValue('D' . $column, $data['no_hp'])
                        ->setCellValue('E' . $column, $data['isi_pesan'])
                        ->setCellValue('F' . $column, $data['insert_date']);
            $column++;
            $no++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Question';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
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
                $m_question = new QuestionModel($request);
    
                $m_question->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data contact us dengan kode ' . $kode,
                        'link' => '/admfeedbackquestion'
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