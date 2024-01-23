<style>
    .size {
        height: 130px;
        width: 130px;
        display: block;
        margin-left: 100px;
        margin-right: auto;
    }

    .caption {
        font-size: 20px;
        color: white;
        margin-left: 190px;
        width: 230px;
    }
</style>
<?php session_start() ?>
<?php
if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1 && $_SESSION["level"] != 2) {
    echo "
    <script>
      alert('Hanya Kepala Toko dan Admin Yang Dapat Mengakses');
      location.href='../logout.php';
    </script>
    ";
} ?>
<?php
$no_jadwal = $_GET["no_jadwal"];

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halim Nursery</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/fontawesome-free/css/fontawesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- bootrstrap5 -->
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/AdminLTE-3/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/AdminLTE-3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


</head>

<body>
    <div class="wrapper">
        <!-- NAVBAR -->
        <?php include('../layouts/koneksi.php') ?>
        <div class="content-wrapper">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="header">
                        <h1 class="h3 mb-0 text-gray-800 text-center" style="text-align: center;">HALIM NURSERY</h1>
                    </div>
                    <?php $query = "SELECT jadwal.bukti_pengiriman,jadwal.bukti_pembayaran, jadwal.no_jadwal,jadwal.no_telepon, jadwal.nama_pemesan, jadwal.jadwal_pengiriman, jadwal_detail.no_tanaman, jadwal.nama_kurir, jadwal.metode_pembayaran, jadwal.alamat, jadwal.status_pengiriman, jadwal_detail.nama_tanaman from jadwal join jadwal_detail on jadwal.no_jadwal = jadwal_detail.no_jadwal WHERE jadwal.no_jadwal = '$no_jadwal'" ?>
                    <?php $sql = mysqli_query($kon, $query); ?>
                    <?php $data = mysqli_fetch_array($sql) ?>
                    <div class="text-left mb-3">
                        <div class="row">
                            <div class="container">
                                <div class="col-lg-6 col-sm-12">
                                    <table>
                                        <tr>
                                            <td>Nama Pelanggan</td>
                                            <td width=" 15" style="text-align: center;">:</td>
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
                                    </table> <br>
                                </div>
                            </div>
                        </div>
                        <table class="table">
                            <tr style="text-align: center;">
                                <th>Bukti Pembayaran</th>
                                <th>Bukti Pengiriman</th>
                            </tr>
                            <tr style="text-align: center;">
                                <td><img src="../assets/img/buktipembayaran/<?= $data['bukti_pembayaran']; ?>" alt="" style="width: 200px;"> </td>
                                <td><img src="../assets/img/buktipengiriman/<?= $data['bukti_pengiriman']; ?>" alt="" style="width: 200px;"></td>
                            </tr>
                        </table>
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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="../assets/AdminLTE-3/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../assets/AdminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../assets/AdminLTE-3/dist/js/adminlte.min.js"></script>

        <!-- jQuery UI 1.11.4 -->
        <script src="../assets/AdminLTE-3/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- ChartJS -->
        <script src="../assets/AdminLTE-3/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="../assets/AdminLTE-3/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="../assets/AdminLTE-3/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="../assets/AdminLTE-3/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="../assets/AdminLTE-3/plugins/moment/moment.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="../assets/AdminLTE-3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="../assets/AdminLTE-3/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="../assets/AdminLTE-3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../assets/AdminLTE-3/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/jszip/jszip.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "info": false,
                    "bPaginate": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>

</body>

</html>

<!-- Hapus 
    -->
<script>
    window.print();
</script>