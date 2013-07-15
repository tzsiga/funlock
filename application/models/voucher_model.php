<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_model extends CI_Model {

  public function getVouchers() {
    $vouchers = $this->db->get('vouchers');
    return $vouchers->result();
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
	
}