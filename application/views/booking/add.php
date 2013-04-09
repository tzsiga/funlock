<?php $this->load->view('header_admin'); ?>
	<div id="wrapper_admin">
		<h1>
			Új foglalás
		</h1>
		<h3 id="flash_msg">
			<?= validation_errors() ?>
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<?php
			echo form_open('booking/add');
			echo '<p>';
			echo form_label('Foglaló vezetékneve', 'book_fname');
			echo form_input(array('name' => 'book_fname', 'id' => 'book_fname', 'value' => isset($posted['book_fname']) ? $posted['book_fname'] : '' ));
			echo '</p><p>';
			echo form_label('Foglaló keresztneve', 'book_sname');
			echo form_input(array('name' => 'book_sname', 'id' => 'book_sname', 'value' => isset($posted['book_sname']) ? $posted['book_sname'] : ''));
			echo '</p><p>';
			echo form_label('Foglalt időpont', 'appointment');
			echo form_input(array('name' => 'appointment', 'id' => 'appointment', 'value' => isset($posted['appointment']) ? $posted['appointment'] : '')).' - ';
			$options = array_combine(range(Utils::hour_from, Utils::hour_to), range(Utils::hour_from, Utils::hour_to));
			echo form_dropdown('appointment_hour', $options, isset($posted['appointment_hour']) ? $posted['appointment_hour'] : 10).' : 00';
			echo '</p><p>';
			echo form_label('Fizetés kártyával', 'payment_option');
			echo form_radio(array('name' => 'payment_option', 'id' => 'payment_option_1', 'value' => 'card'));
			echo '</p><p>';
			echo form_label('Fizetés készpénzzel', 'payment_option');
			echo form_radio(array('name' => 'payment_option', 'id' => 'payment_option_2', 'value' => 'cache'));
			echo '</p><p>';
			echo form_label('Számla: vezetéknév', 'bill_fname');
			echo form_input(array('name' => 'bill_fname', 'id' => 'bill_fname', 'value' => isset($posted['bill_fname']) ? $posted['bill_fname'] : ''));
			echo '</p><p>';
			echo form_label('Számla: keresztnév', 'bill_sname');
			echo form_input(array('name' => 'bill_sname', 'id' => 'bill_sname', 'value' => isset($posted['bill_sname']) ? $posted['bill_sname'] : ''));
			echo '</p><p>';
			echo form_label('Email cím', 'email');
			echo form_input(array('name' => 'email', 'id' => 'email', 'value' => isset($posted['email']) ? $posted['email'] : ''));
			echo '</p><p>';
			echo form_label('Irányítószám', 'zip');
			echo form_input(array('name' => 'zip', 'id' => 'zip', 'value' => isset($posted['zip']) ? $posted['zip'] : ''));
			echo '</p><p>';
			echo form_label('Adószám', 'tax_number');
			echo form_input(array('name' => 'tax_number', 'id' => 'tax_number', 'value' => isset($posted['tax_number']) ? $posted['tax_number'] : ''));
			echo '</p><p>';
			echo form_label('Megjegyzések', 'comment');
			echo form_input(array('name' => 'comment', 'id' => 'comment', 'value' => isset($posted['comment']) ? $posted['comment'] : ''));
			echo '</p><p>';
			echo form_label('Jegyzetek', 'notes');
			echo form_input(array('name' => 'notes', 'id' => 'notes', 'value' => isset($posted['notes']) ? $posted['notes'] : ''));
			echo '</p><p>';
			echo form_label('Foglalás időpontja', 'booking_date');
			echo form_input(array('name' => 'booking_date', 'id' => 'booking_date', 'value' => date('Y-m-d H:i')));
			echo '</p><p>';
			echo '<br/>';
			echo form_submit('book', 'Foglalás');
			echo '</p>';
			echo form_close();
		?>
		<p>
			<a href="<?= base_url() ?>index.php/admin">Vissza</a>
		</p>
	</div>
	<script type="text/javascript">
		$('#appointment').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
		$('#booking_date').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd <?= date('H:i') ?>' });
	</script>
<?php $this->load->view('footer'); ?>