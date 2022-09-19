<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="https://panensaham.com/images/icon.png" type="image/gif" sizes="16x16">
    <title>Monika PanenSaham &mdash; Lupa Password</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/sweetalert2.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        var base_url = '<?= base_url() ?>/';
    </script>
</head>

<body style="background-color:#C1C1C1;">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="login-card col-xl-4 offset-xl-4">
                        <form method="POST" id="formchangephone" class="needs-validation">
                            <div class="card">
                                <!--
                                <div style="margin-top:-25px; color:#707070; font-weight: 900; text-align:center;" class="alert alert-danger ml-5 mr-5" role="alert">
                                    No Handphone telah terdaftar
                                </div>-->
                                <a class="mt-3 ml-4" style="text-align: left;" href="/editprofile">BACK</a><br>
                                <div class="text-muted text-center">
                                    <img class="pb-5" alt="logo" src="<?= base_url() ?>/public/assets/img/ps-logo.png" width="300px" height="">
                                </div>
                                <h4 style="text-align: center;">Verifikasi SMS</h4>
                                <a class="pl-5 pr-5">Kami akan mengirimkan kode konfirmasi ke No Handphone anda. Masukan No Handphone yang Anda daftarkan<br>Contoh +62 821234567890</a>

                                <div class="card-body">
                                    <div class="form-group pb-4">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <button class="btn shadow-none" type="button">+62</button>
                                            </div>
                                            <input style="outline: none;" id="notelp" type="input" class="form-control shadow-none" name="notelp" tabindex="2" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Silahkan Isi Kolom tersebut.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button style="width:100%;" type="submit" class="btn btn-warning" tabindex="4">
                                            Kirim
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/public/assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/popper.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/moment.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/stisla.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/function.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/sweetalert2.min.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/public/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/custom.js"></script>
</body>

</html>