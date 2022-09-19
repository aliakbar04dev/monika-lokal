<?= $this->extend('components/template_menu') ?>
<?= $this->section('content_menu') ?>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>

<div id="pricing-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="item">
                    <div class="inner">
                        <div class="top">
                            <div class="title">
                                <br>
                                <br>
                                PAKET ULTIMATE
                                <br>
                                <br>
                            </div>
                            <!-- <div class="label">
                                Non Member
                            </div>
                            <div class="item-price">
                                1,8jt <span>/tahun</span>
                            </div>
                            <div class="item-price">
                                180rb <span>/bulan</span>
                            </div>
                            <div class="label mt-2">
                                Member
                            </div> -->
                            <div class="circle">
                                <div class="circle-inner">
                                    <div class="item-price">
                                        1,8jt <span>/tahun</span>
                                    </div>
                                    <div class="item-price">
                                        180rb <span>/bulan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bot">
                            <br>
                            <!-- <div class="caption">
                                Dapatkan Diskon yang sangat menarik dengan menjadi member komunitas PanenSaham dan anggota koperasi Jasa PanenSaham GRATIS
                            </div> -->
                            <!-- <a data-toggle="modal" data-target="#register" class="register">Register Sekarang</a> -->
                            <!-- <a href="<?php echo site_url('newreg') ?>" class="register">Register Sekarang</a> -->
                            <a href="<?php echo site_url('pembelian') ?>/<?= $kodePaket ?>" class="register">Register Sekarang</a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="description" class="yellow">
                    <h3>DISKRIPSI</h3>
                    <p>Dapatkan Potongan Harga untuk pembayaran Per Tahun hanya bayar 10 bulan. yuk langganan sekarang...</p>

                    <h3 class="mt-4">FITUR</h3>

                    <ul>
                        <li><i class="far fa-circle"></i>10 Chart Realtime</li>
                        <li><i class="far fa-circle"></i>Interval Chart 5 min-Monthly</li>
                        <li><i class="far fa-circle"></i>10 Filter Realtime</li>
                        <li><i class="far fa-circle"></i>3 Alert Realtime</li>
                        <li><i class="far fa-circle"></i>Tabel Sakti EOD</li>
                        <li><i class="far fa-circle"></i>Tabel Bull & Bear EOD</li>
                        <li><i class="far fa-circle"></i>Stock Alert</li>
                        <li><i class="far fa-circle"></i>10 Chart FA Realtime</li>
                        <li><i class="far fa-circle"></i>4 Filter FA</li>
                        <li><i class="far fa-circle"></i>Opini Emiten</li>
                    </ul>

                    <img id="image" src="<?php echo base_url('public/assets/img/pricing/pricing-3.png') ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>