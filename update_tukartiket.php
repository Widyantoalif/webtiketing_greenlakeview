<?php
// Load file koneksi.php
include('koneksi.php');
// Ambil Data yang Dikirim dari Form
$kode_tiket = $_POST['kode_tiket'];
$statusbooking = 'Telah digunakan';
$tanggal_penukaran = date('Y-m-d');


mysqli_query($konek, "UPDATE BOOKING SET STATUS ='$statusbooking' , tanggal_penukaran = '$tanggal_penukaran' WHERE kode_booking ='$kode_tiket'");
// Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: tukar_tiket.php?pesan=sukses"); // Redirectke halaman index.php
