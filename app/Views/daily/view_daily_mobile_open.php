<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/daily.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/m/css/bootstrap.min.css">
    <style>
        .cke_top {
            display: none !important
        }
        .text-primary-ali {
        color: #145eab;
        font-weight:bold;
    }
    .text-success-ali {
        color: #0ec92d;
        font-weight:bold;
    }
    .text-danger-ali {
        color: #ec1c24;
        font-weight:bold;
    }
    </style>
</head>

<body>

    <div class="containeri">
        <div class="hd">
            <div class="hd-1">Monika Secret | Daily Stock | Open Position | <?= date('d / m / Y') ?></div>
        </div>
        <div class="pt-2">
            <table class="table table-striped table-bordered">
                <thead style="background-color: #ffd73a;">
                    <tr>
                        <th style="text-align: center; vertical-align:middle;">Stock <br> Buy Date</th>
                        <th style="text-align: center; vertical-align:middle;">Buy Price <br> Close Price</th>
                        <th style="text-align: center; vertical-align:middle;">Gain/Loss</th>
                        <th style="text-align: center; vertical-align:middle;">Resistance 1</th>
                        <th style="text-align: center; vertical-align:middle;">Resistance 2</th>
                        <th style="text-align: center; vertical-align:middle;">Stop Loss (SL) <br> % Jarak Ke SL</th>
                    </tr>
                </thead>
                <?php
                foreach ($all_data as $item) :
                ?>
                 <tr>
                    <td style="vertical-align:middle;">
                        <div>
                            <?= $item['stock']; ?>
                            <br>
                            <?= date('d/m/Y', strtotime($item['buy_date'])); ?>
                        </div>
                    </td>

                    <td style="vertical-align:middle;">
                        <?= number_format($item['buy_price'], 0, ',', '.'); ?>
                        <br>
                        <?php if($item['closed'] > $item['buy_price']) : ?>
                            <div class="text-success-ali">
                                <?= number_format($item['closed'], 0, ',', '.'); ?>
                            </div>
                        <?php elseif ($item['closed'] < $item['buy_price']) : ?>
                            <div class="text-danger-ali">
                                <?= number_format($item['closed'], 0, ',', '.'); ?>
                            </div>
                        <?php else : ?>
                            <div>
                                <?= number_format($item['closed'], 0, ',', '.'); ?>
                            </div>                                
                        <?php endif ?>
                    </td>

                    <td style="vertical-align:middle;">
                        <div style="" class="<?php 
                            if (strpos($item['gain_loss'], '+') !== false) {
                                echo 'ijo text-success-ali';
                            }	
                            else if (strpos($item['gain_loss'], '-') !== false) {
                                echo 'merah text-danger-ali';
                            }
                            else {
                                echo '';
                            }
                            ?>"
                        >
                            <?= $item['gain_loss']; ?>
                        </div>
                    </td>

                    <td style="vertical-align:middle;">
                        <?= $item['area_beli']; ?>
                    </td>

                    <td style="vertical-align:middle;">
                        <?= $item['area_jual']; ?>
                    </td>

                    <td style="vertical-align:middle;">
                        <?= number_format($item['stop_loss'], 0, ',', '.'); ?>
                        <br>
                        <?= $item['jarak_sl']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <hr>
        <div>
            <?php if (empty($content2)): ?>

            <?php else: ?>
                <div class="pt-2" id="keteranganDailyweb">
                    <?php
                        foreach ($content2 as $item2) :
                    ?>
                        <b style="color: black; font-family: Poppins; font-size:12px; font-weight:bold;"><?=  $item2['content']; ?></b>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

    <script type="text/javascript">
        CKEDITOR.replace('keteranganDailyweb', {
            height: 300,
        });

        CKEDITOR.instances.keteranganDailyweb.config.readOnly = true;
    </script>

</body>

</html>