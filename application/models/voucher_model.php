<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VoucherStatuses {
    const Active = 'active';
    const AlwaysActive = 'always_active';
    const Used = 'used';
}

class Voucher_model extends CI_Model {

  public function getVoucher($code) {
    $query = $this->db->get_where('vouchers', array('code' => $code));

    if ($query->num_rows != 0) {
      $result = $query->result();
      return $result[0];
    } else
      return null;
  }

  public function getVoucherByID($id) {
    $query = $this->db->get_where('vouchers', array('id' => $id));

    if ($query->num_rows != 0) {
      $result = $query->result();
      return $result[0];
    } else
      return null;   
  }

  public function getVouchers() {
    $vouchers = $this->db->get('vouchers');
    return $vouchers->result();
  }

  public function getNewUniqueVoucher($price) {
    $voucher = $this->composeVoucher($price);

    while (!$this->isUniqueCode($voucher['code'])) {
      $voucher = $this->composeVoucher($price);
    }

    return $voucher;
  }

  public function insertVoucher($voucher) {
    $this->db->insert('vouchers', $voucher);
  }

  public function activate($voucher) {
    $this->changeStatus($voucher->code, VoucherStatuses::Used);
  }

  private function changeStatus($code, $newStatus) {
    $this->db->set('status', $newStatus);
    $this->db->where('code', $code);
    $this->db->update('vouchers');
  }

  public function composeVoucher($price) {
    $voucher = array(
      'code' => $this->generateCode(time()),
      //'status' => 'active',
      'discounted_price' => $price,
      'create_date' => time()
    );

    return $voucher;
  }

  public function isUniqueCode($code) {
    $query = $this->db->get_where('vouchers', array('code' => $code));
    return $query->num_rows == 0;
  }

  public function isAvailable($voucher) {
    return isset($voucher) && ($voucher->status == VoucherStatuses::Active || $voucher->status == VoucherStatuses::AlwaysActive);
  }

  public function isActive($voucher) {
    return isset($voucher) && $voucher->status == VoucherStatuses::Active;
  }

  private function generateCode($timestamp) {
    return strtoupper(strrev(hash('crc32b', $timestamp + rand())));
  }

}