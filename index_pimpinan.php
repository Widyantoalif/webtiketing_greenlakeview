<?php include "header.php"; ?>
<script type="text/javascript" src="chartjs/Chart.js"></script>
<?php
include 'koneksi.php';
?>

<?php
$sqlcount = mysqli_query($konek, "SELECT count(*) AS jumlah FROM user");
$e = mysqli_fetch_array($sqlcount);
$lama = 1; // lama data yang tersimpan di database dan akan otomatis terhapus setelah 1 hari

// proses untuk melakukan penghapusan data

$query = "DELETE FROM booking WHERE tanggal_pesan = CURRENT_DATE - INTERVAL 1 DAY AND status = 'Menunggu pembayaran' ";
$hasil = mysqli_query($konek, $query);


$bln = date("m");
$hari = date("d");

$jumlah_pengunjung = mysqli_query($konek, "SELECT count(*) AS jumlah FROM `booking` where DAY(tanggal_penukaran) = '" . $hari . "' AND NOT status = 'Menunggu pembayaran'");
//echo "SELECT count(*) AS jumlah FROM `booking` where DAY(tanggal_pesan) = '" . $hari . "' AND NOT status = 'Menunggu pembayaran'";
$b = mysqli_fetch_array($jumlah_pengunjung);

$sqlsum = mysqli_query($konek, "SELECT SUM(harga) AS pemasukan FROM `booking` where MONTH(tanggal_pesan) = '" . $bln . "' AND NOT status = 'Menunggu pembayaran'");
//echo "SELECT SUM(harga) AS pemasukan FROM `booking` where MONTH(tanggal_pesan) = '" . $bln . "' AND NOT status = 'Menunggu pembayaran'";
$c = mysqli_fetch_array($sqlsum);

$sqlcount2 = mysqli_query($konek, "SELECT count(*) AS jumlah2 FROM user where level ='pengunjung'");
$jumlah_user = mysqli_fetch_array($sqlcount2);

$sqlcount3 = mysqli_query($konek, "SELECT count(*) AS jumlah_batal FROM booking where status ='Dibatalkan'");
$transaksi_dibatalkan = mysqli_fetch_array($sqlcount3);




?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $b['jumlah']  ?> Pengunjung</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan Bulanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $c['pemasukan']   ?> Rupiah</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User pengunjung</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah_user['jumlah2'] ?> User</div>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <a href="jatuh_tempo.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Transaksi Dibatalkan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $transaksi_dibatalkan['jumlah_batal'] ?> </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock-list fa-2x text-gray-300"></i>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->



    <!-- Content Row -->


</div>

<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: '',
                data: [
                    <?php
                    $januari = mysqli_query($konek, "select * from user where prodi='mi'");
                    echo mysqli_num_rows($jumlah_MI);
                    ?>,
                    <?php
                    $jumlah_ka = mysqli_query($konek, "select * from user where prodi='ka'");
                    echo mysqli_num_rows($jumlah_ka);
                    ?>,
                    <?php
                    $jumlah_ap = mysqli_query($konek, "select * from user where prodi='ap'");
                    echo mysqli_num_rows($jumlah_ap);
                    ?>,
                    <?php
                    $jumlah_dkv = mysqli_query($konek, "select * from user where prodi='dkv'");
                    echo mysqli_num_rows($jumlah_dkv);
                    ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<?php include "footer.php"; ?>