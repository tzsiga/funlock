<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VoucherStatuses {
  const Active = 'active';
  const AlwaysActive = 'always_active';
  const Used = 'used';
}

class Voucher_model extends CI_Model {

  public function getVoucherByCode($code) {
    $voucher = $this->db->get_where('vouchers', array(
      'LOWER(code)' => strtolower($code)
    ))->result();
    return isset($voucher[0]) ? $voucher[0] : null;
  }

  public function getVoucherByID($id) {
    $voucher = $this->db->get_where('vouchers', array('id' => $id))->result();
    return isset($voucher[0]) ? $voucher[0] : null;
  }

  public function getAll() {
    $this->db->order_by("create_date", "desc");
    $vouchers = $this->db->get('vouchers');
    return $vouchers->result();
  }

  public function getNewUniqueVoucher($posted) {
    $voucher = $this->composeVoucher($posted);

    while (!$this->isUniqueCode($voucher['code'])) {
      $voucher = $this->composeVoucher($posted);
    }

    return $voucher;
  }

  public function insertVoucher($voucher) {
    $this->db->insert('vouchers', $voucher);
  }

  public function activate($voucher) {
    $this->changeStatus($voucher->code, VoucherStatuses::Used);
  }

  public function composeVoucher($posted) {
    return array(
      'code' => isset($posted['code']) ? $posted['code'] : $this->generateCode(time()),
      'discounted_price' => $posted['discounted_price'],
      'create_date' => isset($posted['create_date']) ? $posted['create_date'] : time(),
      'label' => $posted['label']
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

  public function updateVoucher($id, $voucher) {
    $this->db->where('id', $id);
    $this->db->update('vouchers', $voucher);
  }

  public function deleteVoucher($id) {
    $this->db->delete('vouchers', array('id' => $id));
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