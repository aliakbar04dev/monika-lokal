<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class TrailingCloseModel extends Model {
	protected $table			= 't_trailingclosed';
	protected $primaryKey		= 'kode_trailingclose';
}
?>