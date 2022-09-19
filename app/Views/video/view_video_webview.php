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
    </style>
</head>

<body style="font-family: 'Poppins'; font-weight:bold;">
    <div class="container pt-5 pb-5">
        <form method="GET" action="<?= base_url('videoedukasimonikaps'.'/'.$kodeuserlevel) ?>" class="form-group">
            <div class="row">
                <div class="col-4">
                    <h6 class="font-weight-bold" style="color: #432A19;">Kategori Video</h6>
                </div>
                <div class="col-8">
                    <div class="input-group">
                        <input type="text" class="form-control" name="carivideowebview" placeholder="" required
                            style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset; border-color:#DD9B00;">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit"
                                style="border-bottom-right-radius: 10px; border-top-right-radius: 10px; background-color: #fff; border-color:#DD9B00; font-family: Poppins; font-weight:bold; box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;"><i
                                    class="fa fa-search" aria-hidden="true" style="color: #C4C4C4;"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr style="border:1px solid #C4C4C4;">

        <?php if ($inputCariVideowebview): ?>
            <h4 class="font-weight-bold mb-3">Hasil Pencarian Kategori :</h4>
            <div class="row">
                <?php if ($hasilCariVideowebview): ?>
                    <?php foreach ($hasilCariVideowebview as $hasil) : ?>
                        <div class="col-6 mb-3">
                            <div class="card">
                                <a href="<?= site_url('videodetailwebview/'.'/'.$hasil['kode_media'].'/'.$kodeuserlevel) ?>"><img
                                        src="<?= $hasil['thumbnails_video'] ?>" class="card-img-top" alt="..."></a>
                                <div class="card-body" style="background-color: #D19200; color:#fff;">
                                    <?php if (strlen($hasil['keterangan_submedia']) >= 35): ?>
                                    <h6 style="font-weight: bold; font-size:12px;">
                                        <?= substr( $hasil['keterangan_submedia'], 0, 35) ?> ...</h6>
                                    <?php else: ?>
                                    <h6 style="font-weight: bold; font-size:12px;"><?= $hasil['keterangan_submedia'] ?></h6>
                                    <?php endif; ?>

                                    <?php if (strlen($hasil['desc_submedia']) >= 128): ?>
                                    <p class="card-text" style="font-size:12px; text-align:justify;">
                                        <?= substr( $hasil['desc_submedia'], 0, 128) ?> ...</p>
                                    <?php else: ?>
                                    <p class="card-text" style="font-size:12px; text-align:justify;"><?= $hasil['desc_submedia'] ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 mt-5">
                            <a href="<?= base_url('videoedukasimonikaps'.'/'.$kodeuserlevel) ?>"
                                class="btn btn-danger btn-lg btn-block">
                                <h4 class="text-center font-weight-bold mt-1">Kembali Ke Semua Video</h4>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 mb-3 mt-3">
                        <div class="alert alert-danger" role="alert">
                            <h4>Hasil Pencarian Tidak Ditemukan!</h4>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?= $pager->Links() ?>
        <?php else: ?>
            <div class="row">
                <?php foreach ($dataWebviewAll as $wva) : ?>
                <div class="col-12 mb-3">
                    <div class="card">

                        <a href="<?= site_url('videodetailwebview/'.'/'.$wva['kode_media'].'/'.$kodeuserlevel) ?>"><img
                                src="<?= $wva['thumbnails_video'] ?>" class="card-img-top" alt="..."></a>
                        <div class="card-body" style="background-color: #D19200;">
                            <h4 style="font-weight: bold; font-size:16px; color:#fff;"><?= $wva['keterangan_submedia'] ?></h4>

                            <?php if (strlen($wva['desc_submedia']) >= 128): ?>
                                <p style="font-size:14px; text-align:left; color:#55341d;"><?= substr( $wva['desc_submedia'], 0, 128) ?> ...
                                </p>
                            <?php else: ?>
                                <p style="font-size:14px; text-align:left; color:#55341d;"><?= $wva['desc_submedia'] ?></p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?= $pager->Links() ?>
        <?php endif ?>


        <hr style="border:1px solid #C4C4C4;">
        <div class="col-md-12 pb-3">
            <h4 class="font-weight-bold">POPULER <a class="hotp" style="font-weight:bold;">HOT</a></h4>
            <div class="row">
                <?php foreach ($populers as $populer): ?>
                <div class="col-md-6">
                    <a href="<?= site_url('videodetailwebview/'.'/'.$populer['kode_media'].'/'.$kodeuserlevel) ?>"><img
                            style="width:100%;" src="<?= $populer['thumbnails_video'] ?>" class="mb-3"></a>
                    <a href="<?= site_url('videodetailwebview/'.'/'.$populer['kode_media'].'/'.$kodeuserlevel) ?>"
                        class="jud"
                        style="font-size:17px; font-weight:bold; color:#000;"><?= $populer['judul'] ?></a><br>
                    <a href="<?= site_url('videodetailwebview/'.'/'.$populer['kode_media'].'/'.$kodeuserlevel) ?>"
                        style="font-size:14px; font-weight:bold; color:#000;">
                        <?= $populer['keterangan_submedia'] ?>
                        <br>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <h4 class="font-weight-bold">TERBARU <a class="newp" style="font-weight:bold;">NEW</a></h4>
            <div class="row">
                <?php foreach ($terbarus as $terbaru): ?>
                <div class="col-md-6">
                    <a href="<?= site_url('videodetail/'.'/'.$terbaru['kode_media'].'/'.$kodeuserlevel) ?>"><img
                            style="width:100%;" src="<?= $terbaru['thumbnails_video'] ?>" class="mb-3"></a>
                    <a href="<?= site_url('videodetail/'.'/'.$terbaru['kode_media'].'/'.$kodeuserlevel) ?>" class="jud"
                        style="font-size:17px; font-weight:bold; color:#000;"><?= $terbaru['judul'] ?></a><br>
                    <a href="<?= site_url('videodetail/'.'/'.$terbaru['kode_media'].'/'.$kodeuserlevel) ?>"
                        style="font-size:14px; font-weight:bold; color:#000;">
                        <?= $terbaru['keterangan_submedia'] ?>
                    </a>
                </div>
                <?php endforeach; ?>
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
</body>

</html>