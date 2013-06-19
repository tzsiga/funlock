<?php
	function getTimeRangeDropdownValues() {
		$values = range(Utils::hour_from, Utils::hour_to, Utils::hour_step);
		$labels = array();
		
		foreach ($values as $val) {
			$labels[] = (int)$val == $val ? $val.':00' : ((int)$val).':30';
		}
		
		$midnight = array(0 => '0:00');
		$hours = array_combine($values, $labels);
		array_pop($hours);
		
		return $midnight + $hours;
	}
?>