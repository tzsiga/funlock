<?php
echo '<span id="head-timestamp">' .$headTimestamp. '</span>';
echo '<table id="calendar-table">';
echo '<tr><th><span id="calendar-label">'.lang("search").'</span>'.form_input(array('id' => 'blank-cell')).'</th>';

$dayNames = array(
  lang("monday"),
  lang("tuesday"),
  lang("wednesday"),
  lang("thursday"),
  lang("friday"),
  lang("saturday"),
  lang("sunday")
);

$i = 0;
foreach ($dayNames as $dayName) {
  echo "<th>$dayName<br/><small>".date('Y-m-d', Utils::getLastMonday($headTimestamp) + $i++ * Utils::dayInSec).'</small></th>';
}

echo '</tr>';

for ($hourIndex = Utils::hourFrom; $hourIndex <= Utils::hourTo; $hourIndex += Utils::hourStep) {
  echo (int)$hourIndex == $hourIndex ? "<tr><td>$hourIndex:00</td>" : "<tr><td>".(int)$hourIndex.":30</td>";
  
  for ($dayIndex = 1; $dayIndex <= 7; $dayIndex++) {
    $cellTimestamp = Utils::getLastMonday($headTimestamp) + ($dayIndex - 1) * Utils::dayInSec + $hourIndex * Utils::hourInSec;
    
    if ($cellTimestamp < time()) {
      // if we are in the past
      echo '<td class="timebox-passed"></td>';
    } else if($cellTimestamp < (time() + 3 * Utils::hourInSec)) {
      // last minute deny
      echo '<td class="last-minute"></td>';
    } else {
      // if in the present week or future
      if (isset($bookings[$cellTimestamp])) {
        echo '<td class="reserved-cell"></td>';
      } else {
        if ($cellTimestamp == $selectedAppointment) {
          echo '<td class="timebox" id="timebox-selected">'.$cellTimestamp.'</td>';
        } else {
          echo '<td class="timebox">'.$cellTimestamp.'</td>';
        }
      }
    }
  }
  
  echo "</tr>";
}

echo '</table>';
$this->load->view('booking/table_js');
?>