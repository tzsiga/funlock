<?php $this->load->view('header'); ?>
<body id="intro-page">
	<div id="action-zone">
		<?php
			function generateSliderDivs($letterParts) {
				foreach ($letterParts as $id => $letter) {
					echo '<div class="slider" id="'.$id.'" style="margin-top: '.$letter['margin-top'].'px; margin-left: '.$letter['margin-left'].'px; background-image: url(\''.base_url().'assets/img/intro/'.$letter['img'].'\');"></div>';
				}
			}
			
			function generateSliderCallbacks($letterParts) {
				foreach ($letterParts as $id => $letter) {
					echo '$("#'.$id.'").css("top", ((panelHeight - sliderHeight + (-1 * '.$letter['margin-top'].')) / panelWidth) * (e.pageX - marginOffsetX + offsetX));';
				}
			}
			
			$letterParts = array();
			
			$min = -700;
			$max = 700;
			$hs = 11;			// horizontal spacing
			
			$letterParts['S01'] = array('margin-top' => rand($min,$max), 	'margin-left' =>   		  0, 'img' => 'F_01.gif');
			$letterParts['S02'] = array('margin-top' => rand($min,$max), 	'margin-left' => 		  $hs, 'img' => 'F_01.gif');
			$letterParts['S03'] = array('margin-top' => rand($min,$max), 	'margin-left' =>  2 * $hs, 'img' => 'F_01.gif');
			$letterParts['S04'] = array('margin-top' => rand($min,$max), 	'margin-left' =>  3 * $hs, 'img' => 'F_01.gif');
			$letterParts['S05'] = array('margin-top' => rand($min,$max),	'margin-left' =>  4 * $hs, 'img' => 'F_02.gif');
			$letterParts['S06'] = array('margin-top' => rand($min,$max), 	'margin-left' =>  5 * $hs, 'img' => 'F_02.gif');
			$letterParts['S07'] = array('margin-top' => rand($min,$max),	'margin-left' =>  6 * $hs, 'img' => 'F_02.gif');
			$letterParts['S08'] = array('margin-top' => rand($min,$max), 	'margin-left' =>  7 * $hs, 'img' => 'F_03.gif');
			$letterParts['S09'] = array('margin-top' => rand($min,$max), 	'margin-left' =>  8 * $hs, 'img' => 'F_03.gif');

			$letterParts['S10'] = array('margin-top' => rand($min,$max), 	'margin-left' => 10 * $hs, 'img' => 'U_01.gif');
			$letterParts['S11'] = array('margin-top' => rand($min,$max), 	'margin-left' => 11 * $hs, 'img' => 'U_02.gif');
			$letterParts['S12'] = array('margin-top' => rand($min,$max), 	'margin-left' => 12 * $hs, 'img' => 'U_03.gif');
			$letterParts['S13'] = array('margin-top' => rand($min,$max), 	'margin-left' => 13 * $hs, 'img' => 'U_04.gif');
			$letterParts['S14'] = array('margin-top' => rand($min,$max), 	'margin-left' => 14 * $hs, 'img' => 'U_05.gif');
			$letterParts['S15'] = array('margin-top' => rand($min,$max), 	'margin-left' => 15 * $hs, 'img' => 'U_06.gif');
			$letterParts['S16'] = array('margin-top' => rand($min,$max), 	'margin-left' => 16 * $hs, 'img' => 'U_06.gif');
			$letterParts['S17'] = array('margin-top' => rand($min,$max), 	'margin-left' => 17 * $hs, 'img' => 'U_05.gif');
			$letterParts['S18'] = array('margin-top' => rand($min,$max), 	'margin-left' => 18 * $hs, 'img' => 'U_04.gif');
			$letterParts['S19'] = array('margin-top' => rand($min,$max), 	'margin-left' => 19 * $hs, 'img' => 'U_03.gif');
			$letterParts['S20'] = array('margin-top' => rand($min,$max), 	'margin-left' => 20 * $hs, 'img' => 'U_02.gif');
			$letterParts['S21'] = array('margin-top' => rand($min,$max), 	'margin-left' => 21 * $hs, 'img' => 'U_01.gif');
			
			$letterParts['S22'] = array('margin-top' => rand($min,$max), 	'margin-left' => 23 * $hs, 'img' => 'N_01.gif');
			$letterParts['S23'] = array('margin-top' => rand($min,$max), 	'margin-left' => 24 * $hs, 'img' => 'N_01.gif');
			$letterParts['S24'] = array('margin-top' => rand($min,$max), 	'margin-left' => 25 * $hs, 'img' => 'N_01.gif');
			$letterParts['S25'] = array('margin-top' => rand($min,$max), 	'margin-left' => 26 * $hs, 'img' => 'N_01.gif');
			$letterParts['S26'] = array('margin-top' => rand($min,$max), 	'margin-left' => 27 * $hs, 'img' => 'N_02.gif');
			$letterParts['S27'] = array('margin-top' => rand($min,$max), 	'margin-left' => 28 * $hs, 'img' => 'N_03.gif');
			$letterParts['S28'] = array('margin-top' => rand($min,$max), 	'margin-left' => 29 * $hs, 'img' => 'N_04.gif');
			$letterParts['S29'] = array('margin-top' => rand($min,$max), 	'margin-left' => 30 * $hs, 'img' => 'N_05.gif');
			$letterParts['S30'] = array('margin-top' => rand($min,$max), 	'margin-left' => 31 * $hs, 'img' => 'N_06.gif');
			$letterParts['S31'] = array('margin-top' => rand($min,$max), 	'margin-left' => 32 * $hs, 'img' => 'N_01.gif');
			$letterParts['S32'] = array('margin-top' => rand($min,$max), 	'margin-left' => 33 * $hs, 'img' => 'N_01.gif');
			$letterParts['S33'] = array('margin-top' => rand($min,$max), 	'margin-left' => 34 * $hs, 'img' => 'N_01.gif');
			$letterParts['S34'] = array('margin-top' => rand($min,$max), 	'margin-left' => 35 * $hs, 'img' => 'N_01.gif');

			$letterParts['S35'] = array('margin-top' => rand($min,$max), 	'margin-left' => 37 * $hs, 'img' => 'L_01.gif');
			$letterParts['S36'] = array('margin-top' => rand($min,$max), 	'margin-left' => 38 * $hs, 'img' => 'L_01.gif');
			$letterParts['S37'] = array('margin-top' => rand($min,$max), 	'margin-left' => 39 * $hs, 'img' => 'L_01.gif');
			$letterParts['S38'] = array('margin-top' => rand($min,$max), 	'margin-left' => 40 * $hs, 'img' => 'L_01.gif');
			$letterParts['S39'] = array('margin-top' => rand($min,$max), 	'margin-left' => 41 * $hs, 'img' => 'L_02.gif');
			$letterParts['S40'] = array('margin-top' => rand($min,$max), 	'margin-left' => 42 * $hs, 'img' => 'L_02.gif');
			$letterParts['S41'] = array('margin-top' => rand($min,$max), 	'margin-left' => 43 * $hs, 'img' => 'L_02.gif');
			$letterParts['S42'] = array('margin-top' => rand($min,$max), 	'margin-left' => 44 * $hs, 'img' => 'L_02.gif');
			
			$letterParts['S43'] = array('margin-top' => rand($min,$max), 	'margin-left' => 46 * $hs, 'img' => 'O_01.gif');
			$letterParts['S44'] = array('margin-top' => rand($min,$max), 	'margin-left' => 47 * $hs, 'img' => 'O_02.gif');
			$letterParts['S45'] = array('margin-top' => rand($min,$max), 	'margin-left' => 48 * $hs, 'img' => 'O_03.gif');
			$letterParts['S46'] = array('margin-top' => rand($min,$max), 	'margin-left' => 49 * $hs, 'img' => 'O_04.gif');
			$letterParts['S47'] = array('margin-top' => rand($min,$max), 	'margin-left' => 50 * $hs, 'img' => 'O_05.gif');
			$letterParts['S48'] = array('margin-top' => rand($min,$max), 	'margin-left' => 51 * $hs, 'img' => 'O_06.gif');
			$letterParts['S49'] = array('margin-top' => rand($min,$max), 	'margin-left' => 52 * $hs, 'img' => 'O_07.gif');
			$letterParts['S50'] = array('margin-top' => rand($min,$max), 	'margin-left' => 53 * $hs, 'img' => 'O_07.gif');
			$letterParts['S51'] = array('margin-top' => rand($min,$max), 	'margin-left' => 54 * $hs, 'img' => 'O_06.gif');
			$letterParts['S52'] = array('margin-top' => rand($min,$max), 	'margin-left' => 55 * $hs, 'img' => 'O_05.gif');
			$letterParts['S53'] = array('margin-top' => rand($min,$max), 	'margin-left' => 56 * $hs, 'img' => 'O_04.gif');
			$letterParts['S54'] = array('margin-top' => rand($min,$max), 	'margin-left' => 57 * $hs, 'img' => 'O_03.gif');
			$letterParts['S55'] = array('margin-top' => rand($min,$max), 	'margin-left' => 58 * $hs, 'img' => 'O_02.gif');
			$letterParts['S56'] = array('margin-top' => rand($min,$max), 	'margin-left' => 59 * $hs, 'img' => 'O_01.gif');
			
			$letterParts['S57'] = array('margin-top' => rand($min,$max), 	'margin-left' => 61 * $hs, 'img' => 'C_01.gif');
			$letterParts['S58'] = array('margin-top' => rand($min,$max), 	'margin-left' => 62 * $hs, 'img' => 'C_02.gif');
			$letterParts['S59'] = array('margin-top' => rand($min,$max), 	'margin-left' => 63 * $hs, 'img' => 'C_03.gif');
			$letterParts['S60'] = array('margin-top' => rand($min,$max), 	'margin-left' => 64 * $hs, 'img' => 'C_04.gif');
			$letterParts['S61'] = array('margin-top' => rand($min,$max), 	'margin-left' => 65 * $hs, 'img' => 'C_05.gif');
			$letterParts['S62'] = array('margin-top' => rand($min,$max), 	'margin-left' => 66 * $hs, 'img' => 'C_06.gif');
			$letterParts['S63'] = array('margin-top' => rand($min,$max), 	'margin-left' => 67 * $hs, 'img' => 'C_07.gif');
			$letterParts['S64'] = array('margin-top' => rand($min,$max), 	'margin-left' => 68 * $hs, 'img' => 'C_08.gif');
			$letterParts['S65'] = array('margin-top' => rand($min,$max), 	'margin-left' => 69 * $hs, 'img' => 'C_09.gif');
			$letterParts['S66'] = array('margin-top' => rand($min,$max), 	'margin-left' => 70 * $hs, 'img' => 'C_10.gif');
			$letterParts['S67'] = array('margin-top' => rand($min,$max), 	'margin-left' => 71 * $hs, 'img' => 'C_11.gif');
			
			$letterParts['S68'] = array('margin-top' => rand($min,$max), 	'margin-left' => 73 * $hs, 'img' => 'K_01.gif');
			$letterParts['S69'] = array('margin-top' => rand($min,$max), 	'margin-left' => 74 * $hs, 'img' => 'K_01.gif');
			$letterParts['S70'] = array('margin-top' => rand($min,$max), 	'margin-left' => 75 * $hs, 'img' => 'K_01.gif');
			$letterParts['S71'] = array('margin-top' => rand($min,$max), 	'margin-left' => 76 * $hs, 'img' => 'K_01.gif');
			$letterParts['S72'] = array('margin-top' => rand($min,$max), 	'margin-left' => 77 * $hs, 'img' => 'K_02.gif');
			$letterParts['S73'] = array('margin-top' => rand($min,$max), 	'margin-left' => 78 * $hs, 'img' => 'K_03.gif');
			$letterParts['S74'] = array('margin-top' => rand($min,$max), 	'margin-left' => 79 * $hs, 'img' => 'K_04.gif');
			$letterParts['S75'] = array('margin-top' => rand($min,$max), 	'margin-left' => 80 * $hs, 'img' => 'K_05.gif');
			$letterParts['S76'] = array('margin-top' => rand($min,$max), 	'margin-left' => 81 * $hs, 'img' => 'K_06.gif');
			$letterParts['S77'] = array('margin-top' => rand($min,$max), 	'margin-left' => 82 * $hs, 'img' => 'K_07.gif');
			$letterParts['S78'] = array('margin-top' => rand($min,$max), 	'margin-left' => 83 * $hs, 'img' => 'K_08.gif');
			$letterParts['S79'] = array('margin-top' => rand($min,$max), 	'margin-left' => 84 * $hs, 'img' => 'K_09.gif');
			
			generateSliderDivs($letterParts);
		?>
		
		<div id="enter"><a href="<?= base_url().'index.php/booking' ?>">ENTER &bull;</a></div>
	</div>
	<?php // text for search engines ?>
	<div id="t4se">
		A Funlock egy szórakoztató csapatjáték, mely Téged és Barátaidat egy órára „rabul” ejt és csak magatokra illetve egymásra számíthattok az elgondolkodtató feladatok megoldásában. Közös csapatmunkával képesek lehettek legyőzni a számítógépet, mely átvette a szoba felett az irányítást és az egy óra leteltével örökre bezár Titeket. A játék 2-5 fős csapatokban játszható. Céges csapatépítő programnak is ajánljuk.A játék ára 12.000 Ft csapatonként, a csapat létszámától függetlenül. Amennyiben nagyobb létszámú társasággal jönnétek, egyedi foglalási megoldásokért keressetek minket elérhetőségeinken. Szeretettel várunk Titeket: A Funlock csapata
	</div>
	<?php $this->load->view('intro/intro_js', array('letterParts' => $letterParts)); ?>
</body>
</html>