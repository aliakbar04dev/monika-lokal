<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table = 'media';

    public function getAbout($key)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('media');
        return $builder->select('media.*, filter_media.judul_filter')
            ->join('filter_media', 'filter_media.kode_filter_media = media.kode_filter_media')
            ->getWhere(['filter_media.judul_filter' => $key])->getResultArray();
    }
}
