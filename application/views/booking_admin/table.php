<?php
// table header
echo '<span id="head-timestamp">' .$headTimestamp. '</span>';
echo '<table id="calendar-table"><tr>';
echo '<th><span id="calendar-label">keresés</span>'.form_input(array('id' => 'blank-cell')).'</th>';

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
			echo '<td class="timebox-passed"></td>';
		} else {
			// if in the present week or future
			if (isset($bookings[$cellTimestamp])) {
				if (empty($bookings[$cellTimestamp]['status'])) {
					echo '<td class="reserved-cell">';
				} elseif ($bookings[$cellTimestamp]['payment-option'] == 'card') {
					echo '<td class="reserved-cell-at">';
				} elseif ($bookings[$cellTimestamp]['payment-option'] == 'cache') {
					echo '<td class="reserved-cell-kp">';
				}
			
				echo '<a href="'.base_url().'index.php/admin/booking/edit/'.$bookings[$cellTimestamp]['id'].'"><div style="width: 90px; height: 34px;"></div></a></td>';
			} else {
				echo '<td class="timebox"><a href="'.base_url().'index.php/admin/booking/add/'.$cellTimestamp.'"><div style="width: 90px; height: 34px;"></div></a></td>';
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

	$('#blank-cell').css('cursor', 'pointer');
	$('#blank-cell').datepicker({
		firstDay: 1,
		dateFormat: 'yy-mm-dd',
		minDate: 0
	});

	$('#blank-cell').change(function(){
		var monday = getMonday(new Date($('#blank-cell').val()));
		$('#table-wrapper').invisible().promise().done(function(){
			refreshTable(strtotime(monday.toString()));
			$(this).delay(450).visible();
		});
	});

</script>