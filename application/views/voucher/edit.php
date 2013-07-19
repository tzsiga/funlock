<?php $this->load->view('header'); ?>
<body id="admin-page">
  <h1>
    Kuponok szerkesztése
  </h1>
  <h3 id="flash-msg">
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <ul>
  <?php
    foreach ($vouchers as $voucher)
      echo '<li>['.$voucher->status.'] ['.$voucher->discounted_price.'] '.$voucher->code.'</li>';
  ?>
  </ul>
  <p><a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
</body>
</html>