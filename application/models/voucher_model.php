<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_model extends CI_Model {

  public function getVouchers() {
    $vouchers = $this->db->get('vouchers');
    return $vouchers->result();
  }
	
	private function generateCode($timestamp) {
		return strtoupper(strrev(hash('adler32', hash('crc32b', $timestamp))));
	}
  
  public function composeVoucher() {
    $voucher = array(
      'code' => $this->generateCode(time()),
      'status' => 'active',
      'create_date' => time()
    );
    
    return $voucher;
  }
  
  public function insertVoucher($voucher) {
    $this->db->insert('vouchers', $voucher);
  }
	
}