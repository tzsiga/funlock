<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'admin.php';

class Booking_Admin extends Admin {

  public function add($timestamp = 0) {
    $posted = $this->input->post();

    if ($posted) {
      $this->setValidationRulesForAdmin($posted);

      if ($this->form_validation->run() == true) {
        $this->createBooking($posted);
        redirect('admin/booking/edit', 'refresh');
      }
    }

    $this->load->view('booking_admin/add', array(
      'posted' => $posted,
      'timestamp' => $timestamp
    ));
  }

  public function edit($id) {
    $posted = $this->input->post();

    if ($posted) {
      $this->setValidationRulesForAdmin($posted);

      if ($this->form_validation->run() == true) {
        if (Utils::getCase($posted) === 'save') {
          $this->saveBooking($id, $posted);
        } else if (Utils::getCase($posted) === 'delete') {
          $this->deleteBooking($id, $posted);
        }
        redirect('admin/booking/edit', 'refresh');
      }
    }

    $booking = $this->booking_model->getBooking($id);
    $voucher = $this->voucher_model->getVoucherByID($booking->voucher_id);

    $this->load->view('booking_admin/edit', array(
      'booking' => $booking,
      'voucher' => $voucher,
      'code' => $this->booking_model->convertTimeToBookingCode($booking->appointment)
    ));
  }

  public function editList($offset = 0) {
    $pageLimit = 30;
    $this->setupPagination($this->booking_model->countAll(), $pageLimit);
    $this->load->view('booking_admin/edit_list', array(
      'bookings' => $this->booking_model->getSegment($pageLimit, $offset)
    ));
  }

  private function setupPagination($total, $page) {
    $this->load->library('pagination');
    $config['base_url'] = base_url().'index.php/admin/booking/list';
    $config['uri_segment'] = 4;
    $config['total_rows'] = $total;
    $config['per_page'] = $page;

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';

    $config['next_link'] = '»';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '«';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';

    $config['first_link'] = 'első';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'utolsó';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $this->pagination->initialize($config);
  }

  public function editTable() {
    $this->load->view('booking_admin/edit_table', array(
      'bookings' => $this->booking_model->getAll()
    ));
  }

  public function loadAdminTable() {
    if ($this->input->is_ajax_request()) {
      $headTimestamp = $this->input->get('headTimestamp');
      $this->load->view('booking_admin/table', array(
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


  private function getDateTime($posted) {
    return date('Y-m-d H:i', $this->booking_model->addDateAndTimestamp($posted));
  }

}