<?php
// Load file koneksi.php
include('koneksi.php');
// Ambil Data yang Dikirim dari Form
$nama = $_GET['nama'];
$notelp = $_GET['notelp'];
$alamat = $_GET['alamat'];
$email = $_GET['email'];
$id_user = $_GET['id_user'];
$email = $_GET['email'];
$level = $_GET['level'];
$password  = $_GET['password'];

mysqli_query($konek, "UPDATE user SET nama_user ='$nama',telp ='$notelp',alamat = '$alamat',email = '$email', password = '$password',level = '$level' WHERE id_user ='$id_user'");
// Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: data_user.php");
