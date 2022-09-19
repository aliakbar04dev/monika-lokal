<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>


<main class="main" id="main">
    <div id="maindetailvideotutorial">
        <section id="about" class="about">
            <div class="container" style="margin-top: -2%;">
                <ol class="breadcrumb" style="background-color: #fff; margin-left:-18px;">
                    <li class="breadcrumb-item"><a href="<?= base_url('video') ?>" style="font-weight: bold; color:#000; font-size:14px;">Video Tutorial</a></li>
                    <li class="breadcrumb-item"><a href="#" style="font-weight: bold; color:#000; font-size:14px;">Kategori</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="font-weight: bold; color:#EAA402; font-size:14px;"><?= $jdl['judul_filter'] ?></li>
                </ol>
                <div class="row pb-5" style="margin-top: -1%;">
                    <div class="col-md-7">
                        <h3 style="font-size:23px;"><?= $jdl['judul'] ?></h3>
                        <h5 style="font-size:14px;"><?= $jdl['keterangan_submedia'] ?></h5>
                        <br>
                        <iframe class="video-detail" id="vidframe" src="" style="border: none;" allow="accelerometer; gyroscope; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe>
                    </div>
                    <div class="col-md-5">
                        <div class="card-list">
                            <a href="#" class="kun nextVid ml-2">Next Video</a>
                            <div style="height: 530px !important; max-height: calc(570px); overflow-y: scroll;">
                                <?php
                                $no = 0;

                                foreach ($detail as $v) :
                                    $active = '';

                                    if ($no == 0) {
                                        $active = 'active';
                                    }
                                ?>
                                    <div class="listvid <?= $active ?>" linkvid=<?= $v['link_media'] ?> style="margin-top: 5%;">
                                        <table style="width: 100%;">
                                            <tr height="40px" style="<?= $v['kode_media'] == $segment3 ? 'background-color: #FFD73A;' : ' ' ?>" onclick="window.location='<?= site_url('videodetail/'.'/'.$v['kode_media']) ?>'" style="cursor: pointer;">
                                                <td style="width: 9%; text-align: left; border-top-left-radius:5px; border-bottom-left-radius:5px; font-weight:bold; font-size:11px; color:black;"> &nbsp; <a href="<?= site_url('videodetail/'.'/'.$v['kode_media']) ?>"><img style="" width="70%" src="<?php echo base_url('public/assets/img/playvid.svg') ?>"></a></i></td>
                                                <td style="width: 70%; text-align: left; font-weight:bold; font-size:12px; color:black;"><font style="color: #000; font-weight:bold;"><?= strtoupper($v['judul']) ?></font></td>
                                                <td style="width: 20%;text-align: left; border-top-right-radius:5px; border-bottom-right-radius:5px; font-weight:bold; font-size:12px; color:black;"><font style="color: #000; font-weight:bold;">10:42</font></td>
                                            </tr>
                                        </table>
                                    </div>
                                <?php
                                    $no++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <h5 class="pb-3" style="text-align: center; font-size:18px; font-weight:bold; margin-top:-30px;">Deskripsi</h5>
                        <div class="bcn pb-5" style="font-weight: bold;">
                            <?= $jdl['deskripsi'] ?>
                        </div>
                        <!-- <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div href="#" class="arrows">
                                        <table class="pl-2" style="margin-left:55px;">
                                            <tr>
                                                <td>
                                                    <div class="mt-2 ml-2 black" style="text-align: right; font-weight:bold;">
                                                        <a>Previous</a>
                                                        <br>
                                                        <a>ICHIMOKU</a>
                                                    </div>
                                                </td>
                                                <td><img style="width:100px; margin-top:11px; margin-left:9px;" src="<?php echo base_url('public/assets/img/thumb.png') ?>"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div href="#" class="arrow">
                                        <table class="pl-2">
                                            <tr>
                                                <td><img style="width:100px; margin-top:11px;" src="<?php echo base_url('public/assets/img/thumb.png') ?>"></td>
                                                <td>
                                                    <div class="mt-2 ml-2 black">
                                                        <a>Next</a>
                                                        <br>
                                                        <a>BOLLINGER BAND</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-md-5">
                        <h5 style="font-size: 14px;">Populer <a class="hotp" style="font-weight:bold;">HOT</a></h5>
                        <div class="col-md-12 pb-3" style="margin-left: -3%;">
                            <div class="row">
                                <?php foreach ($populers as $populer): ?>
                                    <div class="col-md-6">
                                        <a href="<?= site_url('videodetail/'.'/'.$populer['kode_media']) ?>"><img style="width:100%;" src="<?= $populer['thumbnails_video'] ?>" class="mb-3"></a>
                                        <a href="<?= site_url('videodetail/'.'/'.$populer['kode_media']) ?>" class="jud" style="font-size:14px; font-weight:bold;"><?= strtoupper($populer['judul']) ?></a><br>
                                        <a href="<?= site_url('videodetail/'.'/'.$populer['kode_media']) ?>" style="font-size:12px; font-weight:bold;">
                                            <?= $populer['keterangan_submedia'] ?> 
                                            <br> 
                                            <!-- <font style="font-weight: bold; color:#000;">04:11</font> -->
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <br>
                        <h5 style="font-size: 14px;">Terbaru <a class="newp" style="font-weight:bold;">NEW</a></h5>
                        <div class="col-md-12" style="margin-left: -3%;">
                            <div class="row">
                                <?php foreach ($terbarus as $terbaru): ?>
                                    <div class="col-md-6">
                                        <a href="<?= site_url('videodetail/'.'/'.$terbaru['kode_media']) ?>"><img style="width:100%;" src="<?= $terbaru['thumbnails_video'] ?>" class="mb-3"></a>
                                        <a href="<?= site_url('videodetail/'.'/'.$terbaru['kode_media']) ?>" class="jud" style="font-size:14px; font-weight:bold;"><?= strtoupper($terbaru['judul']) ?></a><br>
                                        <a href="<?= site_url('videodetail/'.'/'.$terbaru['kode_media']) ?>" style="font-size:12px; font-weight:bold;">
                                            <?= $terbaru['keterangan_submedia'] ?> 
                                            <br> 
                                            <!-- <font style="font-weight: bold; color:#000;">04:11</font> -->
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about" class="about videobawah">
            <div class="container">
                <div class="langgan d-none d-lg-block offset-xl-4">
                    <div class="col-lg-12">
                        <center>
                            <div class="crm">
                                <h5 class="rombeng">BERLANGGANAN SEKARANG</h5>
                            </div>
                            <a>Untuk Akses semua materi</a>
                        </center>
                        <div class="row mt-2">
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>100+ Video Edukasi</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Berita Pasar Modal Terbaru</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Live Trading Bareng</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Sharing 24/7 Setiap Hari</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Laporan Kinerja Emiten</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Analisa Market 24jam</strong></a></div>
                        </div>
                    </div>
                </div>
                <div class="langga d-block d-lg-none">
                    <div class="col-md-12">
                        <center>
                            <div class="crm">
                                <h5 class="rombeng">BERLANGGANAN SEKARANG</h5>
                            </div>
                            <a>Untuk Akses semua materi</a>
                        </center>
                        <div class="row mt-2">
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>100+ Video Edukasi</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Berita Pasar Modal Terbaru</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Live Trading Bareng</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Sharing 24/7 Setiap Hari</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Laporan Kinerja Emiten</strong></a></div>
                            <div class="col-md-6"><a><img style="width:30px;" class="card-img-top" src="<?php echo base_url('public/assets/img/ck.png') ?>"><strong>Analisa Market 24jam</strong></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="modalvideobelumbisadiakses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="<?= base_url('video') ?>" class="btn-sm" style="width:auto; background-color: rgba(255, 0, 0, 0.8);  padding:10px; margin-top:-11px;">
                            <font style="color:#fff;">Back</font>
                        </a>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <a href="<?= base_url('pricing') ?>"><img width="90%" src="<?= base_url() ?>/public/assets/img/membership button.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    $(document).ready(function() {

        var nice = $(".scrollbar").niceScroll(); // The document page (body)

        if ($('.listvid.active').length) {
            var src = $('.listvid.active').attr('linkvid');

            $('#vidframe').attr('src', src);

            console.log('data : ' + src);
        }

        $(document).on('click', '.listvid', function() {
            var ini = $(this);
            var src = ini.attr('linkvid');

            $('.listvid.active').removeClass('active');

            ini.addClass('active');
            $('#vidframe').attr('src', src);

        });

        $(document).on('click', '.nextVid', function() {
            if ($('.listvid.active').next('div.listvid').length) {
                var ini = $('.listvid.active').next('div.listvid');
                var src = ini.attr('linkvid');

                $('.listvid.active').removeClass('active');

                ini.addClass('active');
                $('#vidframe').attr('src', src);
            } else {
                var ini = $(".listvid:first");
                var src = ini.attr('linkvid');

                $('.listvid.active').removeClass('active');

                ini.addClass('active');
                $('#vidframe').attr('src', src);
            }
        });

        // $('#maindetailvideotutorial').on('load',function(){
        //     $('#modalvideobelumbisadiakses').modal('show');
        // });
    });
</script>

<?= $this->endSection(); ?>