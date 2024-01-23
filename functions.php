<?php
include 'layouts/koneksi.php';

function insert($data)
{
    global $kon;
    $nama_pemesan = $data["nama_pemesan"];
    $tanggal_pengiriman = $data["tanggal_pengiriman"];
    $nama_kurir = $data["nama_kurir"];
    $metode_pembayaran = $data["metode_pembayaran"];
    $status_pembayaran = $data["status_pembayaran"];
    $status_pengiriman = $data["status_pengiriman"];
    $no_telepon = $data["no_telepon"];
    $alamat = $data["alamat"];

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

    $sql = mysqli_query($kon, "INSERT INTO jadwal (no_jadwal, nama_pemesan, jadwal_pengiriman, nama_kurir, metode_pembayaran, status_pembayaran, status_pengiriman, alamat, no_telepon ) VALUES ('$no_jadwal','$nama_pemesan','$tanggal_pengiriman','$nama_kurir','$metode_pembayaran','$status_pembayaran','$status_pengiriman','$alamat','$no_telepon')");
    if ($sql) {
        $ulang = 0;
        foreach ($data["nama_tanaman"] as $tanaman) {
            $jumlah = $data["qty"][$ulang];
            $no_tan = "tanaman" . $tanaman . "no" . $jumlah;
            $sqlno = mysqli_query($kon, "SELECT * FROM jadwal_detail WHERE no_tanaman LIKE '$no_tan%'");
            $new = mysqli_num_rows($sqlno) + 1;
            $no_tanaman = date("YmdHis") . "-" . "$no_tan" . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 5);
            $insert = mysqli_query($kon, "INSERT INTO jadwal_detail (no_jadwal,no_tanaman,nama_tanaman,jumlah)VALUES('$no_jadwal','$no_tanaman','$tanaman','$jumlah')");
            $insert1 = mysqli_query($kon, "INSERT INTO tanaman (no_tanaman,nama_tanaman)VALUES('$no_tanaman','$tanaman')");
            $ulang++;
        };
    }

    return mysqli_affected_rows($kon);
}


function update($data)
{
    global $kon;
    $id = $data["no_jadwal"];
    $pemesan = $data["pemesan"];
    $pengiriman = $data["pengiriman"];
    $kurir = $data["kurir"];
    $pembayaran = $data["pembayaran"];
    $alamat = $data["alamat"];
    $status = $data["status"];
    $status_pembayaran = $data["status_pembayaran"];
    $no_telepon = $data["telepon"];

    $query = "UPDATE jadwal SET
    nama_pemesan = '$pemesan',
    jadwal_pengiriman = '$pengiriman',
    nama_kurir = '$kurir',
    metode_pembayaran = '$pembayaran',
    status_pembayaran = '$status_pembayaran',
    status_pengiriman = '$status',
    alamat = '$alamat',
    no_telepon = '$no_telepon'
    WHERE no_jadwal = '$id'
    ";
    $update = mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}
function updatekurir($data)
{
    global $kon;
    // Pengambilan data dari masing masing name input
    $id = $data["no_jadwal"];
    $pemesan = $data["pemesan"];
    $pengiriman = $data["pengiriman"];
    $kurir = $data["kurir"];
    $pembayaran = $data["pembayaran"];
    $alamat = $data["alamat"];
    $status = $data["status"];
    $status_pembayaran = $data["status_pembayaran"];
    $no_telepon = $data["telepon"];
    $gambar = upload();


    // Jika Bukan Gambar proses akan diberhentikan
    if (!$gambar) {
        return false;
    }

    // Proses Update Ke Database
    $query = "UPDATE jadwal SET
    nama_pemesan = '$pemesan',
    jadwal_pengiriman = '$pengiriman',
    nama_kurir = '$kurir',
    metode_pembayaran = '$pembayaran',
    status_pembayaran = '$status_pembayaran',
    status_pengiriman = '$status',
    alamat = '$alamat',
    no_telepon = '$no_telepon',
    bukti_pengiriman = '$gambar'
    WHERE no_jadwal = '$id'
    ";
    $update = mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}

function updateuser($data)
{
    global $kon;
    // Pengambilan data dari masing masing name input
    $id = $data["id_user"];
    $nama_lengkap = $data["nama_lengkap"];
    $noTelp = $data["noTelp"];
    $jk = $data["jk"];
    $alamat = $data["alamat"];
    $email = $data["email"];
    $password = $data["password"];
    $level = $data["level"];


    // Proses Update Ke Database
    $query = "UPDATE users SET
    nama_lengkap = '$nama_lengkap',
    no_telp = '$noTelp',
    jk = '$jk',
    alamat = '$alamat',
    email = '$email',
    password = '$password',
    level = '$level'
    WHERE id_user = '$id'
    ";
    $update = mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}

function upload()
{
    $namafile = $_FILES["buktipengiriman"]["name"];
    $ukuranfile = $_FILES["buktipengiriman"]["size"];
    $error = $_FILES["buktipengiriman"]["error"];
    $tmpName = $_FILES["buktipengiriman"]["tmp_name"];

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
    $namafilebaru = substr(str_shuffle(uniqid() . "BuktiPengiriman-" . $namafile), 0, 25);
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;


    move_uploaded_file($tmpName, 'C:/xampp/htdocs/jadwalpengiriman/assets/img/buktipengiriman/' . $namafilebaru);

    return $namafilebaru;
}
