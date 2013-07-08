<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->redirectIfGuest('/admin/login');
	}
	
	public function login() {
		$posted = $this->input->post();
		
		if ($posted) {
			$this->form_validation->set_rules('given-password', '"Jelszó"', 'required|xss_clean');

			if ($this->form_validation->run() == true) {
				if ($this->admin_model->isCorrectPassword($posted['given-password'])) {
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
	
	public function logout() {
		$this->session->unset_userdata('login-state');
		$this->session->set_flashdata('msg', 'Sikeres kijelentkezés!');
		redirect('/admin/login', 'refresh');
	}
	
	public function index() {
		$this->load->view('admin/index');
	}
	
	private function redirectIfGuest($destination) {
		if ($this->router->fetch_method() != 'login') {
			if (!$this->admin_model->isLoggedIn()) {
				$this->session->set_flashdata('msg', 'Be kell jelentkezni!');
				redirect($destination, 'refresh');
			}
		}
	}

}