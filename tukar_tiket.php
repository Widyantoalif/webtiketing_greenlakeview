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

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Penukaran Tiket</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="form-group">
                <form role="form" action="cek_statustiket.php" method="POST">
                    <label>Masukan Kode tiket</label>
                    <input type="text" name="kode_tiket" id="kode_tiket" class="form-control" value="" required>
                    <br>
                    <button type="submit" class="btn btn-success">Cek</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == 'sukses') {

        ?>
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Penukaran Tiket Sukses',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
        <?php
            }
        }
        ?>

        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == 'telahdigunakan') {

        ?>
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Tiket telah digunakan',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
        <?php
            }
        }
        ?>

        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == 'tidakditemukan') {

        ?>
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Tiket tidak ditemukan',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
        <?php
            }
        }
        ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Id booking</th>
                        <th>Nama </th>
                        <th>Email</th>
                        <th>kode booking </th>
                        <th>Tanggal penukaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    function rp($angka)
                    {
                        $hasil_rupiah = "Rp. " . number_format($angka, 0, '', '.');
                        return $hasil_rupiah;
                    }

                    $query1 = mysqli_query($konek, "SELECT booking.id_booking ,booking.id_harga,user.id_user,user.nama_user,user.email,booking.tanggal_pesan, booking.kode_booking,user.alamat, user.telp ,booking.harga,booking.status,booking.batas_penukaran,booking.tanggal_penukaran FROM booking INNER JOIN user on user.id_user = booking.id_user where booking.status = 'Telah digunakan' GROUP BY id_booking");
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query1)) {
                        if ($row['tanggal_penukaran'] == '0000-00-00') {
                            $tanggal_penukaran = '-';
                        } else {
                            $tanggal_penukaran = tgl($row['tanggal_penukaran']);
                        }
                    ?>
                        <tr>
                            <td align="center"><?php echo $no++ ?></td>
                            <td align="center"><?php echo $row['id_booking']; ?></td>
                            <td align="center"><?php echo $row['nama_user']; ?></td>
                            <td align="center"><?php echo $row['email'];  ?></td>
                            <td align="center"><?php echo $row['kode_booking'];  ?></td>
                            <td align="center"><?php echo  $tanggal_penukaran  ?></td>
                        </tr>


                        <div class="modal fade" id="myModalupdate<?php echo $row['id_harga']; ?>" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal update-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail harga</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="update_harga.php" method="get">

                                            <?php
                                            $id_harga = $row['id_harga'];
                                            $nama_tiket = $row['nama_tiket'];
                                            $query_view = mysqli_query($konek, "SELECT * FROM harga WHERE id_harga='$id_harga'");
                                            //$result = mysqli_query($conn, $query);
                                            while ($data = mysqli_fetch_assoc($query_view)) {
                                            ?>

                                                <!-- <input type="hidden" name="id_booking" id="id_booking" value="<?php echo $data['id_booking']; ?>">
                                                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $data['id_harga']; ?>"> -->


                                                <div class="form-group">
                                                    <input type="hidden" name="id_harga" id="id_harga" class="form-control" value="<?php echo $data['id_harga']; ?>">
                                                </div>
                                                <?php
                                                if ($nama_tiket == "weekday" or "weekend") {


                                                ?>
                                                    <div class="form-group">
                                                        <label>Nama Tiket</label>
                                                        <input type="text" name="nama_tiket" id="nama_tiket" class="form-control" readonly="true" value="<?php echo $data['nama_tiket']; ?>">
                                                    </div>
                                                <?php
                                                } else {

                                                ?>
                                                    <div class="form-group">
                                                        <label>Nama Tiket</label>
                                                        <input type="text" name="nama_tiket" id="nama_tiket" class="form-control" value="<?php echo $data['nama_tiket']; ?>">
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <label>Harga</label>
                                                    <input type="text" name="harga" id="harga" class="form-control" value="<?php echo $data['harga']; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            <?php
                                            }
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

                    <div class="modal fade" id="myModalinsert" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal update-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tukar tiket</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="tambah_tiket.php" method="POST">

                                        <div class="form-group">
                                            <label>Scan Barcode</label>
                                            <input type="text" name="nama_tiketbaru" id="nama_tiketbaru" class="form-control" value="" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Tambah</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php include "footer.php"; ?>