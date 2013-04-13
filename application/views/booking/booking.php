<?php $this->load->view('header_admin'); ?>
	<div id="wrapper_content">
		<div id="navbar">
			<div id="menu">
				<ul>
					<li><p id="link_info">Info</a></li>
					<li><p id="link_map">Térkép</a></li>
					<li><p id="link_contact">Elérhetőség</a></li>
				</ul>
			</div>
			<div id="item_display_area">&nbsp;</div>
		</div>
		<div id="content">
			<div id="calendar">
				<span id="prev_month">&lt;&lt;</span>
				<?php $this->load->view('booking/calendar', array('reserved_dates' => $reserved_dates, 'ref_time' => time(), 'selected_appointment' => 0)); ?>
				<span id="next_month">&gt;&gt;</span>
			</div>
			<div id="booking_details">
				<?php $this->load->view('booking/form', array('is_success' => false)); ?>
			</div>
		</div>
	</div>
	<?php $this->load->view('booking/booking_js'); ?>
<?php $this->load->view('footer'); ?>