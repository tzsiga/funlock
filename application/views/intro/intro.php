<?php $this->load->view('header'); ?>
	<body>
		<div id="action_zone">
			<!-- az action zone tartalmazza a slidereket, hozzá képest kell megadni a csúszkák KEZDETI pozícióját -->
			<div class="slider" id="S1" style="margin-top: 0px; margin-left: 0;"></div>
			<div class="slider" id="S2" style="margin-top: -100px; margin-left: 10px;"></div>
			<div class="slider" id="S3" style="margin-top: 700px; margin-left: 20px;"></div>
			<div class="slider" id="S4" style="margin-top: 200px; margin-left: 30px;"></div>
			<div class="slider" id="S5" style="margin-top: -50px; margin-left: 40px;"></div>
			<div class="slider" id="S6" style="margin-top: 350px; margin-left: 50px;"></div>
			<div class="slider" id="S7" style="margin-top: -150px; margin-left: 60px;"></div>
			<div class="slider" id="S8" style="margin-top: 100px; margin-left: 70px;"></div>
			<div id="enter"><a href="<?= base_url().'index.php/pages/calendar' ?>">ENTER</a></div>
		</div>
		<?php $this->load->view('intro/intro_js'); ?>
	</body>
</html>