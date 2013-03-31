<?php $this->load->view('header'); ?>
	<div id="wrapper_content">
		<div id="navbar">
			<div id="info">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
				Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
				Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
			<div id="menu">
				<ul>
					<li><p id="link_info">Info</a></li>
					<li><p id="link_map">Térkép</a></li>
					<li><p id="link_contact">Elérhetőség</a></li>
				</ul>
			</div>
			<div id="contact">
				Budapest 1023, Galgóczy u. 16. T.: 0036/307726213, info@funlock.hu
			</div>
			<img id="map" src="<?= base_url() ?>assets/img/map.png" alt="" title="" />
		</div>
		<div id="content">
			<div id="calendar">
				<span id="prev_month">&lt;&lt;</span>
				<?php $this->load->view('booking/calendar', array('reserved_dates' => $reserved_dates, 'ref_time' => time())); ?>
				<span id="next_month">&gt;&gt;</span>
			</div>
			<div id="booking_details">
				<?php
					echo form_open('booking/book');
					echo '<p>';
					echo form_label('Időpont', 'booking_date');
					echo form_input(array('name' => 'booking_date', 'id' => 'booking_date'));
					echo '</p><p>';
					echo form_label('Vezetéknév', 'firstname');
					echo form_input(array('name' => 'firstname', 'id' => 'firstname'));
					echo '</p><p>';
					echo form_label('Keresztnév', 'lastname');
					echo form_input(array('name' => 'lastname', 'id' => 'lastname'));
					echo '</p><p>';
					echo form_label('Fizetés kártyával', 'payment_option_1');
					echo form_radio(array('name' => 'payment_option_1', 'id' => 'payment_option_1', 'value' => 'card'));
					echo '</p><p>';
					echo form_label('Fizetés készpénzzel', 'payment_option_2');
					echo form_radio(array('name' => 'payment_option_2', 'id' => 'payment_option_2', 'value' => 'cache'));
					echo '</p><p>';
					echo form_label('Egyetértek a szerződéssel', 'eula');
					echo form_checkbox(array('name' => 'eula', 'id' => 'eula', 'value' => 'accept'));
					echo '</p><p>';
					echo '<br/>';
					echo form_submit('book', 'Foglalás');
					echo '</p>';
					echo form_close();
				?>
			</div>
		</div>
	</div>
	<?php $this->load->view('booking/booking_js'); ?>
<?php $this->load->view('footer'); ?>