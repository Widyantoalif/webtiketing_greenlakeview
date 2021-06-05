<?php
// Load file koneksi.php
require_once('phpqrcode/qrlib.php');
include('koneksi.php');
// Ambil Data yang Dikirim dari Form
$id_booking = $_POST['id_booking'];
$id_transaksi = $_POST['id_transaksi'];
$statusbooking = 'Aktif';
$statustransaksi = 'Sukses';
$id_user = $_SESSION['id_user'];
$query1 = mysqli_query($konek, "SELECT * from booking where id_booking = '$id_booking'");
while ($row = mysqli_fetch_assoc($query1)) {
    $qrvalue = $row["kode_booking"];
    $tempDir = "pdfqrcodes/";
    $codeContents = $qrvalue;
    $fileName = $qrvalue . '.png';
    $pngAbsoluteFilePath = $tempDir . $fileName;
    $urlRelativeFilePath = $tempDir . $fileName;
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
    }
}

$update_status = mysqli_query($konek, "UPDATE booking SET status = '$statusbooking' WHERE id_booking ='$id_booking'");
$update_transaksi = mysqli_query($konek, "UPDATE transaksi SET status = '$statustransaksi' WHERE id_transaksi ='$id_transaksi'");
// Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :


header("location: data_transaksi.php?id_user=$iduser&pesan=sukses"); // Redirectke halaman index.php
