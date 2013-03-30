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
		$('#reserve_details').css('opacity', '0');
		
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

	$('td.timebox').click(function(){
		$('#reserve_details').visible();
		$("#reserve_date").val($(this).attr('alt'));
	});
	
	
	$('#prev_month').click(function(){
		$.ajax({
			url: "<?= base_url() ?>index.php",
			context: document.body
		}).done(function() {
			$(this).addClass("done");
		});
		
	});

	$(document).ready(function(){
		// disable right click
		$(document).bind("contextmenu",function(e){
			return false;
		});
		
		
		
	});

</script>