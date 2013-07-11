<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher extends CI_Controller {

	private function generateCode($timestamp) {
		return strtoupper(strrev(hash('adler32', hash('crc32b', $timestamp))));
	}
	
	public function createVoucher() {
		if ($this->session->userdata('login-state') != 'logged-in') {
			redirect('/admin/login', 'refresh');
		} else {
			$data = array(
				'code' => $this->generateCode(time()),
				'status' => 'active',
				'create_date' => time()
			);
			
			$vouchers = $this->db->get('vouchers');
			
			$this->db->insert('vouchers', $data);
			$this->session->set_flashdata('msg', 'Új voucher létrehozva!');
			
			$this->load->view('voucher_admin/voucher', array('new_voucher' => $data, 'vouchers' => $vouchers));
		}
	}
	
}