<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left_billing1'); ?>
                <?= $this->include('package/detail_content'); ?>
            </div>
    </section>
</main>
<?= $this->endSection(); ?>