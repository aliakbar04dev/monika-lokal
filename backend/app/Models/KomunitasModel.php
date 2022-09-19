<?php namespace App\Models;
use CodeIgniter\Model;

class KomunitasModel extends Model {
    protected $table = 'account';
	
	public function check($clientid){
        return $this->where('client_id' => $clientid)->find();
    }
}