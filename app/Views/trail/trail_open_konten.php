<div class="col-lg-9">
<?php
    if ($lvl == 'MULV001' || $lvl == 'MULV005') {
?>
    <div class="card mb-3">
        <div class="card-header">
            <h4 style="color: #ffd73a; font-weight:bold; font-size:14px;">Monika's Secret<samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h4 style="color: #000; font-weight:bold; font-size:14px;">Trailling Stop<samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h4 style="color: #000; font-weight:bold; font-size:14px;">Open Position<samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h5 class="pt-2" style="color: #000; font-weight:bold; font-size:14px;"><?= date('d/m/Y') ?></h5>

        </div>
        <div class="card-body pb-5">
            <div style="margin-top: -20px;" class="mb-3">
                <button style="width:auto; background-color: #612D11; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('trailopenweb') ?>'">
                    <font style="color:#e8e5e5; font-size:12px; font-weight:bold;">Open Position</font>
                </button>
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('trailclosedweb') ?>'">
                    <font style="color:#612D11; font-size:12px; font-weight:bold;">Closed Position</font>
                </button>
            </div>

            <div class="containeri" style="margin-top: -20px;">
                <div class="row">
                    <div class="col pb-1">
                        <div class="head-table float-right">
                            <?= $pager->links('btaction', 'bootstrap_pagination') ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-1">
                <div class="table-responsive text-center">
                    <table class="table table-striped table-bordered" id="tableBaru">
                        <thead style="background-color: #ffd73a;">
                            <tr>
                                <th style="color: black;">
                                    <div style="font-size:12px; font-weight:bold;">Stock</div>
                                    <div style="font-size:12px; font-weight:bold;">Buy Date</div>
                                </th>
                                <th style="color: black;">
                                    <div style="font-size:12px; font-weight:bold;">Buy Price</div>
                                    <div style="font-size:12px; font-weight:bold;">Close Price</div>
                                </th>
                                <th style="color: black; font-size:12px; font-weight:bold;">
                                    Gain/loss
                                </th>
                                <th style="color: black;">
                                    <div style="font-size:12px; font-weight:bold;">Trailling Stop (TS)</div>
                                    <div style="font-size:12px; font-weight:bold;">% Jarak Ke TS</div>
                                </th>
                                <th style="color: black; font-size:12px; font-weight:bold;">
                                    Syariah
                                </th>
                            </tr>
                        </thead>
                        <?php
                            foreach ($all_data as $item) :
                            ?>
                        <tr>
                            <td style="font-size:12px; font-weight:bold;"><?= $item['stock']; ?><br><?= date('d/m/Y', strtotime($item['buy_date'])); ?></td>
                            <td style="font-size:12px; font-weight:bold;"><?= number_format($item['buy_price'], 0, ',', '.'); ?><br>
                                <div class="<?= $item['close_price'] > $item['buy_price'] ? 'text-success-ali' : 'text-danger-ali' ?>"
                                    style="font-weight: bold;">
                                    <?= number_format($item['close_price'], 0, ',', '.'); ?></div>
                            </td>
                            <td style="font-size:12px; font-weight:bold;"><?= $item['gain_loss']; ?></td>
                            <td style="font-size:12px; font-weight:bold;"><?= number_format($item['trailing_stop'], 0, ',', '.'); ?><br><?= $item['jarak_ts']; ?>
                            </td>
                            <td style="font-size:12px; font-weight:bold;"><?= $item['is_syariah']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="containeri">
                <div class="row">
                    <div class="col-12">
                        <strong>Cara Trading pada Trailing Stop Monika (TS Monika) :</strong><br>
                        1. TSMon diupgrade pada EOD, buy dan sell pada opening hari berikutnya.<br>
                        2. Buy saham sedekat mungkin dengan Harga Beli.<br>
                        3. TSMon hold maksimal 10 saham, buy saham baru hanya dilakukan apabila ada saham terdahulu yang
                        kena Trailing Stop.<br>
                        4. Gunakan Money Management yang anda pahami sebelum entry.<br>
                        5. Trailing Stop Price akan berfungsi sebagai Cutloss Price apabila belum melewati harga beli
                        pertama.<br>
                        6. TSMon menggunakan system buy and hold until Trailling stop hit, sehingga TS Monika tidak
                        menggunakan system Take Profit (TP).<br>
                        7. Averaging, baik average up maupun average down dapat mmenggunakan signal /f swb dari Monika,
                        atau memperhatikan chart /cah xxxx dan /cas xxxx, dengan tetap memperhatikan money management
                        ketika melakukan entery averaging.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
    } else {
        echo $this->include('components/template_upgrade');
    }
?>
</div>