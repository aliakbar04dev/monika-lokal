<?php 
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class TutorialModel extends Model {
    protected $table = 'tutorial';
    protected $primaryKey = 'id_tutorial';
    protected $allowedFields = ['id_tutorial', 'category', 'title', 'sub_title', 'content', 'slug'];
    protected $column_order = array('', 'id_tutorial', 'category', 'title', 'sub_title', 'content', 'slug', '');
    protected $column_search = array('id_tutorial', 'category', 'title', 'sub_title', 'content', 'slug');
    protected $order = array('id_tutorial' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(){
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }


    public function semuaData(){
        $builder = $this->db->table('tutorial');
        $query   = $builder->get(); 
        return $query;
    }

    public function pencarian($cari) {
        return $this->table($this->table)->like('title', $cari);
    }
    
}