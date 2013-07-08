<div class="error-msg">
	<?= validation_errors() ?>
</div>
<?php
	echo form_open('main/addBooking', array('id' => 'booking-form'));
	echo '<p>';
	echo form_hidden('appointment', isset($posted['appointment']) ? $posted['appointment'] : '');
	
	echo '</p><p>';
	echo form_label('Vezetéknév', 'book-fname');
	echo form_input(array('name' => 'book-fname', 'id' => 'book-fname', 'value' => isset($posted['book-fname']) ? $posted['book-fname'] : ''));
	echo form_label('Keresztnév', 'book-sname');
	echo form_input(array('name' => 'book-sname', 'id' => 'book-sname', 'value' => isset($posted['book-sname']) ? $posted['book-sname'] : ''));
	echo form_label('Telefon', 'phone');
	echo form_input(array('name' => 'phone', 'id' => 'phone', 'value' => isset($posted['phone']) ? $posted['phone'] : ''));
	
	echo '</p><p>';
	echo form_label('Fizetés', 'payment-option');
	echo form_dropdown('payment-option', array('card' => 'átutalással', 'cache' => 'készpénzzel'), 'card', 'id="payment-option"');

	echo '</p><p>';
	echo form_label('Email', 'email');
	echo form_input(array('name' => 'email', 'id' => 'email', 'value' => isset($posted['email']) ? $posted['email'] : ''));
	echo form_label('Számlázási adatok különböznek', 'billing');
	echo form_checkbox(array('name' => 'billing', 'id' => 'billing', 'value' => 'accept', 'checked' => isset($posted['billing']) ? true : false));

	echo '</p><p>';
	echo form_label('Vezetéknév', 'bill-fname');
	echo form_input(array('name' => 'bill-fname', 'id' => 'bill-fname', 'value' => isset($posted['bill-fname']) ? $posted['bill-fname'] : ''));
	echo form_label('Keresztnév', 'bill-sname');
	echo form_input(array('name' => 'bill-sname', 'id' => 'bill-sname', 'value' => isset($posted['bill-sname']) ? $posted['bill-sname'] : ''));
	echo form_label('Adószám', 'tax-number');
	echo form_input(array('name' => 'tax-number', 'id' => 'tax-number', 'value' => isset($posted['tax-number']) ? $posted['tax-number'] : ''));

	echo '</p><p>';
	echo form_label('Ir.szám', 'zip');
	echo form_input(array('name' => 'zip', 'id' => 'zip', 'value' => isset($posted['zip']) ? $posted['zip'] : ''));
	echo form_label('Város', 'city');
	echo form_input(array('name' => 'city', 'id' => 'city', 'value' => isset($posted['city']) ? $posted['city'] : ''));
	echo form_label('Utca', 'street');
	echo form_input(array('name' => 'street', 'id' => 'street', 'value' => isset($posted['street']) ? $posted['street'] : ''));
	echo form_label('Házszám', 'house');
	echo form_input(array('name' => 'house', 'id' => 'house', 'value' => isset($posted['house']) ? $posted['house'] : ''));

	echo '</p><p>';
	echo form_label('Elfogadom a <a href="'.base_url().'index.php/pages/eula" id="link-eula" target="_blank">feltételeket</a>', 'eula');
	echo form_checkbox(array('name' => 'eula', 'id' => 'eula', 'value' => 'accept', 'checked' => isset($posted['eula']) ? true : false));
	echo form_submit(array('name' => 'book-btn', 'id' => 'book-btn', 'value' => 'Foglalás'));

	echo '</p>';
	echo form_close();
	
	$this->load->view('booking/form_js');
?>