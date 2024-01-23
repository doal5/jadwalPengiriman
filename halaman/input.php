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
<style>
    .btn-simpan {
        width: 922px;
    }
</style>
<div class="wrapper">

    <!-- NAVBAR -->
    <?php include('../layouts/navbar.php') ?>

    <!-- SIDEBAR -->
    <?php include('../layouts/sidebar.php') ?>
    <div class="content-wrapper">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-header"></div>
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #4863A0">
                        <h3 class="card-title">Input Jadwal</h3>
                    </div>
                    <form method="post" action="simpanjadwal.php" enctype="multipart/form-data" target="">
                        <div class="card-body">
                            <div class="input-group pemesan">
                                <div class="col-lg-8 col-sm-8">
                                    <div class="form-group">
                                        <label for="nama_pemesan">Nama Pemesan</label>
                                        <input type="text" class="form-control shadow-lg" name="nama_pemesan" id="nama_pemesan" placeholder="Masukan Nama Pemesan" autofocus required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-8">
                                    <div class="form-group">
                                        <label for="tanggal_pengiriman">Tanggal Pengiriman</label>
                                        <input type="date" class="form-control shadow-lg" name="tanggal_pengiriman" id="tanggal_pengiriman" placeholder="Masukan Nama Tanaman" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group" id="add-form">
                                <div class="col-lg-8 col-sm-8">
                                    <div class="form-group">
                                        <label for="nama_tanaman">Tanaman</label>
                                        <input type="text" name="nama_tanaman[]" class="form-control shadow-lg" id="nama_tanaman1" placeholder="Masukan Nama Tanaman" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-8">
                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input type="number" name="qty[]" id="qty1" style="box-shadow: inset 0 -1px 0 #ddd;" class="form-control shadow-lg" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-8">
                                    <div class="form-group">
                                        <button type="submit" id="add" class="btn btn-primary" name="tambah" style="background-color: #4863A0"> <i class="fa fa-plus"> Tambah </i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">

                                <div class="col-lg-4 col-sm-8">
                                    <div class="form-group">
                                        <label for="metode_pembayaran">Metode Pembayaran</label>
                                        <select name="metode_pembayaran" class="custom-select form-control-border" id="exampleSelectBorder" required>
                                            <option value="">Metode Pembayaran</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-8">
                                    <div class="form-group">
                                        <label for="status_pembayaran">Status Pembayaran</label>
                                        <select name="status_pembayaran" class="custom-select form-control-border" id="exampleSelectBorder" required>
                                            <option value="">Status Pembayaran</option>
                                            <option value="Lunas">Lunas</option>
                                            <option value="Belum Lunas">Belum Lunas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-8">
                                    <div class="form-group">
                                        <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                        <input type="file" class="form-control shadow-lg" name="bukti_pembayaran" id="bukti_pembayaran" placeholder="Bukti Pembayaran" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-lg-4 col-sm-8">
                                    <div class="form-group">
                                        <label for="no_telepon">No Telepon</label>
                                        <input type="number" class="form-control shadow-lg" name="no_telepon" id="no_telepon" placeholder="Metode Pembayaran" required>
                                        <input type="hidden" class="form-control shadow-lg" name="bukti_pengiriman" id="bukti_pengiriman" placeholder="Metode Pembayaran">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-8">
                                    <div class="form-group">
                                        <label for="status_pengiriman">Status Pengiriman</label>
                                        <select name="status_pengiriman" class="custom-select form-control-border" id="exampleSelectBorder" required>
                                            <option value="">Status Pengiriman</option>
                                            <option value="Belum Dikirim">Belum Dikirim</option>
                                            <option value="Sudah Dikirim">Sudah Dikirim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Nama Kurir</label>
                                        <select name="nama_kurir" class="custom-select form-control-border" id="exampleSelectBorder" required>
                                            <option value="">Pilih Kurir</option>
                                            <?php $sql = mysqli_query($kon, "SELECT * FROM kurir");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <option value="<?= $data["nama_kurir"] ?>"><?= $data["nama_kurir"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-lg-8 col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Alamat</label>
                                        <textarea class="shadow-lg" name="alamat" id="alamat" cols="100" rows="5"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="card-footer ">
                                    <center>
                                        <button type="submit" name="simpan" class="btn btn-primary btn-simpan" style="background-color: #4863A0">Submit</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <?php include '../layouts/footer.php' ?>
</div>
<script src="../assets/js/sweetalert.min.js"></script>
<?php include('../layouts/mainfoot.php') ?>
<script>
    $(document).ready(function() {
        var max = 5;
        var add = $('#add');
        var form = $('#add-form');
        var x = 1;
        $(add).click(function(e) {
            e.preventDefault();
            if (x < max) {
                x++
                $(form).append('<div class="input-group new' + x + '" id="add-form"><div class = "col-lg-8 col-sm-8" ><div class = "form-group"><label for = "nama_tanaman">Tanaman</label><input type = "text" name = "nama_tanaman[]" class = "form-control shadow-lg" id = "nama_tanaman' + x + '" placeholder = "Masukan Nama Tanaman"></div></div><div class = "col-lg-2 col-sm-8 row1"><div class = "form-group"><label for = "qty"> Qty </label><input type = "number" name = "qty[]" id = "qty' + x + '" style = "box-shadow: inset 0 -1px 0 #ddd;" class = "form-control shadow-lg"></div> </div> <div class = "col-lg-2 col-sm-8 row1"><div class = "form-group"><div class = "col-lg-5 col-sm-8 row1"><button type="button" class="btn btn-md btn-danger form-control remove_field"><i class="far fa-window-close fa-md"></i></button></div></div></div></div>');
            }
        });
        $(form).on('click', '.remove_field', function(e) {
            e.preventDefault();
            $('.new' + x + '').remove();
            x--;
        });
    });
</script>
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

<?php require('simpanjadwal.php'); ?>