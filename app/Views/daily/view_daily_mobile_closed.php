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
            <div class="hd-1">Monika Secret | Daily Stock | Closed Position | <?= date('d / m / Y') ?></div>
        </div>
        <div class="pt-2">
            <table class="table table-striped table-bordered">
                <thead style="background-color: #ffd73a;">
                    <tr>
                        <th style="text-align: center; vertical-align:middle;">Stock</th>
                        <th style="text-align: center; vertical-align:middle;">Buy Price <br> Sell Price</th>
                        <th style="text-align: center; vertical-align:middle;">Buy Date <br> Sell Date</th>
                        <th style="text-align: center; vertical-align:middle;">Gain/Loss</th>
                        <th style="text-align: center; vertical-align:middle;">Target</th>
                        <th style="text-align: center; vertical-align:middle;">Hit / Miss</th>
                        <th style="text-align: center; vertical-align:middle;">Highest</th>
                    </tr>
                </thead>
                <?php
                foreach ($all_data as $item) :
                ?>
                 <tr>
                    <td style="vertical-align:middle;">
                        <div style=""><?= $item['stock']; ?></div>
                    </td>

                    <td style="vertical-align:middle;">
                        <div style=""><?= number_format($item['buy_price'], 0, ',', '.'); ?></div>

                        <?php if($item['sell_price'] > $item['buy_price']) : ?>
                            <div class="text-success-ali" style="font-weight: bold;">
                                <?= number_format($item['sell_price'], 0, ',', '.'); ?>
                            </div>
                        <?php elseif ($item['sell_price'] < $item['buy_price']) : ?>
                            <div class="text-danger-ali" style="font-weight: bold;">
                                <?= number_format($item['sell_price'], 0, ',', '.'); ?>
                            </div>
                        <?php else : ?>
                            <div style="font-weight: bold;">
                                <?= number_format($item['sell_price'], 0, ',', '.'); ?>
                            </div>                                
                        <?php endif ?>

                    </td>

                    <td style="vertical-align:middle;">
                        <div style=""><?= date('d/m/Y', strtotime($item['buy_date'])); ?></div>
                        <div style=""><?= date('d/m/Y', strtotime($item['sell_date'])); ?></div>
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
                                echo 'biru';
                            }
                        ?>">
                            <?= $item['gain_loss']; ?>
                        </div>
                    </td>

                    <td style="vertical-align:middle;">
                        <div style=""><?= $item['target']; ?></div>
                    </td>

                    <td style="vertical-align:middle;">
                        <div style="">
                            <?php if($item['hit_miss'] == 'hit') : ?>
                                <div class="text-success-ali" style="font-weight: bold;">
                                    <?= strtoupper($item['hit_miss']) ?>
                                </div>
                            <?php elseif ($item['hit_miss'] == 'miss') : ?>
                                <div class="text-danger-ali" style="font-weight: bold;">
                                    <?= strtoupper($item['hit_miss']) ?>
                                </div>
                            <?php else : ?>
                                error
                            <?php endif ?>

                        </div>
                    </td>

                    <td style="vertical-align:middle;">
                        <div style=""><?= $item['highest']; ?></div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
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