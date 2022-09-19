<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?= base_url() ?>/public/assets/img/favicon.png" type="image/gif" sizes="16x16">
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
            <div class="container mt-1">
                <div class="row">
                    <div class="login-card col-xl-4 offset-xl-4">
						<form method="POST" id="formforget" class="needs-validation">
							<div class="card">
								<div class="mt-5 text-muted text-center">
                                    <a href="<?= site_url('/'); ?>">
									<img class="pb-5" alt="logo" src="<?= base_url() ?>/public/assets/img/ps-logo.png" width="300px" height="">
                                    </a>
								</div>
								<h4 class="pl-5 pr-5">Lupa Password ?</h4>
								<a class="pl-5 pr-5">Masukan alamat email anda dan kami akan mengirimkan alamat untuk merubah password anda.</a>

								<div class="card-body">
									<form method="POST" action="#" class="needs-validation" novalidate="">
										<div class="form-group pb-4">
											<input id="forget" type="email" class="form-control" name="forget" tabindex="1" placeholder="Masukan Alamat Email anda." required autofocus>
											<div class="invalid-feedback">
												Silahkan Isi Kolom tersebut.
											</div>
										</div>

										<div class="form-group">
											<button style="width:100%;" type="submit" class="btn btn-warning" tabindex="4">
												Kirimkan Email
											</button>
										</div>
									</form>
									<div class="text-center mt-4 mb-3">
										<a href="<?= site_url('/newlogin'); ?>" class="kuning">Kembali ke halaman login</a>
									</div>
								</div>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <br>
        <br>
        <br>
        <br>
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