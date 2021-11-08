<div class="card shadow py-2">
    <div class="card-body">
    <a href="<?php echo base_url()."transaksi/pembelian" ?>" class="btn btn-primary mb-3"> <span class="fa fa-plus-circle"></span> Tambah Pembelian</a>
 
        <div class="table-responsive">
        <?php echo $this->session->flashdata('tambahpembelian'); ?>
        <?php echo $this->session->flashdata('updatepembelian'); ?>
            <table class="table table-striped table-hover table-bordered datatable table-custom">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Pembelian</td>
                        <td>Tanggal Pembelian</td>
                        <td>Total</td>
                        <td>Admin</td>
                        <td>Option</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pembelian as $g) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $g->kode_pembelian ?></td>
                            <td><?= $g->tanggal_pembelian ?></td>
                            <td><?= $g->total ?></td>
                            <td><?= $g->username ?></td>
                            <td>
                                <?php
                                $dropdown['link'] = array(
                                    "Edit" => base_url() ."Transaksi/editpembelian/".$g->kode_pembelian,
                                    "Delete" => array('confirm',base_url() ."Transaksi/deletepembelian/".$g->kode_pembelian)
                                );
                                $this->load->view("common/dropdown", $dropdown);
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

