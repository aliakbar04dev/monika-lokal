<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- <link rel="icon" href="<?= base_url(); ?>/public/assets/img/logo-icon.ico" type="image/gif" sizes="16x16"> -->
    <link rel="icon" href="<?= base_url() ?>/public/assets/img/favicon.png" type="image/gif">
    <title>Monika PanenSaham | <?= $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="google-signin-client_id" content="932936604587-j8kor41ajgqbtdql43rqtemmj817ph4o.apps.googleusercontent.com">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/gijgo.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/slicknav.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/sweetalert2.min.css">
    <link href="<?= base_url() ?>/public/vendor/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style-land.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style-about.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/landing-v2.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Muli" />
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/loading.css">
    <script src="<?= base_url() ?>/public/assets/js/snapprod.js" data-client-key="<?= CLIENTKEY ?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    <script src="https://kit.fontawesome.com/1f76310694.js" crossorigin="anonymous"></script>
    <script>
        var base_url = '<?= base_url() ?>/';
    </script>
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "1ab1cc67-e3b3-4157-bc27-9861d3f9b06d";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LVKBWVX0SR"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LVKBWVX0SR');
        gtag('config', 'AW-382841180');
    </script>

</head>

<body style="font-family: 'Poppins';">
    <div class="container-fluid">

        <!-- header user 2 -->
        <header class="head">
            <div class="head pl-4 pr-4">
                <div id="sticky-header" class="main-head">
                    <?= $this->include('menu/menu_top'); ?>
                </div>
            </div>
        </header>

        <!-- Page content -->
        <?= $this->renderSection('content_menu'); ?>

        <!-- footer -->
        <?= $this->include('components/template_footer'); ?>
    </div>

    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="<?= base_url() ?>/public/assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/isotope.pkgd.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/ajax-form.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/waypoints.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/jquery.counterup.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/scrollIt.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/wow.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/nice-select.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/jquery.slicknav.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/plugins.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/gijgo.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/function.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/sweetalert2.min.js"></script>
    <script src='https://vjs.zencdn.net/7.6.5/video.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?= base_url() ?>/public/assets/js/datatables.min.js"></script>


    <!--contact js-->
    <script src="<?= base_url() ?>/public/assets/js/contact.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/jquery.form.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/mail-script.js"></script>


    <script src="<?= base_url() ?>/public/assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            var fb_failed_account = '<?= isset($fb_failed_account) ? $fb_failed_account : '' ?>';
            var fb_failed_email = '<?= isset($fb_failed_email) ? $fb_failed_email : '' ?>';
            var fb_registered_account = '<?= isset($fb_registered_account) ? $fb_registered_account : '' ?>';
            var fb_failed_email_verifikasi = '<?= isset($fb_failed_email_verifikasi) ? $fb_failed_email_verifikasi : '' ?>';

            if (fb_failed_account != '') {
                Swal.fire('Gagal Login Facebook', 'Cek apakah email anda sudah di verifikasi di Facebook', 'error');
            }

            if(fb_failed_email != ''){
                Swal.fire('Email anda Salah', 'Email yang anda masukkan salah atau Email belum terdaftar.', 'error');
            }

            if(fb_registered_account != ''){
                Swal.fire('Registered Email', 'Registrasi gagal, Akun sudah teregistrasi.', 'error');
            }

            if (fb_failed_email_verifikasi != '') {
                Swal.fire('Akun Belum Terverifikasi', 'Silahkan cek email untuk proses verifikasi.', 'error');
            }
        });

        function hoveritemteks() {
            document.getElementById("hoveritem").style.color = "black";
        }
    </script>
</body>

</html>