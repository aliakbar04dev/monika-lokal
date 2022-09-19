<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class CloseModel extends Model {
	protected $table			= 't_closepos';
	protected $primaryKey		= 'kode_closepos';
}
?>