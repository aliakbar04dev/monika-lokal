<?php
namespace App\Controllers;

use App\Models\RegisModel;
use App\Models\RefModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
//use App\Libraries\Facebook;

require_once 'public/assets/google-api-php-client/vendor/autoload.php';
require_once 'public/assets/facebook-api-client/src/Facebook/autoload.php';

class Newlogin extends BaseController
{
    protected $regisModel;
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->regisModel = new RegisModel();
        $this->user = new UserModel();
        $this->ref = new RefModel();

        // Load facebook oauth library 
        //$this->facebook = new Facebook();
    }

    public function index()
    {
        $email = getsession('email');
        // echo json_encode($email); die;
        if (!hassession('email')) {
            if (!session_id()) {
				session_start();
			}

            $fb = new \Facebook\Facebook([
                'app_id' => FB_APP_ID, // Replace {app-id} with your app id
                'app_secret' => FB_APP_SECRET,
                'default_graph_version' => 'v11.0',
            ]);
              
            $helper = $fb->getRedirectLoginHelper();
              
            $permissions = ['email']; // Optional permissions
            $callbackUrl = htmlspecialchars(base_url('facebookcalback'));
            $loginUrl = $helper->getLoginUrl($callbackUrl,$permissions);
              
            $data['authURL'] =  $loginUrl;

            if (getsession('fb_failed_account') != '') {
				$data['fb_failed_account'] = true;

				$this->session->remove('fb_failed_account');
			}

			if (getsession('fb_failed_email') != '') {
				$data['fb_failed_email'] = true;

				$this->session->remove('fb_failed_email');
			}

            if (getsession('fb_registered_account') != '') {
				$data['fb_registered_account'] = true;

				$this->session->remove('fb_registered_account');
			}

            if (getsession('fb_failed_email_verifikasi') != '') {
				$data['fb_failed_email_verifikasi'] = true;

				$this->session->remove('fb_failed_email_verifikasi');
			}

            $this->session->remove('viapembelian');

            return view('login/new_login', $data);
        } else {
            return redirect()->to('/');
        }
    }
}