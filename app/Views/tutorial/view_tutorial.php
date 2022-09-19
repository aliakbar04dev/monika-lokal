<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<style>
    .page-item .page-link {
        background-color: #fff;
        border-color: #888888;
        color: #888888;
        padding-left: 17px;
        padding-right: 17px;
        font-family: Poppins; font-weight:bold;
    }
    .page-item.active .page-link {
        background-color: #FBDC8E;
        border-color: #DD9B00;
        color: #DD9B00;
        padding-left: 17px;
        padding-right: 17px;
        font-family: Poppins; font-weight:bold;
    }
</style>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>
                
                <?= $this->include('tutorial/tutorial_content'); ?>
            </div>
    </section>
</main>
<?= $this->endSection(); ?>