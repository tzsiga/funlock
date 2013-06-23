<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper-admin">
		<h1>
			Foglalási limit változtatás
		</h1>
		<h3 id="flash-msg">
			<?= validation_errors() ?>
		</h3>
		<?php
			echo form_open('admin/changeLimit', array('class' => 'centered'));
			echo '<p>';
			echo form_label('Foglalási limit', 'limit');
			echo form_input(array('name' => 'limit', 'id' => 'limit', 'value' => $currentLimit));
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