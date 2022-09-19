<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class SeenModel extends Model {
	protected $table			= 't_seen_notif';
	protected $primaryKey		= 'kode_notif';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['id_seen', 'id_notif', 'email', 'is_seen'];
	protected $request;
    protected $db;
    protected $dt;
}
?>