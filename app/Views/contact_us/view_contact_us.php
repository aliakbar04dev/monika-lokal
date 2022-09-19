<?= $this->extend('components/template_menu') ?>

<?= $this->section('content_menu') ?>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>
<section id="about" class="about section-bg pt-5 pb-5 pl-2 pr-2">
    <div class="container">
        <div class="row asisten-ah">
            <?= $this->include('contact_us/contact_us_left'); ?>
            <?= $this->include('contact_us/contact_us_right'); ?>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>