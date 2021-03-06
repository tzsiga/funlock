<?php $this->load->view('header'); ?>
<body id="main-page">
  <div id="loading"></div>
  <div id="wrapper-content">
    <div id="navbar">
      <a href="<?= base_url().'index.php/main' ?>"><?= img(array('src' => base_url().'assets/img/main/logo_small.png', 'id' => 'logo-small')) ?></a>
      <?php if ($this->agent->browser() == 'Internet Explorer') {?>
      <div id="subtitle" style="margin-top: -20px;">
      <?php } else { ?>
      <div id="subtitle">
      <?php } 
        echo lang('subtitle');
      ?></div>
      <a href="<?= base_url().'index.php/main' ?>" id="main-link"></a>
      <div id="menu">
        <ul>
          <li><p id="link-info"><?= lang('menuitem_1') ?></p></li>
          <li><p id="link-story"><?= lang('menuitem_2') ?></p></li>
          <li><p id="link-contact"><?= lang('menuitem_3') ?></p></li>
          <li><p id="link-gallery"><a href="https://www.facebook.com/FunlockBudapest/photos_albums" target="_blank"><?= lang('menuitem_4') ?></a></p></li>
          <li><p id="link-about"><?= lang('menuitem_5') ?></p></li>
        </ul>
      </div>
      <div id="item-display-area"></div>
      <span id="sidebar-logo">
        <br/>
        <a href="https://hu-hu.facebook.com/FunlockBudapest" target="_blank">
          <?= img(array('src' => base_url().'assets/img/logo/logo_f_gs.png', 'class' => 'rollover')) ?>
        </a>
        <a href="https://www.tripadvisor.com/UserReviewEdit-g274887-d4795570-a_placetype.10021-Funlock-Budapest_Central_Hungary.html" target="_blank">
          <?= img(array('src' => base_url().'assets/img/logo/logo_trip_gs.png', 'class' => 'rollover')) ?>
        </a>
        <br/>
      </span>
    </div>
    <div id="content">
      <span id="change-locale"><?= lang('change_locale') ?></span>
      <div id="calendar">
        <span id="prev-month"><?= img(array('src' => base_url().'assets/img/main/arrow_left.png', 'id' => 'arrow-left')) ?></span>
        <div id="table-wrapper"><?php $this->load->view('booking/table', array('bookings' => $bookings, 'headTimestamp' => time(), 'selectedAppointment' => 0)); ?></div>
        <span id="next-month"><?= img(array('src' => base_url().'assets/img/main/arrow_right.png', 'id' => 'arrow-right')) ?></span>
      </div>
      <div id="legend">
        <div id="icon-unavailable"></div>
        <div><?= lang('legend_1') ?></div>
        <div id="icon-available"></div>
        <div><?= lang('legend_2') ?></div>
        <div id="icon-reserved"></div>
        <div><?= lang('legend_3') ?></div>
      </div>
      <div id="booking-details">
        <?php $numberOfSuccessfulBookings < $bookingLimit ? $this->load->view('booking/form') : $this->load->view('booking/form_fail_limit'); ?>
      </div>
    </div>
  </div>
  <?php $this->load->view('booking/booking_js'); ?>
</body>
</html>