<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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
        font-size: 12px;
        padding: 10px;
        cursor: pointer;
    }
    
</style>

<main class="body" id="main">
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>

                <div class="col-12 col-sm-12 col-lg-9">
                    <div class="card">
                      
                        <div class="card-body">
                            <?php if ($lvl === 'MULV001' || $lvl === 'MULV005'): ?>
                                <div class="col-lg-12">
                                    <div class="table-responsive" style="border-radius:5px;">
                                        <table class="table table-striped" style="border-radius:5px;">
                                            <thead>
                                                <tr>
                                                    <th colspan="7" style="text-align: left; font-family: Poppins; font-weight:bold; background-color:#730C0C; color:#fff; font-size:16px;  border-radius:5px;">
                                                        SMART WATCHLIST
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-2">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col"></div>
                                            <div class="col-8" style="background-color: #730C0C; padding:20px; border-radius:5px;">
                                                <form action="<?= site_url('addsmartwatchlist') ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="kode_user" value="<?= getsession('kode_user') ?>">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-3 col-form-label mt-1" style="font-weight: bold; color:#fff;">Ticker</label>
                                                        <div class="col-sm-8">
                                                            <select name="code" id="" class="selectpicker" data-live-search="true" data-width="100%" data-container="body" data-size="5" style="border-radius: 5px; height: calc(2em + .375rem + 2px) !important; padding: .125rem .25rem !important; font-size: .75rem !important; line-height: 1.5; font-weight:bold;" required>
                                                                <?php foreach ($codeNames as $codeName): ?>
                                                                    <option value="<?= $codeName->code ?>" data-content="<span class='badge badge-light'><?= $codeName->code ?></span> &nbsp; <?= $codeName->codename ?>"></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword" class="col-sm-3 col-form-label mt-1" style="font-weight: bold; color:#fff;">Interval</label>
                                                        <div class="col-sm-8">
                                                            <select name="timeframe" id="" class="form-control form-control-sm" style="cursor: pointer; border-radius: 5px; height: calc(3em + .375rem + 2px) !important; padding: .125rem .25rem !important; font-size: .75rem !important; line-height: 1.5; font-weight:bold;" required>
                                                                <option value=""> &nbsp;&nbsp; Pilih Interval</option>
                                                                <option value="Daily"> &nbsp;&nbsp; D/Daily</option>
                                                                <option value="Hourly"> &nbsp;&nbsp; H/Hourly</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword" class="col-sm-3 col-form-label mt-1" style="font-weight: bold; color:#fff;">System Trade</label>
                                                        <div class="col-sm-8">
                                                            <select name="" id="" class="form-control form-control-sm" style="cursor: pointer; border-radius: 5px; height: calc(3em + .375rem + 2px) !important; padding: .125rem .25rem !important; font-size: .75rem !important; line-height: 1.5; font-weight:bold;" required>
                                                                <option value="Cah"> &nbsp;&nbsp; Cah</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col"></div>
                                        </div>

                                        <div class="text-center mt-3">

                                            <?php if ( $jumlah < 10 ) : ?>
                                                <button type="submit" style="padding-left:40px; padding-right:40px; background-color: #730C0C; border-color:#730C0C;" class="btn btn-dark mt-1" style="font-family:Poppins;">
                                                    <b style="font-weight:bold; color:white;">SUBMIT</b>
                                                </button>
                                            <?php else : ?>
                                                <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #730C0C; color:#fff; font-weight:bold;">
                                                    <b style="font-weight:bold; font-size:12px; color:#fff;">Data WATCHLIST sudah mancapai batas maksimal.</b>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                            
                                        </div>
                                        </form>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-lg-12">
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

                                    <br>
                                    <div class="table-responsive">
                                        <table style="width: 100%;">
                                            <thead>
                                                <tr height="25px">
                                                    <td style="width: 10%; text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000;"></td>
                                                    <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Code</td>
                                                    <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Interval</td>
                                                    <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">System</td>
                                                    <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Price</td>
                                                    <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Trailing Stop</td>
                                                    <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Resisten</td>
                                                    <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000;">Prev Status</td>
                                                    <td style="text-align: center; border-top-left-radius: 50px 20px; font-family: Poppins; font-weight:bold; font-size:12px; color:black; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000;">Now Status</td>
                                                </tr>

                                                <?php  foreach($dataResult as $result) : ?>
                                                    <tr height="60px" class="hoverali">
                                                        <td style=" text-align: center; font-family: Poppins; font-weight:bold; font-size:12px;"><a href="<?= site_url('/deletesmartwatchlist/'.$result['id']) ?>" onclick="return ActionMessage(1, this, event)" data-msg="Ingin hapus data ini ?"><span class="badge badge-danger" style="background-color: #D30000;">Hapus</span></a></td>
                                                        <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:12px; color:#000;"><?= $result['code'] ?></td>
                                                        <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:12px; color:#000;"><?= $result['timeframe'] ?></td>
                                                        <td style="text-align: center; font-family: Poppins; font-weight:bold; font-size:12px; color:#000;">Cah</td>
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
                            <?php else: ?>
                                <?= $this->include('components/template_upgrade'); ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(function () {
        $('.selectpicker').selectpicker();
    });
</script>


<?= $this->endSection(); ?>