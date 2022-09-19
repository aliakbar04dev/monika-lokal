<?php 
namespace App\Models\Information;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class BursaemitenModel extends Model {
    protected $table = 'bursaemiten';
    protected $primaryKey = 'kode_pengumuman';
    protected $allowedFields = ['kode_pengumuman', 'kode_jenis_pengumuman', 'kode_kategori_pengumuman', 'tgl_pengumuman', 'judul', 'isi_pengumuman', 'status', 'gambar', 'berkas', 'status_notif', 'is_active'];
    protected $column_order = array('', 'kode_pengumuman', 'kode_jenis_pengumuman', 'kode_kategori_pengumuman', 'tgl_pengumuman', 'judul', 'isi_pengumuman', 'status', 'gambar', 'berkas', 'is_active', '');
    protected $column_search = array('kode_pengumuman', 'kode_jenis_pengumuman', 'kode_kategori_pengumuman', 'tgl_pengumuman', 'judul', 'isi_pengumuman', 'status', 'gambar', 'berkas', 'is_active');
    protected $order = array('kode_pengumuman' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        // $this->dt = $this->db->table('bursaemiten a')
        //             ->select('a.kode_pengumuman, a.kode_jenis_pengumuman, a.kode_kategori_pengumuman, a.tgl_pengumuman, a.judul, a.isi_pengumuman, a.status, a.gambar, a.berkas, a.is_active, b.nama_kategori_pengumuman, c.jenis_pengumuman')
        //             ->join('kategori_pengumuman b', 'a.kode_kategori_pengumuman = b.kode_kategori_pengumuman')
        //             ->join('jenis_pengumuman c', 'a.kode_jenis_pengumuman = c.kode_jenis_pengumuman')
        //             ->orderBy('a.kode_pengumuman ASC');

        // $this->dt = $this->db->query("SELECT a.*, b.nama_kategori_pengumuman, c.jenis_pengumuman FROM bursaemiten a 
        //                             LEFT JOIN kategori_pengumuman b ON a.kode_kategori_pengumuman=b.kode_kategori_pengumuman
        //                             LEFT JOIN jenis_pengumuman c ON a.kode_jenis_pengumuman=c.kode_jenis_pengumuman
        //                             ORDER BY a.kode_pengumuman ASC");

        $this->dt = $this->db->table('bursaemiten');
        $this->dt->select('bursaemiten.*, kategori_pengumuman.nama_kategori_pengumuman, jenis_pengumuman.jenis_pengumuman');
        $this->dt->join('kategori_pengumuman', 'kategori_pengumuman.kode_kategori_pengumuman = bursaemiten.kode_kategori_pengumuman', 'left');
        $this->dt->join('jenis_pengumuman', 'jenis_pengumuman.kode_jenis_pengumuman = bursaemiten.kode_jenis_pengumuman', 'left');
        $this->dt->orderBy('bursaemiten.kode_pengumuman', 'ASC');
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