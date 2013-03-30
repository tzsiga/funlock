<?php
	// load html header
	$this->load->view('header');

	function generate_table($h_from, $h_to, $reserved_dates, $ref_time) {
		$day = 24 * 60 * 60;
		$monday = $ref_time - (date('w', $ref_time) - 1) * $day;

		// table header
		$day_names = array('hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat', 'vasárnap');
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

?>
		<body>
		<div id="wrapper_content">
			<div id="navbar">
				<div id="info">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
					Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
					Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
				<div id="menu">
					<ul>
						<li><p id="link_info">Info</a></li>
						<li><p id="link_map">Térkép</a></li>
						<li><p id="link_contact">Elérhetőség</a></li>
					</ul>
				</div>
				<div id="contact">
					Budapest 1023, Galgóczy u. 16. T.: 0036/307726213, info@funlock.hu
				</div>
				<img id="map" src="<?= base_url() ?>assets/img/map.png" alt="" title="" />
			</div>
			<div id="content">
				<div id="calendar">
					<span id="prev_month">&lt;&lt;</span>
					<?php generate_table(11, 20, $reserved_dates, time()); ?>
					<span id="next_month">&gt;&gt;</span>
				</div>
				<div id="reserve_details">
					<form>
						<p>Időpont: <input id="reserve_date" type="text" name="date"></p>
						<p>Vezetéknév: <input type="text" name="firstname">Keresztnév: <input type="text" name="lastname"></p>
						<p><input type="radio" name="payment_option" value="male">Fizetés kártyával</p>
						<p><input type="radio" name="payment_option" value="female">Fizetés készpénzzel</p>
						<p><input type="checkbox" name="eula" value="eula">Egyetértek a <a href="">szerződéssel</a></p><br/>
						<input type="submit" value="Foglalás">
					</form> 
				</div>
			</div>
		</div>
		<?php $this->load->view('jq_calendar'); ?>
	</body>
</html>