<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="google-signin-client_id" content="932936604587-j8kor41ajgqbtdql43rqtemmj817ph4o.apps.googleusercontent.com">
    <link rel="icon" href="<?= base_url() ?>/public/assets/img/favicon.png" type="image/gif" sizes="16x16">
    <title>Monika PanenSaham &mdash; Register</title>

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
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/iti.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

    <script src="<?= base_url() ?>/public/assets/js/iti.js"></script>
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

<!-- <body style="background-color:#C1C1C1;"> -->

<body>

    <div id="app">
        <section class="section bckregis">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-8" style="margin-top: 9%; margin-bottom: 9%;">
                        <div class="card">
                            <center>
                                <div class="message" id="notifregis">Registrasi Gagal, Akun Sudah Teregistrasi</div>
                            </center>
                            <div class="mt-4 text-muted text-center">
                                <a href="<?= site_url('/'); ?>">
                                    <img alt="logo" src="<?= base_url(); ?>/public/assets/img/logomonika.png" width="300px" height="">
                                </a>
                                <br>
                                <h3>Daftar Akun</h3>
                                Sudah Punya Akun? <a href="/newlogin" id="masuksekarang"><span style="color: #EAA401;">Masuk</span></a>
                                <!-- <div class="disk pt-3">Daftarkan dan dapatkan <strong>DISKON</strong> menarik jika anda sudah<br>
                                    bergabung di Komunitas dan Koperasi PanenSaham</div> -->
                            </div>
                            <div class="card-body">
                                <form method="POST" class="needs-validation" id="registrationForm">
                                    <div class="form-group">
                                        <div class="row">
                                            <!-- <div class="col-12"> -->
                                                <!-- <div class="row"> -->
                                                <!-- <div class="col-lg-7"> -->
                                                <!-- <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="radiomember" id="regisnonkomunitas" value="nonkomunitas" checked>
                                                                <label class="form-check-label" for="regisnonkomunitas">
                                                                    Non Member komunitas <a class="kuning">PanenSaham</a>
                                                                </label>
                                                            </div> -->
                                                <!-- <div class="form-group pt-2">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="radio" name="regiskomunitas" id="regiskomunitas" class="custom-control-input" value="komunitas" tabindex="3">
                                                                    <label class="custom-control-label" for="regiskomunitas">Sudah Menjadi member
                                                                        komunitas
                                                                        PanenSaham</label>
                                                                </div>
                                                            </div> -->
                                                <!-- </div>
                                                        <div class="col-lg-5">
                                                            <input style="outline: none;" type="text" class="form-control mb-2 mr-sm-2" id="clientid" name="clientid" placeholder="Masukan Client ID">
                                                        </div> -->
                                                <!--  <div class="col-lg-7 pt-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="radiomember" id="regiskomunitas" value="komunitas">
                                                                <label class="form-check-label" for="regiskomunitas">
                                                                    Member komunitas <a class="kuning">PanenSaham</a>
                                                                </label>
                                                            </div> -->
                                                <!-- <div class="form-group pt-2">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="radio" name="regiskoperasi" id="regiskoperasi" class="custom-control-input" value="koperasi" tabindex="3">
                                                                    <label class="custom-control-label" for="regiskoperasi">Sudah menjadi
                                                                        anggota
                                                                        koperasi
                                                                        PanenSaham</label>
                                                                </div>
                                                            </div> -->
                                                <!-- </div>
                                                        <div class="col-lg-5 pb-3">
                                                            <input style="outline: none;" type="text" class="form-control" id="emailid" name="emailid" placeholder="Masukan Email/ID Anggota">
                                                            <input style="outline: none;" type="text" class="form-control mb-2 mr-sm-2" id="clientid" name="clientid" placeholder="Masukan Email">
                                                        </div> -->
                                                <!-- </div> -->
                                                <!--  </div>
                                            </div> -->

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group col-12">
                                                                <label for="nama">Nama</label>
                                                                <input style="outline: none;" id="nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                                                            </div>
                                                        </div>
                                                        <!--  <div class="col-lg-6">
                                                                <div class="form-group col-12">
                                                                    <label for="hp">Username</label>
                                                                    <input style="outline: none;" id="username" type="text" class="form-control" name="username" tabindex="1" required>
                                                                </div>
                                                            </div> -->
                                                                <!--   <div class="col-lg-6">
                                                                <div class="form-group col-12">
                                                                    <label for="kota">Kota</label>
                                                                    <input style="outline: none;" id="kota" type="text" class="form-control" name="kota" tabindex="1" required autofocus>
                                                                </div>
                                                        </div> -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group col-12">
                                                                <label for="email">Email</label>
                                                                <input style="outline: none;" id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                                            </div>
                                                        </div>
                                                        <!--
                                                            <div class="col-lg-12">
                                                                <div class="form-group col-12">
                                                                    <label for="hp">No HP</label><br>
                                                                    <input style="outline: none; padding-left:60px;" id="hp" type="text" class="form-control" name="hp" tabindex="1" required autofocus onkeypress="return hanyaAngka(event)" maxlength="15">
                                                                </div>
                                                            </div>
                                                        -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group col-12">
                                                                <div class="d-block">
                                                                    <label for="password" class="control-label">Password</label>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <input style="outline: none;" id="password" type="password" class="form-control shadow-none" name="password" tabindex="1" required>
                                                                    <div class="input-group-append" style="border-color:#ADADAD;">
                                                                        <button style="z-index:0;" id="passBtn1" class="btn btn-outline-secondari shadow-none fas fa-eye-slash" type="button">
                                                                            <li class="" aria-hidden="true"></li>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group col-12">
                                                                <div class="d-block">
                                                                    <label for="repeat" class="control-label">Ulangi
                                                                        Password
                                                                    </label>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <input style="outline: none;" id="repeat" type="password" class="form-control shadow-none" name="repeat" tabindex="1" required>
                                                                    <div class="input-group-append">
                                                                        <button style="z-index:0;" id="passBtn2" class="btn btn-outline-secondari shadow-none fas fa-eye-slash" type="button"><i class="" aria-hidden="true"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group col-12">
                                                                <label for="referal">Referral Code</label>
                                                                <input style="outline: none;" id="referal" type="text" class="form-control" name="referal" tabindex="1" value="<?= (isset($reference_id) && $reference_id != '') ? $reference_id : '' ?>" <?= (isset($reference_id) && $reference_id != '') ? 'readonly' : '' ?>>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        if (!isset($reference_id) || $reference_id == '') {
                                                        ?>
                                                            <div class="col-lg-6">
                                                                <div class="form-group col-12" style="padding-top:20px;">
                                                                    <a id="refcodebut" style="background-color: #13AE28;" class="boxed-abu mr-4">Gunakan</a>
                                                                    <img alt="logo" id="okelogo" src="<?= base_url(); ?>/public/assets/img/check.png" width="30px" height="" style="display: none;">
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="syarat" class="custom-control-input" value="accept" tabindex="3" id="syarat" required>
                                                    <label class="custom-control-label" for="syarat">Anda telah menyetujui <a href="<?= site_url('termsconditions'); ?>" style="color: #EAA401;"> syarat dan ketentuan</a> yang berlaku</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <button id="submitRegis" type="submit" class="btn btn-warning mr-5">Lanjut</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <table class="tg">
                                                            <thead>
                                                                <tr>
                                                                    <th class="tg-0pky">
                                                                        <div style="margin-left:20px;">Atau daftar dengan</div>
                                                                    </th>
                                                                    <th class="tg-0pky">
                                                                        <div style="margin-left:15px; margin-top:-5px;" class="g-signin2" data-onsuccess="onRegis" data-width="40"></div>
                                                                    </th>
                                                                    <!-- <th class="tg-0pky"><a href="<?= $authURL ?>"><img class="ml-2 pt-1" style="cursor:pointer;" width="30px" id="loginwithfacebook" src="<?= base_url('/public/assets/img/fb.png'); ?>" alt="facebook"></a></th> -->
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <!-- <div class="col-lg-4">
                                                        <div class="mt-2">Atau daftar dengan</div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div class="g-signin2" data-onsuccess="onSignIn" data-width="40"></div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <a href="<?= $authURL ?>"><img class="ml-2 pt-1" style="cursor:pointer;" width="30px" id="loginwithfacebook" src="<?= base_url('/public/assets/img/fb.png'); ?>" alt="facebook"></a>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <!--<img class="ml-2 g-signin2" data-onsuccess="onSignIn" style="cursor:pointer;" width="40px" href="#" src="<?= base_url('/public/assets/img/google.png'); ?>" alt="google">-->
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
    <script src="<?= base_url() ?>/public/assets/js/function.js?rnd=<?= rand() ?>"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/public/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/custom.js"></script>
    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        $(function() {
            var input = document.querySelectorAll("input[name=hp]");

            iti = intlTelInput(input[i], {
                // initialCountry: "auto",
                separateDialCode: true,
                customPlaceholder: function(selectedCountryPlaceholder) {
                    return '';
                },
                hiddenInput: "calling_code",
                utilsScript: "/public/assets/js/itil.js"
                // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/utils.js"
            });

        });

        var fb_failed_account = '<?= isset($fb_failed_account) ? $fb_failed_account : '' ?>';
        var fb_failed_email = '<?= isset($fb_failed_email) ? $fb_failed_email : '' ?>';
        var fb_registered_account = '<?= isset($fb_registered_account) ? $fb_registered_account : '' ?>';

        const PassBtn1 = document.querySelector('#passBtn1');
        PassBtn1.addEventListener('click', () => {
            const input = document.querySelector('#password');
            input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
        });
        const PassBtn2 = document.querySelector('#passBtn2');
        PassBtn2.addEventListener('click', () => {
            const input = document.querySelector('#repeat');
            input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
        });

        var myInput = document.getElementById('password'),
            myIcon = document.getElementById('passBtn1');
        myIcon.onclick = function() {
            if (myIcon.classList.contains('fa-eye-slash')) {
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            } else {
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            };
        }

        var myInput2 = document.getElementById('repeat'),
            myIcon1 = document.getElementById('passBtn2');
        myIcon1.onclick = function() {
            if (myIcon1.classList.contains('fa-eye-slash')) {
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

        if (fb_failed_email != '') {
            Swal.fire('Email anda Salah', 'Email yang anda masukkan salah atau Email belum terdaftar.', 'error');
        }

        if (fb_registered_account != '') {
            Swal.fire('Registered Email', 'Registrasi gagal, Akun sudah teregistrasi.', 'error');
        }
    </script>
</body>

</html>