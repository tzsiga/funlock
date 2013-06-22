<?php

function generate_table($reserved_dates, $ref_time) {
	// table header, alt param contains the actual reference time variable
	echo '<span id="reference_time">' .$ref_time. '</span>';
	echo '<table id="calendar_table"><tr>';
	echo '<th><span id="calendar_label">keresés</span>'.form_input(array('id' => 'blank_cell')).'</th>';

	$day_names = array('- H -', '- K -', '- SZ -', '- CS -', '- P -', '- SZ -', '- V -');
	$i = 0;
	foreach ($day_names as $day_name) {
		echo "<th>$day_name<br/><small>".date('Y-m-d', Utils::getLastMonday($ref_time) + $i++ * Utils::dayInSec).'</small></th>';
	}
	
	echo '</tr>';
	
	// table body
	for ($hour_index = Utils::hourFrom; $hour_index <= Utils::hourTo; $hour_index += Utils::hourStep) {
		echo (int)$hour_index == $hour_index ? "<tr><td>$hour_index:00</td>" : "<tr><td>".(int)$hour_index.":30</td>";
		
		for ($day_index = 1; $day_index <= 7; $day_index++) {
			$cell_time = Utils::getLastMonday($ref_time) + ($day_index - 1) * Utils::dayInSec + $hour_index * Utils::hourInSec;
			
			if ($cell_time < time()) {
				// if we are in the past
				echo '<td class="timebox_passed"></td>';
			} else {
				// if in the present week or future
				if (isset($reserved_dates[$cell_time])) {
					if ($reserved_dates[$cell_time]['payment_option'] == 'card') {
						echo '<td class="reserved_cell_at">';
					} elseif ($reserved_dates[$cell_time]['payment_option'] == 'cache') {
						echo '<td class="reserved_cell_kp">';
					}
				
					echo '<a href="'.base_url().'index.php/booking/editBookingAsAdmin/'.$reserved_dates[$cell_time]['id'].'"><div style="width: 90px; height: 34px;"></div></a></td>';
				} else {
					echo '<td class="timebox"><a href="'.base_url().'index.php/booking/addBookingAsAdmin/'.$cell_time.'"><div style="width: 90px; height: 34px;"></div></a></td>';
				}
			}
		}
		
		echo "</tr>";
	}
	
	echo '</table>';
}

generate_table($reserved_dates, $ref_time);

?>

<script type="text/javascript">

	function getMonday(d) {
		d = new Date(d);
		var day = d.getDay();
		var diff = d.getDate() - day + (day == 0 ? -6:1);
		return new Date(d.setDate(diff));
	}

	$('#blank_cell').css('cursor', 'pointer');
	$('#blank_cell').datepicker({
		firstDay: 1,
		dateFormat: 'yy-mm-dd',
		minDate: 0
	});

	$('#blank_cell').change(function(){
		var monday = getMonday(new Date($('#blank_cell').val()));
		$('#table_wrapper').invisible().promise().done(function(){
			refreshTable(strtotime(monday.toString()));
			$(this).delay(450).visible();
		});
	});

</script>