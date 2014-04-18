<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <h1>
    Foglalási limit változtatás
  </h1>
  <br/>

  <?= form_open('admin/config/change_limit', array('class' => 'form-horizontal', 'role' => 'form')) ?>
    <?php if (validation_errors() != null) { ?>
      <div id="flash-msg" class="alert alert-danger">
        <?= validation_errors() ?>
      </div>
    <?php } ?>

    <div class="form-group">
      <label for="current-password" class="col-sm-3 control-label">Limit</label>
      <div class="col-sm-2">
        <?= form_input(array(
          'id' => 'limit',
          'class' => 'form-control',
          'name' => 'limit',
          'placeholder' => '#',
          'value' => $currentLimit)) ?>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-2">
        <?= form_button(array(
          'class' => 'btn btn-primary',
          'name' => 'change',
          'value' => 'Mehet',
          'content' => 'Mehet',
          'type' => 'submit',
          'role' => 'button')) ?>
      </div>
    </div>
  <?= form_close() ?>
</div>
</body>
</html>