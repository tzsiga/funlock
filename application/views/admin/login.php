<?php $this->load->view('header'); ?>
	<h1>
		Adminisztrációs felület
	</h1>
	<h3 id="flash_msg">
		<?= $this->session->flashdata('msg') ?>
		<?= validation_errors() ?>
	</h3>
	<p>
		<?php
			echo form_open('admin/login', array('class' => 'centered'));
			echo form_label('Jelszó', 'given_password');
			echo form_password('given_password');
			echo '<br/>';
			echo form_submit('login', 'Bejelentkezés!');
			echo form_close();		
		?>
	</p>
<?php $this->load->view('footer'); ?>