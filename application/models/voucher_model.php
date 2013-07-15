<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_model extends CI_Model {

  public function getVouchers() {
    $vouchers = $this->db->get('vouchers');
    return $vouchers->result();
  }
	
}