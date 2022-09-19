<?php
    use CodeIgniter\HTTP\UserAgent;
    $this->request = \Config\Services::request();
    $agent = $this->request->getUserAgent();
    $mobile = $agent->isMobile();
?>

<?php if ($mobile == true): ?>

    <!-- footer start -->
    <footer class=" footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget" style="padding-left: 50px;">
                           <table class="table table-bordered" style="border:none;">
                                <tr style="border:none;">
                                   <th style="border:none; height:50px; font-size: 13px; color:#FFF; font-family: 'Poppins'">Monika PanenSaham</th>
                                   <th style="border:none; height:50px; font-size: 13px; color:#FFF; font-family: 'Poppins'">Bantuan & Panduan</th>
                               </tr>
                               <tr style="border:none;">
                                   <td style="border:none; height:50px;"><a href="<?= site_url('aboutus'); ?>" style="font-size: 13px; color:#000; font-family: 'Poppins';">Tentang <b style="font-weight:bold; font-family: 'Poppins'; color:#000;">Monika</b></a></td>
                                   <td style="border:none; height:50px;"><a href="<?= site_url('contactus'); ?>" style="font-size: 13px; color:#000; font-family: 'Poppins';">Kontak Kami</a></td>
                               </tr>
                               <tr style="border:none;">
                                    <td style="border:none; height:50px;"><a href="<?= site_url('policyprivacy'); ?>" style="font-size: 13px; color:#000; font-family: 'Poppins';">Pricing <b style="font-family: 'Poppins'; color:#000;">Monika</b></a></td>
                                    <td style="border:none; height:50px;"><a href="<?= site_url('termsconditionsweb'); ?>" style="font-size: 13px; color:#000; font-family: 'Poppins';">Syarat & Ketentuan</a></td>
                               </tr>
                               <tr style="border:none;">
                                    <td style="border:none; height:50px;"><a href="https://helpmonika.panensaham.com" style="font-size: 13px; color:#000; font-family: 'Poppins';">Bantuan</a></td>
                                    <td style="border:none; height:50px;"><a href="<?= site_url('contactus'); ?>" style="font-size: 13px; color:#000; font-family: 'Poppins';">Kontak</a></td>
                               </tr>
                               <tr style="border:none;">
                                    <td style="border:none; height:50px;"><a href="<?= site_url('career'); ?>" style="font-size: 13px; color:#000; font-family: 'Poppins';">Karir</a></td>
                                    <td style="border:none; height:50px;"><a href="#" style="font-size: 13px; color:#000; font-family: 'Poppins';"> </a></td>
                               </tr>
                               <tr style="border:none;">
                                   <td style="font-size: 13px; height:50px; border:none; font-family: 'Poppins';" colspan="2">support.monika@panensaham.com</td>
                                   <td style="font-size: 13px; height:50px; border:none;"> </td>
                               </tr>
                           </table>
                            <br>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget" style="text-align: center;">
                            <h3 class="footer_title" style="font-family: 'Poppins';">
                                Download Aplikasi Monika
                            </h3>
                                <a href="https://play.google.com/store/apps/details?id=id.monika.monika_panen_saham"><img class="pb-2 app" width="130" alt="image" src="<?= base_url(); ?>/public/assets/img/playstore.png"></a> &nbsp;
                                <a href="https://apps.apple.com/id/app/monika-panensaham/id1559849738?l=id"><img class="pb-2 app" width="130" alt="image" src="<?= base_url(); ?>/public/assets/img/appstore.png"></a>
                            <!-- <table class="table table-bordered" style="border:none;">
                               <tr style="border:none;">
                                   <th style="font-size: 13px; border:none; height:190px;"><a href="https://play.google.com/store/apps/details?id=id.monika.monika_panen_saham"><img class="pb-2 app" width="65%" alt="image" src="<?= base_url(); ?>/public/assets/img/playstore.png"></a></th>
                                   <th style="font-size: 13px; border:none; height:190px;"><a href="https://apps.apple.com/id/app/monika-panensaham/id1559849738?l=id"><img class="pb-2 app" width="65%" alt="image" src="<?= base_url(); ?>/public/assets/img/appstore.png"></a></th>
                               </tr>
                           </table> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text" style="text-align: center;">
            <div class="container pl-3 pr-3">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <img class="pb-2 mw-100" alt="image" src="<?= base_url(); ?>/public/assets/img/logo pembayaran.svg">
                    </div>
                    <div class="col-xl-4">
                        <p class="copy_right" style="font-size:11px; font-weight:bold;">
                            &copy; Copyright
                            MONIKA Panensaham
                            <script>
                                document.write(new Date().getFullYear());
                            </script>.
                            All Right Reserved. Owned by PT. Carmel Anugerah Cemerlang
                        </p>
                    </div>                  
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->

