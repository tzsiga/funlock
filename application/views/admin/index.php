<?php $this->load->view('header'); ?>
<body id="admin-page">
	<h1>
		Adminisztrációs felület
	</h1>
	<h3 id="flash-msg">
		<?= $this->session->flashdata('msg') ?>
	</h3>
	<div id="admin-menu">
		<h3>Eszközök</h3>
		<ul>
			<li><a href="<?= base_url() ?>index.php/BookingAdmin/EditTable">Foglalások kezelése</a></li>
			<li><a href="<?= base_url() ?>index.php/VoucherAdmin/CreateVoucher">Voucherek generálása</a></li>
		</ul>
		<h3>Verzió</h3>
		<ul>
			<li><a href="<?= base_url() ?>index.php/Config/phpinfo">phpinfo</a></li>
			<li>php version: <?= phpversion() ?></li>
			<li>CodeIgniter version: <?= CI_VERSION ?></li>
			<li>jQuery version: <?= '<script type="text/javascript">document.write($.fn.jquery);</script>' ?></li>
		</ul>
		<h3>Beállítások</h3>
		<ul>
			<li><a href="<?= base_url() ?>index.php/Config/changeLimit">Foglalási limit változtatás</a></li>
			<li><a href="<?= base_url() ?>index.php/Config/changePassword">Jelszó változtatás</a></li>
			<li><a href="<?= base_url() ?>index.php/Admin/logout">Kijelentkezés</a></li>
		</ul>
	</div>
</body>
</html>