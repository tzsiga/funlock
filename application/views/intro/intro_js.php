<script type="text/javascript">
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
