<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

	class InformasibursaModel extends Model {
		protected $table = 'bursaemiten';
		protected $primaryKey = 'kode_pengumuman';
		protected $allowedFields = ['kode_pengumuman', 'kode_jenis_pengumuman', 'kode_kategori_pengumuman', 
		'tgl_pengumuman', 'judul', 'isi_pengumuman', 'gambar', 'berkas', 'is_active'];


		function getBursaDataSearchText($searchInformasibursa){
			if($searchInformasibursa != ''){
				$this->like('bursaemiten.judul', $searchInformasibursa);
			}
			
			$data = $this->select('*')
				->orderBy('tgl_pengumuman', 'DESC')
				->where('kode_jenis_pengumuman', 'JEPM003')
				->where('is_active', '1')
				->paginate(6, 'group1');
	
			return $data;
		}

		function getBursaDataSearchTextBeranda($searchInformasibursa){
			if($searchInformasibursa != ''){
				$this->like('bursaemiten.judul', $searchInformasibursa);
			}
			
			$data = $this->select('*')
				->orderBy('tgl_pengumuman', 'DESC')
				->where('is_active', '1')
				->where('kode_jenis_pengumuman', 'JEPM003')
				->orWhere('kode_jenis_pengumuman', 'JEPM004')
				->paginate(4, 'group1');
	
			return $data;
		}

		function getDataBursa($nm_kode){
			$this->db = \Config\Database::connect();
			$queryCariKode = $this->db->query("SELECT * FROM bursaemiten a LEFT JOIN kategori_pengumuman b ON a.kode_kategori_pengumuman=b.kode_kategori_pengumuman WHERE b.nama_kategori_pengumuman='$nm_kode' LIMIT 1")->getRowArray();

			if ($queryCariKode == null) {
				$kodeNameTag = ' ';
			} else {
				$kodeNameTag = $queryCariKode['kode_kategori_pengumuman'];
			}

			$data = $this->select('*')
				->orderBy('tgl_pengumuman', 'DESC')
				->where('kode_kategori_pengumuman', $kodeNameTag)
				->where('kode_jenis_pengumuman', 'JEPM003')
				->where('is_active', '1')
				->paginate(6, 'group1');

			return $data;
		}

		function getInformasiBursaDetail($kode){
			$this->db = \Config\Database::connect();
			$CariData = $this->db->query("SELECT * FROM bursaemiten a LEFT JOIN kategori_pengumuman b ON a.kode_kategori_pengumuman=b.kode_kategori_pengumuman WHERE a.kode_pengumuman ='$kode' AND a.kode_jenis_pengumuman = 'JEPM003' AND a.is_active = '1'")->getRowArray();
			return $CariData;
		}

		public function getInformasiBursaDetailAll(){
			$results = $this->orderBy('tgl_pengumuman', 'DESC')->where('kode_jenis_pengumuman', 'JEPM003')->where('is_active', '1')->paginate(6, 'group1');
			return $results;
		}
	}
?>