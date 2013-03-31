<?php $this->load->view('header'); ?>
	<h1>
		Adminisztrációs felület
	</h1>
	<h3 id="flash_msg">
		<?= $this->session->flashdata('msg') ?>
	</h3>
	<p>
		<h3>Foglalások kezelése</h3>
		<ul>
			<li><a href="<?= base_url() ?>index.php/booking/add">Új létrehozása</a></li>
			<li><a href="<?= base_url() ?>index.php/booking/edit">Meglévők módosítása, törlése</a></li>
		</ul>
		<h3>Beállítások</h3>
		<ul>
			<li><a href="<?= base_url() ?>index.php/admin/change_password">Jelszó változtatás</a></li>
			<li><a href="<?= base_url() ?>index.php/admin/logout">Kijelentkezés</a></li>
		</ul>
	</p>
<?php $this->load->view('footer'); ?>