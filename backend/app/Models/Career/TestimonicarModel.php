<?php 
namespace App\Models\Career;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class TestimonicarModel extends Model {
    protected $table = 't_testimoni_karir';
    protected $primaryKey = 'id_testimoni';
    protected $allowedFields = ['id_testimoni', 'nama', 'divisi', 'testimoni', 'foto', 'is_highlight', 'publish'];
    protected $column_order = array('', 'foto', 'nama','divisi', 'is_highlight', 'publish', '');
    protected $column_search = array('foto', 'nama','divisi', 'is_highlight', 'publish');
    protected $order = array('id_testimoni' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    public function getkodetype(){
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    public function getLastData() {
        $query = $this->dt->selectMax('id_testimoni', 'kode')->get();

        return $query->getRow();
    }

    private function _get_datatables_query(){
        $i = 0;
        foreach ($this->column_search as $item){
            if($this->request->getPost('search')['value']){ 
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

    function count_filtered(){
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }

    public function count_all(){
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}