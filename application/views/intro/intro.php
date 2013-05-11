<?php $this->load->view('header'); ?>
<body id="intro_page">
	<div id="action_zone">
		<?php
			// az action zone tartalmazza a slidereket, hozzá képest kell megadni a csúszkák KEZDETI pozícióját
			
			function generate_slider_divs($letters) {
				foreach ($letters as $id => $letter) {
					echo "\n".'<div class="slider" id="'.$id.'" style="margin-top: '.$letter['margin_top'].'px; margin-left: '.$letter['margin_left'].'px; background-image: url(\'assets/img/intro/'.$letter['img'].'\');"></div>';
				}
			}
			
			function generate_slider_js($letters) {
				foreach ($letters as $id => $letter) {
					echo "\n".'$("#'.$id.'").css("top", ((panel_height - slider_height + (-1 * '.$letter['margin_top'].')) / panel_width) * (e.pageX - margin_offset_x + offset_x));';
				}
			}
			
			// array of the sticks
			$letters = array();
			
			$min = -700;
			$max = 700;
			$hs = 11;			// horizontal spacing
			
			$letters['S01'] = array('margin_top' => rand($min,$max), 	'margin_left' =>   		 0, 'img' => 'F_01.gif');
			$letters['S02'] = array('margin_top' => rand($min,$max), 	'margin_left' => 		 $hs, 'img' => 'F_01.gif');
			$letters['S03'] = array('margin_top' => rand($min,$max), 	'margin_left' => 2 * $hs, 'img' => 'F_01.gif');
			$letters['S04'] = array('margin_top' => rand($min,$max), 	'margin_left' => 3 * $hs, 'img' => 'F_01.gif');
			$letters['S05'] = array('margin_top' => rand($min,$max),	'margin_left' => 4 * $hs, 'img' => 'F_02.gif');
			$letters['S06'] = array('margin_top' => rand($min,$max), 	'margin_left' => 5 * $hs, 'img' => 'F_02.gif');
			$letters['S07'] = array('margin_top' => rand($min,$max),	'margin_left' => 6 * $hs, 'img' => 'F_02.gif');
			$letters['S08'] = array('margin_top' => rand($min,$max), 	'margin_left' => 7 * $hs, 'img' => 'F_03.gif');
			$letters['S09'] = array('margin_top' => rand($min,$max), 	'margin_left' => 8 * $hs, 'img' => 'F_03.gif');

			$letters['S10'] = array('margin_top' => rand($min,$max), 	'margin_left' => 10 * $hs, 'img' => 'U_01.gif');
			$letters['S11'] = array('margin_top' => rand($min,$max), 	'margin_left' => 11 * $hs, 'img' => 'U_02.gif');
			$letters['S12'] = array('margin_top' => rand($min,$max), 	'margin_left' => 12 * $hs, 'img' => 'U_03.gif');
			$letters['S13'] = array('margin_top' => rand($min,$max), 	'margin_left' => 13 * $hs, 'img' => 'U_04.gif');
			$letters['S14'] = array('margin_top' => rand($min,$max), 	'margin_left' => 14 * $hs, 'img' => 'U_05.gif');
			$letters['S15'] = array('margin_top' => rand($min,$max), 	'margin_left' => 15 * $hs, 'img' => 'U_06.gif');
			$letters['S16'] = array('margin_top' => rand($min,$max), 	'margin_left' => 16 * $hs, 'img' => 'U_06.gif');
			$letters['S17'] = array('margin_top' => rand($min,$max), 	'margin_left' => 17 * $hs, 'img' => 'U_05.gif');
			$letters['S18'] = array('margin_top' => rand($min,$max), 	'margin_left' => 18 * $hs, 'img' => 'U_04.gif');
			$letters['S19'] = array('margin_top' => rand($min,$max), 	'margin_left' => 19 * $hs, 'img' => 'U_03.gif');
			$letters['S20'] = array('margin_top' => rand($min,$max), 	'margin_left' => 20 * $hs, 'img' => 'U_02.gif');
			$letters['S21'] = array('margin_top' => rand($min,$max), 	'margin_left' => 21 * $hs, 'img' => 'U_01.gif');
			
			$letters['S22'] = array('margin_top' => rand($min,$max), 	'margin_left' => 23 * $hs, 'img' => 'N_01.gif');
			$letters['S23'] = array('margin_top' => rand($min,$max), 	'margin_left' => 24 * $hs, 'img' => 'N_01.gif');
			$letters['S24'] = array('margin_top' => rand($min,$max), 	'margin_left' => 25 * $hs, 'img' => 'N_01.gif');
			$letters['S25'] = array('margin_top' => rand($min,$max), 	'margin_left' => 26 * $hs, 'img' => 'N_01.gif');
			$letters['S26'] = array('margin_top' => rand($min,$max), 	'margin_left' => 27 * $hs, 'img' => 'N_02.gif');
			$letters['S27'] = array('margin_top' => rand($min,$max), 	'margin_left' => 28 * $hs, 'img' => 'N_03.gif');
			$letters['S28'] = array('margin_top' => rand($min,$max), 	'margin_left' => 29 * $hs, 'img' => 'N_04.gif');
			$letters['S29'] = array('margin_top' => rand($min,$max), 	'margin_left' => 30 * $hs, 'img' => 'N_05.gif');
			$letters['S30'] = array('margin_top' => rand($min,$max), 	'margin_left' => 31 * $hs, 'img' => 'N_06.gif');
			$letters['S31'] = array('margin_top' => rand($min,$max), 	'margin_left' => 32 * $hs, 'img' => 'N_01.gif');
			$letters['S32'] = array('margin_top' => rand($min,$max), 	'margin_left' => 33 * $hs, 'img' => 'N_01.gif');
			$letters['S33'] = array('margin_top' => rand($min,$max), 	'margin_left' => 34 * $hs, 'img' => 'N_01.gif');
			$letters['S34'] = array('margin_top' => rand($min,$max), 	'margin_left' => 35 * $hs, 'img' => 'N_01.gif');

			$letters['S35'] = array('margin_top' => rand($min,$max), 	'margin_left' => 37 * $hs, 'img' => 'L_01.gif');
			$letters['S36'] = array('margin_top' => rand($min,$max), 	'margin_left' => 38 * $hs, 'img' => 'L_01.gif');
			$letters['S37'] = array('margin_top' => rand($min,$max), 	'margin_left' => 39 * $hs, 'img' => 'L_01.gif');
			$letters['S38'] = array('margin_top' => rand($min,$max), 	'margin_left' => 40 * $hs, 'img' => 'L_01.gif');
			$letters['S39'] = array('margin_top' => rand($min,$max), 	'margin_left' => 41 * $hs, 'img' => 'L_02.gif');
			$letters['S40'] = array('margin_top' => rand($min,$max), 	'margin_left' => 42 * $hs, 'img' => 'L_02.gif');
			$letters['S41'] = array('margin_top' => rand($min,$max), 	'margin_left' => 43 * $hs, 'img' => 'L_02.gif');
			$letters['S42'] = array('margin_top' => rand($min,$max), 	'margin_left' => 44 * $hs, 'img' => 'L_02.gif');
			
			$letters['S43'] = array('margin_top' => rand($min,$max), 	'margin_left' => 46 * $hs, 'img' => 'O_01.gif');
			$letters['S44'] = array('margin_top' => rand($min,$max), 	'margin_left' => 47 * $hs, 'img' => 'O_02.gif');
			$letters['S45'] = array('margin_top' => rand($min,$max), 	'margin_left' => 48 * $hs, 'img' => 'O_03.gif');
			$letters['S46'] = array('margin_top' => rand($min,$max), 	'margin_left' => 49 * $hs, 'img' => 'O_04.gif');
			$letters['S47'] = array('margin_top' => rand($min,$max), 	'margin_left' => 50 * $hs, 'img' => 'O_05.gif');
			$letters['S48'] = array('margin_top' => rand($min,$max), 	'margin_left' => 51 * $hs, 'img' => 'O_06.gif');
			$letters['S49'] = array('margin_top' => rand($min,$max), 	'margin_left' => 52 * $hs, 'img' => 'O_07.gif');
			$letters['S50'] = array('margin_top' => rand($min,$max), 	'margin_left' => 53 * $hs, 'img' => 'O_07.gif');
			$letters['S51'] = array('margin_top' => rand($min,$max), 	'margin_left' => 54 * $hs, 'img' => 'O_06.gif');
			$letters['S52'] = array('margin_top' => rand($min,$max), 	'margin_left' => 55 * $hs, 'img' => 'O_05.gif');
			$letters['S53'] = array('margin_top' => rand($min,$max), 	'margin_left' => 56 * $hs, 'img' => 'O_04.gif');
			$letters['S54'] = array('margin_top' => rand($min,$max), 	'margin_left' => 57 * $hs, 'img' => 'O_03.gif');
			$letters['S55'] = array('margin_top' => rand($min,$max), 	'margin_left' => 58 * $hs, 'img' => 'O_02.gif');
			$letters['S56'] = array('margin_top' => rand($min,$max), 	'margin_left' => 59 * $hs, 'img' => 'O_01.gif');
			
			$letters['S57'] = array('margin_top' => rand($min,$max), 	'margin_left' => 61 * $hs, 'img' => 'C_01.gif');
			$letters['S58'] = array('margin_top' => rand($min,$max), 	'margin_left' => 62 * $hs, 'img' => 'C_02.gif');
			$letters['S59'] = array('margin_top' => rand($min,$max), 	'margin_left' => 63 * $hs, 'img' => 'C_03.gif');
			$letters['S60'] = array('margin_top' => rand($min,$max), 	'margin_left' => 64 * $hs, 'img' => 'C_04.gif');
			$letters['S61'] = array('margin_top' => rand($min,$max), 	'margin_left' => 65 * $hs, 'img' => 'C_05.gif');
			$letters['S62'] = array('margin_top' => rand($min,$max), 	'margin_left' => 66 * $hs, 'img' => 'C_06.gif');
			$letters['S63'] = array('margin_top' => rand($min,$max), 	'margin_left' => 67 * $hs, 'img' => 'C_07.gif');
			$letters['S64'] = array('margin_top' => rand($min,$max), 	'margin_left' => 68 * $hs, 'img' => 'C_08.gif');
			$letters['S65'] = array('margin_top' => rand($min,$max), 	'margin_left' => 69 * $hs, 'img' => 'C_09.gif');
			$letters['S66'] = array('margin_top' => rand($min,$max), 	'margin_left' => 70 * $hs, 'img' => 'C_10.gif');
			$letters['S67'] = array('margin_top' => rand($min,$max), 	'margin_left' => 71 * $hs, 'img' => 'C_11.gif');
			
			$letters['S68'] = array('margin_top' => rand($min,$max), 	'margin_left' => 73 * $hs, 'img' => 'K_01.gif');
			$letters['S69'] = array('margin_top' => rand($min,$max), 	'margin_left' => 74 * $hs, 'img' => 'K_01.gif');
			$letters['S70'] = array('margin_top' => rand($min,$max), 	'margin_left' => 75 * $hs, 'img' => 'K_01.gif');
			$letters['S71'] = array('margin_top' => rand($min,$max), 	'margin_left' => 76 * $hs, 'img' => 'K_01.gif');
			$letters['S72'] = array('margin_top' => rand($min,$max), 	'margin_left' => 77 * $hs, 'img' => 'K_02.gif');
			$letters['S73'] = array('margin_top' => rand($min,$max), 	'margin_left' => 78 * $hs, 'img' => 'K_03.gif');
			$letters['S74'] = array('margin_top' => rand($min,$max), 	'margin_left' => 79 * $hs, 'img' => 'K_04.gif');
			$letters['S75'] = array('margin_top' => rand($min,$max), 	'margin_left' => 80 * $hs, 'img' => 'K_05.gif');
			$letters['S76'] = array('margin_top' => rand($min,$max), 	'margin_left' => 81 * $hs, 'img' => 'K_06.gif');
			$letters['S77'] = array('margin_top' => rand($min,$max), 	'margin_left' => 82 * $hs, 'img' => 'K_07.gif');
			$letters['S78'] = array('margin_top' => rand($min,$max), 	'margin_left' => 83 * $hs, 'img' => 'K_08.gif');
			$letters['S79'] = array('margin_top' => rand($min,$max), 	'margin_left' => 84 * $hs, 'img' => 'K_09.gif');
			
			generate_slider_divs($letters);
			
		?>
		
		<div id="enter"><a href="<?= base_url().'index.php/booking' ?>">ENTER &bull;</a></div>
	</div>
	<script type="text/javascript">
		var panel_height = 370;
		var panel_width = 800;
		
		var slider_height = 177;
		
		var offset_x = 0;
		//var margin_offset_x = ($("body").width() - panel_width) / 2;
		var margin_offset_x = 280;
		
		jQuery(document).ready(function(){
			$(document).mousemove(function(e){
				<?php generate_slider_js($letters); ?>
			});
		});
		
		// disable right click
		$(document).ready(function(){
			$(document).bind("contextmenu",function(e){
				return false;
			});
		});
		
	</script>
</body>
</html>