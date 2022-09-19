<style>
    .card .card-header, .card .card-body, .card .card-footer {
        background-color: rgb(0 0 0 / 3%);
        padding: 40px 45px;
    }
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
<div class="col-lg-9">

    <div style="padding-left: 60%;">
        <form method="GET" action="<?= base_url('videoweb') ?>" class="form-group">
            <div class="row" style="text-align: center;">
                <div class="col-lg-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="carivideo" placeholder="" required style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit" style="border-bottom-right-radius: 10px; border-top-right-radius: 10px; background-color: #fdc134; border-color: #fdc134; color: #612D11; font-family: Poppins; font-weight:bold;">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php if ($inputCariVideo): ?>
        <div class="card-video mb-4">
            <div class="video-head">
                <div class="row">
                    <div class="col-lg-6">
                        <a class="nav-linko" style="color: #393939; font-weight: bold; font-size:15px;">Hasil Pencarian : <?= $inputCariVideo ?></a>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="<?= base_url('videoweb') ?>" class="btn btn-sm" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-right-radius: 5px; background-color: #fdc134; border-color: #fdc134; color: #612D11; font-family: Poppins; font-weight:bold;">Kembali ke semua video</a>
                    </div>
                </div>
            </div>
            <div class="card-body-video">
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <?php foreach ($hasilCariVideo as $row) : ?>
                                <div class="col-lg-4 mt-3">
                                    <div class="form-group col-12">
                                        <div class="thumbnail video-thumbs" href="#" data-judul="<?= $row['judul']; ?>" data-subjudul="<?= $row['judul_filter']; ?>" data-vidlink="<?= $row['link_media']; ?>" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url(); ?>/public/assets/img/thumbnail2.png" data-target="#vid<?= $row['kode_media']; ?>">
                                            <img class="img-thumbnail" src="<?= $row['thumbnails_video']; ?>" alt="Another alt text">
                                            <div class="middle">
                                                <div class="textss"><i class="fas fa-play uy"></i></div>
                                            </div>
                                        </div>
                                        <h5 class="pt-4 pb-1" style="text-align:center; font-weight: bold; font-size:13px;">
                                            <?= $row['keterangan_submedia'] ?> 
                                            <hr> 
                                            <?= strtoupper($row['judul']) ?>
                                            <hr>
                                            <a href="<?= site_url('videodetail/'.$row['kode_media']) ?>" class="btn btn-sm" style="background-color: #612D11; border:none; color: #fdc134; font-size:10px; padding-left:5%; padding-right:5%;">Lihat semua video di kategori ini</a>
                                        </h5>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div>
                    <hr>
                    <?= $pager->Links() ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="pb-3">
            <iframe class="video-utama" src="https://iframe.videodelivery.net/688a3a040febfe2ff6d6380bdf33c364" style="border: none;" allow="accelerometer; gyroscope; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe>
        </div>
        <div class="card-video">
            <div class="video-head">
                <div class="row">
                    <div class="col"><a class="nav-linko" style="color: #393939; font-weight: bold; font-size:15px;">Video Tutorial</a></div>
                    <div class="col">
                        <!-- Nav tabs -->
                        <ul class="nav justify-content-end">
                            <li class="nav-item">
                                <a class="nav-linko active" data-toggle="tab" href="#utama">Video Utama</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-linko" data-toggle="tab" href="#tranding">Video Tranding</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body-video">
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active" id="utama" style="height: 420px !important; max-height: calc(570px); overflow-y: scroll;">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <?php foreach ($videUtama as $v) : ?>
                                            <div class="col-md-4 pb-2 mb-3" style="border-color:#F39C12;">
                                                <div class="card sub" style="cursor: pointer;" onclick="window.location='<?= site_url('videodetail/'.$v['kode_media']) ?>'">
                                                    <img class="card-img-top" src="<?= $v['thumbnails_video'] ?>" alt="Card image cap">
                                                    <div class="card-body" style="background-color: #fef5e7; border-color:#F39C12;">
                                                        <div class="video-head">

                                                            <?php if (strlen($v['judul']) >= 20): ?>
                                                                <p class="card-text center jud" style="font-weight: bold; font-size:12px;"><?= $v['judul'] ?></p>
                                                            <?php else: ?>
                                                                <p class="card-text center jud" style="font-weight: bold; font-size:12px;"><?= $v['judul'] ?> <br><br></p>
                                                            <?php endif; ?>

                                                            <?php if (strlen($v['keterangan_submedia']) >= 46): ?>
                                                                <h5 class="card-title center pb-2" style="font-weight: bold; font-size:14px;"><?= $v['keterangan_submedia'] ?></h5>
                                                            <?php else: ?>
                                                                <h5 class="card-title center pb-2" style="font-weight: bold; font-size:14px;"><?= $v['keterangan_submedia'] ?> <br><br></h5>
                                                            <?php endif; ?>
                                                            
                                                        </div>
                                                        <center>
                                                            <div style="border-top: 3px solid #F39C12; width:30px; margin-top:-4px;"></div>
                                                        </center>
                                                        <div class="pt-3 text-center">
                                                            <a class="vide" href="<?= site_url('videodetail/'.$v['kode_media']) ?>"><?= $v['total_video'] ?> video</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="col-md-12 pt-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container fade" id="tranding" style="height: 420px !important; max-height: calc(570px); overflow-y: scroll;">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <?php foreach ($videTranding as $vt) : ?>
                                            <div class="col-md-4 pb-2">
                                                <div class="card sub" style="cursor: pointer;"  onclick="window.location='<?= site_url('videodetail/'.$vt['kode_media']) ?>'">
                                                    <img class="card-img-top" src="<?= $vt['thumbnails_video'] ?>" alt="Card image cap">
                                                    <div class="card-body" style="background-color: #fef5e7; border-color:#F39C12;">
                                                        <div class="video-head">
                                                            <p class="card-text center jud" style="font-weight: bold; font-size:12px;"><?= $vt['judul'] ?></p>
                                                            <h5 class="card-title center pb-2" style="font-weight: bold; font-size:14px;"><?= $vt['keterangan_submedia'] ?></h5>
                                                        </div>
                                                        <center>
                                                            <div style="border-top: 3px solid #F39C12; width:30px; margin-top:-4px;"></div>
                                                        </center>
                                                        <div class="pt-3 float-right">
                                                        <a class="vide" href="<?= site_url('videodetail/'.$vt['kode_media']) ?>"><?= $vt['total_video'] ?> video</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="col-md-12 pt-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>


    <!--CUSTOM MODAL -->
    <div class="modal fade modalvideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: rgba(38, 38, 38, 0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="background-color: #FFD73A; border-radius: 20px;">
                <div class="modal-header border-bottom-0">
                    <h4 class="modal-title" id="image-gallery-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body py-0">
                <!--  <video class="video" width="100%" poster="<?= base_url(); ?>/public/assets/img/thumbnail2.png" controls>
                        <source src="<?= base_url(); ?>/public/assets/img/video/felix.mp4" type="video/mp4"> 
                    
                        Your browser does not support HTML video.
                    </video> -->
                    
                    <iframe id="vid_video" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
                    <!-- <iframe src="https://iframe.videodelivery.net/df362e31706e64525ec5ebe0e7958eb9" width="100%" height="400" frameborder="0" allowfullscreen></iframe> -->
                </div>
                <div>
                    <p class="title-img-galeri" style="text-align:center; color:#402615;"><span id="vid_judul" style="text-align:center; color:#402615;"></span> <br> <span id="vid_subjudul" style="text-align:center; color:#402615;"></span></p>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
</div>