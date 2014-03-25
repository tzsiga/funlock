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
    '<?= base_url() ?>assets/img/main/logo_small.png',
    '<?= base_url() ?>assets/img/main/reserved.png',
    '<?= base_url() ?>assets/img/main/selected.png',
    '<?= base_url() ?>assets/img/main/arrow_left.png',
    '<?= base_url() ?>assets/img/main/arrow_right.png',
    '<?= base_url() ?>assets/img/main/map.png'
  ]).preload();

  <?php // disable right click ?>
  $(document).bind("contextmenu", function(e){
    return false;
  });

  <?php // fake links ?>
  $('#link-info').css('cursor', 'pointer');
  $('#link-story').css('cursor', 'pointer');
  $('#link-contact').css('cursor', 'pointer');
  $('#link-about').css('cursor', 'pointer');
  $('td.timebox').css('cursor', 'pointer');
  $('#arrow-left').css('cursor', 'pointer');
  $('#arrow-right').css('cursor', 'pointer');


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

  <?php // opacity toggle ?>
  jQuery.fn.visible = function(done) {
    return this.animate({opacity: 1}, 200, done);
  }
  
  jQuery.fn.invisible = function(done) {
    return this.animate({opacity: 0}, 200, done);
  }
  
  jQuery.fn.visibilityToggle = function() {
    return (this.css('opacity') == 0) ? this.animate({opacity: 1}, 400) : this.animate({opacity: 0}, 400);
  }

  <?php // left menu items ?>
  var menuItemInfo = '<span id="menuItemInfo">' + '<?= lang("menuitem_1_text") ?>' + '</span>';
  var menuItemStory = '<span id="menuItemStory">' + '<?= lang("menuitem_2_text") ?>' + '</span>';
  var menuItemContact = '<span id="menuItemContact">' + '<?= lang("menuitem_3_text") ?>' + '</span>';
  var menuItemAbout =
    '<ul id="menuItemAbout">' +
      '<li>' +
        '<a href="http://welovebudapest.com/hu/nevezetessegek-turak/cikkek/2013/09/03/high-tech-szabadulos-jatek-a-kiraly-utcaban-funlock">' +
          '<img class="rolloverAbout" src="<?= base_url() ?>assets/img/logo/logo_welovebp_gs.png" alt="" title=""/>' +
        '</a><a href="http://player.hu/kult/funlock-kiraly-utca-teszt">' +
          '<img class="rolloverAbout" src="<?= base_url() ?>assets/img/logo/logo_player_gs.png" alt="" title=""/>' +
        '</a>' +
      '</li><li>' +
        '<a href="http://www.faninfo.hu/szabadido/adatlap/funlock-szabadulo-szoba-budapest">' +
          '<img class="rolloverAbout" src="<?= base_url() ?>assets/img/logo/logo_faninfo_gs.png" alt="" title=""/>' +
        '</a><a href="http://www.kijutos-jatekok.hu/kijutos-jatekok/2013/11/elo-kijutos-funlock/">' +
          '<img class="rolloverAbout" src="<?= base_url() ?>assets/img/logo/logo_kijutos_gs.png" alt="" title=""/>' +
        '</a>' +
      '</li>' +
    '</ul>';

  setMenuCallback('#link-info', '#menuItemInfo', menuItemInfo);
  setMenuCallback('#link-story', '#menuItemStory', menuItemStory);
  setMenuCallback('#link-contact', '#menuItemContact', menuItemContact);
  setMenuCallback('#link-about', '#menuItemAbout', menuItemAbout);

  <?php // menu item faders ?>
  function setMenuCallback(link, holder, content) {
    $(link).click(function(){
      $('#sidebar-logo').invisible(
        function(){
          $('#item-display-area').fadeOut(function(){
            if ($(holder).length > 0){
              $('#item-display-area').html('');
              $('#sidebar-logo').visible();
            } else {
              $(this).html(content).fadeIn();
              setRollovers('.rolloverAbout');
              $('#sidebar-logo').visible();
            }
          });
        }
      );
    });
  }

  <?php // rollover fade ?>
  function setRollovers(cls) {
    $(cls).each(function(){
      generateRolloverImg($(this));

      $(this).mouseenter(function(){
        $(this).stop().fadeTo(600, 0);
      }).mouseleave(function(){
        $(this).stop().fadeTo(600, 1);
      });
    });
  }

  function generateRolloverImg(originalImg) {
    var std = $(originalImg).attr("src");
    var hover = std.replace("_gs.png", ".png");

    $(originalImg).clone().insertAfter(originalImg).attr('src', hover).removeClass('rollover').siblings().css({
      position: 'absolute'
    });
  }

  setRollovers('.rollover');

  <?php // booking table wrapper ?>
  var timer = $.timer(function() {
    refreshTable();
  });
  
  timer.set({ time : 15000, autostart : true });
  
  function refreshTable(headTimestamp) {
    if (typeof headTimestamp === 'undefined')
      headTimestamp = parseInt($('#head-timestamp').text());
    
    $.ajax({
      url: '<?= base_url() ?>index.php/main/loadBookingTable?headTimestamp=' + headTimestamp + '&selectedAppointment=' + $("input[name=appointment]").val(),
      type: 'POST'
    }).success(function(result) {
      $('#table-wrapper').html(result);
      $('td.timebox').css('cursor', 'pointer');
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