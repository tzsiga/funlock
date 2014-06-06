<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

  public function index() {
    $this->load->view('booking/booking', array(
      'bookings' => $this->booking_model->getBookingsInRange(time()),
      'numberOfSuccessfulBookings' => $this->booking_model->getNumberOfSuccessfulBookings(),
      'bookingLimit' => $this->config_model->bookingLimit()
    ));
  }

  public function addBooking() {
    if ($this->input->is_ajax_request()) {
      if ($this->booking_model->getNumberOfSuccessfulBookings() >= $this->config_model->bookingLimit()) {
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

  private function setValidationRules($posted = null) {
    $this->form_validation->set_rules('appointment', '"appointment"', 'required|xss_clean|greater_than['.time().']');
    $this->form_validation->set_rules('book-fname', lang('book-fname'), 'required|xss_clean');
    $this->form_validation->set_rules('book-sname', lang('book-sname'), 'required|xss_clean');
    $this->form_validation->set_rules('payment-option', lang('payment-option'), 'required|xss_clean');
    $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean|numeric');
    $this->form_validation->set_rules('email', lang('email'), 'required|xss_clean|valid_email');
    $this->form_validation->set_rules('zip', lang('zip'), 'required|xss_clean|numeric');
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

  private function onSuccessfulBooking($posted) {
    $voucher = $this->voucher_model->getVoucherByCode($posted['code']);

    if (isset($voucher) && $this->voucher_model->isAvailable($voucher)) {
      if ($this->voucher_model->isActive($voucher))
        $this->voucher_model->activate($voucher);
    }

    $newBookingId = $this->booking_model->insertBooking($this->booking_model->composeBooking($posted, $voucher));
    $this->loadFormSuccessResult($posted, $voucher);

    $this->load->library('email');
    $this->sendConfirmationEmail($posted, $voucher);
    $this->sendReportingEmail($posted, $voucher, $newBookingId);

    $this->booking_model->incSuccessfulBookings();
  }

  private function loadFormSuccessResult($posted, $voucher = null) {
    if (isset($voucher) && $voucher->code == $this->config_model->specialVoucher()) {
      $this->load->view('booking/form_success_special');
    } else {
      if ($posted['payment-option'] == 'cache') {
        $this->load->view('booking/form_success_cache', array('voucher' => $voucher));
      } else if ($posted['payment-option'] == 'card') {
        $this->load->view('booking/form_success_card', array(
          'code' => $this->booking_model->convertTimeToBookingCode($posted['appointment']),
          'voucher' => $voucher
        ));
      }
    }
  }

  private function sendConfirmationEmail($posted, $voucher = null) {
    $this->setEmailDefaultOptions($posted);
    $lang = $this->config->config['language_abbr'];

    if (isset($voucher) && $voucher->code == $this->config_model->specialVoucher()) {
      $this->email->message(
        $this->load->view(
          'email/'.'hun'.'/special',
          array(
            'posted' => $posted,
            'voucher' => $voucher),
          true)
      );
    } else {
      $this->email->message(
        $this->load->view(
          'email/'.$lang.'/confirm',
          array(
            'posted' => $posted,
            'voucher' => $voucher),
          true)
      );
    }
    
    $this->email->send();
  }

  private function setEmailDefaultOptions($posted) {
    $this->email->set_mailtype('html');
    $this->email->to($posted['email']);
    $this->email->from('info@funlock.hu', 'Funlock');
    $this->email->subject('Funlock: Visszaigazolás a foglalásról');
  }

  private function sendReportingEmail($posted, $voucher, $newBookingId) {
    $this->setEmailReportingOptions();

    $this->email->message(
      $this->load->view(
        'email/'.'hun'.'/report',
        array(
          'posted' => $posted,
          'voucher' => $voucher,
          'newBookingId' => $newBookingId),
        true)
    );

    $this->email->send();
  }

  private function setEmailReportingOptions() {
    $emails = $this->config_model->adminEmails();
    $admins = explode(',', $emails);
    //$admins = 'tzsiga@funlock.hu';

    $this->email->set_mailtype('html');
    $this->email->to('');
    $this->email->bcc($admins);
    $this->email->from('info@funlock.hu', 'Funlock');
    $this->email->subject('Foglalási értesítő');
  }

}