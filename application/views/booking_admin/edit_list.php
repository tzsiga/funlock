<?php $this->load->view('header'); ?>
<?php
  function printTableRow($date, $booking, $passed = false) {
    echo '<tr>';
    if ($passed) {
      echo '<td class="passed-appointment">'.date('Y-m-d H:i', $date).'</td>';
      echo '<td class="passed-appointment">'.(isset($booking->status) ? 'aktív' : 'inaktív').'</td>';
      echo '<td class="passed-appointment">'.(isset($booking->payment_verified) ? 'igen' : 'nem').'</td>';
      echo '<td class="passed-appointment">'.$booking->book_fname.' '.$booking->book_sname.'</td>';
    } else {
      echo '<td>'.date('Y-m-d H:i', $date).'</td>';
      echo '<td>'.(isset($booking->status) ? 'aktív' : 'inaktív').'</td>';
      echo '<td>'.(isset($booking->payment_verified) ? 'igen' : 'nem').'</td>';
      echo '<td>'.$booking->book_fname.' '.$booking->book_sname.'</td>';
    }
    echo '<td>'.'<a href="'.base_url().'index.php/admin/booking/edit/'.$booking->id.'">szerkesztés</a>'.'</td>';
    echo '</tr>';    
  }
?>
<body id="admin-page">
  <h1>
    Foglalások szerkesztése/törlése
  </h1>
  <h3 id="flash-msg">
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <p><?= $this->pagination->create_links() ?> | <a href="<?= base_url() ?>index.php/admin/booking/edit">Vissza</a></p>
  <table class="admin-list-table">
    <tr>
      <th>dátum</th>
      <th>állapot</th>
      <th>fizetve?</th>
      <th>név</th>
      <th>link</th>
    </tr>
    <?php
      foreach ($bookings as $date => $booking) {
        if ($date > time()) {
          printTableRow($date, $booking);
        } else {
          printTableRow($date, $booking, true);
        }
      }
    ?>
  </table>
  <p><?= $this->pagination->create_links() ?> | <a href="<?= base_url() ?>index.php/admin/booking/edit">Vissza</a></p>
</body>
</html>