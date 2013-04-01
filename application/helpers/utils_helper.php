<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

	public static function hour() {
		return 3600;
	}
	
	public static function day() {
		return 24 * 3600;
	}
	
	public static function week() {
		return 7 * 24 * 3600;
	}

	public static function day_of_week($timestamp) {
		$day_of_week = date('w', $timestamp);
		return ($day_of_week == 0) ? 7 : $day_of_week;
	}

	public static function monday($timestamp) {
		$current_time = (date('H', $timestamp) - 1) * Utils::hour() + date('i', $timestamp) * 60 + date('s', $timestamp);
		return $timestamp - (Utils::day_of_week($timestamp) - 1) * Utils::day() - $current_time - Utils::hour();
	}

}