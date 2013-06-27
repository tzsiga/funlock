<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper-admin">
		<h1>
			Voucher
		</h1>
		<h3 id="flash-msg">
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<?php
			echo '<p>Új voucher: '.$new_voucher['code'].'</p>';
			
			echo '<p>Eddig generáltak:</p><ul>';
			foreach ($vouchers->result() as $row) {
				echo '<li>'.$row->code.'</li>';
			}
			echo '</ul>';
		?>
	</div>
</body>
</html>