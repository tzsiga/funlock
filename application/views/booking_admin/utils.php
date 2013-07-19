<?php
	function getPlaytimeRangeDropdownValues() {
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
?>