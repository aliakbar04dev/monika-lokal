<?php namespace App\Controllers;

use App\Models\StockQuoteModel;
use App\Models\StockTechIndiModel;
use App\Models\StockMoveAvgModel;
use App\Models\StockEffectValModel;
use App\Models\StockForeNbsModel;
use App\Models\StockWatchlistModel;
use App\Models\StockTrWatchlistModel;
use App\Models\StockDataPasarModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Apistockreview extends BaseController
{
	use ResponseTrait;
	
	function getStatistic($kode, $timeframe, $quotes)
	{
		$this->db1 = \Config\Database::connect('stockrev');
		$query = $this->db1->query("SELECT
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
					WHERE a.code='$kode' AND b.timeframe='$timeframe' AND c.timeframe='$timeframe' AND d.timeframe='$timeframe' AND e.timeframe='$timeframe';");
					$data = $query->getRowArray();
		
		$data1 = array();
		
		$dataactgeneral['summary_general'] = $this->actionGeneral($data, $quotes);
		$dataactteknikal['summary_teknikal'] = $this->actionTechIndi($data);
		$dataactmoving['summary_moving'] = $this->actionMoveAvg($data);
		$dataacteffective['summary_effective'] = $this->actionEffectVal($data);
		$dataactforenbs['summary_foreign'] = $this->actionForeNbs($data);
		
		$data = array_merge($dataactgeneral, $dataactteknikal, $dataactmoving, $dataacteffective, $dataactforenbs, $data1);
		return $data;
	}
	
	function actionGeneral($data, $quotes)
	{
		if($data['total_buy_teknikal'] == 0 && $data['total_sell_teknikal'] == 0) {
           $sum_teknikal = 'NETRAL';
        } elseif ($data['total_buy_teknikal'] == 0) {
           if ($data['total_sell_teknikal'] > 2) {
               $sum_teknikal = 'STRONG SELL';
           } 
		   elseif ($data['total_sell_teknikal'] > 1 && $data['total_sell_teknikal'] <= 2) {
               $sum_teknikal = 'SELL';
           } 
		   elseif ($data['total_sell_teknikal'] == 1) {
               $sum_teknikal = 'NETRAL';
           } 
		   elseif ($data['total_sell_teknikal'] < 1 && $data['total_sell_teknikal'] >= 0.5) {
               $sum_teknikal = 'SELL';
           } 
		   elseif ($data['total_sell_teknikal'] < 0.5) {
               $sum_teknikal = 'SELL';
           } 
		   else {
               $sum_teknikal = 'ERROR';
           }
        } 
		elseif ($data['total_sell_teknikal'] == 0) {
           if ($data['total_buy_teknikal'] > 2) {
               $sum_teknikal = 'STRONG BUY';
           } elseif ($data['total_buy_teknikal'] > 1 && $data['total_buy_teknikal'] <= 2) {
               $sum_teknikal = 'BUY';
           } elseif ($data['total_buy_teknikal'] == 1) {
               $sum_teknikal = 'NETRAL';
           } elseif ($data['total_buy_teknikal'] < 1 && $data['total_buy_teknikal'] >= 0.5) {
               $sum_teknikal = 'BUY';
           } elseif ($data['total_buy_teknikal'] < 0.5) {
               $sum_teknikal = 'BUY';
           } else {
               $sum_teknikal = 'ERROR';
           }
        } else {
           if ($data['total_buy_teknikal']/$data['total_sell_teknikal'] > 2) {
               $sum_teknikal = 'STRONG BUY';
           } elseif ($data['total_buy_teknikal']/$data['total_sell_teknikal'] > 1 && $data['total_buy_teknikal']/$data['total_sell_teknikal'] <= 2) {
               $sum_teknikal = 'BUY';
           } elseif ($data['total_buy_teknikal']/$data['total_sell_teknikal'] == 1) {
               $sum_teknikal = 'NETRAL';
           } elseif ($data['total_buy_teknikal']/$data['total_sell_teknikal'] < 1 && $data['total_buy_teknikal']/$data['total_sell_teknikal'] >= 0.5) {
               $sum_teknikal = 'SELL';
           } elseif ($data['total_buy_teknikal']/$data['total_sell_teknikal'] < 0.5) {
               $sum_teknikal = 'STRONG SELL';
           } else {
               $sum_teknikal = 'ERROR';
           }
        }

        if ($data['total_buy_moving'] == 0 && $data['total_sell_moving'] == 0) {
           $sum_moving = 'NETRAL';
           } 
		elseif ($data['total_buy_moving'] == 0) {
           if ($data['total_sell_moving'] > 2) {
               $sum_moving = 'STRONG SELL';
           } elseif ($data['total_sell_moving'] > 1 && $data['total_sell_moving'] <= 2) {
               $sum_moving = 'SELL';
           } elseif ($data['total_sell_moving'] == 1) {
               $sum_moving = 'NETRAL';
           } elseif ($data['total_sell_moving'] < 1 && $data['total_sell_moving'] >= 0.5) {
               $sum_moving = 'SELL';
           } elseif ($data['total_sell_moving'] < 0.5) {
               $sum_moving = 'SELL';
           } else {
               $sum_moving = 'ERROR';
           }
        } elseif ($data['total_sell_moving'] == 0) {
           if ($data['total_buy_moving'] > 2) {
               $sum_moving = 'STRONG BUY';
           } elseif ($data['total_buy_moving'] > 1 && $data['total_buy_moving'] <= 2) {
               $sum_moving = 'BUY';
           } elseif ($data['total_buy_moving'] == 1) {
               $sum_moving = 'NETRAL';
           } elseif ($data['total_buy_moving'] < 1 && $data['total_buy_moving'] >= 0.5) {
               $sum_moving = 'BUY';
           } elseif ($data['total_buy_moving'] < 0.5) {
               $sum_moving = 'BUY';
           } else {
               $sum_moving = 'ERROR';
           }
        } else {
           if ($data['total_buy_moving']/$data['total_sell_moving'] > 2) {
               $sum_moving = 'STRONG BUY';
           } elseif ($data['total_buy_moving']/$data['total_sell_moving'] > 1 && $data['total_buy_moving']/$data['total_sell_moving'] <= 2) {
               $sum_moving = 'BUY';
           } elseif ($data['total_buy_moving']/$data['total_sell_moving'] == 1) {
               $sum_moving = 'NETRAL';
           } elseif ($data['total_buy_moving']/$data['total_sell_moving'] < 1 && $data['total_buy_moving']/$data['total_sell_moving'] >= 0.5) {
               $sum_moving = 'SELL';
           } elseif ($data['total_buy_moving']/$data['total_sell_moving'] < 0.5) {
               $sum_moving = 'STRONG SELL';
           } else {
               $sum_moving = 'ERROR';
           }
        }

        $sum_moving_teknikal = $sum_teknikal.' '.$sum_moving;
		
		if($sum_moving_teknikal == 'STRONG BUY STRONG BUY' || $sum_moving_teknikal == 'STRONG BUY BUY' || $sum_moving_teknikal == 'BUY STRONG BUY')
		{
			$status = 'STRONG BUY';
			$colorsts = '#13AC13';
		}
		elseif ($sum_moving_teknikal == 'STRONG BUY NETRAL' || $sum_moving_teknikal == 'BUY BUY' || $sum_moving_teknikal == 'BUY NETRAL' || $sum_moving_teknikal == 'NETRAL STRONG BUY' || $sum_moving_teknikal == 'NETRAL BUY')
		{
			$status = 'BUY';
			$colorsts = '#13AC13';
		}
		elseif ($sum_moving_teknikal == 'BUY STRONG SELL' || $sum_moving_teknikal == 'NETRAL SELL' || $sum_moving_teknikal == 'NETRAL STRONG SELL' || $sum_moving_teknikal == 'SELL NETRAL' || $sum_moving_teknikal == 'SELL SELL' || $sum_moving_teknikal == 'STRONG SELL BUY' || $sum_moving_teknikal == 'STRONG SELL NETRAL')
		{
			$status = 'SELL';
			$colorsts = '#F80000';
		}
		elseif ($sum_moving_teknikal == 'SELL STRONG SELL' || $sum_moving_teknikal == 'STRONG SELL SELL' || $sum_moving_teknikal == 'STRONG SELL STRONG SELL')
		{
			$status = 'STRONG SELL';
			$colorsts = '#F80000';
		}
		elseif ($sum_moving_teknikal == 'STRONG BUY SELL' || $sum_moving_teknikal == 'STRONG BUY STRONG SELL' || $sum_moving_teknikal == 'BUY SELL' || $sum_moving_teknikal == 'NETRAL NETRAL' || $sum_moving_teknikal == 'SELL STRONG BUY' || $sum_moving_teknikal == 'SELL BUY' || $sum_moving_teknikal == 'STRONG SELL STRONG BUY')
		{
			$status = 'NETRAL';
			$colorsts = '#000000';
		}
		
		if ($quotes['chg'] == 0)
		{
			$colorchg = '#000000';
		}
		elseif ($quotes['chg'] > 0)
		{
			$colorchg = '#13AC13';
		}
		else
		{ 
			$colorchg = '#F80000';
		}
                                  
		return array(
			'status_general' => $status,
			'colorcode_general' => $colorsts,
			'colorcode_chg' => $colorchg,
		);
	}
	
	function actionTechIndi($data)
	{
		 if($data['total_buy_teknikal'] == 0 && $data['total_sell_teknikal'] == 0)
		 {
			 $status = 'NETRAL';
			 $colorsts = '#000000';
		 }
         elseif($data['total_buy_teknikal'] == 0)
		 {
			 if($data['total_sell_teknikal'] > 2)
		     {
				 $status = 'STRONG SELL';
				 $colorsts = '#F80000';
			 }
			 elseif($data['total_sell_teknikal'] > 1 && $data['total_sell_teknikal'] <= 2)
			 {
				 $status = 'SELL';
				 $colorsts = '#F80000';
			 }
			 elseif ($data['total_sell_teknikal'] == 1)
			 {
				 $status = 'NETRAL';
				 $colorsts = '#000000';
			 }
			 elseif ($data['total_sell_teknikal'] < 1 && $data['total_sell_teknikal'] >= 0.5)
			 {
				 $status = 'SELL';
				 $colorsts = '#F80000';
			 }
			 elseif ($data['total_sell_teknikal'] < 0.5)
			 {
				 $status = 'SELL';
				 $colorsts = '#F80000';
			 }
			 else
			 {
				 $status = 'ERROR';
				 $colorsts = '#000000';
			 }
		 }
         elseif ($data['total_sell_teknikal'] == 0)
		 {
			if ($data['total_buy_teknikal'] > 2)
			{
				$status = 'STRONG BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_teknikal'] > 1 && $data['total_buy_teknikal'] <= 2)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_teknikal'] == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			elseif ($data['total_buy_teknikal'] < 1 && $data['total_buy_teknikal'] >= 0.5)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_teknikal'] < 0.5)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		 }
		 else
		 {
			 if (($data['total_buy_teknikal']/$data['total_sell_teknikal']) > 2)
			 {
				$status = 'STRONG BUY';
				$colorsts = '#13AC13';
			 }
			 elseif (($data['total_buy_teknikal']/$data['total_sell_teknikal']) > 1 && ($data['total_buy_teknikal']/$data['total_sell_teknikal']) <= 2)
			 {
				$status = 'BUY';
				$colorsts = '#13AC13';
			 }
			 elseif (($data['total_buy_teknikal']/$data['total_sell_teknikal']) == 1)
			 {
				$status = 'NETRAL';
				$colorsts = '#000000';
			 }
			 elseif (($data['total_buy_teknikal']/$data['total_sell_teknikal']) < 1 && ($data['total_buy_teknikal']/$data['total_sell_teknikal']) >= 0.5)
			 {
				$status = 'SELL';
				$colorsts = '#F80000';
			 }
			 elseif (($data['total_buy_teknikal']/$data['total_sell_teknikal']) < 0.5)
			 {
				$status = 'STRONG SELL';
				$colorsts = '#F80000';
			 }
			 else
			 {
				$status = 'ERROR';
				$colorsts = '#000000';
			 }
		 }
		 
	    return array(
			'status_teknikal' => $status,
			'colorcode_teknikal' => $colorsts,
			'total_buy_teknikal' => $data['total_buy_teknikal'],
            'total_sell_teknikal' => $data['total_sell_teknikal'],
		);
	}
	
	function customTechIndi($data)
	{
		foreach($data as $dt){
			$returnDat = array(
				array(
					'name' => 'RSI (14)',
					'value' => $dt['rsi_14'],
					'action' => $dt['sig_rsi_14'],
				),
				array(
					'name' => 'STO (5,3)',
					'value' => $dt['sto_5_3'],
					'action' => $dt['sig_sto_5_3'],
				),
				array(
					'name' => 'STO-RSI (14)',
					'value' => $dt['sto_rsi_14'],
					'action' => $dt['sig_sto_rsi_14'],
				),
				array(
					'name' => 'MACD (12,26)',
					'value' => $dt['macd_12_26'],
					'action' => $dt['sig_macd_12_26'],
				),
				array(
					'name' => 'ADX (14)',
					'value' => $dt['adx_14'],
					'action' => $dt['sig_adx_14'],
				),
				array(
					'name' => 'CCI (14)',
					'value' => $dt['cci_14'],
					'action' => $dt['sig_cci_14'],
				),
				array(
					'name' => 'ATR (14)',
					'value' => $dt['atr_14'],
					'action' => $dt['sig_atr_14'],
				),
				array(
					'name' => 'OBV (14)',
					'value' => $dt['obv_14'],
					'action' => $dt['sig_obv_14'],
				),
				array(
					'name' => 'UO',
					'value' => $dt['uo'],
					'action' => $dt['sig_uo'],
				),
				array(
					'name' => 'MFI (14)',
					'value' => $dt['mfi_14'],
					'action' => $dt['sig_mfi_14'],
				),
			);
		}
		
		return $returnDat;
	}
	
	function actionMoveAvg($data)
	{
		if ($data['total_buy_moving'] == 0 && $data['total_sell_moving'] == 0)
		{
			$status = 'NETRAL';
			$colorsts = '#000000';
		}
		elseif ($data['total_buy_moving'] == 0)
		{
			if ($data['total_sell_moving'] > 2)
			{
				$status = 'STRONG SELL';
				$colorsts = '#F80000';
			}
			elseif ($data['total_sell_moving'] > 1 && $data['total_sell_moving'] <= 2)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			elseif ($data['total_sell_moving'] == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			elseif ($data['total_sell_moving'] < 1 && $data['total_sell_moving'] >= 0.5)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			elseif ($data['total_sell_moving'] < 0.5)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		elseif ($data['total_sell_moving'] == 0)
		{
			if ($data['total_buy_moving'] > 2)
			{
				$status = 'STRONG BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_moving'] > 1 && $data['total_buy_moving'] <= 2)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_moving'] == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			elseif ($data['total_buy_moving'] < 1 && $data['total_buy_moving'] >= 0.5)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_moving'] < 0.5)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		else {
			if(($data['total_buy_moving']/$data['total_sell_moving']) > 2)
			{
				$status = 'STRONG BUY';
				$colorsts = '#13AC13';
			}
			elseif (($data['total_buy_moving']/$data['total_sell_moving']) > 1 && ($data['total_buy_moving']/$data['total_sell_moving']) <= 2)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif (($data['total_buy_moving']/$data['total_sell_moving']) == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			elseif (($data['total_buy_moving']/$data['total_sell_moving']) < 1 && ($data['total_buy_moving']/$data['total_sell_moving']) >= 0.5)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			elseif (($data['total_buy_moving']/$data['total_sell_moving']) < 0.5)
			{
				$status = 'STRONG SELL';
				$colorsts = '#F80000';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		
		return array(
			'status_moving' => $status,
			'colorcode_moving' => $colorsts,
			'total_buy_moving' => $data['total_buy_moving'],
            'total_sell_moving' => $data['total_sell_moving'],
		);
	}
	
	function customMoveAvg($data)
	{
		foreach($data as $dt){
			$returnDat = array(
				array(
					'name' => 'MA 5',
					'simple_val' => $dt['ma_5'],
					'simple_act' => $dt['sig_ma_5'],
					'exponen_val' => $dt['ema_5'],
					'exponen_act' => $dt['sig_ema_5'],
				),
				array(
					'name' => 'MA 10',
					'simple_val' => $dt['ma_10'],
					'simple_act' => $dt['sig_ma_10'],
					'exponen_val' => $dt['ema_10'],
					'exponen_act' => $dt['sig_ema_10'],
				),
				array(
					'name' => 'MA 20',
					'simple_val' => $dt['ma_20'],
					'simple_act' => $dt['sig_ma_20'],
					'exponen_val' => $dt['ema_20'],
					'exponen_act' => $dt['sig_ema_20'],
				),
				array(
					'name' => 'MA 50',
					'simple_val' => $dt['ma_50'],
					'simple_act' => $dt['sig_ma_50'],
					'exponen_val' => $dt['ema_50'],
					'exponen_act' => $dt['sig_ema_50'],
				),
				array(
					'name' => 'MA 100',
					'simple_val' => $dt['ma_100'],
					'simple_act' => $dt['sig_ma_100'],
					'exponen_val' => $dt['ema_100'],
					'exponen_act' => $dt['sig_ema_100'],
				),
				array(
					'name' => 'MA 200',
					'simple_val' => $dt['ma_200'],
					'simple_act' => $dt['sig_ma_200'],
					'exponen_val' => $dt['ema_200'],
					'exponen_act' => $dt['sig_ema_200'],
				),
			);
		}
		
		return $returnDat;
	}
	
	function actionEffectVal($data)
	{
		if ($data['total_accu_effective'] == 0 && $data['total_dist_effective'] == 0)
		{
			$status = 'NETRAL';
			$colorsts = '#000000';
		}
		elseif ($data['total_accu_effective'] == 0)
		{
			if ($data['total_dist_effective'] > 1)
			{
				$status = 'DISTRIBUTION';
				$colorsts = '#F80000';
			}
			elseif ($data['total_dist_effective'] == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		elseif ($data['total_dist_effective'] == 0)
		{
			if ($data['total_accu_effective'] > 1)
			{
				$status = 'ACCUMULATION';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_accu_effective'] == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		else
		{
			if (($data['total_accu_effective']/$data['total_dist_effective']) > 1)
			{
				$status = 'ACCUMULATION';
				$colorsts = '#13AC13';
			}
			elseif (($data['total_accu_effective']/$data['total_dist_effective']) == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			elseif (($data['total_accu_effective']/$data['total_dist_effective']) < 1)
			{
				$status = 'DISTRIBUTION';
				$colorsts = '#F80000';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		
		return array(
			'status_effective' => $status,
			'colorcode_effective' => $colorsts,
			'total_accu_effective' => $data['total_accu_effective'],
            'total_dist_effective' => $data['total_dist_effective'],
		);
	}
	
	function customEffectVal($data)
	{
		foreach($data as $dt){
			$returnDat = array(
				array(
					'periode' => '1',
					'value_billion' => $dt['ss_period_1'],
					'nett_action' => $dt['ss_sig_period_1'],
				),
				array(
					'periode' => '5',
					'value_billion' => $dt['ss_period_5'],
					'nett_action' => $dt['ss_sig_period_5'],
				),
				array(
					'periode' => '10',
					'value_billion' => $dt['ss_period_10'],
					'nett_action' => $dt['ss_sig_period_10'],
				),
				array(
					'periode' => '20',
					'value_billion' => $dt['ss_period_20'],
					'nett_action' => $dt['ss_sig_period_20'],
				),
			);
		}
		
		return $returnDat;
	}
	
	function actionForeNbs($data)
	{
		if ($data['total_buy_foreign'] == 0 && $data['total_sell_foreign'] == 0)
		{
			$status = 'NETRAL';
			$colorsts = '#000000';
		}
		elseif ($data['total_buy_foreign'] == 0)
		{
			if ($data['total_sell_foreign'] > 2)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			elseif ($data['total_sell_foreign'] > 1 && $data['total_sell_foreign'] <= 2)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			elseif ($data['total_sell_foreign'] == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			elseif ($data['total_sell_foreign'] < 1 && $data['total_sell_foreign'] >= 0.5)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			elseif ($data['total_sell_foreign'] < 0.5)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		elseif ($data['total_sell_foreign'] == 0)
		{
			if ($data['total_buy_foreign'] > 2)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_foreign'] > 1 && $data['total_buy_foreign'] <= 2)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_foreign'] == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			elseif ($data['total_buy_foreign'] < 1 && $data['total_buy_foreign'] >= 0.5)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_foreign'] < 0.5)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		else
		{
			if ($data['total_buy_foreign']/$data['total_sell_foreign'] > 2)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_foreign']/$data['total_sell_foreign'] > 1 && $data['total_buy_foreign']/$data['total_sell_foreign'] <= 2)
			{
				$status = 'BUY';
				$colorsts = '#13AC13';
			}
			elseif ($data['total_buy_foreign']/$data['total_sell_foreign'] == 1)
			{
				$status = 'NETRAL';
				$colorsts = '#000000';
			}
			elseif ($data['total_buy_foreign']/$data['total_sell_foreign'] < 1 && $data['total_buy_foreign']/$data['total_sell_foreign'] >= 0.5)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			elseif ($data['total_buy_foreign']/$data['total_sell_foreign'] < 0.5)
			{
				$status = 'SELL';
				$colorsts = '#F80000';
			}
			else
			{
				$status = 'ERROR';
				$colorsts = '#000000';
			}
		}
		 
	    return array(
			'status_foreign' => $status,
			'colorcode_foreign' => $colorsts,
			'total_buy_foreign' => $data['total_buy_foreign'],
            'total_sell_foreign' => $data['total_sell_foreign'],
		);
	}
	
	function customForeNbs($data)
	{
		foreach($data as $dt){
			$returnDat = array(
				array(
					'periode' => '1',
					'value_billion' => $dt['period_1'],
					'action' => $dt['sig_period_1'],
				),
				array(
					'periode' => '5',
					'value_billion' => $dt['period_5'],
					'action' => $dt['sig_period_5'],
				),
				array(
					'periode' => '10',
					'value_billion' => $dt['period_10'],
					'action' => $dt['sig_period_10'],
				),
				array(
					'periode' => '20',
					'value_billion' => $dt['period_20'],
					'action' => $dt['sig_period_20'],
				),
			);
		}
		
		return $returnDat;
	}

	function getPrevStatusColor($input){
		if ($input == "Buy" || $input == "Avg Up"){
			$output = "#13AC13";
		}
		else if ($input == "Sell")
		{
			$output = "#F80000";
		}
		else {
			$output = "#000000";
		}

		return $output;
	}

	function getSigDslColor($input){
		if ($input == "Buy" || $input == "Avg Up"){
			$output = "#13AC13";
		}
		else if ($input == "Sell")
		{
			$output = "#F80000";
		}
		else {
			$output = "#000000";
		}

		return $output;
	}

	function getChgColor($input){
		if ($input > 0.00){
			$output = "#13AC13";
		}
		else if ($input < 0.00)
		{
			$output = "#F80000";
		}
		else {
			$output = "#000000";
		}

		return $output;
	}

	function getPercentDsl($dsl, $close){
		$output = ($dsl - $close) / $close * 100;

		return $output;
	}

	function getColorPercentDsl($input){
		if ($input > 0.00){
			$output = "#13AC13";
		}
		else if ($input < 0.00)
		{
			$output = "#F80000";
		}
		else {
			$output = "#000000";
		}

		return $output;
	}

	function getPercentPivot($pivot, $close){
		$output = ($pivot - $close) / $close * 100;

		return $output;
	}

	function getColorPercentPivot($input){
		if ($input > 0.00){
			$output = "#13AC13";
		}
		else if ($input < 0.00)
		{
			$output = "#F80000";
		}
		else {
			$output = "#000000";
		}

		return $output;
	}
	
	public function fGetStart($kode, $timeframe){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
			
			if ($decoded) {
					$quotesModel 	= new StockQuoteModel();
					$techIndiModel 	= new StockTechIndiModel();
					$moveAvgModel 	= new StockMoveAvgModel();
					$effectValModel = new StockEffectValModel();
					$foreNbsModel 	= new StockForeNbsModel();
					
					$quoteData 		= $quotesModel->where("code", $kode)->first();
					$techIndiData 	= $techIndiModel->where("code", $kode)->where("timeframe", $timeframe)->find();
					$moveAvgData 	= $moveAvgModel->where("code", $kode)->where("timeframe", $timeframe)->find();
					$effectValData 	= $effectValModel->where("code", $kode)->where("timeframe", $timeframe)->find();
					$foreNbsData 	= $foreNbsModel->where("code", $kode)->where("timeframe", $timeframe)->find();
					
					if($quoteData)
					{
						$timefr = [
						  'timeframe' => $timeframe,
						];
						
						$replaced = array_replace($quoteData, $timefr);
					}
					
					$alldata = [
						'quotes' 				=> $replaced,
						'technical_indicators'	=> $this->customTechIndi($techIndiData),
						'moving_averages'		=> $this->customMoveAvg($moveAvgData),
						'foreign_nbs'			=> $this->customForeNbs($foreNbsData),
						'effective_value'		=> $this->customEffectVal($foreNbsData),
						'statistic'				=> $this->getStatistic($kode, $timeframe, $replaced),
					];
										
					if ($quoteData) {
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Stock Review',
							'data' => $alldata,
						];
						return $this->respondCreated($response);
					} 
					else {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Data not found'
						];
						return $this->respondCreated($response);
					}
			} else {
				$response = [
					'status' => 500,
					'error' => TRUE,
					'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
				];
				return $this->respondCreated($response);
			}
		} catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function getTimeline()
	{
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
			
			if ($decoded) {
				$returnDat = array(
					array(
						'name' => 'Weekly',
						'timeframe' => 'Weekly',
					),
					array(
						'name' => 'Daily',
						'timeframe' => 'Daily',
					),
					array(
						'name' => 'Hourly',
						'timeframe' => 'Hourly',
					),
					array(
						'name' => '30min',
						'timeframe' => '30-minute',
					),
					array(
						'name' => '15min',
						'timeframe' => '15-minute',
					),
					array(
						'name' => '05min',
						'timeframe' => '5-minute',
					),
				);
				
				if ($returnDat) {
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data Timeframe',
						'data' => $returnDat,
					];
					return $this->respondCreated($response);
				} 
				else {
					$response = [
						'status' => 401,
						'error' => TRUE,
						'messages' => 'Access denied'
					];
					return $this->respondCreated($response);
				}
			}
		} catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function getSystemTrade()
	{
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
			
			if ($decoded) {
				$returnDat = array(
					array(
						'system' => 'Cah',
					),
				);
				
				if ($returnDat) {
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data System Trade',
						'data' => $returnDat,
					];
					return $this->respondCreated($response);
				} 
				else {
					$response = [
						'status' => 401,
						'error' => TRUE,
						'messages' => 'Access denied'
					];
					return $this->respondCreated($response);
				}
			}
		} catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function getIntervalWatchlist()
	{
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
			
			if ($decoded) {
				$returnDat = array(
					array(
						'interval' => 'Daily',
						'deskripsi' => 'D/Daily'
					),
					array(
						'interval' => 'Hourly',
						'deskripsi' => 'H/Hourly'
					),
				);
				
				if ($returnDat) {
					$response = [
						'status' => 200,
						'error' => FALSE,
						'messages' => 'Data Interval Watchlist',
						'data' => $returnDat,
					];
					return $this->respondCreated($response);
				} 
				else {
					$response = [
						'status' => 401,
						'error' => TRUE,
						'messages' => 'Access denied'
					];
					return $this->respondCreated($response);
				}
			}
		} catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function getWatchlist(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
			
			if ($decoded) {
					$watchlistModel = new StockWatchlistModel();
					$kodeUser = $this->request->getGet("kode_user");
					//$data = $watchlistModel->getData($kodeUser);
					$data = $watchlistModel->getDataTes($kodeUser);
					
					foreach($data as $dt){
						$dsl_perc = round($this->getPercentDsl($dt['dsl'], $dt['close']), 2);
						$pivot_perc = round($this->getPercentPivot($dt['pivot_r2'], $dt['close']), 2);

						$out[] = array(
							'id'		    => $dt['id'],
							'kode_user'		=> $dt['kode_user'],
							'code' 			=> $dt['code'],
							'codename' 		=> $dt['codename'],
							'timeframe' 	=> $dt['timeframe'],
							'dsl' 			=> $dt['dsl'],
							'dsl_percent'	=> $dsl_perc,
							'dsl_percent_color'	=> $this->getColorPercentDsl($dsl_perc),
							'system' 		=> 'Cah',
							'pivot_r2' 		=> $dt['pivot_r2'],
							'pivot_r2_percent'	=> $pivot_perc,
							'pivot_r2_color'	=> $this->getColorPercentPivot($pivot_perc),
							'close' 		=> $dt['close'],
							'close_color' 	=> $this->getSigDslColor($dt['sig_dsl']),
							'chg' 			=> $dt['chg'],
							'chg_color'		=> $this->getChgColor($dt['chg']),
							'sig_dsl' 		=> $dt['sig_dsl'] == '' ? '-' : $dt['sig_dsl'],
							'sig_dsl_color' => $this->getSigDslColor($dt['sig_dsl']),
							'prev_sig_dsl' 	=> $dt['prev_sig_dsl'],
							'prev_sig_dsl_color' => $this->getPrevStatusColor($dt['prev_sig_dsl']),
						);
					}
										
					if ($data) {
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Smart Watchlist',
							'data' => $out,
							//'data' => $data,
						];
						return $this->respondCreated($response);
					} 
					else {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Data not found'
						];
						return $this->respondCreated($response);
					}
			} else {
				$response = [
					'status' => 500,
					'error' => TRUE,
					'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
				];
				return $this->respondCreated($response);
			}
		} catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function getWatchlistTes(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
			
			if ($decoded) {
					$watchlistModel = new StockWatchlistModel();
					$kodeUser = $this->request->getGet("kode_user");
					$data = $watchlistModel->getDataTes($kodeUser);
					
					/* foreach($data as $dt){
						$dsl_perc = round($this->getPercentDsl($dt['dsl'], $dt['close']), 2);
						$pivot_perc = round($this->getPercentPivot($dt['pivot_r2'], $dt['close']), 2);

						$out[] = array(
							'id'		    => $dt['id'],
							'kode_user'		=> $dt['kode_user'],
							'code' 			=> $dt['code'],
							'codename' 		=> $dt['codename'],
							'timeframe' 	=> $dt['timeframe'],
							'dsl' 			=> $dt['dsl'],
							'dsl_percent'	=> $dsl_perc,
							'dsl_percent_color'	=> $this->getColorPercentDsl($dsl_perc),
							'system' 		=> 'Cah',
							'pivot_r2' 		=> $dt['pivot_r2'],
							'pivot_r2_percent'	=> $pivot_perc,
							'pivot_r2_color'	=> $this->getColorPercentPivot($pivot_perc),
							'close' 		=> $dt['close'],
							'close_color' 	=> $this->getSigDslColor($dt['sig_dsl']),
							'chg' 			=> $dt['chg'],
							'chg_color'		=> $this->getChgColor($dt['chg']),
							'sig_dsl' 		=> $dt['sig_dsl'] == '' ? '-' : $dt['sig_dsl'],
							'sig_dsl_color' => $this->getSigDslColor($dt['sig_dsl']),
							'prev_sig_dsl' 	=> $dt['prev_sig_dsl'],
							'prev_sig_dsl_color' => $this->getPrevStatusColor($dt['prev_sig_dsl']),
						);
					} */
										
					if ($data) {
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Smart Watchlist',
							//'data' => $out,
							'data' => $data,
						];
						return $this->respondCreated($response);
					} 
					else {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Data not found'
						];
						return $this->respondCreated($response);
					}
			} else {
				$response = [
					'status' => 500,
					'error' => TRUE,
					'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
				];
				return $this->respondCreated($response);
			}
		} catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
	
	public function getTickerWatchlist(){
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
			
			if ($decoded) {
					$quoteModel = new StockQuoteModel();
					$kode = $this->request->getGet("inputan");
					
					if ($kode != ''){
						$data = $quoteModel->like('code', $kode, 'after')->orderBy('code','ASC')->find();
					}
					else
					{
						$data = $quoteModel->orderBy('code','ASC')->find();
					}
					
					
					foreach ($data as $dt) {
						$output[] = array(
							"codename" 		=> $dt['code'],
							"deskripsi"		=> $dt['codename'],
						);
					}
										
					if ($data) {
						$response = [
							'status' => 200,
							'error' => FALSE,
							'messages' => 'Data Ticker Watchlist',
							'data' => $output,
						];
						return $this->respondCreated($response);
					} 
					else {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Data not found'
						];
						return $this->respondCreated($response);
					}
			} else {
				$response = [
					'status' => 500,
					'error' => TRUE,
					'messages' => 'Command yang anda masukkan salah, silahkan coba lagi',
				];
				return $this->respondCreated($response);
			}
		} catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

	public function insertWatchlist()
	{
		$key = $this->myKey();
		
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
			$watchlistModel = new StockWatchlistModel();
			$trwatchlistModel = new StockTrWatchlistModel();
			$dataPasarModel = new StockDataPasarModel();

            if ($decoded) {
                $kodeUser = $this->request->getVar('kode_user');
        		$code = $this->request->getVar('code');
        		$timeframe = $this->request->getVar('timeframe');

				$dataTr = array(
					'id' => null,
					'kode_user' => $kodeUser,
					'code' => $code,
					'timeframe' => $timeframe,
				);
											
				$trwatchlistModel->insert($dataTr);
				
				if ($kodeUser != '' && $code != '' && $timeframe != '')
				{
					$isExist = $watchlistModel->select('*')->where('kode_user', $kodeUser)
													  ->where('code', $code)
													  ->where('timeframe', $timeframe)
													  ->first();

					if (!empty($isExist)){
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Data has exist'
						];
						return $this->respondCreated($response);
					}
					else {
						$tmp = $dataPasarModel->select('*')->where('code', $code)
													   ->where('timeframe', $timeframe)
													   ->orderBy('lastupdate', 'DESC')
													   ->first();

						if (!empty($tmp)){
							$data = array(
								'id' => null,
								'kode_user' => $kodeUser,
								'code' => $code,
								'timeframe' => $timeframe,
								'last_update' => $tmp['lastupdate'],
								'close' => $tmp['close'],
								'dsl' => $tmp['dsl'],
								'pivot_r2' => $tmp['pivot_r2'],
								'sig_dsl' => $tmp['sig_dsl'],
							);
														
							$watchlistModel->insert($data);
												
							$response = [
								'status' => 200,
								'error' => FALSE,
								'messages' => 'Data successfully created',
							];

							return $this->respondCreated($response);
						}
						else
						{
							$response = [
								'status' => 200,
								'error' => FALSE,
								'messages' => 'Data conflict',
								];
							return $this->respondCreated($response);
						}
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Insert data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}

	public function deleteWatchlist($kode = null) {
		$key = $this->myKey();
        $authHeader = $this->request->getHeader("X-Auth");
		if ($authHeader != '')
		{
			$authHeader = $authHeader->getValue();
			$token = $authHeader;
		}
		else
		{
			$response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
		}
        
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
				$watchlistModel = new StockWatchlistModel();

				if ($kode != '')
				{
					$existData 	= $watchlistModel->where("id", $kode)->first();

					if ($existData){
						$watchlistModel->delete($kode);
				
						$response = [
							'status' => 201,
							'error' => FALSE,
							'messages' => 'Successfully delete watchlist data',
						];

						
						return $this->respondCreated($response);
					}
					else {
						$response = [
							'status' => 500,
							'error' => TRUE,
							'messages' => 'Invalid data watchlist',
						];
						
						return $this->respondCreated($response);
					}
				}
				else
				{
					$response = [
						'status' => 500,
						'error' => TRUE,
						'messages' => 'Delete data refused'
					];
					return $this->respondCreated($response);
				}
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }
	}
}