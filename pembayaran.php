<?php include "header.php"; ?>



<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rincian Pembayaran</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->


    <!-- Content Row -->

    <div class="row">


        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rincian</h6>
                </div>
                <!-- Card Body -->
                <?php
                $sqltambah = mysqli_query($konek, "SELECT * FROM harga WHERE id_harga='$_GET[id_harga]'");
                $id_harga = $_GET['id_harga'];
                $jumlah_tiket = $_GET['jumlah_tiket'];
                $harga = $_GET['harga'];
                $total = $_GET['total'];
                $iduser = $_GET['id_user'];
                $id_booking = $_GET['id_booking'];
                $e = mysqli_fetch_array($sqltambah);
                //echo $iduser
                ?>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">Tiket&nbsp;<?php echo $e['nama_tiket']; ?> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> <?php echo $jumlah_tiket; ?>&nbsp;Tiket</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon icon-calendar dark" id="totalnya"><?php echo $total; ?></div>
                                </div>
                            </div>
                            <hr><i class=""></i>
                            <div class="row">
                                <div class="col-md-6">
                                    <label id="harga" type="text"></label>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal">Lanjutkan Ke pembayaran</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>


                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="row">
                                    <div class="col section-1 section-description">
                                        <div class="text-center">
                                            <h5><b>Silahkan melakukan pembayaran Ke No Rekening</b> <br>
                                                BRI A/n GreenLakeviewwaterpark<br>
                                                0421-01-000825-301 </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="upload_transfer.php" enctype="multipart/form-data" method="POST">
                                    <div class="form-group">
                                        <label>Nama kartu </label>
                                        <input type="text" name="nama_kartu" id="nama_kartu" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Bukti Transfer</label>
                                        <input type="file" name="upload" id="upload" class="form-control">
                                        <input type="hidden" name="id_user" id="id_user" class="form-control" value="<?php echo $iduser; ?>">
                                        <input type="hidden" name="jumlah_tiket" id="jumlah_tiket" class="form-control" value="<?php echo $jumlah_tiket; ?>">
                                        <input type="hidden" name="id_booking" id="id_booking" class="form-control" value="<?php echo $id_booking; ?>">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>