<?php
include('koneksi.php');
$id_harga = $_GET['id_tiket'];
mysqli_query($konek, "delete from harga where id_harga='$id_harga'");
header("location: harga.php?pesan=sukses");
