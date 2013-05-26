<script type="text/javascript">

	// opacity toggle
	
	jQuery.fn.visible = function() {
		return this.animate({opacity: 1}, 400);
	}

	jQuery.fn.invisible = function() {
		return this.animate({opacity: 0}, 400);
	}

	jQuery.fn.visibilityToggle = function() {
		return (this.css('opacity') == 0) ? this.animate({opacity: 1}, 400) : this.animate({opacity: 0}, 400);
	}

	// default setup
	
	$(document).ready(function(){
		// disable right click
		$(document).bind("contextmenu", function(e){
			return false;
		});
	
		// hidden elements by default
		$('#booking_details').css('opacity', '0');
		
		// fake links
		$('#link_info').css('cursor', 'pointer');
		$('#link_map').css('cursor', 'pointer');
		$('#link_contact').css('cursor', 'pointer');
		$('td.timebox').css('cursor', 'pointer');
		$('#arrow_left').css('cursor', 'pointer');
		$('#arrow_right').css('cursor', 'pointer');
	});
	
	// left menu items
		
	var item_info = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
	var item_contact = '1068 Budapest<br/>Király utca 54.<br/>T.: +3670 382 1388<br/><p id="info">&nbsp;</p><br/>';
	var item_map = '<img id="map" src="<?= base_url() ?>assets/img/main/map.png" alt="" title="" style="margin-left: -15px; border: 1px solid black; -moz-box-shadow: 8px 8px 15px #CCCCCC; -webkit-box-shadow: 8px 8px 15px #CCCCCC; box-shadow: 8px 8px 15px #CCCCCC;"/>';
	
	function replaceAll(txt, replace, with_this) {
		return txt.replace(new RegExp(replace, 'g'), with_this);
	}

	$('#link_info').click(function(){
		$('#item_display_area').fadeOut(function(){
			if ($(this).html() == item_info){
				$(this).html('');
			} else {
				$(this).html(item_info).fadeIn();
			}
		});
	});

	$('#link_contact').click(function(){
		$('#item_display_area').fadeOut(function(){
			if ($(this).html() == replaceAll(item_contact, '/>','>') + item_map.replace('/>','>')){
				$(this).html('');
			} else {
				$(this).html(item_contact + item_map).fadeIn();
			}
		});
	});
		
	// booking calendar wrapper
	
	var timer = $.timer(function() {
		refreshTable();
  });
	
	timer.set({ time : 15000, autostart : true });
	
	function refreshTable(ref_time) {
		if (typeof ref_time === 'undefined') ref_time = parseInt($('#reference_time').attr('alt'));
	
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/generate_table?ref_time=' + ref_time + '&selected_appointment=' + strtotime($("input[name=appointment]").val()),
			type: 'POST'
		}).success(function(result) {
			$('#table_wrapper').html(result);
			$('td.timebox').css('cursor', 'pointer');
		});
	}
	
	$('#arrow_left').click(function(){
		if ($('#reference_time').attr('alt') > <?= time() ?>) {
			$('#table_wrapper').invisible().promise().done(function(){
				refreshTable(parseInt($('#reference_time').attr('alt')) - parseInt(<?= Utils::week ?>));
				$('#table_wrapper').visible();
			});
		}
	});
	
	$('#arrow_right').click(function(){
		$('#table_wrapper').invisible().promise().done(function(){
			refreshTable(parseInt($('#reference_time').attr('alt')) + parseInt(<?= Utils::week ?>));
			$('#table_wrapper').visible();
		});
	});
	
</script>