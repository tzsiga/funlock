<?php $this->load->view('admin/header'); ?>
<body id="admin-login">
  <div class="container">
    <?= form_open('admin/login', array('class' => 'form-signin', 'role' => 'form')) ?>
      <h1>
        Admin felület
      </h1>
      <br/>

      <?php if (!empty($this->session->flashdata('msg')) || validation_errors() != null) { ?>
      <div id="flash-msg" class="alert alert-danger">
        <?= $this->session->flashdata('msg') ?>
        <?= validation_errors() ?>
      </div>
      <?php } ?>

      <?= form_password(array(
        'class' => 'form-control',
        'name' => 'given-password',
        'placeholder' => 'Jelszó')) ?>
      <?= form_button(array(
        'class' => 'btn btn-lg btn-primary btn-block',
        'name' => 'login',
        'value' => 'Bejelentkezés',
        'content' => 'Bejelentkezés',
        'type' => 'submit')) ?>
    <?= form_close() ?>
  </div>
</body>
</html>