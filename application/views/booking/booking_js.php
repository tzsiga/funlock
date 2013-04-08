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
			$(this).html('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
		}).fadeIn();
	});
	
	$('#link_map').click(function(){
		$('#item_display_area').fadeOut(function(){
			$(this).html('<img id="map" src="<?= base_url() ?>assets/img/map.png" alt="" title="" />');
		}).fadeIn();
	});
	
	$('#link_contact').click(function(){
		$('#item_display_area').fadeOut(function(){
			$(this).html('Budapest 1023, Galgóczy u. 16. T.: 0036/307726213, info@funlock.hu');
		}).fadeIn();
	});
	
	$('td.timebox').click(function(){
		$("#booking_date").val($(this).attr('alt'));
		$('#booking_details').visible();
	});
	
	$('#prev_month').click(function(){
		if ($('#reference_time').attr('alt') > <?= time() ?>) {	
			$.ajax({
				url: '<?= base_url() ?>index.php/booking/generate_table/' + (parseInt($('#reference_time').attr('alt')) - parseInt(<?= Utils::week ?>)),
			}).done(function(result) {
				setupTable(result);
			});
		}
	});
	
	$('#next_month').click(function(){
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/generate_table/' + (parseInt($('#reference_time').attr('alt')) + parseInt(<?= Utils::week ?>)),
		}).done(function(result) {
			setupTable(result);
		});
	});
	
	function setupTable(data) {
		$('#calendar_table').html(data);
		$('td.timebox').css('cursor', 'pointer');
		$('td.timebox').click(function(){
			$('#booking_details').visible();
			$("#booking_date").val($(this).attr('alt'));
		});
	}

</script>