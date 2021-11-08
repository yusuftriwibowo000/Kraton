<div class="card shadow py-2">
    <div class="card-body">
    <a href="<?php echo base_url()."transaksi/kas" ?>" class="btn btn-primary mb-3"> <span class="fa fa-plus-circle"></span> Tambah Kas</a>
        <div class="table-responsive">
        <?php echo $this->session->flashdata('tambahkas'); ?>
        <?php echo $this->session->flashdata('editkas'); ?>
        <?php echo $this->session->flashdata('hapuskas'); ?>
            <table class="table table-striped table-hover table-bordered datatable table-custom">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Kas</td>
                        <td>Tanggal Kas</td>
                        <td>Nominal</td>
                        <td>Jenis</td>
                        <td>Keterangan</td>
                        <td>Option</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kas as $g) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $g->kode_kas ?></td>
                            <td><?= $g->tanggal_kas ?></td>
                            <td><?= $g->nominal ?></td>
                            <td><?= $g->jenis ?></td>
                            <td><?= $g->keterangan ?></td>
                            <td>
                                <?php
                                $dropdown['link'] = array(
                                    "Edit" => base_url() ."Transaksi/vkas/".$g->kode_kas,
                                    "Hapus" => array('confirm',base_url() ."Transaksi/hapuskas/".$g->kode_kas)
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

