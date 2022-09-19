<?php
    if($login == 'Yes'){
?>
    <?= $this->extend('components/template_admin') ?>
    <?= $this->section('content_admin') ?>

    <main class="body" id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
                <div class="row">
                    <?= $this->include('thanks/content'); ?>
                </div>
        </section>
    </main>
    <?= $this->endSection(); ?>
<?php
    }else if($login == 'No'){
?>
<?= $this->extend('components/template_menu') ?>

<?= $this->section('content_menu') ?>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>
    <section id="about" class="about section-bg pt-5 pb-5 pl-2 pr-2">
        <div class="container">
            <div class="row asisten-ah">
                <?= $this->include('thanks/contentland'); ?>
            </div>
        </div>
    </section>

    <?= $this->endSection(); ?>
<?php
    }
?>