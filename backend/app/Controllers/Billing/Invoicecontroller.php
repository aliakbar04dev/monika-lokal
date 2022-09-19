<?php 
namespace App\Controllers\Billing;
use App\Controllers\BaseController;
use App\Models\Billing\InvoiceModel;
use Config\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Invoicecontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $stdate = date("m/01/Y");
			$eddate = date("m/d/Y");
			$data = [
				'start_date' => $stdate,
				'end_date' => $eddate,
            ];
			return view('menubilling/view_billinginvoice', $data);
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
                $stdate = $this->request->getVar('stdate');
			    $eddate = $this->request->getVar('eddate');

                $request = Services::request();
                $m_inv   = new InvoiceModel($request, date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate)));

                // $m_cat = $this->infocategorymodel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_inv->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editpackagedisc('" .$list->kode_pembayaran. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletepackagedisc('" .$list->kode_pembayaran. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                if ($list->status_pembayaran == 'settlement')
                                {
                                    $status = "<span style='color:#2dce89;'>". $list->status_pembayaran ."</span";
                                }
                                else
                                {
                                    $status = "<span style='color:#f5365c;'>". $list->status_pembayaran ."</span";
                                }

                                $row[] = $no;
                                $row[] = date("d/m/Y h:m:s", strtotime($list->created_at));
                                $row[] = $list->kode_pembayaran;
                                $row[] = $list->id_user;
                                $row[] = $list->email_user;
                                $row[] = $list->ref_code;
                                $row[] = $list->nama_paket;
                                
                                $durasi = floor(($list->total + $list->disc_val) / $list->harga_paket);
                                $langganan = $list->langganan == "tahun" ? "1 tahun" : $durasi . " bulan";
                                $row[] = $langganan;

                                $row[] = "Rp " . number_format($list->total, 0, ',', '.');
                                $row[] = $list->pay_method;
                                $row[] = $list->expire_date;
                                $row[] = $status;
                                // $row[] = $tomboledit;
                                //$row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_inv->count_all(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
                            "recordsFiltered" => $m_inv->count_filtered(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
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

    public function filterdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $validationCheck = $this->validate([
                    'billinginv_filterstdate' => [
                        'label' => 'Tanggal Awal',
                        'rules' => [
                            'required',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                        ],
                    ],
    
                    'billinginv_filtereddate' => [
                        'label' => 'Tanggal Akhir',
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
						"featurestsakti_kode" => $this->validation->getError('featurestsakti_kode'),
                        "featurestsakti_nama" => $this->validation->getError('featurestsakti_nama'),
                        "featurestsakti_files" => $this->validation->getError('featurestsakti_files'),
					]
				];
			}
			else
			{
                $request = Services::request();
                // $stdate = $this->request->getVar('stdate');
			    // $eddate = $this->request->getVar('eddate');

                $stdate = date("Y-m-d", strtotime($this->request->getVar('billinginv_filterstdate')));
			    $eddate = date("Y-m-d", strtotime($this->request->getVar('billinginv_filtereddate')));

                // echo json_encode($stdate); die;

                $m_inv   = new InvoiceModel($request, $stdate, $eddate);

                // $m_cat = $this->infocategorymodel($request);

                // if($request->getMethod(true)=='POST'){
                    $lists = $m_inv->get_datatables();
                    $data = [];
                    $no = $request->getPost("start");

                    foreach ($lists as $list) {
                            $no++;
                            $row = [];

                            $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                            onclick=\"editpackagedisc('" .$list->kode_pembayaran. "')\">
                                            <i class=\"fa fa-edit\"></i></button>";

                            $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                            onclick=\"deletepackagedisc('" .$list->kode_pembayaran. "')\"> 
                                            <i class=\"fa fa-trash\"></i></button>";

                            if ($list->status_pembayaran == 'settlement')
                            {
                                $status = "<span style='color:#2dce89;'>". $list->status_pembayaran ."</span";
                            }
                            else
                            {
                                $status = "<span style='color:#f5365c;'>". $list->status_pembayaran ."</span";
                            }

                            $row[] = $no;
                            $row[] = date("d/m/Y h:m:s", strtotime($list->created_at));
                            $row[] = $list->kode_pembayaran;
                            $row[] = $list->id_user;
                            $row[] = $list->email_user;
                            $row[] = $list->ref_code;
                            $row[] = $list->nama_paket;
                            
                            $durasi = floor(($list->total + $list->disc_val) / $list->harga_paket);
                            $langganan = $list->langganan == "tahun" ? "1 tahun" : $durasi . " bulan";
                            $row[] = $langganan;

                            $row[] = "Rp " . number_format($list->total, 0, ',', '.');
                            $row[] = $list->pay_method;
                            $row[] = $list->expire_date;
                            $row[] = $status;
                            // $row[] = $tomboledit;
                            //$row[] = $tomboledit . ' ' . $tombolhapus;
                            $data[] = $row;
                    }
                
                    $output = [
                        "draw" => $request->getPost('draw'),
                        "recordsTotal" => $m_inv->count_all(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
                        "recordsFiltered" => $m_inv->count_filtered(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
                        "data" => $data,
                    ];         
                    
                    echo json_encode($output);
            }
        }
    }

    public function proses() {
        $stdate = $this->request->getVar('billinginv_exportstdate');
		$eddate = $this->request->getVar('billinginv_exporteddate');
        // $stdate = date("m/01/Y");
		// $eddate = date("m/d/Y");

        $request = Services::request();
        $m_inv  = new InvoiceModel($request, date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate)));
        $filter = $m_inv->getDataFilter(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate)));

        // echo json_encode($filter); die;

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
                    'rgb' => 'ff9800'
                ]
            ],
            'alignment'=>[
                'horizontal' => Alignment::HORIZONTAL_LEFT
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
                    ->setWidth(30);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(15);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(30);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setWidth(25);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setWidth(20);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setWidth(20);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('I')
                    ->setWidth(20);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('J')
                    ->setWidth(20);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('K')
                    ->setWidth(20);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('L')
                    ->setWidth(20);

        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Tgl Terbit')
                    ->setCellValue('C1', 'Kode Pembayaran')
                    ->setCellValue('D1', 'ID User')
                    ->setCellValue('E1', 'Email')
                    ->setCellValue('F1', 'Kode Ref')
                    ->setCellValue('G1', 'Paket')
                    ->setCellValue('H1', 'Berlangganan')
                    ->setCellValue('I1', 'Total')
                    ->setCellValue('J1', 'Metode Pembayaran')
                    ->setCellValue('K1', 'Expire Date')
                    ->setCellValue('L1', 'Status Pembayaran');


        // STYLE judul table
        $spreadsheet->getActiveSheet()
                    ->getStyle('A1:L1')
                    ->applyFromArray($styleJudul);
        
        $no = 1;
        $column = 2;
        // tulis data ke cell
        foreach($filter as $data) {
            $durasi = floor(($data['total'] + $data['disc_val']) / $data['harga_paket']);
            $langganan = $data['langganan'] == "tahun" ? "1 tahun" : $durasi . " bulan";
            $tgl = date("d/m/Y h:m:s", strtotime($data['created_at']));
            $total_tagihan = 'Rp'.number_format($data['total'], 0, ',', '.');

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no)
                        ->setCellValue('B' . $column, $tgl)
                        ->setCellValue('C' . $column, $data['kode_pembayaran'])
                        ->setCellValue('D' . $column, $data['id_user'])
                        ->setCellValue('E' . $column, $data['email_user'])
                        ->setCellValue('F' . $column, $data['ref_code'])
                        ->setCellValue('G' . $column, $data['nama_paket'])
                        ->setCellValue('H' . $column, $langganan)
                        ->setCellValue('I' . $column, $total_tagihan)
                        ->setCellValue('J' . $column, $data['pay_method'])
                        ->setCellValue('K' . $column, $data['expire_date'])
                        ->setCellValue('L' . $column, $data['status_pembayaran']);


            $column++;
            $no++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Invoice';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}