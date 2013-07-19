<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_model extends CI_Model {

  public function getVouchers() {
    $vouchers = $this->db->get('vouchers');
    return $vouchers->result();
  }

  private function generateCode($timestamp) {
    return strtoupper(strrev(hash('crc32b', $timestamp + rand())));
  }

  public function composeVoucher() {
    $voucher = array(
      'code' => $this->generateCode(time()),
      //'status' => 'active',
      'discounted_price' => 8000,
      'create_date' => time()
    );

    return $voucher;
  }

  public function getUniqueVoucher() {
    $voucher = $this->composeVoucher();

    while (!$this->isUniqueCode($voucher['code'])) {
      $voucher = $this->composeVoucher();
    }

    return $voucher;
  }

  public function isUniqueCode($code) {
    $query = $this->db->get_where('vouchers', array('code' => $code));
    return $query->num_rows == 0;
  }

  public function insertVoucher($voucher) {
    $this->db->insert('vouchers', $voucher);
  }

  public function getVoucherFromCode($code) {
    $query = $this->db->get_where('vouchers', array('code' => $code));
    if ($query->num_rows != 0)
      return $query->row()->value;
    else
      return null;
  }

  public function changeStatus($code, $newStatus) {
    $this->db->set('status', $newStatus);
    $this->db->where('code', $code);
    $this->db->insert('voucher');
  }

}