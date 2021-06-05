<?php include "header.php"; ?>
<?php
$query = mysqli_query($konek, "select * from user where id_user = '$_SESSION[id_user]'");
$id_user1 = mysqli_fetch_array($query);
$id_user = $_SESSION['id_user'];
$idnya = $id_user1['id_user'];
// echo $idnya;
// $id_harga = $_GET['id_harga'];
// $jumlah_tiket = $_GET['jumlah_tiket'];
// $harga = $_GET['harga'];
// $total = $_GET['total'];
// $iduser = $_GET['id_user'];
// $id_booking = $_GET['id_booking'];
//echo $_SESSION['id_user'];
//echo $id_user
?>

<link rel="stylesheet" href="jquery-ui.css">
<script type="text/javascript" src="chartjs/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="jquery.js"></script>
<script src="jquery-ui.js"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/themes/blitzer/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<?php
include 'koneksi.php';
?>

<?php
$sqlcount = mysqli_query($konek, "SELECT count(*) AS jumlah  FROM booking where id_user = '$id_user'");
$e = mysqli_fetch_array($sqlcount);
function manipulasiTanggal($jam, $jumlahnya = 1, $format = 'days')
{
    $currentDate = new DateTime($jam);
    $currentDate->modify($jumlahnya . ' ' . $format);
    return $currentDate->format('Y-m-d');
}
// echo $e['jumlah'];

?>


