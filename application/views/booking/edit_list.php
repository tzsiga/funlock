<?php $this->load->view('header_admin'); ?>
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
					echo '<li>';
					echo date('Y-m-d H:i', $date);
					echo ' - ';
					echo $booking['client'];
					echo ' - ';
					echo '<a href="'.base_url().'index.php/booking/edit/'.$booking['id'].'">';
					echo 'szerkesztés';
					echo '</a>';
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