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
    
    if (isset($voucher) && $this->voucher_model->isAvailable($voucher)) {
      if ($this->voucher_model->isActive($voucher))
        $this->voucher_model->activate($voucher);
      
      $this->booking_model->insertBooking($this->booking_model->composeBooking($posted, $voucher));
      $this->loadFormSuccessResult($posted, $voucher);
    } else {      // if voucher code is wrong or used
      $this->booking_model->insertBooking($this->booking_model->composeBooking($posted));
      $this->loadFormSuccessResult($posted);
    }

    $this->sendConfirmationEmail($posted, $voucher);
    $this->booking_model->incSuccessfulBookings();
  }

  private function sendConfirmationEmail($posted, $voucher = null) {
    $this->setEmailDefaultOptions();
    $this->email->to($posted['email']);
    $msg = $this->load->view('email/confirm', array(
      'posted' => $posted,
      'voucher' => $voucher
    ), true);
    $this->email->message($msg);
    $this->email->send();
  }

  private function setEmailDefaultOptions() {
    $admins = array(
      'andras.csernak@funlock.hu',
      'gabor.veress@funlock.hu',
      'kacsoh.gabor@gmail.com',
      'info@funlock.hu',
      'tzsiga@funlock.hu'
    );

    $this->load->library('email');
    $this->email->set_mailtype('html');
    $this->email->from('info@funlock.hu', 'Funlock');
    $this->email->bcc($admins);
    $this->email->subject('Visszaigazolás a foglalásról');
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

  private function setValidationRules($posted = null) {
    $this->form_validation->set_rules('appointment', '"appointment"', 'required|xss_clean|greater_than['.time().']');
    $this->form_validation->set_rules('book-fname', lang('book-fname'), 'required|xss_clean');
    $this->form_validation->set_rules('book-sname', lang('book-sname'), 'required|xss_clean');
    $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean|numeric');
    $this->form_validation->set_rules('email', lang('email'), 'required|xss_clean|valid_email');
    $this->form_validation->set_rules('zip', lang('zip'), 'required|xss_clean|numeric|exact_length[4]');
    $this->form_validation->set_rules('city', lang('city'), 'required|xss_clean');
    $this->form_validation->set_rules('street', lang('street'), 'required|xss_clean');
    $this->form_validation->set_rules('house', lang('house'), 'required|xss_clean');
    $this->form_validation->set_rules('eula', lang('eula'), 'required|xss_clean');

    if (isset($posted['billing'])) {
      $this->form_validation->set_rules('tax-number', lang('tax-number'), 'required|xss_clean|numeric');
      $this->form_validation->set_rules('bill-fname', lang('bill-fname'), 'required|xss_clean');
      $this->form_validation->set_rules('bill-sname', lang('bill-sname'), 'required|xss_clean');
    }
  }

}