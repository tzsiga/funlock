<?php
  $msg = $this->session->flashdata('msg');
  $validation_errors = validation_errors();

  if (!empty($msg) || !empty($validation_errors)) { ?>
  <div id="flash-msg" class="alert alert-danger">
    <?= $msg ?>
    <?= $validation_errors ?>
  </div>
<?php } ?>