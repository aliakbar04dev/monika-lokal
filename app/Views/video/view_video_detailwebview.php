<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .page-item .page-link {
            background-color: #fff;
            border-color: #888888;
            color: #888888;
            padding-left: 17px;
            padding-right: 17px;
            font-family: Poppins;
            font-weight: bold;
            font-size: 16px;
        }

        .page-item.active .page-link {
            background-color: #FBDC8E;
            border-color: #DD9B00;
            color: #DD9B00;
            padding-left: 17px;
            padding-right: 17px;
            font-family: Poppins;
            font-weight: bold;
            font-size: 16px;
        }

        .hotp {
            font-size: 8px !important;
            color: #fff !important;
            background-color: red;
            padding: 3px 3px 3px 3px;
            border-bottom-left-radius: 5px;
            border-top-right-radius: 5px;
            margin-top: -20%;
        }

        .newp {
            font-size: 8px !important;
            color: #fff !important;
            background-color: #61B210;
            padding: 3px 3px 3px 3px;
            border-bottom-left-radius: 5px;
            border-top-right-radius: 5px;
            margin-top: -20%;
        }
        .sentuhanoren:hover {
            background-color: #FFD73A;
        }
    </style>
</head>

<body style="font-family: 'Poppins'; font-weight:bold;">
    <div class="container pt-5 pb-5">
        <form method="GET" action="<?= base_url('videoedukasimonikaps'.'/'.$kodeuserlevel) ?>" class="form-group">
            <div class="row">
                <div class="col-6">
                    <h4 class="mt-2 font-weight-bold" style="color: #432A19;">Detail Video</h4>
                </div>
                <div class="col-6 text-right">
                    <a href="<?= base_url('videoedukasimonikaps'.'/'.$kodeuserlevel) ?>" class="btn btn-warning font-weight-bold">Kembali Ke Semua Video</a>
                </div>
            </div>
        </form>
        <hr style="border:1px solid #C4C4C4; margin-bottom:3%;">
        <iframe src="<?= $jdl['link_media'] ?>" style="border: none;" allowfullscreen="true" width="100%"
            height="600"></iframe>
        <h3 class="font-weight-bold mt-3"><?= $jdl['judul'] ?></h3>
        <h5 class="font-weight-bold"><?= $jdl['keterangan_submedia'] ?></h5>
        <h5 class="font-weight-bold mt-3 mb-5"><?= $jdl['deskripsi'] ?></h5>
        <h3 class="font-weight-bold mt-3 mb-3"> List Video Kategori <?= $jdl['keterangan_submedia'] ?></h3>
        <div>
            <!-- <img style="width:100%;" src="<?= $jdl['thumbnails_video'] ?>" class="mb-3"> -->
            <div class="card-list">
                <div style="height: 450px !important; max-height: calc(570px); overflow-y: scroll;">
                    <?php
                    $no = 0;

                    foreach ($detail as $v) :
                        $active = '';

                        if ($no == 0) {
                            $active = 'active';
                        }
                    ?>
                        <div class="listvid <?= $active ?>" linkvid=<?= $v['link_media'] ?>>
                            <table style="width: 100%;">
                                <thead>
                                        <?php if ($kodeuserlevel == 'MULV002'): ?>
                                            <?php if ($v['is_berbayar'] == 1): ?>
                                                <tr class="sentuhanoren" height="90px" style="<?= $v['kode_media'] == $segment3 ? 'background-color: #FFD73A;' : ' ' ?> cursor: pointer;"data-toggle="modal" data-target="#modalVideoBerbayar" data-backdrop="static" data-keyboard="false">
                                            <?php else: ?>
                                                <tr class="sentuhanoren" height="90px" style="<?= $v['kode_media'] == $segment3 ? 'background-color: #FFD73A;' : ' ' ?> cursor: pointer;" onclick="window.location='<?= site_url('videodetailwebview/'.'/'.$v['kode_media'].'/'.$kodeuserlevel) ?>'">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <tr class="sentuhanoren" height="90px" style="<?= $v['kode_media'] == $segment3 ? 'background-color: #FFD73A;' : ' ' ?> cursor: pointer;" onclick="window.location='<?= site_url('videodetailwebview/'.'/'.$v['kode_media'].'/'.$kodeuserlevel) ?>'">
                                        <?php endif; ?> 

                                        <td style="width: 9%; text-align: left; font-weight:bold; color:black; cursor: pointer; vertical-align:middle;">
                                            &nbsp;
                                            <?php if ($kodeuserlevel == 'MULV002'): ?>
                                                <?php if ($v['is_berbayar'] === '1'): ?>
                                                    <a data-toggle="modal" data-target="#modalVideoBerbayar" data-backdrop="static" data-keyboard="false">
                                                        <img width="70%" src="<?php echo base_url('public/assets/img/gembok.svg') ?>">
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= site_url('videodetailwebview/'.'/'.$v['kode_media'].'/'.$kodeuserlevel) ?>">
                                                        <img width="70%" src="<?php echo base_url('public/assets/img/playvid.svg') ?>">
                                                    </a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a href="<?= site_url('videodetailwebview/'.'/'.$v['kode_media']) ?>">
                                                    <img width="70%" src="<?php echo base_url('public/assets/img/playvid.svg') ?>">
                                                </a>
                                            <?php endif; ?> 
                                        </td>
                                        <td style="width: 70%; text-align: left; font-weight:bold; color:black; vertical-align:middle;"><font style="color: #000; font-weight:bold;"><?= strtoupper($v['judul']) ?></font></td>
                                        <td style="width: 20%;text-align: left; font-weight:bold; color:black; vertical-align:middle;">
                                            <font style="color: #000; font-weight:bold;">
                                                <?php
                                                    $min =  intval($v['link_api'] / 60);
                                                    $convertDurasi = $min . ' : ' . str_pad(($v['link_api'] % 60), 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <?= $convertDurasi?>
                                            </font> 
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php
                        $no++;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div id="modalVideoBerbayar" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;">
                        <img width="90%" src="<?= base_url() ?>/public/assets/img/membership button.svg" alt="" class="mt-3">
                        <br><br>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function () {

            var nice = $(".scrollbar").niceScroll(); // The document page (body)

            if ($('.listvid.active').length) {
                var src = $('.listvid.active').attr('linkvid');

                $('#vidframe').attr('src', src);

                console.log('data : ' + src);
            }

            $(document).on('click', '.listvid', function () {
                var ini = $(this);
                var src = ini.attr('linkvid');

                $('.listvid.active').removeClass('active');

                ini.addClass('active');
                $('#vidframe').attr('src', src);

            });

            $(document).on('click', '.nextVid', function () {
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
</body>

</html>