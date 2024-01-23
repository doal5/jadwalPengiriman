<?php
session_start();
include 'layouts/koneksi.php';
if (isset($_POST["daftar"])) {
    $namaLengkap = $_POST["namaLengkap"];
    $id_user = $_POST["id_user"];
    $email = $_POST["email"];
    $no_telepon = $_POST["no_telepon"];
    $jk = $_POST["jk"];
    $alamat = $_POST["alamat"];
    $level = $_POST["level"];
    $password = $_POST["password"];
    $konfirmasiPassword = $_POST["konfirmasiPassword"];

    $cekEmail = mysqli_query($kon, "SELECT email FROM users WHERE email = '$email'");

    if (mysqli_num_rows($cekEmail) > 0) {
        $_SESSION["errorEmail"] = "Email Sudah Terdaftar";
        $_SESSION["status_code"] = "error";
        header("Location: registrasi.php");
    } elseif ($password != $konfirmasiPassword) {
        $_SESSION["errorkonfirmasiPassword"] = "Konfirmasi Password Tidak Sesuai";
        header("Location: registrasi.php");
    } else {
        $sql = "INSERT INTO users (nama_lengkap, no_telp, jk, alamat, email, password, level ) VALUES ('$namaLengkap','$no_telepon','$jk','$alamat','$email','$password','$level')";
        mysqli_query($kon, $sql);
        $_SESSION["status"] = "Akun Berhasil Dibuat";
        $_SESSION["status_text"] = "Silahkan Login";
        $_SESSION["status_code"] = "success";
        header("Location: registrasi.php");
    }
}
