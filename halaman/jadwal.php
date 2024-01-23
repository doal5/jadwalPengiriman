<?php session_start() ?>
<?php
if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1 && $_SESSION["level"] != 2) {
    echo "
    <script>
      alert('Hanya Kepala Toko dan Admin Yang Dapat Mengakses');
      location.href= '../logout.php';
    </script>
    ";
} ?>

<?php require '../functions.php' ?>

<?php
if (isset($_POST["update"])) {
    if (update($_POST) > 0) {
        $_SESSION["status"] = "Data Berhasil Diupdate";
        $_SESSION["status_code"] = "success";
    } else {
        $_SESSION["status"] = "Data Gagal Disimpan";
        $_SESSION["status_code"] = "error";
    }
}

?>

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
                    <h1 class="card-title">JADWAL PENGIRIMAN</h1>
                </span>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 10%;">Pemesan</th>
                            <th style="width: 5%;">Pengiriman</th>
                            <th style="width: 5%;">Kurir</th>
                            <th style="width: 5%;">Pembayaran</th>
                            <th style="width: 5%;">Alamat</th>
                            <th style="width: 5%;">Pengiriman</th>
                            <th style="width: 5%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Jumlah data per halaman
                        $dataPerHalaman = 10;
                        // Halaman saat ini
                        $halamanSaatIni = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
                        // Menghitung offset
                        $offset = ($halamanSaatIni - 1) * $dataPerHalaman;
                        $i = 1;
                        $sql = mysqli_query($kon, "SELECT * FROM jadwal LIMIT $offset, $dataPerHalaman");
                        if (mysqli_num_rows($sql) > 0) {
                            foreach ($sql as $data) {

                                $jadwal = strtotime($data["jadwal_pengiriman"]);
                        ?>
                                <tr id="tr_<?= $data["no_jadwal"] ?>">
                                    <td><?= $i++ ?></td>
                                    <td><?= $data["nama_pemesan"] ?></td>
                                    <td> <span class="badge badge-primary"><?= date('d-m-Y', $jadwal)  ?></span></td>
                                    <td><?= $data["nama_kurir"] ?></td>
                                    <td><?= $data["metode_pembayaran"] ?></td>
                                    <td><span class="badge badge-success"> <?= $data["alamat"] ?></span></td>
                                    <td><span class="badge badge-success"> <?= $data["status_pengiriman"] ?></span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="jadwaldetail.php?no_jadwal=<?= $data["no_jadwal"] ?>"> <button type="button" class="btn btn-primary" "><i class=" fa fa-eye"></i></button></a>

                                            <button type="button" class="btn btn-info edit-btn" title="Edit" data-toggle="modal" data-target="#modaledit" data-id="<?= $data["no_jadwal"] ?>" data-nama="<?= $data["nama_pemesan"] ?>" data-pengiriman="<?= $data["jadwal_pengiriman"] ?>" data-kurir="<?= $data["nama_kurir"] ?>" data-pembayaran="<?= $data["metode_pembayaran"] ?>" data-alamat="<?= $data["alamat"] ?>" data-status="<?= $data["status_pengiriman"] ?>" data-telepon="<?= $data["no_telepon"] ?>" data-statuspembayaran="<?= $data["status_pembayaran"] ?>">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                            <!-- Modal Edit -->

                                            <button type="button" class="btn btn-danger hapus-btn" title="Hapus" data-nojadwal="<?= $data["no_jadwal"] ?>" value="<?= $data["no_jadwal"] ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <?php
                            // Hitung total jumlah data
                            $totalData = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM jadwal"));
                            // Hitung total halaman
                            $totalHalaman = ceil($totalData / $dataPerHalaman);
                            // Tampilkan navigasi halaman
                            for ($i = 1; $i <= $totalHalaman; $i++) {
                ?>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-sm">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $totalHalaman; $i++) { ?>
                                <li class="page-item <?php if ($i == $halamanSaatIni) echo 'active'; ?>">
                                    <a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                <?php
                            }
                ?>
            </div>
        <?php } ?>
        <!-- /.card-body -->
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <script src="../assets/js/delete.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <?php include('../layouts/footer.php') ?>
</div>
<?php include('../layouts/mainfoot.php') ?>
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

<!-- <button type="submit" data-toggle="modal" data-target="#mymodal" onclick="ubah(<?= $id ?>)">modal</button> -->

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #4863A0;">
                <h5 class="modal-title text-white" id="modaldetailTitle"> <i class="fa fa-list"> </i> DETAIL JADWAL PENGIRIMAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="card-body">
                        <tr>
                            <input type="text" name="no_jadwal" id="no_jadwal" class="form-control">
                            <td>
                                <label for="pemesan">Pemesan</label>
                                <input type="text" class="form-control shadow-lg" name="pemesan" id="pemesan" placeholder="Masukan Nama Pemesan" autofocus required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="pengiriman">Pengiriman</label>
                                <input type="date" class="form-control shadow-lg" name="pengiriman" id="pengiriman" placeholder="Masukan Nama Tanaman" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="telepon">telepon</label>
                                <input type="number" class="form-control shadow-lg" name="telepon" id="telepon" placeholder="Masukan Nama Tanaman" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="status_pembayaran">status_pembayaran</label>
                                <input type="text" class="form-control shadow-lg" name="status_pembayaran" id="status_pembayaran" placeholder="Masukan Nama Tanaman" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="kurir">kurir</label>
                                <input type="text" class="form-control shadow-lg" name="kurir" id="kurir" placeholder="Masukan Nama Tanaman" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="pembayaran">pembayaran</label>
                                <input type="text" class="form-control shadow-lg" name="pembayaran" id="pembayaran" placeholder="Masukan Nama Tanaman" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="alamat">alamat</label>
                                <input type="text" class="form-control shadow-lg" name="alamat" id="alamat" placeholder="Masukan Nama Tanaman" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="status">status</label>
                                <input type="text" class="form-control shadow-lg" name="status" id="status" placeholder="Masukan Nama Tanaman" required>
                            </td>
                        </tr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" name="update" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit -->

<script>
    $(document).on("click", ".edit-btn", function() {
        let id = $(this).data('id');
        let nama = $(this).data('nama');
        let pengiriman = $(this).data('pengiriman');
        let kurir = $(this).data('kurir');
        let pembayaran = $(this).data('pembayaran');
        let alamat = $(this).data('alamat');
        let status = $(this).data('status');
        let telepon = $(this).data('telepon');
        let statuspembayaran = $(this).data('statuspembayaran');

        $("#no_jadwal").val(id);
        $("#pemesan").val(nama);
        $("#pengiriman").val(pengiriman);
        $("#kurir").val(kurir);
        $("#pembayaran").val(pembayaran);
        $("#alamat").val(alamat);
        $("#status").val(status);
        $("#telepon").val(telepon);
        $("#status_pembayaran").val(statuspembayaran);
    })
</script>