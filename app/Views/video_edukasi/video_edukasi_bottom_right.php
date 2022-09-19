<div class="card-body">
    <div class="pb-3">
        <h5>Tutorial PanenSaham Apps
        </h5>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
				<?php foreach ($video_apps as $va) : ?>
                <div class="col-lg-4">
                    <div class="form-group col-12">
                        <div class="thumbnail video-thumbs" href="#" data-judul="<?= $va['judul']; ?>" data-subjudul="<?= $va['judul_filter']; ?>" data-vidlink="<?= $va['link_media']; ?>" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url(); ?>/public/assets/img/thumbnail2.png" data-target="#vid<?= $va['kode_media']; ?>">
                            <img class="img-thumbnail" src="<?= $va['thumbnails_video']; ?>" alt="Another alt text">
                            <div class="middle">
                                <div class="textss"><i class="fas fa-play uy"></i></div>
                            </div>
                        </div>
                        <h5 class="pt-4 pb-5" style="text-align:center;"><?= $va['judul']; ?> <br> <?= $va['judul_filter']; ?></h5>
                    </div>
                </div>
				<?php endforeach; ?>
            </div>
        </div>
    </div>

</div>