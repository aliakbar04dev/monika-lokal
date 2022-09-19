<?php 
namespace App\Controllers\Feedback;
use App\Controllers\BaseController;
use App\Models\Feedback\SubscriberModel;
use Config\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Subscribercontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menufeedback/view_feedbacksubscribe');
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
                $m_subscriber = new SubscriberModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_subscriber->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tombolview = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"viewfeedbacksubscriber('" .$list->id_subscriber. "')\">
                                                <i class=\"fa fa-eye\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletefeedbacksubscriber('" .$list->id_subscriber. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->email_address;
                                $row[] = $list->insert_date;
                                // $row[] = $tombolview . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_subscriber->count_all(),
                            "recordsFiltered" => $m_subscriber->count_filtered(),
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

    function proses() {
        $request = Services::request();
        $m_subscriber = new SubscriberModel($request);
        $alldata = $m_subscriber->findAll();

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

        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Alamat Email')
                    ->setCellValue('C1', 'Tanggal Subscriber');

        // STYLE judul table
        $spreadsheet->getActiveSheet()
                    ->getStyle('A1:C1')
                    ->applyFromArray($styleJudul);
        
        $no = 1;
        $column = 2;
        // tulis data ke cell
        foreach($alldata as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no)
                        ->setCellValue('B' . $column, $data['email_address'])
                        ->setCellValue('C' . $column, $data['insert_date']);
            $column++;
            $no++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Subscriber';

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
                $m_subscriber = new SubscriberModel($request);
    
                $m_subscriber->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data subscriber dengan kode ' . $kode,
                        'link' => '/admfeedbacksubscribe'
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