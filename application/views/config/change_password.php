<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <h1>
    Jelszó változtatás
  </h1>
  <br/>

  <?= form_open('admin/config/change_password', array('class' => 'form-horizontal', 'role' => 'form')) ?>
    <?php $this->load->view('admin/alert'); ?>

    <div class="form-group">
      <label for="current-password" class="col-sm-3 control-label">Jelenlegi jelszó</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'current-password',
          'type' => 'password',
          'placeholder' => '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="new-password-1" class="col-sm-3 control-label">Új jelszó</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'new-password-1',
          'type' => 'password',
          'placeholder' => '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="new-password-2" class="col-sm-3 control-label">Új jelszó újra</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'new-password-2',
          'type' => 'password',
          'placeholder' => '')) ?>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-3">
        <?= form_button(array(
          'class' => 'btn btn-primary',
          'name' => 'change',
          'value' => 'Mehet',
          'content' => 'Mehet',
          'type' => 'submit')) ?>
      </div>
    </div>
  <?= form_close() ?>
</div>

</body>
</html>