<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tiketku</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pembelian </h6>
                </div>

                <div class="card-body">
                    <?php
                    $sqlharga = mysqli_query($konek, "select * from booking where id_user like '%$id_user%' group by id_booking ");
                    // echo "select * from booking where id_user = '$id_user' group by id_booking";
                    while ($harga = mysqli_fetch_array($sqlharga)) {
                        $sqltotal = mysqli_query($konek, "select sum(harga) as jumlah from booking where id_booking = '$harga[id_booking]'");
                        $jumlah = mysqli_fetch_array($sqltotal);
                        $namatiket = mysqli_query($konek, "select * from harga where id_harga = '$harga[id_harga]' group by id_harga");
                        $namanya = mysqli_fetch_array($namatiket);
                        //echo "select * from harga where id_harga = '$harga[id_harga]' group by id_harga";
                        //echo "select sum(harga) as jumlah from booking where id_booking = '$harga[id_booking]'";
                        $jumlahid = mysqli_query($konek, "SELECT count(*) AS jumlahid FROM booking WHERE id_booking ='$harga[id_booking]'");
                        $seluruhid = mysqli_fetch_array($jumlahid);
                        $status = $harga['status'];
                        $id_harganya = $harga['id_harga'];
                        $tgl_pesan = $harga['tanggal_pesan'];
                        $jam_pesan = $harga['jam_pesan'];
                        $id_konfig = $harga['id_konfig'];
                        //echo $id_harganya;
                        // echo $tgl_pesan;
                        // echo $jam_pesan;
                        // echo $status;
                        // echo $jam_pesan;
                        $ininama = $namanya['nama_tiket'];

                        //echo $seluruhid['jumlahid'];
                        $id_booking = $harga['id_booking'];
                        $harganya = $namanya['harga'];
                        // $tanggal_to         = mktime(0, 0, 0, date('m') + 0, date('d') + 1, date('Y') + 0);
                        // $tanggal              = date();
                        echo "<br>";
                        // echo $tanggal;



                    ?>
                        <div class="card">
                            <div class="card-header">Tiket &nbsp;<?php echo $namanya['nama_tiket']; ?>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                        $kategorinya = $namanya['kategori'];
                                        $ininama;
                                        if ($kategorinya == "weekday") {
                                        ?>
                                            <div class="icon icon-hourglass bg"></div><a href="" data-toggle="modal" data-target="#modaldetailweekday<?php echo $id_booking; ?>">Detail</a>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="icon icon-hourglass bg"></div><a href="" data-toggle="modal" data-target="#modaldetailweekend<?php echo $id_booking; ?>">Detail</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="mr-2">
                                            <?php
                                            if ($status == "Menunggu pembayaran") {
                                            ?>
                                                <div class="bg-warning"></div><b>Menunggu Pembayaran</b>
                                            <?php
                                            } elseif ($status == "Menunggu konfirmasi") {
                                            ?>
                                                <div class="bg-warning"></div><b>Sedang Diproses</b>
                                            <?php
                                            } elseif ($status == "Aktif") {
                                            ?>
                                                <div class="bg-warning"></div><b>Tiket aktif</b>
                                            <?php
                                            } elseif ($status == "Dibatalkan") {
                                            ?>
                                                <div class="bg-warning"></div><b>Dibatalkan</b>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="bg-warning"></div><b>Tiket Tidak aktif</b>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label id="harga" type="text">Total Rp.<?= $jumlah['jumlah'] ?></label>
                                    </div>
                                    <?php
                                    if ($status == "Menunggu pembayaran") {
                                    ?>
                                        <div class="col-md-6 text-right">
                                            <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modaltransfer<?php echo $id_booking; ?>">Bayar</a>
                                            <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modalbatal<?php echo $id_booking; ?>">Batalkan Pembelian</a>
                                        </div>
                                    <?php
                                    } elseif ($status == "Menunggu konfirmasi") {
                                    ?>
                                        <div class="col-md-6 text-right">
                                            <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modalkonfirmasi<?php echo $id_booking; ?>">Cek Tiket</a>
                                        </div>
                                    <?php
                                    } elseif ($status == "Tidak aktif") {
                                    ?>
                                        <div class="col-md-6 text-right">
                                            <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modalcektiket<?php echo $id_booking; ?>">Cek Tiket</a>
                                        </div>
                                    <?php
                                    } elseif ($status == "Dibatalkan") {
                                    ?>
                                        <div class="col-md-6 text-right">
                                            <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="">Dibatalkan</a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-md-6 text-right">
                                            <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modalcektiket<?php echo $id_booking; ?>">Cek Tiket</a>
                                        </div>
                                    <?php


                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <br>


                        <div class="modal fade" id="modaltransfer<?php echo $id_booking; ?>" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal pembayaran-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col section-1 section-description">
                                                <div class="text-center">
                                                    <?php
                                                    $query_konfig = mysqli_query($konek, "select * from konfigurasi_pembayaran where id_konfig = '$id_konfig'");
                                                    $nama_bank = mysqli_fetch_array($query_konfig);
                                                    $bank_name = $nama_bank['metode'];
                                                    $nomor_rekening = $nama_bank['no_rek'];
                                                    ?>
                                                    <h5><b>Silahkan melakukan pembayaran Ke No Rekening</b> <br>
                                                        <?php echo $bank_name; ?> - <?php echo $nomor_rekening; ?> <br>


                                                    </h5>
                                                    <?php
                                                    //echo $jam_pesan;
                                                    //echo $tgl_pesan;
                                                    // function manipulasiTanggal($jam_pesan, $jumlahnya = 1, $format = 'days')
                                                    // {
                                                    //     $currentDate = new DateTime($jam_pesan);
                                                    //     $currentDate->modify($jumlahnya . ' ' . $format);
                                                    //     return $currentDate->format('Y-m-d');
                                                    // }
                                                    // $tgl = '2021-03-20';
                                                    // $tanggal_pemesanan = manipulasiTanggal($jam_pesan, '1', 'days');

                                                    ?>


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
                                                <input type="hidden" name="id_user" id="id_user" class="form-control" value="<?php echo $idnya; ?>">
                                                <input type="hidden" name="jumlah_tiket" id="jumlah_tiket" class="form-control" value="<?php echo $seluruhid['jumlahid']; ?>">
                                                <input type="hidden" name="id_booking" id="id_booking" class="form-control" value="<?php echo $harga['id_booking']  ?>">
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
                        <div class="modal fade" id="modalbatal<?php echo $id_booking; ?>" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal pembayaran-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col section-1 section-description">
                                                <div class="text-center">
                                                    <?php
                                                    $query_konfig = mysqli_query($konek, "select * from konfigurasi_pembayaran where id_konfig = '$id_konfig'");
                                                    $nama_bank = mysqli_fetch_array($query_konfig);
                                                    $bank_name = $nama_bank['metode'];
                                                    $nomor_rekening = $nama_bank['no_rek'];
                                                    ?>
                                                    <h5><b>Apakah Anda Yakin Membatalkan Pemesanan Tiket???</b> <br>
                                                    </h5>
                                                    <?php
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="batal_pemesanan.php" method="GET">
                                            <div class="form-group">
                                                <label>id booking</label>
                                                <input type="text" name="id_booking" id="id_booking" class="form-control" value="<?php echo $harga['id_booking']  ?>">
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




                        <div class="modal fade" id="modaldetailweekend<?php echo $id_booking; ?>" role="dialog">
                            <div class="modal-dialog modal-md">

                                <!-- Modal tiket sudah aktif-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tiket aktif</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card mb-4">
                                            <!-- Card Header - Accordion -->
                                            <a href="#collapseCardExampleweekend" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Deskripsi</h6>
                                            </a>
                                            <!-- Card Content - Collapse -->
                                            <div class="collapse show" id="collapseCardExampleweekend">
                                                <div class="card-body">
                                                    - Berlaku pada hari Sabtu – Minggu.<br>
                                                    - Tiket berlaku 30 hari setelah tanggal pembelian.
                                                </div>
                                            </div>
                                        </div>
                                        <form role="form" action="" method="POST">
                                            <?php
                                            $id_bookingnya = $id_booking;
                                            ?>
                                            <?php

                                            $query1 = mysqli_query($konek, "SELECT * FROM booking where id_booking = '$id_bookingnya'");
                                            $no = 1;

                                            while ($row = mysqli_fetch_assoc($query1))

                                            ?>
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Accordion -->
                                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <h6 class="m-0 font-weight-bold text-primary">Detail tiket</h6>
                                                </a>
                                                <!-- Card Content - Collapse -->
                                                <div class="collapse show" id="collapseCardExample">
                                                    <div class="card-body">
                                                        <label>Nama tiket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $namanya['nama_tiket']; ?></label><br>
                                                        <label>Jumlah tiket&nbsp;&nbsp;&nbsp;: <?php echo $seluruhid['jumlahid']; ?></label><br>
                                                        <label>Harga tiket&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $harganya; ?></label><br>
                                                    </div>
                                                </div>
                                            </div>



                                            </tbody>
                                            </table>

                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Keluar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>










                        <div class="modal fade" id="modaldetailweekday<?php echo $id_booking; ?>" role="dialog">
                            <div class="modal-dialog modal-md">

                                <!-- Modal tiket sudah aktif-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tiket aktif</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card mb-4">
                                            <!-- Card Header - Accordion -->
                                            <a href="#collapseCardExampleweekday" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Deskripsi</h6>
                                            </a>
                                            <!-- Card Content - Collapse -->
                                            <div class="collapse show" id="collapseCardExampleweekday">
                                                <div class="card-body">
                                                    - Berlaku pada hari Senin – Jumat.<br>
                                                    - Tiket berlaku 30 hari setelah tanggal pembelian.
                                                </div>
                                            </div>
                                        </div>
                                        <form role="form" action="" method="POST">
                                            <?php
                                            $id_bookingnya = $id_booking;
                                            ?>
                                            <?php

                                            $query1 = mysqli_query($konek, "SELECT * FROM booking where id_booking = '$id_bookingnya'");
                                            $no = 1;

                                            while ($row = mysqli_fetch_assoc($query1))

                                            ?>
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Accordion -->
                                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <h6 class="m-0 font-weight-bold text-primary">Detail tiket</h6>
                                                </a>
                                                <!-- Card Content - Collapse -->
                                                <div class="collapse show" id="collapseCardExample">
                                                    <div class="card-body">
                                                        <label>Nama tiket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $namanya['nama_tiket']; ?></label><br>
                                                        <label>Jumlah tiket&nbsp;&nbsp;&nbsp;: <?php echo $seluruhid['jumlahid']; ?></label><br>
                                                        <label>Harga tiket&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $harganya; ?></label><br>
                                                    </div>
                                                </div>
                                            </div>



                                            </tbody>
                                            </table>

                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Keluar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>





                        <!-- modal konfirmasi -->
                        <div class="modal fade" id="modalkonfirmasi<?php echo $id_booking; ?>" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal detail-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col section-1 section-description">
                                                <div class="text-center">
                                                    <h5>Tiket</h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Accordion -->
                                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Detail tiket</h6>
                                            </a>
                                            <!-- Card Content - Collapse -->
                                            <div class="collapse show" id="collapseCardExample">
                                                <div class="card-body">
                                                    <label>Nama tiket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $namanya['nama_tiket']; ?></label><br>
                                                    <label>Jumlah tiket&nbsp;&nbsp;&nbsp;: <?php echo $seluruhid['jumlahid']; ?></label><br>
                                                    <label>Harga tiket&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $harganya; ?></label><br>
                                                    <label>Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $status; ?></label><br>
                                                </div>
                                            </div>
                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Keluar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="modal fade" id="modalcektiket<?php echo $id_booking; ?>" role="dialog">
                            <div class="modal-dialog modal-md">

                                <!-- Modal tiket sudah aktif-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tiket aktif</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="" method="POST">
                                            <?php
                                            $id_bookingnya = $id_booking;
                                            ?>
                                            <?php

                                            $query1 = mysqli_query($konek, "SELECT * FROM booking where id_booking = '$id_bookingnya'");
                                            $no = 1;

                                            while ($row = mysqli_fetch_assoc($query1)) {

                                            ?>
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Accordion -->
                                                    <!-- <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                        <h6 class="m-0 font-weight-bold text-primary">Detail tiket</h6>
                                                    </a> -->
                                                    <!-- Card Content - Collapse -->
                                                    <!-- <div class="collapse show" id="collapseCardExample">
                                                        <div class="card-body">
                                                            <label>Nama tiket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $namanya['nama_tiket']; ?></label><br>
                                                            <label>Jumlah tiket&nbsp;&nbsp;&nbsp;: <?php echo $seluruhid['jumlahid']; ?></label><br>
                                                            <label>Harga tiket&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $harganya; ?></label><br>
                                                            <label>Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $status; ?></label><br>
                                                        </div>
                                                    </div> -->
                                                </div>

                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Accordion -->
                                                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                        <h6 class="m-0 font-weight-bold text-primary">Kode Tiket:&nbsp;&nbsp;&nbsp; <?php echo $row['kode_booking'] ?></h6>
                                                        <h6 class="m-0 font-weight-bold text-primary">Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['status'] ?></h6>
                                                        <h6 class="m-0 font-weight-bold text-primary">Berlaku:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo tgl($row['batas_penukaran']) ?></h6>
                                                    </a>
                                                    <!-- Card Content - Collapse -->
                                                    <div class="collapse show" id="collapseCardExample" text-align="center">
                                                        <div class="card-body text-center">
                                                            <img src="pdfqrcodes/<?= $row['kode_booking'] . '.png' ?>" width="70%" text-align="center"><br>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php
                                            }
                                            ?>


                                            </tbody>
                                            </table>

                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Keluar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>

                </div>


            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow mb-4 p-4 ">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Yang Harus kamu ketahui </h6>
                </div>
                <div class="card shadow mb-4 p-4">
                    <a href="#collapseCardExamplesyarat" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Syarat dan ketentuan</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExamplesyarat">
                        <div class="card-body">
                            - Berlaku pada hari Sabtu & minguu.<br>
                            - Tiket berlaku 30 hari setelah tanggal pembelian.
                        </div>
                    </div>
                    <a href="#collapseCardExamplepenukaran" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Penukaran Tiket</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExamplepenukaran">
                        <div class="card-body">
                            - Berlaku pada hari Sabtu & minguu.<br>
                            - Tiket berlaku 30 hari setelah tanggal pembelian.
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.datepicker').datepicker({
        daysOfWeekDisabled: [0, 6]
    });
</script>

<script type="text/javascript">
    function sum() {
        var harga = document.getElementById('harga_tiket').value;
        var jumlah = document.getElementById('quantity').value;
        var result = parseInt(harga) * parseInt(jumlah);
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }
    $('#nama_kartu').change(function() {
        var input = $(this).val();
        console.log(input)
        if (input.length == 6) {
            console.log("data sudah 6")
        }
    })
</script>
<?php include "footer.php"; ?>