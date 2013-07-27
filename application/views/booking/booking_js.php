<script type="text/javascript">

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
  
  <?php // default setup ?>
  $(document).ready(function(){
    <?php // disable right click ?>
    $(document).bind("contextmenu", function(e){
      return false;
    });
    
    <?php // hidden elements by default ?>
    $('#booking-details').css('visibility', 'hidden');
    $('#booking-details').css('opacity', '0');
    
    <?php // fake links ?>
    $('#link-info').css('cursor', 'pointer');
    $('#link-story').css('cursor', 'pointer');
    $('#link-contact').css('cursor', 'pointer');
    $('td.timebox').css('cursor', 'pointer');
    $('#arrow-left').css('cursor', 'pointer');
    $('#arrow-right').css('cursor', 'pointer');
  });
  
  <?php // left menu items ?>
  var menuItemInfo = 'A Funlock egy szórakoztató csapatjáték, mely Téged és Barátaidat egy órára „rabul” ejt és csak magatokra illetve egymásra számíthattok az elgondolkodtató feladatok megoldásában. Közös csapatmunkával képesek lehettek legyőzni a számítógépet, mely átvette a szoba felett az irányítást és az egy óra leteltével örökre bezár Titeket.<br/><br/>A játék <strong>2-5 fős csapatokban</strong> játszható. Céges csapatépítő programnak is ajánljuk.<br/><br/>A játék ára <strong>12.000 Ft csapatonként</strong>, a csapat létszámától függetlenül.<br/><br/>Amennyiben nagyobb létszámú társasággal jönnétek, egyedi foglalási megoldásokért keressetek minket elérhetőségeinken.<br/><br/>Szeretettel várunk Titeket:<br/><em>A Funlock csapata</em>';
  var menuItemStory = '<p>Képzelj el egy gépet, egy szuperszámítógépet, ami egy nagyon jó célért dologozik már sok-sok éve. A program, ha végéhez ér, megválaszolja a régóta kutatott kérdést: létezhet-e ingyen energia? A számítógép azonban egy technikai probléma miatt megakadt. A gépet létrehozó professzor Téged és csapatodat kér fel arra, hogy újraindítsátok, és így az beteljesít-hesse küldetését.</p><br/><p>Nos, elvállaljátok a küldetést?</p>';
  var menuItemContact = '1068 Budapest<br/>Király utca 54.<br/>(bejárat a Hegedű utcából)<br/><br/>+3670 382 1388<br/><p id="info">&nbsp;</p><br/><a href="http://goo.gl/maps/AriVW" target="_blank"><img id="map" src="<?= base_url() ?>assets/img/main/map.png" alt="" title=""/></a>';
  
  function replaceAll(txt, replace, withThis) {
    return txt.replace(new RegExp(replace, 'g'), withThis);
  }
  
  $('#link-info').click(function(){
    $('#item-display-area').fadeOut(function(){
      if ($(this).html() == replaceAll(menuItemInfo, '/>','>')){
        $(this).html('');
      } else {
        $(this).html(menuItemInfo).fadeIn();
      }
    });
  });

  $('#link-story').click(function(){
    $('#item-display-area').fadeOut(function(){
      if ($(this).html() == replaceAll(menuItemStory, '/>','>')){
        $(this).html('');
      } else {
        $(this).html(menuItemStory).fadeIn();
      }
    });
  });
  
  $('#link-contact').click(function(){
    $('#item-display-area').fadeOut(function(){
      if ($(this).html() == replaceAll(menuItemContact, '/>','>')){
        $(this).html('');
      } else {
        $(this).html(menuItemContact).fadeIn();
      }
    });
  });
    
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
    });
  }
  
  $('#arrow-left').click(function(){
    if ($('#head-timestamp').text() > <?= time() ?>) {
      $('#table-wrapper').invisible().promise().done(function(){
        refreshTable(parseInt($('#head-timestamp').text()) - parseInt(<?= Utils::weekInSec ?>));
        $(this).delay(450).visible();
      });
    }
  });
  
  $('#arrow-right').click(function(){
    $('#table-wrapper').invisible().promise().done(function(){
      refreshTable(parseInt($('#head-timestamp').text()) + parseInt(<?= Utils::weekInSec ?>));
      $(this).delay(450).visible();
    });
  });

</script>