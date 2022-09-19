<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
	protected $table			= 'pengumuman';
	protected $primaryKey		= 'kode_pengumuman';
	protected $returnType		= 'array';
	protected $allowedFields 	= '';
	protected $request;
	protected $db;
	protected $dt;


	function getData($key)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('pengumuman');
		return $builder->select('pengumuman.*, jenis_pengumuman.jenis_pengumuman, kategori_pengumuman.nama_kategori_pengumuman')
			->join('jenis_pengumuman', 'jenis_pengumuman.kode_jenis_pengumuman = pengumuman.kode_jenis_pengumuman')
			->join('kategori_pengumuman', 'kategori_pengumuman.kode_kategori_pengumuman = pengumuman.kode_kategori_pengumuman')
			->orderBy('tgl_pengumuman','DESC')
			->getWhere(['jenis_pengumuman.jenis_pengumuman' => $key])->getResultArray();

		//return $query;
	}

	function getBursaDataSearchText($searchInformasibursa){
		if($searchInformasibursa != ''){
			$this->like('bursaemiten.judul', $searchInformasibursa);
		}
		
		$data = $this->select('*')
			->orderBy('tgl_pengumuman', 'DESC')
			->where('kode_jenis_pengumuman', 'JEPM003')
			->where('kode_jenis_pengumuman', 'JEPM004')

			->where('is_active', '1')
			->paginate(6, 'group1');

		return $data;
	}

	function getNews($srch){

		if($srch != ''){
			$this->like('pengumuman.judul',$srch);
		}
		
		$data = $this->select('pengumuman.*, jenis_pengumuman.jenis_pengumuman, kategori_pengumuman.nama_kategori_pengumuman')
			->join('jenis_pengumuman', 'jenis_pengumuman.kode_jenis_pengumuman = pengumuman.kode_jenis_pengumuman')
			->join('kategori_pengumuman', 'kategori_pengumuman.kode_kategori_pengumuman = pengumuman.kode_kategori_pengumuman')
			->orderBy('tgl_pengumuman','DESC')
			->where('jenis_pengumuman.jenis_pengumuman','News')
			->paginate(10, 'group1');

		return $data;
	}

	function getNews3($srch){

		if($srch != ''){
			$this->like('pengumuman.judul',$srch);
		}
		
		$data = $this->select('pengumuman.*, jenis_pengumuman.jenis_pengumuman, kategori_pengumuman.nama_kategori_pengumuman')
			->join('jenis_pengumuman', 'jenis_pengumuman.kode_jenis_pengumuman = pengumuman.kode_jenis_pengumuman')
			->join('kategori_pengumuman', 'kategori_pengumuman.kode_kategori_pengumuman = pengumuman.kode_kategori_pengumuman')
			->orderBy('tgl_pengumuman','DESC')
			->where('jenis_pengumuman.jenis_pengumuman','News')
			->paginate(4, 'group1');

		return $data;
	}

	function getNews4($srch){

		$db      = \Config\Database::connect();
		$builder = $db->table('bursaemiten');

		return $builder->select('bursaemiten.*')
			->orderBy('tgl_pengumuman','DESC')
			->where('kode_jenis_pengumuman', 'JEPM004')
			->paginate(4, 'group1')
			->getResultArray();
	}

	function getBanner()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('banner')->orderBy('id_banner', 'DESC');
		return $builder->getWhere(['status' => 1])->getResultArray();
	}
}
