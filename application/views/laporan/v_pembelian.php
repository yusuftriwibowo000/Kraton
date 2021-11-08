<div class="card shadow py-2">
    <div class="card-body">
        
        <form action="<?php echo base_url(); ?>Laporan/export" method="POST" class="row">
        <div class="col-md-2">
            <input type="text" id="tglawal" name="tanggal_awal"  class="form-control datepicker">
        </div>
                <div class="col-md-2">
            <input type="text" id="tglakhir" name="tanggal_akhir"  class="form-control datepicker">
                </div>
            <input style="margin-right: 10px;" name="submit" type="submit" value="Cetak Excel" class="btn btn-info" />
            <input style="margin-right: 10px;" name="submit2" type="submit" value="Cetak PDF" class="btn btn-info" />
            <a class="btn btn-info" href="<?php echo base_url(); ?>Laporan/laporanpembelian">Reset</a>
        </form>
       <br>
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-hover table-bordered datatable table-custom">
                <thead>
                    <tr>
                        <td>Kode Pembelian</td>
                        <td>Tanggal Pembelian</td>
                        <td>Total</td>
                        <td>Admin</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
        $(document).ready(function() {
            var userDataTable = $('#userTable').DataTable({
                //   'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                //'searching': false, // Remove default Search Control
                'ajax': {
                    'url': '<?= base_url() ?>Laporan/getPembelian',
                    'data': function(data) {
                        data.tglawal = $('#tglawal').val();
                        data.tglakhir = $('#tglakhir').val();
                        // data.searchNama = $('#sel_naama').val();
                        console.log(data);
                    }

                },
                'columns': [{
                        data: 'kode_pembelian'
                    },
                    {
                        data: 'tanggal_pembelian'
                    },
                    {
                        data: 'total'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'keterangan'
                    }

                ]
            });

            $('#tglawal,#sel_nama,#tglakhir').change(function() {
                userDataTable.draw();
            });
            $('#searchName').keyup(function() {
                userDataTable.draw();
            });
        });
    </script>