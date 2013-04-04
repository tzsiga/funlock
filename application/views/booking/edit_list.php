<?php $this->load->view('header'); ?>
	<div id="wrapper_admin">
		<h1>
			Foglalások szerkesztése/törlése
		</h1>
		<h3 id="flash_msg">
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<div id="admin_menu">
			<ul>
			<?php
				foreach ($reserved_dates as $date => $booking) {
					echo '<li><a href="">';
					echo date('Y-m-d H:i', $date);
					echo '</a> - ';
					echo $booking['client'];
					echo '</li>';
				}
			?>
			</ul>
			<p>
				<a href="<?= base_url() ?>index.php/admin">Vissza</a>
			</p>
		</div>
	</div>
<?php $this->load->view('footer'); ?>