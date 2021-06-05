<?php
// Load file koneksi.php
include('koneksi.php');
// Ambil Data yang Dikirim dari Form
$id_booking = $_GET['id_booking'];
$status = "Dibatalkan";

mysqli_query($konek, "UPDATE booking SET status ='$status' WHERE id_booking ='$id_booking'");
// Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: tiketku.php"); // Redirectke halaman index.php
