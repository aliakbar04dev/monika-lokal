<?php

namespace App\Models;

use CodeIgniter\Model;

class StockWatchlistModel extends Model
{
	protected $DBGroup = 'stockrev';
    protected $table = 'trx_smartwatchlist';
    protected $allowedFields = ['id', 'kode_user', 'code', 'timeframe', 'last_update', 'close', 'dsl', 'pivot_r2', 'sig_dsl'];

    function getData($kodeuser){
        return $this->db->table($this->table)
                        ->join('data_pasar', 'trx_smartwatchlist.code = data_pasar.code AND trx_smartwatchlist.timeframe = data_pasar.timeframe', 'left')
                        ->join('quotes', 'trx_smartwatchlist.code = quotes.code', 'left')
                        ->where('kode_user', $kodeuser)
                        ->orderBy('trx_smartwatchlist.id', 'DESC')
                        ->get()->getResultArray();
    }
	
	function getDataTes($kodeuser){
        return $this->db->table($this->table)
						->select('trx_smartwatchlist.id, trx_smartwatchlist.kode_user, trx_smartwatchlist.code, trx_smartwatchlist.timeframe, trx_smartwatchlist.last_update, data_pasar.close, data_pasar.dsl, data_pasar.pivot_r2, data_pasar.sig_dsl, quotes.codename, data_pasar.chg, data_pasar.prev_sig_dsl')
                        ->join('data_pasar', 'trx_smartwatchlist.code = data_pasar.code AND trx_smartwatchlist.timeframe = data_pasar.timeframe', 'left')
                        ->join('quotes', 'trx_smartwatchlist.code = quotes.code', 'left')
                        ->where('kode_user', $kodeuser)
                        ->orderBy('trx_smartwatchlist.id', 'DESC')
                        ->get()->getResultArray();
    }
}
