<?php
	
	if(!function_exists('hassession')) {
		function hassession($search){
			$session = \Config\Services::session();
			
			return $session->has($search);
		}
	}
	
	if(!function_exists('getsession')) {
		function getsession($search){
			$session = \Config\Services::session();
			
			return $session->get($search);
		}
	}
	
	if(!function_exists('md5session')) {
		function md5session($search){
			$session = \Config\Services::session();
			
			return md5($session->get($search));
		}
	}
	
	if (!function_exists('rupiah')) {
		function rupiah($val){
			$value = number_format($val, 0, ',', '.');
			return 'Rp. ' . $value;
		}
	}
	
	if (!function_exists('discrupiah')) {
		function discrupiah($val, $disc){
			$price = $val - ($val * ($disc / 100));
			$value = number_format($price, 0, ',', '.');
			return 'Rp. ' . $value;
		}
	}
	
	if (!function_exists('calcdisc')) {
		function calcdisc($val, $disc){
			$price = $val - ($val * ($disc / 100));
			return $price;
		}
	}
	
	if(!function_exists('formatkilo')) {
		function formatkilo($n){
			if($n>1000) {
				$x = round($n);
				$x_number_format = number_format($x);
				$x_array = explode(',', $x_number_format);
				$x_parts = array('K', 'M', 'B', 'T');
				$x_count_parts = count($x_array) - 1;
				$x_display = $x;
				$x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
				$x_display .= $x_parts[$x_count_parts - 1];

				return 'IDR '.$x_display;
			}
			return 'IDR '.$n;
		}
	}
	
	if(!function_exists('time_elapsed_string')) {
		function time_elapsed_string($datetime, $full = false) {
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);

			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;

			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute',
				's' => 'second',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}

			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' ago' : 'just now';
		}
	}
?>