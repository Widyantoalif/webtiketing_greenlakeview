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
            <h6 class="m-0 font-weight-bold text-primary">Data Booking</h6>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th style="display:none;">Id booking</th>
                            <th style="display:none;">Id user</th>
                            <th>Nama user</th>
                            <th>email</th>
                            <th>Tanggal pesan</th>
                            <th style="display:none;">Kode booking</th>
                            <th style="display:none;">Alamat</th>
                            <th>Harga</th>
                            <th>status</th>
                            <th>Jumlah</th>
                            <th>Konfirm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // require_once('phpqrcode/qrlib.php');
                        $query1 = mysqli_query($konek, "SELECT booking.id_booking ,user.id_user,user.nama_user,user.email,booking.tanggal_pesan, booking.kode_booking,user.alamat, booking.harga,booking.status FROM booking INNER JOIN user on user.id_user = booking.id_user where user.level = 'pengunjung' GROUP BY id_booking");
                        $no = 1;
                        //$querycount = mysqli_query($konek, "SELECT COUNT(id_user) AS jumlahtiket FROM booking where id_user = '100002' AND status= 'Menunggu konfirmasi'");
                        while ($row = mysqli_fetch_assoc($query1)) {
                            $qrvalue = $row["kode_booking"];
                            $jumlahidbook = mysqli_query($konek, "SELECT count(*) AS jumlahidbook FROM booking WHERE id_booking ='$row[id_booking]'");
                            $seluruhidbook = mysqli_fetch_array($jumlahidbook);
                            $idbooknya = $seluruhidbook['jumlahidbook'];
                            // echo $idbooknya;
                            // $tempDir = "pdfqrcodes/";
                            // $codeContents = $qrvalue;
                            // $fileName = $qrvalue . '.png';
                            // $pngAbsoluteFilePath = $tempDir . $fileName;
                            // $urlRelativeFilePath = $tempDir . $fileName;
                            // if (!file_exists($pngAbsoluteFilePath)) {
                            //     QRcode::png($codeContents, $pngAbsoluteFilePath);
                            // }
                        ?>

                            <tr>
                                <td align="center"><?php echo $no++ ?></td>
                                <td align="center" style="display:none;"><?php echo $row['id_booking']; ?></td>
                                <td align="center" style="display:none;"><?php echo $row['id_user']; ?></td>
                                <td align="center"><?php echo $row['nama_user'] ?></td>
                                <td align="center"><?php echo $row['email'] ?></td>
                                <td align="center"><?php echo $row['tanggal_pesan'] ?></td>
                                <td align="center" style="display:none;"><?php echo $row['kode_booking'] ?></td>
                                <td align="center" style="display:none;"><?php echo $row['alamat'] ?></td>
                                <td align="center"><?php echo ($row['harga']) ?></td>
                                <td align="center"><?php echo $row['status'] ?></td>
                                <td align="center"><?php echo $idbooknya; ?></td>
                                <td align="center">
                                    <!-- Button untuk modal -->
                                    <a href="#" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal<?php echo $row['id_booking']; ?>">Detail</a>
                                </td>
                            </tr>


                            <div class="modal fade" id="myModal<?php echo $row['id_booking']; ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Detail Booking</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="konfirmasi_booking.php" method="get">

                                                <?php
                                                $id_booking = $row['id_booking'];
                                                $query_view = mysqli_query($konek, "SELECT * FROM booking WHERE id_booking='$id_booking'");
                                                //$result = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_assoc($query_view)) {
                                                ?>

                                                    <input type="hidden" name="id_booking" id="id_booking" value="<?php echo $data['id_booking']; ?>">
                                                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $data['id_user']; ?>">
                                                    <div class="form-group">
                                                        <label>iduser</label>
                                                        <input type="text" name="nim" class="form-control" value="<?php echo $data['nim']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kelas</label>
                                                        <input type="text" name="kelas" class="form-control" value="<?php echo $data['kelas']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>biaya</label>
                                                        <input type="text" name="biaya" class="form-control" value="<?php echo $data['biaya']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tingkat</label>
                                                        <input type="text" name="tingkat" class="form-control" value="<?php echo $data['tingkat']; ?>">
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>