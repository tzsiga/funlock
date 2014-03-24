<?php $this->load->view('header'); ?>
  <body id="confirm-email">
    <h2>Kedves <?= $posted['book-sname'] ?>!</h2>
    <p>Örülünk, hogy elvállaltátok a küldetést! Mielőtt a helyszínre érkeznétek (időpontotok:  <?= date("Y-m-d H:i", $posted['appointment']) ?>), három kisebb feladatot kell elvégeznetek:</p>
    <ol>
      <?php
        if ($posted['payment-option'] == 'card') {
      ?>
      <li>Utaljátok el a foglalási összeget (<?= isset($voucher) ? $voucher->discounted_price : lang('base_price') ?> Ft) a játék megkezdése előtt minimum <strong>két nappal</strong>, hogy foglalásotokat érvényesítsétek.
        <br/>Név: Flow4Freedom Kft.
        <br/>Számlaszám: 10918001-00000026-88000000
        <br/>Közlemény: <strong><?= $this->booking_model->convertTimeToBookingCode($posted['appointment']) ?></strong></li>
      <li><strong>Figyelem! Átutalásos fizetés esetén a számla az utaló személy nevére lesz kiállítva! Ha az utaló személye eltér a foglaló személyétől, akkor kérünk titeket, hogy az utalás közlemény rovatában tüntessétek fel a lakcímét a foglalási azonosító mellett! Amennyiben más névre és címre kéritek a számlát, ezt is a közlemény rovatba bevitt adatok megadásával tehetitek meg.</strong></li>
      <?php
        } else {
      ?>
      <li>Hozzátok be a foglalási összeget (<?= isset($voucher) ? $voucher->discounted_price : lang('base_price') ?> Ft) a játék időpontjára!
        <br/>Cím: 1068 Budapest, Hegedű utca 1.
        <br/>Foglalási azonosító: “<?= $this->booking_model->convertTimeToBookingCode($posted['appointment']) ?>”</li>
      <?php
        }
      ?>
      <li>Itt <a href="<?= base_url().'assets/email/funlock_prof_ossz.pdf' ?>" target="_blank">megtaláljátok</a> a professzorról tudomásunkra jutott információkat. Tanulmányozzátok át, hogy rájöjjetek a bejutáshoz szükséges kombinációra!</li>
      <li>Érkezzetek időben és érezzétek jól magatokat!</li>
    </ol>
    <p>Várunk Titeket szeretettel:<br/><em>A Funlock csapata</em></p>
  </body>
</html>