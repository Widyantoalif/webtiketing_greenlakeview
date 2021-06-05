<?php
include('koneksi.php');

$query = mysqli_query($konek, "SELECT max(id_harga) as kodeTerbesar FROM harga");
$data = mysqli_fetch_array($query);
$id_harga = $data['kodeTerbesar'];
$urutan = (int) substr($id_harga, 3, 3);
$urutan++;
$angka = "h";
$harga_id = $angka . sprintf("%03s", $urutan);

// $query1 = mysqli_query($konek, "SELECT max(id_tagihan) as kodeTerbesar1 FROM tagihan");
// $data1 = mysqli_fetch_array($query1);
// $userid1 = $data1['kodeTerbesar1'];
// $urutan1 = (int) substr($userid1, 3, 3);
// $urutan1++;
// $angka1 = "TAG";
// $id_tagihan = $angka1 . sprintf("%03s", $urutan1);

$nama_tiketbaru = $_POST['nama_tiketbaru'];
$harga_baru = $_POST['harga_baru'];
$kategori = $_POST['kategori'];


mysqli_query($konek, "insert into harga (id_harga, nama_tiket, harga,kategori) values ('$harga_id', '$nama_tiketbaru', '$harga_baru', '$kategori')");
header('location:harga.php');
