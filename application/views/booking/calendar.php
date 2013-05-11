<?php

function generate_table($reserved_dates, $ref_time, $selected_appointment) {
	// table header, alt param contains the actual reference time variable
	echo '<table id="calendar_table"><tr id="reference_time" alt="'.$ref_time.'"><th><span id="calendar_label">naptár</span>'.form_input(array('id' => 'blank_cell')).'</th>';

	$day_names = array('- H -', '- K -', '- SZ -', '- CS -', '- P -', '- SZ -', '- V -');
	$i = 0;
	foreach ($day_names as $day_name) {
		echo "<th>$day_name<br/><small>".date('Y-m-d', Utils::monday($ref_time) + $i++ * Utils::day).'</small></th>';
	}
	
	echo '</tr>';
	
	// table body
	for ($hour_index = Utils::hour_from; $hour_index <= Utils::hour_to; $hour_index += Utils::hour_step) {
		echo (int)$hour_index == $hour_index ? "<tr><td>$hour_index:00</td>" : "<tr><td>".(int)$hour_index.":30</td>";
		
		for ($day_index = 1; $day_index <= 7; $day_index++) {
			$cell_time = Utils::monday($ref_time) + ($day_index - 1) * Utils::day + $hour_index * Utils::hour;
			
			if ($cell_time < time()) {
				// if we are in the past
				echo '<td class="timebox_passed" alt=""></td>';
			} else {
				// if in the present week or future
				if (isset($reserved_dates[$cell_time])) {
					echo "<td>".img(array('src' => 'assets/img/main/reserved.png', 'class' => 'reserved', 'title' => 'Foglalt időpont!', 'alt' => $reserved_dates[$cell_time]['id']))."</td>";
				} else {
					if ($cell_time == $selected_appointment) {
						echo '<td class="timebox" alt="'. date('Y-m-d H:i', $cell_time) .'" style="background-color: grey"></td>';
					} else {
						echo '<td class="timebox" alt="'. date('Y-m-d H:i', $cell_time) .'"></td>';
					}
				}
			}
		}
		
		echo "</tr>";
	}
	
	echo '</table>';
}

generate_table($reserved_dates, $ref_time, $selected_appointment);

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
		refreshTable(strtotime(monday.toString()));
	});

	$('td.timebox').click(function(){
		$('td.timebox').css('background-color', '');
		$(this).css('background-color', 'grey');
		$("input[name=appointment]").val($(this).attr('alt'));
		$('#booking_details').visible();
	});

</script>