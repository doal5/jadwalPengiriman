<?php session_start() ?>
<?php
if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1 && $_SESSION["level"] != 2) {
    echo "
    <script>
      alert('Hanya Kepala Toko dan Admin Yang Dapat Mengakses');
      location.href='logout.php';
    </script>
    ";
} ?>
<?php include('../layouts/mainup.php') ?>
<div class="wrapper">
    <!-- NAVBAR -->
    <?php include('../layouts/navbar.php') ?>

    <!-- SIDEBAR -->
    <?php include('../layouts/sidebar.php') ?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <span class="badge badge-primary" style="background-color: #4863A0;">
                    <h1 class="card-title">LAPORAN JADWAL PENGIRIMAN</h1>
                </span>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post">
                    <center>
                        <div class="col-lg-8 col-sm-8">
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" class="form-control shadow-lg" name="tanggal_awal" id="tanggal_awal" placeholder="Masukan Nama Pemesan" autofocus required>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            <div class="form-group">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" class="form-control shadow-lg" name="tanggal_akhir" id="tanggal_akhir" placeholder="Masukan Nama Tanaman" required>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            <div class="form-group"> <br>
                                <button type="submit" name="tampil" class="btn btn-primary btn-tampil"> <i class="fa fa-search"> Tampil</i> </button>
                            </div>
                        </div>
                    </center>
                </form>
                <?php
                if (isset($_POST["tampil"])) {
                    $tanggal_awal = $_POST["tanggal_awal"];
                    $tanggal_akhir = $_POST["tanggal_akhir"];

                    $taw = strtotime($tanggal_awal);
                    $tak = strtotime($tanggal_akhir);

                    $awal = date('Y-m-d', $taw);
                    $akhir = date('Y-m-d', $tak);

                    if (empty($tanggal_awal) || empty($tanggal_akhir)) {
                ?>
                        <script>
                            alert("Tanggal Awal Dan Tanggal Akhir Harap Diisi");
                            document.location.href = "laporan.php";
                        </script>
                    <?php
                    } else {
                    ?>
                        <div class="col-xl-12 col-lg-12 shadow-lg">
                            <div class="card shadow-lg">
                                <div class="card-header">
                                    <center>
                                        <h1><span class="badge badge-success">Laporan Jadwal Periode</span> </h1>
                                        <h2><span class="badge badge-primary"><?= date('d-m-y', $taw) ?></span> s/d <span class="badge badge-primary"><?= date('d-m-Y', $tak) ?></span> </h2>
                                    </center>
                                </div>
                                <?php $query = mysqli_query($kon, "SELECT * FROM jadwal WHERE jadwal_pengiriman BETWEEN '$awal' AND '$akhir'"); ?>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th width="300px">Nama Pemesan</th>
                                            <th width="300px">Tanggal Pengiriman</th>
                                            <th width="300px">Nama Kurir</th>
                                            <th width="300px">Metode Pembayaran</th>
                                            <th width="300px">Alamat</th>
                                            <th width="300px">Status Pengiriman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($query as $data) {
                                        ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $data["nama_pemesan"] ?></td>
                                                <td> <span class="badge badge-primary"><?= $data["jadwal_pengiriman"] ?></span></td>
                                                <td><?= $data["nama_kurir"] ?></td>
                                                <td><?= $data["metode_pembayaran"] ?></td>
                                                <td><span class="badge badge-success"> <?= $data["alamat"] ?></span></td>
                                                <td><span class="badge badge-success"> <?= $data["status_pengiriman"] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tanaman</th>
                                            <th>Jadwal Pengiriman</th>
                                            <th>Nama Kurir</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Alamat</th>
                                            <th>Status Pengiriman</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <?php include('../layouts/footer.php') ?>
</div>
<?php include('../layouts/mainfoot.php') ?>