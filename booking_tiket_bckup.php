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
        $harga = $_POST['harga'];
        $kode_tiket = $_POST['id_tiket'];
        $status = 'Menunggu pembayaran';
        $tanggal_pesan = date('Y-m-d');
        $jam_pesan = 'Menunggu pembayaran';
        $randomnomor = rand(100000, 999999);
        $nama_tiket = $_POST['nama_tiket'];
        $id_harga = $_POST['id_harga'];
        $total = $_POST['total'];
        $harga = $_POST['harga'];

        //$bulan = date('m', strtotime($jatuhtempo)) . " " . date('Y', strtotime($jatuhtempo));
        //$tempo_bulan        = mktime(0, 0, 0, date('m') + $i, date('d') + 0, date('Y') + 0);
        //$tempo              = date($tanggal_rencana, $tempo_bulan);
        $jalan = mysqli_query($konek, "insert into booking (id_booking, id_user, tanggal_pesan, tanggal_booking, kode_booking , harga, status,id_harga,jam_pesan) values ('$id_book', '$iduser', '$tanggal_pesan','$tanggal_kunjungan', '$randomnomor','$harga' ,'$status','$id_harga','$jam_pesan')");
        header("location:tiketku.php");
    }
}
