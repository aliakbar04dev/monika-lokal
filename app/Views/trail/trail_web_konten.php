<div class="col-lg-9">
<?php
    if ($lvl == 'MULV001' || $lvl == 'MULV005') {
?>
    <div class="card mb-3">
        <div class="card-header">
            <h4 style="color: #fdc134; font-family:lato; font-weight:bold;">Monika's Secret <samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h4 style="color: #000; font-family:lato; font-weight:bold;">Trailling Stop<samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h5 class="pt-2" style="color: #000; font-family:lato; font-weight:bold;"><?= date('d/m/Y') ?></h5>

        </div>
        <div class="card-body pb-5">
            <div class="hd">
            </div>
            <div class="pt-1">
                <div class="table-responsive text-center">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-warning">
                            <tr>
                                <th style="color: black;">
                                    <div>Stock</div>
                                    <div>Buy Date</div>
                                </th>
                                <th style="color: black;">
                                    <div>Buy Price</div>
                                    <div>Close Price</div>
                                </th>
                                <th style="color: black;">
                                    Gain/loss
                                </th>
                                <th style="color: black;">
                                    <div>Trailling Stop (TS)</div>
                                    <div>% Jarak Ke TS</div>
                                </th>
                                <th style="color: black;">
                                    Syariah
                                </th>
                            </tr>
                        </thead>
                        <?php
                            foreach ($all_data as $item) :
                            ?>
                        <tr>
                            <td><?= $item['stock']; ?><br><?= date('d/m/Y', strtotime($item['buy_date'])); ?></td>
                            <td><?= number_format($item['buy_price'], 0, ',', '.'); ?><br>
                                <div class="<?= $item['close_price'] > $item['buy_price'] ? 'text-success-ali' : 'text-danger-ali' ?>"
                                    style="font-weight: bold;">
                                    <?= number_format($item['close_price'], 0, ',', '.'); ?></div>
                            </td>
                            <td><?= $item['gain_loss']; ?></td>
                            <td><?= number_format($item['trailing_stop'], 0, ',', '.'); ?><br><?= $item['jarak_ts']; ?>
                            </td>
                            <td><?= $item['is_syariah']; ?></td>
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
            <br />
            <div class="pt-2">
                <!-- <?php
				foreach ($content as $item) :
			?>
                <?=  $item['content']; ?>
                <?php endforeach; ?> -->
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