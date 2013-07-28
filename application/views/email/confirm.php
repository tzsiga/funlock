<?php $this->load->view('header'); ?>
  <body id="confirm-email">
    <h2>Keves Csapat!</h2>
    <p>Örülünk, hogy elvállaltátok a küldetést! Mielőtt a helyszínre érkeznétek (időpontotok:  <?= date("Y-m-d H:i", $posted['appointment']) ?>), három kisebb feladatot kell elvégeznetek:</p>
    <ol>
      <?php
        if ($posted['payment-option'] == 'card') {
      ?>
      <li>Utaljátok el a foglalási összeget (<?= isset($voucher) ? $voucher->discounted_price : '12000' ?> Ft) a játék megkezdése előtt minimum <strong>két nappal</strong>, hogy foglalásotokat érvényesítsétek.
        <br/>Név: Flow4Freedom Kft.
        <br/>Számlaszámrara: 10918001-00000026-88000000
        <br/>Közlemény: <strong><?= $this->booking_model->convertTimeToBookingCode($posted['appointment']) ?></strong></li>
      <?php
        } else {
      ?>
      <li>Hozzátok be a foglalási összeget (<?= isset($voucher) ? $voucher->discounted_price : '12000' ?> Ft) a játék megkezdése előtt minimum <strong>két nappal</strong>, hogy foglalásotokat érvényesítsétek.
        <br/>Cím: 1068 Budapest, Király utca. 54. (bejárat a Hegedű utca felől)
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