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
  
	public function createVoucher() {
    $voucher = $this->voucher_model->composeVoucher();
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