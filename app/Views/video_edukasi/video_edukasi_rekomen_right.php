<div class="card-body d-none d-lg-block">
    <div class="pb-3">
        <h5>Video Recommendation
        </h5>
    </div>

    <div class="carousel" data-flickity='{ "imagesLoaded": true, "contain": true, "percentPosition": false, "freeScroll": true, "prevNextButtons": false }' style="background-color:#fff;">
        <?php foreach ($video_rekomendasi as $vr) : ?>
            <div class="col-4">
                <div class="thumbnail video-thumbs" href="#" data-judul="<?= $vr['judul']; ?>" data-subjudul="<?= $vr['judul_filter']; ?>" data-vidlink="<?= $vr['link_media']; ?>" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url(); ?>/public/assets/img/thumbnail2.png" data-target="#vid<?= $vr['kode_media']; ?>">
                    <img class="img-thumbnail" src="<?= $vr['thumbnails_video']; ?>" alt="Another alt text">
                    <div class="middle">
                        <div class="texts"><i class="fas fa-play"></i></div>
                    </div>
                </div>
                <h5 class="pt-4" style="text-align:center;"><?= $vr['judul']; ?> <br> <?= $vr['judul_filter']; ?></h5>
            </div>
        <?php endforeach; ?>
    </div>
</div>