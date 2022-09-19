<?php

namespace App\Models;

use CodeIgniter\Model;

class PricingModel extends Model
{
    protected $table = 'harga_paket';
    protected $primaryKey = 'kode_user_level';
}
