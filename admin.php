<!-- panggil file header -->
<?php include "header.php";
?>

<?php

// pengujian jika tombol simpan di klik
if (isset($_POST['bsimpan'])) {
    $tgl = date('Y-m-d');

    // htmlspecialcars agar lebih aman dari injection
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);

    // persiapan query specialchars
    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES  (
                                                                '',                                                                    
                                                                '$tgl',
                                                                '$nama',
                                                                '$alamat',
                                                                '$tujuan',
                                                                '$nope'
                                                                )
                        ");

    // uji jika simpan data sukses
    if ($simpan) {
        echo "<script>alert('simpan Data Sukses');
    document.location='?'</script>";
    } else {
        echo "<script>alert('simpan Data Gagal');
                document.location='?'</script>";
    }
}
?>



<!-- Head -->
<div class="head text-white text-center">
    <img src="assets/img/logo N.png" alt="" width="100px">
    <h2 class="text-white">Sistem Informasi Buku Tamu <br> Nioke Dev</h2>
</div>
<!-- end Head -->


<!-- Start Row -->
<div class="row mt-2">
    <!-- Start col lg 7 -->
    <div class="col-lg-7 mb-3">
        <div class="card shadow bg-gradient-light">
            <!-- Start card-body -->
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                </div>
                <form class="user" method="POST" action="">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat Pengunjung" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Tujuan Pengunjung" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="nope" placeholder="No HP Pengunjung" required>
                    </div>

                    <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="#">By. Nioke-Dev | 2021 - <?= date('Y'); ?></a>
                </div>
            </div>
            <!-- end card-body -->
        </div>
    </div>
    <!-- End col lg-7 -->

    <!-- Start col lg 5 -->
    <div class="col-lg-5 mb-3">
        <!-- start card -->
        <div class="card shadow">
            <!-- Start card-body -->
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                </div>
                <?php
                // Deklarasi Tanggal

                // Menampilkan Tanggal Sekarang
                $tgl_sekarang = date('Y-m-d');

                // menampilkan Data Kemarin
                $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                // Mendapatkan 6 Hari Sebelum Tanggal Sekarang
                $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

                $sekarang = date('Y-m-d h:i:s');

                $bulan_ini = date('m');

                // persiapan query tampilkan jumlah data pengunjung
                $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%'"
                ));

                $kemarin = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%'"
                ));

                $seminggu = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and '$sekarang'"
                ));

                $sebulan = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"
                ));

                $keseluruhan = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu"
                ));

                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Hari Ini :</td>
                        <td><?= $tgl_sekarang[0]; ?></td>
                    </tr>
                    <tr>
                        <td>Kemarin :</td>
                        <td><?= $kemarin[0]; ?></td>
                    </tr>
                    <tr>
                        <td>Minggu Ini :</td>
                        <td><?= $seminggu[0]; ?></td>
                    </tr>
                    <tr>
                        <td>Bulan Ini :</td>
                        <td><?= $sebulan[0]; ?></td>
                    </tr>
                    <tr>
                        <td>Keseluruhan :</td>
                        <td><?= $keseluruhan[0]; ?></td>
                    </tr>
                </table>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- End col lg 5 -->
</div>
<!-- End Row -->

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini | <?= date('d,m,Y'); ?></h6>
    </div>
    <div class="card-body">
        <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table mr-1"></i>Rekapitulasi Pengunjung</a>
        <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt mr-1"></i>Logout</a>

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
                    $tgl = date('Y-m-d'); //2021-07-16
                    $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu 
                                            where tanggal like '%$tgl%' order by id desc");
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
        </div>
    </div>
</div>
<!-- panggil file footer -->
<?php include "footer.php"; ?>