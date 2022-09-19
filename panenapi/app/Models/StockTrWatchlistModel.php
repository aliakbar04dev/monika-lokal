<?php

namespace App\Models;

use CodeIgniter\Model;

class StockTrWatchlistModel extends Model
{
	protected $DBGroup = 'stockrev';
    protected $table = 'tr_smartwatchlist';
    protected $allowedFields = ['id', 'kode_user', 'code', 'timeframe'];
}
