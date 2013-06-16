<?php $this->load->view('header'); ?>
<body id="main_page">
	<div id="wrapper_content">
		<div id="navbar">
			<a href="<?= base_url().'index.php/booking' ?>"><?= img(array('src' => base_url().'assets/img/main/logo_small.png', 'id' => 'logo_small')) ?></a>
			<?php if ($this->agent->browser() == 'Internet Explorer') {?>
			<div id="subtitle" style="margin-top: -20px;">
			<?php } else { ?>
			<div id="subtitle">
			<?php } ?>- A Bejutós Játék -</div>
			<a href="<?= base_url().'index.php/booking' ?>" id="main_link"></a>
			<div id="menu">
				<ul>
					<li><p id="link_info">Info</p></li>
					<li><p id="link_contact">Elérhetőség</p></li>
					<li><p id="link_gallery"><a href="https://www.facebook.com/pages/Funlock/334668339974241?id=334668339974241&amp;sk=photos_stream" target="_blank">Galéria</a></p></li>
				</ul>
			</div>
			<div id="item_display_area"></div>
		</div>
		<div id="content">
			<div id="calendar">
				<span id="prev_month"><?= img(array('src' => base_url().'assets/img/main/arrow_left.png', 'id' => 'arrow_left')) ?></span>
				<div id="table_wrapper"><?php $this->load->view('booking/calendar', array('reserved_dates' => $reserved_dates, 'ref_time' => time(), 'selected_appointment' => 0)); ?></div>
				<span id="next_month"><?= img(array('src' => base_url().'assets/img/main/arrow_right.png', 'id' => 'arrow_right')) ?></span>
			</div>
			<div id="legend">
				<div id="icon_unavailable"></div>
				<div>Nem elérhető</div>
				<div id="icon_available"></div>
				<div>Szabad</div>
				<div id="icon_reserved"></div>
				<div>Foglalt</div>
			</div>
			<div id="booking_details">
				<?php $user_booking_num < $booking_limit ? $this->load->view('booking/form') : $this->load->view('booking/form_fail_limit'); ?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		
		<?php // big brother ?>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-41388740-1']);
		_gaq.push(['_setDomainName', 'funlock.hu']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
		<?php // preload images ?>
		$.fn.preload = function() {
			this.each(function(){
				$('<img/>')[0].src = this;
			});
		}

		$([
			'<?= base_url() ?>assets/img/main/logo_small.png',
			'<?= base_url() ?>assets/img/main/reserved.png',
			'<?= base_url() ?>assets/img/main/selected.png',
			'<?= base_url() ?>assets/img/main/arrow_left.png',
			'<?= base_url() ?>assets/img/main/arrow_right.png',
			'<?= base_url() ?>assets/img/main/map.png'
		]).preload();

		<?php // opacity toggle ?>
		jQuery.fn.visible = function() {
			return this.animate({opacity: 1}, 400);
		}

		jQuery.fn.invisible = function() {
			return this.animate({opacity: 0}, 400);
		}

		jQuery.fn.visibilityToggle = function() {
			return (this.css('opacity') == 0) ? this.animate({opacity: 1}, 400) : this.animate({opacity: 0}, 400);
		}

		<?php // default setup ?>
		
		$(document).ready(function(){
			<?php // disable right click ?>
			$(document).bind("contextmenu", function(e){
				return false;
			});
		
			<?php // hidden elements by default ?>
			$('#booking_details').css('opacity', '0');
			
			<?php // fake links ?>
			$('#link_info').css('cursor', 'pointer');
			$('#link_map').css('cursor', 'pointer');
			$('#link_contact').css('cursor', 'pointer');
			$('td.timebox').css('cursor', 'pointer');
			$('#arrow_left').css('cursor', 'pointer');
			$('#arrow_right').css('cursor', 'pointer');
		});
		
		<?php // left menu items ?>
			
		var item_info = 'A Funlock egy szórakoztató csapatjáték, mely Téged és Barátaidat egy órára „rabul” ejt és csak magatokra illetve egymásra számíthattok az elgondolkodtató feladatok megoldásában. Közös csapatmunkával képesek lehettek legyőzni a számítógépet, mely átvette a szoba felett az irányítást és az egy óra leteltével örökre bezár Titeket.<br/><br/>A játék <strong>2-5 fős csapatokban</strong> játszható. Céges csapatépítő programnak is ajánljuk.<br/><br/>A játék ára <strong>12.000 Ft csapatonként</strong>, a csapat létszámától függetlenül.<br/><br/>Amennyiben nagyobb létszámú társasággal jönnétek, egyedi foglalási megoldásokért keressetek minket elérhetőségeinken.<br/><br/>Szeretettel várunk Titeket:<br/><em>A Funlock csapata</em>';
		var item_contact = '1068 Budapest<br/>Király utca 54.<br/>(bejárat a Hegedű utcából)<br/><br/>+3670 382 1388<br/><p id="info">&nbsp;</p><br/>';
		var item_map = '<a href="http://goo.gl/maps/AriVW" target="_blank"><img id="map" src="<?= base_url() ?>assets/img/main/map.png" alt="" title="" style="margin-left: -15px; border: 1px solid black; -moz-box-shadow: 8px 8px 15px #CCCCCC; -webkit-box-shadow: 8px 8px 15px #CCCCCC; box-shadow: 8px 8px 15px #CCCCCC;"/></a>';
		
		function replaceAll(txt, replace, with_this) {
			return txt.replace(new RegExp(replace, 'g'), with_this);
		}

		$('#link_info').click(function(){
			$('#item_display_area').fadeOut(function(){
				if ($(this).html() == replaceAll(item_info, '/>','>')){
					$(this).html('');
				} else {
					$(this).html(item_info).fadeIn();
				}
			});
		});

		$('#link_contact').click(function(){
			$('#item_display_area').fadeOut(function(){
				if ($(this).html() == replaceAll(item_contact, '/>','>') + item_map.replace('/>','>')){
					$(this).html('');
				} else {
					$(this).html(item_contact + item_map).fadeIn();
				}
			});
		});
			
		<?php // booking calendar wrapper ?>
		
		var timer = $.timer(function() {
			refreshTable();
		});
		
		timer.set({ time : 15000, autostart : true });
		
		function refreshTable(ref_time) {
			if (typeof ref_time === 'undefined') ref_time = parseInt($('#reference_time').text());
		
			$.ajax({
				url: '<?= base_url() ?>index.php/booking/generate_table?ref_time=' + ref_time + '&selected_appointment=' + strtotime($("input[name=appointment]").val()),
				type: 'POST'
			}).success(function(result) {
				$('#table_wrapper').html(result);
				$('td.timebox').css('cursor', 'pointer');
			});
		}
		
		$('#arrow_left').click(function(){
			if ($('#reference_time').text() > <?= time() ?>) {
				$('#table_wrapper').invisible().promise().done(function(){
					refreshTable(parseInt($('#reference_time').text()) - parseInt(<?= Utils::week ?>));
					$(this).delay(450).visible();
				});
			}
		});
		
		$('#arrow_right').click(function(){
			$('#table_wrapper').invisible().promise().done(function(){
				refreshTable(parseInt($('#reference_time').text()) + parseInt(<?= Utils::week ?>));
				$(this).delay(450).visible();
			});
		});
		
	</script>
</body>
</html>