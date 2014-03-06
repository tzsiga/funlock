<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model {

  public function bookingLimit() {
    return $this->getValueByKey('booking_limit');
  }

  public function specialVoucher() {
    return $this->getValueByKey('special_voucher');
  }

  public function adminEmails() {
    return $this->getValueByKey('admin_emails');
  }

  private function getValueByKey($key) {
    $row = $this->db->get_where('config', array('option_name' => $key))->result();
    return $row[0]->value;
  }

}