<?php include "header.php"; ?>
<?php
include('koneksi.php');
?>
<?php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    echo $id_user = $_SESSION['id_user'];
}

$kode_tiket = $_GET['kode_tiket'];
// echo $kode_tiket;
?>


<?php
// require_once('phpqrcode/qrlib.php');
$query1 = mysqli_query($konek, "SELECT booking.id_booking ,booking.id_harga,user.id_user,user.nama_user,user.email,booking.tanggal_pesan, booking.kode_booking,user.alamat, user.telp ,booking.harga,booking.status,booking.batas_penukaran FROM booking INNER JOIN user on user.id_user = booking.id_user where booking.kode_booking = '$kode_tiket' GROUP BY id_booking");
$no = 1;
//$querycount = mysqli_query($konek, "SELECT COUNT(id_user) AS jumlahtiket FROM booking where id_user = '100002' AND status= 'Menunggu konfirmasi'");
while ($row = mysqli_fetch_assoc($query1)) {
    $qrvalue = $row["kode_booking"];
    $jumlahidbook = mysqli_query($konek, "SELECT count(*) AS jumlahidbook FROM booking WHERE id_booking ='$row[id_booking]'");
    $seluruhidbook = mysqli_fetch_array($jumlahidbook);
    $nama_tiket = mysqli_query($konek, "select * from harga where id_harga = '$row[id_harga]'");
    $array_namatiket = mysqli_fetch_array($nama_tiket);
    $idbooknya = $seluruhidbook['jumlahidbook'];
    $id_booking = $row["id_booking"];
    $nama_pengunjung = $row["nama_user"];
    $status_tiket = $row["status"];
    $tanggal_pesan = $row["tanggal_pesan"];
    $name_tiket = $array_namatiket["nama_tiket"];
    $email_user = $row['email'];
    $no_telp = $row['telp'];
    $batas_penukaran = $row['batas_penukaran'];
    $kode_booking = $row['kode_booking'];
    // echo $id_booking;
    // echo $nama_pengunjung;
    // echo $status_tiket;
    // echo $name_tiket;
    // echo $tanggal_pesan;
    // echo $email_user;
    // echo $batas_penukaran;

?>
<?php
}
?>


<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Detail Tiket user</h6>
            <div class="dropdown no-arrow">
            </div>
        </div>
        <div class="card-body">
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i></i> Halo, <?php echo $nama_pengunjung; ?>
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
                            <b><?php echo $status_tiket; ?></b>
                        </address>
                    </div>


                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col"><br><br>
                        Tanggal Pemesanan<br>
                        <b><?php echo tgl($tanggal_pesan) ?></b><br><br>
                        Email<br>
                        <b><?php echo $email_user; ?></b>
                    </div>

                    <div class="col-sm-6 invoice-col">
                        <address>
                            Paket Tiket<br>
                            <strong>Tiket <?php echo $name_tiket; ?></strong><br><br>
                            Nama pemesan<br>
                            <b>Alif widiyanto</b>
                        </address>
                    </div>

                    <div class="col-sm-6 invoice-col">
                        Nomor Telepon<br>
                        <b><?php echo $no_telp; ?></b>
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="card mb-4 col-12">
                        <br>
                        <div class="col-md-6">
                            <h5><b>Tiket <?php echo $name_tiket; ?></b></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> Berlaku hingga</label></div>
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> <?php echo tgl($batas_penukaran) ?></label></div>
                                </div>
                                <div class="col-md-6">
                                    <div id="totalnya">Alamat</div>
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> jl.bogor km 38 cimanggis</label></div>
                                </div>
                                <br>

                                <div class="col-md-6">
                                    <div class="icon icon-calendar dark" id="totalnya">Kode booking</div>
                                    <div class="icon icon-hourglass bg"><label id="jumlahnya"> <?php echo $kode_booking; ?></label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row no-print">
                    <div class="col-12">
                        <div class="form-group">
                            <form role="form" action="update_tukartiket.php" method="POST">
                                <input type="hidden" name="kode_tiket" id="kode_tiket" class="form-control" value="<?php echo $kode_booking; ?>">
                                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Tukar Tiket
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <?php include "footer.php"; ?>