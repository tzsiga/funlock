<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function isLoggedIn() {
		return $this->session->userdata('login-state') == 'logged-in';
	}
	
	public function isCorrectPassword($password) {
		$query = $this->db->query("SELECT value FROM config WHERE option_name = 'admin_password'");
		$hashedPassword = $query->row()->value;

		return $hashedPassword == do_hash($password);
	}
	
	public function updatePassword($password) {
		$this->db->query("UPDATE config SET value = '".do_hash($password)."' WHERE option_name = 'admin_password'");
	}
	
}