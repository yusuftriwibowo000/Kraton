<div class="card shadow py-2">
    <div class="card-body">
    <a href="<?php echo base_url()."transaksi/listkas" ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> List Kas</a>
    <hr>
    <div class="col-md-6">
        <form action="<?= base_url('Transaksi/tambah_kas'); ?>" method="POST" enctype="multipart/form-data">
            <label>Tanggal Kas</label>
            <input name="tanggal_kas" type="text"  placeholder="tanggal kas" class="form-control datepicker">
            <br>
            <label>Nominal</label>
            <input name="nominal" type="number" placeholder="Nominal" class="form-control">
         
            <br>
            <label>Jenis</label>
            <select name="jenis" id="" class="form-control select2">
                <option value="kredit" disabled selected>--Pilih Jenis--</option>
                <option value="kredit">Kredit</option>
                <option value="debit">Debit</option>
            </select>
            <br>
            <br>
            <label>Keterangan</label>
            <input name="keterangan" type="text" placeholder="Keterangan" class="form-control">
            <br>
            <?php 
                $this->load->view("common/btn");
            ?>
        </form>
        </div>
    </div>
</div>
