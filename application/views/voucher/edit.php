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
    echo form_open('admin/voucher/edit/'.$voucher->id, array('class' => 'centered'));
    echo '<p>';
    echo form_label('Kód:', '');
    echo form_hidden('code', $voucher->code);
    echo $voucher->code;
    echo '</p><p>';
    echo form_label('Állapot:', '');
    echo form_hidden('status', $voucher->status);
    echo $voucher->status;
    echo '</p><p>';
    echo form_label('Létrehozva:', '');
    echo date("Y-m-d H:i", $voucher->create_date);
    echo form_hidden('create_date', $voucher->create_date);
    echo '</p><p>';
    echo form_label('<strong>Kedvezményes ár:</strong>', 'discounted_price');
    echo form_input(array('name' => 'discounted_price', 'id' => 'discounted_price', 'value' => $voucher->discounted_price));
    echo '</p><p>';
    echo form_label('<strong>Címke:</strong>', 'label');
    echo form_input(array('name' => 'label', 'id' => 'label', 'value' => $voucher->label));
    echo '</p><p>';
    echo '<br/>';
    echo '<div id="buttons">'.form_submit('save', 'Mentés').form_submit('delete', 'Törlés').'</div>';
    echo '</p>';
    echo form_close();
  ?>
  <p><a href="<?= base_url() ?>index.php/admin/voucher/edit">Vissza</a></p>
</body>
</html>