<?php 
namespace App\Controllers\Chart;
use App\Controllers\BaseController;
use App\Models\Chart\ChartTaModel;

class ChartTaController extends BaseController
{
	public function index() {
        $chartTa = new ChartTaModel();
		
		$data = $chartTa->findAll();
		
		$response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Chart TA',
                    'data' => $data
                ];
				
        echo json_encode($response);
    }
}