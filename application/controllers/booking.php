<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

	private function get_appointments($from) {
		$day = 24 * 3600;
		$week = 7 * $day;
	
		$query = $this->db->query('SELECT * FROM reservations WHERE appointment > '.$from.' AND appointment < '.($from + $week).' ORDER BY appointment ASC');
		
		$reserved_dates = array();
		
		foreach ($query->result() as $row) {
			$hour = date('G', $row->appointment);
			$day_of_week = date('w', $row->appointment);
			
			if ($day_of_week == 0) {
				$day_of_week = 7;
			}
			
			$reserved_dates[$hour][$day_of_week]['appointment'] = $row->appointment;
			//$reserved_dates[$hour][$day_of_week]['payment_option'] = $row->payment_option;
			//$reserved_dates[$hour][$day_of_week]['billing_id'] = $row->billing_id;
			//$reserved_dates[$hour][$day_of_week]['id'] = $row->id;
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