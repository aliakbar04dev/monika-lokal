<div class="col-12 col-sm-12 col-lg-9">
    <div class="card">
        <div id="demoo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators" style="z-index:8;">
                <?php
                $isactive = 0;
                foreach ($banner as $b) :
                ?>
                    <li data-target="#demo" data-slide-to="<?= $isactive ?>" class="<?= ($isactive == 0) ? "active" : "" ?>"></li>
                <?php
                    $isactive++;
                endforeach;
                ?>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner pb-4 mb-4">
                <?php
                $isactive = 0;
                foreach ($banner as $b) :
                    $isactive++;
                ?>
                    <div style="cursor:pointer;" onclick="window.location='<?= $b['link_banner']; ?>';" class="carousel-item <?= ($isactive == 1) ? "active" : "" ?>">
                        <img width="100%" src="<?= $b['gambar_banner']; ?>">
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="card-body">
            <div class="col-lg-12">

                <ul class="nav nav-pills d-none d-lg-block" id="pills-tab" role="tablist">
                    <li class="nav-item topnav-centered-left">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">NEWS</a>
                    </li>
                    <li class="nav-item topnav-centered-right">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">EVENT</a>
                    </li>
                </ul>
                <ul class="nav nav-pills d-sm-none" id="pills-tab" role="tablist">
                    <li class="nav-item topnav-a">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" data-toggle="" role="tab" aria-controls="pills-home" aria-selected="true">NEWS</a>
                    </li>
                    <li class="nav-item topnav-b">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">EVENT</a>
                    </li>
                </ul>

                <div class="tab-content pt-5" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form method='get' action="pengumuman" id="searchForm">
                            <div class="input-group mb-3">
                                    <div class="col-lg-10">
                                    <input type="text" class="form-control" name="searchNews" id="searchNews" placeholder="Search..." value="<?=$sNws?>" aria-describedby="basic-addon2">
                                    </div>
                                    <div class="col-lg-2">
                                    <button style="padding:5px;" class="boxed-save" style="width:auto;" id='btnsearch' onclick='document.getElementById("searchForm").submit();' type="button">search</button>
                                    </div>
                            </div>
                        </form>
                        <?php foreach ($news as $n) : ?>
                            <div class="accordion-wrapper" style="cursor: pointer;">
                                <div class="acc-head p-3">
                                    <a class="acc" style="cursor: pointer;"><?= $n['judul']; ?></a>
                                    <br><a class="kuning" style="cursor: pointer;">
                                        <?= $n['tgl_pengumuman']; ?>
                                        <!--hot web -->
                                        <?php if ($n['kode_kategori_pengumuman'] == 'KTPM001') { ?>
                                            <img class="hot d-none d-lg-block" src="<?= base_url() ?>/public/assets/img/hot.png" alt="">
                                            <!--hot Mobile-->
                                            <img class="d-sm-none" width="50" src="<?= base_url() ?>/public/assets/img/hotang.png" alt="">
                                        <?php }
                                        if ($n['kode_kategori_pengumuman'] == 'KTPM002') { ?>
                                            <a style="color: red;">NEW!</a>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div class="acc-body">
                                    <?= $n['isi_pengumuman']; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <?= $pager->links('group1','default_full') ?>
                        
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <?php foreach ($event as $e) : ?>
                                <div class="accordion-wrapper">
                                    <div class="acc-head p-3">
                                        <a class="acc" style="cursor: pointer;"><?= $e['judul']; ?></a>
                                        <br><a class="kuning" style="cursor: pointer;">
                                            <?= $e['tgl_pengumuman']; ?>
                                            <!--hot web -->
                                            <?php if ($e['kode_kategori_pengumuman'] == 'KTPM001') { ?>
                                                <img class="hot d-none d-lg-block" src="<?= base_url() ?>/public/assets/img/hot.png" alt="">
                                                <!--hot Mobile-->
                                                <img class="d-sm-none" width="50" src="<?= base_url() ?>/public/assets/img/hotang.png" alt="">
                                            <?php }
                                            if ($e['kode_kategori_pengumuman'] == 'KTPM002') { ?>
                                                <a style="color: red;">NEW!</a>
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="acc-body">
                                        <?= $e['isi_pengumuman']; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>
