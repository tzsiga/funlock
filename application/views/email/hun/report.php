<?php $this->load->view('header'); ?>

load bootstrap

<body id="report-email">

<h2>Új foglalás értesítő</h2>

<h3>alapadatok:</h3>
<ul>
  <li>foglaló neve: <?= $posted['book-sname'] ?></li>
  <li>foglalt időpont: <?= date("Y-m-d H:i", $posted['appointment']) ?></li>
  <li>email cím: <?= $posted['email'] ?></li>
  <li>fizetési mód: <?= $posted['payment-option'] ?></li>

  <?php
    if (isset($voucher))
      echo '<li>'.'voucher link'.'</li>';
  ?>

  <li>foglalási azonosító: <?= $this->booking_model->convertTimeToBookingCode($posted['appointment']) ?></li>
</ul>
<!--[link a foglalásra]-->

<h3>statisztika:</h3>
<ul>
  <!-- select -->
  <li>összesen hányadik érvényes aktív (nem dummy) foglalás</li>
  <!-- select -->
  <li>ebben a hónapban hányadik foglalás</li>
  <!-- select -->
  <li>fizetési mód szerinti megoszlás</li>
  <!-- select -->
  <li>nyelv szerinti megoszlás</li>
</ul>

</body>
</html>