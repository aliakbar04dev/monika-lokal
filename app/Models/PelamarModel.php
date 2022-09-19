<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PelamarModel extends Model {
	protected $table			= 't_pelamar';
	protected $primaryKey		= 'id_pelamar';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['id_pelamar', 'nama_pelamar', 'no_hp', 'email', 'dokumen', 'id_karir', 'create_at'];
	protected $request;
    protected $db;
    protected $dt;
}
?>