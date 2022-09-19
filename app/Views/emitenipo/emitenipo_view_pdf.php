<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<style>
    .page-item .page-link {
        background-color: #fff;
        border-color: #fff;
        color: #888888;
        padding-left: 17px;
        padding-right: 17px;
        
    }
    .page-item.active .page-link {
        background-color: #FBDC8E;
        border-color: #FBDC8E;
        color: #DD9B00;
        padding-left: 17px;
        padding-right: 17px;
        
    }
</style>

<main class="body" id="main">
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>

                <div class="col-lg-9">
                    <div class="mb-3" style="background-color: #eeeeee;">
                        <div class="header">
                            <h3 class="mb-4">News Update</h3>
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 style="font-size: 13px; color:#000;">
                                        <a>Stock & Market Update</a>
                                        <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                        <a href="<?= base_url('news') ?>">News</a>
                                        <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                        <a  href="<?= base_url('informasibursa') ?>">Informasi Bursa</a>
                                        <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                        <a href="<?= base_url('emitenipo') ?>" style="font-weight: bold; color:#DD9B00;">Bedah Emiten IPO & Special Report</a>
                                    </h6>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>

                            <hr color="black" size="10" class="mt-1 mb-4">

                            <div class="mt-4 mb-4" style="text-align: center; overflow: hidden; padding: 0;">
                                <iframe src="<?= base_url().'/backend/public/assets/img/bursaemiten/'.$news['berkas'] ?>#toolbar=0" width="90%" height="500px" frameBorder="0"></iframe>
                            </div>

                            <hr color="black" size="10" class="mt-4 mb-4">

                            <div class="mt-2 mb-4" style="text-align: center;">
                                <h6 style="font-family: Poppins;">Berita lainnya</h6>
                            </div>
                            <div class="row">
                                <?php foreach ($ipos as $ipo): ?>
                                    <div class="col-lg-6 pb-3 list-item" style="">
                                        <div class="pb-3 pt-3 pl-5 pr-3" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 8px 12px 0 rgb(0 0 0 / 20%); border: 1px solid #dcdcdc;">
                                            <h5 class="coklat" style="color: #000; font-size: 13px;"> 
                                                <?php if (strlen($ipo['judul']) < 50 ): ?>
                                                    <?= substr($ipo['judul'], 0, 50) ?>
                                                <?php elseif (strlen($ipo['judul']) >= 50 ): ?>
                                                    <?= substr($ipo['judul'], 0, 50) ?> ... 
                                                <?php else: ?>
                                                    error
                                                <?php endif; ?>
                                            </h5>
                                            <a style="margin-bottom: 80px; font-size: 13px;"><?= date("d-m-Y H:i", strtotime($ipo['tgl_pengumuman'])) ?></a> <br>
                                            <!-- <a href="<?= base_url().'/emitenipodetail/'.$ipo['kode_pengumuman'] ?>"><b style="color: #000;  font-size: 13px;">Read More</b></a> &nbsp;&nbsp;&nbsp; -->
                                            <a href="<?= base_url().'/emitenipopdf/'.$ipo['kode_pengumuman'] ?>"><b style="color: #000;  font-size: 13px; margin-right:65%;">View</b></a>

                                            <?php if ($ipo['status'] == 'NEW'): ?>
                                                <img style="width: 70px;" alt="image" src="<?= base_url(); ?>/public/assets/img/new.svg">
                                            <?php elseif ($ipo['status'] == 'HOT') : ?>
                                                <img style="width: 70px;" alt="image" src="<?= base_url(); ?>/public/assets/img/hot.svg">
                                            <?php else: ?>
                                                Error
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <?= $pager->links('group1','default_full') ?>

                            </div>

                            <hr color="black" size="10" class="mt-4 mb-5">

                            <div class="text-center">
                                <img alt="image" src="<?= base_url(); ?>/public/assets/img/langgananmonikaskrg.svg">
                            </div>

                            <div class="container">
                                <div class="row justify-content-lg-center mt-5">
                                    <div class="col-lg-3" style="margin-top:7%; text-align:center;">
                                        <div class="item">
                                            <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #E5E5E5, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT002') ?>'">
                                                <div class="top">
                                                    <div class="title">
                                                        <br>
                                                        <h4 style="color: #412817; font-size:20px;">Paket TA</h4>
                                                        <h4 style="color: #EBA502; font-size:25px;">Rp 90.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                        <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4>
                                                        <h4 style="color: #412817; font-size:20px; font-weight:bold;">Rp. 900.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                        <img alt="image" src="<?= base_url(); ?>/public/assets/img/diskon17.svg" style="width: 90px;">
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3" style="text-align:center;">
                                        <div class="item">
                                            <div style="background-color:#412817; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px; padding-right:2%; padding-left:2%;" onclick="location.href='<?= site_url('pembelian/HPKT004') ?>'">
                                                <br>
                                                <h3 style="color: #FBDC8E;">Best Offer</h3>
                                                <div class="item">
                                                    <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #EBA502, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT004') ?>'">
                                                        <div class="top">
                                                            <div class="title">
                                                                <br>
                                                                <h4 style="color: #412817; font-size:20px;">Ultimate</h4>
                                                                <h4 style="color: #FFFFFF; font-size:25px;">Rp 180.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                                <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4>
                                                                <h4 style="color: #412817; font-size:20px; font-weight:bold;">Rp. 1.800.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                                <img alt="image" src="<?= base_url(); ?>/public/assets/img/diskon17.svg" style="width: 90px;">
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3" style="margin-top:7%; text-align:center;">
                                        <div class="item">
                                            <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #E5E5E5, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT003') ?>'">
                                                <div class="top">
                                                    <div class="title">
                                                        <br>
                                                        <h4 style="color: #412817; font-size:20px;">Paket FA</h4>
                                                        <h4 style="color: #EBA502; font-size:25px;">Rp 90.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                        <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4>
                                                        <h4 style="color: #412817; font-size:20px; font-weight:bold;">Rp. 900.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                        <img alt="image" src="<?= base_url(); ?>/public/assets/img/diskon17.svg" style="width: 90px;">
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>

<?= $this->endSection(); ?>

