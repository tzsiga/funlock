<?php $this->load->view('header'); ?>
<body id="report-email">
<h2>Új foglalás értesítő</h2>
<h3>Alapadatok:</h3>
<table>
  <tr>
    <td><strong>Foglaló neve:</strong></td>
    <td><?= $posted['book-sname'] ?></td>
  </tr>
  <tr>
    <td><strong>Foglalt időpont:</strong></td>
    <td><?= date("Y-m-d H:i", $posted['appointment']) ?></td>
  </tr>
  <tr>
    <td><strong>Email cím:</strong></td>
    <td><?= $posted['email'] ?></td>
  </tr>
  <tr>
    <td><strong>Fizetési mód:</strong></td>
    <td>
      <?php
        if ($posted['payment-option'] == 'cache') {
          echo 'készpénz';
        } else if ($posted['payment-option'] == 'card') {
          echo 'átutalás';
        }
      ?>
    </td>
  </tr>
  <tr>
    <td></td>
    <td><?= '<a href="'.base_url().'index.php/admin/booking/edit/'.$newBookingId.'">' ?>link</a></td>
  </tr>
  <tr>
    <td><strong>Foglalási azonosító:</strong></td>
    <td><?= $this->booking_model->convertTimeToBookingCode($posted['appointment']) ?></td>
  </tr>
</table>
</body>
</html>