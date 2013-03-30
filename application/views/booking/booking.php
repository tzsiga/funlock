<?php $this->load->view('header'); ?>
	<body>
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
					<?php $this->load->view('booking/calendar', array('reserved_dates' => $reserved_dates, 'ref_time' => time() )); ?>
					<span id="next_month">&gt;&gt;</span>
				</div>
				<div id="reserve_details">
					<form>
						<p>Időpont: <input id="reserve_date" type="text" name="date"></p>
						<p>Vezetéknév: <input type="text" name="firstname">Keresztnév: <input type="text" name="lastname"></p>
						<p><input type="radio" name="payment_option" value="male">Fizetés kártyával</p>
						<p><input type="radio" name="payment_option" value="female">Fizetés készpénzzel</p>
						<p><input type="checkbox" name="eula" value="eula">Egyetértek a <a href="">szerződéssel</a></p><br/>
						<input type="submit" value="Foglalás">
					</form> 
				</div>
			</div>
		</div>
		<?php $this->load->view('booking/booking_js'); ?>
	</body>
</html>