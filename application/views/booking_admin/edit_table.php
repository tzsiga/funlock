<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <h1>
    Foglalások szerkesztése
  </h1>
  <br/>

  <?php if (!empty($this->session->flashdata('msg'))) { ?>
    <div id="flash-msg" class="alert alert-danger">
      <?= $this->session->flashdata('msg') ?>
    </div>
  <?php } ?>

  <div id="admin-menu">
    <div id="admin-calendar" class="center-block">
      <span id="prev-month"><?= img(array('src' => base_url().'assets/img/main/arrow_left.png', 'id' => 'arrow-left')) ?></span>
      <div id="table-wrapper"><?php $this->load->view('booking_admin/table', array('bookings' => $bookings, 'headTimestamp' => time())); ?></div>
      <span id="next-month"><?= img(array('src' => base_url().'assets/img/main/arrow_right.png', 'id' => 'arrow-right')) ?></span>
    </div>
  </div>

</div>
<script type="text/javascript">

  <?php // preload images ?>
  $.fn.preload = function() {
    this.each(function(){
      $('<img/>')[0].src = this;
    });
  }

  $([
    '<?= base_url() ?>assets/img/main/reserved.png',
    '<?= base_url() ?>assets/img/main/selected.png',
    '<?= base_url() ?>assets/img/main/arrow_left.png',
    '<?= base_url() ?>assets/img/main/arrow_right.png'
  ]).preload();

  $('#arrow-left').css('cursor', 'pointer');
  $('#arrow-right').css('cursor', 'pointer');

  <?php // opacity toggle ?>
  jQuery.fn.visible = function() {
    return this.animate({opacity: 1}, 400);
  }

  jQuery.fn.invisible = function() {
    return this.animate({opacity: 0}, 400);
  }

  jQuery.fn.visibilityToggle = function() {
    return (this.css('opacity') == 0) ? this.animate({opacity: 1}, 400) : this.animate({opacity: 0}, 400);
  }

  <?php // disable right click ?>
  $(document).ready(function(){
    $(document).bind("contextmenu", function(e){
      return false;
    });
  });

  <?php // booking table wrapper ?>
  var timer = $.timer(function() {
    refreshTable();
  });

  timer.set({ time : 15000, autostart : true });

  function refreshTable(headTimestamp) {
    if (typeof headTimestamp === 'undefined') headTimestamp = parseInt($('#head-timestamp').text());

    $.ajax({
      url: '<?= base_url() ?>index.php/admin/booking/loadAdminTable?headTimestamp=' + headTimestamp,
      type: 'POST'
    }).success(function(result) {
      $('#table-wrapper').html(result);
      $('#table-wrapper').visible();
      $('#prev-month').visible();
      $('#next-month').visible();
    });
  }

  $('#arrow-left').click(function(){
    if ($('#head-timestamp').text() > <?= time() ?>) {
      $('#prev-month').invisible();
      $('#next-month').invisible();
      $('#table-wrapper').invisible().promise().done(function(){
        refreshTable(parseInt($('#head-timestamp').text()) - parseInt(<?= Utils::weekInSec ?>));
      });
    }
  });

  $('#arrow-right').click(function(){
    $('#prev-month').invisible();
    $('#next-month').invisible();
    $('#table-wrapper').invisible().promise().done(function(){
      refreshTable(parseInt($('#head-timestamp').text()) + parseInt(<?= Utils::weekInSec ?>));
    });
  });

</script>
</body>
</html>