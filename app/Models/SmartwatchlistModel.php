<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

	class SmartwatchlistModel extends Model {
		protected $table = 'tr_smartwatchlist';
		protected $primaryKey = 'id';
		protected $allowedFields = ['id', 'kode_user', 'code', 'timeframe'];

	}
?>