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
            <h4 style="color: #000; font-size:14px; font-weight:bold;">Closed Position<samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h5 class="pt-2" style="color: #000; font-weight:bold; font-size:14px;"><?= date('d/m/Y') ?></h5>

        </div>
        <div class="card-body pb-5">
            <div style="margin-top: -20px;" class="mb-3">
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('trailopenweb') ?>'">
                    <font style="color:#612D11; font-size:12px; font-weight:bold;">Open Position</font>
                </button>
                <button style="width:auto; background-color: #612D11; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('trailclosedweb') ?>'">
                    <font style="color:#e8e5e5; font-size:12px; font-weight:bold;">Closed Position</font>
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
                                    <strong>
                                        <div style="font-size:12px; font-weight:bold;">Stock</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-size:12px; font-weight:bold;">Buy Price</div>
                                        <div class="biru text-primary-ali" style="font-size:12px; font-weight:bold;">Sell Price</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-size:12px; font-weight:bold;">Buy Date</div>
                                        <div class="biru text-primary-ali" style="font-size:12px; font-weight:bold;">Sell Date</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div class="biru text-primary-ali" style="font-size:12px; font-weight:bold;">Profit</div>
                                        <div style="font-size:12px; font-weight:bold;">Days Hold</div>
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                        <?php
                            foreach ($all_data as $item) :
                        ?>
                        <tr>
                            <td>
                                <div style="font-size:12px; font-weight:bold;"><?= $item['stock']; ?></div>
                            </td>
                            <td>
                                <div style="font-size:12px; font-weight:bold;"><?= $item['buy_price']; ?></div>
                                <div class="biru text-primary-ali" style="font-size:12px; font-weight:bold;"><?= $item['sell_price']; ?></div>
                            </td>
                            <td>
                                <div style="font-size:12px; font-weight:bold;"><?= date('d/m/Y', strtotime($item['buy_date'])); ?></div>
                                <div class="biru text-primary-ali" style="font-size:12px; font-weight:bold;"><?= date('d/m/Y', strtotime($item['sell_date'])); ?></div>
                            </td>
                            <td>
                                <div style="font-size:12px; font-weight:bold;" class="<?php 
                                    if (strpos($item['profit'], '+') !== false) {
                                        echo 'ijo text-success-ali';
                                    }	
                                    else if (strpos($item['profit'], '-') !== false) {
                                        echo 'merah text-danger-ali';
                                    }
                                    else {
                                        echo 'biru text-primary-ali';
                                    }
                                ?>">
                                    <?= $item['profit']; ?>
                                </div>
                                <div style="font-size:12px; font-weight:bold;"><?= $item['days_hold']; ?></div>
                            </td>
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