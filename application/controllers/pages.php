<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index() {
		$this->load->view('page_intro');
	}
	
	public function calendar() {
		$query = $this->db->query('SELECT * FROM reservations WHERE appointment > '.time().' ORDER BY appointment ASC');
		
		foreach ($query->result() as $row) {
			$hour = date('G', $row->appointment);
			$day = date('w', $row->appointment);
			$reserved_dates[$hour][$day]['appointment'] = $row->appointment;
			//$reserved_dates[$hour][$day]['payment_option'] = $row->payment_option;
			//$reserved_dates[$hour][$day]['billing_id'] = $row->billing_id;
			//$reserved_dates[$hour][$day]['id'] = $row->id;
		}
		
		$this->load->view('page_calendar', array('reserved_dates' => $reserved_dates));
	}
	
}
