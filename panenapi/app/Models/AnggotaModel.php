<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'm_anggota';
    protected $primaryKey = 'email';
}
