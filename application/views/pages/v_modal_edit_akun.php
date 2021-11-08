<?php
$id = $this->uri->segment(3);
$query = $this->db->query("SELECT * FROM `admin` WHERE id_admin='$id'")->result();
foreach ($query as $q) { ?>
    <div class="modal modalJS" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('Pages/aksiedit_akun'); ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-4  control-label col-form-label">Username</label>
                            <div class="col-sm-8">
                            <input type="hidden" name="id_admin" value="<?= $q->id_admin; ?>" />
                            <input type="text" class="form-control" name="username" value="<?= $q->username; ?>" />
                            </div>
                            <br>
                            <br>
                            <label for="fname" class="col-sm-4  control-label col-form-label">Password</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="password" value="<?= $q->password; ?>" />
                            </div>
                            <br>
                            <br>
                            <label for="fname" class="col-sm-4  control-label col-form-label">No Telpon</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_tlp" value="<?= $q->no_tlp; ?>" />
                            <input type="hidden" class="form-control" name="no_tlp" value="<?= $q->level; ?>" />
                            </div>                         
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>