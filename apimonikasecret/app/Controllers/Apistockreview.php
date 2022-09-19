<?php namespace App\Controllers;

use App\Models\ApistockreviewModel;
use CodeIgniter\API\ResponseTrait;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Apistockreview extends BaseController
{
	use ResponseTrait;

    function fGetStartWeekly($kode){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT *, 
        d.period_1 fn_1, d.sig_period_1 sfn_1,
        d.period_5 fn_5, d.sig_period_5 sfn_5,
        d.period_10 fn_10, d.sig_period_10 sfn_10,
        d.period_20 fn_20, d.sig_period_20 sfn_20,
        d.ss_period_1 ev_1, d.ss_sig_period_1 sev_1,
        d.ss_period_5 ev_5, d.ss_sig_period_5 sev_5,
        d.ss_period_10 ev_10, d.ss_sig_period_10 sev_10,
        d.ss_period_20 ev_20, d.ss_sig_period_20 sev_20,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Buy' THEN 1 END),0)as total_buy_teknikal,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Sell' THEN 1 END),0)as total_sell_teknikal,
        ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Buy' THEN 1 END),0)as total_buy_moving,
 		ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Sell' THEN 1 END),0)as total_sell_moving,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Buy' THEN 1 END),0)as total_buy_foreign,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Sell' THEN 1 END),0)as total_sell_foreign,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Accummulation' THEN 1 END),0)as total_accu_effective,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Distribution' THEN 1 END),0)as total_dist_effective
        FROM quotes a 
        LEFT JOIN technical_indicators b ON b.code=a.code 
        LEFT JOIN moving_averages c ON c.code=a.code 
        LEFT JOIN foreign_nbs d ON d.code=a.code 
        LEFT JOIN effective_value e ON e.code=a.code 
        WHERE a.code='$kode' AND b.timeframe='Weekly' AND c.timeframe='Weekly' AND d.timeframe='Weekly' AND e.timeframe='Weekly';");
        $array1 = $query->getRowArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
	}
	
	function fGetStart($kode){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT *, 
        d.period_1 fn_1, d.sig_period_1 sfn_1,
        d.period_5 fn_5, d.sig_period_5 sfn_5,
        d.period_10 fn_10, d.sig_period_10 sfn_10,
        d.period_20 fn_20, d.sig_period_20 sfn_20,
        d.ss_period_1 ev_1, d.ss_sig_period_1 sev_1,
        d.ss_period_5 ev_5, d.ss_sig_period_5 sev_5,
        d.ss_period_10 ev_10, d.ss_sig_period_10 sev_10,
        d.ss_period_20 ev_20, d.ss_sig_period_20 sev_20,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Buy' THEN 1 END),0)as total_buy_teknikal,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Sell' THEN 1 END),0)as total_sell_teknikal,
        ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Buy' THEN 1 END),0)as total_buy_moving,
 		ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Sell' THEN 1 END),0)as total_sell_moving,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Buy' THEN 1 END),0)as total_buy_foreign,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Sell' THEN 1 END),0)as total_sell_foreign,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Accummulation' THEN 1 END),0)as total_accu_effective,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Distribution' THEN 1 END),0)as total_dist_effective
        FROM quotes a 
        LEFT JOIN technical_indicators b ON b.code=a.code 
        LEFT JOIN moving_averages c ON c.code=a.code 
        LEFT JOIN foreign_nbs d ON d.code=a.code 
        LEFT JOIN effective_value e ON e.code=a.code 
        WHERE a.code='$kode' AND b.timeframe='Daily' AND c.timeframe='Daily' AND d.timeframe='Daily' AND e.timeframe='Daily';");
        $array1 = $query->getRowArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
	}

    function fGetStartHourly($kode){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT *, 
        d.period_1 fn_1, d.sig_period_1 sfn_1,
        d.period_5 fn_5, d.sig_period_5 sfn_5,
        d.period_10 fn_10, d.sig_period_10 sfn_10,
        d.period_20 fn_20, d.sig_period_20 sfn_20,
        d.ss_period_1 ev_1, d.ss_sig_period_1 sev_1,
        d.ss_period_5 ev_5, d.ss_sig_period_5 sev_5,
        d.ss_period_10 ev_10, d.ss_sig_period_10 sev_10,
        d.ss_period_20 ev_20, d.ss_sig_period_20 sev_20,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Buy' THEN 1 END),0)as total_buy_teknikal,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Sell' THEN 1 END),0)as total_sell_teknikal,
        ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Buy' THEN 1 END),0)as total_buy_moving,
 		ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Sell' THEN 1 END),0)as total_sell_moving,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Buy' THEN 1 END),0)as total_buy_foreign,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Sell' THEN 1 END),0)as total_sell_foreign,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Accummulation' THEN 1 END),0)as total_accu_effective,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Distribution' THEN 1 END),0)as total_dist_effective
        FROM quotes a 
        LEFT JOIN technical_indicators b ON b.code=a.code 
        LEFT JOIN moving_averages c ON c.code=a.code 
        LEFT JOIN foreign_nbs d ON d.code=a.code 
        LEFT JOIN effective_value e ON e.code=a.code 
        WHERE a.code='$kode' AND b.timeframe='Hourly' AND c.timeframe='Hourly' AND d.timeframe='Hourly' AND e.timeframe='Hourly';");
        $array1 = $query->getRowArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
	}

    function fGetStartTsalatsuuna($kode){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT *, 
        d.period_1 fn_1, d.sig_period_1 sfn_1,
        d.period_5 fn_5, d.sig_period_5 sfn_5,
        d.period_10 fn_10, d.sig_period_10 sfn_10,
        d.period_20 fn_20, d.sig_period_20 sfn_20,
        d.ss_period_1 ev_1, d.ss_sig_period_1 sev_1,
        d.ss_period_5 ev_5, d.ss_sig_period_5 sev_5,
        d.ss_period_10 ev_10, d.ss_sig_period_10 sev_10,
        d.ss_period_20 ev_20, d.ss_sig_period_20 sev_20,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Buy' THEN 1 END),0)as total_buy_teknikal,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Sell' THEN 1 END),0)as total_sell_teknikal,
        ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Buy' THEN 1 END),0)as total_buy_moving,
 		ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Sell' THEN 1 END),0)as total_sell_moving,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Buy' THEN 1 END),0)as total_buy_foreign,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Sell' THEN 1 END),0)as total_sell_foreign,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Accummulation' THEN 1 END),0)as total_accu_effective,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Distribution' THEN 1 END),0)as total_dist_effective
        FROM quotes a 
        LEFT JOIN technical_indicators b ON b.code=a.code 
        LEFT JOIN moving_averages c ON c.code=a.code 
        LEFT JOIN foreign_nbs d ON d.code=a.code 
        LEFT JOIN effective_value e ON e.code=a.code 
        WHERE a.code='$kode' AND b.timeframe='30-minute' AND c.timeframe='30-minute' AND d.timeframe='30-minute' AND e.timeframe='30-minute';");
        $array1 = $query->getRowArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
	}

    function fGetStartKhomsahasyaroh($kode){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT *, 
        d.period_1 fn_1, d.sig_period_1 sfn_1,
        d.period_5 fn_5, d.sig_period_5 sfn_5,
        d.period_10 fn_10, d.sig_period_10 sfn_10,
        d.period_20 fn_20, d.sig_period_20 sfn_20,
        d.ss_period_1 ev_1, d.ss_sig_period_1 sev_1,
        d.ss_period_5 ev_5, d.ss_sig_period_5 sev_5,
        d.ss_period_10 ev_10, d.ss_sig_period_10 sev_10,
        d.ss_period_20 ev_20, d.ss_sig_period_20 sev_20,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Buy' THEN 1 END),0)as total_buy_teknikal,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Sell' THEN 1 END),0)as total_sell_teknikal,
        ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Buy' THEN 1 END),0)as total_buy_moving,
 		ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Sell' THEN 1 END),0)as total_sell_moving,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Buy' THEN 1 END),0)as total_buy_foreign,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Sell' THEN 1 END),0)as total_sell_foreign,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Accummulation' THEN 1 END),0)as total_accu_effective,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Distribution' THEN 1 END),0)as total_dist_effective
        FROM quotes a 
        LEFT JOIN technical_indicators b ON b.code=a.code 
        LEFT JOIN moving_averages c ON c.code=a.code 
        LEFT JOIN foreign_nbs d ON d.code=a.code 
        LEFT JOIN effective_value e ON e.code=a.code 
        WHERE a.code='$kode' AND b.timeframe='15-minute' AND c.timeframe='15-minute' AND d.timeframe='15-minute' AND e.timeframe='15-minute';");
        $array1 = $query->getRowArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
	}

    function fGetStartKhomsah($kode){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT *, 
        d.period_1 fn_1, d.sig_period_1 sfn_1,
        d.period_5 fn_5, d.sig_period_5 sfn_5,
        d.period_10 fn_10, d.sig_period_10 sfn_10,
        d.period_20 fn_20, d.sig_period_20 sfn_20,
        d.ss_period_1 ev_1, d.ss_sig_period_1 sev_1,
        d.ss_period_5 ev_5, d.ss_sig_period_5 sev_5,
        d.ss_period_10 ev_10, d.ss_sig_period_10 sev_10,
        d.ss_period_20 ev_20, d.ss_sig_period_20 sev_20,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Buy' THEN 1 END),0)as total_buy_teknikal,
        ifnull(COUNT(CASE WHEN b.sig_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_5_3 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_sto_rsi_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_macd_12_26 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_adx_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_cci_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_atr_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_obv_14 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_uo = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN b.sig_mfi_14 = 'Sell' THEN 1 END),0)as total_sell_teknikal,
        ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Buy' THEN 1 END),0)as total_buy_moving,
 		ifnull(COUNT(CASE WHEN c.sig_ma_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ma_200 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_20 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_50 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_100 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN c.sig_ema_200 = 'Sell' THEN 1 END),0)as total_sell_moving,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Buy' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Buy' THEN 1 END),0)as total_buy_foreign,
        ifnull(COUNT(CASE WHEN d.sig_period_1 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_5 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_10 = 'Sell' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.sig_period_20 = 'Sell' THEN 1 END),0)as total_sell_foreign,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Accummulation' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Accummulation' THEN 1 END),0)as total_accu_effective,
        ifnull(COUNT(CASE WHEN d.ss_sig_period_1 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_5 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_10 = 'Distribution' THEN 1 END),0)+
        ifnull(COUNT(CASE WHEN d.ss_sig_period_20 = 'Distribution' THEN 1 END),0)as total_dist_effective
        FROM quotes a 
        LEFT JOIN technical_indicators b ON b.code=a.code 
        LEFT JOIN moving_averages c ON c.code=a.code 
        LEFT JOIN foreign_nbs d ON d.code=a.code 
        LEFT JOIN effective_value e ON e.code=a.code 
        WHERE a.code='$kode' AND b.timeframe='5-minute' AND c.timeframe='5-minute' AND d.timeframe='5-minute' AND e.timeframe='5-minute';");
        $array1 = $query->getRowArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
	}
    
    function fGetSW(){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT * FROM `data_pasar` WHERE CODE='AALI' AND timeframe='Daily' ORDER BY lastupdate DESC LIMIT 1");
        $array1 = $query->getResultArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
    }

    function fGetCodeName(){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT code, codename FROM `quotes`");
        $array1 = $query->getResultArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
    }

    function fGetSmartWathlist($kode_user){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT a.id, a.kode_user, b.code, b.timeframe, b.lastupdate, b.close, b.dsl, b.pivot_r2, b.sig_dsl, b.prev_sig_dsl 
        FROM trx_smartwatchlist a 
        LEFT JOIN data_pasar b ON a.code=b.code AND a.timeframe=b.timeframe 
        WHERE kode_user='$kode_user'
        ORDER BY a.id DESC, b.lastupdate DESC");
        $array1 = $query->getResultArray();

        if ($array1) {
            $response = $array1;
            return $this->respondCreated($response);
        } else {
            // $response = [
            //     'status' => 401,
            //     'error' => TRUE,
            //     'messages' => 'Access denied'
            // ];
            // return $this->respondCreated($response);
        }    
	}

    function prosesDeleteSW($id){
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT COUNT(id) AS jumlah FROM trx_smartwatchlist WHERE id='$id'")->getRowArray();

        if ($query['jumlah'] > 0) {
            $delete = $this->db->query("DELETE FROM `trx_smartwatchlist` WHERE `trx_smartwatchlist`.`id` = $id");
            if ($delete) {
                $this->db->query("DELETE FROM `tr_smartwatchlist` WHERE `tr_smartwatchlist`.`id` = $id");
                $response = [
                    'status' => 200,
                    'error' => null,
                    'messages' => 'Data Berhasil Terhapus'
                ];
                return $this->respondDeleted($response);
            }
        } else {
            return $this->failNotFound('Data dengan ID '.$id.' Tidak Ditemukan');        
        }		
    }

    function prosesInsertSW(){
        $this->db = \Config\Database::connect();
        $kodeUser = $this->request->getVar('kode_user');
        $code = $this->request->getVar('code');
        $timeframe = $this->request->getVar('timeframe');

        $tabelTujuan = $this->db->query("INSERT INTO `tr_smartwatchlist` (`id`, `kode_user`, `code`, `timeframe`) VALUES (NULL, '$kodeUser', '$code', '$timeframe')");

        $dataCount = $this->db->query("SELECT COUNT(id) AS jumlah FROM trx_smartwatchlist WHERE kode_user='$kodeUser' AND code='$code'AND timeframe='$timeframe'")->getRowArray();
        $jumlahDataSama = $dataCount['jumlah'];

        // echo json_encode($jumlah); die;

        if ($jumlahDataSama > 0) {
            if ($tabelTujuan) {
                return $this->failNotFound('Data Tidak Bisa Terinput Karena Sudah Ada');
            }
        } else {
            $sementaraRows = $this->db->query("SELECT a.id, a.kode_user, b.code, b.timeframe, b.lastupdate, b.close, b.dsl, b.pivot_r2, b.sig_dsl 
                                                            FROM tr_smartwatchlist a 
                                                            LEFT JOIN data_pasar b ON a.code=b.code AND a.timeframe=b.timeframe
                                                            WHERE a.kode_user='$kodeUser' AND b.code='$code' AND b.timeframe='$timeframe'
                                                            ORDER BY a.id DESC, b.lastupdate DESC
                                                            LIMIT 1")->getRowArray();

            $kodeUserFix = $sementaraRows['kode_user'];
            $codeFix = $sementaraRows['code'];
            $timeframeFix = $sementaraRows['timeframe'];
            $lastupdateFix = $sementaraRows['lastupdate'];
            $closeFix = $sementaraRows['close'];
            $dslFix = $sementaraRows['dsl'];
            $pivot_r2Fix = $sementaraRows['pivot_r2'];
            $sig_dslFix = $sementaraRows['sig_dsl'];

            $this->db->query("INSERT INTO `trx_smartwatchlist` (`id`, `kode_user`, `code`, `timeframe`, `last_update`, `close`, `dsl`, `pivot_r2`, `sig_dsl`) VALUES (NULL, '$kodeUserFix', '$codeFix', '$timeframeFix', '$lastupdateFix', '$closeFix', '$dslFix', '$pivot_r2Fix', '$sig_dslFix')");

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => 'Data Berhasil Ditambahkan'
            ];
            return $this->respondCreated($response);
        }
    }
}