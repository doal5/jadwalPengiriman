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
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
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
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
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
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>
                </div>
                <div class="card-body">
                    Start creating your amazing application!
                </div>
                <div class="card-footer">
                    Footer
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