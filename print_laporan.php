<?php include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");
function tgl($tanggal)
{
    $bulan_arr    = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    // $hari_arr     = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    $ex           = explode('-', $tanggal);
    $hari         = date('N', strtotime($tanggal));
    $tanggal_indo = $ex[2] . ' ' . $bulan_arr[(int)$ex[1]] . ' ' . $ex[0];

    return $tanggal_indo;
}
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, '', '.');
    return $hasil_rupiah;
}
?>
<!-- <script> window.print();</script> -->
<!-- Font Awesome -->
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
<!-- Content Wrapper. Contains page content -->
<style>
    .borderless td,
    .borderless th {
        border: none;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: sans-serif; */
    }
</style>
<div class="container p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <hr>
            <div class="invoice p-3">
                <div class="col-md-12 text-center">
                    <h4>Laporan Transaksi</h4>
                </div>
            </div>
            <hr>
            <div class="col-md-6">
                <table class="table borderless">

                    <tr>
                        <th>Tanggal Laporan</th>
                        <td>: <?= tgl($_GET['dfrom']); ?> s/d <?= tgl($_GET['dto']); ?></td>
                    </tr>
                </table>
            </div>
            <table class="table table-bordered table-hover fixed nowrap">
                <tr>
                    <th align="center">No</th>
                    <th align="center">Tanggal Transaksi</th>
                    <th align="center">Jumlah Pemesanan</th>
                    <th align="center">Total</th>
                </tr>
                <tbody>
                    <?php
                    $no = 1;
                    $total_tr = 0;
                    $total_bn = 0;
                    $qtr = mysqli_query($konek, "SELECT SUM(harga) AS harga,COUNT(*) AS jumlah_harian,tanggal_pesan FROM booking WHERE tanggal_pesan BETWEEN '$_GET[dfrom]' AND '$_GET[dto]' GROUP BY tanggal_pesan");
                    while ($dtr = mysqli_fetch_array($qtr)) {
                        $harga[] = $dtr['harga'];
                        $total =  array_sum($harga);
                        // $total_tr = $total_tr + $dtr['total_transaksi'];
                        // $total_bn = $total_bn + $dtr['jumlah_transaksi'];
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo tgl($dtr['tanggal_pesan']) ?></td>
                            <td><?php echo $dtr['jumlah_harian'] ?></td>
                            <td><?php echo rupiah($dtr['harga']) ?></td>
                        </tr>
                    <?php } ?>

                </tbody>

            </table>
            <td align="right
            ">
                <B>Total Pemasukan
                    <?php
                    echo rupiah($total);
                    ?>
                </B>
            </td>
        </div>




    </div>
</div>
<script>
    window.print();
</script>