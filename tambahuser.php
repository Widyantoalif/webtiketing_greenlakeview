<?php
include('koneksi.php');

$query = mysqli_query($konek, "SELECT max(id_user) as kodeTerbesar FROM user");
$data = mysqli_fetch_array($query);
$id_harga = $data['kodeTerbesar'];
$urutan = (int) substr($id_harga, 3, 3);
$urutan++;
$angka = "100";
$harga_id = $angka . sprintf("%03s", $urutan);
$id_user = $harga_id;


$nama    = $_POST['nama'];
$telp       = $_POST['notelp'];
$alamat       = $_POST['alamat'];
$password       = $_POST['password'];
$email       = $_POST['email'];
$level       = $_POST['level'];



mysqli_query($konek, "insert into user (id_user,nama_user,telp,alamat,level,email,password) VALUES('$id_user','$nama','$telp','$alamat','$level','$email','$password')");
//echo "INSERT INTO user(id_user,nama_user,telp,alamat,level,email,password)VALUES('$id_user','$nama','$telp','$alamat','$level','$email','$password'";
header('location:data_user.php');
