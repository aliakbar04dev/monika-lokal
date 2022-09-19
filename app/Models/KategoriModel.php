<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class KategoriModel extends Model {
	protected $table			= 't_kategori_pekerjaan';
	protected $primaryKey		= 'id_kategori_pekerjaan';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['id_kategori_pekerjaan', 'kategori_pekerjaan'];
	protected $request;
    protected $db;
    protected $dt;
}
?>