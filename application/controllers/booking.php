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
				// booking limit reached
				$this->load->view('booking/form_fail_limit');
			} else {
				$posted = $this->input->post();
				
				if (!$posted) {
					// on page load
					$this->load->view('booking/form', array('posted' => $posted));
				} else {
					$this->setValidationRules($posted);
					
					if ($this->form_validation->run() == false) {
						// form validation fail
						$this->load->view('booking/form', array('posted' => $posted));
					} else {
						$this->db->insert('bookings', $this->composeBooking($posted));
						$this->booking_model->increaseSuccessfulBookings();
						
						// success
						if ($posted['payment_option'] == 'cache') {
							$this->load->view('booking/form_success_cache');
						} else if ($posted['payment_option'] == 'card') {
							$this->load->view('booking/form_success_card', array(
								'code' => $this->convertTimestampToBookingCode(strtotime($posted['appointment']))
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
	
	private function convertTimestampToBookingCode($timestamp) {
		return strtoupper(strrev(dechex($timestamp)));
	}
	
	private function setValidationRulesForAdmin() {
		$this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');
		$this->form_validation->set_rules('book_fname', '"Foglaló vezetékneve"', 'required|xss_clean');
		$this->form_validation->set_rules('book_sname', '"Foglaló keresztneve"', 'required|xss_clean');
		$this->form_validation->set_rules('phone', '"Telefon"', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('email', '"Email"', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('zip', '"Irányítószám"', 'required|xss_clean|numeric|exact_length[4]');
		$this->form_validation->set_rules('city', '"Város"', 'required|xss_clean');
		$this->form_validation->set_rules('street', '"Utca"', 'required|xss_clean');
		$this->form_validation->set_rules('house', '"Házszám"', 'required|xss_clean');
	}
	
	private function setValidationRules($posted = null) {
		$this->setValidationRulesForAdmin();
		$this->form_validation->set_rules('eula', '"Szerződés feltételei"', 'required|xss_clean');
		if (isset($posted['billing'])) {
			$this->form_validation->set_rules('tax_number', '"Adószám"', 'required|xss_clean|numeric');
			$this->form_validation->set_rules('bill_fname', '"Számlázási vezetéknév"', 'required|xss_clean');
			$this->form_validation->set_rules('bill_sname', '"Számlázási keresztnév"', 'required|xss_clean');
		}
	}
	
	private function composeBooking($posted) {
		return array(
			'appointment' 		=> strtotime($posted['appointment']),
			'book_fname' 			=> $posted['book_fname'],
			'book_sname' 			=> $posted['book_sname'],
			'payment_option' 	=> $posted['payment_option'],
			'email' 					=> $posted['email'],
			'phone' 					=> $posted['phone'],
			'tax_number' 			=> $posted['tax_number'],
			'bill_fname' 			=> $posted['bill_fname'],
			'bill_sname'	 		=> $posted['bill_sname'],
			'zip' 						=> $posted['zip'],
			'city' 						=> $posted['city'],
			'street'					=> $posted['street'],
			'house' 					=> $posted['house'],
			//'comment' 				=> $posted['comment'],
			'booking_date' 		=> time()
		);
	}
	
	private function composeBookingAsAdmin($posted) {
		$booking = $this->composeBooking($posted);
		$booking['appointment'] = strtotime($posted['appointment']) 
			+ $posted['appointment_hour'] * Utils::hourInSec;
		
		return $booking;
	}
	
	// admin functions ----------------------------------------------------------
	
	public function addBookingAsAdmin($timestamp = 0) {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$posted = $this->input->post();
			
			if ($posted) {
				$this->setValidationRulesForAdmin();
				
				if ($this->form_validation->run() == true) {
					$this->db->insert('bookings', $this->composeBookingAsAdmin($posted));
					$this->session->set_flashdata('msg', 
						'Új foglalás ('.
						date(
							'Y-m-d H:i',
							strtotime($posted['appointment']) + 
							$posted['appointment_hour'] * Utils::hourInSec
						).
						') elmentve!'
					);
					redirect('admin/index', 'refresh');
				}
			}
			
			$this->load->view('booking/admin_add', array(
				'posted' => $posted, 
				'timestamp' => $timestamp
			));
		}
	}
	
	public function editBooking($id) {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$posted = $this->input->post();
			
			if ($posted) {
				$this->setValidationRulesForAdmin();
				
				if ($this->form_validation->run() == true) {
					$case = '';
					
					foreach ($posted as $name => $value) {
						if (preg_match('/save/', $name)) {
							$case = 'save';
						} else if (preg_match('/delete/', $name)) {
							$case = 'delete';
						}
					}
					
					if ($case === 'save') {
						$this->db->where('id', $id);
						$this->db->update('bookings', $this->composeBookingAsAdmin($posted));
						$this->session->set_flashdata('msg', 
							'Foglalás ('.
							date(
								'Y-m-d H:i', 
								strtotime($posted['appointment']) + 
								$posted['appointment_hour'] * Utils::hourInSec
							).
							') elmentve!'
						);
						redirect('booking/editTable', 'refresh');
					} else if ($case === 'delete') {
						$this->db->delete('bookings', array('id' => $id));
						$this->session->set_flashdata('msg', 
							'Foglalás ('.
							date(
								'Y-m-d H:i', 
								strtotime($posted['appointment']) + 
								$posted['appointment_hour'] * Utils::hourInSec
							).
							') törölve!'
						);
						redirect('booking/editTable', 'refresh');
					}
				}
			}
			
			$booking = $this->db->get_where('bookings', array('id' => $id))->result();
			$this->load->view('booking/admin_edit', array('booking' => $booking[0]));			
		}
	}
	
	public function editList() {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$this->load->view('booking/admin_edit_list', array(
				'bookings' => $this->booking_model->getAllBookings()
			));
		}
	}
	
	public function editTable() {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$this->load->view('booking/admin_edit_table', array(
				'bookings' => $this->booking_model->getAllBookings()
			));
		}
	}
	
	public function loadAdminTable() {
		if ($this->input->is_ajax_request()) {
			$headTimestamp = $this->input->get('headTimestamp');
			$this->load->view('booking/admin_table', array(
				'bookings' => $this->booking_model->getBookingsInRange($headTimestamp), 
				'headTimestamp' => $headTimestamp
			));
		}
	}
	
}