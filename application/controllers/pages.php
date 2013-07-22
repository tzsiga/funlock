<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

  public function index() {
    $this->load->library('user_agent');

    if ($this->agent->is_mobile())
      redirect('main', 'refresh');

    $this->load->view('intro/intro');
  }

  public function eula() {
    $this->load->view('booking/eula');
  }

}