<?php namespace App\Controllers;

use App\Models\TutorialModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Tutorial extends BaseController
{
	use ResponseTrait;
	
	function getAllTutorial(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$tutorialModel = new TutorialModel();
				
                $data = $tutorialModel->orderBy('id_tutorial','DESC')
                                      ->findAll();

                if (empty($data)) {
                    $response = [
                        'status' => 401,
                        'error' => TRUE,
                        'messages' => 'Data not found'
                    ];
                    return $this->respondCreated($response);
                }
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Tutorial',
                    'data' => $data
                ];
                return $this->respondCreated($response);
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	function getTutorialByLimit(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$tutorialModel = new TutorialModel();
                $keyword = $this->request->getGet("keyword");
                $limit = $this->request->getGet("limit");
                $offset = $this->request->getGet("offset");

                if (!empty($keyword))
                {
                    $data = $tutorialModel->orderBy('id_tutorial','DESC')
                                            ->like("title", $keyword, 'both')
                                            ->limit($limit, $offset)
                                            ->find();
                }
                else
                {
                    $data = $tutorialModel->orderBy('id_tutorial','DESC')
                                            ->limit($limit, $offset)
                                            ->find();
                }

                if (empty($data)) {
                    $response = [
                        'status' => 401,
                        'error' => TRUE,
                        'messages' => 'Data not found'
                    ];
                    return $this->respondCreated($response);
                }
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Tutorial',
                    'data' => $data
                ];
                return $this->respondCreated($response);
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

    function getTutorialById(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$tutorialModel = new TutorialModel();
                $category = $this->request->getGet("id_tutorial");

                $data = $tutorialModel->where("id_tutorial", $category)
                                      ->find();

                if (empty($data)) {
                    $response = [
                        'status' => 401,
                        'error' => TRUE,
                        'messages' => 'Data not found'
                    ];
                    return $this->respondCreated($response);
                }
		
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Data Tutorial',
                    'data' => $data
                ];
                return $this->respondCreated($response);
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
}