<?php else: ?>

    <!-- footer start -->
    <footer class="footer">
        <div class="footer_top pl-3 pr-3" style="padding-top: 8%;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 wow fadeInLeft" data-wow-delay="0.2s" style="text-align: left;">
                        <div class="footer_widget">
                            <h3 class="footer_title" style="font-family: 'Poppins';">
                                Monika PanenSaham
                            </h3>
                            <ul style="margin-top: -25px;">
                                <li><a href="<?= site_url('aboutus'); ?>" style="font-family: 'Poppins';">Tentang <b style="font-family: 'Poppins'; color:#000;">Monika</b></a></li>
                                <li><a href="#" style="font-family: 'Poppins';">Fitur <b style="font-family: 'Poppins'; color:#000;">Monika</b></a></li>
                                <li><a href="https://monika.panensaham.com/pricing/paket-ta" style="font-family: 'Poppins';">Pricing</a></li>
                                <li><a href="https://helpmonika.panensaham.com" style="font-family: 'Poppins';">Bantuan</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 wow fadeInLeft" style="text-align: left;">
                        <div class="footer_widget">
                            <h3 class="footer_title" style="font-family: 'Poppins';">
                                Bantuan & Panduan
                            </h3>
                            <ul style="margin-top: -25px;">
                                <li><a href="<?= site_url('contactus'); ?>" style="font-family: 'Poppins';">Kontak Kami</a></li>
                                <li><a href="<?= site_url('termsconditionsweb'); ?>" style="font-family: 'Poppins';">Syarat & Ketentuan</a></li>
                                <li><a href="<?= site_url('policyprivacy'); ?>" style="font-family: 'Poppins';">Kebijakan Privasi</a></li>
                                <li><a href="<?= site_url('career'); ?>" style="font-family: 'Poppins';">Karir</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="footer_widget">
                            <h3 class="footer_title" style="font-family: 'Poppins'; text-align:center;">
                                Subscribe to Our Newsletter
                            </h3>
                            <ul style="margin-top: -25px; text-align:center;">
                                <li><a style="font-family: 'Poppins'; text-align:center;" onmouseover="hoveritemteks()" id="hoveritem">Jadilah orang pertama yang mendapatkan berita, event, dan semua promo terbaru dari kami. Berlangganan sekarang!</a></li> <br>
                                <li>
                                    <div class="container" style="font-family: 'Poppins';">
                                        <div class="text-center">
                                            <div class="footer_widget">
                                                <?= form_open('subscribeprocess', ['class' => 'formSubscribe']); ?>
                                                    <?= csrf_field(); ?>
                                                    <div class="newsletter_form col-xl-12" style="font-family: 'Poppins';">
                                                        <input type="text" placeholder="Masukkan alamat Email anda" id="input_subscribe" name="input_subscribe" style="font-family: 'Poppins';">
                                                        <button type="submit" class="btn_subscribe" style="font-family: 'Poppins'; font-weight:bold; background-color:#FFD737; padding-top:-1px; padding-bottom:-5px; padding-left:10px; padding-right:10px; font-size:14px;">Subscribe</button>
                                                        <div class="invalid-feedback bg-secondary error_subscribe_footer"></div>
                                                    </div>
                                                <?= form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <br>
                            <h3 class="footer_title" style="font-family: 'Poppins'; text-align:center;">
                                Download Aplikasi Monika
                            </h3>
                            <ul style="margin-top:-25px; text-align:center;">
                                <a href="https://play.google.com/store/apps/details?id=id.monika.monika_panen_saham"><img class="pb-2 app" width="65%" alt="image" src="<?= base_url(); ?>/public/assets/img/playstore.png"></a>
                                <a href="https://apps.apple.com/id/app/monika-panensaham/id1559849738?l=id"><img class="pb-2 app" width="65%" alt="image" src="<?= base_url(); ?>/public/assets/img/appstore.png"></a>
                            </ul>

                        </div>
                    </div>
                </div>               

                <br>
                <br>
                <br>

                <div class="text-center wow fadeInUp">
                    <h5 class="footer_title" style="font-family: 'Poppins'; font-weight:bold;">
                        Pembayaran Melalui: <img class="ml-3" alt="image" src="<?= base_url(); ?>/public/assets/img/landing/payments.png">
                    </h5>
                </div>

                <hr>

                <div class="text-center wow fadeInUp" data-wow-delay="0.2s" style="margin-bottom: -9%;">
                    <h5 class="footer_title" style="font-family: 'Poppins'; font-weight:bold;">
                        &copy; Copyright MONIKA Panensaham
                        <script>
                            document.write(new Date().getFullYear());
                        </script>.
                        All Right Reserved. Owned by PT. Carmel Anugerah Cemerlang
                    </h5>
                </div>

            </div>
        </div>


    </footer>
    <!--/ footer end  -->

<?php endif ?>