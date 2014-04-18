<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <h1>
    Kupon szerkesztése
  </h1>
  <br/>

  <?= form_open('admin/voucher/edit/'.$voucher->id, array('class' => 'form-horizontal', 'role' => 'form')) ?>
    <?php $this->load->view('admin/alert'); ?>

    <div class="form-group">
      <label for="code" class="col-sm-3 control-label">Kód</label>
      <div class="col-sm-3">
        <p class="form-control-static"><?= $voucher->code ?></p>
      </div>
      <?= form_hidden('code', $voucher->code) ?>
    </div>

    <div class="form-group">
      <label for="status" class="col-sm-3 control-label">Állapot</label>
      <div class="col-sm-3">
        <?= form_dropdown('status', Utils::$voucherStatuses, $voucher->status, 'class="form-control"') ?>
      </div>
    </div>

    <?php if (!empty($booking)) { ?>
      <div class="form-group">
        <label for="code" class="col-sm-3 control-label">Foglalás</label>
        <div class="col-sm-3">
        <p class="form-control-static">
          <?= '<a href="' . base_url() . 'index.php/admin/booking/edit/' . $booking->id . '">' . date('Y-m-d H:i', $booking->appointment) . '</a>' ?>
        </p>
        </div>
      </div>
    <?php } ?>

    <div class="form-group">
      <label for="code" class="col-sm-3 control-label">Létrehozva</label>
      <div class="col-sm-3">
        <p class="form-control-static"><?= date("Y-m-d H:i", $voucher->create_date) ?></p>
      </div>
      <?= form_hidden('code', $voucher->create_date) ?>
    </div>

    <div class="form-group">
      <label for="discounted_price" class="col-sm-3 control-label">Kedvezményes ár</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'discounted_price',
          'id' => 'discounted_price',
          'type' => 'text',
          'value' => $voucher->discounted_price)) ?>
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
          'value' => $voucher->label)) ?>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-3">
        <?= form_button(array(
          'class' => 'btn btn-success',
          'name' => 'save',
          'value' => 'Mentés',
          'content' => 'Mentés',
          'type' => 'submit')) ?>
        <?= form_button(array(
          'class' => 'btn btn-danger',
          'name' => 'delete',
          'value' => 'Törlés',
          'content' => 'Törlés',
          'type' => 'submit')) ?>
      </div>
    </div>
  <?= form_close() ?>
</div>
</body>
</html>