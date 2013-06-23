<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper-admin">
		<h1>
			Foglalások szerkesztése/törlése
		</h1>
		<h3 id="flash-msg">
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<div id="admin-menu">
			<h3>Lejátszott játékok:</h3>
			<ul>
			<?php
				$currentTimeFlag = true;
			
				foreach ($bookings as $date => $booking) {
					if ($date > time() && $currentTimeFlag) {
						echo '</ul><hr/><h3>Új játékok:</h3><ul>';
						$currentTimeFlag = false;
					}
					echo '<li>';
					echo date('Y-m-d H:i', $date);
					echo ' - ';
					echo $booking['client'];
					echo ' - ';
					echo '<a href="'.base_url().'index.php/booking/editBooking/'.$booking['id'].'">';
					echo 'szerkesztés';
					echo '</a>';
					echo '</li>';
				}
			?>
			</ul>
			<p>
				<a href="<?= base_url() ?>index.php/booking/EditTable">Vissza</a>
			</p>
		</div>
	</div>
</body>
</html>