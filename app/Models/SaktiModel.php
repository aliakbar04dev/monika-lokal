<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class SaktiModel extends Model {
	protected $table			= 't_sakti';
	protected $primaryKey		= 'kode_tsakti';
	protected $returnType		= 'array';
	protected $allowedFields 	= '';
	protected $request;
    protected $db;
    protected $dt;
	
	public function getalljnssakti(){
		$db = \Config\Database::connect();
		$builder = $db->table('jenis_tsakti');
		
		return $builder->get()->getResult();
	}
	
	public function getnewdata(){
		return $this->orderBy('tanggal_input','DESC')->findAll(15,0);
	}
}
?>