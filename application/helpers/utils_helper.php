<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils {

  const hourInSec   = 3600;       // 60 * 60
  const dayInSec    = 86400;      // 60 * 60 * 24
  const weekInSec   = 604800;     // 60 * 60 * 24 * 7

  const hourFrom    = 12;
  const hourTo      = 23;
  const hourStep    = 1.5;

  public static $voucherStatuses = array('infinite' => 'végtelenített', 'active' => 'aktív', 'used' => 'felhasznált');

  public static function dump($var) {
    if (is_array($var) || is_object($var)) {
      echo '<pre>';
      print_r($var);
      echo '</pre>';
    } else {
      var_dump($var);
    }
  }

  public static function getLastMonday($timestamp) {
    $last = $timestamp - (Utils::getDayNumber($timestamp) - 1) * Utils::dayInSec - Utils::getTimeInSec($timestamp);

    if (date('H', $last) == 1)
      $last -= Utils::hourInSec;

    return $last;
  }

  public static function getCase($posted) {
    foreach ($posted as $name => $value) {
      if (preg_match('/save/', $name)) {
        return 'save';
      } else if (preg_match('/delete/', $name)) {
        return 'delete';
      }
    }

    return null;
  }

  public static function getPlaytimeRangeDropdownValues() {
    $values = range(Utils::hourFrom, Utils::hourTo, Utils::hourStep);
    $labels = array();
    
    foreach ($values as $val) {
      $labels[] = (int)$val == $val ? $val.':00' : ((int)$val).':30';
    }
    
    $hours = array_combine($values, $labels);
    
    if (Utils::hourTo == 24) {
      array_pop($hours);
      return $hours + array(0 => '0:00');
    }
    
    return $hours;
  }

  private static function getTimeInSec($timestamp) {
    return (date('H', $timestamp) - 1) * Utils::hourInSec + date('i', $timestamp) * 60 + date('s', $timestamp);
  }

  private static function getDayNumber($timestamp) {
    return (date('w', $timestamp) == 0) ? 7 : date('w', $timestamp);
  }
}
