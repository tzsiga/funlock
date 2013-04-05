<script type="text/javascript">

	var panel_height = 570;
	var panel_width = 912;
	
	/*
	$(document).ready(watcher);
	$(window).resize(watcher);

	function watcher(){
		if ($(document).width() <= 480){
			panel_height = 210;
			panel_width = 336;
		} else if ($(document).width() <= 600){
			panel_height = 300;
			panel_width = 480;
		} else if ($(document).width() <= 900){
			panel_height = 345;
			panel_width = 552;
		} else if ($(document).width() <= 1900){
			panel_height = 570;
			panel_width = 912;
		}
	}
	*/
	
	var slider_height = 100;
	
	var offset_x = 0;
	var margin_offset_x = ($("body").width() - panel_width) / 2;
	
	jQuery(document).ready(function(){
		$(document).mousemove(function(e){
			//$('#p_w').html(panel_width);
			
			// a csúszkák mozgásának függvénye az egérhöz képest
			$("#S1").css('top', ((panel_height - slider_height      ) / panel_width) * (e.pageX - margin_offset_x + offset_x));
			$("#S2").css('top', ((panel_height - slider_height + 100) / panel_width) * (e.pageX - margin_offset_x + offset_x));
			$("#S3").css('top', ((panel_height - slider_height - 700) / panel_width) * (e.pageX - margin_offset_x + offset_x));
			$("#S4").css('top', ((panel_height - slider_height - 200) / panel_width) * (e.pageX - margin_offset_x + offset_x));
			$("#S5").css('top', ((panel_height - slider_height + 50 ) / panel_width) * (e.pageX - margin_offset_x + offset_x));
			$("#S6").css('top', ((panel_height - slider_height - 350) / panel_width) * (e.pageX - margin_offset_x + offset_x));
			$("#S7").css('top', ((panel_height - slider_height + 150) / panel_width) * (e.pageX - margin_offset_x + offset_x));
			$("#S8").css('top', ((panel_height - slider_height - 100) / panel_width) * (e.pageX - margin_offset_x + offset_x));
			
		});
	});
	
	// disable right click
	$(document).ready(function(){
		$(document).bind("contextmenu",function(e){
			return false;
		});
	});
	
</script>