<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>


<style>
     .page-item .page-link {
        background-color: #fff;
        border-color: #fff;
        color: #888888;
        padding-left: 17px;
        padding-right: 17px;
        font-family: Poppins;
    }

    .page-item.active .page-link {
        background-color: #FBDC8E;
        border-color: #FBDC8E;
        color: #DD9B00;
        padding-left: 17px;
        padding-right: 17px;
        font-family: Poppins;
    }

    .page-item .page-link {
        color: #612D11;
        border-radius: 3px;
        margin: 0 3px;
    }

    .text-primary-ali {
        color: #145eab;
        font-weight: bold;
    }

    .text-success-ali {
        color: #0ec92d;
        font-weight: bold;
    }

    .text-danger-ali {
        color: #ec1c24;
        font-weight: bold;
    }

    .cke_top {
        display: none !important
    }

    .page-item:first-child .page-link {
        font-family: Poppins;
    }

    .page-link {
        font-family: Poppins;
    }

    span {
        font-family: Poppins;
    }

    .badge {
        background-color: #D30000;
        vertical-align: middle;
        padding: 7px 12px;
        font-weight: bold;
        letter-spacing: 0.3px;
        border-radius: 5px;
        font-size: 9px;
    }

    tr:nth-child(even).hoverali  {
        background-color: #f2f2f2;
    }

    tr td span.badge-danger { 
        display:none;
    }

    tr:hover td span.badge-danger { 
        display:inline-block;
    }

    .btn-light, .btn-light.disabled {
        box-shadow: none;
        background-color: #fff;
        border-color: #fff;
        height: 35  px;
    }

    .input-group-text, select.form-control:not([size]):not([multiple]), .form-control:not(.form-control-sm):not(.form-control-lg) {
        font-size: 13px;
        padding: 1px 15px;
        height: 29px;
        border-radius: 5px;
        border-color: #730C0C;
    }

    .text {
        background-color: white;
        width: 410px;
        height: 10px;
        border-radius: 5px;
        color: black;
        font-size: 11px;
        padding: 10px;
        cursor: pointer;
    }
</style>



