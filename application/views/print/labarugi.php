<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <?php
  $uri = !empty($this->uri->segment(2)) ? $this->uri->segment(2) : $this->uri->segment(1);
  $pageTitle = ucwords(str_replace("_", " ", $uri));
  ?>
  <title><?php echo $pageTitle . " - " . $pageInfo ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() . "assets/" ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() . "assets/" ?>css/sb-admin-2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() . "assets/" ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() . "assets/" ?>vendor/select2-develop/dist/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() . "assets/" ?>vendor/sweetalert-master/dist/sweetalert.css" rel="stylesheet" />
  <link href="<?php echo base_url() . "assets/" ?>vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() . "assets/" ?>css/custom.css" rel="stylesheet" />
  <script src="<?php echo base_url() . "assets/" ?>vendor/jquery/jquery.min.js"></script>
</head>

<div class="card shadow py-2">
    <div class="card-body">
 
        <div class="table-responsive">
            <center><h2>LAPORAN LABA RUGI</h2></center>
            <table class="table table-striped table-hover table-bordered table-custom">
                <thead>
                    <tr>
                    <td>Laporan Laba Rugi</td>
                    <td><?= $tanggal ?></td>
                    </tr>
                    <tr>
                    <td>Penjualan</td>
                    <td><?= $penjualan ?></td>
                    </tr>
                    <tr>
                    <td>Potongan</td>
                    <td><?= $potongan ?></td>
                    </tr>
                    <tr>
                    <td>return Penjualan</td>
                    <td><?= $return_penjualan ?></td>
                    </tr>
                    <tr>
                    <td>Total Penjualan</td>
                    <td><?= $total_penjualan ?></td>
                    </tr>
                    <tr>
                    <td>Pembelian</td>
                    <td><?= $pembelian ?></td>
                    </tr>
                    <td>Potongan</td>
                    <td><?= $potongan2 ?></td>
                    </tr>
                    <tr>
                    <td>Return Pembelian</td>
                    <td><?= $return_pembelian ?></td>
                    </tr>
                    <tr>
                    <td>Pembelian Bersih</td>
                    <td><?= $pembelian_bersih ?></td>
                    </tr>
                    <tr>
                    <td>Persediaan Awal</td>
                    <td><?= $persediaan_awal ?></td>
                    </tr>
                    <tr>
                    <td>Total</td>
                    <td><?= $total_persediaan ?></td>
                    </tr>
                    <tr>
                    <td>Persediaan Akhir</td>
                    <td><?= $persediaan_akhir ?></td>
                    </tr>
                    <tr>
                    <td>HPP</td>
                    <td><?= $hpp ?></td>
                    </tr>
                    <tr>
                    <td>Laba Rugi</td>
                    <td><?= $laba_rugi ?></td>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
		window.print();
    </script>
        <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() . "assets/" ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() . "assets/" ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() . "assets/" ?>js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url() . "assets/" ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() . "assets/" ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() . "assets/" ?>vendor/select2-develop/dist/js/select2.min.js"></script>
<script src="<?php echo base_url() . "assets/" ?>vendor/sweetalert-master/dist/sweetalert-dev.js"></script>
<script src="<?php echo base_url() . "assets/" ?>vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() . "assets/" ?>js/custom.js"></script>
</body>

</html>
