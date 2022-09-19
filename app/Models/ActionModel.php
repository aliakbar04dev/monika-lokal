<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ActionModel extends Model {
	protected $table			= 't_wtcaction';
	protected $primaryKey		= 'kode_wtcaction';
}
?>