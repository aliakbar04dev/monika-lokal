<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="https://panensaham.com/images/icon.png" type="image/gif" sizes="16x16">
    <title>PanenSaham &mdash; Change Forget Password</title>

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
            <div class="container mt-4">
                <div class="row">
                    <div class="login-card col-xl-5 offset-xl-4">

                        <div class="card">
                            <div class="mt-5 text-muted text-center">
                                <img class="pb-5" alt="logo" src="<?= base_url() ?>/public/assets/img/ps-logo.png" width="300px" height="">
                            </div>
                            <h4 class="pl-5">New Password </h4>
                            <a class="pl-5">Masukan password baru anda .</a>

                            <div class="card-body">
                                <form method="POST" id="changepass" class="needs-validation" autocomplete="off">
									<input id="code" type="hidden" name="code" value="<?= $code ?>">
                                    <div class="form-group pb-4">
                                        <input id="password" type="password" class="form-control" name="password" tabindex="1" placeholder="New Password" required>
                                        <div class="invalid-feedback">
                                            Please fill in your new Password
                                        </div>
                                    </div>
                                    <div class="form-group pb-4">
                                        <input id="repeat" type="password" class="form-control" name="repeat" tabindex="1" placeholder="Confirm New Password" required>
                                        <div class="invalid-feedback">
                                            Please fill in your Confirm New Password
                                        </div>
                                    </div>
                                    <div class="alert alert-dark mt-4">
                                        <strong>Tips for a good password</strong>
                                        <p class="att">Use both upper dan lowercase characters include at lease one
                                            symbol
                                            (#&^%$^^%etc) Don't use
                                            dictionary words</p>
                                    </div>

                                    <div class="form-group">
                                        <button style="width:100%;" type="submit" class="btn btn-warning" tabindex="4">
                                            Konfirmasi
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center mt-4 mb-3">
                                    <a href="<?= site_url('/'); ?>" class="kuning">Kembali ke halaman login</a>
                                </div>
                            </div>
                        </div>
<br>
<br>
<br>
<br>
<br>
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