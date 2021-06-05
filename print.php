<?php include "header.php"; ?>
<?php
include('koneksi.php');
?>
<?php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    echo $id_user = $_SESSION['id_user'];
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data user</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="cetak.php">Cetak PDF</a>
                    <a class="dropdown-item" href="#">Excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i></i> Halo, Alif widiyanto
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-12 invoice-col">
                        Pembelian Tiket Berhasil
                        <br><br>
                        <address>
                            <br>
                            Terimakasih telah membeli tiket Green lake view waterpark.cek detail pembelian dan kode tiket kamu <br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col">
                        <strong>Detail pembelian</strong><br><br>
                        <address>
                            No transaksi<br>
                            <strong>T0001</strong><br><br>
                            Status<br>
                            <b>Telah dibayar</b>
                        </address>
                    </div>


                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col"><br><br>
                        Tanggal Pemesanan<br>
                        <b>06 Maret 2021 08:30</b><br><br>
                        Jumlah tiket<br>
                        <b>1</b>
                    </div>

                    <div class="col-sm-6 invoice-col">
                        <address>
                            Paket Tiket<br>
                            <strong>Tiket weekend</strong><br><br>
                            Nama pemesan<br>
                            <b>Alif widiyanto</b>
                        </address>
                    </div>

                    <div class="col-sm-6 invoice-col">
                        Total<br>
                        <b>Rp.80.000</b><br><br>
                        Email<br>
                        <b>alifwidiyanto46@gmail.com</b>
                    </div>

                    <div class="col-sm-6 invoice-col">
                        <address>
                            Nomor telepon<br>
                            <strong>089671457902</strong><br><br>
                        </address>
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="card mb-4 col-12">
                        <br>
                        <div class="col-md-6">
                            <h5><b>Tiket weekend</b></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> Berlaku hingga</label></div>
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> 06 April 2021 08:30</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div id="totalnya">Alamat</div>
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> jl.bogor km 38 cimanggis</label></div>
                                </div>
                                <br>

                                <div class="col-md-6">
                                    <div class="icon icon-hourglass bg"><img src="113489.png" width="100px"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon icon-calendar dark" id="totalnya">Kode booking</div>
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> 181684</label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                            Payment
                        </button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>