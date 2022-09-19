<?php 
namespace App\Models\Billing;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class InvoiceModel extends Model {
    protected $table = 't_pembayaran';
    protected $primaryKey = 'kode_pembayaran';
    protected $allowedFields = ['kode_pembayaran', 'id_user', 'email_user', 'ref_code', 'nama_paket', 'langganan', 'total', 'created_at', 'pay_method', 'expire_date', 'status_pembayaran', 'disc_val'];
    protected $column_order = array('', 'kode_pembayaran', 'id_user', 'email_user', 'ref_code', 'nama_paket', 'langganan', 'total', 'created_at', 'pay_method', 'expire_date', 'status_pembayaran', 'disc_val', '');
    protected $column_search = array('kode_pembayaran', 'id_user', 'email_user', 'ref_code', 'nama_paket', 'langganan', 'total', 'created_at', 'pay_method', 'expire_date', 'status_pembayaran', 'disc_val');
    protected $order = array('created_at' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request, $datest, $dateed){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)->where('created_at >=', $datest . ' 00:00:00')
                                                  ->where('created_at <=', $dateed . ' 23:59:59');
    }

    function getDataFilter($datest, $dateed){
        return $this->db->table($this->table)
                        ->where('created_at >=', $datest . ' 00:00:00')
                        ->where('created_at <=', $dateed . ' 23:59:59')->get()->getResultArray();
    }


    private function _get_datatables_query(){
        $i = 0;
        foreach ($this->column_search as $item){
            if(isset($this->request->getPost('search')['value'])){ 
                if($i===0){
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                }
                else{
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }
         
        if($this->request->getPost('order')){
                $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
            } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables(){
        $this->_get_datatables_query();
        if($this->request->getPost('length') != -1)
        $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    // function count_filtered(){
    //     $this->_get_datatables_query();
    //     return $this->dt->countAllResults();
    // }

    // public function count_all(){
    //     $tbl_storage = $this->db->table($this->table);
    //     return $tbl_storage->countAllResults();
    // }

    function count_filtered($datest, $dateed){
        $this->_get_datatables_query();
        return $this->dt->WHERE('created_at >=', $datest . ' 00:00:00')
        ->WHERE('created_at <=', $dateed . ' 23:59:59')->countAllResults();
    }

    public function count_all($datest, $dateed){
        $tbl_storage = $this->db->table($this->table)->WHERE('created_at >=', $datest . ' 00:00:00')
        ->WHERE('created_at <=', $dateed . ' 23:59:59');
        return $tbl_storage->countAllResults();
    }
}