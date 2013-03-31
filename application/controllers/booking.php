<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

	private function get_appointments($from) {
		$day = 24 * 3600;
		$week = 7 * $day;
	
		// only check if appointments in cursor range
		$query = $this->db->query('SELECT * FROM reservations WHERE appointment > '.$from.' AND appointment < '.($from + $week).' ORDER BY appointment ASC');
		
		$reserved_dates = array();
		
		foreach ($query->result() as $row) {
			// table cell 'coordinates' will be x == day of week, y == hour
			$hour = date('G', $row->appointment);
			$day_of_week = date('w', $row->appointment);
			
			if ($day_of_week == 0) {
				$day_of_week = 7;
			}
			
			//$reserved_dates[$hour][$day_of_week][$row->appointment]['id'] = $row->id;
			//$reserved_dates[$hour][$day_of_week][$row->appointment]['billing_id'] = $row->billing_id;
			//$reserved_dates[$hour][$day_of_week][$row->appointment]['payment_option'] = $row->payment_option;
		}
		
		return $reserved_dates;
	}

	// called by jq.ajax()
	public function generate_table($ref_time) {
		$this->load->view('booking/calendar', array('reserved_dates' => $this->get_appointments($ref_time), 'ref_time' => $ref_time));
	}

	public function index() {
		$this->load->view('booking/booking', array('reserved_dates' => $this->get_appointments(time())));
	}

}