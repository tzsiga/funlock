<?php $this->load->view('header'); ?>
<body id="report-email">

<h2>Új foglalás értesítő</h2>

<h3>Alapadatok:</h3>
<ul>
  <li>Foglaló neve: <?= $posted['book-sname'] ?></li>
  <li>Foglalt időpont: <?= date("Y-m-d H:i", $posted['appointment']) ?></li>
  <li>Email cím: <?= $posted['email'] ?></li>
  <li>Fizetési mód: <?= $posted['payment-option'] ?></li>
  <li><?= '<a href="'.base_url().'index.php/admin/booking/edit/'.$newBookingId.'">' ?>link</a></li>
  <li>Foglalási azonosító: <?= $this->booking_model->convertTimeToBookingCode($posted['appointment']) ?></li>
</ul>

</body>
</html>