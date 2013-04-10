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
	
	$('#booking_form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/add_appointment',
			type: 'POST',
			data: $('#booking_form').serialize()
		}).done(function(result){
			refreshTable(parseInt($('#reference_time').attr('alt')));
			
			/*
			$('#booking_details').invisible();
			// clear form fields
			$('#appointment').val('');
			$('#book_fname').val('');
			$('#book_sname').val('');
			$('#payment_option_1').val('');
			$('#payment_option_2').val('');
			*/
			
			$('#booking_details').html(result);
		});
	});
	
</script>