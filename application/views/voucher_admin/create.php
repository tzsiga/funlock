<?php $this->load->view('header'); ?>
<body id="admin-page">
	<h1>
		Voucher generálása
	</h1>
	<h3 id="flash-msg">
		<?= $this->session->flashdata('msg') ?>
	</h3>
	<?php
		echo '<p>Új voucher: '.$new_voucher['code'].'</p>';
	?>
  <p><a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
</body>
</html>