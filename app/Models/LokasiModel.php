<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class LokasiModel extends Model {
	protected $table			= 't_lokasi_pekerjaan';
	protected $primaryKey		= 'id_lokasi_pekerjaan';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['id_lokasi_pekerjaan', 'lokasi_pekerjaan'];
	protected $request;
    protected $db;
    protected $dt;
}
?>