<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class VideonewModel extends Model {
	protected $table 			= 'new_media';
	protected $primaryKey		= 'kode_media';
    protected $allowedFields 	= ['kode_media', 'link_media', 'judul', 'deskripsi', 'kode_filter_media', 'kode_filter_submedia', 'is_populer', 'is_berbayar', 'thumbnails_video', 'link_api', 'create_at'];
    protected $column_order 	= ['', 'kode_media', 'link_media', 'judul', 'deskripsi', 'kode_filter_media', 'kode_filter_submedia', 'is_populer', 'is_berbayar', 'thumbnails_video', 'link_api', 'create_at', ''];
    protected $column_search 	= ['kode_media', 'link_media', 'judul', 'deskripsi', 'kode_filter_media', 'kode_filter_submedia', 'is_populer', 'is_berbayar', 'thumbnails_video', 'link_api', 'create_at'];
    protected $order 			= ['kode_media' => 'asc'];
    protected $request;
    protected $db;
    protected $dt;

	function __construct(){
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

	function getVideoUtamaTranding($key)
	{
		if($key != ''){
			$this->where('filter_media.judul_filter', $key);
		}

		$data = $this->select('new_media.*, count(new_media.kode_media) as total_video, filter_media.judul_filter, filter_media.jenis_media, filter_submedia.keterangan_submedia, filter_submedia.desc_submedia')
					->join('filter_submedia','filter_submedia.kode_filter_submedia = new_media.kode_filter_submedia','left')
					->join('filter_media', 'filter_media.kode_filter_media = new_media.kode_filter_media', 'left')
					->groupBy('filter_submedia.kode_filter_submedia')
					->paginate(90000000000);

		return $data;
	}

	function getSubMenuData($id, $kodevid, $sub)
	{
		$data = $this->select('new_media.*, filter_media.judul_filter, filter_media.jenis_media, filter_submedia.keterangan_submedia, filter_submedia.desc_submedia')
				->join('filter_submedia','filter_submedia.kode_filter_submedia = new_media.kode_filter_submedia')
				->join('filter_media', 'filter_media.kode_filter_media = new_media.kode_filter_media', 'left')
				->where('new_media.kode_media', $id)
				->where('new_media.kode_filter_media', $sub)
				->where('new_media.kode_filter_submedia', $kodevid)
				->first();

		return $data;
	}

	function mGetPopuler()
	{
		$data = $this->select('new_media.*, filter_media.judul_filter, filter_media.jenis_media, filter_submedia.keterangan_submedia, filter_submedia.desc_submedia')
				->join('filter_submedia','filter_submedia.kode_filter_submedia = new_media.kode_filter_submedia')
				->join('filter_media', 'filter_media.kode_filter_media = new_media.kode_filter_media', 'left')
				->where('new_media.is_populer', 1)
				->orderBy('new_media.create_at', 'DESC')
				->limit(2)
				->get()
				->getResultArray();

		return $data;
	}

	function mGetTerbaru()
	{
		$data = $this->select('new_media.*, filter_media.judul_filter, filter_media.jenis_media, filter_submedia.keterangan_submedia, filter_submedia.desc_submedia')
				->join('filter_submedia','filter_submedia.kode_filter_submedia = new_media.kode_filter_submedia')
				->join('filter_media', 'filter_media.kode_filter_media = new_media.kode_filter_media', 'left')
				->orderBy('new_media.create_at', 'DESC')
				->limit(2)
				->get()
				->getResultArray();

		return $data;
	}

	function getAllVideo($kodevid){
		$data = $this->select('new_media.*')
				->where('kode_filter_submedia',$kodevid)
				->findAll();

		return $data;
	}

	function getRowsVideo($kode){
		$data = $this->select('new_media.*, filter_media.judul_filter, filter_media.jenis_media, filter_submedia.keterangan_submedia, filter_submedia.desc_submedia')
					->join('filter_submedia','filter_submedia.kode_filter_submedia = new_media.kode_filter_submedia')
					->join('filter_media', 'filter_media.kode_filter_media = new_media.kode_filter_media', 'left')
					->where('new_media.kode_media', $kode)
					->get()
					->getRowArray();

		return $data;
	}

	function getAllVideonew($filterMed, $subFilterMed){
		$data = $this->select('new_media.*')
				->where('kode_filter_media', $filterMed)
				->where('kode_filter_submedia', $subFilterMed)
				->get()
				->getResultArray();

		return $data;
	}

	public function pencarianVideo($inputCariVideo) {
		if($inputCariVideo != ''){
			$this->like('filter_submedia.keterangan_submedia',$inputCariVideo);
		}
		
		$data = $this->select('new_media.*, filter_media.judul_filter, filter_media.jenis_media, filter_submedia.keterangan_submedia, filter_submedia.desc_submedia')
		 			->join('filter_submedia','filter_submedia.kode_filter_submedia = new_media.kode_filter_submedia','left')
		 			->join('filter_media', 'filter_media.kode_filter_media = new_media.kode_filter_media', 'left')
					->paginate(9);

		return $data;
    }

	public function pencarianVideowebview($inputCariVideo) {
		if($inputCariVideo != ''){
			$this->like('filter_submedia.keterangan_submedia',$inputCariVideo);
		}
		
		$data = $this->select('new_media.*, filter_media.judul_filter, filter_media.jenis_media, filter_submedia.keterangan_submedia, filter_submedia.desc_submedia')
		 			->join('filter_submedia','filter_submedia.kode_filter_submedia = new_media.kode_filter_submedia','left')
		 			->join('filter_media', 'filter_media.kode_filter_media = new_media.kode_filter_media', 'left')
					->groupBy('filter_submedia.kode_filter_submedia')
					->paginate(4);

		return $data;
    }

	public function webViewAll() {
		$data = $this->select('new_media.*, filter_media.judul_filter, filter_media.jenis_media, filter_submedia.keterangan_submedia, filter_submedia.desc_submedia')
		 			->join('filter_submedia','filter_submedia.kode_filter_submedia = new_media.kode_filter_submedia','left')
		 			->join('filter_media', 'filter_media.kode_filter_media = new_media.kode_filter_media', 'left')
					->groupBy('filter_submedia.kode_filter_submedia')
					->paginate(4);

		return $data;
    }


}
