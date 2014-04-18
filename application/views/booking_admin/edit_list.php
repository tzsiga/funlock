<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<?php
  function printTableRow($date, $booking, $passed = false) {
    echo '<tr>';
    if ($passed) {
      echo '<td class="td-passed">'.
        '<a href="'.base_url().'index.php/admin/booking/edit/'.$booking->id.'">'.
        '<span class="glyphicon glyphicon-pencil"></span> '.
        date('Y-m-d H:i', $date).
        '</a></td>';
      echo '<td class="td-passed">'.(isset($booking->status) ? 'aktív' : 'inaktív').'</td>';
      echo '<td class="td-passed">'.(isset($booking->payment_verified) ? 'igen' : 'nem').'</td>';
      echo '<td class="td-passed">'.$booking->book_fname.' '.$booking->book_sname.'</td>';
    } else {
      echo '<td>'.
        '<a href="'.base_url().'index.php/admin/booking/edit/'.$booking->id.'">'.
        '<span class="glyphicon glyphicon-pencil"></span> '.
        date('Y-m-d H:i', $date).
        '</a></td>';
      echo '<td>'.(isset($booking->status) ? 'aktív' : 'inaktív').'</td>';
      echo '<td>'.(isset($booking->payment_verified) ? 'igen' : 'nem').'</td>';
      echo '<td>'.$booking->book_fname.' '.$booking->book_sname.'</td>';
    }
    echo '</tr>';
  }
?>

<div class="container">
  <h1>
    Foglalások szerkesztése
  </h1>
  <br/>

  <?php if (!empty($this->session->flashdata('msg'))) { ?>
    <div id="flash-msg" class="alert alert-danger">
      <?= $this->session->flashdata('msg') ?>
    </div>
  <?php } ?>

  <?= $this->pagination->create_links() ?>

  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>dátum</th>
        <th>állapot</th>
        <th>fizetve?</th>
        <th>név</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach ($bookings as $date => $booking) {
        if ($date > time()) {
          printTableRow($date, $booking);
        } else {
          printTableRow($date, $booking, true);
        }
      }
    ?>
    </tbody>
  </table>

  <?= $this->pagination->create_links() ?>
</div>
</body>
</html>