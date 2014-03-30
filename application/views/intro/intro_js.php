<script type="text/javascript">
  <?php // default setup ?>
  $(document).ready(function(){
    $('#loading').fadeOut();
  });

  <?php // preload images ?>
  $.fn.preload = function() {
    this.each(function(){
      $('<img/>')[0].src = this;
    });
  }

  $([
  <?php
    $map = directory_map('./assets/img/intro/');
    
    foreach ($map as $img) {
      echo "'".base_url()."assets/img/intro/".$img."',";
    }
  ?>
    '<?= base_url() ?>assets/img/main/logo_small.png',
    '<?= base_url() ?>assets/img/main/reserved.png',
    '<?= base_url() ?>assets/img/main/selected.png',
    '<?= base_url() ?>assets/img/main/arrow_left.png',
    '<?= base_url() ?>assets/img/main/arrow_right.png',
    '<?= base_url() ?>assets/img/main/map.png',

    '<?= base_url() ?>assets/img/logo/logo_f.png',
    '<?= base_url() ?>assets/img/logo/logo_f_gs.png',
    '<?= base_url() ?>assets/img/logo/logo_trip.png',
    '<?= base_url() ?>assets/img/logo/logo_trip_gs.png',
    '<?= base_url() ?>assets/img/logo/logo_welovebp.png',
    '<?= base_url() ?>assets/img/logo/logo_welovebp_gs.png',
    '<?= base_url() ?>assets/img/logo/logo_kijutos.png',
    '<?= base_url() ?>assets/img/logo/logo_kijutos_gs.png',
    '<?= base_url() ?>assets/img/logo/logo_player.png',
    '<?= base_url() ?>assets/img/logo/logo_player_gs.png',
    '<?= base_url() ?>assets/img/logo/logo_faninfo.png',
    '<?= base_url() ?>assets/img/logo/logo_faninfo_gs.png'

  ]).preload();
  
  function setupOffsetX() {
    marginOffsetX = (($(window).width() - $('#action-zone').width()) / 2) + 120;
    
    if ($(window).width() % 2 == 1) {
      $('#action-zone').css("padding-left", "14px");
    } else {
      $('#action-zone').css("padding-left", "15px");
    }
  }
  
  var panelHeight = 370;
  var panelWidth = 800;
  var sliderHeight = 177;
  var offsetX = 0;
  setupOffsetX();
  
  $(window).resize(function(){
    setupOffsetX();
  });
  
  jQuery(document).ready(function(){
    <?php // check browser width, redirect if too small ?>
    if ($(window).width() < 1280) {
      window.location.replace("<?= site_url('main') ?>");
    }

    $(document).mousemove(function(e){
      <?php generateSliderCallbacks($letterParts); ?>
    });
  });
  
  <?php // big brother ?>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-41388740-1']);
  _gaq.push(['_setDomainName', 'funlock.hu']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  
  <?php // disable right click ?>
  $(document).ready(function(){
    $(document).bind("contextmenu",function(e){
      return false;
    });
  });
</script>
