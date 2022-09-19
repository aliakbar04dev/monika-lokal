<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

	class NewsModel extends Model {
		protected $table = 'pengumuman';
		protected $primaryKey = 'kode_pengumuman';
		protected $allowedFields = ['kode_pengumuman', 'kode_jenis_pengumuman', 'kode_kategori_pengumuman', 
		'tgl_pengumuman', 'judul', 'isi_pengumuman', 'gambar', 'is_active'];


		function getNewsSearchText($searchNews){
			if($searchNews != ''){
				$this->like('pengumuman.judul', $searchNews);
			}
			
			$data = $this->select('*')
				->orderBy('tgl_pengumuman', 'DESC')
				->where('kode_jenis_pengumuman', 'JEPM001')
				->where('is_active', '1')
				->paginate(6, 'group1');
	
			return $data;
		}

		function getDataBursa($nm_kode){
			$this->db = \Config\Database::connect();
			$queryCariKode = $this->db->query("SELECT * FROM pengumuman a LEFT JOIN kategori_pengumuman b ON a.kode_kategori_pengumuman=b.kode_kategori_pengumuman WHERE b.nama_kategori_pengumuman='$nm_kode' LIMIT 1")->getRowArray();

			if ($queryCariKode == null) {
				$kodeNameTag = ' ';
			} else {
				$kodeNameTag = $queryCariKode['kode_kategori_pengumuman'];
			}

			$data = $this->select('*')
				->orderBy('tgl_pengumuman', 'DESC')
				->where('kode_kategori_pengumuman', $kodeNameTag)
				->where('kode_jenis_pengumuman', 'JEPM001')
				->where('is_active', '1')
				->paginate(6, 'group1');

			return $data;
		}

		function getNewsDetail($kode){
			$this->db = \Config\Database::connect();
			$CariData = $this->db->query("SELECT * FROM pengumuman a LEFT JOIN kategori_pengumuman b ON a.kode_kategori_pengumuman=b.kode_kategori_pengumuman WHERE a.kode_pengumuman ='$kode' AND a.kode_jenis_pengumuman = 'JEPM001' AND a.is_active = '1'")->getRowArray();
			return $CariData;
		}

		public function getNewsDetailAll(){
			$results = $this->orderBy('tgl_pengumuman', 'DESC')->where('kode_jenis_pengumuman', 'JEPM001')->where('is_active', '1')->paginate(6, 'group1');
			return $results;
		}

	}
?>