<?php $this->load->view('header'); ?>
	<h1>
		Jelszó változtatás
	</h1>
	<h3 id="flash_msg">
		<?= $this->session->flashdata('msg') ?>
		<?= validation_errors() ?>
	</h3>
	<p>
		<?php
			echo form_open('admin/change_password', array('class' => 'centered'));
			echo form_label('Régi jelszó', 'current_password');
			echo form_password('current_password');
			echo '<br/>';
			echo form_label('Új jelszó', 'new_password_1');
			echo form_password('new_password_1');
			echo '<br/>';
			echo form_label('Új jelszó újra', 'new_password_2');
			echo form_password('new_password_2');
			echo '<br/>';
			echo form_submit('change', 'Mehet!');
			echo form_close();
		?>
	</p>
	<p>
		<a href="<?= base_url() ?>index.php/admin">Vissza</a>
	</p>
<?php $this->load->view('footer'); ?>