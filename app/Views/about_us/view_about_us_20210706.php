<?= $this->extend('components/template_menu') ?>

<?= $this->section('content_menu') ?>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>
<section class="bg">
</section>
<section class="pl-4 pr-4">
    <div class="container pt-5 pb-5">
        <div class="row ">
            <?= $this->include('about_us/about_us_left'); ?>
            <?= $this->include('about_us/about_us_right'); ?>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>