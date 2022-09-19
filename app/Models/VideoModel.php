<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model
{
	protected $table = 'media';

	function getVideo($key)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('media');
		return $builder->select('media.*, filter_media.judul_filter')
			->join('filter_media', 'filter_media.kode_filter_media = media.kode_filter_media')
			->getWhere(['filter_media.judul_filter' => $key])->getResultArray();

		//return $query;
	}

	function getVideo3($key)
	{
		$data = $this->select('media.*, filter_media.judul_filter')
			->join('filter_media', 'filter_media.kode_filter_media = media.kode_filter_media')
			->where('filter_media.judul_filter',$key)
			->paginate(4, 'group1');

		return $data;
	}
}
