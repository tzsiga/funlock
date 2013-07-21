<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'admin.php';

class Voucher extends Admin {

  function __construct() {
    parent::__construct();
    $this->load->model('voucher_model');
  }

  public function index() {
    $this->load->view('voucher/index');
  }

  public function addVoucher() {
    $posted = $this->input->post();

    if ($posted) {
      $this->form_validation->set_rules('number_of_vouchers', '"Voucherek száma"', 'required|xss_clean|numeric|greater_than[0]|less_than[100]');

      if ($this->form_validation->run() == true) {
        $vouchers = array();
        for ($i = 0; $i < $posted['number_of_vouchers']; $i++)
          $vouchers[] = $this->createVoucher($posted['discounted_price']);

        $this->session->set_flashdata('msg', 'Új voucher(ek) létrehozva!<br/>'.$this->getCodes($vouchers));
        redirect('/admin/voucher/add', 'refresh');
      }
    }

    $this->load->view('voucher/add');
  }

  private function createVoucher($price) {
    $newVoucher = $this->voucher_model->getNewUniqueVoucher($price);
    $this->voucher_model->insertVoucher($newVoucher);

    return $newVoucher;
  }

  public function editVouchers() {
    $this->load->view('voucher/edit', array(
      'vouchers' => $this->voucher_model->getVouchers()
    ));
  }

  private function getCodes($vouchers) {
    $msg = '';
    foreach ($vouchers as $voucher)
      $msg .= $voucher['code'].'<br/>';

    return $msg;
  }

}