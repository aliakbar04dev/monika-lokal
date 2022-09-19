<?php 
namespace App\Controllers\Chart;
use App\Controllers\BaseController;
use App\Models\Chart\IntervalTaModel;

class IntervalTaController extends BaseController
{
	public function index() {
        $intTa = new IntervalTaModel();
		
		$data = $intTa->findAll();
		
		$response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Interval TA',
                    'data' => $data
                ];
				
        echo json_encode($response);
    }
}