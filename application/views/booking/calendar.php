<?php

function generate_table($reserved_dates, $ref_time) {
	// table header, alt param contains the actual reference time variable
	echo '<table id="calendar_table"><tr id="reference_time" alt="'.$ref_time.'"><th></th>';

	$day_names = array('hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat', 'vasárnap');
	$i = 0;
	foreach ($day_names as $day_name) {
		echo "<th>$day_name<br/><small>".date('Y-m-d', Utils::monday($ref_time) + $i++ * Utils::day).'</small></th>';
	}
	
	echo '</tr>';
	
	// table body
	for ($hour_index = Utils::hour_from; $hour_index <= Utils::hour_to; $hour_index++) {
		echo "<tr><td>$hour_index:00</td>";
		
		for ($day_index = 1; $day_index <= 7; $day_index++) {
			$cell_time = Utils::monday($ref_time) + ($day_index - 1) * Utils::day + $hour_index * Utils::hour;
			
			if ($cell_time < time()) {
				// if we are in the past
				echo '<td class="timebox_passed" alt=""></td>';
			} else {
				// if in the present week or future
				if (isset($reserved_dates[$cell_time])) {
					echo "<td>".img(array('src' => 'assets/img/reserved.gif', 'title' => 'Foglalt időpont!', 'alt' => $reserved_dates[$cell_time]['id']))."</td>";
				} else {
					echo '<td class="timebox" alt="'. date('Y-m-d H:i', $cell_time) .'"></td>';
				}
			}
		}
		
		echo "</tr>";
	}
	
	echo '</table>';
}

generate_table($reserved_dates, $ref_time);

?>