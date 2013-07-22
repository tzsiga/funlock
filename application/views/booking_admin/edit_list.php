<?php $this->load->view('header'); ?>
<?php
  function printTableRow($date, $booking) {
    echo '<tr>';
    echo '<td>'.date('Y-m-d H:i', $date).'</td>';
    echo '<td>'.(isset($booking['status']) ? $booking['status'] : 'inactive').'</td>';
    echo '<td>'.$booking['client'].'</td>';
    echo '<td>'.'<a href="'.base_url().'index.php/admin/booking/edit/'.$booking['id'].'">szerkesztés</a>'.'</td>';
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
  <h3>Új játékok:</h3>
  <table class="admin-list-table">
    <tr>
      <th>dátum</th>
      <th>állapot</th>
      <th>név</th>
      <th>link</th>
    </tr>
    <?php
      foreach ($bookings as $date => $booking) {
        if ($date > time()) {
          printTableRow($date, $booking);
        }
      }
    ?>
  </table>
  <h3>Lejátszott játékok:</h3>
  <table class="admin-list-table">
    <?php
      foreach ($bookings as $date => $booking) {
        if ($date <= time()) {
          printTableRow($date, $booking);
        }
      }
    ?>
  </table>
  <p>
    <a href="<?= base_url() ?>index.php/admin/booking/edit">Vissza</a>
  </p>
</body>
</html>