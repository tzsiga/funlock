<?php $this->load->view('header'); ?>
<body id="admin-page">
	<h1>
		Adminisztrációs felület
	</h1>
	<h3 id="flash-msg">
		<?= $this->session->flashdata('msg') ?>
		<?= validation_errors() ?>
	</h3>
	<?php
		echo form_open('admin/login', array('class' => 'centered'));
		echo '<p>';
		echo form_label('Jelszó', 'given-password');
		echo form_password('given-password');
		echo '</p><p>';
		echo '<br/>';
		echo form_submit('login', 'Bejelentkezés');
		echo '</p>';
		echo form_close();		
	?>
</body>
</html>