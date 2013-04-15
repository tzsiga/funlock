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
	
	$('#link_info').click(function(){
		$('#item_display_area').fadeOut(function(){
			$(this).html('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
		}).fadeIn();
	});
	
	$('#link_map').click(function(){
		$('#item_display_area').fadeOut(function(){
			$(this).html('<img id="map" src="<?= base_url() ?>assets/img/main/map.png" alt="" title="" />');
		}).fadeIn();
	});
	
	$('#link_contact').click(function(){
		$('#item_display_area').fadeOut(function(){
			$(this).html('Budapest 1023<br/>Galgóczy utca 16.<br/>T.: 0036/307726213<br/>info@funlock.hu');
		}).fadeIn();
	});
	
	// booking calendar wrapper
	
	function refreshTable(ref_time) {
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/generate_table?ref_time=' + ref_time + '&selected_appointment=' + strtotime($("input[name=appointment]").val()),
			type: 'POST'
		}).success(function(result) {
			$('#calendar_table').html(result);
			$('td.timebox').css('cursor', 'pointer');
		});
	}
	
	$('#arrow_left').click(function(){
		if ($('#reference_time').attr('alt') > <?= time() ?>) {
			refreshTable(parseInt($('#reference_time').attr('alt')) - parseInt(<?= Utils::week ?>));
		}
	});
	
	$('#arrow_right').click(function(){
		refreshTable(parseInt($('#reference_time').attr('alt')) + parseInt(<?= Utils::week ?>));
	});
	
</script>