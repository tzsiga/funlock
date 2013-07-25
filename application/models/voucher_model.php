<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VoucherStatuses {
  const Active = 'active';
  const AlwaysActive = 'always_active';
  const Used = 'used';
}

class Voucher_model extends CI_Model {

  public function getVoucherByCode($code) {
    $voucher = $this->db->get_where('vouchers', array('code' => $code))->result();
    return isset($voucher[0]) ? $voucher[0] : null;
  }

  public function getVoucherByID($id) {
    $voucher = $this->db->get_where('vouchers', array('id' => $id))->result();
    return isset($voucher[0]) ? $voucher[0] : null;
  }

  public function getVouchers() {
    $this->db->order_by("create_date", "desc");
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

  public function composeVoucher($price) {
    return array(
      'code' => $this->generateCode(time()),
      'discounted_price' => $price,
      'create_date' => time()
    );
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

  private function changeStatus($code, $newStatus) {
    $this->db->set('status', $newStatus);
    $this->db->where('code', $code);
    $this->db->update('vouchers');
  }

  private function generateCode($timestamp) {
    return strtoupper(strrev(hash('crc32b', $timestamp + rand())));
  }

}