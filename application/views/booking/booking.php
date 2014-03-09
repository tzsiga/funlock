<?php $this->load->view('header'); ?>
<body id="main-page">
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
      <span id="tripadvisor">
        <br/>
        <div id="TA_linkingWidgetWAR498" class="TA_linkingWidgetWAR">
          <ul id="C4HVPnyPQ0NL" class="TA_links E3mvASbc0f8e">
            <li id="gerY5vGD" class="IBBAWzVU">
              <a target="_blank" href="http://www.tripadvisor.com/"><img src="http://www.tripadvisor.com/img/cdsi/partner/tripadvisor_logo_115x18-15078-2.gif" alt="TripAdvisor"/></a>
            </li>
          </ul>
        </div>
        <script src="http://www.jscache.com/wejs?wtype=linkingWidgetWAR&amp;uniq=498&amp;locationId=4795570&amp;lang=en_US&amp;border=false"></script>
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