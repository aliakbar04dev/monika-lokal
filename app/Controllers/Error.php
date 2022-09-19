<?php
	
namespace App\Controllers;

class Error extends BaseController
{
    public function index()
    {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function maintenance(){
        return view('errors/maintenance');
    }

}
?>