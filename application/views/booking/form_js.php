<script type="text/javascript">

	if (!$('#billing').is(':checked')) {
		$('#tax-number').hide();
		$('#bill-fname').hide();
		$('#bill-sname').hide();
		$('label[for="tax-number"]').hide();
		$('label[for="bill-fname"]').hide();
		$('label[for="bill-sname"]').hide();
	}
	
	$('#billing').click(function() {
		if ($('#billing').is(':checked')) {
			$('#tax-number').fadeIn();
			$('#bill-fname').fadeIn();
			$('#bill-sname').fadeIn();
			$('label[for="tax-number"]').fadeIn();
			$('label[for="bill-fname"]').fadeIn();
			$('label[for="bill-sname"]').fadeIn();
		} else {
			$('#tax-number').fadeOut();
			$('#bill-fname').fadeOut();
			$('#bill-sname').fadeOut();
			$('label[for="tax-number"]').fadeOut();
			$('label[for="bill-fname"]').fadeOut();
			$('label[for="bill-sname"]').fadeOut();
		}
	});
	
	$('#booking-form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: '<?= base_url() ?>index.php/booking/addBooking',
			type: 'POST',
			data: $('#booking-form').serialize(),
			success: function(result){
				refreshTable(parseInt($('#head-timestamp').text()));
				$('#booking-details').html(result);
			},
		statusCode: {
			404: function() {
				$('#booking-details').html('<form id="error-form"><h3>Kapcsolódási hiba!</h3></form>');
			},
			500: function() {
				refreshTable(parseInt($('#head-timestamp').text()));
				$('#booking-details').html('<form id="error-form"><h3>Lekésted!</h3><br/><p>Mialatt nézelődtél befoglalták az általad kiválasztott időpontot! Válassz egy újat.</p></form>');
			}
		}
		
		});
	});

</script>