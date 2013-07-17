<?php $this->load->view('header'); ?>
<body id="admin-page">
  <h1>
    Voucher generálása
  </h1>
  <h3 id="flash-msg">
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <?php
    echo form_open('admin/voucher/add', array('class' => 'centered'));
    echo '<p>';
    echo form_label('Generálj ennyi vouchert:', 'number_of_vouchers');
    echo form_input(array('name' => 'number_of_vouchers', 'id' => 'number_of_vouchers', 'value' => 1));
    echo '</p><p>';
    echo form_submit('generate', 'Mehet');
    echo '</p>';
    echo form_close();
  ?>
  <p><a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
</body>
</html>