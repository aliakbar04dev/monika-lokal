<?php 
namespace App\Models\Features;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PoinModel extends Model {
    protected $table = 'm_referal';
    protected $primaryKey = 'kode_referal';
	
	public function getData($stdate, $eddate)
	{
		$this->db = db_connect();
		//$query = $this->db->query("call proc_viewpoin('$stdate 00:00:00', '$eddate 23:59:59')");
		
		$query = $this->db->query("SELECT m_referal.*, IFNULL(p.reward_poin, 0) AS reward_poin
									FROM m_referal
									LEFT JOIN ( SELECT t_poin.kode_referal, (SUM(t_poin.reward_poin)) reward_poin
									FROM t_poin
									WHERE t_poin.insert_date BETWEEN '$stdate 00:00:00' AND '$eddate 23:59:59'
									GROUP BY t_poin.kode_referal
									) p ON m_referal.kode_referal = p.kode_referal
									ORDER BY p.reward_poin DESC;");
		
		return $query->getResult();
	}
	
	public function getDetailData($kode, $stdate, $eddate)
	{
		$this->db = db_connect();
		//$query = $this->db->query("call proc_viewdetailpoin('$kode', '$stdate 00:00:00', '$eddate 23:59:59')");
		
		$query = $this->db->query("SELECT t.*, u.nama_lengkap, h.title FROM t_poin t
									LEFT JOIN t_user u ON t.kode_user = u.kode_user
									LEFT JOIN harga_paket h ON t.kode_harga_paket = h.kode_harga_paket
									WHERE t.kode_referal = '$kode' AND t.insert_Date BETWEEN '$stdate 00:00:00' AND '$eddate 23:59:59';");
		
		return $query->getResult();
	}
	
    function getDataFilter($stdate, $eddate){
        $this->db = db_connect();
        //$query = $this->db->query("call proc_viewpoin('$stdate 00:00:00', '$eddate 23:59:59')");
		$query = $this->db->query("SELECT m_referal.*, IFNULL(p.reward_poin, 0) AS reward_poin
									FROM m_referal
									LEFT JOIN ( SELECT t_poin.kode_referal, (SUM(t_poin.reward_poin)) reward_poin
									FROM t_poin
									WHERE t_poin.insert_date BETWEEN '$stdate 00:00:00' AND '$eddate 23:59:59'
									GROUP BY t_poin.kode_referal
									) p ON m_referal.kode_referal = p.kode_referal
									ORDER BY p.reward_poin DESC;");

        return $query->getResultArray();
    }
}