<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper_admin">
		<h1>
			Jelszó változtatás
		</h1>
		<h3 id="flash_msg">
			<?= $this->session->flashdata('msg') ?>
			<?= validation_errors() ?>
		</h3>
		<?php
			echo form_open('admin/change_password', array('class' => 'centered'));
			echo '<p>';
			echo form_label('Régi jelszó', 'current_password');
			echo form_password('current_password');
			echo '</p><p>';
			echo form_label('Új jelszó', 'new_password_1');
			echo form_password('new_password_1');
			echo '</p><p>';
			echo form_label('Új jelszó újra', 'new_password_2');
			echo form_password('new_password_2');
			echo '</p><p>';
			echo '<br/>';
			echo form_submit('change', 'Mehet');
			echo '</p>';
			echo form_close();
		?>
		<p>
			<a href="<?= base_url() ?>index.php/admin">Vissza</a>
		</p>
	</div>
</body>
</html>