<?php

function generate_table($reserved_dates, $ref_time, $selected_appointment) {
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
					echo '<td class="reserved_cell"></td>';
				} else {
					if ($cell_time == $selected_appointment) {
						echo '<td class="timebox" style="-moz-box-shadow: 8px 8px 15px #888888; -webkit-box-shadow: 8px 8px 15px #888888; box-shadow: 8px 8px 15px #888888; position: relative; z-index: 3; background-image: url(\''.base_url().'/assets/img/main/selected.png\')">'. date('Y-m-d H:i', $cell_time) .'</td>';
					} else {
						echo '<td class="timebox">'. date('Y-m-d H:i', $cell_time) .'</td>';
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
		$('#table_wrapper').invisible().promise().done(function(){
			refreshTable(strtotime(monday.toString()));
			$(this).delay(450).visible();
		});
	});

	$('td.timebox').click(function(){
		$('td.timebox').css('-moz-box-shadow', 'none');
		$('td.timebox').css('-webkit-box-shadow', 'none');
		$('td.timebox').css('box-shadow', 'none');
		$('td.timebox').css('z-index', '0');
		$('td.timebox').css('background-image', 'none');
		
		$(this).css('-moz-box-shadow', '8px 8px 15px #888888');
		$(this).css('-webkit-box-shadow', '8px 8px 15px #888888');
		$(this).css('box-shadow', '8px 8px 15px #888888');
		$(this).css('position', 'relative');
		$(this).css('z-index', '3');
		$(this).css('background-image', "url('<?= base_url() ?>/assets/img/main/selected.png')");
		
		$('#booking_details').visible();
		
		if ($('#booking_details > form').attr('id') == 'error_form') {
			$.ajax({
				url: '<?= base_url() ?>index.php/booking/loadBookingForm',
				type: 'POST'
			}).success(function(result) {
				$('#booking_details').html(result);
			});
		}
		
		$("input[name=appointment]").val($(this).text());
	});

</script>