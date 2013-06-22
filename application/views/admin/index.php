<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper_admin">
		<h1>
			Adminisztrációs felület
		</h1>
		<h3 id="flash_msg">
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<div id="admin_menu">
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
				<li><a href="<?= base_url() ?>index.php/admin/change_limit">Foglalási limit változtatás</a></li>
				<li><a href="<?= base_url() ?>index.php/admin/change_password">Jelszó változtatás</a></li>
				<li><a href="<?= base_url() ?>index.php/admin/logout">Kijelentkezés</a></li>
			</ul>
		</div>
	</div>
</body>
</html>