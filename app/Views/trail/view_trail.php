<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/daily.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/m/css/bootstrap.min.css">
</head>

<body>

    <div class="containeri">
        <div class="hd">
            <div class="hd-1">
                <a>Trailling Open MONIKA</a>
                <a class="float-right"><?= date('d / m / Y') ?></a>
            </div>
        </div>
        <div class="pt-1">
            <table class="table table-striped table-bordered">
                <tr style="background-color: #ffd73a;">
                    <td>
						<div>Stock</div> 
						<div>Buy Date</div>
					</td>
                    <td>
						<div>Buy Price</div>
						<div>Close Price</div>
					</td>
                    <td>Gain/loss</td>
                    <td>
						<div>Trailling Stop (TS)</div>
						<div>% Jarak Ke TS</div>
					</td>
                    <td>Syariah</td>
                </tr>
                <!-- <tr>
                    <td>MAPA<br>01/09/2021</td>
                    <td>22.501<br>
                        <div class="ijo">20.000</div>
                    </td>
                    <td>- 10%</td>
                    <td>19.000<br>-3,4%</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>SMBR<br>01/09/2021</td>
                    <td>22.501<br>
                        <div class="merah">20.000</div>
                    </td>
                    <td>- 10%</td>
                    <td>19.000<br>-3,4%</td>
                    <td>Yes</td>
                </tr> -->
                <?php 
                    foreach($all_data as $item): 
				?>
                    <tr>
                        <td><?= $item['stock']; ?><br><?= date('d/m/Y', strtotime($item['buy_date'])); ?></td>
                        <td><?= number_format($item['buy_price'], 0, ',', '.'); ?><br>
                            <div class="<?= $item['close_price'] > $item['buy_price'] ? 'ijo' : 'merah' ?>"><?= number_format($item['close_price'], 0, ',', '.'); ?></div>
                        </td>
                        <td><?= $item['gain_loss']; ?></td>
                        <td><?= number_format($item['trailing_stop'], 0, ',', '.'); ?><br><?= $item['jarak_ts']; ?></td>
                        <td><?= $item['is_syariah']; ?></td>
					</tr>
				<?php endforeach; ?>
            </table>
        </div>
        <div class="containeri">
            <div class="row">
                <div class="col-12 kecil">
                    <strong>Cara Trading pada Trailing Stop Monika (TS Monika) :</strong><br>
                    1. TSMon diupgrade pada EOD, buy dan sell pada opening hari berikutnya.<br>
                    2. Buy saham sedekat mungkin dengan Harga Beli.<br>
                    3. TSMon hold maksimal 10 saham, buy saham baru hanya dilakukan apabila ada saham terdahulu yang kena Trailing Stop.<br>
                    4. Gunakan Money Management yang anda pahami sebelum entry.<br>
                    5. Trailing Stop Price akan berfungsi sebagai Cutloss Price apabila belum melewati harga beli pertama.<br>
                    6. TSMon menggunakan system buy and hold until Trailling stop hit, sehingga TS Monika tidak menggunakan system Take Profit (TP).<br>
                    7. Averaging, baik average up maupun average down dapat mmenggunakan signal /f swb dari Monika, atau memperhatikan chart /cah xxxx dan /cas xxxx, dengan tetap memperhatikan money management ketika melakukan entery averaging.
                </div>
            </div>
        </div>
        <br/>
        <div class="pt-2">
			<?php
				foreach ($content as $item) :
			?>
				<?=  $item['content']; ?>
			<?php endforeach; ?>
        </div> 
    </div>

</body>

</html>