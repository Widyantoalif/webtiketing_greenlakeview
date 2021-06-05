<?php
include('koneksi.php');
$id_konfig = $_GET['id_konfig'];
mysqli_query($konek, "delete from konfigurasi_pembayaran where id_konfig='$id_konfig'");
header("location: data_metode.php?pesan=deletesukses");
