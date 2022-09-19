<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Landing_page extends BaseController
{
    public function index()
    {
		if(!hassession('email')){
			$data = '';
			
			if(getsession('aktivasi') != ''){
				
			}
			
			return view('/landingpage/view_landing_page',$data);
		}else{
			return view('chart/view_chart');
		}
    }
}
