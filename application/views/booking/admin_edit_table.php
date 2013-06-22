<?php $this->load->view('header'); ?>
<body>
	<div id="wrapper_admin">
		<h1>
			Foglalások szerkesztése/törlése
		</h1>
		<h3 id="flash_msg">
			<?= $this->session->flashdata('msg') ?>
		</h3>
		<div id="admin_menu">
			<div id="admin_calendar">
				<span id="prev_month"><?= img(array('src' => base_url().'assets/img/main/arrow_left.png', 'id' => 'arrow_left')) ?></span>
				<div id="table_wrapper"><?php $this->load->view('booking/admin_table', array('bookings' => $bookings, 'headTimestamp' => time())); ?></div>
				<span id="next_month"><?= img(array('src' => base_url().'assets/img/main/arrow_right.png', 'id' => 'arrow_right')) ?></span>
			</div>
			<p>
				<a href="<?= base_url() ?>index.php/booking/editList">Listanézet</a><br/>
				<a href="<?= base_url() ?>index.php/admin">Vissza</a>
			</p>
		</div>
	</div>
	<script type="text/javascript">
		
		<?php // preload images ?>
		$.fn.preload = function() {
			this.each(function(){
				$('<img/>')[0].src = this;
			});
		}

		$([
			'<?= base_url() ?>assets/img/main/reserved.png',
			'<?= base_url() ?>assets/img/main/selected.png',
			'<?= base_url() ?>assets/img/main/arrow_left.png',
			'<?= base_url() ?>assets/img/main/arrow_right.png'
		]).preload();
		
		$('#arrow_left').css('cursor', 'pointer');
		$('#arrow_right').css('cursor', 'pointer');

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

		<?php // disable right click ?>
		$(document).ready(function(){
			$(document).bind("contextmenu", function(e){
				return false;
			});
		});
		
		<?php // booking table wrapper ?>
		var timer = $.timer(function() {
			refreshTable();
		});
		
		timer.set({ time : 15000, autostart : true });
		
		function refreshTable(ref_time) {
			if (typeof ref_time === 'undefined') ref_time = parseInt($('#reference_time').text());
		
			$.ajax({
				url: '<?= base_url() ?>index.php/booking/loadAdminTable?headTimestamp=' + ref_time,
				type: 'POST'
			}).success(function(result) {
				$('#table_wrapper').html(result);
			});
		}
		
		$('#arrow_left').click(function(){
			if ($('#reference_time').text() > <?= time() ?>) {
				$('#table_wrapper').invisible().promise().done(function(){
					refreshTable(parseInt($('#reference_time').text()) - parseInt(<?= Utils::weekInSec ?>));
					$(this).delay(450).visible();
				});
			}
		});
		
		$('#arrow_right').click(function(){
			$('#table_wrapper').invisible().promise().done(function(){
				refreshTable(parseInt($('#reference_time').text()) + parseInt(<?= Utils::weekInSec ?>));
				$(this).delay(450).visible();
			});
		});
		
	</script>
</body>
</html>