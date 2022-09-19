<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="google-signin-client_id" content="932936604587-j8kor41ajgqbtdql43rqtemmj817ph4o.apps.googleusercontent.com">
    <link rel="icon" href="<?= base_url() ?>/public/assets/img/favicon.png" type="image/gif" sizes="16x16">
    <title>Monika PanenSaham &mdash; Masuk</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/sweetalert2.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style-land.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style-about.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/components.css">
    <!-- Start GA -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script> -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-LVKBWVX0SR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LVKBWVX0SR');
        gtag('config', 'AW-382841180');
    </script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script>
        var base_url = '<?= base_url() ?>/';
    </script>
</head>

<body style="background-color:#C1C1C1;">

    <div id="app">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-4" style="margin-top: 15%; margin-bottom: 15%;">
                        <div class="card">
                            <!-- <center>
                                <div class="message" id="notifregis">Registrasi Gagal, Akun Sudah Teregistrasi</div>
                            </center> -->
                            <div class="mt-5 text-muted text-center">
                                <a href="<?= site_url('/'); ?>">
                                    <img alt="logo" src="<?= base_url(); ?>/public/assets/img/logomonika.png" width="300px" height="">
                                </a>
                                <h3>Selamat Datang kembali</h3>
                                Belum Punya Akun? <a class="kuning" href="/newreg" id="daftarsekarang">Daftar Sekarang</a>
                            </div>
                            <div class="card-body">
                            <form method="POST" id="formlogin" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <label for="emaillogin">Email / No Handphone</label>
                            <input style="outline: none;" id="emaillogin" type="email" class="form-control shadow-none" name="emaillogin" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                                Please fill in your email
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="passwordlogin" class="control-label">Password</label>
                            </div>
                            <div class="input-group mb-3">
                                <input style="outline: none;" id="passwordlogin" type="password" class="form-control shadow-none" name="passwordlogin" tabindex="2" required>
                                <div class="input-group-append">
                                    <button id="passBtn" class="btn btn-outline-secondari shadow-none fas fa-eye-slash" style="margin-top:1px solid #ADADAD;" type="button"><i class="" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <!-- <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Ingat Saya</label> -->
                                <div class="float-right">
                                    <a href="<?= site_url('/lupa'); ?>" class="kuning text-small">
                                        Lupa Password
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3 pl-0">
                                    <div class="form-group">
                                        <button id="submitLogin" type="submit" class="boxed-trial mr-4">Masuk</button>
                                    </div>
                                </div>
                                <div class="col-lg-9 pr-0">
                                    <table class="tg">
                                        <thead>
                                            <tr>
                                                <th class="tg-0pky">
                                                    <div class="mt-2 mr-4 ml-2"><a style="font-size: 15px;">Atau Masuk dengan</a></div>
                                                </th>
                                                <th class="tg-0pky">
                                                    <div class="g-signin2" data-onsuccess="onSignIn" data-width="40"></div>
                                                </th>
                                                <th class="tg-0pky">
                                                    <a href="<?= $authURL ?>"><img class="ml-2 pt-1" style="cursor:pointer;" width="30px" id="loginwithfacebook" src="<?= base_url('/public/assets/img/fb.png'); ?>" alt="facebook"></a>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>
                            </div>
                        </div.>
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
    <script src="<?= base_url() ?>/public/assets/js/sweetalert2.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/function.js?rnd=<?=rand()?>"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/public/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/custom.js"></script>
    <script>
        var fb_failed_account = '<?= isset($fb_failed_account) ? $fb_failed_account : '' ?>';
        var fb_failed_email = '<?= isset($fb_failed_email) ? $fb_failed_email : '' ?>';
        var fb_failed_email_verifikasi = '<?= isset($fb_failed_email_verifikasi) ? $fb_failed_email_verifikasi : '' ?>';
        
        const PassBtn10 = document.querySelector('#passBtn');
        PassBtn10.addEventListener('click', () => {
            const input = document.querySelector('#passwordlogin');
            input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
        });
        var myInput = document.getElementById('passwordlogin'),
            myIcon = document.getElementById('passBtn');
        myIcon.onclick = function() {
            if (myIcon.classList.contains('fa-eye-slash')) {
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            } else {
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            };
        }

        if (fb_failed_account != '') {
            Swal.fire('Gagal Login Facebook', 'Cek apakah email anda sudah di verifikasi di Facebook', 'error');
        }

        if (fb_failed_email_verifikasi != '') {
            Swal.fire('Akun Belum Terverifikasi', 'Silahkan cek email untuk proses verifikasi.', 'error');
        }

        if(fb_failed_email != ''){
            Swal.fire('Email anda Salah', 'Email yang anda masukkan salah atau Email belum terdaftar.', 'error');
        }
    </script>
</body>

</html>