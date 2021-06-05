<?php
include('koneksi.php');

$query = mysqli_query($konek, "SELECT max(id_konfig) as kodeTerbesar FROM konfigurasi_pembayaran");
$data = mysqli_fetch_array($query);
$id_konfig = $data['kodeTerbesar'];
$urutan = (int) substr($id_konfig, 3, 3);
$urutan++;
$angka = "k";
$konfig_id = $angka . sprintf("%03s", $urutan);



$metode = $_POST['metode'];
$no_rek = $_POST['no_rek'];
$nama = $_POST['nama'];


mysqli_query($konek, "insert into konfigurasi_pembayaran (id_konfig, metode, no_rek,nama) values ('$konfig_id', '$metode', '$no_rek', '$nama')");
header("location: data_metode.php?pesan=insertsukses");
