<script type="text/javascript">

  $('#link-eula').fancybox({
    maxWidth  : 700,
    maxHeight : 500,
//    fitToView : false,
//    autoSize  : false,
    closeClick  : false,
    openEffect  : 'elastic',
    closeEffect : 'elastic'
  });

  if (!$('#voucher').is(':checked')) {
    $('#code').hide();
  }

  $('#voucher').click(function() {
    if ($('#voucher').is(':checked')) {
      $('#code').fadeIn();
    } else {
      $('#code').fadeOut();
      $('#code').val('');
    }
  });

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
      url: '<?= site_url("main") ?>/addBooking',
      type: 'POST',
      data: $('#booking-form').serialize(),
      success: function(result){
        refreshTable(parseInt($('#head-timestamp').text()));
        $('#booking-details').html(result);
      },
    statusCode: {
      404: function() {
        $('#booking-details').html('<?= lang("booking_404") ?>');
      },
      500: function() {
        refreshTable(parseInt($('#head-timestamp').text()));
        $('#booking-details').html('<?= lang("booking_500") ?>');
      }
    }
    });
  });

</script>