<?php include "header.php" ?>
<!-- Awal Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4 mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6>
            </div>
            <!-- start card body -->
            <div class="card-body">
                <form action="" method="POST" class="text-center">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Dari Tanggal</label>
                                <input type="date" class="form-control" name="tanggal1" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Hingga Tanggal</label>
                                <input type="date" class="form-control" name="tanggal2" value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <button class="btn btn-primary form-control" name="btampilkan"><i class="fa fa-search mr-1"></i>Tampilkan</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger form-control" name="bkembali"><i class="fa fa-backward mr-1"></i>Kembali</button>
                        </div>
                    </div>
                </form>

                <?php
                if (isset($_POST['btampilkan'])) :
                ?>

                    <!-- start table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pengunjung</th>
                                    <th>Alamat</th>
                                    <th>Tujuan</th>
                                    <th>No HP</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pengunjung</th>
                                    <th>Alamat</th>
                                    <th>Tujuan</th>
                                    <th>No HP</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                // $tgl = date('Y-m-d'); //2021-07-16

                                $tgl1 = $_POST['tanggal1'];
                                $tgl2 = $_POST['tanggal2'];

                                $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu 
                                            where tanggal BETWEEN '$tgl1' and '$tgl2' order by id desc");
                                $no = 1;

                                while ($data = mysqli_fetch_array($tampil)) {
                                ?>
                                    <tr>
                                        <th><?= $no++; ?></th>
                                        <th><?= $data['tanggal']; ?></th>
                                        <th><?= $data['nama']; ?></th>
                                        <th><?= $data['alamat']; ?></th>
                                        <th><?= $data['tujuan']; ?></th>
                                        <th><?= $data['nope']; ?></th>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <center>
                            <form action="exportexcel.php" method="POST">
                                <div class="col-md-4">
                                    <input type="hidden" name="tanggala" value="<?= @$_POST['tanggal1']; ?>">
                                    <input type="hidden" name="tanggalb" value="<?= @$_POST['tanggal2']; ?>">

                                    <button class="btn btn-success form-control" name="bexport"><i class="fa fa-download"></i>Export Data Excel</button>
                                </div>
                            </form>
                        </center>

                    </div>
                    <!-- end table -->

                <?php endif; ?>

            </div>
            <!-- end card body -->
        </div>
    </div>
</div>
<!-- Akhir Row -->
<?php include "footer.php" ?>