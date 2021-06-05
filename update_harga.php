<?php
// Load file koneksi.php
include('koneksi.php');
// Ambil Data yang Dikirim dari Form
$id_harga = $_GET['id_harga'];
$nama_tiket = $_GET['nama_tiket'];
$harga = $_GET['harga'];
$kategori = $_GET['kategori_update'];

mysqli_query($konek, "UPDATE harga SET nama_tiket ='$nama_tiket',harga ='$harga',kategori ='$kategori' WHERE id_harga ='$id_harga'");
// Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: harga.php"); // Redirectke halaman index.php
