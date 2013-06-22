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
	
	const hourInSec 	= 3600;				// 60 * 60
	const dayInSec		= 86400;			// 60 * 60 * 24
	const weekInSec 	= 604800;			// 60 * 60 * 24 * 7
	
	const hourFrom 		= 12;
	const hourTo 			= 23;
	const hourStep 		= 1.5;
	
	private static function getDayNumber($timestamp) {
		return (date('w', $timestamp) == 0) ? 7 : date('w', $timestamp);
	}
	
	public static function getLastMonday($timestamp) {
		$currentTime = (date('H', $timestamp) - 1) * Utils::hourInSec + date('i', $timestamp) * 60 + date('s', $timestamp);
		return $timestamp - (Utils::getDayNumber($timestamp) - 1) * Utils::dayInSec - $currentTime - Utils::hourInSec;
	}

}