<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>
                <div class="col-12 col-sm-12 col-lg-9">
                    <div class="card">
                        <div id="demoo" class="carousel slide" data-ride="carousel" data-interval="2000">

                            <!-- Indicators -->
                            <ul class="carousel-indicators" style="z-index:8;">
                                <?php
                                $isactive = 0;
                                foreach ($banner as $b) :
                                ?>
                                <li data-target="#demo" data-slide-to="<?= $isactive ?>"
                                    class="<?= ($isactive == 0) ? "active" : "" ?>"></li>
                                <?php
                                    $isactive++;
                                endforeach;
                                ?>
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner pb-4 mb-4">
                                <?php
                                $isactive = 0;
                                foreach ($banner as $b) :
                                    $isactive++;
                                ?>
                                <div style="cursor:pointer;" onclick="window.location='<?= $b['link_banner']; ?>';"
                                    class="carousel-item <?= ($isactive == 1) ? "active" : "" ?>">
                                    <img width="100%" src="<?= $b['gambar_banner']; ?>">
                                </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                        <div class="card-body" style="margin-top: -90px;">
                            <section>
                                    <div class="col-lg-12">
                                        <div class="table-responsive" style="border-radius:5px;">
                                            <table class="table table-striped" style="border-radius:5px;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="7" style="text-align: center; font-family: Poppins; font-weight:bold; background-color:#730C0C; color:#fff; font-size:20px; border-radius:5px;">
                                                            <a href="<?= site_url('smartwatchlist') ?>" style="font-weight:bold; color:#fff; font-size:20px;">SMART WATCHLIST</a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <?php if (!empty(session()->getFlashdata('message'))) : ?>
                                        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('message'); ?>"></div>
                                        <?php if(session()->getFlashdata('message')) : ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                        <div class="flash-data-error" data-flashdataerror="<?= session()->getFlashdata('error'); ?>"></div>
                                        <?php if(session()->getFlashdata('error')) : ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                

                                <?php if ($lvl === 'MULV001' || $lvl === 'MULV005'): ?>
                                    <?php if (empty($dataResult)): ?>
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table style="width: 100%;">
                                                    <thead>
                                                        <tr height="25px">
                                                            <td style="width: 10%; text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000;"></td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Code</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Interval</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">System</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Price</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Trailing Stop</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Resisten</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Prev Status</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000;">Now Status</td>
                                                        </tr>
                                                        <tr height="60px" class="hoverali">
                                                            <td colspan="9" style="text-align: center; font-family: Poppins; font-weight:bold; font-size:11px; color:#000; background-color:#E3E3E3; padding-top:20px; padding-bottom:20px;">
                                                                Anda belum memiliki watchlist. Buat watchlist anda <a href="<?= base_url('smartwatchlist') ?>" style="color: #D19200; font-weight:bold;"> disini</a> 
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table style="width: 100%;">
                                                    <thead>
                                                        <tr height="25px">
                                                            <td style="width: 10%; text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000;"></td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Code</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Interval</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">System</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Price</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Trailing Stop</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Resisten</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Prev Status</td>
                                                            <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000;">Now Status</td>
                                                        </tr>

                                                        <?php  foreach($dataResult as $result) : ?>
                                                            <tr height="60px" class="hoverali">
                                                                <td style=" text-align: center; font-family: Poppins; font-weight:bold; font-size:11px;"><a href="<?= site_url('/deletesmartwatchlistberanda/'.$result['id']) ?>" onclick="return ActionMessage(1, this, event)" data-msg="Ingin hapus data ini ?"><span class="badge badge-danger" style="background-color: #D30000;">Hapus</span></a></td>
                                                                <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:11px; color:#000;"><?= $result['code'] ?></td>
                                                                <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:11px; color:#000;"><?= $result['timeframe'] ?></td>
                                                                <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:11px; color:#000;">Cah</td>
                                                                <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:12px; color:#000;">
                                                                <?php if ( $result['chg'] == 0.00  ) : ?>
                                                                    <b style="font-weight:bold; font-size:12px; color:#000;"><?= $result['close'] ?></b>
                                                                    <br>
                                                                    <b style="font-weight:bold; font-size:10px; color:#000;"><?= $result['chg'] ?> %</b>
                                                                <?php elseif ($result['chg'] > 0.00): ?>
                                                                    <b style="font-weight:bold; font-size:12px; color:#61B210;"><?= $result['close'] ?></b>
                                                                    <br>
                                                                    <b style="font-weight:bold; font-size:10px; color:#61B210;"><?= $result['chg'] ?> %</b>
                                                                <?php elseif ($result['chg'] < 0.00): ?>
                                                                    <b style="font-weight:bold; font-size:12px; color:#E50000;"><?= $result['close'] ?></b>
                                                                    <br>
                                                                    <b style="font-weight:bold; font-size:10px; color:#E50000;"><?= $result['chg'] ?> %</b>
                                                                <?php else : ?>
                                                                    Error
                                                                <?php endif; ?>
                                                                </td>
                                                                <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:12px; color:#000;">
                                                                    <?= $result['dsl'] ?>
                                                                    <br>
                                                                    <?php
                                                                        $ts = ($result['dsl']-$result['close'])/$result['close']*100;
                                                                        $re = ($result['pivot_r2']-$result['close'])/$result['close']*100;
                                                                    ?>
                                                                    <?php if ( round($ts, 2) == 0.00  ) : ?>
                                                                        <b style="font-weight:bold; font-size:10px; color:#000;"><?= round($ts, 2) ?> %</b>
                                                                    <?php elseif (round($ts, 2) > 0.00): ?>
                                                                        <b style="font-weight:bold; font-size:10px; color:#61B210;"><?= round($ts, 2) ?> %</b>
                                                                    <?php elseif (round($ts, 2) < 0.00): ?>
                                                                        <b style="font-weight:bold; font-size:10px; color:#E50000;"><?= round($ts, 2) ?> %</b>
                                                                    <?php else : ?>
                                                                        Error
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:12px; color:#000;">
                                                                    <?= $result['pivot_r2']  ?>
                                                                    <br>
                                                                    <?php if ( round($re, 2) == 0.00  ) : ?>
                                                                        <b style="font-weight:bold; font-size:10px; color:#000;"><?= round($re, 2) ?> %</b>
                                                                    <?php elseif (round($re, 2) > 0.00): ?>
                                                                        <b style="font-weight:bold; font-size:10px; color:#61B210;"><?= round($re, 2) ?> %</b>
                                                                    <?php elseif (round($re, 2) < 0.00): ?>
                                                                        <b style="font-weight:bold; font-size:10px; color:#E50000;"><?= round($re, 2) ?> %</b>
                                                                    <?php else : ?>
                                                                        Error
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:12px;">
                                                                    <?php if ( $result['prev_sig_dsl'] == 'Buy' OR $result['prev_sig_dsl'] == 'Avg Up' ) : ?>
                                                                        <b style="font-weight:bold; font-size:12px; color:#61B210;"><?= $result['prev_sig_dsl'] ?></b>
                                                                    <?php elseif ($result['prev_sig_dsl'] == 'Sell'): ?>
                                                                        <b style="font-weight:bold; font-size:12px; color:#E50000;"><?= $result['prev_sig_dsl'] ?></b>
                                                                    <?php elseif ($result['prev_sig_dsl'] == ' ' OR $result['prev_sig_dsl'] == '' OR $result['prev_sig_dsl'] == null): ?>
                                                                        <b style="font-weight:bold; font-size:12px; color:#000;">-</b>
                                                                    <?php else : ?>
                                                                        Error
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:12px;">
                                                                    <?php if ( $result['sig_dsl'] == 'Buy' OR $result['sig_dsl'] == 'Avg Up' ) : ?>
                                                                        <b style="font-weight:bold; font-size:12px; color:#61B210;"><?= $result['sig_dsl'] ?></b>
                                                                    <?php elseif ($result['sig_dsl'] == 'Sell'): ?>
                                                                        <b style="font-weight:bold; font-size:12px; color:#E50000;"><?= $result['sig_dsl'] ?></b>
                                                                    <?php elseif ($result['sig_dsl'] == ' ' OR $result['sig_dsl'] == '' OR $result['sig_dsl'] == null): ?>
                                                                        <b style="font-weight:bold; font-size:12px; color:#000;">-</b>
                                                                    <?php else : ?>
                                                                        Error
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>

                                                    </thead>
                                                </table>
                                                
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table style="width: 100%;">
                                                <thead>
                                                    <tr height="25px">
                                                        <td style="width: 10%; text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000;"></td>
                                                        <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Code</td>
                                                        <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Interval</td>
                                                        <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">System</td>
                                                        <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Price</td>
                                                        <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Trailing Stop</td>
                                                        <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Resisten</td>
                                                        <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Prev Status</td>
                                                        <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:11px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000;">Now Status</td>
                                                    </tr>
                                                    <tr height="60px" class="hoverali">
                                                        <td colspan="9" style="text-align: center; font-family: Poppins; font-weight:bold; font-size:11px; color:#000; background-color:#E3E3E3; padding-top:20px; padding-bottom:20px;">
                                                            <img width="35" src="<?= base_url() ?>/public/assets/img/locksm.svg" alt="">
                                                            <br><br>
                                                            Silahkan <a href="<?= base_url('pricing') ?>" style="color: #D19200; font-weight:bold;">Berlangganan</a> untuk dapat melihat & menambahkan daftar Watchlist Anda.
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <br>
                                <hr>

                                <div class="mt-1">
                                    <h3 class="poppins tebal">NEWS</h3>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="poppins tebal hitam" style="font-size: 12px; font-weight:bold; margin-top:-10px;">Informasi akurat & terkini seputar dunia Pasar Modal</p>
                                            </div>
                                            <div class="col-lg-6" style="text-align:right;">
                                                <p class="poppins tebal hitam" style="font-size: 12px; font-weight:bold; margin-top:-10px;"><a href="<?= base_url('news') ?>" class="poppins hitam" style="font-size: 12px; font-weight:bold; text-align:right;">View All News</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12 mt-3">

                                        <ul class="nav nav-pills d-none d-lg-block" id="pills-tab" role="tablist" style="margin-top:-20px;">
                                        <li class="nav-item topnav-centered-left">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" style="margin-left: -50px; border-radius:5px;">News</a>
                                        </li>
                                        <li class="nav-item topnav-centered-right">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="margin-left: 20px; border-radius:5px;">Keterbukaan Informasi</a>
                                        </li>
                                        </ul>
                                        <ul class="nav nav-pills d-sm-none" id="pills-tab" role="tablist">
                                        <li class="nav-item topnav-a">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" style="margin-left: -50px; border-radius:5px;">News</a>
                                        </li>
                                        <li class="nav-item topnav-b">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="margin-left: 20px; border-radius:5px;">Keterbukaan Informasi</a>
                                        </li>
                                        </ul>

                                        <div class="tab-content pt-5" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <?php foreach ($news as $n) : ?>
                                                    <div class="accordion-wrapper" style="cursor: pointer;">
                                                        <div class="acc-head p-3">
                                                            <a class="acc poppins tebel" style="cursor: pointer; font-size:12px;"><?= $n['judul']; ?></a>
                                                            <br><a class="kuning poppins tebel" style="cursor: pointer; font-size:12px; ">
                                                                <?= $n['tgl_pengumuman']; ?>
                                                                <!--hot web -->
                                                                <?php if ($n['kode_kategori_pengumuman'] == 'KTPM001') { ?>
                                                                      <!-- <img class="hot d-none d-lg-block" src="<?= base_url() ?>/public/assets/img/hot.png" alt=""> -->
                                                                      <a  style="color: red; font-weight:bold;">NEW!</a>
                                                                        <!--hot Mobile-->
                                                                        <!-- <img class="d-sm-none" width="50" src="<?= base_url() ?>/public/assets/img/hotang.png" alt=""> -->
                                                                      <!-- <a class="d-sm-none" style="color: red; font-weight:bold;">NEW!</a> -->
                                                                <?php }
                                                                if ($n['kode_kategori_pengumuman'] == 'KTPM002') { ?>
                                                                    <a style="color: red; font-weight:bold;">NEW!</a>
                                                                <?php } ?>
                                                            </a>
                                                        </div>
                                                        <div class="acc-body">
                                                            <?= $n['isi_pengumuman']; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                
                                                <?= $pager->links('group1','default_full') ?>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                    <?php foreach ($keterbukaaninformasis as $keterbukaaninformasi) : ?>
                                                        <div class="accordion-wrapper">
                                                            <div class="acc-head p-3">
                                                                <a class="acc" style="cursor: pointer; font-size:12px;"><?= $keterbukaaninformasi['judul']; ?></a>
                                                                <br><a class="kuning" style="cursor: pointer; font-size:12px; font-weight:bold;">
                                                                    <?= $keterbukaaninformasi['tgl_pengumuman']; ?>
                                                                    <!--hot web -->
                                                                    <?php if ($keterbukaaninformasi['kode_kategori_pengumuman'] == 'KTPM001') { ?>
                                                                        <!-- <img class="hot d-none d-lg-block" src="<?= base_url() ?>/public/assets/img/hot.png" alt=""> -->
                                                                        <a  style="color: red; font-weight:bold;">NEW!</a>
                                                                        <!--hot Mobile-->
                                                                        <!-- <img class="d-sm-none" width="50" src="<?= base_url() ?>/public/assets/img/hotang.png" alt=""> -->
                                                                        <a class="d-sm-none" style="color: red; font-weight:bold;">NEW!</a>
                                                                    <?php }
                                                                    if ($keterbukaaninformasi['kode_kategori_pengumuman'] == 'KTPM002') { ?>
                                                                        <a style="color: red; font-weight:bold;">NEW!</a>
                                                                    <?php } ?>
                                                                </a>
                                                            </div>
                                                            <div class="acc-body">
                                                                <?= $keterbukaaninformasi['isi_pengumuman']; ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                    <?= $pager->links('group1','default_full') ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <hr class="mt-4">
                                
                                <div class="mt-1">
                                    <h3 class="poppins tebal">VIDEO TUTORIAL</h3>
                                    <p class="poppins hitam" style="font-size: 12px; font-weight:bold; text-align:right;  margin-top:-40px;"><a href="<?= base_url('videoedukasi') ?>" class="poppins hitam" style="font-size: 12px; font-weight:bold; text-align:right;">View All Videos</a></p>
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <?php foreach ($video_apps as $va) : ?>
                                            <div class="col-lg-3">
                                                <div class="form-group col-12">
                                                    <div class="thumbnail video-thumbs" href="#" data-judul="<?= $va['judul']; ?>" data-subjudul="<?= $va['judul_filter']; ?>" data-vidlink="<?= $va['link_media']; ?>" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url(); ?>/public/assets/img/thumbnail2.png" data-target="#vid<?= $va['kode_media']; ?>">
                                                        <img class="img-thumbnail" src="<?= $va['thumbnails_video']; ?>" alt="Another alt text">
                                                        <div class="middle" style="top:60%;">
                                                            <div class="textss"><i class="fas fa-play uy"></i></div>
                                                        </div>
                                                    </div>
                                                    <h5 class="pt-1 pb-3" style="text-align:center; font-family: Poppins; font-weight:bold; font-size:13px;"><?= $va['judul']; ?> <br> <?= $va['judul_filter']; ?></h5>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="modal fade modalvideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: rgba(38, 38, 38, 0.5);">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content" style="background-color: #FFD73A; border-radius: 20px;">
                                                <div class="modal-header border-bottom-0">
                                                    <h4 class="modal-title" id="image-gallery-title"></h4>
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body py-0">
                                                <!--  <video class="video" width="100%" poster="<?= base_url(); ?>/public/assets/img/thumbnail2.png" controls>
                                                        <source src="<?= base_url(); ?>/public/assets/img/video/felix.mp4" type="video/mp4"> 
                                                    
                                                        Your browser does not support HTML video.
                                                    </video> -->
                                                    
                                                    <iframe id="vid_video" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
                                                    <!-- <iframe src="https://iframe.videodelivery.net/df362e31706e64525ec5ebe0e7958eb9" width="100%" height="400" frameborder="0" allowfullscreen></iframe> -->
                                                </div>
                                                <div>
                                                    <p class="title-img-galeri" style="text-align:center; color:#402615;"><span id="vid_judul" style="text-align:center; color:#402615;"></span> <br> <span id="vid_subjudul" style="text-align:center; color:#402615;"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <hr>
                                <div class="row justify-content-lg-center mt-5">
                                    <img alt="image" src="<?= base_url(); ?>/public/assets/img/langgananmonikaskrg.svg" style="width: 100%;">
                                </div>
                                <?php
                                    use CodeIgniter\HTTP\UserAgent;
                                    $this->request = \Config\Services::request();
                                    $agent = $this->request->getUserAgent();
                                    $mobile = $agent->isMobile();
                                ?>
                                <div class="row justify-content-lg-center mt-5">
                                    <div class="col-lg-4" style="margin-top:5%; text-align:center;">
                                        <div class="item">
                                            <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #E5E5E5, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT002') ?>'">
                                                <div class="top">
                                                    <div class="title">
                                                        <br>
                                                        <h4 style="color: #412817; font-size:20px; font-family: Poppins; font-weight:bold;">Paket TA</h4>
                                                        <h4 style="color: #EBA502; font-size:25px; font-family: Poppins; font-weight:bold;">Rp 90.000 <b style="color: #000; font-size:15px; font-weight:bold; font-family: Poppins;">/bulan</b></h4>
                                                        <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px; font-family: Poppins; font-weight:bold;">atau</h4>
                                                        <h4 style="color: #412817; font-size:20px; font-weight:bold; font-family: Poppins; font-weight:bold;">Rp. 900.000 <b style="color: #000; font-size:15px; font-weight:bold; font-family: Poppins;">/tahun</b></h4>
                                                        <img alt="image" src="<?= base_url(); ?>/public/assets/img/diskon17.svg" style="width: 90px;">
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($mobile == true): ?>
                                        <div class="col-lg-4" style="margin-top:10%; text-align:center;">
                                    <?php else: ?>
                                        <div class="col-lg-4" style="text-align:center;">
                                    <?php endif ?>

                                        <div class="item">
                                            <div style="background-color:#412817; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px; padding-right:2%; padding-left:2%;" onclick="location.href='<?= site_url('pembelian/HPKT004') ?>'">
                                                <br>
                                                <h3 style="color: #FBDC8E; font-weight:bold; font-family: Poppins;">Best Offer</h3>
                                                <div class="item">
                                                    <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #EBA502, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT004') ?>'">
                                                        <div class="top">
                                                            <div class="title">
                                                                <br>
                                                                <h4 style="color: #412817; font-size:20px; font-weight:bold; font-family: Poppins;">Ultimate</h4>
                                                                <h4 style="color: #FFFFFF; font-size:25px; font-weight:bold; font-family: Poppins;">Rp 180.000 <b style="color: #000; font-size:15px; font-weight:bold; font-family: Poppins;">/bulan</b></h4>
                                                                <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px; font-weight:bold; font-family: Poppins;">atau</h4>
                                                                <h4 style="color: #412817; font-size:20px; font-weight:bold;">Rp. 1.800.000 <b style="color: #000; font-size:15px; font-weight:bold; font-family: Poppins;">/tahun</b></h4>
                                                                <img alt="image" src="<?= base_url(); ?>/public/assets/img/diskon17.svg" style="width: 90px;">
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($mobile == true): ?>
                                        <div class="col-lg-4" style="margin-top:10%; text-align:center;">
                                    <?php else: ?>
                                        <div class="col-lg-4" style="margin-top:5%; text-align:center;">
                                    <?php endif ?>
                                        <div class="item">
                                            <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #E5E5E5, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT003') ?>'">
                                                <div class="top">
                                                    <div class="title">
                                                        <br>
                                                        <h4 style="color: #412817; font-size:20px; font-weight:bold; font-family: Poppins;">Paket FA</h4>
                                                        <h4 style="color: #EBA502; font-size:25px; font-weight:bold; font-family: Poppins;">Rp 90.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                        <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px; font-family: Poppins;">atau</h4>
                                                        <h4 style="color: #412817; font-size:20px; font-weight:bold; font-family: Poppins;">Rp. 900.000 <b style="color: #000; font-size:15px; font-weight:bold; font-family: Poppins;">/tahun</b></h4>
                                                        <img alt="image" src="<?= base_url(); ?>/public/assets/img/diskon17.svg" style="width: 90px;">
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>