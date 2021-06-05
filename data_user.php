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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#myModalinsert">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah User</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th style="display:none;">Id user</th>
                            <th>Nama user</th>
                            <th>Telp</th>
                            <th style="display:none;">Alamat</th>
                            <th>Email</th>
                            <th>level</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query1 = mysqli_query($konek, "SELECT * from user ");
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query1)) {
                            $level = $row['level'];
                        ?>
                            <tr>
                                <td align="center"><?php echo $no++ ?></td>
                                <td align="center" style="display:none;"><?php echo $row['id_user']; ?></td>
                                <td align="center"><?php echo $row['nama_user'] ?></td>
                                <td align="center"><?php echo $row['telp'] ?></td>
                                <td align="center" style="display :none;"><?php echo $row['alamat'] ?></td>
                                <td align="center"><?php echo ($row['email']) ?></td>
                                <td align="center"><?php echo $row['level'] ?></td>
                                <td align="center">
                                    <!-- Button untuk modal -->
                                    <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModalubah<?php echo $row['id_user']; ?>">Ubah</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="myModalubah<?php echo $row['id_user']; ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">tambah user </h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="ubah_user.php" method="GET">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="hidden" name="id_user" id="id_user" class="form-control" value="<?php echo $row['id_user'] ?>">
                                                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $row['nama_user'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>No telp</label>
                                                    <input type="text" name="notelp" id="notelp" class="form-control" value="<?php echo $row['telp'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>alamat</label>
                                                    <input type="text" name="alamat" id="alamat" class="form-control" value="<?php echo $row['alamat'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>email</label>
                                                    <input type="text" name="email" id="email" class="form-control" value="<?php echo ($row['email']) ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>level</label>
                                                    <select id="level" name="level" class="form-control">
                                                        <option <?php if ($level == "pengunjung") {
                                                                    echo ' selected="selected"';
                                                                } ?> value="pengunjung">pengunjung</option>
                                                        <option <?php if ($level == "admin") {
                                                                    echo ' selected="selected"';
                                                                } ?> value="admin">admin</option>
                                                        <option <?php if ($level == "pimpinan") {
                                                                    echo ' selected="selected"';
                                                                } ?> value="pimpinan">pimpinan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>password</label>
                                                    <input type="text" name="password" id="password" class="form-control" value="<?php echo ($row['password']) ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">tambah user </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="tambahuser.php" method="POST">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>No telp</label>
                                                <input type="text" name="notelp" id="notelp" class="form-control" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>alamat</label>
                                                <input type="text" name="alamat" id="alamat" class="form-control" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>email</label>
                                                <input type="text" name="email" id="email" class="form-control" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>level</label>
                                                <select id="level" name="level" class="form-control">
                                                    <option value="pengunjung">pengunjung</option>
                                                    <option value="admin">admin</option>
                                                    <option value="pimpinan">pimpinan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>password</label>
                                                <input type="text" name="password" id="password" class="form-control" value="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Save</button>
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