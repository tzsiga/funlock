<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model {

	public function fetchBookingQuery($query) {
		$bookings = array();
		
		foreach ($query->result() as $row) {
			$bookings[$row->appointment] = array(
				'id' => $row->id,
				'payment-option' => $row->payment_option,
				'client' => $row->book_fname.' '.$row->book_sname,
				'status' => $row->status
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
	
	public function getBooking($id) {
		$booking = $this->db->get_where('bookings', array('id' => $id))->result();
		return $booking[0];
	}
	
	public function getBookingsInRange($start) {
		$rangeLength = Utils::weekInSec - (time() - Utils::getLastMonday(time()));
		
		return $this->fetchBookingQuery($this->db->query('
			SELECT * 
			FROM bookings 
			WHERE appointment > '.Utils::getLastMonday($start).' 
			AND appointment < '.($start + $rangeLength).' 
			ORDER BY appointment ASC'
		));
	}
	
	public function insertBooking($booking) {
		$this->db->insert('bookings', $booking);
	}
	
	public function updateBooking($id, $booking) {
		$this->db->where('id', $id);
		$this->db->update('bookings', $booking);
	}
	
	public function deleteBooking($id) {
		$this->db->delete('bookings', array('id' => $id));
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
	
	public function incSuccessfulBookings($n = 1) {
		$this->session->set_userdata(array(
			'number-of-bookings' => $this->getNumberOfSuccessfulBookings() + $n
		));
	}
	
}