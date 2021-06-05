<?php
session_start();
include "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // variabel unutk menyimpoan kiriman dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == '' || $password == '') {
        echo "Form belum lengkap";
    } else {


        $sqllogin = mysqli_query($konek, "SELECT * from user WHERE email='$email' AND password='$password'");

        $jml = mysqli_num_rows($sqllogin);
        $d = mysqli_fetch_array($sqllogin);
        if ($jml > 0) {
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $d['id_user'];
            $_SESSION['email'] = $d['email'];
            $_SESSION['password'] = $d['email'];
            $_SESSION['level'] = $d['level'];

            if ($_SESSION['level'] == "admin") {
                header('location:index_admin.php');
            } elseif ($_SESSION['level'] == "pengunjung") {
                header('location:index.php');
            } elseif ($_SESSION['level'] == "pimpinan") {
                header('location:index_pimpinan.php');
            } else {
                header('location:index_pimpinan.php');
            }
        }
    }
}
