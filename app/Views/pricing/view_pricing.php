<?= $this->extend('components/template_menu') ?>
<?= $this->section('content_menu') ?>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>
<?= $this->include('pricing/categori_area'); ?>
<?= $this->include('pricing/categori_bandingin'); ?>
<?= $this->include('pricing/categori_faq_landing'); ?>

<?= $this->endSection(); ?>