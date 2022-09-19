<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DailyclosedwebModel extends Model {
	protected $table			= 't_dailyclosed';
	protected $primaryKey		= 'kode_dailyclosed';
}
?>