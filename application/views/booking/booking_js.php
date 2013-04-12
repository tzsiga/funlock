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
		$('#prev_month').css('cursor', 'pointer');
		$('#next_month').css('cursor', 'pointer');
	});
	
	// ui logic
	
	$('#link_info').click(function(){
		$('#item_display_area').fadeOut(function(){
			$(this).html('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
		}).fadeIn();
	});
	
	$('#link_map').click(function(){
		$('#item_display_area').fadeOut(function(){
			$(this).html('<img id="map" src="<?= base_url() ?>assets/img/map.png" alt="" title="" />');
		}).fadeIn();
	});
	
	$('#link_contact').click(function(){
		$('#item_display_area').fadeOut(function(){
			$(this).html('Budapest 1023<br/>Galgóczy utca 16.<br/>T.: 0036/307726213<br/>info@funlock.hu');
		}).fadeIn();
	});
	
	$('td.timebox').click(function(){
		$('td.timebox').css('background-color', '');
		$(this).css('background-color', 'grey');
		$("#appointment").val($(this).attr('alt'));
		$('#booking_details').visible();
	});
	
	function setupTable(data) {
		$('#calendar_table').html(data);
		$('td.timebox').css('cursor', 'pointer');
		$('td.timebox').click(function(){
			$('#booking_details').visible();
			$("#appointment").val($(this).attr('alt'));
		});
	}
	
	function refreshTable(ref_time) {
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/generate_table/' + ref_time,
			type: 'POST'
		}).done(function(result) {
			setupTable(result);
		});
	}
	
	$('#prev_month').click(function(){
		if ($('#reference_time').attr('alt') > <?= time() ?>) {
			refreshTable(parseInt($('#reference_time').attr('alt')) - parseInt(<?= Utils::week ?>));
		}
	});
	
	$('#next_month').click(function(){
		refreshTable(parseInt($('#reference_time').attr('alt')) + parseInt(<?= Utils::week ?>));
	});
	
	$('#blank_cell').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
	
	$('#blank_cell').change(function(){
		// ide ez kellene: strtotime( $('#blank_cell').val() )
	
		refreshTable( $('#blank_cell').val() );
	});
	
</script>