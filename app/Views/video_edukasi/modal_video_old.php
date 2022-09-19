<!-- MODAL -->
<?php foreach ($video_utama as $vu) : ?>
<div class="modal fade modalvideo" id="vid<?= $vu['kode_media']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: rgba(38, 38, 38, 0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background-color: #FFD73A; border-radius: 20px;">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title" id="image-gallery-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body py-0" id="yt-player">
              <!--  <video class="video" width="100%" poster="<?= base_url(); ?>/public/assets/img/thumbnail2.png" controls>
                    <source src="<?= base_url(); ?>/public/assets/img/video/felix.mp4" type="video/mp4"> 
				   
                    Your browser does not support HTML video.
                </video> -->
				
				<iframe id="custom-video" width="100%" height="400" src="<?= $vu['link_media']; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div>
                <p class="title-img-galeri" style="text-align:center; color:#402615;"><?= $vu['judul']; ?> <br> <?= $vu['judul_filter']; ?></p>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- END MODAL -->


<!-- MODAL -->
<?php foreach ($video_rekomendasi as $vr) : ?>
<div class="modal fade modalvideo" id="vid<?= $vr['kode_media']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: rgba(38, 38, 38, 0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background-color: #FFD73A; border-radius: 20px;">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title" id="image-gallery-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body py-0" id="yt-player">
              <!--  <video class="video" width="100%" poster="<?= base_url(); ?>/public/assets/img/thumbnail2.png" controls>
                    <source src="<?= base_url(); ?>/public/assets/img/video/felix.mp4" type="video/mp4"> 
				   
                    Your browser does not support HTML video.
                </video> -->
				
				<iframe id="custom-video" width="100%" height="400" src="<?= $vr['link_media']; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div>
                <p class="title-img-galeri" style="text-align:center; color:#402615;"><?= $vr['judul']; ?> <br> <?= $vr['judul_filter']; ?></p>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- END MODAL -->

<!-- MODAL -->
<?php foreach ($video_apps as $va) : ?>
<div class="modal fade modalvideo" id="vid<?= $va['kode_media']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: rgba(38, 38, 38, 0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background-color: #FFD73A; border-radius: 20px;">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title" id="image-gallery-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body py-0" id="yt-player">
              <!--  <video class="video" width="100%" poster="<?= base_url(); ?>/public/assets/img/thumbnail2.png" controls>
                    <source src="<?= base_url(); ?>/public/assets/img/video/felix.mp4" type="video/mp4"> 
				   
                    Your browser does not support HTML video.
                </video> -->
				
				<iframe id="custom-video" width="100%" height="400" src="<?= $va['link_media']; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div>
                <p class="title-img-galeri" style="text-align:center; color:#402615;"><?= $va['judul']; ?> <br> <?= $va['judul_filter']; ?></p>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- END MODAL -->