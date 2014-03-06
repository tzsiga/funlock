<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'admin.php';

class Config extends Admin {

  public function changePassword() {
    $posted = $this->input->post();

    if ($posted) {
      $this->form_validation->set_rules('current_password', '"Régi jelszó"', 'required|xss_clean');
      $this->form_validation->set_rules('new_password_1', '"Új jelszó"', 'required|xss_clean|min_length[5]|max_length[20]');
      $this->form_validation->set_rules('new_password_2', '"Új jelszó újra"', 'required|xss_clean|matches[new_password_1]');

      if ($this->form_validation->run() == true) {
        if ($this->admin_model->isCorrectPassword($posted['current_password'])) {
          $this->admin_model->updatePassword($posted['new_password_1']);
          $this->session->set_flashdata('msg', 'Jelszó megváltoztatva!');
          redirect('/admin', 'refresh');
        } else if ($this->input->post('current_password')) {
          $this->session->set_flashdata('msg', 'Hibás jelenlegi jelszó!');
          redirect('/config/changePassword', 'refresh');
        }
      }
    }

    $this->load->view('config/change_password');
  }

  public function changeLimit() {
    $currentLimit = $this->config_model->bookingLimit();
    $posted = $this->input->post();

    if ($posted) {
      $this->form_validation->set_rules('limit', '"Foglalási limit"', 'required|xss_clean|numeric|greater_than[0]|less_than[100]');

      if ($this->form_validation->run() == true) {
        $this->db->query("UPDATE config SET value = '".$posted['limit']."' WHERE option_name = 'booking_limit'");
        $this->session->set_flashdata('msg', 'Új foglalási limit: '.$posted['limit']);
        redirect('/admin', 'refresh');
      }
    }

    $this->load->view('config/change_limit', array('currentLimit' => $currentLimit));
  }

  public function phpinfo() {
    phpinfo();
  }

}