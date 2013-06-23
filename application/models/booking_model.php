<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model {

	public function fetchBookingQuery($query) {
		$bookings = array();
		
		foreach ($query->result() as $row) {
			$bookings[$row->appointment] = array(
				'id' => $row->id,
				'payment-option' => $row->payment_option,
				'client' => $row->book_fname.' '.$row->book_sname
			);
		}
		
		return $bookings;
	}
	
	public function getAllBookings() {
		return $this->fetchBookingQuery($this->db->query('
			SELECT * 
			FROM bookings 
			ORDER BY appointment ASC'
		));
	}
	
	public function getBookingsInRange($start, $rangeLength = Utils::weekInSec) {
		return $this->fetchBookingQuery($this->db->query('
			SELECT * 
			FROM bookings 
			WHERE appointment > '.Utils::getLastMonday($start).' 
			AND appointment < '.($start + $rangeLength).' 
			ORDER BY appointment ASC'
		));
	}
	
	public function getBookingLimit() {
		$query = $this->db->query("
			SELECT value 
			FROM config 
			WHERE option_name = 'booking_limit'
		");
		$result = $query->result();
		
		return $result[0]->value;
	}

	public function getNumberOfSuccessfulBookings() {
		if (!$this->session->all_userdata()) {
			$this->session->set_userdata(array('number-of-bookings' => 0));
		}
		
		return $this->session->userdata('number-of-bookings');
	}
	
	public function increaseSuccessfulBookings() {
		$this->session->set_userdata(array(
			'number-of-bookings' => $this->getNumberOfSuccessfulBookings() + 1
		));
	}
	
}