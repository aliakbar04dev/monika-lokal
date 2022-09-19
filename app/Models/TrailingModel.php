<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class TrailingModel extends Model {
	protected $table			= 't_trailing';
	protected $primaryKey		= 'kode_trailing';
}
?>