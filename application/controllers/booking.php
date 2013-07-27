<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

  public function index() {
    $this->load->view('booking/booking', array(
      'bookings' => $this->booking_model->getBookingsInRange(time()),
      'numberOfSuccessfulBookings' => $this->booking_model->getNumberOfSuccessfulBookings(),
      'bookingLimit' => $this->booking_model->getBookingLimit()
    ));
  }

  public function addBooking() {
    if ($this->input->is_ajax_request()) {
      if ($this->booking_model->getNumberOfSuccessfulBookings() >= $this->booking_model->getBookingLimit()) {
        $this->load->view('booking/form_fail_limit');
      } else {
        $posted = $this->input->post();

        if (!$posted) {     // on page load
          $this->load->view('booking/form', array('posted' => $posted));
        } else {
          $this->processPosted($posted);
        }
      }
    }
  }

  private function processPosted($posted) {
    $this->setValidationRules($posted);

    if ($this->form_validation->run() == false) {
      $this->load->view('booking/form', array('posted' => $posted));
    } else {
      $this->onSuccessfulBooking($posted);
    }
  }

  private function onSuccessfulBooking($posted) {
    $voucher = $this->voucher_model->getVoucherByCode($posted['code']);
    
    if ($this->voucher_model->isAvailable($voucher)) {
      if ($this->voucher_model->isActive($voucher))
        $this->voucher_model->activate($voucher);
      
      $this->booking_model->insertBooking($this->booking_model->composeBooking($posted, $voucher));
      $this->loadFormSuccessResult($posted, $voucher);
    } else {      // if voucher code is wrong or used
      $this->booking_model->insertBooking($this->booking_model->composeBooking($posted));
      $this->loadFormSuccessResult($posted);
    }

    //$this->sendConfirmationEmail($posted, $voucher);
    $this->booking_model->incSuccessfulBookings();
  }

  private function sendConfirmationEmail($posted, $voucher = null) {
    $this->load->library('email');

    $this->email->from('your@example.com', 'Your Name');
    $this->email->to('tzsiga@gmail.com');
    //$this->email->bcc('them@their-example.com'); 

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');

    $this->email->send();
  }

  private function loadFormSuccessResult($posted, $voucher = null) {
    if ($posted['payment-option'] == 'cache') {
      $this->load->view('booking/form_success_cache', array('voucher' => $voucher));
    } else if ($posted['payment-option'] == 'card') {
      $this->load->view('booking/form_success_card', array(
        'code' => $this->booking_model->convertTimeToBookingCode($posted['appointment']),
        'voucher' => $voucher
      ));
    }
  }

  public function loadBookingTable() {
    if ($this->input->is_ajax_request()) {
      $this->load->view('booking/table', array(
        'bookings' => $this->booking_model->getBookingsInRange($this->input->get('headTimestamp')),
        'headTimestamp' => $this->input->get('headTimestamp'),
        'selectedAppointment' => $this->input->get('selectedAppointment')
      ));
    }
  }

  public function loadBookingForm() {
    if ($this->input->is_ajax_request()) {
      $this->load->view('booking/form');
    }
  }

  private function setValidationRules($posted = null) {
    $this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean|greater_than['.time().']');
    $this->form_validation->set_rules('book-fname', '"Vezetéknév"', 'required|xss_clean');
    $this->form_validation->set_rules('book-sname', '"Keresztnév"', 'required|xss_clean');
    $this->form_validation->set_rules('phone', '"Telefon"', 'required|xss_clean|numeric');
    $this->form_validation->set_rules('email', '"Email"', 'required|xss_clean|valid_email');
    $this->form_validation->set_rules('zip', '"Irányítószám"', 'required|xss_clean|numeric|exact_length[4]');
    $this->form_validation->set_rules('city', '"Város"', 'required|xss_clean');
    $this->form_validation->set_rules('street', '"Utca"', 'required|xss_clean');
    $this->form_validation->set_rules('house', '"Házszám"', 'required|xss_clean');
    $this->form_validation->set_rules('eula', '"Elfogadom a feltételeket"', 'required|xss_clean');

    if (isset($posted['billing'])) {
      $this->form_validation->set_rules('tax-number', '"Adószám"', 'required|xss_clean|numeric');
      $this->form_validation->set_rules('bill-fname', '"Számlázási vezetéknév"', 'required|xss_clean');
      $this->form_validation->set_rules('bill-sname', '"Számlázási keresztnév"', 'required|xss_clean');
    }
  }


}