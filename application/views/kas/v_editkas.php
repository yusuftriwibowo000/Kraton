<div class="card shadow py-2">
    <div class="card-body">
    <a href="<?php echo base_url()."transaksi/listkas" ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> List Kas</a>
    <hr>
    <?php foreach($edit as $e){ ?>
    <div class="col-md-6">
        <form action="<?= base_url('Transaksi/editkas'); ?>" method="POST" enctype="multipart/form-data">
            <label>Tanggal Kas</label>
            <input name="kode_kas" type="hidden" value="<?= $e->kode_kas ?>"  placeholder="tanggal kas" class="form-control">
            <input name="tanggal_kas" type="text" value="<?= $e->tanggal_kas ?>"  placeholder="tanggal kas" class="form-control datepicker">
            <br>
            <label>Nominal</label>
            <input name="nominal" type="number" value="<?= $e->nominal ?>" placeholder="Nominal" class="form-control">
            <br>
            <label>Jenis</label>
            <select name="jenis" id="" class="form-control select2">
                <option disabled>--Pilih Jenis--</option>
                <option <?php if($e->jenis == 'kredit') echo "selected" ?> value="kredit">Kredit</option>
                <option  <?php if($e->jenis == 'debit') echo "selected" ?> value="debit">Debit</option>
            </select>
            <br>
            <br>
            <label>Keterangan</label>
            <input name="keterangan" type="text" value="<?= $e->keterangan ?>" placeholder="Keterangan" class="form-control">
            <br>
            <?php 
                $this->load->view("common/btn");
            ?>
        </form>
        </div>
    <?php } ?>
    </div>
</div>
