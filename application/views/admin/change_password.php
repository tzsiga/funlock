<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper-admin">
		<h1>
			Jelszó változtatás
		</h1>
		<h3 id="flash-msg">
			<?= $this->session->flashdata('msg') ?>
			<?= validation_errors() ?>
		</h3>
		<?php
			echo form_open('admin/changePassword', array('class' => 'centered'));
			echo '<p>';
			echo form_label('Régi jelszó', 'current-password');
			echo form_password('current-password');
			echo '</p><p>';
			echo form_label('Új jelszó', 'new-password-1');
			echo form_password('new-password-1');
			echo '</p><p>';
			echo form_label('Új jelszó újra', 'new-password-2');
			echo form_password('new-password-2');
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