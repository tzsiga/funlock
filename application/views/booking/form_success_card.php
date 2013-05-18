<?php
	echo form_open('', array('id' => 'booking_form_success'));
	echo '<p>A foglalás sikeres volt! Emailt küldtünk a további teendőkről.</p>';
	echo '<br/>';
	echo '<p>Kérünk ne felejtsétek el a foglalásotokat megelőző két nappal a 8000 forint foglalási összeget elutalni a  10918001-00000026-88000000 bankszámlaszámunkra, különben a foglalásotok törlésre kerül, köszönjük!</p>';
	echo '<br/>';
	echo '<p>A „közlemény” rovatban  tűntessétek fel a következőt: <strong>'.$code.'</strong></p>';
	echo form_close();
?>
