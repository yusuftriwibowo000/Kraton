<div class="card shadow py-2">
    <div class="card-body">
    <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div style="height: 160px;" class="box bg-success text-center">

                                <h1 style="margin-top: 10px;" class="font-light text-white"><i class="fas fa-fw fa-wallet"></i></h1>
                                <h6 class="text-white">Total kas</h6>
                                <h2 class="text-white">Rp. <?php $format_indonesia = number_format ($kas[0]->total, 0, ',', '.');
                                     echo $format_indonesia; ?></h2>
                                
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div style="height: 160px;" class="box bg-warning text-center">

                                <h1 style="margin-top: 10px;" class="font-light text-white"><i class="fas fa-fw fa-shopping-cart"></i></h1>
                                <h6 class="text-white">Penjualan</h6>
                                <h2 class="text-white">Rp. <?php $format_indonesia = number_format ($penjualan[0]->total, 0, ',', '.');
                                     echo $format_indonesia; ?></h2>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div style="height: 160px;" class="box bg-danger text-center">

                                <h1 style="margin-top: 10px;" class="font-light text-white"><i class="fas fa-fw fa-cubes"></i></h1>
                                <h6 class="text-white">Pembelian</h6>
                                <h2 class="text-white">Rp. <?php $format_indonesia = number_format ($pembelian[0]->total, 0, ',', '.');
                                     echo $format_indonesia; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div style="height: 160px;" class="box bg-info text-center">

                                <h1 style="margin-top: 10px;" class="font-light text-white"><i class="fas fa-balance-scale"></i></h1>
                                <h6 class="text-white">Saldo</h6>
                                <h2 class="text-white">Rp. <?php $format_indonesia = number_format ($saldoawal, 0, ',', '.');
                                     echo $format_indonesia; ?></h2>
                            </div>
                        </div>
                    </div>
                  
                   
                </div>
    </div>
</div>
