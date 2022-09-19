<?= $this->extend('components/template_menu') ?>

<?= $this->section('content_menu') ?>
<link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/career.css">

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>

<section class="">
    <div class="container pt-5 pb-5">
        <div class="row ">
            <img width="100%" src="<?= base_url(); ?>/public/assets/img/career/ban.png">
        </div>
    </div>
</section>
<section class="pb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 style="color:#55341D; text-align:left;" class="pb-4" data-aos="fade-in" data-aos-delay="100">Job Opportunity
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <?php
                foreach ($karir as $l) { ?>
                    <div class="putih">
                                    <div class="ml-3 mr-3 mt-3 mb-3">
                                        <h5 style="color: #55341D; font-size:20px;"><?= $l['karir'] ?></h5>
                                        <h5 class="bord"></h5>
                                    </div>
                                    <div class="ml-3 mr-3 mt-3 mb-3">
                                    <h5>Requirements:</h5>
                                    <p style="font-size:17px; color:#000;"><?= $l['requirement'] ?></p>
                                        <div class="form-group">
                                            <a id="submitLogin" type="submit" class="boxed-trial mr-4" href="<?= site_url('detail'); ?>/<?= $l['id_karir'] ?>">Apply</a>
                                        </div>
                                    </div>
                                </div>
                            <br>
                <?php 
                }
                ?>
                <!--
                <div class="putih">
                    <div class="ml-3 mr-3 mt-3 mb-3">
                            <h5 style="color: #55341D; font-size:20px;">Graphic Designer</h5>
                            <h5 class="bord"></h5>
                    </div>
                    <div class="ml-3 mr-3 mt-3 mb-3">
                    <h5>Requirements:</h5>
                    <h5 class="title" style="font-style: italic;">Developtment Program for sales & Marketing and News Reporter</h5>
                    <p style="font-size:17px;"><a style="color: #E79900;">&#x25cf;</a> Proficiens with Swift and Cocoa Touch</p>
                    <div class="form-group">
                        <button id="submitLogin" type="submit" class="boxed-trial mr-4">Apply</button>
                    </div>
                    </div>
                </div>
                <br>
                <div class="putih">
                    <div class="ml-3 mr-3 mt-3 mb-3">
                            <h5 style="color: #55341D; font-size:20px;">Graphic Designer</h5>
                            <h5 class="bord"></h5>
                    </div>
                    <div class="ml-3 mr-3 mt-3 mb-3">
                    <h5>Requirements:</h5>
                    <h5 class="title" style="font-style: italic;">Developtment Program for sales & Marketing and News Reporter</h5>
                    <p style="font-size:17px;"><a style="color: #E79900;">&#x25cf;</a> Proficiens with Swift and Cocoa Touch</p>
                    <div class="form-group">
                        <button id="submitLogin" type="submit" class="boxed-trial mr-4">Apply</button>
                    </div>
                    </div>
                </div>
                <br>
                -->
            </div>
            <div class="col-lg-3">
                <div class="col-12 pb-4">
                    <!-- <div class="list-group" id="list-tab" role="tablist">
                        <button class="bc radiusatas" onclick="window.location.href=''">
                            <img width="18px" src="<?= base_url(); ?>/public/assets/img/aa.png"><a class="judulmenu">Informasi lowongan kerja</a>
                        </button>
                        <button class="bc" onclick="window.location.href=''">
                            <img width="18px" src="<?= base_url(); ?>/public/assets/img/bb.png"><a class="judulmenu">Informasi rekruitmen</a>
                        </button>
                        <button class="bc radiusbawah" onclick="window.location.href=''">
                            <img width="18px" src="<?= base_url(); ?>/public/assets/img/cc.png"><a class="judulmenu">Testimoni karyawan</a>
                        </button>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>