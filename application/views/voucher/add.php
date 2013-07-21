<?php $this->load->view('header'); ?>
<body id="admin-page">
  <h1>
    Kuponok generálása
  </h1>
  <h3 id="flash-msg">
    <?= validation_errors() ?>
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <?php
    echo form_open('admin/voucher/add', array('class' => 'centered'));
    echo '<p>';
    echo form_label('Generálj ennyi Kupont:', 'number_of_vouchers');
    echo form_input(array('name' => 'number_of_vouchers', 'id' => 'number_of_vouchers', 'value' => 1));
    echo '</p><p>';
    echo form_label('Kedvezményes ár:', 'discounted_price');
    echo form_input(array('name' => 'discounted_price', 'id' => 'discounted_price', 'value' => 8000));
    echo '</p><p>';
    echo form_submit('generate', 'Mehet');
    echo '</p>';
    echo form_close();
  ?>
  <p><a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
</body>
</html>