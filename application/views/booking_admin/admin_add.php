<?php $this->load->view('header'); ?>
<?php $this->load->view('booking_admin/admin_utils'); ?>
<body>
	<div id="wrapper-admin">
		<h1>
			Új foglalás
		</h1>
		<h3 id="flash-msg">
			<?= validation_errors() ?>
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<?php
			echo form_open('BookingAdmin/addBookingAsAdmin');
			echo '<p>';
			echo form_label('<strong>Foglaló vezetékneve</strong>', 'book-fname');
			echo form_input(array('name' => 'book-fname', 'id' => 'book-fname', 'value' => isset($posted['book-fname']) ? $posted['book-fname'] : '' ));
			echo '</p><p>';
			echo form_label('<strong>Foglaló keresztneve</strong>', 'book-sname');
			echo form_input(array('name' => 'book-sname', 'id' => 'book-sname', 'value' => isset($posted['book-sname']) ? $posted['book-sname'] : ''));
			echo '</p><p>';
			echo form_label('Foglalt időpont', 'appointment');
			echo form_input(array('name' => 'appointment', 'id' => 'appointment', 'value' => isset($posted['appointment']) ? $posted['appointment'] : date('Y-m-d', $timestamp))).' - ';
			echo form_dropdown('appointment-hour', getPlaytimeRangeDropdownValues(), isset($posted['appointment-hour']) ? $posted['appointment-hour'] : date('G', $timestamp) + (date('i', $timestamp) == 30 ? 0.5 : 0));
			echo '</p><p>';
			echo form_label('<strong>Fizetés átutalással</strong>', 'payment-option');
			echo form_radio(array('name' => 'payment-option', 'id' => 'payment-option-1', 'value' => 'card'));
			echo '</p><p>';
			echo form_label('<strong>Fizetés készpénzzel</strong>', 'payment-option');
			echo form_radio(array('name' => 'payment-option', 'id' => 'payment-option-2', 'value' => 'cache', 'checked' => true));
			echo '</p><p>';
			echo form_label('Telefon', 'phone');
			echo form_input(array('name' => 'phone', 'id' => 'phone', 'value' => isset($posted['phone']) ? $posted['phone'] : ''));
			echo '</p><p>';
			echo form_label('Email cím', 'email');
			echo form_input(array('name' => 'email', 'id' => 'email', 'value' => isset($posted['email']) ? $posted['email'] : ''));
			echo '</p><p>';
			echo form_label('Irányítószám', 'zip');
			echo form_input(array('name' => 'zip', 'id' => 'zip', 'value' => isset($posted['zip']) ? $posted['zip'] : ''));
			echo '</p><p>';
			echo form_label('Város', 'city');
			echo form_input(array('name' => 'city', 'id' => 'city', 'value' => isset($posted['city']) ? $posted['city'] : ''));
			echo '</p><p>';
			echo form_label('Utca', 'street');
			echo form_input(array('name' => 'street', 'id' => 'street', 'value' => isset($posted['street']) ? $posted['street'] : ''));
			echo '</p><p>';
			echo form_label('Házszám', 'house');
			echo form_input(array('name' => 'house', 'id' => 'house', 'value' => isset($posted['house']) ? $posted['house'] : ''));
			echo '</p><p>';
			echo form_label('Számla: vezetéknév', 'bill-fname');
			echo form_input(array('name' => 'bill-fname', 'id' => 'bill-fname', 'value' => isset($posted['bill-fname']) ? $posted['bill-fname'] : ''));
			echo '</p><p>';
			echo form_label('Számla: keresztnév', 'bill-sname');
			echo form_input(array('name' => 'bill-sname', 'id' => 'bill-sname', 'value' => isset($posted['bill-sname']) ? $posted['bill-sname'] : ''));
			echo '</p><p>';
			echo form_label('Adószám', 'tax-number');
			echo form_input(array('name' => 'tax-number', 'id' => 'tax-number', 'value' => isset($posted['tax-number']) ? $posted['tax-number'] : ''));
			echo '</p><p>';
			echo form_label('Megjegyzések', 'comment');
			echo form_textarea(array('name' => 'comment', 'id' => 'comment', 'value' => isset($posted['comment']) ? $posted['comment'] : '', 'rows' => 6, 'cols' => 54));
			echo '</p><p>';
			echo form_label('Jegyzetek', 'notes');
			echo form_textarea(array('name' => 'notes', 'id' => 'notes', 'value' => isset($posted['notes']) ? $posted['notes'] : '', 'rows' => 6, 'cols' => 54));
			echo '</p><p>';
			echo form_label('Foglalás időpontja', 'booking-date');
			echo form_input(array('name' => 'booking-date', 'id' => 'booking-date', 'value' => date('Y-m-d H:i')));
			echo '</p><p>';
			echo '<br/>';
			echo form_submit('book', 'Foglalás');
			echo '</p>';
			echo form_close();
		?>
		<p>
			<a href="<?= base_url() ?>index.php/BookingAdmin/editTable">Vissza</a>
		</p>
	</div>
	<script type="text/javascript">
		$('#appointment').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
		$('#booking-date').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd <?= date('H:i') ?>' });
	</script>
</body>
</html>