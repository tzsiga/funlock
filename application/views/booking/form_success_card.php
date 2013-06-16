<?php
	echo form_open('', array('id' => 'booking_form_success'));
	echo '<p>A foglalásotok sikeres volt! Emailt küldtünk a további teendőkről.</p>';
	echo '<br/>';
	echo '<p>Kérünk Titeket, hogy a foglalt időpont előtt legkésőbb <strong>két nappal</strong> utaljátok el a <strong>12.000 Ft foglalási összeget</strong> számlaszámunkra, különben foglalásotok törlésre kerül! Köszönjük!</p>';
	echo '<br/>';
	echo '<p>A „közlemény” rovatban  tűntessétek fel a következőt: <strong>'.$code.'</strong></p>';
	echo '<br/>';
	echo '<p>Név: Flow4Freedom Kft. <span class="tabulated">Számlaszám: 10918001-00000026-88000000</span></p>';
	echo form_close();
?>
