<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<style>
    .page-item .page-link {
        color: #612D11;
        border-radius: 3px;
        margin: 0 3px;
    }

    .text-primary-ali {
        color: #145eab;
    }
    .text-success-ali {
        color: #0ec92d;
    }
    .text-danger-ali {
        color: #ec1c24;
    }
    .cke_top {
        display: none !important 
    } 
    .page-item:first-child .page-link {
        font-family: Poppins;
    }
    .page-link {
        font-family: Poppins;
    }
    span {
        font-family: Poppins;
    }
</style>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>
                <?= $this->include('action/action_web_konten'); ?>
            </div>
    </section>
</main>
<?= $this->endSection(); ?>