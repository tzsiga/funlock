<?php $this->load->view('admin/header'); ?>
<body id="admin-page">
<?php $this->load->view('admin/navbar'); ?>
<div class="container">
  <h1>
    Kuponok szerkesztése
  </h1>
  <br/>

  <?php if (!empty($this->session->flashdata('msg'))) { ?>
    <div id="flash-msg" class="alert alert-danger">
      <?= $this->session->flashdata('msg') ?>
    </div>
  <?php } ?>

  <div class="container col-sm-8">
  <?= $this->pagination->create_links() ?>
  </div>

  <div class="container col-sm-4">
    <br/>
    <?= form_open('admin/voucher/edit/search/', array('class' => 'form-horizontal', 'role' => 'form')) ?>
      <div class="input-group">
        <?= form_input(array(
          'name' => 'voucher-search',
          'class' => 'form-control',
          'id' => 'voucher-search',
          'tpye' => 'text',
          'value' => '')) ?>
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit" name="search">Keresés</button>
        </span>
      </div>
    <?= form_close() ?>
  </div>

  <br/>

  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>kód</th>
        <th>állapot</th>
        <th>kedvezményes ár</th>
        <th>létrhozva</th>
        <th>címke</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach ($vouchers as $voucher) {
        echo '<tr>';
        echo '<td><a href="'.base_url().'index.php/admin/voucher/edit/'.$voucher->id.'">'.
          '<span class="glyphicon glyphicon-pencil"></span> '.
          $voucher->code.
          '</td>';
        echo '<td>'.Utils::$voucherStatuses[$voucher->status].'</td>';
        echo '<td>'.$voucher->discounted_price.'</td>';
        echo '<td>'.date("Y-m-d H:i",$voucher->create_date).'</td>';
        echo '<td>'.$voucher->label.'</td>';
        echo '</tr>';
      }
    ?>
    </tbody>
  </table>

  <?= $this->pagination->create_links() ?>
</div>

<script type="text/javascript">
$(function() {
  var availableTags = [
    <?php
      foreach ($allVouchers as $voucherFromList) {
        echo '"'.$voucherFromList->code.'",';
      }
    ?>
  ];

  $("#voucher-search").autocomplete({
    source: availableTags
/*
    appendTo: '.live_search_result_list',
    focus: function(event, ui) {
      $(".live_search_result_list li.result").removeClass("selected");
      $("#ui-active-menuitem")
        .closest("li")
        .addClass("selected2");
    }
*/
  });
});
</script>
</body>
</html>