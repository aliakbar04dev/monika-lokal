<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DataModel extends Model {
	protected $table			= 't_wtcdata';
	protected $primaryKey		= 'kode_wtcdata';
}
?>