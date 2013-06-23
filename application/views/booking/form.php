<div class="error_msg">
	<?= validation_errors() ?>
</div>
<?php
	echo form_open('booking/addBooking', array('id' => 'booking-form'));
	echo '<p>';
	//echo form_label('Időpont', 'appointment');
	//echo form_input(array('name' => 'appointment', 'id' => 'appointment', 'value' => isset($posted['appointment']) ? $posted['appointment'] : ''));
	echo form_hidden('appointment', isset($posted['appointment']) ? $posted['appointment'] : '');
	//echo form_hidden('booking-date', date('Y-m-d H:i'));
	
	echo '</p><p>';
	echo form_label('Vezetéknév', 'book-fname');
	echo form_input(array('name' => 'book-fname', 'id' => 'book-fname', 'value' => isset($posted['book_fname']) ? $posted['book_fname'] : ''));
	echo form_label('Keresztnév', 'book-sname');
	echo form_input(array('name' => 'book-sname', 'id' => 'book-sname', 'value' => isset($posted['book_sname']) ? $posted['book_sname'] : ''));
	echo form_label('Telefon', 'phone');
	echo form_input(array('name' => 'phone', 'id' => 'phone', 'value' => isset($posted['phone']) ? $posted['phone'] : ''));
	
	echo '</p><p>';
	echo form_label('Fizetés', 'payment-option');
	echo form_dropdown('payment-option', array('card' => 'átutalással', 'cache' => 'készpénzzel'), 'card', 'id="payment-option"');
	echo form_label('Elfogadom a <a href="'.base_url().'index.php/pages/eula" id="link-eula" target="_blank">feltételeket</a>', 'eula');
	echo form_checkbox(array('name' => 'eula', 'id' => 'eula', 'value' => 'accept', 'checked' => isset($posted['eula']) ? true : false));

	echo '</p><p>';
	echo form_label('Email', 'email');
	echo form_input(array('name' => 'email', 'id' => 'email', 'value' => isset($posted['email']) ? $posted['email'] : ''));
	echo form_label('Számlázási adatok különböznek', 'billing');
	echo form_checkbox(array('name' => 'billing', 'id' => 'billing', 'value' => 'accept', 'checked' => isset($posted['billing']) ? true : false));

	echo '</p><p>';
	echo form_label('Vezetéknév', 'bill-fname');
	echo form_input(array('name' => 'bill-fname', 'id' => 'bill-fname', 'value' => isset($posted['bill_fname']) ? $posted['bill_fname'] : ''));
	echo form_label('Keresztnév', 'bill-sname');
	echo form_input(array('name' => 'bill-sname', 'id' => 'bill-sname', 'value' => isset($posted['bill_sname']) ? $posted['bill_sname'] : ''));
	echo form_label('Adószám', 'tax-number');
	echo form_input(array('name' => 'tax-number', 'id' => 'tax-number', 'value' => isset($posted['tax_number']) ? $posted['tax_number'] : ''));

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
	echo form_submit(array('name' => 'book-btn', 'id' => 'book-btn', 'value' => 'Foglalás'));

	echo '</p>';
	echo form_close();
?>
<script type="text/javascript">

	if (!$('#billing').is(':checked')) {
		$('#tax-number').hide();
		$('#bill-fname').hide();
		$('#bill-sname').hide();
		$('label[for="tax-number"]').hide();
		$('label[for="bill-fname"]').hide();
		$('label[for="bill-sname"]').hide();
	}
	
	$('#billing').click(function() {
		if ($('#billing').is(':checked')) {
			$('#tax-number').fadeIn();
			$('#bill-fname').fadeIn();
			$('#bill-sname').fadeIn();
			$('label[for="tax-number"]').fadeIn();
			$('label[for="bill-fname"]').fadeIn();
			$('label[for="bill-sname"]').fadeIn();
		} else {
			$('#tax-number').fadeOut();
			$('#bill-fname').fadeOut();
			$('#bill-sname').fadeOut();
			$('label[for="tax-number"]').fadeOut();
			$('label[for="bill-fname"]').fadeOut();
			$('label[for="bill-sname"]').fadeOut();
		}
	});
	
	$('#booking-form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/addBooking',
			type: 'POST',
			data: $('#booking-form').serialize(),
			success: function(result){
				refreshTable(parseInt($('#head-timestamp').text()));
				$('#booking-details').html(result);
			},
		statusCode: {
			404: function() {
				$('#booking-details').html('<form id="error-form"><h3>Kapcsolódási hiba!</h3></form>');
			},
			500: function() {
				refreshTable(parseInt($('#head-timestamp').text()));
				$('#booking-details').html('<form id="error-form"><h3>Lekésted!</h3><br/><p>Mialatt nézelődtél befoglalták az általad kiválasztott időpontot! Válassz egy újat.</p></form>');
			}
		}
		
		});
	});

</script>