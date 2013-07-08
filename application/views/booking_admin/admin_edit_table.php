<?php $this->load->view('header'); ?>
<body id="admin-page">
	<h1>
		Foglalások szerkesztése/törlése
	</h1>
	<h3 id="flash-msg">
		<?= $this->session->flashdata('msg') ?>
	</h3>
	<div id="admin-menu">
		<div id="admin-calendar">
			<span id="prev-month"><?= img(array('src' => base_url().'assets/img/main/arrow_left.png', 'id' => 'arrow-left')) ?></span>
			<div id="table-wrapper"><?php $this->load->view('booking_admin/admin_table', array('bookings' => $bookings, 'headTimestamp' => time())); ?></div>
			<span id="next-month"><?= img(array('src' => base_url().'assets/img/main/arrow_right.png', 'id' => 'arrow-right')) ?></span>
		</div>
		<p>
			<a href="<?= base_url() ?>index.php/admin/booking/list">Listanézet</a><br/>
			<a href="<?= base_url() ?>index.php/admin">Vissza</a>
		</p>
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
		
		$('#arrow-left').css('cursor', 'pointer');
		$('#arrow-right').css('cursor', 'pointer');

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
		
		function refreshTable(headTimestamp) {
			if (typeof headTimestamp === 'undefined') headTimestamp = parseInt($('#head-timestamp').text());
		
			$.ajax({
				url: '<?= base_url() ?>index.php/admin/booking/loadAdminTable?headTimestamp=' + headTimestamp,
				type: 'POST'
			}).success(function(result) {
				$('#table-wrapper').html(result);
			});
		}
		
		$('#arrow-left').click(function(){
			if ($('#head-timestamp').text() > <?= time() ?>) {
				$('#table-wrapper').invisible().promise().done(function(){
					refreshTable(parseInt($('#head-timestamp').text()) - parseInt(<?= Utils::weekInSec ?>));
					$(this).delay(450).visible();
				});
			}
		});
		
		$('#arrow-right').click(function(){
			$('#table-wrapper').invisible().promise().done(function(){
				refreshTable(parseInt($('#head-timestamp').text()) + parseInt(<?= Utils::weekInSec ?>));
				$(this).delay(450).visible();
			});
		});
		
	</script>
</body>
</html>