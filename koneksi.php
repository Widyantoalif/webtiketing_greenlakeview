<?php
//variabel koneksi
$konek = mysqli_connect("localhost", "root", "", "tiket");

if (!$konek) {
	echo "Koneksi Database Gagal...!!!";
}
