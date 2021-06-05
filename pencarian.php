<?php
if (isset($_POST["Search"])) {
    include "koneksi.php";
    $tanggal_from   = $_POST['tanggal_from'];
    $tanggal_to     = $_POST['tanggal_to'];

    // mysqli_query($koneksi,"DELETE FROM laporan_transaksi WHERE tanggal_transaksi BETWEEN '$tanggal_from' AND '$tanggal_to'");

    // mysqli_query($koneksi,"INSERT INTO laporan_transaksi 
    // SELECT t.id_transaksi, t.id_customer, c.nama_customer, t.tanggal_transaksi, t.jumlah_transaksi, t.total_transaksi 
    // FROM transaksi t INNER JOIN customer c on c.id_customer = t.id_customer WHERE tanggal_transaksi 
    // BETWEEN '$tanggal_from' AND '$tanggal_to'");

    header("location:laporan_transaksi.php?dfrom=$tanggal_from&dto=$tanggal_to");
}
