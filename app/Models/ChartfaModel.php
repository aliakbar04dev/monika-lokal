<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ChartfaModel extends Model {
	protected $table			= 'm_chart_fa';
	protected $primaryKey		= 'id_chart';
	protected $returnType		= 'array';
	protected $allowedFields 	= [];
	protected $request;
    protected $db;
    protected $dt;
}
?>