<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'admin.php';

class Booking_Admin extends Admin {

	public function addBookingAsAdmin($timestamp = 0) {
		$posted = $this->input->post();
		
		if ($posted) {
			$this->setValidationRulesForAdmin($posted);
			
			if ($this->form_validation->run() == true) {
				$this->createBooking($posted);
				redirect('admin/booking/edit', 'refresh');
			}
		}
		
		$this->load->view('booking_admin/admin_add', array(
			'posted' => $posted, 
			'timestamp' => $timestamp
		));
	}
	
	public function editBooking($id) {
		$posted = $this->input->post();
		
		if ($posted) {
			$this->setValidationRulesForAdmin($posted);
			
			if ($this->form_validation->run() == true) {
				if ($this->getCase($posted) === 'save') {
					$this->saveBooking($id, $posted);
				} else if ($this->getCase($posted) === 'delete') {
					$this->deleteBooking($id, $posted);
				}
				redirect('admin/booking/edit', 'refresh');
			}
		}
		
		$this->load->view('booking_admin/admin_edit', array(
			'booking' => $this->booking_model->getBooking($id)
		));
	}
	
	public function editList() {
		$this->load->view('booking_admin/admin_edit_list', array(
			'bookings' => $this->booking_model->getAllBookings()
		));
	}
	
	public function editTable() {
		$this->load->view('booking_admin/admin_edit_table', array(
			'bookings' => $this->booking_model->getAllBookings()
		));
	}
	
	public function loadAdminTable() {
		if ($this->input->is_ajax_request()) {
			$headTimestamp = $this->input->get('headTimestamp');
			$this->load->view('booking_admin/admin_table', array(
				'bookings' => $this->booking_model->getBookingsInRange($headTimestamp), 
				'headTimestamp' => $headTimestamp
			));
		}
	}
	
	private function setValidationRulesForAdmin($posted = null) {
		$this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');

		if (isset($posted['status'])) {
			$this->form_validation->set_rules('book-fname', '"Foglaló vezetékneve"', 'required|xss_clean');
			$this->form_validation->set_rules('book-sname', '"Foglaló keresztneve"', 'required|xss_clean');
		}
	}
	
	private function createBooking($posted) {
		$this->booking_model->insertBooking($this->composeBookingAsAdmin($posted));
		$this->session->set_flashdata('msg', 
			'Új foglalás ('.$this->getDateTime($posted).') elmentve!'
		);
	}
	
	private function saveBooking($id, $posted) {
		$this->booking_model->updateBooking($id, $this->composeBookingAsAdmin($posted));
		$this->session->set_flashdata('msg', 
			'Foglalás ('.$this->getDateTime($posted).') elmentve!'
		);
	}
	
	private function deleteBooking($id, $posted) {
		$this->booking_model->deleteBooking($id);
		$this->session->set_flashdata('msg', 
			'Foglalás ('.$this->getDateTime($posted).') törölve!'
		);
	}
	
	private function getCase($posted) {
		foreach ($posted as $name => $value) {
			if (preg_match('/save/', $name)) {
				return 'save';
			} else if (preg_match('/delete/', $name)) {
				return 'delete';
			}
		}
		
		return null;
	}
	
	private function addDateAndTimestamp($posted) {
		return strtotime($posted['appointment']) + $posted['appointment-hour'] * Utils::hourInSec;
	}
	
	private function getDateTime($posted) {
		return date('Y-m-d H:i', $this->addDateAndTimestamp($posted));
	}
	
	private function composeBookingAsAdmin($posted) {
		return array(
			'status'					=> isset($posted['status']) ? $posted['status'] : '',
			'appointment' 		=> $this->addDateAndTimestamp($posted),
			'book_fname' 			=> $posted['book-fname'],
			'book_sname' 			=> $posted['book-sname'],
			'payment_option' 	=> $posted['payment-option'],
			'email' 					=> $posted['email'],
			'phone' 					=> $posted['phone'],
			'tax_number' 			=> $posted['tax-number'],
			'bill_fname' 			=> $posted['bill-fname'],
			'bill_sname'	 		=> $posted['bill-sname'],
			'zip' 						=> $posted['zip'],
			'city' 						=> $posted['city'],
			'street'					=> $posted['street'],
			'house' 					=> $posted['house'],
			'booking_date' 		=> time()
		);
	}
	
}