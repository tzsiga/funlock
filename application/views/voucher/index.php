<?php $this->load->view('header'); ?>
<body id="admin-page">
  <h1>
    Kuponok kezelése
  </h1>
  <h3 id="flash-msg">
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <p>
    <a href="<?= base_url() ?>index.php/admin/voucher/add">Kuponok generálása</a><br/>
    <a href="<?= base_url() ?>index.php/admin/voucher/unique">Egyedi kupon létrehozása</a><br/>
    <a href="<?= base_url() ?>index.php/admin/voucher/list">Kuponok szerkesztése</a><br/><br/>
    <a href="<?= base_url() ?>index.php/admin">Vissza</a>
  </p>
</body>
</html>