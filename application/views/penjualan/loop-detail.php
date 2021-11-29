<div class="row detail-field mb-3" data-id='<?= $now; ?>'>
    <?php
    $value = array(
        'kode_barang' => '',
        'qty' => '',
        'harga_satuan' => '',
        'keterangan' => '',
        'subtotal' => '',
        'id_kategori' => ''
    );
    if (isset($edit)) {
        $value = $edit;
        $value['subtotal'] = $value['qty'] * $value['harga_satuan'];
    }
    ?>

    <div class="col-md-1">
        <label for="">#</label><br>
        <label for=""><?=$now?></label>
    </div>

    <div class="col-md-2">
        <label for="">Kategori</label>
        <select name="" class="form-control select2" id="kategori">
            <option value="">---Pilih Kategori---</option>
            <?php $sql = $this->db->query("SELECT * FROM kategori")->result();
            foreach ($sql as $s) {
                $selected = '';
                if ($value['id_kategori'] != '') {
                    $selected = $value['id_kategori'] == $s->id_kategori ? 'selected' : '';
                }
            ?>
                <option value="<?= $s->id_kategori ?>" <?= $selected ?>><?= $s->nama_kategori ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-4">
        <?php
        if (isset($edit)) {
            echo "<input type='text' name='id_detail[]' value='$value[id_detail]'>";
        }
        ?>
        <label for="">Nama Barang</label>
        <select name="kode_barang[]" class="form-control select2 setHarga" data-target="#harga<?= $now ?>" id="barang">
            <option value="">---Pilih Barang---</option>
        </select>
    </div>
    <div class="col-md-1">
        <label for="">Jumlah</label>
        <input type="number" name='qty[]' class="form-control qtyHarga" value='<?= $value['qty'] ?>' id='qty<?= $now ?>' data-parent='#harga<?= $now ?>' data-subtotal='#subtotal<?= $now ?>'>
    </div>
    <div class="col-md-2">
        <label for="">Harga Satuan</label>
        <input type="number" name='harga_satuan[]' class="form-control qtyHarga" id='harga<?= $now ?>' data-parent='#qty<?= $now ?>' data-subtotal='#subtotal<?= $now ?>' value="<?= $value['harga_satuan'] ?>" readonly>
    </div>
    
    <div class="col-md-2">
        <label for="">Subtotal</label>
        <input type="text" name='subtotal[]' class="form-control subtotal" id='subtotal<?= $now ?>' value='<?= $value['subtotal'] ?>' readonly>
    </div>
    <?php
    if ($start!=1) {
    ?>
        <div class="col-md-1">
            <br>
            <?php 
                if(isset($edit)){
            ?>
                <a href="" data-target='<?= $now; ?>' class="btn btn-danger mt-2 removeField editRemoveField" data-id='<?= $value['id_detail'] ?>'>Hapus</a>
            <?php
                }
                else{
            ?>
                <a href="" data-target='<?= $now; ?>' class="btn btn-danger mt-2 removeField">Hapus</a>
            <?php
                }
            ?>
        </div>
    <?php } ?>
</div>