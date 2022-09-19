<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <!-- php echo= $this->include('profile/profile_left');  -->
                <?= $this->include('menu/menu_left2'); ?>
                <?= $this->include('edit_profile/edit_profile_right'); ?>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>