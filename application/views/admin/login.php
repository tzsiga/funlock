<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper_admin">
		<h1>
			Adminisztrációs felület
		</h1>
		<h3 id="flash_msg">
			<?= $this->session->flashdata('msg') ?>
			<?= validation_errors() ?>
		</h3>
		<?php
			echo form_open('admin/login', array('class' => 'centered'));
			echo '<p>';
			echo form_label('Jelszó', 'given_password');
			echo form_password('given_password');
			echo '</p><p>';
			echo '<br/>';
			echo form_submit('login', 'Bejelentkezés');
			echo '</p>';
			echo form_close();		
		?>
	</div>
</body>
</html>