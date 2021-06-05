<!DOCTYPE html>
<html lang="en">
<?php
include('koneksi.php');
?>

<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    $id_user = $_SESSION['id_user'];
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // mysqli_query($konek, "delete from booking where DATEDIFF(CURDATE(), batas_penukaran)");
    $jumlah_tiket = $_POST['jumlah_tiket'];
    $nama_tiket = $_POST['nama_tiket'];
    $tanggal_pesan = date('Y-m-d');
    $total = $_POST['total'];
    $id_user = $_POST['id_user'];
    $id_tiket = $_POST['id_tiket'];
    $nama_tiket = $_POST['nama_tiket'];
    $harga_tiket = $_POST['harga_tiket'];
    $total = $_POST['total'];
    $sqlnama = mysqli_query($konek, "SELECT * FROM user where id_user ='$id_user'");
    while ($row = mysqli_fetch_assoc($sqlnama)) {
        $nama_pengunjung = $row["nama_user"];
        $email_pengunjunug = $row["email"];
        $notelp = $row["telp"];
?>

<?php
    }
    // if (empty($jumlah_tiket)) {
    //     echo "Name is empty";
    // } else {
    //     echo $jumlah_tiket;
    // }
}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>

    <?php
    function tgl($tanggal)
    {
        $bulan_arr    = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $hari_arr     = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $ex           = explode('-', $tanggal);
        $hari         = date('N', strtotime($tanggal));
        $tanggal_indo = $hari_arr[$hari] . ', ' . $ex[2] . ' ' . $bulan_arr[(int)$ex[1]] . ' ' . $ex[0];

        return $tanggal_indo;
    }

    function hari($date)
    {
        $hari_arr     = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $hari         = date('N', strtotime($date));
        return $hari_arr[$hari];
    }
    function rupiah($angka)
    {
        $hasil_rupiah = "" . number_format($angka, 0, '', '.');
        return $hasil_rupiah;
    }

    function rp($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 0, '', '.');
        return $hasil_rupiah;
    }

    date_default_timezone_set("Asia/Jakarta");
    ?>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 10000;
            background-size: 500px;
            background: url('img/Ellipsis-1.4s-200px.gif') 50% 50% no-repeat rgb(249, 249, 249);
            opacity: .8;
        }
    </style>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
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
                        Rincian Pemesanan
                        <br><br>
                        <address>
                            <br>
                            Terimakasih telah membeli tiket Green lake view waterpark.cek detail pembelian dan Lakukan Pembayaran <br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col">
                        <strong>Detail pembelian</strong><br><br>
                        <address>
                            Nama Tiket<br>
                            <strong><?php echo $nama_tiket; ?></strong><br><br>
                            Jumlah Tiket<br>
                            <b><?php echo $jumlah_tiket; ?></b>
                        </address>
                    </div>


                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col"><br><br>
                        Tanggal Pemesanan<br>
                        <b><?php echo tgl($tanggal_pesan)  ?></b><br><br>
                        Nama Pemesan<br>
                        <b><?php echo $nama_pengunjung; ?></b>
                    </div>

                    <div class="col-sm-6 invoice-col">
                        <address>
                            Total<br>
                            <strong>Rp. <?php echo rupiah($total) ?></strong><br><br>
                            No Telp<br>
                            <b><?php echo $notelp; ?></b>
                        </address>
                    </div>

                    <div class="col-sm-6 invoice-col">
                        Email<br>
                        <b>
                            <?php echo $email_pengunjunug; ?>
                        </b><br><br>
                        <br>
                        <b></b>
                    </div>



                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <form action="booking_user.php" method="POST">
                        <div class="card mb-4 col-12">
                            <br>
                            <h5><b>Pilih Metode Pembayaran</b></h5>
                            <div class="card-body">
                                <div class="row">
                                    <label id="jumlahnya"> Pilih Bank</label>
                                    <select id="id_konfig" name="id_konfig" class="selectpicker form-control" data-live-search="true" required>
                                        <option selected="true" disabled="disabled">Silahkan Pilih Bank</option>
                                        <?php
                                        $sql = mysqli_query($konek, "SELECT * FROM konfigurasi_pembayaran");
                                        while ($data = mysqli_fetch_array($sql)) {

                                            echo "<option  
                      value='$data[id_konfig]'>$data[metode]
                      </option> ";
                                        }
                                        ?>
                                    </select>
                                    <br>

                                    <div class="col-md-6">
                                        <div class="icon icon-hourglass bg"></div>
                                    </div>

                                    <input name="id_user" id="id_user" type="hidden" value="<?php echo $id_user; ?>" readonly>
                                    <input name="harga" id="harga" type="hidden" class="form-control" value="<?php echo $total; ?>" readonly>
                                    <input name="nama_tiket" id="nama_tiket" type="hidden" class="form-control" value="<?php echo $nama_tiket; ?>" readonly>
                                    <input name="id_tiket" id="id_tiket" type="hidden" class="form-control" value="<?php echo $id_tiket; ?>" readonly>
                                    <input name="jumlah_tiket" id="jumlah_tiket" type="hidden" class="form-control" value="<?php echo $jumlah_tiket; ?>" readonly>
                                    <input name="total" id="total" type="hidden" class="form-control" value="<?php echo $total; ?>" readonly>
                                    <input name="id_harga" id="id_harga" type="hidden" class="form-control" value="<?php echo $id_tiket; ?>" readonly>
                                    <input name="harga_tiket" id="harga_tiket" type="hidden" class="form-control" value="<?php echo $harga_tiket; ?>" readonly>
                                    <br>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" type='submit' name='submit' value='Lanjutkan'>

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