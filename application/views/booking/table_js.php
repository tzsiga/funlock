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

  function clearAllCellsStyles(cell){
    $(cell).removeAttr('id');
  }

  function setCellStyleSelected(cell){
    $(cell).attr('id', 'timebox-selected');
  }

  $('td.timebox').click(function(){
    clearAllCellsStyles('td.timebox');
    setCellStyleSelected(this);
    
    $('#booking-details').css('visibility', 'visible');
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