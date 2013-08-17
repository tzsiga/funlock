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
    } else {
      // if in the present week or future
      if (isset($bookings[$cellTimestamp])) {
        echo '<td class="reserved-cell"></td>';
      } else {
        if ($cellTimestamp == $selectedAppointment) {
          echo '<td class="timebox" 
                    style="-moz-box-shadow: 8px 8px 15px #888888; 
                           -webkit-box-shadow: 8px 8px 15px #888888; 
                            box-shadow: 8px 8px 15px #888888; 
                            position: relative; 
                            z-index: 3; 
                            background-image: url(\''.base_url().'/assets/img/main/selected.png\')">'. 
                $cellTimestamp .'</td>';
        } else {
          echo '<td class="timebox">'. $cellTimestamp .'</td>';
        }
      }
    }
  }
  
  echo "</tr>";
}

echo '</table>';
$this->load->view('booking/table_js');
?>