<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'admin.php';

class Booking_Admin extends Admin {

  public function addBookingAsAdmin($timestamp = 0) {
    $posted = $this->input->post();

    if ($posted) {
      $this->setValidationRulesForAdmin($posted);

      if ($this->form_validation->run() == true) {
        $this->createBooking($posted);
        redirect('admin/booking/edit', 'refresh');
      }
    }

    $this->load->view('booking_admin/admin_add', array(
      'posted' => $posted,
      'timestamp' => $timestamp
    ));
  }

  public function editBooking($id) {
    $posted = $this->input->post();

    if ($posted) {
      $this->setValidationRulesForAdmin($posted);

      if ($this->form_validation->run() == true) {
        if ($this->getCase($posted) === 'save') {
          $this->saveBooking($id, $posted);
        } else if ($this->getCase($posted) === 'delete') {
          $this->deleteBooking($id, $posted);
        }
        redirect('admin/booking/edit', 'refresh');
      }
    }

    $this->load->view('booking_admin/admin_edit', array(
      'booking' => $this->booking_model->getBooking($id)
    ));
  }

  public function editList() {
    $this->load->view('booking_admin/admin_edit_list', array(
      'bookings' => $this->booking_model->getAllBookings()
    ));
  }

  public function editTable() {
    $this->load->view('booking_admin/admin_edit_table', array(
      'bookings' => $this->booking_model->getAllBookings()
    ));
  }

  public function loadAdminTable() {
    if ($this->input->is_ajax_request()) {
      $headTimestamp = $this->input->get('headTimestamp');
      $this->load->view('booking_admin/admin_table', array(
        'bookings' => $this->booking_model->getBookingsInRange($headTimestamp),
        'headTimestamp' => $headTimestamp
      ));
    }
  }

  private function setValidationRulesForAdmin($posted = null) {
    $this->form_validation->set_rules('appointment', '"Foglalt időpont"', 'required|xss_clean');

    if (isset($posted['status'])) {
      $this->form_validation->set_rules('book-fname', '"Foglaló vezetékneve"', 'required|xss_clean');
      $this->form_validation->set_rules('book-sname', '"Foglaló keresztneve"', 'required|xss_clean');
    }
  }

  private function createBooking($posted) {
    $this->booking_model->insertBooking($this->booking_model->composeBookingAsAdmin($posted));
    $this->session->set_flashdata('msg',
      'Új foglalás ('.$this->getDateTime($posted).') elmentve!'
    );
  }

  private function saveBooking($id, $posted) {
    $this->booking_model->updateBooking($id, $this->booking_model->composeBookingAsAdmin($posted));
    $this->session->set_flashdata('msg',
      'Foglalás ('.$this->getDateTime($posted).') elmentve!'
    );
  }

  private function deleteBooking($id, $posted) {
    $this->booking_model->deleteBooking($id);
    $this->session->set_flashdata('msg',
      'Foglalás ('.$this->getDateTime($posted).') törölve!'
    );
  }

  private function getCase($posted) {
    foreach ($posted as $name => $value) {
      if (preg_match('/save/', $name)) {
        return 'save';
      } else if (preg_match('/delete/', $name)) {
        return 'delete';
      }
    }

    return null;
  }

  private function getDateTime($posted) {
    return date('Y-m-d H:i', $this->booking_model->addDateAndTimestamp($posted));
  }

}