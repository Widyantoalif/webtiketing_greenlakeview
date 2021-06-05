<!DOCTYPE html>
<?php
// defenisikan koneksi
require('koneksi.php');
// cek apakah tombol simpan sudah ditekan
if (isset($_POST['submit'])) {
  $query = mysqli_query($konek, "SELECT max(id_user) as kodeTerbesar FROM user");
  $data = mysqli_fetch_array($query);
  $userid = $data['kodeTerbesar'];
  $urutan = (int) substr($userid, 3, 3);
  $urutan++;
  $angka = "100";
  $iduser = $angka . sprintf("%03s", $urutan);

  //$query2 = mysqli_query($konek, "SELECT max(id_mahasiswa) as mahasiswaterbesar FROM mahasiswa");
  //$data = mysqli_fetch_array($query2);
  //$idmahasiswa = $data['mahasiswaterbesar'];
  //$urutan2 = (int) substr($idmahasiswa, 3, 3);
  //$urutan2++;
  //$angka2 = "200";
  //$mahasiswa_id = $angka2.sprintf("%03s", $urutan2);

  // jika sudah, ambil nilai masing-masing field
  $id_user = $iduser;
  $nama    = $_POST['nama'];
  $telp       = $_POST['telp'];
  $alamat       = $_POST['alamat'];
  $password       = $_POST['password'];
  $email       = $_POST['email'];
  $level       = "pengunjung";
  //$tingkat       = "1";

  $sql = "INSERT INTO user(id_user,nama_user,telp,alamat,level,email,password)
        VALUES('$id_user','$nama','$telp','$alamat','$level','$email','$password')";
  echo "INSERT INTO user(id_user,nama_user,telp,alamat,level,email,password)
        VALUES('$id_user','$nama','$telp','$alamat','$level','$email','$password')";
  // cek apakah proses simpan berhasil

  // $sql2 = "INSERT INTO mahasiswa(id_mahasiswa,id_user,nim,nama,tingkat)
  //VALUES('$mahasiswa_id','$id_user','$nim','$nama','$tingkat')";        
  // cek apakah proses simpan berhasil

  if (mysqli_query($konek, $sql)) {
    // jika berhasil, redirect ke index.php
    header('Location:index.php');
  } else {
    // jika tidak, tampilkan pesan gagal menyimpan
    echo "Ouppsss..., maap proses menyimpan data tidak berhasil";
  }
}
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form action="" method="POST" class="user">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nama" id="nama" placeholder="Nama lengkap ">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="telp" id="telp" placeholder="Nomor Telpon ">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="alamat" id="alamat" placeholder="Alamat">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="password">
                </div>
                <input id="submit" type="submit" class="btn btn-primary btn-user btn-block" type='submit' name='submit' value='Register'>

                </a>
                <hr>
              </form>
              <hr>

              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>