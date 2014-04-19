<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <h1>
    Egyedi kupon létrehozása
  </h1>
  <br/>

  <?= form_open('admin/voucher/unique', array('class' => 'form-horizontal', 'role' => 'form')) ?>
    <?php $this->load->view('admin/alert'); ?>

    <div class="form-group">
      <label for="code" class="col-sm-3 control-label">Kód</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'code',
          'id' => 'code',
          'type' => 'text',
          'placeholder' => 'ABCD')) ?>
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
          'placeholder' => 'X Y részére')) ?>
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