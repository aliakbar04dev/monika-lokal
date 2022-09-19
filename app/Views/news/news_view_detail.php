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
                                        <a style="font-weight: bold; color:#DD9B00;" href="<?= base_url('news') ?>">News</a>
                                        <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                        <a  href="<?= base_url('informasibursa') ?>">Informasi Bursa</a>
                                        <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                        <a href="<?= base_url('emitenipo') ?>">Bedah Emiten IPO & Special Report</a>
                                    </h6>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>

                            <hr color="black" size="10" class="mt-1 mb-4">

                            <div class="mb-3">
                                <h3 style="color: #412817;"> <?= $news['judul'] ?> </h3>
                                <?php
                                    function tanggal_indo($tanggal, $cetak_hari = false){
                                        $hari = array ( 1 =>    'Senin',
                                                    'Selasa',
                                                    'Rabu',
                                                    'Kamis',
                                                    'Jumat',
                                                    'Sabtu',
                                                    'Minggu'
                                                );
                                                
                                        $bulan = array (1 =>   'Januari',
                                                    'Februari',
                                                    'Maret',
                                                    'April',
                                                    'Mei',
                                                    'Juni',
                                                    'Juli',
                                                    'Agustus',
                                                    'September',
                                                    'Oktober',
                                                    'November',
                                                    'Desember'
                                                );
                                        $split 	  = explode('-', $tanggal);
                                        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                                        
                                        if ($cetak_hari) {
                                            $num = date('N', strtotime($tanggal));
                                            return $hari[$num] . ', ' . $tgl_indo;
                                        }
                                        return $tgl_indo;
                                    }
                                ?>
                                <h6 style="font-size: 15px; color:#000;">
                                    <a><?= tanggal_indo(date('Y-m-d', strtotime($news['tgl_pengumuman'])), true) ?> &nbsp; <?= date("H:i", strtotime($news['tgl_pengumuman'])) ?> WIB</a>
                                </h6>
                            </div>

                            <!-- <div class="mt-4 mb-4" style="text-align: center; overflow: hidden; padding: 0;">
                                <img style="max-height: 400px;"  alt="image" src="<?= base_url().'/backend/public/assets/img/news_cms/'.$news['cover'] ?>">
                            </div>

                            <div class="mt-4 mb-4" style="text-align: justify; text-justify: inter-word;">
                                <?= $news['isi_pengumuman'] ?>
                            </div> -->

                            <div class="mt-4 mb-4">
                                <?= $news['isi_pengumuman'] ?>
                            </div>

                            <div class="mt-4 mb-4" style="text-align: center;">
                                <h6>Share This News</h6>
                                <img alt="image" src="<?= base_url(); ?>/public/assets/img/wa1.svg" style="width: 30px;"> &nbsp;
                                <img alt="image" src="<?= base_url(); ?>/public/assets/img/fb1.svg" style="width: 30px;"> &nbsp;
                                <img alt="image" src="<?= base_url(); ?>/public/assets/img/ig1.svg" style="width: 30px;"> &nbsp;
                                <img alt="image" src="<?= base_url(); ?>/public/assets/img/tw1.svg" style="width: 30px;">
                            </div>

                            <hr color="black" size="10" class="mt-4 mb-4">

                            <div class="mt-2 mb-4" style="text-align: center;">
                                <h6>Berita lainnya</h6>
                            </div>
                            <div class="row">
                                <?php foreach ($ipos as $ipo): ?>
                                    <div class="col-lg-6 pb-3 list-item" style="">
                                        <div class="pb-3 pt-3 pl-5 pr-5" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 8px 12px 0 rgb(0 0 0 / 20%); border: 1px solid #dcdcdc;">
                                            <div class="mb-3" style="text-align: left; overflow: hidden; padding: 0;">
                                                <img style="max-height: 110px;" alt="image" src="<?= base_url().'/backend/public/assets/img/news_cms/'.$ipo['cover'] ?>">
                                            </div>
                                            <h5 class="coklat" style="color: #000; font-size: 13px;"> <?= substr($ipo['judul'], 0, 45) ?> ... </h5>
                                            <a style="margin-bottom: 80px; font-size: 13px;"><?= date("d-m-Y H:i", strtotime($ipo['tgl_pengumuman'])) ?></a> <br>
                                            <a href="<?= base_url().'/newsdetail/'.$ipo['kode_pengumuman'] ?>"><b style="color: #000;  font-size: 13px; margin-right:50%;">Read More</b></a> &nbsp;&nbsp;&nbsp;

                                            <?php if ($ipo['status'] == 'NEW'): ?>
                                                <img style="width: 70px; margin-top:-20px" alt="image" src="<?= base_url(); ?>/public/assets/img/new.svg">
                                            <?php elseif ($ipo['status'] == 'HOT') : ?>
                                                <img style="width: 70px; margin-top:-20px" alt="image" src="<?= base_url(); ?>/public/assets/img/hot.svg">
                                            <?php else: ?>
                                                
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

