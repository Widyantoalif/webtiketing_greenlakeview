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
            <h6 class="m-0 font-weight-bold text-primary">Data Metode Pembayaran</h6>
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
        <div class="card-header py-3">
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#myModalinsert">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Metode</span>
            </a>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == 'updatesukses') {

            ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Update Metode Pembayaran Sukses',
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
                if ($_GET['pesan'] == 'insertsukses') {

            ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Tambah Metode Pembayaran Sukses',
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
                if ($_GET['pesan'] == 'deletesukses') {

            ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Hapus Metode Pembayaran Sukses',
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
                            <th>id_konfig</th>
                            <th>Bank</th>
                            <th>Nomor Rek</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // require_once('phpqrcode/qrlib.php');
                        $query1 = mysqli_query($konek, "SELECT * from konfigurasi_pembayaran");
                        $no = 1;
                        //$querycount = mysqli_query($konek, "SELECT COUNT(id_user) AS jumlahtiket FROM booking where id_user = '100002' AND status= 'Menunggu konfirmasi'");
                        while ($row = mysqli_fetch_assoc($query1)) {
                            // $qrvalue = $row["kode_booking"];
                            // $jumlahidbook = mysqli_query($konek, "SELECT count(*) AS jumlahidbook FROM booking WHERE id_booking ='$row[id_booking]'");
                            // $seluruhidbook = mysqli_fetch_array($jumlahidbook);
                            // $idbooknya = $seluruhidbook['jumlahidbook'];
                            // echo $idbooknya;
                            // $tempDir = "pdfqrcodes/";
                            // $codeContents = $qrvalue;
                            // $fileName = $qrvalue . '.png';
                            // $pngAbsoluteFilePath = $tempDir . $fileName;
                            // $urlRelativeFilePath = $tempDir . $fileName;
                            // if (!file_exists($pngAbsoluteFilePath)) {
                            //     QRcode::png($codeContents, $pngAbsoluteFilePath);
                            // }
                            $metode = $row['metode'];
                        ?>

                            <tr>
                                <td align="center"><?php echo $no++ ?></td>
                                <td align="center"><?php echo ($row['id_konfig']) ?></td>
                                <td align="center"><?php echo $row['metode'] ?></td>
                                <td align="center"><?php echo $row['no_rek'] ?></td>
                                <td align="center"><?php echo $row['nama'] ?></td>
                                <td align="center">
                                    <!-- Button untuk modal -->
                                    <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModalupdate<?php echo $row['id_konfig']; ?>">Update</a>
                                    <a href="#" type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModalDelete<?php echo $row['id_konfig']; ?>">Delete</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="myModalupdate<?php echo $row['id_konfig']; ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal update-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Metode Pembayaran</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="update_metode.php" method="get">

                                                <?php
                                                $id_konfig = $row['id_konfig'];
                                                $query_view = mysqli_query($konek, "SELECT * FROM konfigurasi_pembayaran WHERE id_konfig='$id_konfig'");
                                                //$result = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_assoc($query_view)) {
                                                ?>

                                                    <!-- <input type="hidden" name="id_booking" id="id_booking" value="<?php echo $data['id_booking']; ?>">
                                                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $data['id_harga']; ?>"> -->


                                                    <div class="form-group">
                                                        <input type="text" name="id_konfig" id="id_konfig" class="form-control" value="<?php echo $data['id_konfig']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <?php
                                                        echo $metode;
                                                        ?>

                                                        <label>Nama Bank</label>
                                                        <select id="metode" name="metode" class="form-control">
                                                            <option <?php if ($metode == "BRI") {
                                                                        echo ' selected="selected"';
                                                                    } ?> value="BRI">BRI</option>
                                                            <option <?php if ($metode == "BNI") {
                                                                        echo ' selected="selected"';
                                                                    } ?> value="BNI">BNI</option>
                                                            <option <?php if ($metode == "BCA") {
                                                                        echo ' selected="selected"';
                                                                    } ?> value="BCA">BCA</option>
                                                            <option <?php if ($metode == "PERMATA BANK") {
                                                                        echo ' selected="selected"';
                                                                    } ?> value="PERMATA BANK">PERMATA BANK</option>
                                                            <option <?php if ($metode == "OVO") {
                                                                        echo ' selected="selected"';
                                                                    } ?> value="OVO">OVO</option>
                                                            <option <?php if ($metode == "GOPAY") {
                                                                        echo ' selected="selected"';
                                                                    } ?> value="GOPAY">GOPAY</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nomor Rekening</label>
                                                        <input type="text" name="no_rek" id="no_rek" class="form-control" value="<?php echo $data['no_rek']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>A/n</label>
                                                        <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama']; ?>">
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
                            <div class="modal fade" id="myModalDelete<?php echo $row['id_konfig']; ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal update-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Apakah Anda Ingin menghapus data ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="hapus_metode.php" method="GET">

                                                <div class="form-group">
                                                    <label>id tiket</label>
                                                    <input type="text" name="id_konfig" id="id_konfig" class="form-control" value="<?php echo $row['id_konfig']; ?>" required>
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
                            <div class="modal fade" id="myModalinsert" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal update-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Metode Pembayaran</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="tambah_metode.php" method="POST">

                                                <div class="form-group">
                                                    <label>Nama Bank</label>
                                                    <select id="metode" name="metode" class="form-control">
                                                        <option value="BRI">BRI</option>
                                                        <option value="BNI">BNI</option>
                                                        <option value="BCA">BCA</option>
                                                        <option value="PERMATA BANK">PERMATA BANK</option>
                                                        <option value="OVO">OVO</option>
                                                        <option value="GOPAY">GOPAY</option>
                                                        <option value="DANA">DANA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomor Rekening</label>
                                                    <input type="text" name="no_rek" id="no_rek" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>A/n</label>
                                                    <input type="text" name="nama" id="nama" class="form-control">
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