<?php

namespace App\Models;

use CodeIgniter\Model;

class TblSaktiModel extends Model
{
    protected $table = 't_sakti';
    protected $primaryKey = 'kode_tsakti';
    protected $allowedFields = ['kode_tsakti', 'kode_jenis_tsakti', 'tanggal_input'];
}
