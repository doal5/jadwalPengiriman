<?php session_start() ?>
<?php
if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1) {
    echo "
    <script>
      alert('Hanya Kepala Toko Yang Dapat Mengakses');
      location.href='../logout.php';
    </script>
    ";
}

?>
<?php include('../layouts/mainup.php') ?>
<!-- Site wrapper -->
<div class="wrapper">
    <!-- NAVBAR -->
    <?php include('../layouts/navbar.php') ?>

    <!-- SIDEBAR -->
    <?php include('../layouts/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <a href="jadwal.php">
                            <div class="small-box bg-info">
                                <div class="inner text-center">
                                    <?php $pengiriman = mysqli_query($kon, 'SELECT * FROM jadwal');
                                    $jumlah = mysqli_num_rows($pengiriman);
                                    ?>
                                    <h3><?= $jumlah ?></h3>
                                    <p>Pengiriman</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <span class="small-box-footer">Total Pengiriman</span>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <a href="kurir.php">
                            <div class="small-box bg-success">
                                <div class="inner text-center">
                                    <?php $kurir = mysqli_query($kon, 'SELECT * FROM kurir');
                                    $jumlahkurir = mysqli_num_rows($kurir);
                                    ?>
                                    <h3><?= $jumlahkurir ?></h3>
                                    <p>Kurir</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <span class="small-box-footer">Jumlah Kurir</i></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <script src="../assets/js/delete.js"></script>
        <script src="../assets/js/sweetalert.min.js"></script>
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

    </div>
    <!-- /.content-wrapper -->
    <?php include('../layouts/footer.php') ?>
</div>
<!-- ./wrapper -->

<?php include('../layouts/mainfoot.php') ?>