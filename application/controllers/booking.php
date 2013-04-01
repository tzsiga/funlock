<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

	private function get_appointments($from) {
		// only check if appointments in cursor range
		$query = $this->db->query('SELECT * FROM reservations WHERE appointment > '.Utils::monday($from).' AND appointment < '.($from + Utils::week()).' ORDER BY appointment ASC');
		
		$reserved_dates = array();
		
		foreach ($query->result() as $row) {
			$reserved_dates[$row->appointment] = array(
				'client'	 		=> $row->forename.' '.$row->surname,
				'billing_id' 		=> $row->billing_id,
				'payment_option' 	=> $row->payment_option
			);
		}
		
		return $reserved_dates;
	}

	public function index() {
		$this->load->view('booking/booking', array('reserved_dates' => $this->get_appointments(time())));
	}

	// called by jq.ajax()
	public function generate_table($ref_time) {
		$this->load->view('booking/calendar', array('reserved_dates' => $this->get_appointments($ref_time), 'ref_time' => $ref_time));
	}

}