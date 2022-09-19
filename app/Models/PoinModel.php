<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PoinModel extends Model {
	protected $table			= 't_poin';
	protected $primaryKey		= 'id_poin';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['kode_referal', 'kode_user', 'kode_harga_paket', 'reward_poin', 'insert_date'];
	protected $request;
    protected $db;
    protected $dt;
}
?>