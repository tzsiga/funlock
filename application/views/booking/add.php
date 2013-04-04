<?php $this->load->view('header'); ?>
	<div id="wrapper_admin">
		<h1>
			Új foglalás
		</h1>
		<h3 id="flash_msg">
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<?php
			echo form_open('booking/add_appointment');
			echo '<p>';
			echo form_label('Időpont', 'booking_date');
			echo form_input(array('name' => 'booking_date', 'id' => 'booking_date'));
			echo '</p><p>';
			echo form_label('Vezetéknév', 'firstname');
			echo form_input(array('name' => 'firstname', 'id' => 'firstname'));
			echo '</p><p>';
			echo form_label('Keresztnév', 'lastname');
			echo form_input(array('name' => 'lastname', 'id' => 'lastname'));
			echo '</p><p>';
			echo form_label('Fizetés kártyával', 'payment_option_1');
			echo form_radio(array('name' => 'payment_option_1', 'id' => 'payment_option_1', 'value' => 'card'));
			echo '</p><p>';
			echo form_label('Fizetés készpénzzel', 'payment_option_2');
			echo form_radio(array('name' => 'payment_option_2', 'id' => 'payment_option_2', 'value' => 'cache'));
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
<?php $this->load->view('footer'); ?>