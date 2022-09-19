<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>
				
                <div class="col-lg-9 col-md-6">
					<?php
						if ($lvl != 'MULV002') {
					?>
                    <h2 class="tittle-header">Video Edukasi</h2>
                    <div class="card">
                        <?= $this->include('video_edukasi/video_edukasi_utama_right'); ?>
                        <?= $this->include('video_edukasi/video_edukasi_rekomen_right'); ?>
                        <?= $this->include('video_edukasi/video_edukasi_bottom_right'); ?>
                        <?= $this->include('video_edukasi/modal_video'); ?>
                    </div>
					<?php
						}else{
							echo $this->include('components/template_upgrade');
						}
					?>
                </div>
            </div>
    </section>
</main>
<?= $this->endSection(); ?>