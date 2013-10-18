<?php
  echo form_open('', array('id' => 'booking_form_success'));
  echo lang('form_success_cache_1');
  echo (isset($voucher) ? $voucher->discounted_price : lang('base_price'));
  echo lang('form_success_cache_2');
  echo form_close();
?>