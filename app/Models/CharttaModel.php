<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class CharttaModel extends Model {
	protected $table			= 'm_chart_ta';
	protected $primaryKey		= 'id_chart';
	protected $returnType		= 'array';
	protected $allowedFields 	= [];
	protected $request;
    protected $db;
    protected $dt;
}
?>