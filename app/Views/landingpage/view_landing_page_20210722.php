<?= $this->extend('components/template_landing') ?>

<?= $this->section('content_landingage') ?>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>
<?= $this->include('landingpage/slider_area_start'); ?>
<?= $this->include('landingpage/populer_catagory_layer2'); ?>
<?= $this->include('landingpage/popular_catagory_area_start'); ?>
<?= $this->include('landingpage/popular_catagory_video'); ?>
<?= $this->include('landingpage/popular_catagory_bawah'); ?>

<?= $this->endSection(); ?>