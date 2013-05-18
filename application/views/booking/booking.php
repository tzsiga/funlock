<?php $this->load->view('header'); ?>
<body id="main_page">
	<div id="wrapper_content">
		<div id="navbar">
			<?= img(array('src' => base_url().'assets/img/main/logo_small.png', 'id' => 'logo_small')) ?>
			<div id="menu">
				<ul>
					<li><p id="link_info">Info</a></li>
					<li><p id="link_contact">Elérhetőség</a></li>
				</ul>
			</div>
			<div id="item_display_area"></div>
		</div>
		<div id="content">
			<div id="calendar">
				<span id="prev_month"><?= img(array('src' => base_url().'assets/img/main/arrow_left.png', 'id' => 'arrow_left')) ?></span>
				<span id="table_wrapper"><?php $this->load->view('booking/calendar', array('reserved_dates' => $reserved_dates, 'ref_time' => time(), 'selected_appointment' => 0)); ?></span>
				<span id="next_month"><?= img(array('src' => base_url().'assets/img/main/arrow_right.png', 'id' => 'arrow_right')) ?></span>
			</div>
			<div id="legend">
				<div id="icon_unavailable"></div>
				<div>Nem elérhető</div>
				<div id="icon_available"></div>
				<div>Szabad</div>
				<div id="icon_reserved"></div>
				<div>Foglalt</div>
			</div>
			<div id="booking_details">
				<?php $this->load->view('booking/form'); ?>
			</div>
		</div>
	</div>
	<?php $this->load->view('booking/booking_js'); ?>
</body>
</html>