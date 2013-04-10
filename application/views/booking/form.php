<?php
	echo validation_errors();

	echo form_open('booking/add_appointment', array('id' => 'booking_form'));
	echo '<p>';
	echo form_label('Időpont', 'appointment');
	echo form_input(array('name' => 'appointment', 'id' => 'appointment'));
	echo form_hidden('booking_date', date('Y-m-d H:i'));
	echo '</p><p>';
	echo form_label('Vezetéknév', 'book_fname');
	echo form_input(array('name' => 'book_fname', 'id' => 'book_fname'));
	echo '</p><p>';
	echo form_label('Keresztnév', 'book_sname');
	echo form_input(array('name' => 'book_sname', 'id' => 'book_sname'));
	echo '</p><p>';
	echo form_label('Fizetés kártyával', 'payment_option_1');
	echo form_radio(array('name' => 'payment_option', 'id' => 'payment_option_1', 'value' => 'card'));
	echo '</p><p>';
	echo form_label('Fizetés készpénzzel', 'payment_option_2');
	echo form_radio(array('name' => 'payment_option', 'id' => 'payment_option_2', 'value' => 'cache'));
	echo '</p><p>';
	echo form_label('Egyetértek a szerződéssel', 'eula');
	echo form_checkbox(array('name' => 'eula', 'id' => 'eula', 'value' => 'accept'));
	echo '</p><p>';
	echo '<br/>';
	echo form_submit(array('name' => 'book_btn', 'id' => 'book_btn', 'value' => 'Foglalás'));
	echo '</p>';
	echo form_close();
?>