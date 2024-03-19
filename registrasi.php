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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DAFTAR</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="assets/AdminLTE-3/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="assets/AdminLTE-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="assets/AdminLTE-3/dist/css/adminlte.min.css?v=3.2.0">
    <script nonce="0f91167a-3995-462a-b675-1c42be9b4c71">
        (function(w, d) {
            ! function(a, b, c, d) {
                a[c] = a[c] || {};
                a[c].executed = [];
                a.zaraz = {
                    deferred: [],
                    listeners: []
                };
                a.zaraz.q = [];
                a.zaraz._f = function(e) {
                    return async function() {
                        var f = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({
                            m: e,
                            a: f
                        })
                    }
                };
                for (const g of ["track", "set", "debug"]) a.zaraz[g] = a.zaraz._f(g);
                a.zaraz.init = () => {
                    var h = b.getElementsByTagName(d)[0],
                        i = b.createElement(d),
                        j = b.getElementsByTagName("title")[0];
                    j && (a[c].t = b.getElementsByTagName("title")[0].text);
                    a[c].x = Math.random();
                    a[c].w = a.screen.width;
                    a[c].h = a.screen.height;
                    a[c].j = a.innerHeight;
                    a[c].e = a.innerWidth;
                    a[c].l = a.location.href;
                    a[c].r = b.referrer;
                    a[c].k = a.screen.colorDepth;
                    a[c].n = b.characterSet;
                    a[c].o = (new Date).getTimezoneOffset();
                    if (a.dataLayer)
                        for (const n of Object.entries(Object.entries(dataLayer).reduce(((o, p) => ({
                                ...o[1],
                                ...p[1]
                            })), {}))) zaraz.set(n[0], n[1], {
                            scope: "page"
                        });
                    a[c].q = [];
                    for (; a.zaraz.q.length;) {
                        const q = a.zaraz.q.shift();
                        a[c].q.push(q)
                    }
                    i.defer = !0;
                    for (const r of [localStorage, sessionStorage]) Object.keys(r || {}).filter((t => t.startsWith("_zaraz_"))).forEach((s => {
                        try {
                            a[c]["z_" + s.slice(7)] = JSON.parse(r.getItem(s))
                        } catch {
                            a[c]["z_" + s.slice(7)] = r.getItem(s)
                        }
                    }));
                    i.referrerPolicy = "origin";
                    i.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a[c])));
                    h.parentNode.insertBefore(i, h)
                };
                ["complete", "interactive"].includes(b.readyState) ? zaraz.init() : a.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">

            <div class="card-header text-center">
                <a href="login.php" class="h1"><b>Halim</b>Nursery</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Daftar Halim Nursery</p>

                <form action="registrasiProses.php" method="post">
                    <input type="hidden" name="id_user">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="namaLengkap" placeholder="Masukan Nama Lengkap" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control <?php if (isset($_SESSION["errorEmail"])) : ?> is-invalid <?php endif; ?>" name="email" placeholder="Masukan Email" required>
                        <?php if (isset($_SESSION["errorEmail"])) : ?>
                            <div class="invalid-feedback">
                                Email Sudah Terdaftar
                            </div>
                        <?php endif; ?>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="no_telepon" placeholder="Masukan No Telepon" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-location-arrow"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control" name="jk" id="jk" required>
                            <option value="#">Masukan Jenis Kelamin</option>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-venus-mars"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control" name="level" id="level" required>
                            <option value="#">Masukan Level User</option>
                            <option value="1">Kepala Toko</option>
                            <option value="2">Admin</option>
                            <option value="3">Kurir</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-users"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?php if (isset($_SESSION["errorkonfirmasiPassword"])) : ?> is-invalid <?php endif; ?>" name="konfirmasiPassword" placeholder="Konfirmasi Password" required>
                        <?php if (isset($_SESSION["errorkonfirmasiPassword"])) : ?>
                            <div class="invalid-feedback">
                                Konfirmasi Password Tidak Sesuai
                            </div>
                        <?php endif; ?>
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <button type="submit" name="daftar" class="btn btn-primary btn-block">Daftar</button>

                        </div>

                    </div>
                </form>
                <?php if ($_SESSION["level"] == 1) : ?>
                    <a href="halaman/dashboard.php"> <button class="btn btn-xs btn-primary">
                            << Kembali Ke Halaman Dashboard</button> </a>
                <?php else : ?>
                    <a href="halaman/jadwal.php"> <button class="btn btn-xs btn-primary">
                            << Kembali Ke Halaman Dashboard</button> </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="assets/AdminLTE-3/plugins/jquery/jquery.min.js"></script>

    <script src="assets/AdminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/AdminLTE-3/dist/js/adminlte.min.js?v=3.2.0"></script>

    <?php
    if (isset($_SESSION["errorkonfirmasiPassword"]) && $_SESSION["errorkonfirmasiPassword"] != '') { ?>
        <script>
            Swal.fire({
                title: '<?= $_SESSION['errorkonfirmasiPassword']; ?>',
                icon: 'error',
            });
        </script>
    <?php unset($_SESSION["errorkonfirmasiPassword"]);
    } ?>
    <?php
    if (isset($_SESSION["errorEmail"]) && $_SESSION["errorEmail"] != '') { ?>
        <script>
            Swal.fire({
                title: '<?= $_SESSION['errorEmail']; ?>',
                icon: '<?= $_SESSION["status_code"] ?>',
            });
        </script>
    <?php unset($_SESSION["errorEmail"]);
    } ?>
    <?php
    if (isset($_SESSION["status"]) && $_SESSION["status"] != '') { ?>
        <script>
            Swal.fire({
                title: '<?= $_SESSION['status']; ?>',
                text: '<?= $_SESSION['status_text']; ?>',
                icon: '<?= $_SESSION['status_code']; ?>',
            });
        </script>
    <?php unset($_SESSION["status"]);
    } ?>
</body>

</html>