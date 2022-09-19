<img src="<?= base_url() ?>/public/assets/img/pricing/head-pricing.png" style="" width="100%" height="100%">
<div class="popular_catagory_pricing" style="background-color: #eee;">
    <div class="container  pl-3 pr-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="tittle">
                    Pilih Paket Asisten PanenSaham-mu
                </div>
            </div>

        </div>
        <div class="row pb-5">
            <?php
            if (isset($paket)) {

                foreach ($paket as $p) {

            ?>
                    <div class="columns 
                        <?php
                        if (strtolower($p['title']) == 'basic') {
                            echo 'pt-5 mt-5';
                        }
                        if (strtolower($p['title']) == 'ultimate') {
                            echo 'pt-5';
                        }
                        if (strtolower($p['title']) == 'paket fa') {
                            echo 'pt-5 mt-5';
                        }
                        ?>
                    ">
                        <ul class="price">
                            <li class="<?= (strtolower($p['title']) == 'ultimate') ? 'cok' : 'head' ?>">
                                <h2 style="color:<?= (strtolower($p['title']) == 'ultimate') ? '#fff' : '#683B1E' ?>!important; font-weight: 700;" class="pt-5"><?= strtoupper($p['title']) ?></h2>
                                <center>
                                    <?php
                                    if (strtolower($p['title']) == 'basic') {
                                        echo '<div class="mt-4 mb-4" id="circle-a">
													<p class="pt-4" style="font-size:25px;">FREE <br> TRIAL</p>
												</div>';
                                    } else if (strtolower($p['title']) == 'ultimate') {
                                        if ($p['is_ready'] == 1) {
                                            echo '<div class="mt-4 mb-4" id="circle-cok">
														<p class="pt-3">
															<br>
															' . formatkilo($p['harga_paket']) . '<br>
															<span>/ bulan</span>
														</p>
													</div>';
                                        } else {
                                            echo '<div class="mt-4 mb-4" id="circle-cok">
														<p class="pt-4 mt-2">
															COMING SOON
														</p>
													</div>';
                                        }
                                    } else {
                                        if ($p['is_ready'] == 1) {
                                            echo '<div class="mt-4 mb-4" id="circle-ta">
														<p class="pt-3">
															<br>
															' . formatkilo($p['harga_paket']) . '<br>
															<span>/ bulan</span>
														</p>
													</div>';
                                        } else {
                                            echo '<div class="mt-4 mb-4" id="circle-ta">
														<p class="pt-4 mt-2">
															COMING SOON
														</p>
													</div>';
                                        }
                                    }
                                    ?>
                                </center>
                                <p <?= (strtolower($p['title']) == 'ultimate') ? 'style="color:#fff!important;"' : '' ?> class="pb-3"><?= $p['description'] ?></p>
                            </li>
                            <li class="<?= (strtolower($p['title']) == 'ultimate') ? 'lat' : 'or' ?>">
                                <?= $p['feature'] ?>
                            </li>
                            <li class="<?= (strtolower($p['title']) == 'ultimate' || $usrlvl == $p['kode_user_level']) ? 'kil' : 'foot' ?>">
                                <?php
                                if ($usrlvl == $p['kode_user_level']) {
                                    echo '<center>
											<div class="" id="circle-cok">
												<p class="pt-2 mt-2">
													PAKET ANDA SAAT INI
												</p>

											</div>
										</center>';
                                } else {
                                    if ($p['is_ready']){
                                        $rankusr    = (int)substr($usrlvl, -1);
                                        $rankpkt    = (int)substr($p['kode_user_level'], -1);

                                        if($rankusr > $rankpkt){
                                            if (strtolower($p['title']) == 'ultimate') {
                                                echo '<a href="#" class="btn boxed-asik disabled">TIDAK TERSEDIA</a>';
                                            } elseif ( $rankusr == 5) {
                                                echo '<a href="#" class="btn boxed-abu disabled">TIDAK TERSEDIA</a>';
                                            } elseif (strtolower($p['title']) == 'paket ta') {
                                                echo '<a href="' . base_url('cart/' . $p['kode_harga_paket']) . '" class="boxed-basic">LANGGANAN SEKARANG</a>';
                                                // echo '<a href="#" class="btn boxed-abu disabled">TIDAK TERSEDIA</a>';
                                            } else {
                                                echo '<a href="#" class="btn boxed-abu disabled">TIDAK TERSEDIA</a>';
                                            }
                                        }else{
                                            if(strtolower($p['title']) == 'basic'){
                                                echo '<a href="#" class="btn boxed-abu disabled">TIDAK TERSEDIA</a>';
                                            }else{
                                                echo '<a href="' . base_url('cart/' . $p['kode_harga_paket']) . '" class="boxed-basic">LANGGANAN SEKARANG</a>';
                                            }
                                        }
                                    }else{
                                        if (strtolower($p['title']) == 'ultimate') {
                                            echo '<a href="#" class="btn boxed-asik disabled">TIDAK TERSEDIA</a>';
                                        } else {
                                            echo '<a href="#" class="btn boxed-abu disabled">TIDAK TERSEDIA</a>';
                                        }
                                    }
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
            <?php

                }
            }
            ?>
            <!--
            <div class="columns pt-5 mt-5">
                <ul class="price">
                    <li class="head">
                        <h2 style="color:#683B1E!important; font-weight: 700;" class="pt-5">BASIC</h2>
                        <center>
                            <div class="mt-4 mb-4" id="circle-a">
                                <p class="pt-3">FREE TRIAL</p>
                            </div>
                        </center>

                        <p class="pb-3">Refer friend and get up to $30</p>
                    </li>
                    <li class="or">
                        <div>
                            <p>Untuk para investor dan trader yang ingin mengenal dan melihat fitur-fiture yang ada di tools ini</p>
                            <p style="font-size: 15px; font-weight: bold; text-align: center;">Fitur-fitur yang didapat</p>
                            <div class="left ml-2">
                                <p>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> 1 chart Daily<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> 1 Filter EOD<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Tabel sakti EOD<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Tabel Bull & Bear EOD<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Venn Diagram EOD
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="kil">
                        <center>
                            <div class="" id="circle-cok">
                                <p class="pt-2 mt-2">
                                    PAKET ANDA SAAT INI
                                </p>

                            </div>
                        </center>
                    </li>
                </ul>
            </div>
            <div class="columns">
                <ul class="price">
                    <li class="head">
                        <h2 style="color:#683B1E!important; font-weight: 700;" class="pt-5">PAKET TA</h2>

                        <center>
                            <div class="mt-4 mb-4" id="circle-ta">
                                <p class="pt-3">
                                    <span style="color: #BD4244!important; letter-spacing: -1px; font-size: 15px; text-decoration: line-through #BD4244;">IDR 120.000</span><br>
                                    IDR60K<br>
                                    <span>/ bulan</span>
                                </p>
                            </div>
                        </center>

                        <p class="pb-3">Dapatkan Diskon 50% dengan menjadi member komunitas PanenSaham dan anggota
                            koperasi Jasa PanenSaham GRATIS</p>
                    </li>
                    <li class="or">
                        <div>
                            <p>Investasi dan Trading tanpa gangguan, full akses ke semua fitur-fitur yang kami sediakan untuk anda dengan chart, interval, indikator dan alert yang sangat lengkap untuk anda</p>
                            <p style="font-size: 15px; font-weight: bold; text-align: center;">Fitur-fitur yang didapat</p>
                            <div class="left ml-2">
                                <p>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> 12 Chart Realtime<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Interval Chart 5 min-Mon<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> 10 Filter Realtime<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> 3 Alert Realtime<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Tabel Sakti EOD<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Tabel Bull & Bear EOD<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Venn Diagram EOD<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Whatchlist Alert
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="foot"><a href="#" class="boxed-basic">LANGGANAN SEKARANG</a></li>
                </ul>
            </div>
            <div class="columns pt-5 mt-5">
                <ul class="price">
                    <li class="head">
                        <h2 style="color:#683B1E!important; font-weight: 700;" class="pt-5">PAKET FA</h2>
                        <center>
                            <div class="mt-4 mb-4" id="circle-ta">
                                <p class="pt-4 mt-2">
                                    COMING SOON
                                </p>
                            </div>
                        </center>

                        <p class="pb-3">Untuk menjadi member komunitas PanenSaham dan anggota koperasi jasa PanenSaham GRATIS</p>
                    </li>
                    <li class="or">
                        <div>
                            <p>Dengan tambahan diskon yang membuat anda sangat tertarik dan pasti anda akan sangat puas mendapatkanya</p>
                            <p style="font-size: 15px; font-weight: bold; text-align: center;">Fitur-fitur yang didapat</p>
                            <div class="left ml-2">
                                <p>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> 4 Chart<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> 5 Filter<br>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="foot"><a href="#" class=" btn boxed-abu disabled">COMING SOON</a></li>
                </ul>
            </div>
            <div class="columns pt-5">
                <ul class="price">
                    <li class="cok">
                        <h2 style="color:#fff!important; font-weight: 700;" class="pt-5">ULTIMATE</h2>
                        <center>
                            <div class="mt-4 mb-4" id="circle-cok">
                                <p class="pt-4 mt-2">
                                    COMING SOON
                                </p>

                            </div>
                        </center>

                        <p style="color:#fff!important;" class="pb-3">Dengan tambahan diskon yang membuat anda sangat tertarik dan pasti anda akan sangat puas mendapatkanya</p>
                    </li>
                    <li class="lat">
                        <div>
                            <p style="color: #fff!important;">Dengan tambahan diskon yang membuat anda sangat tertarik dan pasti anda akan sangat puas mendapatkanya</p>
                            <p style="font-size: 15px; font-weight: bold; text-align: center; color: #fff!important;">Fitur-fitur yang didapat</p>
                            <div class="left ml-2">
                                <p style="color: #fff!important;">
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Chart untuk 5 saham pilihan<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Chart Alert<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Tabel Sakti<br>
                                    <i class="far fa-circle" style="color:#E8A303;"></i> Beberapa video Pengenalan<br>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="kil"><a href="#" class="btn boxed-asik disabled">COMING SOON</a></li>
                </ul>
            </div>-->
        </div>
    </div>
</div>