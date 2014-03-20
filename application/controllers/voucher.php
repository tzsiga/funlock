<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'admin.php';

class Voucher extends Admin {

  function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->load->view('voucher/index');
  }

  public function add() {
    $posted = $this->input->post();

    if ($posted) {
      $this->setAddValidationRules();

      if ($this->form_validation->run() == true) {
        $vouchers = array();
        for ($i = 0; $i < $posted['number_of_vouchers']; $i++)
          $vouchers[] = $this->create($posted);

        $this->session->set_flashdata('msg', 'Új kupon(ok) létrehozva!<br/>'.$this->getCodes($vouchers));
        redirect('/admin/voucher/add', 'refresh');
      }
    }

    $this->load->view('voucher/add');
  }

  public function addUnique() {
    $posted = $this->input->post();

    if ($posted) {
      $this->setAddUniqueValidationRules();

      if ($this->form_validation->run() == true) {
        if (!$this->voucher_model->isUniqueCode($posted['code'])) {
          $this->session->set_flashdata('msg', 'Ilyen kupon már létezik!<br/>'.$posted['code']);
        } else {
          $voucher = $this->create($posted);
          $this->session->set_flashdata('msg', 'Új kupon létrehozva!<br/>'.$voucher['code']);
        }
        redirect('/admin/voucher/unique', 'refresh');
      }
    }

    $this->load->view('voucher/unique');
  }

  public function listAll($offset = 0) {
    $pageLimit = 30;
    $this->setupPagination($this->voucher_model->countAll(), $pageLimit);
    $this->load->view('voucher/edit_list', array(
      'vouchers' => $this->voucher_model->getSegment($pageLimit, $offset),
      'allVouchers' => $this->voucher_model->getAll()
    ));
  }

  public function search() {
    $posted = $this->input->post();

    if ($posted) {
      $voucher = $this->voucher_model->getVoucherByCode($posted['voucher-search']);
      if (isset($voucher)) {
        redirect('admin/voucher/edit/'.$voucher->id, 'refresh');
      }
    }

    redirect('admin/voucher/list', 'refresh');
  }

  public function edit($id) {
    $posted = $this->input->post();

    if ($posted) {
      $this->setEditValidationRules();

      if ($this->form_validation->run() == true) {
        if (Utils::getCase($posted) === 'save') {
          $this->saveVoucher($id, $posted);
        } else if (Utils::getCase($posted) === 'delete') {
          $this->deleteVoucher($id);
        }
        redirect('admin/voucher/list', 'refresh');
      }
    }

    $this->load->view('voucher/edit', array(
      'voucher' => $this->voucher_model->getVoucherByID($id),
      'booking' => $this->booking_model->getBookingByVoucher($id)
    ));
  }

  private function setupPagination($total, $page) {
    $this->load->library('pagination');
    $config['base_url'] = base_url().'index.php/admin/voucher/list';
    $config['uri_segment'] = 4;
    $config['total_rows'] = $total;
    $config['per_page'] = $page;
    $config['first_link'] = 'Első';
    $config['last_link'] = 'Utolsó';
    $this->pagination->initialize($config);
  }

  private function create($posted) {
    $newVoucher = $this->voucher_model->getNewUniqueVoucher($posted);
    $this->voucher_model->insertVoucher($newVoucher);

    return $newVoucher;
  }

  private function setEditValidationRules() {
    $this->form_validation->set_rules('discounted_price', '"Kedvezményes ár"', 'required|xss_clean|numeric|greater_than[-1]|less_than[15001]');
    $this->form_validation->set_rules('label', '"Címke"', 'xss_clean');
  }

  private function setAddValidationRules() {
    $this->form_validation->set_rules('number_of_vouchers', '"Kuponok száma"', 'required|xss_clean|numeric|greater_than[0]|less_than[1000]');
    $this->setEditValidationRules();
  }

  private function setAddUniqueValidationRules() {
    $this->form_validation->set_rules('code', '"Kód"', 'required|xss_clean|min_length[4]|max_length[20]');
    $this->setEditValidationRules();
  }

  private function getCodes($vouchers) {
    $msg = '';
    foreach ($vouchers as $voucher)
      $msg .= $voucher['code'].'<br/>';

    return $msg;
  }

  private function saveVoucher($id, $posted) {
    $this->voucher_model->updateVoucher($id, $this->voucher_model->composeVoucher($posted));
    $this->session->set_flashdata('msg', 'Kupon elmentve!');
  }

  private function deleteVoucher($id) {
    $this->voucher_model->deleteVoucher($id);
    $this->session->set_flashdata('msg', 'Kupon törölve!');
  }

}