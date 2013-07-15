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
  
  public function addVoucher() {
		$posted = $this->input->post();
		
		if ($posted) {
			$this->form_validation->set_rules('number_of_vouchers', '"Voucherek száma"', 'required|xss_clean|numeric|greater_than[0]|less_than[100]');
			
			if ($this->form_validation->run() == true) {
        $vouchers = array();
        for ($i = 0; $i < $posted['number_of_vouchers']; $i++)
          $vouchers[] = $this->createVoucher();
        $this->session->set_flashdata('msg', 'Új voucherek létrehozva!<br/>'.print_r($vouchers, true));
        redirect('/admin/voucher/add', 'refresh');
      }
    }
    
    $this->load->view('voucher_admin/add');
  }
  
	public function createVoucher() {
    $newVoucher = $this->voucher_model->composeVoucher();
    $this->voucher_model->insertVoucher($newVoucher);
    
    return $newVoucher;
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
    $this->session->set_flashdata('msg', 'Voucher törölve!');
  }
	
}