<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BookingAdmin extends CI_Controller {

	private function setValidationRulesForAdmin() {
		$this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');
		$this->form_validation->set_rules('book-fname', '"Foglaló vezetékneve"', 'required|xss_clean');
		$this->form_validation->set_rules('book-sname', '"Foglaló keresztneve"', 'required|xss_clean');
	}
	
	private function composeBookingAsAdmin($posted) {
		return array(
			'appointment' 		=> strtotime($posted['appointment']) + $posted['appointment-hour'] * Utils::hourInSec,
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
	
	public function addBookingAsAdmin($timestamp = 0) {
		if ($this->session->userdata('login-state') != 'logged-in') {
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
							$posted['appointment-hour'] * Utils::hourInSec
						).
						') elmentve!'
					);
					redirect('admin/index', 'refresh');
				}
			}
			
			$this->load->view('booking_admin/admin_add', array(
				'posted' => $posted, 
				'timestamp' => $timestamp
			));
		}
	}
	
	public function editBooking($id) {
		if ($this->session->userdata('login-state') != 'logged-in') {
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
								$posted['appointment-hour'] * Utils::hourInSec
							).
							') elmentve!'
						);
						redirect('BookingAdmin/editTable', 'refresh');
					} else if ($case === 'delete') {
						$this->db->delete('bookings', array('id' => $id));
						$this->session->set_flashdata('msg', 
							'Foglalás ('.
							date(
								'Y-m-d H:i', 
								strtotime($posted['appointment']) + 
								$posted['appointment-hour'] * Utils::hourInSec
							).
							') törölve!'
						);
						redirect('BookingAdmin/editTable', 'refresh');
					}
				}
			}
			
			$booking = $this->db->get_where('bookings', array('id' => $id))->result();
			$this->load->view('booking_admin/admin_edit', array('booking' => $booking[0]));			
		}
	}
	
	public function editList() {
		if ($this->session->userdata('login-state') != 'logged-in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$this->load->view('booking_admin/admin_edit_list', array(
				'bookings' => $this->booking_model->getAllBookings()
			));
		}
	}
	
	public function editTable() {
		if ($this->session->userdata('login-state') != 'logged-in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$this->load->view('booking_admin/admin_edit_table', array(
				'bookings' => $this->booking_model->getAllBookings()
			));
		}
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
	
}