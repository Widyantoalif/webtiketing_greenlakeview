<?php include "header.php"; ?>
<?php
include('koneksi.php');
?>
<?php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    echo $id_user = $_SESSION['id_user'];
}
?>

<div class="container-fluid">
    <!-- <?php
            echo $id_user = $_SESSION['id_user'];
            ?> -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>


            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="cetak.php">Cetak PDF</a>
                    <a class="dropdown-item" href="#">Excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == 'sukses') {

                ?>
                        <script>
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Sukses Konfirmasi Pembayaran',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        </script>
                <?php
                    }
                }
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th style="display:none;">Id transaksi</th>
                            <th style="display:none;">Id user</th>
                            <th style="display:none;">Id booking</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telp</th>
                            <th>Bukti Pembayaran</th>
                            <th>Detail Transaksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query1 = mysqli_query($konek, "SELECT transaksi.nama_kartu,transaksi.status,transaksi.id_transaksi,transaksi.id_user,transaksi.id_booking,transaksi.nama_kartu,transaksi.bukti_pembayaran,transaksi.jumlah_tiket,transaksi.tanggal_transaksi,user.nama_user,user.telp,user.email FROM transaksi INNER JOIN  user ON user.id_user = transaksi.id_user where user.level = 'pengunjung' GROUP BY id_booking");
                        $no = 1;
                        //$querycount = mysqli_query($konek, "SELECT COUNT(id_user) AS jumlahtiket FROM booking where id_user = '100002' AND status= 'Menunggu konfirmasi'");
                        while ($row = mysqli_fetch_assoc($query1)) {
                            $jumlahidbook = mysqli_query($konek, "SELECT count(*) AS jumlahidbook FROM booking WHERE id_booking ='$row[id_booking]' ");
                            $seluruhidbook = mysqli_fetch_array($jumlahidbook);
                            $idbooknya = $seluruhidbook['jumlahidbook'];
                            //echo $idbooknya;
                        ?>

                            <tr>
                                <td align="center"><?php echo $no++ ?></td>
                                <td align="center" style="display:none;"><?php echo $row['id_transaksi']; ?></td>
                                <td align="center" style="display:none;"><?php echo $row['id_user'] ?></td>
                                <td align="center" style="display:none;"><?php echo $row['id_booking'] ?></td>
                                <td align="center"><?php echo $row['nama_user'] ?></td>
                                <td align="center"><?php echo $row['email'] ?></td>
                                <td align="center"><?php echo $row['telp'] ?></td>
                                <td align="center">
                                    <!-- Button untuk modal -->
                                    <a href="#" type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal1<?php echo $row['id_transaksi']; ?>">cek</a>
                                </td>
                                <td align="center">
                                    <!-- Button untuk modal -->
                                    <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal<?php echo $row['id_booking']; ?>">cek</a>
                                </td>

                                <td align="center"><?php echo $row['status'] ?></td>
                            </tr>


                            <div class="modal fade" id="myModal<?php echo $row['id_booking']; ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Detail transaksi</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="konfirmasi_booking.php" method="get">

                                                <?php
                                                $id_booking = $row['id_booking'];
                                                //echo $id_booking;
                                                $nama = $row['nama_user'];
                                                $email = $row['email'];
                                                $jumlah_tiket = $row['jumlah_tiket'];
                                                $query_kodetiket = mysqli_query($konek, "SELECT booking.id_booking,harga.id_harga,booking.id_harga,harga.nama_tiket from booking INNER JOIN harga where id_booking='$id_booking'");
                                                while ($data = mysqli_fetch_assoc($query_kodetiket)) {
                                                    $kode_tiket = $data['id_harga'];
                                                }
                                                //echo $kode_tiket;
                                                $query_idharga = mysqli_query($konek, "select * from harga where id_harga = '$kode_tiket'");
                                                while ($data1 = mysqli_fetch_assoc($query_idharga)) {
                                                    $kodenya = $data1['nama_tiket'];
                                                    //echo $kodenya;
                                                }



                                                // $query_view = mysqli_query($konek, "SELECT * FROM booking WHERE id_booking='$id_booking'");
                                                //$result = mysqli_query($conn, $query);
                                                // while ($data = mysqli_fetch_assoc($query_view)) {
                                                ?>

                                                <input type="hidden" name="id_booking" id="id_booking" value="<?php echo $data['id_mahasiswa']; ?>">
                                                <input type="hidden" name="id_user" id="id_user" value="<?php echo $data['id_user']; ?>">
                                                <div class="form-group">
                                                    <label>Nama Pengunjung</label>
                                                    <input type="text" name="nim" class="form-control" value="<?php echo $nama ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" name="nim" class="form-control" value="<?php echo $email ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Paket tiket</label>
                                                    <input type="text" name="nim" class="form-control" value="<?php echo $kodenya ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah tiket</label>
                                                    <input type="text" name="nim" class="form-control" value="<?php echo $jumlah_tiket ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                                <?php
                                                // }
                                                //mysql_close($host);
                                                ?>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal fade" id="myModal1<?php echo $row['id_transaksi']; ?>" role="dialog">
                                <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Konfirmasi Pembayaran </h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="konfirmasi_pembayaran.php" method="POST">

                                                <?php
                                                $bukti = $row['bukti_pembayaran'];
                                                //echo $bukti;

                                                ?>


                                                <input type="hidden" name="id_booking" id="id_booking" class="form-control" value="<?php echo $id_booking;    ?>">
                                                <input type="hidden" name="id_transaksi" id="id_transaksi" class="form-control" value="<?php echo  $row['id_transaksi'];   ?>">
                                                <div class="form-group">
                                                    <label>Nama Rekening</label>
                                                    <input type="text" name="nama_kartu" id="nama_kartu" class="form-control" value="<?php echo  $row['nama_kartu'];   ?>">
                                                </div>
                                                <img id="myImg" src="images/<?= $row['bukti_pembayaran'] ?>" alt="picture" width="100%">
                                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                <?php

                                                //mysql_close($host);
                                                ?>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>