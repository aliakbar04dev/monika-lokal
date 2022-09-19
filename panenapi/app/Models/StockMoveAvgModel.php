<?php

namespace App\Models;

use CodeIgniter\Model;

class StockMoveAvgModel extends Model
{
	protected $DBGroup = 'stockrev';
    protected $table = 'moving_averages';
}
