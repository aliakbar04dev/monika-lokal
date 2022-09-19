<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

	class StockreviewModel extends Model {
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
	}
?>