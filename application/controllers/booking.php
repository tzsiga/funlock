<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

	public function index() {
		$this->load->view('booking/booking', array(
			'bookings' => $this->booking_model->getBookingsInRange(time()), 
			'numberOfSuccessfulBookings' => $this->booking_model->getNumberOfSuccessfulBookings(), 
			'bookingLimit' => $this->booking_model->getBookingLimit()
		));
	}
	
	public function addBooking() {
		if ($this->input->is_ajax_request()) {
			if ($this->booking_model->getNumberOfSuccessfulBookings() >= $this->booking_model->getBookingLimit()) {
				$this->load->view('booking/form_fail_limit');
			} else {
				$posted = $this->input->post();
				
				if (!$posted) {			// on page load
					$this->load->view('booking/form', array('posted' => $posted));
				} else {
					$this->setValidationRules($posted);
					
					if ($this->form_validation->run() == false) {
						$this->load->view('booking/form', array('posted' => $posted));
					} else {
						$this->booking_model->insertBooking($this->booking_model->composeBooking($posted));
						$this->booking_model->incSuccessfulBookings();
						
						if ($posted['payment-option'] == 'cache') {
							$this->load->view('booking/form_success_cache');
						} else if ($posted['payment-option'] == 'card') {
							$this->load->view('booking/form_success_card', array(
								'code' => $this->convertTimeToBookingCode($posted['appointment'])
							));
						}
					}
				}
			}
		}
	}
	
	public function loadBookingTable() {
		if ($this->input->is_ajax_request()) {
			$this->load->view('booking/table', array(
				'bookings' => $this->booking_model->getBookingsInRange($this->input->get('headTimestamp')),
				'headTimestamp' => $this->input->get('headTimestamp'),
				'selectedAppointment' => $this->input->get('selectedAppointment')
			));
		}
	}
	
	public function loadBookingForm() {
		if ($this->input->is_ajax_request()) {
			$this->load->view('booking/form');
		}
	}
	
	private function convertTimeToBookingCode($time) {
		return strtoupper(strrev(dechex(strtotime($time))));
	}
	
	private function setValidationRules($posted = null) {
		$this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');
		$this->form_validation->set_rules('book-fname', '"Foglaló vezetékneve"', 'required|xss_clean');
		$this->form_validation->set_rules('book-sname', '"Foglaló keresztneve"', 'required|xss_clean');
		$this->form_validation->set_rules('phone', '"Telefon"', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('email', '"Email"', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('zip', '"Irányítószám"', 'required|xss_clean|numeric|exact_length[4]');
		$this->form_validation->set_rules('city', '"Város"', 'required|xss_clean');
		$this->form_validation->set_rules('street', '"Utca"', 'required|xss_clean');
		$this->form_validation->set_rules('house', '"Házszám"', 'required|xss_clean');
		$this->form_validation->set_rules('eula', '"Szerződés feltételei"', 'required|xss_clean');

		if (isset($posted['billing'])) {
			$this->form_validation->set_rules('tax-number', '"Adószám"', 'required|xss_clean|numeric');
			$this->form_validation->set_rules('bill-fname', '"Számlázási vezetéknév"', 'required|xss_clean');
			$this->form_validation->set_rules('bill-sname', '"Számlázási keresztnév"', 'required|xss_clean');
		}
	}

	
}