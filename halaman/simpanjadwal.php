
<?php
include('../layouts/koneksi.php');

include('../layouts/mainup.php');



if (isset($_POST["simpan"])) {
    $nama_pemesan =  $_POST["nama_pemesan"];
    $tanggal_pengiriman = htmlspecialchars($_POST["tanggal_pengiriman"]);
    $nama_kurir = $_POST["nama_kurir"];
    $metode_pembayaran = $_POST["metode_pembayaran"];
    $status_pembayaran = htmlspecialchars($_POST["status_pembayaran"]);
    $status_pengiriman = htmlspecialchars($_POST["status_pengiriman"]);
    $no_telepon = $_POST["no_telepon"];
    $alamat = htmlspecialchars($_POST["alamat"]);
    $bPengiriman = htmlspecialchars($_POST["bukti_pengiriman"]);
    $bPembayaran = buktiPembayaran();
    $new_no = "jadwal" . $nama_pemesan . "no";
    $sqlno = mysqli_query($kon, "SELECT * FROM jadwal WHERE no_jadwal LIKE '$new_no%'");
    $new = mysqli_num_rows($sqlno) + 1;
    if ($new > 99) {
        $no_jadwal = $new_no . $new;
    } elseif ($new > 9 && $new < 100) {
        $no_jadwal = $new_no . "0" . $new;
    } else {
        $no_jadwal = $new_no . "00" . $new;
    }
    $sql = mysqli_query($kon, "INSERT INTO jadwal (no_jadwal, nama_pemesan, jadwal_pengiriman, nama_kurir, metode_pembayaran, status_pembayaran, status_pengiriman, alamat, no_telepon, bukti_pengiriman ,bukti_pembayaran ) VALUES ('$no_jadwal','$nama_pemesan','$tanggal_pengiriman','$nama_kurir','$metode_pembayaran','$status_pembayaran','$status_pengiriman','$alamat','$no_telepon','$bPengiriman','$bPembayaran')");
    if ($sql) {
        $ulang = 0;
        foreach ($_POST["nama_tanaman"] as $tanaman) {
            $jumlah = $_POST["qty"][$ulang];
            $no_tan = "tanaman" . $tanaman . "no" . $jumlah;
            $sqlno = mysqli_query($kon, "SELECT * FROM jadwal_detail WHERE no_tanaman LIKE '$no_tan%'");
            $new = mysqli_num_rows($sqlno) + 1;
            $notan_pross = date("YmdHis") . "-" . $no_tan;
            $no_tanaman = substr(str_shuffle($notan_pross), 0, 15);
            $insert = mysqli_query($kon, "INSERT INTO jadwal_detail (no_jadwal,no_tanaman,nama_tanaman,jumlah)VALUES('$no_jadwal','$no_tanaman','$tanaman','$jumlah')");
            $insert1 = mysqli_query($kon, "INSERT INTO tanaman (no_tanaman,nama_tanaman)VALUES('$no_tanaman','$tanaman')");

            $ulang++;
        }
    }
    if ($insert1) {
        session_start();
        $_SESSION["status"] = "Data Berhasil Disimpan";
        $_SESSION["status_code"] = "success";
        header("Location: input.php");
    } else {
        $_SESSION["status"] = "Data Gagal Disimpan";
        $_SESSION["status_code"] = "error";
        header("Location: input.php");
    }
}


function buktiPembayaran()
{
    $namafile = $_FILES["bukti_pembayaran"]["name"];
    $ukuranfile = $_FILES["bukti_pembayaran"]["size"];
    $error = $_FILES["bukti_pembayaran"]["error"];
    $tmpName = $_FILES["bukti_pembayaran"]["tmp_name"];

    // Cek tidak ada gambar yang diupload
    if ($error == 4) {
        $_SESSION["error"] = "Tidak Ada Gambar Yang Diupload";
        $_SESSION["error_code"] = "error";
        return false;
    }

    //Validasi Yang hanya boleh diupload berupa gambar
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        $_SESSION["error_ekstensi"] = "Harap Upload Berupa Gambar";
        $_SESSION["error_code"] = "error";
        return false;
    }

    // Cek Ukuran Yang Terlalu Besar
    if ($ukuranfile > 8000000) {
        $_SESSION["ukuran_gambar"] = "Ukuran Gambar Terlalu Besar";
        $_SESSION["error_code"] = "error";
        return false;
    }

    // Setelah lolos pengecekan, gambar siap di upload
    // membuat namafile baru agar tidak ada yang sama
    $namafilebaru = substr(str_shuffle(uniqid() . "buktiPembayaran-" . $namafile), 0, 25);
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;


    move_uploaded_file($tmpName, 'C:/xampp/htdocs/jadwalpengiriman/assets/img/buktipembayaran/' . $namafilebaru);

    return $namafilebaru;
}
include('../layouts/mainfoot.php');
