<?php

namespace App\Models;

use CodeIgniter\Model;

class FactsheetModel extends Model
{
    protected $table = 'factsheet';
    protected $primaryKey = 'kode_factsheet';
    protected $allowedFields = ['kode_factsheet'];
}
