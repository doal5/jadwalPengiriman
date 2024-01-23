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
<?php
include '../layouts/koneksi.php';
if (isset($_POST["hapus-btn"])) {
    $no_jadwal = $_POST["no_jadwal"];
    $sql = mysqli_query($kon, "DELETE FROM jadwal WHERE no_jadwal = '$no_jadwal'");

    if ($sql) {
        $no_jadwal = $_POST["no_jadwal"];
        $query = mysqli_query($kon, "DELETE FROM jadwal_detail WHERE no_jadwal = '$no_jadwal'");
    }

    if ($query) {
        // header("Location: jadwal.php", "Jadwal Berhasil Dihapus");
        echo 200;
    } else {
        // header("Location: jadwal.php", "Jadwal Gagal Dihapus");
        echo 500;
    }
}

include '../layouts/mainfoot.php';
