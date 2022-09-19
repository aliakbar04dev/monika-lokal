<div class="card-body">
    <div class="pb-3">
        <h3><i class="fas fa-film fa-sm kuning"></i> <a>Trending</a> <a class="kuning">Video</a>
        </h3>
    </div>
    <div class="carousel" data-flickity='{ "imagesLoaded": true, "contain": true, "percentPosition": false, "freeScroll": true, "prevNextButtons": false }' style="background-color:#fff;">
        <?php foreach ($video_utama as $vu) : ?>
            <!-- <div class="col-12">
            <div class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url(); ?>/public/assets/img/thumbnail2.png" data-target="#vid<?= $vu['kode_media']; ?>">
                <img class="img-thumbnail" src="<?= $vu['thumbnails_video']; ?>" alt="Another alt text">
                <div class="middle">
                    <div class="text d-none d-lg-block"><i class="fas fa-play"></i></div>
                    <div class="textsa d-sm-none"><i class="fas fa-play ihi"></i></div>
                </div>
            </div>
            <h3 class="pt-4" style="text-align:center;"><?= $vu['judul']; ?> <br> <?= $vu['judul_filter']; ?></h3>
        </div> -->

            <div class="col-12">
                <div class="thumbnail video-thumbs" data-judul="<?= $vu['judul']; ?>" data-subjudul="<?= $vu['judul_filter']; ?>" data-vidlink="<?= $vu['link_media']; ?>" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url(); ?>/public/assets/img/thumbnail2.png">
                    <img class="img-thumbnail" src="<?= $vu['thumbnails_video']; ?>" alt="Another alt text">
                    <div class="middle">
                        <div class="text d-none d-lg-block"><i class="fas fa-play"></i></div>
                        <div class="textsa d-sm-none"><i class="fas fa-play ihi"></i></div>
                    </div>
                </div>
                <h3 class="pt-4" style="text-align:center;"><?= $vu['judul']; ?> <br> <?= $vu['judul_filter']; ?></h3>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<hr width=" 100%">