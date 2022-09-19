<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class TestimonikModel extends Model {
	protected $table			= 't_testimoni_karir';
	protected $primaryKey		= 'id_testimoni';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['nama', 'divisi', 'testimoni', 'foto', 'is_highlight', 'publish', 'create_at'];
	protected $request;
    protected $db;
    protected $dt;
}
?>