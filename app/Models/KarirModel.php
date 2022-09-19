<?php
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class KarirModel extends Model {
	protected $table			= 't_karir';
	protected $primaryKey		= 'id_karir';
	protected $returnType		= 'array';
	protected $allowedFields 	= ['id_karir', 'karir', 'id_lokasi_pekerjaan', 'id_departemen', 'id_kategori_pekerjaan', 'deskripsi_karir', 'benefit_karir', 'publish'];
	protected $request;
    protected $db;
    protected $dt;

	public function getKarirList()
	{
		$data = $this->select('id_karir, karir, d.nama_departemen, l.lokasi_pekerjaan, k.kategori_pekerjaan')
			->join('t_departemen d', 'd.id_departemen = t_karir.id_departemen')
			->join('t_lokasi_pekerjaan l', 'l.id_lokasi_pekerjaan = t_karir.id_lokasi_pekerjaan')
			->join('t_kategori_pekerjaan k', 'k.id_kategori_pekerjaan = t_karir.id_kategori_pekerjaan')
			->where('publish', 1)
			->findAll(10);

		return $data;
	}
	
	public function getSatukarirdetail($id)
	{
		return $this->select('id_karir, karir, d.nama_departemen, l.lokasi_pekerjaan, k.kategori_pekerjaan, deskripsi_karir, requirement, benefit_karir')
				->join('t_departemen d', 'd.id_departemen = t_karir.id_departemen')
				->join('t_lokasi_pekerjaan l', 'l.id_lokasi_pekerjaan = t_karir.id_lokasi_pekerjaan')
				->join('t_kategori_pekerjaan k', 'k.id_kategori_pekerjaan = t_karir.id_kategori_pekerjaan')->where('id_karir', $id)->where('publish',1)->first();
	}
	
	public function getKarirDetail($id){
		$data = $this->select('id_karir, karir, d.nama_departemen, l.lokasi_pekerjaan, k.kategori_pekerjaan')
			->join('t_departemen d', 'd.id_departemen = t_karir.id_departemen')
			->join('t_lokasi_pekerjaan l', 'l.id_lokasi_pekerjaan = t_karir.id_lokasi_pekerjaan')
			->join('t_kategori_pekerjaan k', 'k.id_kategori_pekerjaan = t_karir.id_kategori_pekerjaan')
			->where('id_karir', $id)
			->findAll(10);

		return $data;
	}
}
?>