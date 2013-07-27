<?php $this->load->view('header'); ?>
<body id="main-page">
  <div id="wrapper-content">
    <div id="navbar">
      <a href="<?= base_url().'index.php/main' ?>"><?= img(array('src' => base_url().'assets/img/main/logo_small.png', 'id' => 'logo-small')) ?></a>
      <?php if ($this->agent->browser() == 'Internet Explorer') {?>
      <div id="subtitle" style="margin-top: -20px;">
      <?php } else { ?>
      <div id="subtitle">
      <?php } ?>- A Bejutós Játék -</div>
      <a href="<?= base_url().'index.php/main' ?>" id="main-link"></a>
      <div id="menu">
        <ul>
          <li><p id="link-info">Info</p></li>
          <li><p id="link-story">Történet</p></li>
          <li><p id="link-contact">Elérhetőség</p></li>
          <li><p id="link-gallery"><a href="https://www.facebook.com/pages/Funlock/334668339974241?id=334668339974241&amp;sk=photos_stream" target="_blank">Galéria</a></p></li>
        </ul>
      </div>
      <div id="item-display-area"></div>
    </div>
    <div id="content">
      <div id="calendar">
        <span id="prev-month"><?= img(array('src' => base_url().'assets/img/main/arrow_left.png', 'id' => 'arrow-left')) ?></span>
        <div id="table-wrapper"><?php $this->load->view('booking/table', array('bookings' => $bookings, 'headTimestamp' => time(), 'selectedAppointment' => 0)); ?></div>
        <span id="next-month"><?= img(array('src' => base_url().'assets/img/main/arrow_right.png', 'id' => 'arrow-right')) ?></span>
      </div>
      <div id="legend">
        <div id="icon-unavailable"></div>
        <div>Nem elérhető</div>
        <div id="icon-available"></div>
        <div>Szabad</div>
        <div id="icon-reserved"></div>
        <div>Foglalt</div>
      </div>
      <div id="booking-details">
        <?php $numberOfSuccessfulBookings < $bookingLimit ? $this->load->view('booking/form') : $this->load->view('booking/form_fail_limit'); ?>
      </div>
    </div>
  </div>
  <?php $this->load->view('booking/booking_js'); ?>
</body>
</html>