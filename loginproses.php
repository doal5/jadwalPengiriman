<?php
session_start();
include 'layouts/koneksi.php';
if (isset($_POST["login"])) {
    session_start();
    $email = $_POST["email"];
    $password = $_POST["password"];

    $login = mysqli_query($kon, "SELECT nama_lengkap, level, email, password FROM users WHERE email='$email' AND password='$password'");
    $data = mysqli_fetch_array($login);

    if (mysqli_num_rows($login) == 0) {
        $_SESSION["status"] = "User Belum Terdaftar";
        $_SESSION["status_code"] = "error";
        header("Location: login.php");
    } else {
        if ($password <> $data["password"]) {
            $_SESSION["status"] = "Password Salah";
            $_SESSION["status_code"] = "error";
            header("Location: login.php");
        } else {
            $_SESSION["level"] = $data["level"];
            $_SESSION["namakurir"] = $data["nama_lengkap"];
            $_SESSION["nama"] = $data["nama_lengkap"];

            if ($_SESSION["level"] == 1) {
                $_SESSION["status"] = "Selamat Datang Kepala Toko";
                $_SESSION["status_code"] = "success";
                $_SESSION["nama"];
                header("Location: halaman/dashboard.php");
            } elseif ($_SESSION["level"] == 2) {
                $_SESSION["status"] = "Selamat Datang Admin";
                $_SESSION["status_code"] = "success";
                $_SESSION["nama"];
                header("Location: halaman/jadwal.php");
            } elseif ($_SESSION["level"] == 3) {
                $_SESSION["status"] = "Selamat Datang Kurir";
                $_SESSION["status_code"] = "success";
                $_SESSION["namakurir"];
                $_SESSION["nama"];
                header("Location: halaman/kurir.php");
            }
        }
    }
}
