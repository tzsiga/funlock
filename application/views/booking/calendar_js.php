<script type="text/javascript">

	$('#blank_cell').datepicker({
		firstDay: 1,
		dateFormat: 'yy-mm-dd',
		minDate: 0
	});
	
	$('#blank_cell').change(function(){
		refreshTable(strtotime($('#blank_cell').val()));
	});

	$('td.timebox').click(function(){
		$('td.timebox').css('background-color', '');
		$(this).css('background-color', 'grey');
		$("input[name=appointment]").val($(this).attr('alt'));
		$('#booking_details').visible();
	});

</script>