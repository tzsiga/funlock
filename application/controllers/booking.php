<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

	public function index() {
		$this->load->view('booking/booking', array('reserved_dates' => $this->get_appointments(time())));
	}

	private function get_appointments($from) {
		// only check appointments in cursor range
		$query = $this->db->query('SELECT * FROM bookings WHERE appointment > '.Utils::monday($from).' AND appointment < '.($from + Utils::week).' ORDER BY appointment ASC');
		
		$reserved_dates = array();
		
		foreach ($query->result() as $row) {
			$reserved_dates[$row->appointment] = array(
				'id' => $row->id
			);
		}
		
		return $reserved_dates;
	}
	
	private function get_booking_limit() {
		$query = $this->db->query("SELECT value FROM config WHERE option_name = 'booking_limit'");
		$result = $query->result();
		
		return $result[0]->value;
	}
	
	private function get_user_booking_num() {
		if (!$this->session->all_userdata()) {
			$this->session->set_userdata(array('number_of_bookings' => 0));
		}
		
		return $this->session->userdata('number_of_bookings');
	}
	
	private function generate_booking_code($timestamp) {
		return strtoupper(strrev(dechex($timestamp)));
	}
	
	public function generate_table() {
		if ($this->input->is_ajax_request()) {
			$ref_time = $this->input->get('ref_time');
			$selected_appointment = $this->input->get('selected_appointment');
			
			$this->load->view('booking/calendar', array('reserved_dates' => $this->get_appointments($ref_time), 'ref_time' => $ref_time, 'selected_appointment' => $selected_appointment));
		}
	}

	public function generate_form() {
		if ($this->input->is_ajax_request()) {
			$this->load->view('booking/form');
		}
	}

	public function add_appointment() {
		if ($this->input->is_ajax_request()) {
			if ($this->get_user_booking_num() < $this->get_booking_limit()) {
				$posted = $this->input->post();
				
				if ($posted) {
					$this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');
					$this->form_validation->set_rules('book_fname', '"Foglaló vezetékneve"', 'required|xss_clean');
					$this->form_validation->set_rules('book_sname', '"Foglaló keresztneve"', 'required|xss_clean');
					$this->form_validation->set_rules('phone', '"Telefon"', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('eula', '"Szerződés feltételei"', 'required|xss_clean');
					$this->form_validation->set_rules('email', '"Email"', 'required|xss_clean|valid_email');
					$this->form_validation->set_rules('zip', '"Irányítószám"', 'required|xss_clean|numeric|exact_length[4]');
					$this->form_validation->set_rules('city', '"Város"', 'required|xss_clean');
					$this->form_validation->set_rules('street', '"Utca"', 'required|xss_clean');
					$this->form_validation->set_rules('house', '"Házszám"', 'required|xss_clean');
					
					if (isset($posted['billing'])) {
						$this->form_validation->set_rules('tax_number', '"Adószám"', 'required|xss_clean|numeric');
						$this->form_validation->set_rules('bill_fname', '"Számlázási vezetéknév"', 'required|xss_clean');
						$this->form_validation->set_rules('bill_sname', '"Számlázási keresztnév"', 'required|xss_clean');
					}
					
					$is_success = false;
					
					if ($this->form_validation->run() == true) {
						$this->session->set_userdata(array('number_of_bookings' => $this->get_user_booking_num() + 1));
					
						$data = array(
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
						
						$this->db->insert('bookings', $data);
						
						// success
						if ($posted['payment_option'] == 'cache') {
							$this->load->view('booking/form_success_cache');
						} else if ($posted['payment_option'] == 'card') {
							$this->load->view('booking/form_success_card', array('code' => $this->generate_booking_code(strtotime($posted['appointment']))));
						}
					} else {
						$this->load->view('booking/form', array('posted' => $posted));
					}
				} else {
					$this->load->view('booking/form', array('posted' => $posted));
				}
			} else {
				// booking limit reached!
				$this->load->view('booking/form_fail_limit');
			}
		}
	}
	
	// admin functions ----------------------------------------------------------
	
	public function add() {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$posted = $this->input->post();
			
			if ($posted) {
				$this->form_validation->set_rules('book_fname', '"Foglaló vezetékneve"', 'required|xss_clean');
				$this->form_validation->set_rules('book_sname', '"Foglaló keresztneve"', 'required|xss_clean');
				$this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');
				$this->form_validation->set_rules('payment_option', '"Fizetés ..."', 'required|xss_clean');
				$this->form_validation->set_rules('booking_date', '"Foglalás időpontja"', 'required|xss_clean');
				
				if ($this->form_validation->run() == true) {
					$data = array(
						'book_fname' 			=> $posted['book_fname'],
						'book_sname' 			=> $posted['book_sname'],
						'appointment' 		=> strtotime($posted['appointment']) + $posted['appointment_hour'] * Utils::hour,
						'payment_option' 	=> $posted['payment_option'],
						'bill_fname'	 		=> $posted['bill_fname'],
						'bill_sname' 			=> $posted['bill_sname'],
						'email' 					=> $posted['email'],
						'phone' 					=> $posted['phone'],
						'zip' 						=> $posted['zip'],
						'city'						=> $posted['city'],
						'street'					=> $posted['street'],
						'house'						=> $posted['house'],
						'tax_number' 			=> $posted['tax_number'],
						'comment' 				=> $posted['comment'],
						'notes' 					=> $posted['notes'],
						'booking_date'	 	=> strtotime($posted['booking_date'])
					);
					
					$this->db->insert('bookings', $data);
					$this->session->set_flashdata('msg', 'Új foglalás ('.date('Y-m-d H:i', $data['appointment']).') elmentve!');
					redirect('admin/index', 'refresh');
				}
			}
			
			$this->load->view('booking/add', array('posted' => $posted));
		}
	}
	
	public function edit_list() {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			//$where = ' WHERE appointment > '.time();
			$query = $this->db->query('SELECT * FROM bookings ORDER BY appointment ASC');
			$reserved_dates = array();
			
			foreach ($query->result() as $row) {
				$reserved_dates[$row->appointment] = array(
					'id'	 							=> $row->id,
					'client'	 					=> $row->book_fname.' '.$row->book_sname,
					'payment_option' 		=> $row->payment_option
				);
			}

			$this->load->view('booking/edit_list', array('reserved_dates' => $reserved_dates));
		}
	}
	
	public function edit($id) {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$posted = $this->input->post();
			
			if ($posted) {
				$this->form_validation->set_rules('book_fname', '"Foglaló vezetékneve"', 'required|xss_clean');
				$this->form_validation->set_rules('book_sname', '"Foglaló keresztneve"', 'required|xss_clean');
				$this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');
				$this->form_validation->set_rules('payment_option', '"Fizetés ..."', 'required|xss_clean');
				$this->form_validation->set_rules('booking_date', '"Foglalás időpontja"', 'required|xss_clean');

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
						$data = array(
							'book_fname' 			=> $posted['book_fname'],
							'book_sname' 			=> $posted['book_sname'],
							'appointment' 		=> strtotime($posted['appointment']) + $posted['appointment_hour'] * Utils::hour,
							'payment_option' 	=> $posted['payment_option'],
							'bill_fname' 			=> $posted['bill_fname'],
							'bill_sname' 			=> $posted['bill_sname'],
							'email' 					=> $posted['email'],
							'phone' 					=> $posted['phone'],
							'zip' 						=> $posted['zip'],
							'city'						=> $posted['city'],
							'street'					=> $posted['street'],
							'house'						=> $posted['house'],
							'tax_number' 			=> $posted['tax_number'],
							'comment' 				=> $posted['comment'],
							'notes' 					=> $posted['notes'],
							'booking_date' 		=> strtotime($posted['booking_date'])
						);
						
						$this->db->where('id', $id);
						$this->db->update('bookings', $data);
						$this->session->set_flashdata('msg', 'Foglalás ('.date('Y-m-d H:i', $data['appointment']).') elmentve!');
						redirect('booking/edit_list', 'refresh');
					} else if ($case === 'delete') {
						$this->db->delete('bookings', array('id' => $id));
						$this->session->set_flashdata('msg', 'Foglalás ('.$posted['appointment'].') törölve!');
						redirect('booking/edit_list', 'refresh');
					}
				}
			}

			$booking = $this->db->get_where('bookings', array('id' => $id))->result();
			$this->load->view('booking/edit', array('booking' => $booking[0]));			
		}
	}

}