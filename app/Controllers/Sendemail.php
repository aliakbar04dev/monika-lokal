<?php

namespace App\Controllers;

class Sendemail extends BaseController
{
    public function __construct()
    {
        $this->email = \Config\Services::email();
    }
    public function index()
    {
        // return view('/landingpage/view_landing_page');
        // // echo 'tes landing page';
        $this->email->setFrom('no-reply@panensaham.com', 'No-reply Panensaham');
        //$this->email->setFrom('ahmad@jsm.co.id', 'Ahmad Sudaryono');
        $this->email->setTo('muhammadyusran95@gmail.com, soleh.fuddin@gmail.com, ahmad.sudaryono1@gmail.com,peternicosetiawan@gmail.com');
        $this->email->setSubject('Test Email no-reply PanenSaham');
        $this->email->setMessage('/email');

        if (!$this->email->send()) {
            return false;
        } else {
            return true;
        }
    }

    //--------------------------------------------------------------------

}
