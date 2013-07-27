<?php $this->load->view('header'); ?>
<body id="admin-page">
  <h1>
    Kuponok szerkesztése
  </h1>
  <h3 id="flash-msg">
    <?= $this->session->flashdata('msg') ?>
  </h3>
  <p><a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
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
  <p><a href="<?= base_url() ?>index.php/admin/voucher">Vissza</a></p>
</body>
</html>