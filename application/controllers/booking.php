<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

	public function index() {
		$this->load->view('booking/booking', array('reserved_dates' => $this->get_appointments(time())));
	}
	
	// called by jq.ajax()
	public function generate_table($ref_time) {
		$this->load->view('booking/calendar', array('reserved_dates' => $this->get_appointments($ref_time), 'ref_time' => $ref_time));
	}
	
	private function get_appointments($from) {
		// only check if appointments in cursor range
		$query = $this->db->query('SELECT * FROM bookings WHERE appointment > '.Utils::monday($from).' AND appointment < '.($from + Utils::week).' ORDER BY appointment ASC');
		
		$reserved_dates = array();
		
		foreach ($query->result() as $row) {
			$reserved_dates[$row->appointment] = array(
				'id' => $row->id
			);
		}
		
		return $reserved_dates;
	}
	
	public function add_appointment() {
		$posted = $this->input->post();
		
		if ($posted) {
			$this->form_validation->set_rules('book_fname', '"Foglaló vezetékneve"', 'required|xss_clean');
			$this->form_validation->set_rules('book_sname', '"Foglaló keresztneve"', 'required|xss_clean');
			$this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');
			$this->form_validation->set_rules('payment_option', '"Fizetés ..."', 'required|xss_clean');
			$this->form_validation->set_rules('booking_date', '"Foglalás időpontja"', 'required|xss_clean');

			if ($this->form_validation->run() == true) {
				$data = array(
					'book_fname' 		=> $posted['book_fname'],
					'book_sname' 		=> $posted['book_sname'],
					'appointment' 		=> strtotime($posted['appointment']),
					'payment_option' 	=> $posted['payment_option'],
//					'bill_fname' 		=> $posted['bill_fname'],
//					'bill_sname' 		=> $posted['bill_sname'],
//					'email' 			=> $posted['email'],
//					'zip' 				=> $posted['zip'],
//					'tax_number' 		=> $posted['tax_number'],
//					'comment' 			=> $posted['comment'],
//					'notes' 			=> $posted['notes'],
					'booking_date' 		=> strtotime($posted['booking_date'])
				);
				
				$this->db->insert('bookings', $data);
				$this->session->set_flashdata('msg', 'Új foglalás ('.date('Y-m-d H:i', $data['appointment']).') elmentve!');
				//redirect('booking/booking', 'refresh');
			}
		}

		$this->index();
		//$this->load->view('booking/booking', array('posted' => $posted));
		//$this->load->view('booking/booking', array('posted' => $posted));
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
						'book_fname' 		=> $posted['book_fname'],
						'book_sname' 		=> $posted['book_sname'],
						'appointment' 		=> strtotime($posted['appointment']) + $posted['appointment_hour'] * Utils::hour,
						'payment_option' 	=> $posted['payment_option'],
						'bill_fname' 		=> $posted['bill_fname'],
						'bill_sname' 		=> $posted['bill_sname'],
						'email' 			=> $posted['email'],
						'zip' 				=> $posted['zip'],
						'tax_number' 		=> $posted['tax_number'],
						'comment' 			=> $posted['comment'],
						'notes' 			=> $posted['notes'],
						'booking_date' 		=> strtotime($posted['booking_date'])
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
					'id'	 			=> $row->id,
					'client'	 		=> $row->book_fname.' '.$row->book_sname,
					'payment_option' 	=> $row->payment_option
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
							'book_fname' 		=> $posted['book_fname'],
							'book_sname' 		=> $posted['book_sname'],
							'appointment' 		=> strtotime($posted['appointment']) + $posted['appointment_hour'] * Utils::hour,
							'payment_option' 	=> $posted['payment_option'],
							'bill_fname' 		=> $posted['bill_fname'],
							'bill_sname' 		=> $posted['bill_sname'],
							'email' 			=> $posted['email'],
							'zip' 				=> $posted['zip'],
							'tax_number' 		=> $posted['tax_number'],
							'comment' 			=> $posted['comment'],
							'notes' 			=> $posted['notes'],
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