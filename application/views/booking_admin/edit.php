<?php $this->load->view('header'); ?>
<?php $this->load->view('booking_admin/utils'); ?>
<body id="admin-page">
  <h1>
    Foglalás szerkesztése
  </h1>
  <h3 id="flash-msg">
    <?= validation_errors() ?>
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <?php
    echo form_open('admin/booking/edit/'.$booking->id);
    echo '<p>';
    echo form_label('Aktív?', 'status');
    echo form_checkbox(array('name' => 'status', 'id' => 'status', 'value' => 'active', 'checked' => ($booking->status == 'active') ? true : false));
    echo '</p><p>';
    echo form_label('Fizetve?', 'payment_verified');
    echo form_checkbox(array('name' => 'payment_verified', 'id' => 'payment_verified', 'value' => 'yes', 'checked' => ($booking->payment_verified == 'yes') ? true : false));
    echo '</p><p>';
    if (isset($voucher)) {
      echo '<label for="">Kupon: </label>';
      echo $voucher->code.' ('.$voucher->discounted_price.' Ft)';
      echo '</p><p>';
    }
    echo form_label('Foglaló vezetékneve', 'book-fname');
    echo form_input(array('name' => 'book-fname', 'id' => 'book-fname', 'value' => $booking->book_fname));
    echo '</p><p>';
    echo form_label('Foglaló keresztneve', 'book-sname');
    echo form_input(array('name' => 'book-sname', 'id' => 'book-sname', 'value' => $booking->book_sname));
    echo '</p><p>';
    echo form_label('Foglalt időpont', 'appointment');
    echo form_input(array('name' => 'appointment', 'id' => 'appointment', 'value' => date('Y-m-d', $booking->appointment))).' - ';
    echo form_dropdown('appointment-hour', getPlaytimeRangeDropdownValues(), date('G', $booking->appointment) + (date('i', $booking->appointment) == 30 ? 0.5 : 0));
    echo '</p><p>';
    echo form_label('Fizetés átutalással', 'payment-option');
    echo form_radio(array('name' => 'payment-option', 'id' => 'payment-option-1', 'value' => 'card', 'checked' => ($booking->payment_option == 'card' ? true : false)));
    if ($booking->payment_option == 'card') {
        echo ' <strong>Kód: '.$code.'</strong>';
    }
    echo '</p><p>';
    echo form_label('Fizetés készpénzzel', 'payment-option');
    echo form_radio(array('name' => 'payment-option', 'id' => 'payment-option-2', 'value' => 'cache', 'checked' => ($booking->payment_option == 'cache' ? true : false)));
    echo '</p><p>';
    echo form_label('Telefon', 'phone');
    echo form_input(array('name' => 'phone', 'id' => 'phone', 'value' => $booking->phone));
    echo '</p><p>';
    echo form_label('Email cím', 'email');
    echo form_input(array('name' => 'email', 'id' => 'email', 'value' => $booking->email));
    echo '</p><p>';
    echo form_label('Irányítószám', 'zip');
    echo form_input(array('name' => 'zip', 'id' => 'zip', 'value' => ($booking->zip == 0 ? '' : $booking->zip)));
    echo '</p><p>';
    echo form_label('Város', 'city');
    echo form_input(array('name' => 'city', 'id' => 'city', 'value' => $booking->city));
    echo '</p><p>';
    echo form_label('Utca', 'street');
    echo form_input(array('name' => 'street', 'id' => 'street', 'value' => $booking->street));
    echo '</p><p>';
    echo form_label('Házszám', 'house');
    echo form_input(array('name' => 'house', 'id' => 'house', 'value' => ($booking->house == 0 ? '' : $booking->house)));
    echo '</p><p>';
    echo form_label('Számla: vezetéknév', 'bill-fname');
    echo form_input(array('name' => 'bill-fname', 'id' => 'bill-fname', 'value' => $booking->bill_fname));
    echo '</p><p>';
    echo form_label('Számla: keresztnév', 'bill-sname');
    echo form_input(array('name' => 'bill-sname', 'id' => 'bill-sname', 'value' => $booking->bill_sname));
    echo '</p><p>';
    echo form_label('Adószám', 'tax-number');
    echo form_input(array('name' => 'tax-number', 'id' => 'tax-number', 'value' => ($booking->tax_number == 0 ? '' : $booking->tax_number)));
    echo '</p><p>';
    echo form_label('Megjegyzések', 'comment');
    echo form_textarea(array('name' => 'comment', 'id' => 'comment', 'value' => $booking->comment, 'rows' => 6, 'cols' => 54));
    echo '</p><p>';
    echo form_label('Jegyzetek', 'notes');
    echo form_textarea(array('name' => 'notes', 'id' => 'notes', 'value' => $booking->notes, 'rows' => 6, 'cols' => 54));
    echo '</p><p>';
    echo form_label('Foglalás időpontja', 'booking-date');
    echo form_input(array('name' => 'booking-date', 'id' => 'booking-date', 'value' => date("Y-m-d H:i", $booking->booking_date)));
    echo '</p><p>';
    echo '<br/>';
    echo '<div id="buttons">'.form_submit('save', 'Mentés').form_submit('delete', 'Törlés').'</div>';
    echo '</p>';
    echo form_close();
  ?>
  <p>
    <a href="<?= base_url() ?>index.php/admin/booking/edit">Vissza</a>
  </p>
  <script type="text/javascript">
    $('#appointment').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
    $('#booking-date').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd <?= date('H:i') ?>' });
  </script>
</body>
</html>