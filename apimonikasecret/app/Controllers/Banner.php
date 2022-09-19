<?php namespace App\Controllers;

use App\Models\BannerModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Banner extends BaseController
{
	use ResponseTrait;
	
	function getAll(){
	
        $bannerModel = new BannerModel();

        $data = $bannerModel->where("status", 1)->orderBy('id_banner', 'DESC')->findAll();

        $response = [
            'status' => 200,
            'messages' => 'Data Banner',
            'data' => $data
        ];
        return $this->respondCreated($response);
     
	}
}