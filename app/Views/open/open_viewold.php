<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/daily.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/m/css/bootstrap.min.css">
</head>

<body>

    <div class="containeri">
        <div class="containeri">
            <div class="row">
                <div class="col pb-1">
                    <div class="head-table">showing
                        <select id="country" name="country">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                        of 100 entries
                    </div>
                </div>

                <div class="col pb-1">
                    <div class="head-table float-right">
                        <a class="paginate" href="#">prev</a>
                        <a class="paginate" href="">1</a>
                        <a class="paginate" href="">2</a>
                        <a class="paginate" href="">3</a>
                        <a class="paginate" href="">4</a>
                        <a class="paginate" href="">...</a>
                        <a class="paginate" href="#">last</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-1">
            <table>
                <tr class="head">
                    <td><strong>
                            <div>Stock</div>
                            <div class="biru">Buy Date</div>
                        </strong>
                    </td>
                    <td><strong>
                            <div>Buy Price</div>
                            <div class="biru">Target Price</div>
                        </strong>
                    </td>
                    <td>
                        <strong>
                            <div>Last Price</div>
                            <div class="merah">Loss/Profit %</div>
                        </strong>
                    </td>
                    <td>
                        <strong>
                            <div>Naration</div>
                            <div class="biru">Stop Loss</div>
                        </strong>
                    </td>
                </tr>
            <!-- <tr>
                    <td>
                        <div>TLKM</div>
                        <div class="biru">374.46T</div>
                    </td>
                    <td>
                        <div>22,501</div>
                        <div class="biru">20,000</div>
                    </td>
                    <td>
                        <div>19,000</div>
                        <div class="merah">-3,4%</div>
                    </td>
                    <td>
                        <div class="biru under">Right Issue</div>
                        <div class="biru">No Action</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>BBNI</div>
                        <div class="biru">374.46T</div>
                    </td>
                    <td>
                        <div>2250</div>
                        <div class="biru">2000</div>
                    </td>
                    <td>
                        <div>19,000</div>
                        <div class="merah">-3,4%</div>
                    </td>
                    <td>
                        <div class="biru under">Corp. Action</div>
                        <div class="biru">Buy</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>BBRI</div>
                        <div class="biru">374.46T</div>
                    </td>
                    <td>
                        <div>2250</div>
                        <div class="biru">2000</div>
                    </td>
                    <td>
                        <div>19,000</div>
                        <div class="merah">-3,4%</div>
                    </td>
                    <td>
                        <div class="biru under">Right Issue</div>
                        <div class="merah">Sell</div>
                    </td>
                </tr> -->
            
            <?php
                foreach ($all_data as $item) :
                ?>
                <tr>
                    <td>
                        <div><?= $item['stock']; ?></div>
                        <div class="biru"><?= date('d/m/Y', strtotime($item['buy_date'])); ?></div>
                    </td>
                    <td>
                        <div><?= $item['buy_price']; ?></div>
                        <div class="biru"><?= $item['target_price']; ?></div>
                    </td>
                    <td>
                        <div><?= $item['last_price']; ?></div>
                        <div class="<?php 
							if (strpos($item['loss_profit'], '+') !== false) {
								echo 'ijo';
							}	
							else if (strpos($item['loss_profit'], '-') !== false) {
								echo 'merah';
							}
							else {
								echo 'biru';
							}
						?>">
							<?= $item['loss_profit']; ?>
						</div>
                    </td>
                    <td>
                        <div class="biru under"><?= $item['narration']; ?></div>
                        <div class="merah"><?= $item['stop_loss']; ?></div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table> 
        </div>
        <div class="containeri">
            <div class="col kecil card-red">
                <strong>Disclaimer On.</strong> <a class="italic putih">Pandangan diatas merupakan pandangan dari PanenSAHAM, dan kami tidak bertanggung jawab atas keuntungan atau kerugian yang diterima oleh investor dalam bertransaksi. Semua keputusan ada di tangan investor.</a>
            </div>
        </div>
        <br />
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