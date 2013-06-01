<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper_admin">
		<h1>
			Foglalási limit változtatás
		</h1>
		<h3 id="flash_msg">
			<?= validation_errors() ?>
		</h3>
		<?php
			echo form_open('admin/change_limit', array('class' => 'centered'));
			echo '<p>';
			echo form_label('Foglalási limit', 'limit');
			echo form_input(array('name' => 'limit', 'id' => 'limit', 'value' => $current_limit));
			echo '</p><p>';
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