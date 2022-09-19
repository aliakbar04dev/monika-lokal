<?= $this->extend('components/template_landing') ?>

<?= $this->section('content_landingage') ?>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>
<?= $this->include('landingpage/landing_v2'); ?>

<?= $this->endSection(); ?>