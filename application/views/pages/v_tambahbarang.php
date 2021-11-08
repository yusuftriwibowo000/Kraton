<div class="card shadow py-2">
    <div class="card-body">
    <a href="<?php echo base_url()."pages/table_barang" ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> Back to table</a>
    <hr>
  
        <form action="<?= base_url('Pages/tambah_barang'); ?>" method="POST" enctype="multipart/form-data">
      
            <label>Nama Barang</label>
            <input name="nama_barang"  type="text" placeholder="Nama Barang" class="form-control">
            <br>
            <label>Kategori Barang</label>
            <select name="id_kategori" id="" class="form-control select2">
                <option value="Aksesoris" disabled selected>--Pilih Kategori--</option>
                <?php foreach($kategori as $g) { ?>
                <option value="<?= $g->id_kategori ?>" ><?= $g->nama_kategori ?></option>
                <?php } ?>
            </select>
            <br>
            <br>
            <label>Harga Jual</label>
            <input name="harga_jual"  type="number" placeholder="Harga Jual" class="form-control">
            <br>
            <label>Stok</label>
            <input name="stok"  type="number" placeholder="Stok" class="form-control">
            <br>
           
            <label>Keterangan</label>
            <textarea name="keterangan"  cols="30" rows="5" class="form-control"></textarea>
            <br>
            <?php 
                $this->load->view("common/btn");
            ?>
        </form>
    </div>
</div>
