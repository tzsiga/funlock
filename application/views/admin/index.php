<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper-admin">
		<h1>
			Adminisztrációs felület
		</h1>
		<h3 id="flash-msg">
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<div id="admin-menu">
			<h3>Foglalások kezelése</h3>
			<ul>
				<li><a href="<?= base_url() ?>index.php/booking/EditTable">Új létrehozása, meglévők módosítása/törlése</a></li>
			</ul>
			<h3>Verzió</h3>
			<ul>
				<li><a href="<?= base_url() ?>index.php/admin/phpinfo">phpinfo</a></li>
				<li>php version: <?= phpversion() ?></li>
				<li>CodeIgniter version: <?= CI_VERSION ?></li>
				<li>jQuery version: <?= '<script type="text/javascript">document.write($.fn.jquery);</script>' ?></li>
			</ul>
			<h3>Beállítások</h3>
			<ul>
				<li><a href="<?= base_url() ?>index.php/admin/changeLimit">Foglalási limit változtatás</a></li>
				<li><a href="<?= base_url() ?>index.php/admin/changePassword">Jelszó változtatás</a></li>
				<li><a href="<?= base_url() ?>index.php/admin/logout">Kijelentkezés</a></li>
			</ul>
		</div>
	</div>
</body>
</html>