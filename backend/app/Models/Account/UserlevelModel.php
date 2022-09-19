<?php 
namespace App\Models\Account;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class UserlevelModel extends Model {
    protected $table = 'm_user_level';
    protected $primaryKey = 'kode_user_level';
    protected $allowedFields = ['kode_user_level', 'nama_level', 'alias_level'];
    protected $column_order = array('', 'kode_user_level','nama_level', 'alias_level', '');
    protected $column_search = array('kode_user_level','nama_level', 'alias_level');
    protected $order = array('kode_user_level' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }
	
	public function getkodeall(){
        $query = $this->dt->get();
        return $query->getResultArray();
    }
	
	public function getlvlall(){
        $query = $this->dt->where('kode_user_level !=', 'MULV006')->get();
        return $query->getResultArray();
    }

    public function checkalias($kode){
        return $this->where(['kode_user_level' => $kode])->find();
    }

    public function getkodeuser(){
        $query = $this->dt->whereNotIn('alias_level', ['Admin'])->get();
        return $query->getResultArray();
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