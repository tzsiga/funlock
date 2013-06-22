<?php
// table header, alt param contains the actual reference time variable
echo '<span id="reference_time">' .$headTimestamp. '</span>';
echo '<table id="calendar_table"><tr>';
echo '<th><span id="calendar_label">keresés</span>'.form_input(array('id' => 'blank_cell')).'</th>';

$dayNames = array('- H -', '- K -', '- SZ -', '- CS -', '- P -', '- SZ -', '- V -');
$i = 0;
foreach ($dayNames as $dayName) {
	echo "<th>$dayName<br/><small>".date('Y-m-d', Utils::getLastMonday($headTimestamp) + $i++ * Utils::dayInSec).'</small></th>';
}

echo '</tr>';

// table body
for ($hourIndex = Utils::hourFrom; $hourIndex <= Utils::hourTo; $hourIndex += Utils::hourStep) {
	echo (int)$hourIndex == $hourIndex ? "<tr><td>$hourIndex:00</td>" : "<tr><td>".(int)$hourIndex.":30</td>";
	
	for ($dayIndex = 1; $dayIndex <= 7; $dayIndex++) {
		$cellTimestamp = Utils::getLastMonday($headTimestamp) + ($dayIndex - 1) * Utils::dayInSec + $hourIndex * Utils::hourInSec;
		
		if ($cellTimestamp < time()) {
			// if we are in the past
			echo '<td class="timebox_passed"></td>';
		} else {
			// if in the present week or future
			if (isset($bookings[$cellTimestamp])) {
				if ($bookings[$cellTimestamp]['payment_option'] == 'card') {
					echo '<td class="reserved_cell_at">';
				} elseif ($bookings[$cellTimestamp]['payment_option'] == 'cache') {
					echo '<td class="reserved_cell_kp">';
				}
			
				echo '<a href="'.base_url().'index.php/booking/editBooking/'.$bookings[$cellTimestamp]['id'].'"><div style="width: 90px; height: 34px;"></div></a></td>';
			} else {
				echo '<td class="timebox"><a href="'.base_url().'index.php/booking/addBookingAsAdmin/'.$cellTimestamp.'"><div style="width: 90px; height: 34px;"></div></a></td>';
			}
		}
	}
	
	echo "</tr>";
}

echo '</table>';
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