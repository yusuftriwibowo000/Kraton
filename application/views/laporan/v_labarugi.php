<div class="card shadow py-2">
    <div class="card-body">
        
        <form action="<?php echo base_url(); ?>Laporan/exportlabarugi" method="POST" class="row">
            <div class="col-md-2">
                <select class="form-control labaRugiFilter" id='bulan' data-other='#tahun' name="bulan" required>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control labaRugiFilter" data-other='#bulan' name="tahun" id="tahun" required>
                    <?php 
                        $yearNow = (int)date('Y');
                        for($i=$yearNow;$i>=$yearNow-10;$i--){
                            echo "<option>$i</option>";
                        }
                    ?>
                </select>
            </div>
            <input style="margin-right: 10px;" name="submit" type="submit" value="Cetak Excel" class="btn btn-info" />
            <input style="margin-right: 10px;" name="submit2" type="submit" value="Cetak PDF" class="btn btn-info" />
        </form>
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-custom">
                    <tr>
                        <td>Penjualan</td>
                        <td>:</td>
                        <td id='penjualan'></td>
                    </tr>
                    <tr>
                        <td>Potongan</td>
                        <td>:</td>
                        <td id='potonganPenjualan'></td>
                    </tr>
                    <tr>
                        <td>Return</td>
                        <td>:</td>
                        <td id='return'></td>
                    </tr>
                    <tr>
                        <td>Total Penjualan</td>
                        <td>:</td>
                        <td id='totalPenjualan'></td>
                    </tr>
                    <tr>
                        <td>Pembelian</td>
                        <td>:</td>
                        <td id='pembelian'></td>
                    </tr>
                    <tr>
                        <td>Potongan</td>
                        <td>:</td>
                        <td id='potongan'></td>
                    </tr>
                    <tr>
                        <td>Return</td>
                        <td>:</td>
                        <td id='returnPembelian'></td>
                    </tr>
                    <tr>
                        <td>Pembelian bersih</td>
                        <td>:</td>
                        <td id='pembelianBersih'></td>
                    </tr>
                    <tr>
                        <td>Persediaan awal</td>
                        <td>:</td>
                        <td id='persediaanAwal'></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td id='total'></td>
                    </tr>
                    <tr>
                        <td>Persediaan Akhir</td>
                        <td>:</td>
                        <td id='persediaanAkhir'></td>
                    </tr>
                    <tr>
                        <td>HPP</td>
                        <td>:</td>
                        <td id='hpp'></td>
                    </tr>
                    <tr>
                        <td>Laba Rugi</td>
                        <td>:</td>
                        <td id='labaRugi'></td>
                    </tr>

            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
/*         var userDataTable = $('#userTable').DataTable({
            //   'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            //'searching': false, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>Laporan/getLabarugi',
                'data': function(data) {
                    data.bulan = $('#bulan').val();
                    data.tahun = $('#tahun').val();
                    // data.searchNama = $('#sel_naama').val();
                    console.log(data);
                }

            },
            'columns': [{
                    data: 'penjualan'
                },
                {
                    data: 'potongan_penjualan'
                },
                {
                    data: 'return_penjualan'
                },
                {
                    data: 'total_penjualan'
                },
                {
                    data: 'pembelian'
                },
                {
                    data: 'potongan_pembelian'
                },
                {
                    data: 'return_pembelian'
                },
                {
                    data: 'pembelian_bersih'
                },
                {
                    data: 'persediaan_awal'
                },
                {
                    data: 'total_persediaan'
                },
                {
                    data: 'persediaan_akhir'
                },
                {
                    data: 'hpp'
                },
                {
                    data: 'laba_rugi'
                }

            ]
        });

        $('#bulan,#sel_nama,#tahun').change(function() {
            userDataTable.draw();
        });
        $('#searchName').keyup(function() {
            userDataTable.draw();
        });
 */    

 });
</script>