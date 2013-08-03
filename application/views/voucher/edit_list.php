<?php $this->load->view('header'); ?>
<body id="admin-page">
  <h1>
    Kuponok szerkesztése
  </h1>
  <h3 id="flash-msg">
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <p><?= $this->pagination->create_links() ?> | <a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
  <p>
    <?php
      echo form_open('admin/voucher/edit/search/');
      echo form_input(array('name' => 'voucher-search', 'id' => 'voucher-search', 'value' => '')).' ';
      echo form_submit('search', 'Keresés');
      echo form_close();
    ?>
  </p>
  <table class="admin-list-table">
    <tr>
      <th>kód</th>
      <th>állapot</th>
      <th>kedvezményes ár</th>
      <th>létrhozva</th>
      <th>címke</th>
    </tr>
    <?php
      foreach ($vouchers as $voucher) {
        echo '<tr>';
        echo '<td><a href="'.base_url().'index.php/admin/voucher/edit/'.$voucher->id.'">'.$voucher->code.'</td>';
        echo '<td>'.Utils::$voucherStatuses[$voucher->status].'</td>';
        echo '<td>'.$voucher->discounted_price.'</td>';
        echo '<td>'.date("Y-m-d H:i",$voucher->create_date).'</td>';
        echo '<td>'.$voucher->label.'</td>';
        echo '</tr>';
      }
    ?>
  </table>
  <p><?= $this->pagination->create_links() ?> | <a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
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
      source: availableTags,
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