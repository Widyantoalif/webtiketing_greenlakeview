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
    <h1 class="h3 mb-2 text-gray-800">Daftar Tiket</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#myModalinsert">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Tiket</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th style="display:none;">Id harga</th>
                            <th>Nama Tiket</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        function rp($angka)
                        {
                            $hasil_rupiah = "Rp. " . number_format($angka, 0, '', '.');
                            return $hasil_rupiah;
                        }

                        $query1 = mysqli_query($konek, "select * from harga");
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query1)) {
                            $namatiket = $row['nama_tiket'];
                            //echo $namatiket;
                        ?>
                            <tr>
                                <td align="center"><?php echo $no++ ?></td>
                                <td align="center" style="display:none;"><?php echo $row['id_harga']; ?></td>
                                <td align="center"><?php echo $row['nama_tiket']; ?></td>
                                <td align="center"><?php echo rp($row['harga'])  ?></td>
                                <td align="center"><?php echo $row['kategori'];  ?></td>
                                <td align="center">
                                    <!-- Button untuk modal -->
                                    <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModalupdate<?php echo $row['id_harga']; ?>">Update</a>
                                    <?php
                                    if ($row['nama_tiket'] == "weekday" || $row['nama_tiket'] == "weekend") {
                                    ?>
                                        <a href="hapus_harga.php?id_harga=<?php echo $row['id_harga'] ?>" type="button" class="btn btn-danger btn-md" onclick="return confirm('Anda tidak dapat menghapus tiket ini <?php echo $row['nama_tiket'] ?>');">Delete</a>
                                    <?php
                                    } else {

                                    ?>
                                        <a href="#" type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModalDelete<?php echo $row['id_harga']; ?>">Delete</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>


                            <div class="modal fade" id="myModalupdate<?php echo $row['id_harga']; ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal update-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Harga</h4>
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
                                                    if ($nama_tiket == "weekday" or $nama_tiket == "weekend") {

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
                                                    <div class="form-group">
                                                        <label>Kategori</label>
                                                        <select id="kategori_update" name="kategori_update" class="form-control">
                                                            <option value="weekend">Weekend</option>
                                                            <option value="weekday">Weekday</option>
                                                            <option value="liburan">Liburan</option>
                                                        </select>
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
                            <div class="modal fade" id="myModalDelete<?php echo $row['id_harga']; ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal update-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Apakah Anda Ingin menghapus data ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="hapus_harga.php" method="GET">

                                                <div class="form-group">
                                                    <label>id tiket</label>
                                                    <input type="text" name="id_tiket" id="id_tiket" class="form-control" value="<?php echo $row['id_harga']; ?>" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">YA</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
                                                </div>
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
                                        <h4 class="modal-title">Tambah</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="tambah_tiket.php" method="POST">

                                            <div class="form-group">
                                                <label>Nama Tiket</label>
                                                <input type="text" name="nama_tiketbaru" id="nama_tiketbaru" class="form-control" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" name="harga_baru" id="harga_baru" class="form-control" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select id="kategori" name="kategori" class="form-control">
                                                    <option value="weekend">Weekend</option>
                                                    <option value="weekday">Weekday</option>
                                                    <option value="liburan">Liburan</option>
                                                </select>
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