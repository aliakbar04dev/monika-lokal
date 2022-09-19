<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<style>
    .swal2-styled.swal2-confirm {
        border: 0;
        border-radius: 0.25em;
        background: #3085d6;
        background-color: #3085d6;
        color: #fff;
        font-size: 1em;
        border: none;
    }
</style>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>
                <?= $this->include('chart/chart_right'); ?>
            </div>
    </section>
</main>
<?= $this->endSection(); ?>