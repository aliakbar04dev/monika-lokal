<?php 
namespace App\Models\Features;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ReferalModel extends Model {
    protected $table = 't_user';
    protected $primaryKey = 'kode_user';
	
	public function getData($stdate, $eddate)
	{
		$this->db = db_connect();

		$query = $this->db->query("SELECT a.*, b.nama as nm_referal
									FROM t_user a LEFT JOIN m_referal b ON a.kode_referal=b.kode_referal 
									WHERE a.kode_referal != '' AND
									a.created_at BETWEEN '$stdate 00:00:00' AND '$eddate 23:59:59'
									ORDER BY a.created_at DESC");
		
		return $query->getResult();
	}
	
    function getDataFilter($stdate, $eddate){
        $this->db = db_connect();
		
		$query = $this->db->query("SELECT a.*, b.nama as nm_referal
									FROM t_user a LEFT JOIN m_referal b ON a.kode_referal=b.kode_referal
									WHERE a.kode_referal != '' AND
									a.created_at BETWEEN '$stdate 00:00:00' AND '$eddate 23:59:59'
									ORDER BY a.created_at DESC");

        return $query->getResultArray();
    }
}