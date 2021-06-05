<?php
include('koneksi.php');
date_default_timezone_set("Asia/Jakarta");
$query = mysqli_query($konek, "SELECT max(id_booking) as kodeTerbesar FROM booking");
$data = mysqli_fetch_array($query);
$id_booking = $data['kodeTerbesar'];
$urutan = (int) substr($id_booking, 3, 3);
$urutan++;
$angka = "BOK";
$id_book = $angka . sprintf("%03s", $urutan);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jumlah_tiket = $_POST['jumlah_tiket'];
    for ($i = 1; $i <= $jumlah_tiket; $i++) {
        $iduser = $_POST['id_user'];
        $id_konfig = $_POST['id_konfig'];
        $harga_tiket = $_POST['harga_tiket'];
        $id_tiket = $_POST['id_tiket'];
        $status = 'Menunggu pembayaran';
        $tanggal_pesan = date('Y-m-d');
        $randomnomor = rand(100, 1000000);
        $nama_tiket = $_POST['nama_tiket'];
        $id_harga = $_POST['id_harga'];
        $total = $_POST['total'];
        $harga = $_POST['harga'];
        $tanggal_to         = mktime(0, 0, 0, date('m') + 0, date('d') + 30, date('Y') + 0);
        $tanggal              = date('Y-m-d', $tanggal_to);
        $jam_pesan              = date('H:i');

        $jalan = mysqli_query($konek, "insert into booking (id_booking, id_user, tanggal_pesan, kode_booking , harga, status,id_harga,batas_penukaran,jam_pesan,id_konfig) values ('$id_book', '$iduser', '$tanggal_pesan', '$randomnomor','$harga_tiket' ,'$status','$id_tiket','$tanggal','$jam_pesan','$id_konfig')");
        header("location: tiketku.php");
    }
}
