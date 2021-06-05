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
        <div class="card-header">
            <form action="pencarian.php" method="post">
                <?php
                $tanggal_from   = "";
                $tanggal_to     = "";
                if (isset($_GET['dfrom']) && isset($_GET['dto'])) {
                    $tanggal_from   = $_GET['dfrom'];
                    $tanggal_to     = $_GET['dto'];
                }
                ?>
                <div class="row">
                    <div class="row col-md-6">
                        <div class="col-md-6">
                            <h5>Tanggal Dari</h5>
                            <input type="date" class="form-control" name="tanggal_from" value="<?= $tanggal_from; ?>">
                        </div>
                        <div class="col-md-6">
                            <h5>Tanggal Sampai</h5>
                            <div class="input-group">
                                <input type="date" class="form-control" name="tanggal_to" value="<?= $tanggal_to; ?>">
                                <div class="input-group-append">
                                    <button type="submit" name="Search" class="btn btn-success float-right"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-6">
                        <div class="col-md-6">
                            <h5>&nbsp;</h5>
                            <a href="print_laporan.php?dfrom=<?= $tanggal_from; ?>&dto=<?= $tanggal_to; ?>" class="btn btn-success"><i class="fas fa-download"></i> Generate PDF</a>
                        </div>
                    </div>
                </div>
        </div>
        </form>



        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Tanggal Transaksi</th>
                            <th>Jumlah Penjualan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query1 = mysqli_query($konek, "SELECT SUM(harga) AS harga,COUNT(*) AS jumlah_harian,tanggal_pesan FROM booking WHERE tanggal_pesan BETWEEN '$tanggal_from' AND '$tanggal_to'  GROUP BY tanggal_pesan");
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query1)) {
                        ?>
                            <tr>
                                <td align="center"><?php echo $no++ ?></td>
                                <td align="center"><?php echo tgl($row['tanggal_pesan']) ?></td>
                                <td align="center"><?php echo $row['jumlah_harian'] ?></td>
                                <td align="center"><?php echo $row['harga'] ?></td>
                            </tr>
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