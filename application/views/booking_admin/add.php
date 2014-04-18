<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <h1>
    Új foglalás
  </h1>
  <br/>

  <?= form_open('admin/booking/add', array('class' => 'form-horizontal', 'role' => 'form')) ?>
    <?php $this->load->view('admin/alert'); ?>

    <div class="form-group">
      <label for="status" class="col-sm-3 control-label">Aktív?</label>
      <div class="col-sm-3">
        <p class="form-control-static">
          <?= form_checkbox(array(
            'name' => 'status',
            'id' => 'status',
            'value' => 'active',
            'checked' => isset($posted['status']) ? true : false)) ?>
        </p>
      </div>
    </div>

    <div class="form-group">
      <label for="book-fname" class="col-sm-3 control-label">Foglaló vezeték/keresztneve</label>
      <div class="col-sm-6">
        <span class="col-sm-6 input-no-padding">
          <?= form_input(array(
            'class' => 'form-control',
            'name' => 'book-fname',
            'id' => 'book-fname',
            'type' => 'text',
            'value' => isset($posted['book-fname']) ? $posted['book-fname'] : '')) ?>
        </span>
        <span class="col-sm-6">
          <?= form_input(array(
            'class' => 'form-control',
            'name' => 'book-sname',
            'id' => 'book-sname',
            'type' => 'text',
            'value' => isset($posted['book-sname']) ? $posted['book-sname'] : '')) ?>
        </span>
      </div>
    </div>

    <div class="form-group">
      <label for="appointment" class="col-sm-3 control-label">Foglalt időpont</label>
      <div class="col-sm-4">
        <span class="col-sm-6 input-no-padding">
          <?= form_input(array(
            'class' => 'form-control',
            'name' => 'appointment',
            'id' => 'appointment',
            'type' => 'text',
            'value' => isset($posted['appointment']) ? $posted['appointment'] : date('Y-m-d', $timestamp))) ?>
        </span>
        <span class="col-sm-6">
          <?= form_dropdown(
            'appointment-hour',
            Utils::getPlaytimeRangeDropdownValues(),
            isset($posted['appointment-hour']) ? $posted['appointment-hour'] : date('G', $timestamp) + (date('i', $timestamp) == 30 ? 0.5 : 0),
            'class="form-control"') ?>
        </span>
      </div>
    </div>

    <div class="form-group">
      <label for="payment-option" class="col-sm-3 control-label">Fizetés módja</label>
      <div class="col-sm-6">
        <div class="radio">
          <label>
            <?= form_radio(array(
              'name' => 'payment-option',
              'id' => 'payment-option-1',
              'value' => 'card')) ?>
            átutalással
          </label>
        </div>
        <div class="radio">
          <label>
            <?= form_radio(array(
              'name' => 'payment-option',
              'id' => 'payment-option-2',
              'value' => 'cache')) ?>
            készpénzzel
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="phone" class="col-sm-3 control-label">Telefonszám</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'phone',
          'id' => 'phone',
          'type' => 'text',
          'value' => isset($posted['phone']) ? $posted['phone'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="email" class="col-sm-3 control-label">Email cím</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'email',
          'id' => 'email',
          'type' => 'text',
          'value' => isset($posted['email']) ? $posted['email'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="zip" class="col-sm-3 control-label">Irányítószám</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'zip',
          'id' => 'zip',
          'type' => 'text',
          'value' => isset($posted['zip']) ? $posted['zip'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="city" class="col-sm-3 control-label">Város</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'city',
          'id' => 'city',
          'type' => 'text',
          'value' => isset($posted['city']) ? $posted['city'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="street" class="col-sm-3 control-label">Utca</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'street',
          'id' => 'street',
          'type' => 'text',
          'value' => isset($posted['street']) ? $posted['street'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="house" class="col-sm-3 control-label">Házszám</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'house',
          'id' => 'house',
          'type' => 'text',
          'value' => isset($posted['house']) ? $posted['house'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="bill-fname" class="col-sm-3 control-label">Számla: vezeték/keresztnév</label>
      <div class="col-sm-6">
        <span class="col-sm-6 input-no-padding">
          <?= form_input(array(
            'class' => 'form-control',
            'name' => 'bill-fname',
            'id' => 'bill-fname',
            'type' => 'text',
            'value' => isset($posted['bill-fname']) ? $posted['bill-fname'] : '')) ?>
        </span>
        <span class="col-sm-6">
          <?= form_input(array(
            'class' => 'form-control',
            'name' => 'bill-sname',
            'id' => 'bill-sname',
            'type' => 'text',
            'value' => isset($posted['bill-sname']) ? $posted['bill-sname'] : '')) ?>
        </span>
      </div>
    </div>

    <div class="form-group">
      <label for="tax-number" class="col-sm-3 control-label">Adószám</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'tax-number',
          'id' => 'tax-number',
          'type' => 'text',
          'value' => isset($posted['tax-number']) ? $posted['tax-number'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="comment" class="col-sm-3 control-label">Megjegyzések</label>
      <div class="col-sm-6">
        <?= form_textarea(array(
          'class' => 'form-control',
          'name' => 'comment',
          'id' => 'comment',
          'rows' => 4,
          'value' => isset($posted['comment']) ? $posted['comment'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="notes" class="col-sm-3 control-label">Jegyzetek</label>
      <div class="col-sm-6">
        <?= form_textarea(array(
          'class' => 'form-control',
          'name' => 'notes',
          'id' => 'notes',
          'rows' => 4,
          'value' => isset($posted['notes']) ? $posted['notes'] : '')) ?>
      </div>
    </div>

    <div class="form-group">
      <label for="booking-date" class="col-sm-3 control-label">Foglalás időpontja</label>
      <div class="col-sm-3">
        <?= form_input(array(
          'class' => 'form-control',
          'name' => 'booking-date',
          'id' => 'booking-date',
          'type' => 'text',
          'value' => date('Y-m-d H:i'))) ?>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-3">
        <?= form_button(array(
          'class' => 'btn btn-success',
          'name' => 'book',
          'value' => 'Foglalás',
          'content' => 'Foglalás',
          'type' => 'submit')) ?>
      </div>
    </div>
  <?= form_close() ?>
</div>
<script type="text/javascript">
  $('#appointment').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
  $('#booking-date').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd <?= date('H:i') ?>' });
</script>
</body>
</html>