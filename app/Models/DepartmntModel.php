<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DepartmntModel extends Model {
	protected $table			= 't_departemen';
	protected $primaryKey		= 'id_departemen';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['id_departemen', 'nama_departemen'];
	protected $request;
    protected $db;
    protected $dt;
}
?>