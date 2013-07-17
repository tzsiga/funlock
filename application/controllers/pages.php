<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

  public function index() {
    $this->load->view('intro/intro');
  }

  public function eula() {
    $this->load->view('booking/eula');
  }

}