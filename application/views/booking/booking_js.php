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

	// animating menu items

	$(document).ready(function(){
		// hidden elements by default
		$('#info').css('opacity', '0');
		$('#map').css('opacity', '0');
		$('#contact').css('opacity', '0');
		$('#booking_details').css('opacity', '0');
		
		// fake links
		$('#link_info').css('cursor', 'pointer');
		$('#link_map').css('cursor', 'pointer');
		$('#link_contact').css('cursor', 'pointer');
		$('td.timebox').css('cursor', 'pointer');
		$('#prev_month').css('cursor', 'pointer');
		$('#next_month').css('cursor', 'pointer');
	});

	$('#link_info').click(function(){
		$('#info').visibilityToggle();
	});

	$('#link_map').click(function(){
		$('#map').visibilityToggle();
	});

	$('#link_contact').click(function(){
		$('#contact').visibilityToggle();
	});

	// ui logic
	
	$('td.timebox').click(function(){
		$('#booking_details').visible();
		$("#booking_date").val($(this).attr('alt'));
	});
	
	var day = 24 * 60 * 60;
	var week = 7 * day;
	
	$('#prev_month').click(function(){
		if ($('#reference_time').attr('alt') > <?= time() ?>) {	
			$.ajax({
				url: '<?= base_url() ?>index.php/pages/generate_table/' + (parseInt($('#reference_time').attr('alt')) - parseInt(week)),
			}).done(function(result) {
				$('#calendar_table').html(result);
				$('td.timebox').css('cursor', 'pointer');
				$('td.timebox').click(function(){
					$('#booking_details').visible();
					$("#booking_date").val($(this).attr('alt'));
				});
			});
		}
	});
	
	$('#next_month').click(function(){
		$.ajax({
			url: '<?= base_url() ?>index.php/pages/generate_table/' + (parseInt($('#reference_time').attr('alt')) + parseInt(week)),
		}).done(function(result) {
			$('#calendar_table').html(result);
			$('td.timebox').css('cursor', 'pointer');
			$('td.timebox').click(function(){
				$('#booking_details').visible();
				$("#booking_date").val($(this).attr('alt'));
			});
		});
	});

	// disable right click
	
	$(document).ready(function(){
		$(document).bind("contextmenu",function(e){
			return false;
		});
	});

</script>