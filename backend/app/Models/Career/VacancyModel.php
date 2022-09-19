<?php 
namespace App\Models\Career;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class VacancyModel extends Model {
    protected $table = 't_karir';
    protected $primaryKey = 'id_karir';
    protected $allowedFields = ['id_karir', 'karir', 'id_lokasi_pekerjaan','id_departemen','id_kategori_pekerjaan','deskripsi_karir','requirement','benefit_karir','publish'];
    protected $column_order = array('', 'id_karir','karir', 'lokasi_pekerjaan', 'nama_departemen', 'kategori_pekerjaan', 'deskripsi_karir', 'benefit_karir',
									'publish', '');
    protected $column_search = array('id_karir','karir','lokasi_pekerjaan','nama_departemen','kategori_pekerjaan','deskripsi_karir','benefit_karir','publish');
    protected $order = array('id_karir' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)->select('*')->join('t_lokasi_pekerjaan', 
                        't_karir.id_lokasi_pekerjaan = t_lokasi_pekerjaan.id_lokasi_pekerjaan')
						->join('t_departemen', 
                        't_karir.id_departemen = t_departemen.id_departemen')
						->join('t_kategori_pekerjaan', 
                        't_karir.id_kategori_pekerjaan = t_kategori_pekerjaan.id_kategori_pekerjaan');
    }

    public function getkodetype(){
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    public function getLastData() {
        $query = $this->dt->selectMax('id_karir', 'kode')->get();

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