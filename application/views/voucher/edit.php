<?php $this->load->view('header'); ?>
<body id="admin-page">
  <h1>
    Kupon szerkesztése
  </h1>
  <h3 id="flash-msg">
    <?= validation_errors() ?>
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <?php
    echo form_open('admin/voucher/edit', array('class' => 'centered'));
    echo '<p>';
    echo form_label('Kód: '.$voucher->code, '');
    echo '</p><p>';
    echo form_label('Állapot: '.$voucher->status, '');
    echo '</p><p>';
    echo form_label('Kedvezményes ár:', 'discounted_price');
    echo form_input(array('name' => 'discounted_price', 'id' => 'discounted_price', 'value' => 8000));
    echo '</p><p>';
    echo form_label('Címke:', 'label');
    echo form_input(array('name' => 'label', 'id' => 'labbel', 'value' => $voucher->label));
    echo '</p><p>';
    echo form_label('Létrehozva: '.$voucher->create_date, '');
    echo '</p><p>';
    echo form_submit('save', 'Mentés');
    echo '</p>';
    echo form_close();
  ?>
  <p><a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
</body>
</html>