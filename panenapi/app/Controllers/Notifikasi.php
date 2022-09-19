<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Notifikasi extends BaseController
{
	use ResponseTrait;
	
	// function sendNotif(){
	// 	$key = $this->myKey();
		
    //     $authHeader = $this->request->getHeader("X-Auth");
	// 	if ($authHeader != '')
	// 	{
	// 		$authHeader = $authHeader->getValue();
	// 		$token = $authHeader;
	// 	}
	// 	else
	// 	{
	// 		$response = [
    //             'status' => 401,
    //             'error' => TRUE,
    //             'messages' => 'Access denied'
    //         ];
    //         return $this->respondCreated($response);
	// 	}
        
    //     try {
    //         $decoded = JWT::decode($token, $key, array("HS256"));

    //         if ($decoded) {
	// 			// Entry Notifikasi
	// 			$title = $this->request->getVar('title');
    //     		$body = $this->request->getVar('body');
    //     		$type_notif = $this->request->getVar('type_notif');
	// 			$topic = $this->request->getVar('topic');
	// 			$token = $this->request->getVar('token');
				
	// 			// Entry Data
	// 			$type = $this->request->getVar('type');
	// 			$documentID = $this->request->getVar('document_id');
	// 			$categoryName = $this->request->getVar('category_name');
				
	// 			$firebase = service('firebase');
	// 			$messaging = $firebase->messaging;
				
	// 			if ($type_notif == "topic")
	// 			{
	// 				$target = $topic;
	// 			}
	// 			else
	// 			{
	// 				$target = $token;
	// 			}
				
	// 			switch ($type) {
	// 				case 'news' :
	// 				case 'event' :
	// 				case 'edukasi' :
	// 					$data = [
	// 						'type' => $type,
	// 						'documentID' => $documentID,
	// 						'categoryName' => $categoryName,
	// 					];
	// 				break;
	// 				default :
	// 					$data = [
	// 						'type' => $type,
	// 					];
	// 				break;
	// 			}
				
	// 			$info = [
	// 				'type_notif' => $type_notif, 
	// 				'target'	 => $target,
	// 			];

	// 			$notification = Notification::fromArray([
	// 				'title' => $title,
	// 				'body'  => $body,
	// 			]);
				
	// 			$message = CloudMessage::withTarget($type_notif, $target)
	// 						->withNotification($notification)
	// 						->withData($data);

	// 			$messaging->send($message);
				
	// 			$response = [
	// 						'status' => 200,
	// 						'error' => FALSE,
	// 						'messages' => 'Notifikasi terkirim',
	// 						'target' => $info,
	// 						'notification' => $notification,
	// 						'data'	=> $data,
	// 					];
	// 			return $this->respondCreated($response);
    //         }
    //     } catch (Exception $ex) {
    //         $response = [
    //             'status' => 401,
    //             'error' => TRUE,
    //             'messages' => 'Access denied'
    //         ];
    //         return $this->respondCreated($response);
    //     }
	// }

	function sendNotif(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '') {
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		} else {
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
				// Entry Notifikasi
				$title = $this->request->getVar('title');
        		$body = $this->request->getVar('body');
        		$type_notif = $this->request->getVar('type_notif');
				$topic = $this->request->getVar('topic');
				$token = $this->request->getVar('token');
				
				// Entry Data
				$type = $this->request->getVar('type');
				$documentID = $this->request->getVar('document_id');
				$categoryName = $this->request->getVar('category_name');
				
				$firebase = service('firebase');
				$messaging = $firebase->messaging;
				
				if ($type_notif == "topic") {
					$target = $topic;
				}
				else {
					$target = $token;
				}
				
				switch ($type) {
					case 'news' :
					case 'event' :
					case 'edukasi' :
						$data = [
							'type' => $type,
							'documentID' => $documentID,
							'categoryName' => $categoryName,
						];
					break;
					default :
						$data = [
							'type' => $type,
						];
					break;
				}
				
				$info = [
					'type_notif' => $type_notif, 
					'target'	 => $target,
				];

				$notification = Notification::fromArray([
					'title' => $title,
					'body'  => $body,
				]);
				
				$message = CloudMessage::withTarget($type_notif, $target)
							->withNotification($notification)
							->withData($data);

				$messaging->send($message);
				
				$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Notifikasi terkirim',
							'target' => $info,
							'notification' => $notification,
							'data'	=> $data,
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