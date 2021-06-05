<?php include "header.php"; ?>
<?php
$query = mysqli_query($konek, "select * from user where id_user = '$_SESSION[id_user]'");
$id_user1 = mysqli_fetch_array($query);
$id_user = $_SESSION['id_user'];
//echo $_SESSION['id_user'];
//echo $id_user
?>

<link rel="stylesheet" href="jquery-ui.css">
<script type="text/javascript" src="chartjs/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>
    jQuery(document).ready(function() {
        // This button will increment the value
        $('.qtyplus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
        // This button will decrement the value till 0
        $(".qtyminus").click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
    });
</script>



<?php
include 'koneksi.php';
?>

<?php
$sqlcount = mysqli_query($konek, "SELECT count(*) AS jumlah FROM user");
$e = mysqli_fetch_array($sqlcount);
// echo "Jumlah data dengan fungsi MySQL count(): {$e['jumlah']} <br/>";

// $sqlcount2 = mysqli_query($konek, "SELECT count(*) AS jumlah2 FROM tagihan where status ='Konfirmasi'");
// $c = mysqli_fetch_array($sqlcount2);

// $bln = date("m");
// $sqlsum = mysqli_query($konek, "SELECT SUM(sisa_pembayaran) AS tagihan FROM `tagihan` where MONTH(tanggal_rencana) = '" . $bln . "'");
// $b = mysqli_fetch_array($sqlsum);

// $tgl    = date("Y-m-d");
// $sqldate = mysqli_query($konek, "SELECT count(*) AS jumlah3 FROM tagihan WHERE tanggal_rencana ='$tgl'");
// $f = mysqli_fetch_array($sqldate);

// $barti = mysqli_query($konek, "SELECT count(*) AS jumlahti FROM user WHERE prodi ='mi'");
// $bar = mysqli_fetch_array($barti);
//echo "Jumlah data dengan fungsi MySQL count(): {$bar['jumlahti']} <br/>";
?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pesan Tiket</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Pilih paket</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php
                    $sqlharga = mysqli_query($konek, "select * from harga");
                    while ($harga = mysqli_fetch_array($sqlharga)) {
                    ?>
                        <div class="card">
                            <div class="card-header"><?= $harga['nama_tiket'] ?></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="icon icon-hourglass bg"></div> Berlaku di tanggal kunjungan
                                    </div>
                                    <div class="col-md-6">
                                        <div class="icon icon-calendar dark"></div>Tiket tidak bisa direfund
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label id="harga" type="text"><?= $harga['harga'] ?></label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal<?php echo $harga['id_harga']; ?>">Pesan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="modal fade" id="myModal<?php echo $harga['id_harga']; ?>" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Pesan tiket </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="booking_tiket.php" method="POST">

                                            <?php
                                            $id = $harga['id_harga'];
                                            $iduser = $_SESSION['id_user'];
                                            //echo $id;
                                            $query_view = mysqli_query($konek, "SELECT * FROM harga WHERE id_harga='$id'");
                                            //$result = mysqli_query($conn, $query);
                                            while ($data = mysqli_fetch_assoc($query_view)) {
                                            ?>
                                                <script>
                                                    $(document).ready(function() {
                                                        var nominal = <?= $data['harga'] ?>;
                                                        $(".kurang<?= $data['id_harga'] ?>").click(function() {
                                                            $(".hasil<?= $data['id_harga'] ?>").val($(".hasil<?= $data['id_harga'] ?>").val() - 1);
                                                            $(".nominal<?= $data['id_harga'] ?>").val($(".nominal<?= $data['id_harga'] ?>").val() - nominal);
                                                        });
                                                        $(".tambah<?= $data['id_harga'] ?>").click(function() {
                                                            $(".hasil<?= $data['id_harga'] ?>").val(+$(".hasil<?= $data['id_harga'] ?>").val() + 1);
                                                            $(".nominal<?= $data['id_harga'] ?>").val(nominal * $(".hasil<?= $data['id_harga'] ?>").val());
                                                        });
                                                        $(".hasil<?= $data['id_harga'] ?>").keyup(function() {
                                                            $(".nominal<?= $data['id_harga'] ?>").val(nominal * $(".hasil<?= $data['id_harga'] ?>").val());
                                                        });
                                                    });
                                                </script>


                                                <div class="form-group">
                                                    <label>Nama tiket</label>
                                                    <input type="text" name="nama_tiket" id="nama_tiket" class="form-control" value="<?php echo $harga['nama_tiket']  ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode tiket</label>
                                                    <input type="text" name="kode_tiket" id="kode_tiket" class="form-control" value="<?php echo $id  ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>id user</label>
                                                    <input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo $iduser ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>harga</label>
                                                    <input type="text" name="harga" id="harga" class="form-control" value="<?php echo $data['harga']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Tanggal kunjungan</label>
                                                    <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control" value="">
                                                </div>
                                                <p>Harga : <?= $data['harga']; ?></p>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="kurang<?= $data['id_harga'] ?> fas fa-minus"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" id="jumlah_tiket" name="jumlah_tiket" value="0" class="form-control hasil<?= $data['id_harga'] ?>">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="tambah<?= $data['id_harga'] ?> fas fa-plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="text" id="total" name="total" class="form-control nominal<?= $data['id_harga'] ?>">
                                                </div>
                                                <input type="text" name="id_harga" value="<?php echo $harga['id_harga']; ?>">
                                                <div class=" modal-footer">
                                                    <button type="submit" class="btn btn-success">Pesan</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                </div>
                                            <?php
                                            }
                                            //mysql_close($host);
                                            ?>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function sum() {
        var harga = document.getElementById('harga_tiket').value;
        var jumlah = document.getElementById('quantity').value;
        var result = parseInt(harga) * parseInt(jumlah);
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }
</script>
<?php include "footer.php"; ?>