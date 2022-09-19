<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class RefModel extends Model {
	protected $table			= 'm_referal';
	protected $primaryKey		= 'kode_referal';
	protected $returnType		= 'array';
	protected $allowedFields 	= '';
	protected $request;
    protected $db;
    protected $dt;
}
?>