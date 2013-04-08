<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils {

	public static function dump($var) {
		if (is_array($var) || is_object($var)) {
			echo '<pre>';
			print_r($var);
			echo '</pre>';
		} else {
			var_dump($var);
		}
	}

	const hour = 3600;
	const day = 86400;				// 24 * 3600
	const week = 604800;			// 7 * 24 * 3600
	
	const hour_from = 10;
	const hour_to = 22;
	
	public static function day_of_week($timestamp) {
		$day_of_week = date('w', $timestamp);
		return ($day_of_week == 0) ? 7 : $day_of_week;
	}

	public static function monday($timestamp) {
		$current_time = (date('H', $timestamp) - 1) * Utils::hour + date('i', $timestamp) * 60 + date('s', $timestamp);
		return $timestamp - (Utils::day_of_week($timestamp) - 1) * Utils::day - $current_time - Utils::hour;
	}

}