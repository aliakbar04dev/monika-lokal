<?php
    use CodeIgniter\HTTP\UserAgent;
    $this->request = \Config\Services::request();
    $agent = $this->request->getUserAgent();
    $mobile = $agent->isMobile();
?>
<header id="header">
    
    <div class="container d-flex">

        <div class="logo mr-auto d-sm-none" id="menuToggle" style="margin-left:-5%;">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <ul id="menu" class="mb-5" style="margin: -100px 0 0 -93px; height: 1700px;">
                <li>
                    <div class="col-lg-2">
                        <a href="<?= base_url('pricing'); ?>" class="btn btn-warning btn-lg btn-block" style="border-radius:10px; width:100%; background-color: #ffd73a; color:black; border-color:#ffd73a;">
                            <font style="font-family: Poppins; font-size:12px; font-weight:bold;">Berlangganan Tools</font>
                        </a>
                    </div>
                </li>
                <hr>
                <button class="dalem <?= ($title == 'Pengumuman') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('pengumuman'); ?>'">
                    <img width="12%" src="<?= base_url(); ?>/public/assets/img/Group 5926.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Pengumuman</a>
                </button>
                <button class="dalem <?= ($title == 'Profile') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('profile'); ?>'">
                    <img width="12%" src="<?= base_url(); ?>/public/assets/img/Group 5926 (1).svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Profil</a>
                </button>
                <button
                    <?php if($title == 'Daily Stock' || $title == 'Trailling Stop' || $title == 'Watchlist Action' || $title == 'Open Position' || $title == 'Closed Position' || $title == 'Stock Review') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
                    <img width="11%" src="<?= base_url(); ?>/public/assets/img/logo monika secret.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Monika's Secret</a>
                </button>
                <div class="content"
                    <?php if($title == 'Daily Stock' || $title == 'Trailling Stop' || $title == 'Watchlist Action' || $title == 'Open Position' || $title == 'Closed Position' || $title == 'Stock Review') { echo 'style="max-height: 500px;"'; }else{ echo 'style=""' ;} ?>>
                    <button class="dalem"
                        <?php if($title == 'Daily Stock') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('dailyweb') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Daily Stock</a>
                    </button>
                    <button class="dalem"
                        <?php if($title == 'Trailling Stop') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('trailopenweb') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Trailling Stop</a>
                    </button>
                    <button class="dalem"
                        <?php if($title == 'Watchlist Action' || $title == 'Open Position' || $title == 'Closed Position') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('openweb') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Copy Trades</a>
                    </button>
                    <button class="dalem" <?php if($title == 'Stock Review') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?> onclick="window.location.href='<?= site_url('stockreview') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Stock Review</a>
                    </button>
                </div>

                <button
                    <?php if($title == 'Chart Teknikal Analisis' || $title == 'Tabel Teknikal Analisis') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
                    <img width="11%" src="<?= base_url(); ?>/public/assets/img/Assessment.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Analisa Teknikal</a>
                </button>
                <div class="content"
                    <?php if($title == 'Chart Teknikal Analisis' || $title == 'Tabel Teknikal Analisis') { echo 'style="max-height: 117px;"'; }else{ echo 'style=""' ;} ?>>
                    <button class="dalem"
                        <?php if($title == 'Chart Teknikal Analisis') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('chart') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Chart TA</a>
                    </button>
                    <button class="dalem"
                        <?php if($title == 'Tabel Teknikal Analisis') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('tabel') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Filter TA</a>
                    </button>
                </div>
              
                <button
                    <?php if($title == 'Chart Fundamental Analysis' || $title == 'Tabel Fundamental Analysis') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
                    <img width="11%" src="<?= base_url(); ?>/public/assets/img/Assessment1.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Analisa Fundamental</a>
                </button>
                <div class="content"
                    <?php if($title == 'Chart Fundamental Analysis' || $title == 'Tabel Fundamental Analysis') { echo 'style="max-height: 117px;"'; }else{ echo 'style=""' ;} ?>>
                    <button class="dalem"
                        <?php if($title == 'Chart Fundamental Analysis') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('chartfa') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Chart FA</a>
                    </button>
                    <button class="dalem"
                        <?php if($title == 'Tabel Fundamental Analysis') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('tabelfa') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Filter FA</a>
                    </button>
                </div>

                <button
                    <?php if($title == 'News' || $title == 'Informasi Bursa' || $title == 'Bedah Emiten IPO') { echo 'class="collapsible activee"'; }else{ echo 'class="collapsible"' ;} ?>>
                    <img width="11%" src="<?= base_url(); ?>/public/assets/img/book.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">News Update</a>
                </button>
                <div class="content"
                    <?php if($title == 'News' || $title == 'Informasi Bursa' || $title == 'Bedah Emiten IPO') { echo 'style="max-height: 300px;"'; }else{ echo 'style=""' ;} ?>>
                    <button class="dalem"
                        <?php if($title == 'News') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('news') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; News</a>
                    </button>
                    <button class="dalem"
                        <?php if($title == 'Informasi Bursa') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('informasibursa') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Informasi Bursa</a>
                    </button>
                    <button class="dalem"
                        <?php if($title == 'Bedah Emiten IPO') { echo 'style="background-color: #432b3a !important; color:white;"'; }else{ echo 'style=""' ;} ?>
                        onclick="window.location.href='<?= site_url('emitenipo') ?>'">
                        <a class="judulmenu ml-4" style="font-family: Poppins; font-size:12px; font-weight:bold;">&#8226; Bedah Emiten IPO</a>
                    </button>
                </div>

                <button class="dalem <?= ($title == 'Smartwatchlist') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('smartwatchlist'); ?>'">
                <img width="12%" src="<?= base_url(); ?>/public/assets/img/list.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">My Watchlist</a>
                </button>

                <button class="dalem <?= ($title == 'Tutorial') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('tutorial'); ?>'">
                <img width="12%" src="<?= base_url(); ?>/public/assets/img/Subscription.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Tutorial</a>
                </button>

                <button class="dalem <?= ($title == 'Video Edukasi') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('videoedukasi'); ?>'">
                <img width="12%" src="<?= base_url(); ?>/public/assets/img/Subscription.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Video Tutorial</a>
                </button>

                <button class="dalem <?= ($title == 'Tabel Sakti') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('tabelsakti'); ?>'">
                <img width="12%" src="<?= base_url(); ?>/public/assets/img/Backup Table.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Tabel Sakti</a>
                </button>

                <button class="dalem" style="cursor:pointer;" onclick="$crisp.push(['do', 'chat:open']);">
                <img width="12%" src="<?= base_url(); ?>/public/assets/img/message-question.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Hubungi Kami</a>
                </button>
                
                <button class="dalem radiusbawah" onclick="window.location.href='<?= site_url('logout'); ?>'">
                <img width="12%" src="<?= base_url(); ?>/public/assets/img/Logout_Icon_UIA.svg" alt=""> &nbsp;&nbsp;
                    <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold; margin-left:-12%;">Keluar</a>
                </button>
            </ul>
        </div>
        
        
        <div class="logo mr-auto">
            <?php if ($mobile == true): ?>
                <a href="<?= base_url('pricing'); ?>" class="btn btn-warning mt-2 ml-5" style="border-radius:10px; width:90%; background-color: #ffd73a; color:black; border-color:#ffd73a;">
                    <font style="font-size: 12px; font-family: Poppins;">Berlangganan Tools</font>
                </a>
            <?php else: ?>
                <a href="<?= site_url('/'); ?>">
                    <img src="<?= base_url(); ?>/public/assets/img/logo monika new.png" alt="" style="margin-top: 6px;">
                </a>
            <?php endif ?>
        </div>
        <div class="searchbox nav-menu d-none d-lg-block mr-auto float-left">
            <!-- <form method="get">
                <input type="text" placeholder="Search..." id="search" name="search" class="search"><i class="fas fa-search"></i>
            </form> -->
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="get-started pt-2"><a href="<?= base_url('pricing') ?>" style="font-family: 'Poppins'; font-weight:bold;">Berlangganan Tools</a></li>
            </ul>
        </nav>
        <div class="dropdown dropdown-list-toggle pt-1">
            <div class="notifications" style="margin-left:15%;">
                <?php
                    if($lvl != 'MULV001' && $lvl != 'MULV002'){
                ?>
                <div class="icon pt-2 pl-4 pr-2">
                    <?php
                        if ($cnt > 0) {
                            echo '<div id="ntftotal" class="bell">';
                            echo '<p class="no center">' . $cnt . '</p>';
                            echo ' </div>';
                        }
                        
                        ?>
                    <img style="cursor:pointer; width: 30px; margin-top: -50%;" alt="image" src="<?= base_url(); ?>/public/assets/img/bell.png">
                </div>
                <?php
                    }
                ?>

                <div class="notification_dd">
                    <ul class="notification_ul">
                        <!--
                        <li class="notif-header">
                            <p>Notification</p>
                            <div class="right">
                                <a id="" href="#"><i class="fas fa-fw fa-exclamation-circle pl-3 pr-3 kuning"></i></a>
                                <a id="" href="#"><i class="fas fa-fw fa-file-invoice-dollar pl-3 pr-3 abu"></i></a>
                            </div>
                        </li>-->


                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <p class="pl-4 pt-3">Notification</p>
                                <i style="margin-left:155px; margin-top:12px; font-size:20px; cursor:pointer;"
                                    class="menunotif nav-item nav-link active fas fa-fw fa-exclamation-circle pl-3 pr-3 abu"
                                    id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                                    aria-controls="nav-home" aria-selected="true"></i>
                                <i style="margin-top:12px; font-size:20px; cursor:pointer;"
                                    class="menunotif nav-item nav-link fas fa-fw fa-file-invoice-dollar pl-3 pr-3 abu"
                                    id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                                    aria-controls="nav-profile" aria-selected="false"></i>
                            </div>
                        </nav>
                        <div class="ininotif">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <?php
                                    if (count($ntf) < 1) {
                                        echo '<li class="show_all">
											<a class="link pb-2">No notification yet..</a>
										</li>';
                                    }
                                    ?>

                                    <!--
                            <li onclick="location.href='#'" class="starbucks success noread" style="cursor: pointer;">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem, ipsum dolor.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                            </li>
                            <li onclick="location.href='#'" class="starbucks success disabled">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem, ipsum dolor.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                            </li>-->

                                    <?php
                                    foreach ($ntf as $n) {
                                        $read = '';

                                        if ($n['seen'] < 1) {
                                            $read = 'noread';
                                        }
                                    ?>
                                    <li id="<?= $n['id_notif'] ?>" onclick="location.href='#'"
                                        class="success <?= $read ?>" style="cursor: pointer;">
                                        <div class="notify_data">
                                            <!-- <div class="title" style="line-height: normal;">
                                                    <?= $n['tittle'] ?>
                                                </div> -->
                                            <!-- <div class="sub_title" style="line-height: normal;">
                                                    <?= $n['description'] ?>
                                                    <br>
                                                    <?= time_elapsed_string($n['created_at']) ?>
                                                </div> -->
                                            <div class="" style="line-height: normal;">
                                                <?= $n['description'] ?>
                                                <br>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">

                                    <?php
                                    if (count($npy) < 1) {
                                        echo '<li class="show_all">
											<a class="link pb-2">No notification yet..</a>
										</li>';
                                    }
                                    ?>

                                    <?php
                                    foreach ($npy as $n) {
                                        $read = '';

                                        if ($n['seen'] < 1) {
                                            $read = 'noread';
                                        }
                                    ?>
                                    <li id="<?= $n['id_notif'] ?>" onclick="location.href='#'"
                                        class="success <?= $read ?>" style="cursor: pointer;">
                                        <!-- <div class="notify_icon">
                                                <span class="icon"></span>
                                            </div> -->
                                        <div class="notify_data">
                                            <!-- <div class="title" style="line-height: normal;">
                                                    <?= $n['tittle'] ?>
                                                </div> -->
                                            <!-- <div class="sub_title" style="line-height: normal;">
                                                    <?= $n['description'] ?>
                                                    <br>
                                                    <?= time_elapsed_string($n['created_at']) ?>
                                                </div> -->
                                            <div class="" style="line-height: normal;">
                                                <?= $n['description'] ?>
                                                <br>
                                                <?= time_elapsed_string($n['created_at']) ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                        <li class="show_all">
                            <!-- <p class="link">Show All</p> -->
                            <p id="markallread">Mark All Read</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="dropdown pt-1 d-none d-lg-block">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user pb-custom">
                <div class=" d-sm-none d-lg-inline-block" style="font-family: 'Poppins'; font-weight:bold;">Hi, <?= getsession('nama') ?>
                </div>
                <img id="smallprofil" alt="image" width="35px" height="35px"
                    src="<?= (getsession('photo') != '') ? base_url(getsession('photo')) : base_url('/public/assets/img/avatar/avatar-1.png') ?>"
                    class="ml-1 rounded-circle mr-1">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= site_url('profile'); ?>" class="dropdown-item has-icon" style="font-family: 'Poppins'; font-weight:bold;">
                    <img width="11%" src="<?= base_url(); ?>/public/assets/img/Group 5926 (1).svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Profil Saya
                </a>
                <a href="<?= site_url('billing'); ?>" class="dropdown-item has-icon" style="font-family: 'Poppins'; font-weight:bold;">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/wallet-add.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Billing
                </a>
                <a href="<?= site_url('editprofile'); ?>" class="dropdown-item has-icon" style="font-family: 'Poppins'; font-weight:bold;">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/Setting_Icon_UIA.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Pengaturan
                </a>
                <hr>
                <a href="https://helpmonika.panensaham.com" class="dropdown-item has-icon" style="font-family: 'Poppins'; font-weight:bold;">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/bantuanicon.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Bantuan
                </a>
                <a style="cursor:pointer; font-family: 'Poppins'; font-weight:bold;" onclick="$crisp.push(['do', 'chat:open']);" class="dropdown-item has-icon">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/headphone.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Live Support
                </a>
                <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon" style="font-family: 'Poppins'; font-weight:bold;">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/Logout_Icon_UIA.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Keluar
                </a>
            </div>
        </div>
        
        <div class="dropdown pt-1 d-sm-none">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-sm-none pb-custom">
                <img id="smallprofil" alt="image" width="35px" height="35px" src="<?= (getsession('photo') != '') ? base_url(getsession('photo')) : base_url('/public/assets/img/avatar/avatar-1.png') ?>" class="ml-1 rounded-circle" style="margin-top: -3px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= site_url('profile'); ?>" class="dropdown-item has-icon" style="font-family: Poppins; font-weight:bold;">
                    <img width="11%" src="<?= base_url(); ?>/public/assets/img/Group 5926 (1).svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Profil Saya
                </a>
                <a href="<?= site_url('billing'); ?>" class="dropdown-item has-icon" style="font-family: Poppins; font-weight:bold;">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/wallet-add.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Billing
                </a>
                <a href="<?= site_url('editprofile'); ?>" class="dropdown-item has-icon" style="font-family: Poppins; font-weight:bold;">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/Setting_Icon_UIA.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Pengaturan
                </a>
                <hr>
                <a href="https://helpmonika.panensaham.com" class="dropdown-item has-icon" style="font-family: 'Poppins'; font-weight:bold;">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/bantuanicon.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Bantuan
                </a>
                <a style="cursor:pointer; font-family: 'Poppins'; font-weight:bold;" onclick="$crisp.push(['do', 'chat:open']);" class="dropdown-item has-icon">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/headphone.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Live Support
                </a>
                <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon" style="font-family: Poppins; font-weight:bold;">
                    <img width="10%" src="<?= base_url(); ?>/public/assets/img/Logout_Icon_UIA.svg" alt="" style="margin-top:-3px;"> &nbsp;&nbsp; Keluar
                </a>
            </div>
        </div>

    </div>
</header>

<script>
    $(".profile .icon").click(function () {
        $(this).parent().toggleClass("active");
        $(".notifications").removeClass("active");
    });

    $(".notifications .icon").click(function () {
        $(this).parent().toggleClass("active");
        $(".profile").removeClass("active");
    });

    $(".show_all .link").click(function () {
        $(".notifications").removeClass("active");
        $(".popup").show();
    });

    $(".close, .shadow").click(function () {
        $(".popup").hide();
    });

    $(document).ready(

        function () {

            $("html").niceScroll();

        }

    );
</script>