<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<style>
    .sentuhanoren:hover {background-color: #FFD73A;}
</style>


<main class="main" id="main">
    <div id="maindetailvideotutorial">

    
        <section id="about" class="about">
            <div class="container" style="margin-top: -2%;">
                <ol class="breadcrumb" style="background-color: #fff; margin-left:-18px;">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('videoweb') ?>" style="font-weight: bold; color:#000; font-size:14px;">Video Tutorial &nbsp; > &nbsp;</a>
                        <a style="font-weight: bold; color:#D19200; font-size:14px;"><?= $jdl['judul_filter'] ?></a></li>
                </ol>
                <div class="row pb-5" style="margin-top: -1%;">
                    <div class="col-md-7">
                        <div class="container pt-3 mb-4" style="background-image: linear-gradient(to left, rgba(255,0,0,0), #FBDC8E); border-color:#D19200; border-style: solid; border-radius:10px;">
                            <div class="col">
                                <p style="color:#000; font-size:18px; font-weight:bold;">
                                    <font style="color:#000; font-size:18px; margin-right:65%;"><?= $jdl['judul_filter'] ?>
                                    </font> <img style="" width="3%" src="<?php echo base_url('public/assets/img/playvid.svg') ?>"> <font style="color:#000; font-size:12px; margin-right:1%;"><?= $countDetailVideo ?> Video</font>
                                    <br>
                                    <font style="color:#000; font-size:15px;"><?= $jdl['keterangan_submedia'] ?></font>
                                </p>
                            </div>
                        </div>
                        <div class="container pt-3 mb-4">
                            <div class="col">
                                <p style="color:#000; font-size:14px;">
                                <?= $jdl['desc_submedia'] ?>
                                </p>
                            </div>
                            <div class="col text-center">
                                <a href="<?= base_url('pricing') ?>"><img class="mt-3" width="80%" src="<?php echo base_url('public/assets/img/joinmember.svg') ?>"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img style="width:100%;" src="<?= $jdl['thumbnails_video'] ?>" class="mb-3">
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
                                            <?php if ($lvl == 'MULV002'): ?>
                                                <?php if ($v['is_berbayar'] == 1): ?>
                                                    <tr class="sentuhanoren" height="40px" style="<?= $v['kode_media'] == $segment3 ? 'background-color: #FFD73A;' : ' ' ?> cursor: pointer;"  data-toggle="modal" data-target="#modalVideoBerbayar" data-backdrop="static" data-keyboard="false">
                                                <?php else: ?>
                                                    <tr class="sentuhanoren" height="40px" style="<?= $v['kode_media'] == $segment3 ? 'background-color: #FFD73A;' : ' ' ?> cursor: pointer;" onclick="window.location='<?= site_url('videoonplay/'.'/'.$v['kode_media']) ?>'">
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <tr class="sentuhanoren" height="40px" style="<?= $v['kode_media'] == $segment3 ? 'background-color: #FFD73A;' : ' ' ?> cursor: pointer;" onclick="window.location='<?= site_url('videoonplay/'.'/'.$v['kode_media']) ?>'">
                                            <?php endif; ?> 

                                                <td style="width: 9%; text-align: left; border-top-left-radius:5px; border-bottom-left-radius:5px; font-weight:bold; font-size:11px; color:black; cursor: pointer;">
                                                    &nbsp;
                                                    <?php if ($lvl == 'MULV002'): ?>
                                                        <?php if ($v['is_berbayar'] == 1): ?>
                                                            <a data-toggle="modal" data-target="#modalVideoBerbayar" data-backdrop="static" data-keyboard="false">
                                                                <img width="70%" src="<?php echo base_url('public/assets/img/gembok.svg') ?>">
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="<?= site_url('videoonplay/'.'/'.$v['kode_media']) ?>">
                                                                <img width="70%" src="<?php echo base_url('public/assets/img/playvid.svg') ?>">
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <a href="<?= site_url('videoonplay/'.'/'.$v['kode_media']) ?>">
                                                            <img width="70%" src="<?php echo base_url('public/assets/img/playvid.svg') ?>">
                                                        </a>
                                                    <?php endif; ?> 
                                                </td>
                                                <td style="width: 70%; text-align: left; font-weight:bold; font-size:12px; color:black;"><font style="color: #000; font-weight:bold;"><?= strtoupper($v['judul']) ?></font></td>
                                                <td style="width: 20%;text-align: left; border-top-right-radius:5px; border-bottom-right-radius:5px; font-weight:bold; font-size:12px; color:black;">
                                                    <font style="color: #000; font-weight:bold;">
                                                        <?php
                                                            $min =  intval($v['link_api'] / 60);
                                                            $convertDurasi = $min . ' : ' . str_pad(($v['link_api'] % 60), 2, '0', STR_PAD_LEFT);
                                                        ?>
                                                        <?= $convertDurasi?>
                                                    </font> 
                                                </td>
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
            </div>
        </section>

       
        <div id="modalVideoBerbayar" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;">
                        <a href="<?= base_url('pricing') ?>"><img width="90%" src="<?= base_url() ?>/public/assets/img/membership button.svg" alt="" class="mt-3"></a>
                        <br><br>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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



    });
</script>


<?= $this->endSection(); ?>