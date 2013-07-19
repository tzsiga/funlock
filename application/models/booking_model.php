<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model {

  private function fetchBookingQuery($query) {
    $bookings = array();

    foreach ($query->result() as $row)
      $bookings[$row->appointment] = array(
        'id' => $row->id,
        'payment-option' => $row->payment_option,
        'client' => $row->book_fname.' '.$row->book_sname,
        'status' => $row->status
      );

    return $bookings;
  }

  public function getAllBookings() {
    return $this->fetchBookingQuery($this->db->query('
      SELECT *
      FROM bookings
      ORDER BY appointment ASC'
    ));
  }

  public function getBooking($id) {
    $booking = $this->db->get_where('bookings', array('id' => $id))->result();
    return $booking[0];
  }

  public function getBookingsInRange($start) {
    $rangeLength = Utils::weekInSec - (time() - Utils::getLastMonday(time()));

    return $this->fetchBookingQuery($this->db->query('
      SELECT *
      FROM bookings
      WHERE appointment > '.Utils::getLastMonday($start).'
      AND appointment < '.($start + $rangeLength).'
      ORDER BY appointment ASC'
    ));
  }

  public function insertBooking($booking) {
    $this->db->insert('bookings', $booking);
  }

  public function updateBooking($id, $booking) {
    $this->db->where('id', $id);
    $this->db->update('bookings', $booking);
  }

  public function deleteBooking($id) {
    $this->db->delete('bookings', array('id' => $id));
  }

  public function getBookingLimit() {
    $query = $this->db->query("
      SELECT value
      FROM config
      WHERE option_name = 'booking_limit'
    ");
    $result = $query->result();

    return $result[0]->value;
  }

  public function composeBooking($posted, $voucher = null) {
    return array(
      'appointment'     => strtotime($posted['appointment']),
      'voucher_id'      => isset($voucher) ? $voucher->id : null,
      'book_fname'      => $posted['book-fname'],
      'book_sname'      => $posted['book-sname'],
      'payment_option'  => $posted['payment-option'],
      'email'           => $posted['email'],
      'phone'           => $posted['phone'],
      'tax_number'      => $posted['tax-number'],
      'bill_fname'      => $posted['bill-fname'],
      'bill_sname'      => $posted['bill-sname'],
      'zip'             => $posted['zip'],
      'city'            => $posted['city'],
      'street'          => $posted['street'],
      'house'           => $posted['house'],
      'booking_date'    => time()
    );
  }

  public function composeBookingAsAdmin($posted) {
    return array(
      'status'          => isset($posted['status']) ? $posted['status'] : '',
      'appointment'     => $this->addDateAndTimestamp($posted),
      'book_fname'      => $posted['book-fname'],
      'book_sname'      => $posted['book-sname'],
      'payment_option'  => $posted['payment-option'],
      'email'           => $posted['email'],
      'phone'           => $posted['phone'],
      'tax_number'      => $posted['tax-number'],
      'bill_fname'      => $posted['bill-fname'],
      'bill_sname'      => $posted['bill-sname'],
      'zip'             => $posted['zip'],
      'city'            => $posted['city'],
      'street'          => $posted['street'],
      'house'           => $posted['house'],
      'booking_date'    => time()
    );
  }

  public function addDateAndTimestamp($posted) {
    return strtotime($posted['appointment']) + $posted['appointment-hour'] * Utils::hourInSec;
  }

  public function getNumberOfSuccessfulBookings() {
    if (!$this->session->all_userdata()) {
      $this->session->set_userdata(array('number-of-bookings' => 0));
    }

    return $this->session->userdata('number-of-bookings');
  }

  public function incSuccessfulBookings($n = 1) {
    $this->session->set_userdata(array(
      'number-of-bookings' => $this->getNumberOfSuccessfulBookings() + $n
    ));
  }

}