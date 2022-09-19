<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- <link rel="icon" href="<?= base_url() ?>/public/assets/img/logo-icon.ico" type="image/gif" sizes="16x16"> -->
    <link rel="icon" href="<?= base_url() ?>/public/assets/img/favicon.png" type="image/gif">
    <title>Monika PanenSaham | <?= $title; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/sweetalert2.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/header-footer.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/loading.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style-land.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style-pricing.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/components.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/datatables.min.css">
    <!--<link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<!-
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    -->

    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script src="<?= base_url() ?>/public/assets/js/snap.js" data-client-key="<?= CLIENTKEY ?>"></script>

    <script src="<?= base_url() ?>/public/assets/modules/jquery.min.js"></script>
    <script>
        var base_url = '<?= base_url() ?>/';
    </script>
</head>

<body>
    <div class="loading_overlay">
        <div class="loading_logo">
            <img id="loading" width="200px" src="<?= base_url('/public/assets/img/loading.png') ?>" />
        </div>
    </div>
    <!-- Page content -->
    <?= $this->renderSection('content_admin'); ?>

</body>

<!-- General JS Scripts -->
<script src="<?= base_url() ?>/public/assets/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>/public/assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>/public/assets/modules/tooltip.js"></script>
<script src="<?= base_url() ?>/public/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>/public/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?= base_url() ?>/public/assets/modules/moment.min.js"></script>
<script src="<?= base_url() ?>/public/assets/js/stisla.js"></script>
<script src="<?= base_url() ?>/public/assets/js/flicky.js"></script>
<script src="<?= base_url() ?>/public/assets/js/function.js"></script>
<script src="<?= base_url() ?>/public/assets/js/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>/public/assets/js/datatables.min.js"></script>

<script src="<?= base_url() ?>/public/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url() ?>/public/assets/modules/sticky-kit.js"></script>

<!-- Page Specific JS File -->
<!--
<script src="<?= base_url() ?>/public/assets/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>/public/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url() ?>/public/assets/js/page/modules-datatables.js"></script>
-->
<script src="<?= base_url() ?>/public/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>

<!-- Template JS File -->
<script src="<?= base_url() ?>/public/assets/js/scripts.js"></script>
<script src="<?= base_url() ?>/public/assets/js/custom.js"></script>
<script src="<?= base_url() ?>/public/assets/js/page/modules-slider.js"></script>

<script src="https://embed.videodelivery.net/embed/sdk.latest.js"></script>



</html>