<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<style>
    .page-item .page-link {
        background-color: #fff;
        border-color: #fff;
        color: #888888;
        padding-left: 17px;
        padding-right: 17px;
        font-family: Poppins; font-weight:bold;
    }

    .page-item.active .page-link {
        background-color: #FBDC8E;
        border-color: #FBDC8E;
        color: #DD9B00;
        padding-left: 17px;
        padding-right: 17px;
        font-family: Poppins; font-weight:bold;
    }
</style>

<main class="body" id="main">
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>
                <div class="col-lg-9">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 style="color: #ffd73a; font-family: Poppins; font-weight:bold; font-size:14px;">
                                Monika's Secret<samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp>
                            </h4>
                            <h5 class="pt-2" style="color: #000; font-family: Poppins; font-weight:bold; font-size:14px;">Stock Review</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr style="background-color: #710D0D; color: #fff;">
                                        <th style="font-family: Poppins; font-weight:bold;">TECHNICAL REVIEW</th>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-lg-4 mt-3 mb-3" style="margin-left: -14px;">
                                <form action="stockreviewfivepost" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="inputstockreview"  placeholder="Kode Emiten" style="font-family: Poppins; font-weight:bold; font-size:12px; border-top-left-radius:5px; border-bottom-left-radius:5px;">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="submit" style="background-color: #710D0D; border-color: #710D0D; color: #fff; font-family: Poppins; font-weight:bold; border-top-right-radius:5px; border-bottom-right-radius:5px;">
                                                Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <?php if ($valStockReview == null): ?>
                                
                            <?php else: ?>
                                <?php if ($dataStart->code == null): ?>
                                    <?php 
                                        echo '<script language="javascript">';
                                        echo 'alert("Kode Emiten Tidak Ditemukan!")';
                                        echo '</script>';
                                    ?>
                                    <div class="alert alert-danger" style="background-color: #F80000; border-color: #F80000; color:#fff;">
                                        <strong style="font-family: Poppins; font-weight:bold;"> Kode Emiten tidak ditemukan.</strong>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive mt-3 mb-3">
                                        <table style="width: 100%;">
                                                <tr>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; width:40%;"><h2><?= $dataStart->code ?></h2></td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">open</td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;"><img style="width: 10px;" alt="image" src="<?= base_url(); ?>/public/assets/img/Union 3.svg"> low</td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;"><img style="width: 10px;" alt="image" src="<?= base_url(); ?>/public/assets/img/Union 4.svg"> high</td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">close</td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">%</td>
                                                </tr>
                                                <tr>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; width:40%;">PT <?= $dataStart->codename ?></td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; font-weight:bold;"><?= number_format($dataStart->open,0,',',',')  ?></td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; font-weight:bold;"><?= number_format($dataStart->low,0,',',',')  ?></td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; font-weight:bold;"><?= number_format($dataStart->high,0,',',',')  ?></td>
                                                    <td class="p-1" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; font-weight:bold;"><?= number_format($dataStart->last,0,',',',') ?></td>
                                                    <?php if (substr($dataStart->chg, 0, 1) == '-'): ?>
                                                        <td class="p-1" style="vertical-align: middle; font-family: Poppins; font-weight:bold; color:#F80000; font-weight:bold;"><?= substr($dataStart->chg, 0, 4) ?>%</td>
                                                    <?php else: ?>
                                                        <td class="p-1" style="vertical-align: middle; font-family: Poppins; font-weight:bold; color:#0A9539; font-weight:bold;"><?= substr($dataStart->chg, 0, 4) ?>%</td>
                                                    <?php endif; ?>
                                                </tr>
                                        </table>
                                    </div>

                                    <div class="table-responsive mt-3 mb-3" style="border-style: solid; border-radius: 5px; border-color:#707070; border-width: 1px;">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <a href="<?= base_url().'/stockreviewweekly/'.$dataStart->code ?>" class="btn btn-sm btn-warning" style="border-radius: 5px; background-color:#ffffff; border-color:#ffffff; color:#000; font-family: Poppins; font-weight:bold;">Weekly</a>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <a href="<?= base_url().'/stockreviewdaily/'.$dataStart->code ?>" class="btn btn-sm btn-warning" style="border-radius: 5px; background-color:#ffffff; border-color:#ffffff; color:#000; font-family: Poppins; font-weight:bold;">Daily</a>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <a href="<?= base_url().'/stockreviewhourly/'.$dataStart->code ?>" class="btn btn-sm btn-warning" style="border-radius: 5px; background-color:#ffffff; border-color:#ffffff; color:#000; font-family: Poppins; font-weight:bold;">Hourly</a>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <a href="<?= base_url().'/stockreviewthirty/'.$dataStart->code ?>" class="btn btn-sm btn-warning" style="border-radius: 5px; background-color:#ffffff; border-color:#ffffff; color:#000; font-family: Poppins; font-weight:bold;">30min</a>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <a href="<?= base_url().'/stockreviewfifteen/'.$dataStart->code ?>" class="btn btn-sm btn-warning" style="border-radius: 5px; background-color:#ffffff; border-color:#ffffff; color:#000; font-family: Poppins; font-weight:bold;">15min</a>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <a href="<?= base_url().'/stockreviewfive/'.$dataStart->code ?>" class="btn btn-sm btn-warning" style="border-radius: 5px; background-color:#FFD73A; border-color:#FFD73A; color:#000; font-family: Poppins; font-weight:bold;">05min</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="table-responsive mt-5 mb-3">
                                        <table class="table table-striped" style="width: 100%;">
                                            <tr>
                                                <td colspan="3" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <small style="font-size: 15px; font-weight:bold;">
                                                        Summary : 
                                                        <?php
                                                            if ($dataStart->total_buy_teknikal == 0 && $dataStart->total_sell_teknikal == 0) {
                                                                $sum_teknikal = 'NETRAL';
                                                            } elseif ($dataStart->total_buy_teknikal == 0) {
                                                                if ($dataStart->total_sell_teknikal > 2) {
                                                                    $sum_teknikal = 'STRONG SELL';
                                                                } elseif ($dataStart->total_sell_teknikal > 1 && $dataStart->total_sell_teknikal <= 2) {
                                                                    $sum_teknikal = 'SELL';
                                                                } elseif ($dataStart->total_sell_teknikal == 1) {
                                                                    $sum_teknikal = 'NETRAL';
                                                                } elseif ($dataStart->total_sell_teknikal < 1 && $dataStart->total_sell_teknikal >= 0.5) {
                                                                    $sum_teknikal = 'SELL';
                                                                } elseif ($dataStart->total_sell_teknikal < 0.5) {
                                                                    $sum_teknikal = 'SELL';
                                                                } else {
                                                                    $sum_teknikal = 'ERROR';
                                                                }
                                                            } elseif ($dataStart->total_sell_teknikal == 0) {
                                                                if ($dataStart->total_buy_teknikal > 2) {
                                                                    $sum_teknikal = 'STRONG BUY';
                                                                } elseif ($dataStart->total_buy_teknikal > 1 && $dataStart->total_buy_teknikal <= 2) {
                                                                    $sum_teknikal = 'BUY';
                                                                } elseif ($dataStart->total_buy_teknikal == 1) {
                                                                    $sum_teknikal = 'NETRAL';
                                                                } elseif ($dataStart->total_buy_teknikal < 1 && $dataStart->total_buy_teknikal >= 0.5) {
                                                                    $sum_teknikal = 'BUY';
                                                                } elseif ($dataStart->total_buy_teknikal < 0.5) {
                                                                    $sum_teknikal = 'BUY';
                                                                } else {
                                                                    $sum_teknikal = 'ERROR';
                                                                }
                                                            } else {
                                                                if ($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal > 2) {
                                                                    $sum_teknikal = 'STRONG BUY';
                                                                } elseif ($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal > 1 && $dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal <= 2) {
                                                                    $sum_teknikal = 'BUY';
                                                                } elseif ($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal == 1) {
                                                                    $sum_teknikal = 'NETRAL';
                                                                } elseif ($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal < 1 && $dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal >= 0.5) {
                                                                    $sum_teknikal = 'SELL';
                                                                } elseif ($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal < 0.5) {
                                                                    $sum_teknikal = 'STRONG SELL';
                                                                } else {
                                                                    $sum_teknikal = 'ERROR';
                                                                }
                                                            }

                                                            if ($dataStart->total_buy_moving == 0 && $dataStart->total_sell_moving == 0) {
                                                                $sum_moving = 'NETRAL';
                                                            } elseif ($dataStart->total_buy_moving == 0) {
                                                                if ($dataStart->total_sell_moving > 2) {
                                                                    $sum_moving = 'STRONG SELL';
                                                                } elseif ($dataStart->total_sell_moving > 1 && $dataStart->total_sell_moving <= 2) {
                                                                    $sum_moving = 'SELL';
                                                                } elseif ($dataStart->total_sell_moving == 1) {
                                                                    $sum_moving = 'NETRAL';
                                                                } elseif ($dataStart->total_sell_moving < 1 && $dataStart->total_sell_moving >= 0.5) {
                                                                    $sum_moving = 'SELL';
                                                                } elseif ($dataStart->total_sell_moving < 0.5) {
                                                                    $sum_moving = 'SELL';
                                                                } else {
                                                                    $sum_moving = 'ERROR';
                                                                }
                                                            } elseif ($dataStart->total_sell_moving == 0) {
                                                                if ($dataStart->total_buy_moving > 2) {
                                                                    $sum_moving = 'STRONG BUY';
                                                                } elseif ($dataStart->total_buy_moving > 1 && $dataStart->total_buy_moving <= 2) {
                                                                    $sum_moving = 'BUY';
                                                                } elseif ($dataStart->total_buy_moving == 1) {
                                                                    $sum_moving = 'NETRAL';
                                                                } elseif ($dataStart->total_buy_moving < 1 && $dataStart->total_buy_moving >= 0.5) {
                                                                    $sum_moving = 'BUY';
                                                                } elseif ($dataStart->total_buy_moving < 0.5) {
                                                                    $sum_moving = 'BUY';
                                                                } else {
                                                                    $sum_moving = 'ERROR';
                                                                }
                                                            } else {
                                                                if ($dataStart->total_buy_moving/$dataStart->total_sell_moving > 2) {
                                                                    $sum_moving = 'STRONG BUY';
                                                                } elseif ($dataStart->total_buy_moving/$dataStart->total_sell_moving > 1 && $dataStart->total_buy_moving/$dataStart->total_sell_moving <= 2) {
                                                                    $sum_moving = 'BUY';
                                                                } elseif ($dataStart->total_buy_moving/$dataStart->total_sell_moving == 1) {
                                                                    $sum_moving = 'NETRAL';
                                                                } elseif ($dataStart->total_buy_moving/$dataStart->total_sell_moving < 1 && $dataStart->total_buy_moving/$dataStart->total_sell_moving >= 0.5) {
                                                                    $sum_moving = 'SELL';
                                                                } elseif ($dataStart->total_buy_moving/$dataStart->total_sell_moving < 0.5) {
                                                                    $sum_moving = 'STRONG SELL';
                                                                } else {
                                                                    $sum_moving = 'ERROR';
                                                                }
                                                            }

                                                            $sum_moving_teknikal = $sum_teknikal.' '.$sum_moving;
                                                        ?>

                                                        <?php if ($sum_moving_teknikal == 'STRONG BUY STRONG BUY' || $sum_moving_teknikal == 'STRONG BUY BUY' || $sum_moving_teknikal == 'BUY STRONG BUY'): ?>
                                                            <span class="badge badge-secondary" style="border-radius: 5px; background-color:#13AC13; border-color:#13AC13; color:#fff; font-family: Poppins; font-weight:bold;">
                                                                STRONG BUY
                                                            </span>
                                                        <?php elseif ($sum_moving_teknikal == 'STRONG BUY NETRAL' || $sum_moving_teknikal == 'BUY BUY' || $sum_moving_teknikal == 'BUY NETRAL' || $sum_moving_teknikal == 'NETRAL STRONG BUY' || $sum_moving_teknikal == 'NETRAL BUY'): ?>
                                                            <span class="badge badge-secondary" style="border-radius: 5px; background-color:#13AC13; border-color:#13AC13; color:#fff; font-family: Poppins; font-weight:bold;">
                                                                BUY
                                                            </span>
                                                        <?php elseif ($sum_moving_teknikal == 'BUY STRONG SELL' || $sum_moving_teknikal == 'NETRAL SELL' || $sum_moving_teknikal == 'NETRAL STRONG SELL' || $sum_moving_teknikal == 'SELL NETRAL' || $sum_moving_teknikal == 'SELL SELL' || $sum_moving_teknikal == 'STRONG SELL BUY' || $sum_moving_teknikal == 'STRONG SELL NETRAL'): ?>
                                                            <span class="badge badge-secondary" style="border-radius: 5px; background-color:#F80000; border-color:#F80000; color:#fff; font-family: Poppins; font-weight:bold;">
                                                                SELL
                                                            </span>
                                                        <?php elseif ($sum_moving_teknikal == 'SELL STRONG SELL' || $sum_moving_teknikal == 'STRONG SELL SELL' || $sum_moving_teknikal == 'STRONG SELL STRONG SELL'): ?>
                                                            <span class="badge badge-secondary" style="border-radius: 5px; background-color:#F80000; border-color:#F80000; color:#fff; font-family: Poppins; font-weight:bold;">
                                                                STRONG SELL
                                                            </span>
                                                        <?php elseif ($sum_moving_teknikal == 'STRONG BUY SELL' || $sum_moving_teknikal == 'STRONG BUY STRONG SELL' || $sum_moving_teknikal == 'BUY SELL' || $sum_moving_teknikal == 'NETRAL NETRAL' || $sum_moving_teknikal == 'SELL STRONG BUY' || $sum_moving_teknikal == 'SELL BUY' || $sum_moving_teknikal == 'STRONG SELL STRONG BUY'): ?>
                                                            <span class="badge badge-secondary" style="border-radius: 5px; background-color:#000; border-color:#000; color:#fff; font-family: Poppins; font-weight:bold;">
                                                                NETRAL
                                                            </span>
                                                        <?php else: ?>

                                                        <?php endif; ?>
                                                    </small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;" id="waktusekarang"></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <small style="font-size: 12px;">Technical Indicators</small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <?php if ($dataStart->total_buy_teknikal == 0 && $dataStart->total_sell_teknikal == 0): ?>
                                                        <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                    <?php elseif ($dataStart->total_buy_teknikal == 0): ?>
                                                        <?php if ($dataStart->total_sell_teknikal > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">STRONG SELL</small>
                                                        <?php elseif ($dataStart->total_sell_teknikal > 1 && $dataStart->total_sell_teknikal <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif ($dataStart->total_sell_teknikal == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif ($dataStart->total_sell_teknikal < 1 && $dataStart->total_sell_teknikal >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif ($dataStart->total_sell_teknikal < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php elseif ($dataStart->total_sell_teknikal == 0): ?>
                                                        <?php if ($dataStart->total_buy_teknikal > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">STRONG BUY</small>
                                                        <?php elseif ($dataStart->total_buy_teknikal > 1 && $dataStart->total_buy_teknikal <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif ($dataStart->total_buy_teknikal == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif ($dataStart->total_buy_teknikal < 1 && $dataStart->total_buy_teknikal >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif ($dataStart->total_buy_teknikal < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if (($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal) > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">STRONG BUY</small>
                                                        <?php elseif (($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal) > 1 && ($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal) <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif (($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal) == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif (($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal) < 1 && ($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal) >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif (($dataStart->total_buy_teknikal/$dataStart->total_sell_teknikal) < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">STRONG SELL</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;">Buy (<?= $dataStart->total_buy_teknikal ?>)</small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;">Sell (<?= $dataStart->total_sell_teknikal ?>)</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <small style="font-size: 12px;">Moving Average</small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <?php if ($dataStart->total_buy_moving == 0 && $dataStart->total_sell_moving == 0): ?>
                                                        <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                    <?php elseif ($dataStart->total_buy_moving == 0): ?>
                                                        <?php if ($dataStart->total_sell_moving > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">STRONG SELL</small>
                                                        <?php elseif ($dataStart->total_sell_moving > 1 && $dataStart->total_sell_moving <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif ($dataStart->total_sell_moving == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif ($dataStart->total_sell_moving < 1 && $dataStart->total_sell_moving >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif ($dataStart->total_sell_moving < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php elseif ($dataStart->total_sell_moving == 0): ?>
                                                        <?php if ($dataStart->total_buy_moving > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">STRONG BUY</small>
                                                        <?php elseif ($dataStart->total_buy_moving > 1 && $dataStart->total_buy_moving <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif ($dataStart->total_buy_moving == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif ($dataStart->total_buy_moving < 1 && $dataStart->total_buy_moving >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif ($dataStart->total_buy_moving < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if (($dataStart->total_buy_moving/$dataStart->total_sell_moving) > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">STRONG BUY</small>
                                                        <?php elseif (($dataStart->total_buy_moving/$dataStart->total_sell_moving) > 1 && ($dataStart->total_buy_moving/$dataStart->total_sell_moving) <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif (($dataStart->total_buy_moving/$dataStart->total_sell_moving) == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif (($dataStart->total_buy_moving/$dataStart->total_sell_moving) < 1 && ($dataStart->total_buy_moving/$dataStart->total_sell_moving) >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif (($dataStart->total_buy_moving/$dataStart->total_sell_moving) < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">STRONG SELL</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;">Buy (<?= $dataStart->total_buy_moving ?>)</small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;">Sell (<?= $dataStart->total_sell_moving ?>)</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <small style="font-size: 12px;">Effective Value</small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <?php if ($dataStart->total_accu_effective == 0 && $dataStart->total_dist_effective == 0): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                    <?php elseif ($dataStart->total_accu_effective == 0): ?>
                                                        <?php if ($dataStart->total_dist_effective > 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">DISTRIBUTION</small>
                                                        <?php elseif ($dataStart->total_dist_effective == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php elseif ($dataStart->total_dist_effective == 0): ?>
                                                        <?php if ($dataStart->total_accu_effective > 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">ACCUMULATION</small>
                                                        <?php elseif ($dataStart->total_accu_effective == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if (($dataStart->total_accu_effective/$dataStart->total_dist_effective) > 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">ACCUMULATION</small>
                                                        <?php elseif (($dataStart->total_accu_effective/$dataStart->total_dist_effective) == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif (($dataStart->total_accu_effective/$dataStart->total_dist_effective) < 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">DISTRIBUTION</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;">Accumulation (<?= $dataStart->total_accu_effective ?>)</small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;">Distribution (<?= $dataStart->total_dist_effective ?>)</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                    <small style="font-size: 12px;">Foreign Nett Buy/Sell</small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <?php if ($dataStart->total_buy_foreign == 0 && $dataStart->total_sell_foreign == 0): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                    <?php elseif ($dataStart->total_buy_foreign == 0): ?>
                                                        <?php if ($dataStart->total_sell_foreign > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif ($dataStart->total_sell_foreign > 1 && $dataStart->total_sell_foreign <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif ($dataStart->total_sell_foreign == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif ($dataStart->total_sell_foreign < 1 && $dataStart->total_sell_foreign >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif ($dataStart->total_sell_foreign < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php elseif ($dataStart->total_sell_foreign == 0): ?>
                                                        <?php if ($dataStart->total_buy_foreign > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif ($dataStart->total_buy_foreign > 1 && $dataStart->total_buy_foreign <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif ($dataStart->total_buy_foreign == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif ($dataStart->total_buy_foreign < 1 && $dataStart->total_buy_foreign >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>    
                                                        <?php elseif ($dataStart->total_buy_foreign < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if ($dataStart->total_buy_foreign/$dataStart->total_sell_foreign > 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif ($dataStart->total_buy_foreign/$dataStart->total_sell_foreign > 1 && $dataStart->total_buy_foreign/$dataStart->total_sell_foreign <= 2): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#13AC13;">BUY</small>
                                                        <?php elseif ($dataStart->total_buy_foreign/$dataStart->total_sell_foreign == 1): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">NETRAL</small>
                                                        <?php elseif ($dataStart->total_buy_foreign/$dataStart->total_sell_foreign < 1 && $dataStart->total_buy_foreign/$dataStart->total_sell_foreign >= 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php elseif ($dataStart->total_buy_foreign/$dataStart->total_sell_foreign < 0.5): ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#F80000;">SELL</small>
                                                        <?php else: ?>
                                                            <small style="font-size: 12px; font-weight:bold; color:#000;">ERROR</small>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;">Buy (<?= $dataStart->total_buy_foreign ?>)</small>
                                                </td>
                                                <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                    <small style="font-size: 12px;">Sell (<?= $dataStart->total_sell_foreign ?>)</small>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-responsive mt-3 mb-3">
                                                <table class="table table-striped" style="width: 100%;">
                                                    <tr style="background-color: #FFD73A;">
                                                        <td colspan="2" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 16px; font-weight:bold;">Technical Indicators</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;">Buy (<?= $dataStart->total_buy_teknikal ?>) Sell (<?= $dataStart->total_sell_teknikal ?>)</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Name</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Value</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Action</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">RSI (14)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->rsi_14 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_rsi_14 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_rsi_14 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_rsi_14 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_rsi_14 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_rsi_14 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">STO (5,3)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->sto_5_3 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_sto_5_3 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_sto_5_3 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_sto_5_3 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_sto_5_3 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_sto_5_3 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">STO-RSI (14)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->sto_rsi_14 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_sto_rsi_14 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_sto_rsi_14 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_sto_rsi_14 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_sto_rsi_14 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_sto_rsi_14 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">MACD (12-26)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->macd_12_26 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_macd_12_26 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_macd_12_26 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_macd_12_26 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_macd_12_26 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_macd_12_26 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">ADX (14)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->adx_14 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_adx_14 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_adx_14 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_adx_14 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_adx_14 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_adx_14 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">CCI (14)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->cci_14 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_cci_14 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_cci_14 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_cci_14 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_cci_14 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_cci_14 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">ATR (14)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->atr_14 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_atr_14 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_atr_14 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_atr_14 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_atr_14 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_atr_14 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">OBV</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->obv_14 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_obv_14 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_obv_14 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_obv_14 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_obv_14 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_obv_14 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">UO</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->uo ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_uo == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_uo ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_uo == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_uo ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_uo ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">MFI (14)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->mfi_14 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sig_mfi_14 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sig_mfi_14 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sig_mfi_14 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sig_mfi_14 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sig_mfi_14 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="table-responsive mt-3 mb-3">
                                                <table class="table table-striped" style="width: 100%;">
                                                    <tr style="background-color: #FFD73A;">
                                                        <td colspan="2" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 16px; font-weight:bold;">Moving Averages</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;">Buy (<?= $dataStart->total_buy_moving ?>) Sell (<?= $dataStart->total_sell_moving ?>)</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Name</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Simple</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Exponential</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">MA 5</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ma_5 ?> <br> 
                                                                <?php if ($dataStart->sig_ma_5 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ma_5 ?></b>
                                                                <?php elseif ($dataStart->sig_ma_5 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ma_5 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ma_5 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ema_5 ?> <br> 
                                                                <?php if ($dataStart->sig_ema_5 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ema_5 ?></b>
                                                                <?php elseif ($dataStart->sig_ema_5 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ema_5 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ema_5 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">MA 10</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ma_10 ?> <br> 
                                                                <?php if ($dataStart->sig_ma_10 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ma_10 ?></b>
                                                                <?php elseif ($dataStart->sig_ma_10 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ma_10 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ma_10 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ema_10 ?> <br> 
                                                                <?php if ($dataStart->sig_ema_10 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ema_10 ?></b>
                                                                <?php elseif ($dataStart->sig_ema_10 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ema_10 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ema_10 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">MA 20</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ma_20 ?> <br> 
                                                                <?php if ($dataStart->sig_ma_20 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ma_20 ?></b>
                                                                <?php elseif ($dataStart->sig_ma_20 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ma_20 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ma_20 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ema_20 ?> <br> 
                                                                <?php if ($dataStart->sig_ema_20 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ema_20 ?></b>
                                                                <?php elseif ($dataStart->sig_ema_20 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ema_20 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ema_20 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">MA 50</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ma_50 ?> <br> 
                                                                <?php if ($dataStart->sig_ma_50 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ma_50 ?></b>
                                                                <?php elseif ($dataStart->sig_ma_50 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ma_50 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ma_50 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ema_50 ?> <br> 
                                                                <?php if ($dataStart->sig_ema_50 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ema_50 ?></b>
                                                                <?php elseif ($dataStart->sig_ema_50 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ema_50 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ema_50 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">MA 100</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ma_100 ?> <br> 
                                                                <?php if ($dataStart->sig_ma_100 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ma_100 ?></b>
                                                                <?php elseif ($dataStart->sig_ma_100 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ma_100 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ma_100 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ema_100 ?> <br> 
                                                                <?php if ($dataStart->sig_ema_100 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ema_100 ?></b>
                                                                <?php elseif ($dataStart->sig_ema_100 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ema_100 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ema_100 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">MA 200</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ma_200 ?> <br> 
                                                                <?php if ($dataStart->sig_ma_200 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ma_200 ?></b>
                                                                <?php elseif ($dataStart->sig_ma_200 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ma_200 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ma_200 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px; color: #000;"><?= $dataStart->ema_200 ?> <br> 
                                                                <?php if ($dataStart->sig_ema_200 == 'Buy'): ?>
                                                                    <b style="color: #13AC13;"><?= $dataStart->sig_ema_200 ?></b>
                                                                <?php elseif ($dataStart->sig_ema_200 == 'Sell'): ?>
                                                                    <b style="color: #F80000;"><?= $dataStart->sig_ema_200 ?></b>
                                                                <?php else: ?>
                                                                    <small style="font-size: 12px; color:#000;">
                                                                        <?= $dataStart->sig_ema_200 ?>
                                                                    </small>
                                                                <?php endif; ?>
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-responsive mt-3 mb-3">
                                                <table class="table table-striped" style="width: 100%;">
                                                    <tr style="background-color: #FFD73A;">
                                                        <td colspan="2" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 16px; font-weight:bold;">Foreign Nett Buy/Sell</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;">Buy (<?= $dataStart->total_buy_foreign ?>) Sell (<?= $dataStart->total_sell_foreign ?>)</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Periode</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Value (billion)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">NETT Action</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">1</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->fn_1 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sfn_1 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sfn_1 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sfn_1 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sfn_1 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sfn_1 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">5</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->fn_5 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sfn_5 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sfn_5 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sfn_5 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sfn_5 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sfn_5 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">10</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->fn_10 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sfn_10 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sfn_10 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sfn_10 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sfn_10 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sfn_10 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">20</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->fn_20 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sfn_20 == 'Buy'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    <?= $dataStart->sfn_20 ?>
                                                                </small>
                                                            <?php elseif ($dataStart->sfn_20 == 'Sell'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    <?= $dataStart->sfn_20 ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sfn_20 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="table-responsive mt-3 mb-3">
                                                <table class="table table-striped" style="width: 100%;">
                                                    <tr style="background-color: #FFD73A;">
                                                        <td colspan="2" style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 16px; font-weight:bold;">Effective Value</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;">Accu (<?= $dataStart->total_accu_effective ?>) Dist (<?= $dataStart->total_dist_effective ?>)</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Periode</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Value (billion)</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left; height: 33px;">
                                                            <small style="font-size: 12px; font-weight:bold;">Action</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">1</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->ev_1 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sev_1 == 'Accummulation'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    ACCUMULATION
                                                                </small>
                                                            <?php elseif ($dataStart->sev_1 == 'Distribution'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    DISTRIBUTION
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sev_1 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">5</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->ev_5 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sev_5 == 'Accummulation'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    ACCUMULATION
                                                                </small>
                                                            <?php elseif ($dataStart->sev_5 == 'Distribution'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    DISTRIBUTION
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sev_5 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">10</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->ev_10 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sev_10 == 'Accummulation'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    ACCUMULATION
                                                                </small>
                                                            <?php elseif ($dataStart->sev_10 == 'Distribution'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    DISTRIBUTION
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sev_10 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold;">
                                                            <small style="font-size: 12px;">20</small>
                                                        </td>
                                                        <td style="vertical-align: middle; color: #000; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <small style="font-size: 12px;"><?= $dataStart->ev_20 ?></small>
                                                        </td>
                                                        <td style="vertical-align: middle; font-family: Poppins; font-weight:bold; text-align:left;">
                                                            <?php if ($dataStart->sev_20 == 'Accummulation'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#13AC13;">
                                                                    ACCUMULATION
                                                                </small>
                                                            <?php elseif ($dataStart->sev_20 == 'Distribution'): ?>
                                                                <small style="font-size: 12px; font-weight:bold; color:#F80000;">
                                                                    DISTRIBUTION
                                                                </small>
                                                            <?php else: ?>
                                                                <small style="font-size: 12px; color:#000;">
                                                                    <?= $dataStart->sev_20 ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?> 
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>

<script>
    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;

    window.setTimeout("waktu()", 1000);

    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        document.getElementById("waktusekarang").innerHTML = tanggallengkap + ' ' + waktu.getHours() + ':' + waktu.getMinutes() + ':' + waktu.getSeconds();
    }
</script>

<?= $this->endSection(); ?>