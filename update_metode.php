<?php
// Load file koneksi.php
include('koneksi.php');
// Ambil Data yang Dikirim dari Form
$id_konfig = $_GET['id_konfig'];
$metode = $_GET['metode'];
$no_rek = $_GET['no_rek'];
$nama = $_GET['nama'];

mysqli_query($konek, "UPDATE konfigurasi_pembayaran SET id_konfig ='$id_konfig',metode ='$metode',no_rek ='$no_rek',nama = '$nama' WHERE id_konfig ='$id_konfig'");
// Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: data_metode.php?pesan=updatesukses"); // Redirectke halaman index.php
