<div class="card shadow py-2">
    <div class="card-body">
        <a href="<?php echo base_url() . "transaksi/listpembelian" ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> List Pembelian</a>
        <hr>
        <?php 
            $this->load->view('pages/alert');
        ?>
        <form action="<?= base_url('Transaksi/aksieditpembelian') ?>" method="POST">
            <div class="deletedId"></div>
            <?php foreach ($beli as $g) { ?>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Kode Pembelian</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><span class="fa fa-calendar"></span> </span>
                            </div>
                            <input type="text" name="kode_pembelian" value="<?= $g->kode_pembelian ?>" readonly class="form-control datepicker">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Tanggal</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><span class="fa fa-calendar"></span> </span>
                            </div>
                            <input type="text" name="tanggal_beli" value="<?= $g->tanggal_pembelian ?>" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Keterangan</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><span class="fas fa-address-book"></span> </span>
                            </div>
                            <input type="text" value="<?= $g->id_admin ?>" name="id_admin" class="form-control">
                            <input type="text" value="<?= $g->keterangan ?>" name="keterangan2" class="form-control">
                        </div>
                    </div>

                </div>
            <?php } ?>
            <hr>
            <div class="loop-detail" data-counting='<?php echo count($detail) ?>'>
                <?php
                foreach ($detail as $key  => $data) {
                    $key++;
                    $start = $key == 1 ? 1 : 0;
                    $this->load->view('pembelian/loop-detail', ['start' => $start, 'now' => $key, 'edit' => $data]);
                }

                ?>
            </div>
            <div class="row">
                <div class="col-auto">
                    <a href="<?= base_url() . "transaksi/addDetailPembelian" ?>" class="btn btn-default addDetail"><span class="fa fa-plus"></span> Tambah Item</a>
                </div>
                <div class="col-auto ml-auto">
                    <h4 class="total">Total : <span id='total'><?= number_format($g->total, 0, ',', '.') ?></span> </h4>
                </div>
            </div>
            <hr>
            <div class="mt-3">
                <?php
                $this->load->view('common/btn');
                ?>
            </div>
        </form>
    </div>

</div>