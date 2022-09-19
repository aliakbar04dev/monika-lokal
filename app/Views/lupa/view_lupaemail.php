<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="assets/img/logo-icon.ico" type="image/gif" sizes="16x16">
    <title>PanenSaham &mdash; Login</title>

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
                        <form method="POST" id="formforget" class="needs-validation">
                            <div class="card">
                                <div class="mt-5 text-muted text-center">
                                    <a href="<?= site_url('/'); ?>">
                                        <img class="pb-5" alt="logo" src="<?= base_url() ?>/public/assets/img/ps-logo.png" width="300px" height="">
                                    </a>
                                </div>
                                <h4 class="pl-5">Periksa Email Anda</h4>
                                <a class="pl-5">Email Perubahan Password sudah dikirim ke email anda : </a>
                                <a class="pl-5">abc******@email.com</a>

                                <div class="card-body">
                                    <div class="text-center mt-4 mb-3">
                                        <a href="<?= site_url('/lupa'); ?>" class="kuning">Kirim Ulang Email Perubahan Password </a>
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