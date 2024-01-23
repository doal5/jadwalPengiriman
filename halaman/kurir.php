<?php session_start() ?>
<?php
if (!isset($_SESSION["level"]) || $_SESSION["level"] != 3 && $_SESSION["level"] != 4 && $_SESSION["level"] != 5 && $_SESSION["level"] != 1 && $_SESSION["level"] != 2) {
    echo "
    <script>
      alert('Hanya Untuk Kurir');
      location.href= '../logout.php';
    </script>
    ";
} ?>

<?php require '../functions.php' ?>

<?php
if (isset($_POST["updateuser"])) {
    if (updateuser($_POST) > 0) {
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
                        <?php
                        if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1 && $_SESSION["level"] != 2) : ?>
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
                        <?php else : ?>
                            <tr>
                                <th style="width: 2%;">No</th>
                                <th style="width: 10%;">Nama Lengkap</th>
                                <th style="width: 10%;">No Telepom</th>
                                <th style="width: 10%;">Jenis Kelamin</th>
                                <th style="width: 10%;">Alamat</th>
                                <th style="width: 10%;">Email</th>
                                <th style="width: 10%;">Password</th>
                                <th style="width: 5%;">Aksi</th>
                            </tr>
                        <?php endif; ?>

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

                        if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1 && $_SESSION["level"] != 2) {
                            $sql = mysqli_query($kon, "SELECT * FROM jadwal WHERE nama_kurir = '$_SESSION[namakurir]'");
                        } else {
                            $sql = mysqli_query($kon, "SELECT * FROM users");
                        } ?>

                        <?php
                        foreach ($sql as $data) {


                        ?>
                            <?php
                            if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1 && $_SESSION["level"] != 2) : ?>
                                <?php $jadwal = strtotime($data["jadwal_pengiriman"]); ?>
                                <tr id="tr_<?= $data["no_jadwal"] ?>">
                                    <td><?= $i++ ?></td>
                                    <td><?= $data["nama_pemesan"] ?></td>
                                    <td> <span class="badge badge-primary"><?= date('d-m-Y', $jadwal)  ?></span></td>
                                    <td><?= $data["nama_kurir"] ?></td>
                                    <td><?= $data["metode_pembayaran"] ?></td>
                                    <td><?= $data["alamat"] ?></span></td>
                                    <td> <?php if ($data["status_pengiriman"] == "Dikirim") : ?> <span class="badge badge-success"> <?= $data["status_pengiriman"] ?> <?php else : ?> <span class="badge badge-danger"> <?= $data["status_pengiriman"] ?> <?php endif; ?> </span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="kurirlaporan.php?no_jadwal=<?= $data["no_jadwal"] ?>">
                                                <button type="button" class="btn btn-success btn-sm" "><i class=" fa fa-pen"></i> Update</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <tr id="tr_<?= $data["id_user"] ?>">
                                    <td><?= $i++ ?></td>
                                    <td><?= $data["nama_lengkap"] ?></td>
                                    <td><?= $data["no_telp"] ?></td>
                                    <td><?= $data["jk"] ?></td>
                                    <td><?= $data["alamat"] ?></td>
                                    <td><?= $data["email"] ?></td>
                                    <td><?= $data["password"] ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-info edit-user" title="Edit" data-toggle="modal" data-target="#editUser" data-id_user="<?= $data["id_user"] ?>" data-nama_lengkap="<?= $data["nama_lengkap"] ?>" data-no_telp="<?= $data["no_telp"] ?>" data-jk="<?= $data["jk"] ?>" data-alamat="<?= $data["alamat"] ?>" data-email="<?= $data["email"] ?>" data-password="<?= $data["password"] ?>" data-level="<?= $data["level"] ?>"> Edit
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                        <?php } ?>
                    </tbody>
                </table>
                <?php
                ?>
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
            <!-- /.card-body -->
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <script src="../assets//js/delete.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <?php include('../layouts/footer.php') ?>
</div>
<?php include('editKurir.php') ?>
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


<!-- Modal Edit Kurir -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="modaleditTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #4863A0;">
                <h5 class="modal-title text-white" id="editkurirLabel"> <i class="fa fa-list"> </i> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="card-body">
                        <tr>
                            <input type="hidden" name="id_user" id="id_user" class="form-control">

                        </tr>
                        <tr>
                            <td>
                                <label for="Nama Lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control shadow-lg" name="nama_lengkap" id="nama_lengkap" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="No Telepon">No Telepon</label>
                                <input type="text" class="form-control shadow-lg" name="noTelp" id="noTelp" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Jenis Kelamin">Jenis Kelamin</label>
                                <input type="text" class="form-control shadow-lg" name="jk" id="jk" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Alamat">Alamat</label>
                                <input type="text" class="form-control shadow-lg" name="alamat" id="alamat" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Email">Email</label>
                                <input type="text" class="form-control shadow-lg" name="email" id="email" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Password">Password</label>
                                <input type="text" class="form-control shadow-lg" name="password" id="password" required>
                                <input type="hidden" class="form-control shadow-lg" name="level" id="level">
                            </td>
                        </tr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" name="updateuser" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit -->

<script>
    $(document).on("click", ".edit-user", function() {
        let id_user = $(this).data('id_user');
        let nama_lengkap = $(this).data('nama_lengkap');
        let no_telp = $(this).data('no_telp');
        let jk = $(this).data('jk');
        let alamat = $(this).data('alamat');
        let email = $(this).data('email');
        let password = $(this).data('password');
        let level = $(this).data('level');

        $("#id_user").val(id_user);
        $("#nama_lengkap").val(nama_lengkap);
        $("#noTelp").val(no_telp);
        $("#jk").val(jk);
        $("#alamat").val(alamat);
        $("#email").val(email);
        $("#password").val(password);
        $("#level").val(level);
    })
</script>