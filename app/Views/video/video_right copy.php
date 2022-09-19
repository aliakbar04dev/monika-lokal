<div class="col-lg-9">
    <div class="pb-2">
        <iframe class="video-utama" src="https://iframe.videodelivery.net/688a3a040febfe2ff6d6380bdf33c364" style="border: none;" allow="accelerometer; gyroscope; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe>
    </div>



    <div class="card-video">
        <div class="video-head">
            <div class="row">
                <div class="col"><a class="nav-linko" style="color: #393939; font-weight: bold; font-size:20px;">Video Tutorial</a></div>
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
                        <div class="tab-pane container active" id="utama">
                            <div class="col-lg-12">
                                <div class="row">
                                    <?php foreach ($vid as $v) : ?>
                                        <div class="col-md-4 pb-2">
                                            <div class="card sub" style="cursor: pointer;" onclick="window.location='<?= site_url('videodetail'); ?>'">
                                                <img class="card-img-top" src="<?= $v['thumbnail'] ?>" alt="Card image cap">
                                                <div class="card-body">
                                                    <div class="video-head">
                                                        <p class="card-text center jud"><?= $v['keterangan_submedia'] ?></p>
                                                        <h5 class="card-title center pb-2">Chart TA - cah</h5>
                                                    </div>
                                                    <center>
                                                        <div style="border-top: 3px solid #F39C12; width:30px; margin-top:-4px;"></div>
                                                    </center>
                                                    <div class="pt-3 float-right">
                                                        <a class="vide"><?= $v['total_video'] ?> video</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="col-md-12 pt-3">
                                        <!--
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            -->
                                        <?= $pager->links('video1', 'default_full') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="tranding">
                            <div class="col-lg-12">
                                <div class="row">
                                    <?php foreach ($vid as $v) : ?>
                                        <div class="col-md-4 pb-2">
                                            <div class="card sub" style="cursor: pointer;" onclick="window.location='<?= site_url('videodetail'); ?>'">
                                                <img class="card-img-top" src="<?= $v['thumbnail'] ?>" alt="Card image cap">
                                                <div class="card-body">
                                                    <div class="video-head">
                                                        <p class="card-text center jud"><?= $v['keterangan_submedia'] ?></p>
                                                        <h5 class="card-title center pb-2">Chart TA - cah</h5>
                                                    </div>
                                                    <center>
                                                        <div style="border-top: 3px solid #F39C12; width:30px; margin-top:-4px;"></div>
                                                    </center>
                                                    <div class="pt-3 float-right">
                                                        <a class="vide"><?= $v['total_video'] ?> video</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="col-md-4 pb-2">
                                        <div class="card sub" style="cursor: pointer;" onclick="window.location='http://google.com';">
                                            <img class="card-img-top" src="<?php echo base_url('public/assets/img/hmm.png') ?>" alt="Card image cap">
                                            <div class="card-body">
                                                <div class="video-head">
                                                    <p class="card-text center jud">Belajar macam-macam perintah chart teknikal</p>
                                                    <h5 class="card-title center pb-2">Chart TA - cah</h5>
                                                </div>
                                                <center>
                                                    <div style="border-top: 3px solid #F39C12; width:30px; margin-top:-4px;"></div>
                                                </center>
                                                <div class="pt-3 float-right">
                                                    <a class="vide">11 video</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pb-2">
                                        <div class="card sub" style="cursor: pointer;" onclick="window.location='http://google.com';">
                                            <img class="card-img-top" src="<?php echo base_url('public/assets/img/hmm.png') ?>" alt="Card image cap">
                                            <div class="card-body">
                                                <div class="video-head">
                                                    <p class="card-text center jud">Belajar macam-macam perintah chart teknikal</p>
                                                    <h5 class="card-title center pb-2">Chart TA - cah</h5>
                                                </div>
                                                <center>
                                                    <div style="border-top: 3px solid #F39C12; width:30px; margin-top:-4px;"></div>
                                                </center>
                                                <div class="pt-3 float-right">
                                                    <a class="vide">11 video</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>