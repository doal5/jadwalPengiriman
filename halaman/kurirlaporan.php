<?php session_start() ?>
<?php
if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1 && $_SESSION["level"] != 2 && $_SESSION["level"] == 3 && $_SESSION["level"] == 4 && $_SESSION["level"] == 3) {
    echo "
    <script>
      alert('Hanya Kepala Toko dan Admin Yang Dapat Mengakses');
      location.href='logout.php';
    </script>
    ";
} ?>
<?php require "../functions.php" ?>
<?php include('../layouts/mainup.php') ?>
<?php
$no_jadwal = $_GET["no_jadwal"];

if (isset($_POST["updatelaporan"])) {
    if (updatekurir($_POST) > 0) {
        $_SESSION["status"] = "Data Berhasil Diupdate";
        $_SESSION["status_code"] = "success";
    } else {
        $_SESSION["status"] = "Data Gagal Diupdate";
        $_SESSION["status_code"] = "error";
    }
}

if (isset($_FILES)) {
    var_dump($_FILES);
}

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
                    <div class="card shadow-lg">
                        <!-- Card Body -->
                        <div class="card-body shadow-lg">
                            <?php $query = "SELECT jadwal.bukti_pengiriman, jadwal.no_jadwal,jadwal.no_telepon, jadwal.nama_pemesan, jadwal.jadwal_pengiriman, jadwal_detail.no_tanaman, jadwal.nama_kurir, jadwal.metode_pembayaran, jadwal.alamat, jadwal.status_pengiriman, jadwal_detail.nama_tanaman, jadwal.status_pembayaran from jadwal join jadwal_detail on jadwal.no_jadwal = jadwal_detail.no_jadwal WHERE jadwal.no_jadwal = '$no_jadwal'" ?>
                            <?php $sql = mysqli_query($kon, $query); ?>
                            <?php $data = mysqli_fetch_array($sql) ?>
                            <div class="text-left mb-3">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <table>
                                                <input type="hidden" name="no_jadwal" id="no_jadwal" value="<?= $data["no_jadwal"] ?>">
                                                <input type="hidden" name="pengiriman" id="pengiriman" value="<?= $data["jadwal_pengiriman"] ?>">
                                                <input type="hidden" name="pembayaran" id="pembayaran" value="<?= $data["metode_pembayaran"] ?>">
                                                <input type="hidden" name="alamat" id="alamat" value="<?= $data["alamat"] ?>">
                                                <tr>
                                                    <td>Nama Pelanggan</td>
                                                    <td width="15" style="text-align: center;">:</td>
                                                    <td><input type="text" class="form-control" name="pemesan" id="pemesan" value="<?= $data['nama_pemesan']; ?>" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>No Telp</td>
                                                    <td style="text-align: center;">:</td>
                                                    <td><input type="text" class="form-control" name="telepon" id="telepon" value="<?= $data['no_telepon']; ?>" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Kurir</td>
                                                    <td style="text-align: center;">:</td>
                                                    <td><input type="text" class="form-control" name="kurir" id="kurir" value="<?= $data['nama_kurir']; ?>" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Status Pembayaran</td>
                                                    <td style="text-align: center;">:</td>
                                                    <td>
                                                        <select name="status_pembayaran" id="status_pembayaran" class="custom-select form-control-border shadow-lg">
                                                            <option value="<?= $data['status_pembayaran'] ?>"><?= $data["status_pembayaran"] ?></option>
                                                            <?php if ($data["status_pembayaran"] == "Belum Lunas") : ?>
                                                                <option value="Dikirim">Lunas</option>
                                                            <?php else : ?>
                                                                <option value="Belum Dikirim">Belum Lunas</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Status Pengiriman</td>
                                                    <td style="text-align: center;">:</td>
                                                    <td>
                                                        <select name="status" id="status" class="custom-select form-control-border shadow-lg">
                                                            <option value="<?= $data['status_pengiriman'] ?>"><?= $data["status_pengiriman"] ?></option>
                                                            <?php if ($data["status_pengiriman"] == "Belum Dikirim") : ?>
                                                                <option value="Dikirim">Dikirim</option>
                                                            <?php else : ?>
                                                                <option value="Belum Dikirim">Belum Dikirim</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Bukti Pengiriman</td>
                                                    <td style="text-align: center;">:</td>
                                                    <td><input type="file" id="buktipengiriman" name="buktipengiriman" class="form-label shadow-lg" onchange="tampilkanPreview()" required> </td>
                                                    <?php if (isset($data["bukti_pengiriman"])) : ?>
                                                        <td><img src="../assets/img/buktipengiriman/<?= $data['bukti_pengiriman'] ?>" alt="" width="200px"></td>
                                                    <?php endif; ?>
                                                    <td><img src="#" alt="Priview Gambar" id="preview" style="display: none; max-width: 300px; max-height: 300px;"></td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <button name="updatelaporan" type="submit" class="btn btn-primary">Update Pengiriman</button>
                                                        </center>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <h6 class=" text-center">List Barang Yang Dipesan</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tanaman</th>
                                        <th>Jumlah</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    $qBarang = mysqli_query($kon, "SELECT jadwal_detail.no_tanaman, tanaman.nama_tanaman, jadwal_detail.jumlah FROM jadwal_detail JOIN tanaman ON jadwal_detail.no_tanaman = tanaman.no_tanaman WHERE no_jadwal='$no_jadwal'");
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
<script src="../assets/js/sweetalert.min.js"></script>


<!-- Notifikasi berhasil melakukan Update -->
<?php
if (isset($_SESSION["status"]) && $_SESSION["status"] != '') { ?>
    <script>
        swal({
            title: '<?= $_SESSION['status']; ?>',
            icon: '<?= $_SESSION['status_code']; ?>',
            text: 'MANTAP',
        });
    </script>
<?php unset($_SESSION["status"]);
} ?>

<!-- Notifikasi Belum Uplaod Gmbar -->
<?php
if (isset($_SESSION["error"])) { ?>
    <script>
        swal({
            title: '<?= $_SESSION['error']; ?>',
            icon: '<?= $_SESSION['error_code']; ?>',
            text: 'Upload Gambar',
        });
    </script>
<?php unset($_SESSION["error"]);
} ?>

<!-- Notifikasi Yang Diupload bukan gambar -->
<?php
if (isset($_SESSION["error_ekstensi"])) { ?>
    <script>
        swal({
            title: '<?= $_SESSION['error_ekstensi']; ?>',
            icon: '<?= $_SESSION['error_code']; ?>',
        });
    </script>
<?php unset($_SESSION["error_ekstensi"]);
} ?>

<!-- Notifikasi ukuran gambar yang diupload terlalu besar -->
<?php
if (isset($_SESSION["ukuran_gambar"])) { ?>
    <script>
        swal({
            title: '<?= $_SESSION['ukuran_gambar']; ?>',
            icon: '<?= $_SESSION['error_code']; ?>',
        });
    </script>
<?php unset($_SESSION["ukuran_gambar"]);
} ?>

<script>
    function tampilkanPreview() {
        var gambar = document.getElementById('buktipengiriman').files[0];
        var preview = document.getElementById('preview');
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        if (gambar) {
            reader.readAsDataURL(gambar);
        }
    }
</script>