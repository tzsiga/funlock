<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <h1>
    Kuponok létrehozása
  </h1>
  <br/>

  <?= form_open('admin/voucher/add', array('class' => 'form-horizontal', 'role' => 'form')) ?>
  <?php if (!empty($this->session->flashdata('msg')) || validation_errors() != null) { ?>
    <div id="flash-msg" class="alert alert-danger">
      <?= $this->session->flashdata('msg') ?>
      <?= validation_errors() ?>
    </div>
  <?php } ?>

  <div class="form-group">
    <label for="number_of_vouchers" class="col-sm-3 control-label">Generálj ennyi kupont</label>
    <div class="col-sm-3">
      <?= form_input(array(
        'class' => 'form-control',
        'name' => 'number_of_vouchers',
        'id' => 'number_of_vouchers',
        'type' => 'text',
        'value' => '1')) ?>
    </div>
  </div>

  <div class="form-group">
    <label for="discounted_price" class="col-sm-3 control-label">Kedvezményes ár</label>
    <div class="col-sm-3">
      <?= form_input(array(
        'class' => 'form-control',
        'name' => 'discounted_price',
        'id' => 'discounted_price',
        'type' => 'text',
        'value' => '8000')) ?>
    </div>
  </div>

  <div class="form-group">
    <label for="label" class="col-sm-3 control-label">Címke</label>
    <div class="col-sm-3">
      <?= form_input(array(
        'class' => 'form-control',
        'name' => 'label',
        'id' => 'label',
        'type' => 'text',
        'placeholder' => 'X Y részre')) ?>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
      <?= form_button(array(
        'class' => 'btn btn-primary',
        'name' => 'generate',
        'value' => 'Mehet',
        'content' => 'Mehet',
        'type' => 'submit')) ?>
    </div>
  </div>
  <?= form_close() ?>
</div>
</body>
</html>