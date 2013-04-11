<div class="error_msg">
	<?= validation_errors() ?>
</div>
<?php
	echo form_open('booking/add_appointment', array('id' => 'booking_form'));
	echo '<p>';
	echo form_label('Időpont', 'appointment');
	echo form_input(array('name' => 'appointment', 'id' => 'appointment', 'value' => isset($posted['appointment']) ? $posted['appointment'] : ''));
	echo form_hidden('booking_date', date('Y-m-d H:i'));
	echo '</p><p>';
	echo form_label('Vezetéknév', 'book_fname');
	echo form_input(array('name' => 'book_fname', 'id' => 'book_fname', 'value' => isset($posted['book_fname']) ? $posted['book_fname'] : ''));
	echo '</p><p>';
	echo form_label('Keresztnév', 'book_sname');
	echo form_input(array('name' => 'book_sname', 'id' => 'book_sname', 'value' => isset($posted['book_sname']) ? $posted['book_sname'] : ''));
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
<script type="text/javascript">
	
	$('#booking_form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/add_appointment',
			type: 'POST',
			data: $('#booking_form').serialize()
		}).done(function(result){
			refreshTable(parseInt($('#reference_time').attr('alt')));
			$('#booking_details').html(result);
			
			/*
			// if booking was successful
			$('#booking_details').invisible();
			// clear form fields
			$('#appointment').val('');
			$('#book_fname').val('');
			$('#book_sname').val('');
			$('#payment_option_1').val('');
			$('#payment_option_2').val('');
			*/
		});
	});

</script>