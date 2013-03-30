<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function generate_table($h_from, $h_to, $reserved_dates, $ref_time) {
		$day = 24 * 60 * 60;
		$monday = $ref_time - (date('w', $ref_time) - 1) * $day;

		// table header
		$day_names = array('hétfo', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat', 'vasárnap');
		echo '<table><tr><th></th>';

		$i = 0;
		foreach ($day_names as $day_name) {
			echo "<th>$day_name<br/><small>".date("Y-m-d", $monday + $i++ * $day).'</small></th>';
		}
		
		echo '</tr>';
		
		// table body
		for ($hour = $h_from; $hour <= $h_to; $hour++) {
			echo "<tr><td>$hour:00</td>";
			
			for ($day_of_week = 1; $day_of_week <= 7; $day_of_week++) {
				if (isset($reserved_dates[$hour][$day_of_week])) {
					echo "<td>".img(array('src' => 'assets/img/reserved.gif', 'title' => 'Foglalt időpont!', 'alt' => $reserved_dates[$hour][$day_of_week]['appointment']))."</td>";
				} else {
					if ($day_of_week < date('w', time()) || ( $day_of_week == date('w', time()) && $hour <= date('G', time()) )) {
						echo '<td class="timebox_passed" alt="'. date("Y-m-d", $monday + ($day_of_week - 1) * $day) . " " . $hour.':00"></td>';
					}	else {
						echo '<td class="timebox" alt="'. date("Y-m-d", $monday + ($day_of_week - 1) * $day) . " " . $hour.':00"></td>';
					}
				}
			}
			
			echo "</tr>";
		}
		
		echo '</table>';
	}
	
}
