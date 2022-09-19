<?php

namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contact_us';
    protected $allowedFields=['nama','email', 'no_hp', 'isi_pesan'];
	
	function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }
}
