<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

	class FactsheetwebModel extends Model {
		protected $table			= 'factsheet';
		protected $primaryKey		= 'kode_factsheet';
	}
?>