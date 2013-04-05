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

	public function add() {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			// call view -> this.add_appointment();
			$this->load->view('booking/add');
		}
	}
	
	public function add_appointment() {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$posted = $this->input->post();
			
			if ($posted) {
				//$this->form_validation->set_rules('title_hu', '"Magyar cím"', 'required|xss_clean');

				if ($this->form_validation->run() == true) {
					$data = array(
						//'title_hu' => $posted['title_hu'],
						//'date' => strtotime($posted['date']),
					);
					$this->db->insert('news', $data);
					$this->session->set_flashdata('msg', 'Új bejegyzés ('.$posted['title_hu'].') elmentve!');
					redirect('news/edit_news_list', 'refresh');
				}
			}

			$this->render_layout('booking/add_article', array('posted' => $posted));
		}
	}
	
	public function edit_list() {
		if ($this->session->userdata('login_state') != 'logged_in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$query = $this->db->query('SELECT * FROM reservations WHERE appointment ORDER BY appointment ASC');
			$reserved_dates = array();
		
			foreach ($query->result() as $row) {
				$reserved_dates[$row->appointment] = array(
					'client'	 		=> $row->forename.' '.$row->surname,
					'billing_id' 		=> $row->billing_id,
					'payment_option' 	=> $row->payment_option
				);
			}

			$this->load->view('booking/edit_list', array('reserved_dates' => $reserved_dates));
		}
	}

}