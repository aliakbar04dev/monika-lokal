<?php namespace App\Controllers;

use App\Models\MainModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Api extends BaseController
{
	use ResponseTrait;
	
	public function index()
	{
		return view('welcome_message');
	}

	public function token()
    {
        $mainModel = new MainModel();

        $userdata = $mainModel->where("email", $this->request->getVar("email"))->first();

        if (!empty($userdata)) {

            if ($userdata['password'] == md5($this->request->getVar("password"))) {

                $key = $this->myKey();

                // $iat = time();
                // $date = new DateTime();
                // $iat = $date->getTimestamp();
                $iat = strtotime("now");
                $nbf = $iat + 10;
                $exp = $iat + 31557600000;

                $payload = array(
                    "iss" => "PanenSahamApi",
                    "aud" => "MonikaMobile",
                    "iat" => $iat,
                    "nbf" => $nbf,
                    "exp" => $exp,
                    "data" => $userdata,
                );

                $token = JWT::encode($payload, $key);

                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'User logged In successfully',
                    'token' => $token
                ];
                return $this->respondCreated($response);
            } else {

                $response = [
                    'status' => 500,
                    'error' => TRUE,
                    'messages' => 'Incorrect details'
                ];
                return $this->respondCreated($response);
            }
        } else {
            $response = [
                'status' => 500,
                'error' => TRUE,
                'messages' => 'User not found'
            ];
            return $this->respondCreated($response);
        }
    }
	
	/* function myKey()
	{
		return "PanenSahamSecret123$$";
	} */
	
	public function userDetail()
    {
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

                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'User details',
                    'data' => $decoded
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
	
	public function getUpdateFotoProfile()
    {
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
				$data = array(
					"android" => true,
					"ios" => false,
				);
				
                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Payment status',
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
	//--------------------------------------------------------------------

}
