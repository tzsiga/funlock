<script type="text/javascript">

	function getMonday(d) {
		d = new Date(d);
		var day = d.getDay();
		var diff = d.getDate() - day + (day == 0 ? -6:1);
		return new Date(d.setDate(diff));
	}

	$('#blank-cell').css('cursor', 'pointer');
	$('#blank-cell').datepicker({
		firstDay: 1,
		dateFormat: 'yy-mm-dd',
		minDate: 0
	});

	$('#blank-cell').change(function(){
		var monday = getMonday(new Date($('#blank-cell').val()));
		$('#table-wrapper').invisible().promise().done(function(){
			refreshTable(strtotime(monday.toString()));
			$(this).delay(450).visible();
		});
	});

	$('td.timebox').click(function(){
		$('td.timebox').css('-moz-box-shadow', 'none');
		$('td.timebox').css('-webkit-box-shadow', 'none');
		$('td.timebox').css('box-shadow', 'none');
		$('td.timebox').css('z-index', '0');
		$('td.timebox').css('background-image', 'none');
		
		$(this).css('-moz-box-shadow', '8px 8px 15px #888888');
		$(this).css('-webkit-box-shadow', '8px 8px 15px #888888');
		$(this).css('box-shadow', '8px 8px 15px #888888');
		$(this).css('position', 'relative');
		$(this).css('z-index', '3');
		$(this).css('background-image', "url('<?= base_url() ?>/assets/img/main/selected.png')");
		
		$('#booking-details').visible();
		
		if ($('#booking-details > form').attr('id') == 'error-form') {
			$.ajax({
				url: '<?= base_url() ?>index.php/booking/loadBookingForm',
				type: 'POST'
			}).success(function(result) {
				$('#booking-details').html(result);
			});
		}
		
		$("input[name=appointment]").val($(this).text());
	});

</script>