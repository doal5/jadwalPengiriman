<?php

// Membuat nav link active sesuai dengan halaman yang dibuka
$directortyURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directortyURI, PHP_URL_PATH);
$component = explode('/', $path);
$page = $component[3];
?>

<aside class="main-sidebar sidebar-dark-primary elevation-3" style="background-color: #4863A0">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../assets/AdminLTE-3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">HALIM NURSERY</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../assets/img/clover.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="badge badge-primary">
                    <?= $_SESSION["nama"]; ?>
                </span>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-bar" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if ($_SESSION["level"] == 1) : ?>
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link <?php if ($page == "dashboard.php") {
                                                                    echo "active";
                                                                } ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == 1 || $_SESSION["level"] == 2) : ?>
                    <li class="nav-item">
                        <a href="jadwal.php" class="nav-link <?php if ($page == "jadwal.php") {
                                                                    echo "active";
                                                                } ?>">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>
                                Jadwal
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (!isset($_SESSION["level"]) || $_SESSION["level"] != 1 && $_SESSION["level"] != 2) : ?>
                    <li class="nav-item">
                        <a href="kurir.php" class="nav-link <?php if ($page == "kurir.php") {
                                                                echo "active";
                                                            } ?>">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>
                                Pengiriman
                            </p>
                        </a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="kurir.php" class="nav-link <?php if ($page == "kurir.php") {
                                                                echo "active";
                                                            } ?>">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == 1 || $_SESSION["level"] == 2) : ?>
                    <li class="nav-item">
                        <a href="input.php" class="nav-link <?php if ($page == "input.php") {
                                                                echo "active";
                                                            } ?>">
                            <i class="nav-icon fas fa-pen"></i>
                            <p>
                                Input Jadwal
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == 1 || $_SESSION["level"] == 2) : ?>
                    <li class="nav-item">
                        <a href="laporan.php" class="nav-link <?php if ($page == "laporan.php") {
                                                                    echo "active";
                                                                } ?>">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Laporan
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == 1 || $_SESSION["level"] == 2) : ?>
                    <li class="nav-item">
                        <a href="../registrasi.php" class="nav-link <?php if ($page == "registrasi.php") {
                                                                        echo "active";
                                                                    } ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Registrasi Akun
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="../logout.php" id="logout" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-arrow-left"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('a#logout').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Apakah Anda Yakin Akan Logout??",
                text: '',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Akan Logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "../logout.php",
                        data: {
                            'a#logout': true,
                        },
                        success: function(response) {
                            location.href = '../login.php';
                        }
                    });
                }
            })
        })
    });
</script>