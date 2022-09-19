<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

	class OpenModel extends Model {
		protected $table			= 't_openpos';
		protected $primaryKey		= 'kode_openpos';
	}
?>