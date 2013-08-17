<div class="error-msg">
  <?= validation_errors() ?>
</div>
<?php
  echo form_open('main/addBooking', array('id' => 'booking-form'));
  echo '<p>';
  echo form_hidden('appointment', isset($posted['appointment']) ? $posted['appointment'] : '');
  
  echo '</p><p>';
  echo form_label(lang('book-fname'), 'book-fname');
  echo form_input(array('name' => 'book-fname', 'id' => 'book-fname', 'value' => isset($posted['book-fname']) ? $posted['book-fname'] : ''));
  echo form_label(lang('book-sname'), 'book-sname');
  echo form_input(array('name' => 'book-sname', 'id' => 'book-sname', 'value' => isset($posted['book-sname']) ? $posted['book-sname'] : ''));
  echo form_label(lang('phone'), 'phone');
  echo form_input(array('name' => 'phone', 'id' => 'phone', 'value' => isset($posted['phone']) ? $posted['phone'] : ''));
  
  echo '</p><p>';
  echo form_label(lang('payment-option'), 'payment-option');
  echo form_dropdown('payment-option', array('card' => lang('payment-option-1'), 'cache' => lang('payment-option-2')), 'card', 'id="payment-option"');
  echo form_label(lang('voucher'), 'voucher');
  echo form_checkbox(array('name' => 'voucher', 'id' => 'voucher', 'value' => 'accept', 'checked' => isset($posted['voucher']) ? true : false));
  echo form_input(array('name' => 'code', 'id' => 'code', 'value' => isset($posted['code']) ? $posted['code'] : ''));

  echo '</p><p>';
  echo form_label(lang('email'), 'email');
  echo form_input(array('name' => 'email', 'id' => 'email', 'value' => isset($posted['email']) ? $posted['email'] : ''));
  echo form_label(lang('billing'), 'billing');
  echo form_checkbox(array('name' => 'billing', 'id' => 'billing', 'value' => 'accept', 'checked' => isset($posted['billing']) ? true : false));

  echo '</p><p>';
  echo form_label(lang('bill-fname'), 'bill-fname');
  echo form_input(array('name' => 'bill-fname', 'id' => 'bill-fname', 'value' => isset($posted['bill-fname']) ? $posted['bill-fname'] : ''));
  echo form_label(lang('bill-sname'), 'bill-sname');
  echo form_input(array('name' => 'bill-sname', 'id' => 'bill-sname', 'value' => isset($posted['bill-sname']) ? $posted['bill-sname'] : ''));
  echo form_label(lang('tax-number'), 'tax-number');
  echo form_input(array('name' => 'tax-number', 'id' => 'tax-number', 'value' => isset($posted['tax-number']) ? $posted['tax-number'] : ''));

  echo '</p><p>';
  echo form_label(lang('zip'), 'zip');
  echo form_input(array('name' => 'zip', 'id' => 'zip', 'value' => isset($posted['zip']) ? $posted['zip'] : ''));
  echo form_label(lang('city'), 'city');
  echo form_input(array('name' => 'city', 'id' => 'city', 'value' => isset($posted['city']) ? $posted['city'] : ''));
  echo form_label(lang('street'), 'street');
  echo form_input(array('name' => 'street', 'id' => 'street', 'value' => isset($posted['street']) ? $posted['street'] : ''));
  echo form_label(lang('house'), 'house');
  echo form_input(array('name' => 'house', 'id' => 'house', 'value' => isset($posted['house']) ? $posted['house'] : ''));

  echo '</p><p>';
  echo form_label(lang('eula'), 'eula');
  echo form_checkbox(array('name' => 'eula', 'id' => 'eula', 'value' => 'accept', 'checked' => isset($posted['eula']) ? true : false));
  echo form_submit(array('name' => 'book-btn', 'id' => 'book-btn', 'value' => lang('book-btn')));

  echo '</p>';
  echo form_close();
  
  $this->load->view('booking/form_js');
?>