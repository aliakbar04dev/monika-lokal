<?php 
namespace App\Controllers\Features;
use App\Controllers\BaseController;
use App\Models\Features\ReferalModel;
use Config\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Referalcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
			$model = new ReferalModel();
			$stdate = date("m/01/Y");
			$eddate = date("m/d/Y");
			$data = [
                'all_data' => $model->getData(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
				'start_date' => $stdate,
				'end_date' => $eddate,
            ];
            return view('menufeatures/view_referal', $data);
        }
    }
	
	public function filterdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $model = new ReferalModel();
			$stdate = $this->request->getVar('featurespoin_filterstdate');
			$eddate = $this->request->getVar('featurespoin_filtereddate');
			$data = [
				'all_data' => $model->getData(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
				'start_date' => $stdate,
				'end_date' => $eddate,
			];
			return view('menufeatures/view_referal', $data);
        }
    }
   
	public function proses() {
        $stdate = $this->request->getVar('featuresreferal_exportstdate');
		$eddate = $this->request->getVar('featuresreferal_exporteddate');
		$model = new ReferalModel();
        $filter = $model->getDataFilter(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate)));

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
                    'rgb' => '4caf50'
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
                    ->setWidth(25);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(40);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(15);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(8);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setWidth(10);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setWidth(25);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setWidth(5);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('I')
                    ->setWidth(10);

        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Fullname')
                    ->setCellValue('C1', 'Email')
                    ->setCellValue('D1', 'No Hp')
                    ->setCellValue('E1', 'Kode Referal')
                    ->setCellValue('F1', 'Nama Referal')
                    ->setCellValue('G1', 'Created On')
                    ->setCellValue('H1', 'Is Verif')
                    ->setCellValue('I1', 'Kode User Level');

        // STYLE judul table
        $spreadsheet->getActiveSheet()
                    ->getStyle('A1:I1')
                    ->applyFromArray($styleJudul);
        
        $no = 1;
        $column = 2;
        // tulis data ke cell
        foreach($filter as $data) {
            $tgl = date("d-m-Y", strtotime($data['created_at']));
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no)
                        ->setCellValue('B' . $column, $data['nama_lengkap'])
                        ->setCellValue('C' . $column, $data['alamat_email'])
                        ->setCellValue('D' . $column, $data['no_hp'])
                        ->setCellValue('E' . $column, $data['kode_referal'])
                        ->setCellValue('F' . $column, $data['nm_referal'])
                        ->setCellValue('G' . $column, $tgl)
                        ->setCellValue('H' . $column, $data['is_verif'])
                        ->setCellValue('I' . $column, $data['kode_user_level']);
            $column++;
            $no++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Referal Register';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}