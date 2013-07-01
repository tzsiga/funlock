<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function login() {
		$posted = $this->input->post();
		
		if ($posted) {
			$this->form_validation->set_rules('given-password', '"Jelszó"', 'required|xss_clean');

			if ($this->form_validation->run() == true) {
				$query = $this->db->query("SELECT value FROM config WHERE option_name = 'admin_password'");
				$hashedPassword = $query->row()->value;
				
				if ($hashedPassword == do_hash($posted['given-password'])) {
					$this->session->set_userdata(array('login-state' => 'logged-in'));
					$this->session->set_flashdata('msg', 'Sikeres bejelentkezés!');
					redirect('/admin', 'refresh');
				} else {
					$this->session->set_flashdata('msg', 'Hibás jelszó!');
					redirect('/admin/login', 'refresh');
				}
			}
		}

		$this->load->view('admin/login');
	}

	public function index() {
		if ($this->session->userdata('login-state') != 'logged-in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$this->load->view('admin/index');
		}
	}

	public function logout() {
		$this->session->unset_userdata('login-state');
		$this->session->set_flashdata('msg', 'Sikeres kijelentkezés!');
		redirect('/admin/login', 'refresh');
	}

	public function changePassword() {
		if ($this->session->userdata('login-state') != 'logged-in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$posted = $this->input->post();
			
			if ($posted) {
				$this->form_validation->set_rules('current_password', '"Régi jelszó"', 'required|xss_clean');
				$this->form_validation->set_rules('new_password_1', '"Új jelszó"', 'required|xss_clean|min_length[5]|max_length[20]');
				$this->form_validation->set_rules('new_password_2', '"Új jelszó újra"', 'required|xss_clean|matches[new_password_1]');

				if ($this->form_validation->run() == true) {
					$query = $this->db->query("SELECT value FROM config WHERE option_name = 'admin_password'");
					$hashedPassword = $query->row()->value;
					
					if ($hashedPassword === do_hash($posted['current_password'])) {
						$this->db->query("UPDATE config SET value = '".do_hash($posted['new_password_1'])."' WHERE option_name = 'admin_password'");
						$this->session->set_flashdata('msg', 'Jelszó megváltoztatva!');
						redirect('/admin', 'refresh');
					} else if ($this->input->post('current_password')) {
						$this->session->set_flashdata('msg', 'Hibás jelenlegi jelszó!');
						redirect('/admin/changePassword', 'refresh');
					}
				}
			}
			
			$this->load->view('admin/change_password');
		}
	}
	
	public function changeLimit() {
		if ($this->session->userdata('login-state') != 'logged-in') {
			$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
			redirect('/admin/login', 'refresh');
		} else {
			$currentLimit = $this->booking_model->getBookingLimit();
			$posted = $this->input->post();
			
			if ($posted) {
				$this->form_validation->set_rules('limit', '"Foglalási limit"', 'required|xss_clean|numeric|greater_than[0]|less_than[100]');
				
				if ($this->form_validation->run() == true) {
					$this->db->query("UPDATE config SET value = '".$posted['limit']."' WHERE option_name = 'booking_limit'");
					$this->session->set_flashdata('msg', 'Új foglalási limit: '.$posted['limit']);
					redirect('/admin', 'refresh');
				}
			}
			
			$this->load->view('admin/change_limit', array('currentLimit' => $currentLimit));
		}
	}

	public function phpinfo() {
		if ($this->session->userdata('login-state') != 'logged-in') {
			redirect('/admin/login', 'refresh');
		} else {
			phpinfo();
		}
	}
	
}