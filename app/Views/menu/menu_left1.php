<?php  
    $db = db_connect();
    $queryz = $db->query("SELECT a.kode_user, b.alias_level, a.nama_lengkap, a.trial_expire, a.expire_date, a.kode_user_level, a.alamat_email, a.photo
                        FROM t_user a
                        LEFT JOIN m_user_level b ON a.kode_user_level=b.kode_user_level
                        LEFT JOIN t_pembayaran c ON a.paket_user=c.kode_pembayaran
                        LEFT JOIN harga_paket d ON a.paket_user=d.kode_user_level
                        WHERE a.kode_user='".getsession("kode_user")."'");
    $dataUser = $queryz->getRowArray();

    $kodeUserLvl = $dataUser['kode_user_level'];
    $photoUser = $dataUser['photo'];
    $queryzz = $db->query("SELECT a.kode_user_level, b.kode_harga_paket FROM t_user a LEFT JOIN harga_paket b ON a.kode_user_level=b.kode_user_level WHERE a.kode_user_level = '$kodeUserLvl'");
    $kodePaketArray = $queryzz->getRowArray();
?>

<div class="col-lg-3 col-md-3 d-none d-lg-block">
    <!--<div class="col-12 pb-4">
        <div class="col-md-12 col-1 pl-0 pr-0 collapse show" id="sidebar">
        </div>
        <div class="list-group" id="list-tab" role="tablist">
            <button class="list-group-item list-group-item-action" id="list-profile-list" href="" role="tab">Pengumuman</button>
            <button class="list-group-item list-group-item-action" id="list-home-list" href="" role="tab">Profile</button>
            <button class="list-group-item list-group-item-action" id="list-messages-list" aria-expanded="true" data-toggle="collapse" href="#menu1" role="tab">Analisa Teknikal</button>
            <div class="collapse" id="menu1" data-parent="#sidebar">
                <button href="<?= site_url('chart'); ?>" class="list-group-item list-group-item-action <?= ($title == 'Chart Teknikal Analysis') ? 'active' : '' ?>">Chart TA</button>
                <button href="<?= site_url('tabel'); ?>" class="list-group-item list-group-item-action <?= ($title == 'Tabel Teknikal Analysis') ? 'active' : '' ?>">Filter TA</button>
            </div>
            <button class="list-group-item list-group-item-action" id="list-settings-list" href="#" role="tab">Analisa Fundamental</button>
            <button class="list-group-item list-group-item-action" id="list-settings-list" href="" role="tab">Stock Alert</button>
            <button class="list-group-item list-group-item-action" id="list-settings-list" href="" role="tab">Tutorial</button>
            <button class="list-group-item list-group-item-action <?= ($title == 'Video Edukasi') ? 'active' : '' ?>" id="list-settings-list" href="<?= site_url('video_edukasi'); ?>" role="tab">Video Edukasi</button>
            <button class="list-group-item list-group-item-action <?= ($title == 'Tabel Sakti') ? 'active' : '' ?>" id="list-settings-list" href="<?= site_url('tabel_sakti'); ?>" role="tab">Tabel Sakti</button>
            <button class="list-group-item list-group-item-action" id="list-settings-list" href="" role="tab">Chat with Us</button>
            <button class="list-group-item list-group-item-action" id="list-settings-list" href="<?= site_url('logout'); ?>" role="tab">Logout</button>
        </div>
    </div>-->
    <div class="col-12 pb-5">
        <div class="card mb-4">
            <div class="card-body" id="tempatgambar" style="font-family: Poppins;">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img id="smallprofil" alt="image" width="100px" src="<?= ($photoUser != '') ? $photoUser : base_url('/public/assets/img/avatar/avatar-1.png') ?>" class="ml-1 mr-1 mb-3" style="border-radius: 100px;">
                        <br>
                        <h6 style="text-align: center; color:#000; font-family: Poppins; font-size:11px;">Paket saat ini:</h6>
                    </div>

                    <?php if ($dataUser['kode_user_level'] === 'MULV001'): ?>
                        <div class="col-lg-12 text-center mb-3">
                            <a style="background-image: linear-gradient(#4E88A9, #12AAAA70); border-color: #fff; border-radius:20px; cursor: context-menu;" class="btn btn-light btn-lg">
                                <h6 style="color:#BCE7FF; margin-bottom:-3px; font-family: Poppins; font-size:11px;">TRIAL</h6>
                            </a>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size:11px;">TRIAL Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#E20000; font-family: Poppins; font-size:11px;"><?= date("d/m/Y", strtotime($dataUser['trial_expire'])) ?></h6>
                        </div>
                        <div class="col-lg-12 text-center mt-2">
                            <button style="background-color: #ffd73a;" class="boxed-save" onclick="window.location.href='<?= base_url('pricing') ?>'">
                                <h6 style="color:#612D11; margin-bottom:-3px; font-family: Poppins; font-size:11px;">Beli Paket</h6>
                            </button>
                        </div>

                    <?php elseif ($dataUser['kode_user_level'] === 'MULV002'): ?>
                        <div class="col-lg-12 text-center mb-3">
                            <a style="background-image: linear-gradient(#4E88A9, #12AAAA70); border-color: #fff; border-radius:20px; cursor: context-menu;" class="btn btn-light btn-lg">
                                <h6 style="color:#BCE7FF; margin-bottom:-3px; font-family: Poppins; font-size:11px;">NO PAKET</h6>
                            </a>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size:11px;">TRIAL Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#E20000; font-family: Poppins; font-size: 11px;"><?= date("d/m/Y", strtotime($dataUser['trial_expire'])) ?></h6>
                        </div>
                        <div class="col-lg-12 text-center mt-2">
                            <button style="background-color: #ffd73a;" class="boxed-save" onclick="window.location.href='<?= base_url('pricing') ?>'">
                                <h6 style="color:#612D11; margin-bottom:-3px; font-family: Poppins; font-size:11px;">Beli Paket</h6>
                            </button>
                        </div>

                    <?php elseif ($dataUser['kode_user_level'] === 'MULV003'): ?>
                        <div class="col-lg-12 text-center mb-3">
                            <a style="background-image: linear-gradient(#786EED, #8212AA70); border-color: #fff; border-radius:20px; cursor: context-menu;" class="btn btn-light btn-lg">
                                <h6 style="color:#BCE7FF; margin-bottom:-3px; font-family: Poppins; font-size:11px;">PAKET TA</h6>
                            </a>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size:11px;">TRIAL Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#E20000; font-family: Poppins; font-size: 11px;"><?= date("d/m/Y", strtotime($dataUser['trial_expire'])) ?></h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;">PAKET Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;"><?= date("d/m/Y", strtotime($dataUser['expire_date'])) ?></h6>
                        </div>
                        <div class="col-lg-12 text-center mt-2">
                            <a href="<?= base_url('/extendpackage'.'/'.$kodePaketArray['kode_harga_paket']) ?>" style="background-color: #ffd73a;" class="boxed-save">
                                <h6 style="color:#612D11; margin-bottom:-3px; font-family: Poppins; font-size: 11px;">Perpanjang Paket</h6>
                            </a>
                        </div>

                    <?php elseif ($dataUser['kode_user_level'] === 'MULV004'): ?>
                        <div class="col-lg-12 text-center mb-3">
                            <a style="background-image: linear-gradient(#786EED, #8212AA70); border-color: #fff; border-radius:20px; cursor: context-menu;" class="btn btn-light btn-lg">
                                <h6 style="color:#BCE7FF; margin-bottom:-3px; font-family: Poppins; font-size: 11px;">PAKET FA</h6>
                            </a>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;">TRIAL Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#E20000; font-family: Poppins; font-size: 11px;"><?= date("d/m/Y", strtotime($dataUser['trial_expire'])) ?></h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;">PAKET Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;"><?= date("d/m/Y", strtotime($dataUser['expire_date'])) ?></h6>
                        </div>
                        <div class="col-lg-12 text-center mt-2">
                            <a href="<?= base_url('/extendpackage'.'/'.$kodePaketArray['kode_harga_paket']) ?>" style="background-color: #ffd73a;" class="boxed-save">
                                <h6 style="color:#612D11; margin-bottom:-3px; font-family: Poppins; font-size: 11px;">Perpanjang Paket</h6>
                            </a>
                        </div>

                    <?php elseif ($dataUser['kode_user_level'] === 'MULV005'): ?>
                        <div class="col-lg-12 text-center mb-3">
                            <a style="background-image: linear-gradient(#786EED, #8212AA70); border-color: #fff; border-radius:20px; cursor: context-menu;" class="btn btn-light btn-lg">
                                <h6 style="color:#BCE7FF; margin-bottom:-3px; font-family: Poppins; font-size: 11px;">ULTIMATE</h6>
                            </a>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;">TRIAL Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#E20000; font-family: Poppins; font-size: 11px;"><?= date("d/m/Y", strtotime($dataUser['trial_expire'])) ?></h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;">PAKET Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;"><?= date("d/m/Y", strtotime($dataUser['expire_date'])) ?></h6>
                        </div>
                        <div class="col-lg-12 text-center mt-2">
                            <a href="<?= base_url('/extendpackage'.'/'.$kodePaketArray['kode_harga_paket']) ?>" style="background-color: #ffd73a;" class="boxed-save">
                                <h6 style="color:#612D11; margin-bottom:-3px; font-family: Poppins; font-size: 11px;">Perpanjang Paket</h6>
                            </a>
                        </div>

                    <?php elseif ($dataUser['kode_user_level'] === 'MULV006'): ?>
                        <div class="col-lg-12 text-center mb-3">
                            <a style="background-image: linear-gradient(#4E88A9, #12AAAA70); border-color: #fff; border-radius:20px; cursor: context-menu;" class="btn btn-light btn-lg">
                                <h6 style="color:#BCE7FF; margin-bottom:-3px; font-family: Poppins; font-size: 11px;">ADMIN</h6>
                            </a>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#000; font-family: Poppins; font-size: 11px;">TRIAL Exp.</h6>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h6 style="text-align: center; color:#E20000; font-family: Poppins; font-size: 11px;"><?= date("d/m/Y", strtotime($dataUser['trial_expire'])) ?></h6>
                        </div>
                        <div class="col-lg-12 text-center mt-2">
                            <button style="background-color: #ffd73a;" class="boxed-save" onclick="window.location.href='<?= base_url('pricing') ?>'">
                                <h6 style="color:#612D11; margin-bottom:-3px; font-family: Poppins; font-size: 11px;">Beli Paket</h6>
                            </button>
                        </div>
                    <?php else: ?>
                        Error
                    <?php endif ?>
                        
                  
                </div>
            </div>
        </div>





        
        <button class="dalem radiusatas <?= ($title == 'Pengumuman') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('pengumuman'); ?>'">
            <a class="judulmenu" href="<?= site_url('pengumuman'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Pengumuman') ? 'color:#612D11;' : '' ?>">Beranda</a>
        </button>
        <button class="dalem <?= ($title == 'Profile') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('profile'); ?>'">
            <a class="judulmenu" href="<?= site_url('profile'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Profile') ? 'color:#612D11;' : '' ?>">Profil</a>
        </button>



        <?php
        //if ($lvl != '' && ($lvl == 'MULV001' || $lvl == 'MULV005')) {
        ?>
        <button <?php if($title == 'Daily Stock' || $title == 'Trailling Stop' || $title == 'Watchlist Action' || $title == 'Open Position' || $title == 'Closed Position' || $title == 'Performa Copy Trade' || $title == 'Stock Review') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
            <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold;">Monika's Secret</a>
        </button>
        <div class="content" <?php if($title == 'Daily Stock' || $title == 'Trailling Stop' || $title == 'Watchlist Action' || $title == 'Open Position' || $title == 'Closed Position' || $title == 'Performa Copy Trade' || $title == 'Stock Review') { echo 'style="max-height: 600px;"'; }else{ echo 'style=""' ;} ?>>
            <button class="dalem" <?php if($title == 'Stock Review') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('stockreview') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('stockreview'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Stock Review') ? 'color:#ffd73a;' : '' ?>">&#8226; Stock Review</a>
            </button>
            <button class="dalem" <?php if($title == 'Daily Stock') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('dailywebihsg') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('dailywebihsg'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Daily Stock') ? 'color:#ffd73a;' : '' ?>">&#8226; Daily Stock</a>
            </button> 
            <button class="dalem" <?php if($title == 'Trailling Stop') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('trailopenweb') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('trailopenweb'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Trailling Stop') ? 'color:#ffd73a;' : '' ?>">&#8226; Trailling Stop</a>
            </button>
            <button class="dalem" <?php if($title == 'Watchlist Action' || $title == 'Open Position' || $title == 'Closed Position' || $title == 'Performa Copy Trade') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('openweb') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('openweb'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Watchlist Action' || $title == 'Open Position' || $title == 'Closed Position' || $title == 'Performa Copy Trade') ? 'color:#ffd73a;' : '' ?>">&#8226; Copy Trades</a>
            </button>
        </div>

        <button <?php if($title == 'Chart Teknikal Analisis' || $title == 'Tabel Teknikal Analisis') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
            <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold;">Analisa Teknikal</a>
        </button>
        <div class="content" <?php if($title == 'Chart Teknikal Analisis' || $title == 'Tabel Teknikal Analisis') { echo 'style="max-height: 117px;"'; }else{ echo 'style=""' ;} ?>>
            <button class="dalem" <?php if($title == 'Chart Teknikal Analisis') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('chart') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('chart'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Chart Teknikal Analisis') ? 'color:#ffd73a;' : '' ?>">&#8226;  Chart Teknikal</a>
            </button>
            <button class="dalem" <?php if($title == 'Tabel Teknikal Analisis') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('tabel') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('tabel'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Tabel Teknikal Analisis') ? 'color:#ffd73a;' : '' ?>">&#8226;  Filter Teknikal</a>
            </button>
        </div>
        <?php

        /*if ($lvl != 'MULV002' && $lvl != 'MULV003') {*/
        ?>
        <button <?php if($title == 'Chart Fundamental Analysis' || $title == 'Tabel Fundamental Analysis') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
            <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold;">Analisa Fundamental</a>
        </button>
        <div class="content" <?php if($title == 'Chart Fundamental Analysis' || $title == 'Tabel Fundamental Analysis') { echo 'style="max-height: 117px;"'; }else{ echo 'style=""' ;} ?>>
            <button class="dalem" <?php if($title == 'Chart Fundamental Analysis') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('chartfa') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('chartfa'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Chart Fundamental Analysis') ? 'color:#ffd73a;' : '' ?>">&#8226; Chart Fundamental</a>
            </button>
            <button class="dalem" <?php if($title == 'Tabel Fundamental Analysis') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('tabelfa') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('tabelfa'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Tabel Fundamental Analysis') ? 'color:#ffd73a;' : '' ?>">&#8226; Filter Fundamental</a>
            </button>
        </div>

        <button <?php if($title == 'News' || $title == 'Informasi Bursa' || $title == 'Bedah Emiten IPO') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
            <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold;">News Update</a>
        </button>
        <div class="content" <?php if($title == 'News' || $title == 'Informasi Bursa' || $title == 'Bedah Emiten IPO') { echo 'style="max-height: 600px;"'; }else{ echo 'style=""' ;} ?>>
            <button class="dalem" <?php if($title == 'News') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('news') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('news'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'News') ? 'color:#ffd73a;' : '' ?>">&#8226; News</a>
            </button>
            <button class="dalem" <?php if($title == 'Informasi Bursa') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('informasibursa') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('informasibursa'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Informasi Bursa') ? 'color:#ffd73a;' : '' ?>">&#8226; Informasi Bursa</a>
            </button>
            <button class="dalem" <?php if($title == 'Bedah Emiten IPO') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('emitenipo') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('emitenipo'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Bedah Emiten IPO') ? 'color:#ffd73a;' : '' ?>">&#8226; Bedah Emiten IPO</a>
            </button>
        </div>


        <?php
        /*}

        if ($lvl == 'MULV005' && $lvl == 'MULV003') {*/
        ?>
        <!-- <button class="dalem">
            <a class="judulmenu">Stock Alert</a>
        </button> -->
        <?php
        /*}*/
        ?>

        <button class="dalem <?= ($title == 'Smartwatchlist') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('smartwatchlist'); ?>'">
            <a class="judulmenu" href="<?= site_url('smartwatchlist'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Smartwatchlist') ? 'color:#612D11;' : '' ?>">My Watchlist</a>
        </button>
       
        <!-- <button class="dalem <?= ($title == 'Tutorial') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('tutorial'); ?>'">
            <a class="judulmenu" href="<?= site_url('tutorial'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Tutorial') ? 'color:#612D11;' : '' ?>">Tutorial</a>
        </button>

        <button class="dalem <?= ($title == 'Video Edukasi') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('videoedukasi'); ?>'">
            <a class="judulmenu" href="<?= site_url('videoedukasi'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Video Edukasi') ? 'color:#612D11;' : '' ?>">Video Tutorial</a>
        </button> -->

        <button <?php if($title == 'Tutorial' || $title == 'Video') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
            <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold;">Tutorial</a>
        </button>
        <div class="content" <?php if($title == 'Tutorial' || $title == 'Video') { echo 'style="max-height: 600px;"'; }else{ echo 'style=""' ;} ?>>
            <button class="dalem" <?php if($title == 'Tutorial') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('tutorial') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('tutorial'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Tutorial') ? 'color:#ffd73a;' : '' ?>">&#8226; Artikel</a>
            </button>
            <button class="dalem" <?php if($title == 'Video') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('videoweb') ?>'">
                <a class="judulmenu ml-4" href="<?= site_url('videoweb'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Video') ? 'color:#ffd73a;' : '' ?>">&#8226; Video</a>
            </button>
        </div>

        <button class="dalem <?= ($title == 'Tabel Sakti') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('tabelsakti'); ?>'">
            <a class="judulmenu" href="<?= site_url('tabelsakti'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold; <?= ($title == 'Tabel Sakti') ? 'color:#612D11;' : '' ?>">Tabel Sakti</a>
        </button>

        <button class="dalem" style="cursor:pointer;" onclick="$crisp.push(['do', 'chat:open']);">
            <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold;">Hubungi Kami</a>
        </button>
        
        <button class="dalem radiusbawah" onclick="window.location.href='<?= site_url('logout'); ?>'">
            <a class="judulmenu" href="<?= site_url('logout'); ?>" style="font-family: Poppins; font-size:12px; font-weight:bold;">Keluar</a>
        </button>
    </div>

    <!-- <?php if ($title == 'Tutorial') { ?>

        <div class="col-12">
            <ul>
                <li class="card-abu pl-3 pt-3 pr-3 pb-3">
                    <div class="section-body">
                        <h2 class="section-title">
                            OVERVIEW
                            <hr>
                        </h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="activities">
                                    <div class="activity pb-2">
                                        <div class="activity-icon" style="background-color: #C1C1C1;">
                                        </div>
                                        <div>
                                            <p>
                                                <a class="coklat">01.</a>
                                                <a href="#">Ini Tempat Judul yaa</a><br>
                                                <a class="sub">Gatau ini apa ada sub nya</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="activity pb-2">
                                        <div class="activity-icon" style="background-color: #C1C1C1;">
                                        </div>
                                        <div>
                                            <p>
                                                <a class="coklat">02.</a>
                                                <a href="#">Ini Tempat Judul yaa</a><br>
                                                <a class="sub">Gatau ini apa ada sub nya</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="activity pb-2">
                                        <div class="activity-icon" style="background-color: #C1C1C1;">
                                        </div>
                                        <div>
                                            <p>
                                                <a class="coklat">03.</a>
                                                <a href="#">Ini Tempat Judul yaa</a><br>
                                                <a class="sub">Gatau ini apa ada sub nya</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    <?php } ?> -->

</div>