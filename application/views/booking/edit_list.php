<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper_admin">
		<h1>
			Foglalások szerkesztése/törlése
		</h1>
		<h3 id="flash_msg">
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<div id="admin_menu">
			<h3>Lejátszott játékok:</h3>
			<ul>
			<?php
				$current_time_flag = true;
			
				foreach ($reserved_dates as $date => $booking) {
					if ($date > time() && $current_time_flag) {
						echo '</ul><hr/><h3>Új játékok:</h3><ul>';
						$current_time_flag = false;
					}
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
</body>
</html>