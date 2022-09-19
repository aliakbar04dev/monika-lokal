<?php 
namespace App\Controllers\Features;
use App\Controllers\BaseController;
use App\Models\Features\PoinModel;
use Config\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Poincontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
			$model = new PoinModel();
			$stdate = date("m/01/Y");
			$eddate = date("m/d/Y");
			$data = [
                'all_poin' => $model->getData(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
				'start_date' => $stdate,
				'end_date' => $eddate,
            ];
			//dd($data);
            return view('menufeatures/view_poin', $data);
			
			//return view('menufeatures/view_poin');
        }
    }
	
	public function filterdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $model = new PoinModel();
			$stdate = $this->request->getVar('featurespoin_filterstdate');
			$eddate = $this->request->getVar('featurespoin_filtereddate');
			$data = [
				'all_poin' => $model->getData(date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
				'start_date' => $stdate,
				'end_date' => $eddate,
			];
				//dd($data);
			return view('menufeatures/view_poin', $data);
        }
    }

	public function detaildata() {
		if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $model = new PoinModel();
			$kode = $this->request->getGet('kode');
			$stdate = $this->request->getGet('stdate');
			$eddate = $this->request->getGet('eddate');
			$data = [
				'detail_poin' => $model->getDetailData($kode, date("Y-m-d", strtotime($stdate)), date("Y-m-d", strtotime($eddate))),
				'start_date' => $stdate,
				'end_date' => $eddate,
				'kode' => $kode,
			];
				//dd($data);
			return view('menufeatures/view_detailpoin', $data);
        }
	}
   
	public function proses() {
        $stdate = $this->request->getVar('featurespoin_exportstdate');
		$eddate = $this->request->getVar('featurespoin_exporteddate');
        // $stdate = date("m/01/Y");
		// $eddate = date("m/d/Y");
		$model = new PoinModel();
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
                    ->setWidth(15);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(35);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(45);
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(8);

        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Kode Referal')
                    ->setCellValue('C1', 'Nama Referal')
                    ->setCellValue('D1', 'Jabatan')
                    ->setCellValue('E1', 'Total Poin');

        // STYLE judul table
        $spreadsheet->getActiveSheet()
                    ->getStyle('A1:E1')
                    ->applyFromArray($styleJudul);
        
        $no = 1;
        $column = 2;
        // tulis data ke cell
        foreach($filter as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no)
                        ->setCellValue('B' . $column, $data['kode_referal'])
                        ->setCellValue('C' . $column, $data['nama'])
                        ->setCellValue('D' . $column, $data['jabatan'])
                        ->setCellValue('E' . $column, $data['reward_poin']);
            $column++;
            $no++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Poin Reward';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}