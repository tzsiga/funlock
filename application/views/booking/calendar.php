<?php

function generate_table($reserved_dates, $ref_time) {
	$h_from = 10;
	$h_to = 22;

	$day = 24 * 3600;
	$week = 7 * $day;
	
	$ref_day_of_week = date('w', $ref_time);
	
	if ($ref_day_of_week == 0) {
		$ref_day_of_week = 7;
	}
	
	$current_time = date('H') * 3600 + date('i') * 60;
	$monday = $ref_time - ($ref_day_of_week - 1) * $day - $current_time;

	// table header, alt param contains the actual reference time variable
	echo '<table id="calendar_table"><tr id="reference_time" alt="'.$ref_time.'"><th></th>';

	$day_names = array('hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat', 'vasárnap');
	$i = 0;
	foreach ($day_names as $day_name) {
		echo "<th>$day_name<br/><small>".date("Y-m-d", $monday + $i++ * $day).'</small></th>';
	}
	
	echo '</tr>';
	
	// table body
	for ($hour = $h_from; $hour <= $h_to; $hour++) {
		echo "<tr><td>$hour:00</td>";
		
		for ($day_of_week = 1; $day_of_week <= 7; $day_of_week++) {
			
			$cell_time = $monday + ($day_of_week - 1) * $day + $hour * 3600;
			
			if ($cell_time <= time()) {
				// if cell is in the past
				echo '<td class="timebox_passed" alt="'. date("Y-m-d", $monday + $day_of_week * $day) . " " . $hour.':00"></td>';				
			} else {
				// present week or future
				
				// if the cell has an appointment
				if (isset($reserved_dates[$hour][$day_of_week])) {
					// check if appointment is in cursor range
					if ($reserved_dates[$hour][$day_of_week]['appointment'] > $monday && $reserved_dates[$hour][$day_of_week]['appointment'] < $monday + $week) {
						echo "<td>".img(array('src' => 'assets/img/reserved.gif', 'title' => 'Foglalt időpont!', 'alt' => $reserved_dates[$hour][$day_of_week]['appointment']))."</td>";
					} else {
						echo '<td class="timebox" alt="'. date("Y-m-d", $monday + $day_of_week * $day) . " " . $hour.':00"></td>';
					}
				} else {
					echo '<td class="timebox" alt="'. date("Y-m-d", $monday + $day_of_week * $day) . " " . $hour.':00"></td>';
				}
			}
		}
		
		echo "</tr>";
	}
	
	echo '</table>';
}

generate_table($reserved_dates, $ref_time);

?>