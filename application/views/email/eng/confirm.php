<?php $this->load->view('header'); ?>
  <body id="confirm-email">
    <h2>Dear <?= $posted['book-sname'] ?>!</h2>
    <p>We are glad that you take part in this adventurous journey! Before you arrive (your date:  <?= date("Y-m-d H:i", $posted['appointment']) ?>), you have three more tasks left:</p>
    <ol>
      <?php
        if ($posted['payment-option'] == 'card') {
      ?>
      <li>Please transfer the (<?= isset($voucher) ? $voucher->discounted_price : lang('base_price') ?> HuF) to our bank account at least <strong>two days</strong> before your booked date.
        <br/>Name: Flow4Freedom Kft.
        <br/>Account number: 10918001-00000026-88000000
        <br/>Notice: <strong><?= $this->booking_model->convertTimeToBookingCode($posted['appointment']) ?></strong></li>
      <?php
        } else {
      ?>
      <li>Please bring the price (<?= isset($voucher) ? $voucher->discounted_price : lang('base_price') ?> HuF) to our place at the booked appointment!
        <br/>Address: 1068 Budapest, Hegedű street 1.
        <br/>Reservation number: “<?= $this->booking_model->convertTimeToBookingCode($posted['appointment']) ?>”</li>
      <?php
        }
      ?>
      <li><a href="<?= base_url().'assets/email/funlock_prof_ossz.pdf' ?>" target="_blank">Here</a> you can find all the information you will need in order to start the game and to find out the access code.</li>
      <li>Please arrive on time and have a good time!</li>
    </ol>
    <p>We are looking forward meeting you:<br/><em>Funlock-Team</em></p>
  </body>
</html>