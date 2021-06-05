<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Load file koneksi.php
    include('koneksi.php');
    // Ambil Data yang Dikirim dari Form

    $kode_tiket = $_POST['kode_tiket'];



    $cek_kodetiket = mysqli_query($konek, "select * from booking where kode_booking = '$kode_tiket'");
    $status_array = mysqli_fetch_array($cek_kodetiket);
    $kode = $status_array['status'];

    if (mysqli_num_rows($cek_kodetiket) < 1) {
        header("location: tukar_tiket.php?pesan=tidakditemukan");
    } elseif ($kode == "Telah digunakan") {

        header("location: tukar_tiket.php?pesan=telahdigunakan");
    } else {

        header("location: view_tukartiket.php?kode_tiket=$kode_tiket");
    }
}
?>




<!-- header("location: tukar_tiket.php?pesan=sukses"); // Redirectke halaman index.php -->