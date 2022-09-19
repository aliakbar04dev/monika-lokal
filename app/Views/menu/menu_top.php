<div class="container-fluid ">
    <div class="header_bottom_border">
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-2">
                <div class="logo">
                    <a href="<?= site_url('/'); ?>">
                        <img width="75%" src="<?= base_url(); ?>/public/assets/img/logo monika new.png" alt="" style="margin-bottom: -10px;">

                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <div class="web main-menu d-none d-lg-block">
                    <nav>
                        <ul id="navigation">
                            <li><a style="font-family: 'Poppins'; font-weight:bold;" class="nav-new <?= ($title == 'Home') ? 'active' : '' ?>" href="<?= site_url('/'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;home&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            </li>
                            <li><a style="font-family: 'Poppins'; font-weight:bold;" class="nav-new <?= ($title == 'About Us') ? 'active' : '' ?>" href="<?= site_url('/aboutus'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;Tentang MONIKA&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            </li>
                            <li>
                                <a style="font-family: 'Poppins'; font-weight:bold;" id="menu-price" class="nav-new <?= ($title == 'Pricing') ? 'active' : '' ?>" href="#">&nbsp;&nbsp;Harga&nbsp;&nbsp;</a>
                                <!-- <a class="nav-new <?= ($title == 'Pricing') ? 'active' : '' ?>" href="<?= site_url('/pricing'); ?>">&nbsp;&nbsp;Pricing&nbsp;&nbsp;</a> -->

                            </li>
                            <!-- <li><a class="nav-new" href="#">&nbsp;Featured&nbsp;&nbsp;</a></li> -->
                            <li><a style="font-family: 'Poppins'; font-weight:bold;" class="nav-new <?= ($title == 'Contact Us') ? 'active' : '' ?>" href="<?= site_url('/contactus'); ?>">&nbsp;&nbsp;&nbsp;Kontak Kami&nbsp;&nbsp;&nbsp;</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                <div class="Appointment">
                    <div class="d-none d-lg-block">
                        <!-- <a class="boxed-btnlogin" data-toggle="modal" data-target="#login">Masuk</a> -->
                        <a class="boxed-btnlogin mr-2" style="font-family: 'Poppins'; font-weight:bold; border-color:#55341d;" href="<?= base_url('/newlogin'); ?>">Masuk</a>
                    </div>
                    <div class="d-none d-lg-block pr-2">
                        <!-- <a class="boxed-btnsignup" data-toggle="modal" data-target="#register">Sign
                            Up</a> -->
                        <a class="boxed-btnsignup" style="font-family: 'Poppins'; font-weight:bold;" href="<?= base_url('/newreg'); ?>">Daftar</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-block d-lg-none">
                    <!--ini menu mobile-->
                    <nav id="navbar1" class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #fff;">
                        <div class="container">
                            <img width="45%" src="<?= base_url(); ?>/public/assets/img/logo monika new.png" alt="">


                            <button style="border:none;" class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span style="border: none; color:#FFD737;">
                                    <i class="fa fa-bars fa-1x"></i></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                                <ul class="nav navbar-nav ml-auto">
                                    <li class="nav-item"><a class="nav-link ml-4 mt-3" id="active1" href="<?= site_url('/'); ?>" style="font-family: 'Poppins'; font-size:14px;">Home</a></li>
                                    <li class="nav-item"><a class="nav-link ml-4" id="active2" href="<?= site_url('/aboutus'); ?>" style="font-family: 'Poppins'; font-size:14px;">Tentang Monika</a></li>
                                    <li class="nav-item"><a class="nav-link ml-4" id="active3" href="#" style="font-size:14px;">Harga</a></li>
                                    <li class="nav-item"><a class="nav-link ml-4" href="<?= site_url('/pricing/paket-ta'); ?>" style="font-family: 'Poppins';"><img alt="logo" src="<?= base_url(); ?>/public/assets/img/tamob1.svg" width="90%"></a></li>
                                    <li class="nav-item"><a class="nav-link ml-4" href="<?= site_url('/pricing/paket-fa'); ?>" style="font-family: 'Poppins';"><img alt="logo" src="<?= base_url(); ?>/public/assets/img/tamob2.svg" width="90%"></a></li>
                                    <li class="nav-item"><a class="nav-link ml-4" href="<?= site_url('/pricing/ultimate'); ?>" style="font-family: 'Poppins';"><img alt="logo" src="<?= base_url(); ?>/public/assets/img/tamob3.svg" width="90%"></a></li>
                                    <!-- <li class="nav-item"><a class="nav-link ml-4" id="active3" href="#">Featured</a></li> -->
                                    <li class="nav-item"><a class="nav-link ml-4 mt-3" id="active3" href="<?= site_url('/contactus'); ?>" style="font-family: 'Poppins'; font-size:14px;">Kontak Kami</a></li>

                                </ul>
                                <div class="pt-3 pb-3 float-center" style="margin-bottom: 100%;">
                                    <!-- <a class="boxed-btnsignup" data-toggle="modal" data-target="#register">Sign Up</a> -->
                                    <a class="btn btn-warning" href="<?= base_url('/newreg'); ?>" style="background-color:#D19200; border-color:#946700;font-family: 'Poppins'; font-weight:bold; padding-left:30px; padding-right:30px; font-size:14px; color:#fff; margin-left:30px;">Daftar</a>
                                    <!-- <a class="boxed-btnloginin" data-toggle="modal" data-target="#login">Masuk</a> -->
                                    <a class="btn btn-light" href="<?= base_url('/newlogin'); ?>" style="background-color:#fff; border-color:#D19200;font-family: 'Poppins'; font-weight:bold; padding-left:30px; padding-right:30px; font-size:14px; color:#D19200;">Masuk</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="nav-pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <a href="<?= site_url('/pricing/paket-ta'); ?>">
                    <img alt="logo" src="<?= base_url(); ?>/public/assets/img/pakettamerah.svg">
                </a>
            </div>
            <div class="col-lg-4">
                <a href="<?= site_url('/pricing/paket-fa'); ?>">
                    <img alt="logo" src="<?= base_url(); ?>/public/assets/img/paketfabiru.svg">
                </a>
            </div>
            <div class="col-lg-4">
                <a href="<?= site_url('/pricing/paket-ultimate'); ?>">
                    <img alt="logo" src="<?= base_url(); ?>/public/assets/img/paketultimateemas.svg">
                </a>
            </div>
        </div>
    </div>
</div>