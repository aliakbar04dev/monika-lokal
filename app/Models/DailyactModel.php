<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DailyactModel extends Model {
	protected $table			= 't_dailyact';
	protected $primaryKey		= 'kode_dailyact';
}
?>