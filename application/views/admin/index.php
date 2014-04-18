<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <div id="admin-menu container">
    <h1>
      Adminisztrációs felület
    </h1>
    <br/>
    <?php $this->load->view('admin/alert'); ?>
    <div class="container col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-tasks"></span> Eszközök</h3>
        </div>

        <div class="panel-body">
          <strong>Foglalások kezelése</strong>
          <ul>
            <li><a href="<?= base_url() ?>index.php/admin/booking/edit">Heti nézet</a></li>
            <li><a href="<?= base_url() ?>index.php/admin/booking/list">Listanézet</a></li>
          </ul>
          <strong>Kuponok kezelése</strong>
          <ul>
            <li><a href="<?= base_url() ?>index.php/admin/voucher/add">Kuponok generálása</a></li>
            <li><a href="<?= base_url() ?>index.php/admin/voucher/unique">Egyedi kupon létrehozása</a></li>
            <li><a href="<?= base_url() ?>index.php/admin/voucher/list">Listanézet</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-wrench"></span> Beállítások</h3>
        </div>
        <div class="panel-body">
          <a href="<?= base_url() ?>index.php/admin/config/change_limit">Foglalási limit változtatás</a><br/>
          <a href="<?= base_url() ?>index.php/admin/config/change_password">Jelszó változtatás</a>
        </div>
      </div>
    </div>

    <div class="container col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-th-large"></span> Verzió</h3>
        </div>
        <div class="panel-body">
          konfig: <a href="http://funlock.hu/cpanel">cPanel</a><br/>
          php: <a href="<?= base_url() ?>index.php/admin/config/phpinfo">phpinfo</a>, version: <?= phpversion() ?><br/>
          CodeIgniter: <?= CI_VERSION ?><br/>
          jQuery: <?= '<script type="text/javascript">document.write($.fn.jquery);</script>' ?>
        </div>
      </div>
    </div>

  </div>
</div>
</body>
</html>