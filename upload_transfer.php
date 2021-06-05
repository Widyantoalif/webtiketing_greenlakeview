<?php
// Load file koneksi.php
include('koneksi.php');
// Ambil Data yang Dikirim dari Form
$id_booking = $_POST['id_booking'];
$iduser = $_POST['id_user'];
$nama_kartu = $_POST['nama_kartu'];
$nama_file = $_FILES['upload']['name'];
$tmp_file = $_FILES['upload']['tmp_name'];
$status = 'Menunggu konfirmasi';
$jumlah_tiket = $_POST['jumlah_tiket'];

// Set path folder tempat menyimpan gambarnya
$path = "images/" . $nama_file;
$query = mysqli_query($konek, "SELECT max(id_transaksi) as kodeTerbesar FROM transaksi");
$data = mysqli_fetch_array($query);
$id_transaksi = $data['kodeTerbesar'];
$urutan = (int) substr($id_transaksi, 3, 3);
$urutan++;
$angka = "TRA";
$id_transaksinya = $angka . sprintf("%03s", $urutan);
$tanggal_transaksi = date('Y-m-d');
$belum_bayar = 'Menunggu konfirmasi';
// Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
// Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
// Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
// Jika ukuran file kurang dari sama dengan 1MB, lakukan :
// Proses upload
if (move_uploaded_file($tmp_file, $path)) { // Cek apakah gambar berhasil diupload atau tidak
    // Jika gambar berhasil diupload, Lakukan :  
    // Proses simpan ke Database
    mysqli_query($konek, "UPDATE booking SET status = '$status' WHERE id_booking ='$id_booking'");
    mysqli_query($konek, "insert into transaksi (id_transaksi,id_user, id_booking, nama_kartu, bukti_pembayaran,jumlah_tiket,tanggal_transaksi,status) values ('$id_transaksinya', '$iduser', '$id_booking', '$nama_kartu', '$nama_file', '$jumlah_tiket','$tanggal_transaksi','$belum_bayar')");
    // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: tiketku.php?id_user=$iduser"); // Redirectke halaman index.php

}
