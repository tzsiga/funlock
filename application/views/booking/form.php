<div class="error_msg">
	<?= $this->session->flashdata('msg') ?>
	<?= validation_errors() ?>
</div>
<?php
	echo form_open('booking/add_appointment', array('id' => 'booking_form'));
	echo '<p>';
	//echo form_label('Időpont', 'appointment');
	//echo form_input(array('name' => 'appointment', 'id' => 'appointment', 'value' => isset($posted['appointment']) ? $posted['appointment'] : ''));
	echo form_hidden('appointment', isset($posted['appointment']) ? $posted['appointment'] : '');
	//echo form_hidden('booking_date', date('Y-m-d H:i'));
	
	echo '</p><p>';
	echo form_label('Vezetéknév', 'book_fname');
	echo form_input(array('name' => 'book_fname', 'id' => 'book_fname', 'value' => isset($posted['book_fname']) ? $posted['book_fname'] : ''));
	echo form_label('Keresztnév', 'book_sname');
	echo form_input(array('name' => 'book_sname', 'id' => 'book_sname', 'value' => isset($posted['book_sname']) ? $posted['book_sname'] : ''));
	echo form_label('Telefon', 'phone');
	echo form_input(array('name' => 'phone', 'id' => 'phone', 'value' => isset($posted['phone']) ? $posted['phone'] : '+36'));
	echo '</p><p>';
	echo form_label('Fizetés', 'payment_option');
	echo form_dropdown('payment_option', array('card' => 'kártyával', 'cache' => 'készpénzzel'), 'card');
	//echo form_label('Megjegyzés', 'comment');
	//echo form_input(array('name' => 'comment', 'id' => 'comment', 'value' => isset($posted['comment']) ? $posted['comment'] : ''));
	echo form_label('Egyetértek a <a href="" id="link_eula">szerződéssel</a>', 'eula');
	echo form_checkbox(array('name' => 'eula', 'id' => 'eula', 'value' => 'accept', 'checked' => isset($posted['eula']) ? true : false));

	echo '</p><p>';
	echo form_label('Email', 'email');
	echo form_input(array('name' => 'email', 'id' => 'email', 'value' => isset($posted['email']) ? $posted['email'] : ''));
	echo form_label('Számlázási adatok különböznek', 'billing');
	echo form_checkbox(array('name' => 'billing', 'id' => 'billing', 'value' => 'accept', 'checked' => isset($posted['billing']) ? true : false));

	echo '</p><p>';
	echo form_label('Vezetéknév', 'bill_fname');
	echo form_input(array('name' => 'bill_fname', 'id' => 'bill_fname', 'value' => isset($posted['bill_fname']) ? $posted['bill_fname'] : ''));
	echo form_label('Keresztnév', 'bill_sname');
	echo form_input(array('name' => 'bill_sname', 'id' => 'bill_sname', 'value' => isset($posted['bill_sname']) ? $posted['bill_sname'] : ''));
	echo form_label('Adószám', 'tax_number');
	echo form_input(array('name' => 'tax_number', 'id' => 'tax_number', 'value' => isset($posted['tax_number']) ? $posted['tax_number'] : ''));

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
	echo form_submit(array('name' => 'book_btn', 'id' => 'book_btn', 'value' => 'Foglalás'));
	echo '<br/>';

	echo '</p>';
	echo form_close();
?>
<script type="text/javascript">

	if (!$('#billing').is(':checked')) {
		$('#tax_number').hide();
		$('#bill_fname').hide();
		$('#bill_sname').hide();
		$('label[for="tax_number"]').hide();
		$('label[for="bill_fname"]').hide();
		$('label[for="bill_sname"]').hide();
	}
	
	$('#link_eula').click(function(event) {
		event.preventDefault();
		alert('EULA');
	});
	
	$('#billing').click(function() {
		if ($('#billing').is(':checked')) {
			$('#tax_number').fadeIn();
			$('#bill_fname').fadeIn();
			$('#bill_sname').fadeIn();
			$('label[for="tax_number"]').fadeIn();
			$('label[for="bill_fname"]').fadeIn();
			$('label[for="bill_sname"]').fadeIn();
		} else {
			$('#tax_number').fadeOut();
			$('#bill_fname').fadeOut();
			$('#bill_sname').fadeOut();
			$('label[for="tax_number"]').fadeOut();
			$('label[for="bill_fname"]').fadeOut();
			$('label[for="bill_sname"]').fadeOut();
		}
	});
	
	$('#booking_form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/add_appointment',
			type: 'POST',
			data: $('#booking_form').serialize(),
			success: function(result){
				refreshTable(parseInt($('#reference_time').attr('alt')));
				$('#booking_details').html(result);
			},
		statusCode: {
			404: function() {
				$('#booking_details').html('Could not contact server.');
			},
			500: function() {
				refreshTable(parseInt($('#reference_time').attr('alt')));
				$('#booking_details').html('<h1>Lekésted! Időközben befoglalták!</h1>');
			}
		}
		
		});
	});

</script>