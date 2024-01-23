<style>
    .size {
        height: 230px;
        width: 230px;
        display: block;
        margin-left: 150px;
        margin-right: auto;
    }

    .caption {
        font-size: 20px;
        color: white;
        margin-left: 190px;
        text-align: center;
        width: 230px;
    }
</style>
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
<?php
$no_jadwal = $_GET["no_jadwal"];

?>
<div class="wrapper">
    <!-- NAVBAR -->
    <?php include('../layouts/navbar.php') ?>

    <!-- SIDEBAR -->
    <?php include('../layouts/sidebar.php') ?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <span class="badge badge-primary" style="background-color: #4863A0;">
                    <h1 class="card-title">DETIAL JADWAL</h1>
                </span>
            </div>
            <!-- /.card-header -->
            <div class="card-body shadow-lg">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Nomor Jadwal : <?= $no_jadwal; ?></h1>
                </div>
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12 shadow-lg">
                    <?php $query = "SELECT jadwal.bukti_pengiriman,jadwal.bukti_pembayaran, jadwal.no_jadwal,jadwal.no_telepon, jadwal.nama_pemesan, jadwal.jadwal_pengiriman, jadwal_detail.no_tanaman, jadwal.nama_kurir, jadwal.metode_pembayaran, jadwal.alamat, jadwal.status_pengiriman, jadwal_detail.nama_tanaman from jadwal join jadwal_detail on jadwal.no_jadwal = jadwal_detail.no_jadwal WHERE jadwal.no_jadwal = '$no_jadwal'" ?>
                    <?php $sql = mysqli_query($kon, $query); ?>
                    <?php $data = mysqli_fetch_array($sql) ?>

                    <div class="card shadow-lg">
                        <a href="printDetail.php?no_jadwal=<?= $data["no_jadwal"] ?>" target="_BLANK">
                            <button style="background-color: #4863A0" class="float-right btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                        </a>
                        <!-- Card Body -->
                        <div class="card-body shadow-lg">

                            <div class="text-left mb-3">
                                <div class="row">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4"><a href="#"><img class="img-responsive size" src="../assets/img/buktipengiriman/<?= $data['bukti_pengiriman'] ?>" style="width: 300px;"></a>
                                                <div class="caption"><span class="badge badge-primary">Bukti Pengiriman</span></div>
                                            </div>
                                            <div class="col-md-4"><a href="#"><img class="img-responsive size" src="../assets/img/buktipembayaran/<?= $data['bukti_pembayaran'] ?>" style="width: 300px;"></a>
                                                <div class="caption"><span class="badge badge-primary">Bukti Pembayaran</span></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <table>
                                                <tr>
                                                    <td>Nama Pelanggan</td>
                                                    <td width="15" style="text-align: center;">:</td>
                                                    <td><?= $data['nama_pemesan']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>No Telp</td>
                                                    <td style="text-align: center;">:</td>
                                                    <td><?= $data['no_telepon']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Kurir</td>
                                                    <td style="text-align: center;">:</td>
                                                    <td><?= $data['nama_kurir']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="text-center">List Barang Yang Dipesan</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tanaman</th>
                                            <th>Jumlah</th>
                                        </tr>
                                        <?php
                                        $no = 1;
                                        $qBarang = mysqli_query($kon, "SELECT jadwal_detail.no_tanaman, tanaman.nama_tanaman, jadwal_detail.jumlah FROM jadwal_detail JOIN tanaman ON jadwal_detail.no_tanaman=tanaman.no_tanaman WHERE no_jadwal='$no_jadwal'");
                                        while ($hasil = mysqli_fetch_array($qBarang)) { ?>
                                            <tr>
                                                <td style="width: 5%;"><?= $no; ?></td>
                                                <td><?= $hasil['nama_tanaman']; ?></td>
                                                <td><?= $hasil['jumlah']; ?></td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <?php include('../layouts/footer.php') ?>
    </div>
    <?php include('../layouts/mainfoot.php') ?>

    <!-- Hapus 
    -->