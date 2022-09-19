<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'kode_media';
	
	public function video($kode_fm)
	{
		$this->db = db_connect();
		return $this->dt = $this->db->table($this->table)->select('media.*')->join('filter_media', 
                        'filter_media.kode_filter_media = media.kode_filter_media')
                        ->where("filter_media.jenis_media", "video")
						->where("filter_media.kode_filter_media", $kode_fm)->get()->getResult();
	}
	
	public function galery($kode_fm)
	{
		$this->db = db_connect();
		return $this->dt = $this->db->table($this->table)->select('media.*')->join('filter_media', 
                        'filter_media.kode_filter_media = media.kode_filter_media')
                        ->where("filter_media.jenis_media", "gambar")
						->where("filter_media.kode_filter_media", $kode_fm)->get()->getResult();
	}
}
