<?= $this->extend('components/template_mobile') ?>
<?= $this->section('content_admin') ?>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
					<?php
						if ($lvl == 'MULV001' || $lvl == 'MULV003' || $lvl == 'MULV004' || $lvl == 'MULV005') {
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