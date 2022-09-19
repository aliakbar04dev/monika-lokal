<!-- popular_catagory_area_start  -->
<div class="popular_catagory_area">
    <div class="container  pl-3 pr-3">
        <div class="row">
            <div class="col-lg-12 pt-5">
                <div class="tittle">
                    Pilih Paket Bot Tools
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if (isset($paket)) {
                $dur = 1;
                $del = 0.3;

                foreach ($paket as $p) {
                    $class = (strtolower($p['title']) == 'ultimate') ? 'ulti' : ((strtolower($p['title']) == 'basic') ? 'basic' : 'ta');
                    $circle = (strtolower($p['title']) == 'ultimate') ? 'circle-cok' : ((strtolower($p['title']) == 'basic') ? 'circle-basic' : 'circle-ta"');
            ?>
                    <div class="wow fadeInUp col-lg-4 col-xl-3 col-md-6 pt-4  mt-3" data-wow-duration="<?= $dur ?>" data-wow-delay="<?= $del ?>">
                        <div class="<?= $class ?>">
                            <h2><?= strtoupper($p['title']) ?></h2>
                            <center>
                                <div class="mt-4 mb-4" id="<?= $circle ?>">
                                    <?php
                                    if (strtolower($p['title']) == 'basic') {
                                        echo '<p style="margin-top: 0px;">FREE TRIAL</p>';
                                    } else if (strtolower($p['title']) == 'ultimate') {
                                        if ($p['is_ready'] == 1) {
                                            echo '<br><p>
												' . formatkilo($p['harga_paket']) . '
												<br>
											</p>
											<span>/ bulan</span>';
                                        } else {
                                            echo '<p class="pt-3">
													COMING
												</p>
												<p class="pt-3" style="margin-top: -10px;">
													SOON
												</p>';
                                        }
                                    } else {
                                        if ($p['is_ready'] == 1) {
                                            echo '<br><p>
												' . formatkilo($p['harga_paket']) . '
												<br>
											</p>
											<span>/ bulan</span>';
                                        } else {
                                            echo '<p class="pt-3">
													COMING
												</p>
												<p class="pt-3" style="margin-top: -10px;">
													SOON
												</p>';
                                        }
                                    }
                                    ?>
                                </div>
                            </center>
                            <p class="pb-3"><?= $p['description'] ?></p>
                            <a data-toggle="modal" data-target="#register" class="boxed-basic">Register Sekarang</a>
                        </div>
                    </div>
            <?php
                    $dur += 0.1;
                    $del += 0.1;
                }
            }
            ?>
            <!--
            <div class="wow fadeInUp col-lg-4 col-xl-3 col-md-6 pt-4  mt-3" data-wow-duration="1s" data-wow-delay=".3s">
                <div class="basic">
                    <h2>BASIC</h2>

                    <center>
                        <div class="mt-4 mb-4" id="circle-basic">
                            <p style="margin-top: 0px;">FREE TRIAL</p>
                        </div>
                    </center>

                    <p class="pb-3">Refer friend and get up to $30</p>

                    <a href="#" class="boxed-basic">Register Sekarang</a>

                </div>
            </div>
            <div class="wow fadeInUp col-lg-4 col-xl-3 col-md-6 mt-2" data-wow-duration="1.1s" data-wow-delay=".4s">
                <div class="ta">
                    <h2>PAKET TA</h2>

                    <center>
                        <div class="mt-4 mb-4" id="circle-ta">

                            <p>
                                <a style="color: #BD4244!important; letter-spacing: -1px; font-size: 15px; text-decoration: line-through #BD4244;">IDR 120.000</a>
                                IDR60K<br>
                            </p>
                            <span>/ bulan</span>

                        </div>
                    </center>

                    <p class="pb-3">Diskon Khusus Untuk Angota Komunitas <br> dan Koperasi Jasa PanenSaham</p>

                    <a href="#" class="boxed-basic">Langganan Sekarang</a>
                </div>
            </div>
            <div class="wow fadeInUp col-lg-4 col-xl-3 col-md-6 mt-2" data-wow-duration="1.2s" data-wow-delay=".5s">
                <div class="ta">
                    <h2>PAKET FA</h2>

                    <center>
                        <div class="mt-4 mb-4" id="circle-ta">
                            <p class="pt-3">
                                COMING
                            </p>
                            <p class="pt-3" style="margin-top: -10px;">
                                SOON
                            </p>

                        </div>
                    </center>

                    <p class="pb-3">Untuk menjadi member komunitas PanenSaham dan anggota koperasi Jasa PanenSaham GRATIS</p>

                    <a href="#" class="btn boxed-basic disabled">COMING SOON</a>
                </div>
            </div>
            <div class="wow fadeInUp col-lg-4 col-xl-3 col-md-6 mt-2" data-wow-duration="1.3s" data-wow-delay=".6s">
                <div class="ulti">
                    <h2>ULTIMATE</h2>

                    <center>
                        <div class="mt-4 mb-4" id="circle-cok">
                            <p class="pt-3">
                                COMING
                            </p>
                            <p class="pt-3" style="margin-top: -10px;">
                                SOON
                            </p>
                        </div>
                    </center>

                    <p class="pb-3">Dengan Tambahan diskon yang membuat anda sangat tertarik dan pasti akan sangat puas</p>

                    <a href="#" class="btn boxed-asik disabled">COMING SOON </a>
                </div>
            </div>-->
        </div>
        <div class="row">
            <div class="col-lg-12 pb-4">
                <div class="bawah">
                    Belum bergabung menjadi member komunitas PanenSaham ? <br> Klik disini untuk mendaftar
                </div>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-lg-12 pb-5 mb-5">
                <a class="boxed-daftar" href="#" data-target="#register" data-toggle="modal">Daftar Akun</a>
            </div>
        </div>

    </div>
</div>