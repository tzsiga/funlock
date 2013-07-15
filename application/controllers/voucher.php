<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'admin.php';

class Voucher extends Admin {

	function __construct() {
		parent::__construct();
		$this->load->model('voucher_model');
	}
  
  public function index() {
    $this->load->view('voucher_admin/index');
  }

	private function generateCode($timestamp) {
		return strtoupper(strrev(hash('adler32', hash('crc32b', $timestamp))));
	}
	
  public function composeVoucher($numberOfVouchers = 1) {
    $voucher = array(
      'code' => $this->generateCode(time()),
      'status' => 'active',
      'create_date' => time()
    );
    
    $this->db->insert('vouchers', $voucher);
    return $voucher;
  }
  
	public function createVoucher() {
    $voucher = $this->composeVoucher();
    $this->session->set_flashdata('msg', 'Új voucher létrehozva!');
    
    $this->load->view('voucher_admin/create', array('new_voucher' => $voucher));
	}
  
  public function listVouchers() {
    $this->load->view('voucher_admin/list', array(
      'vouchers' => $this->voucher_model->getVouchers()
    ));
  }

  public function deleteVouchers() {
    $this->load->view('voucher_admin/delete', array(
      'vouchers' => $this->voucher_model->getVouchers()
    ));
  }
	
}