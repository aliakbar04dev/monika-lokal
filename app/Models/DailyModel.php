<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DailyModel extends Model {
	protected $table			= 't_daily';
	protected $primaryKey		= 'kode_daily';
}
?>