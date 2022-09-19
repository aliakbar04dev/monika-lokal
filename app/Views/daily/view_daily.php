<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/daily.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/m/css/bootstrap.min.css">
    <style>
        .cke_top {
            display: none !important
        }
    </style>
</head>

<body>

    <div class="containeri">
        <div class="hd">
            <div class="hd-1">Daily Stock Watchlist | <?= date('d / m / Y') ?></div>
        </div>
        <div class="pt-1">
            <?php foreach ($content as $item) :?>
            <?=  $item['content']; ?>
            <?php endforeach; ?>
        </div>
        <div class="pt-2">
            <table class="table table-striped table-bordered">
                <thead style="background-color: #ffd73a;">
                    <tr>
                        <th style="text-align: center;">Stock</th>
                        <th style="text-align: center;">Buy Date</th>
                        <th style="text-align: center;">Closed</th>
                        <th style="text-align: center;">Stop Loss</th>
                        <th style="text-align: center;">Resistance 1</th>
                        <th style="text-align: center;">Resistance 2</th>
                        <!-- <th style="text-align: center;">Type</th> -->
                    </tr>
                </thead>
                <?php
                foreach ($all_data as $item) :
                ?>
                <tr>
                    <td><?= $item['stock']; ?></td>
                    <td><?= date("d/m/Y", strtotime($item['buy_date'])) ?></td>
                    <td><?= $item['closed']; ?></td>
                    <td><?= $item['stop_loss']; ?></td>
                    <td><?= $item['area_beli']; ?></td>
                    <td><?= $item['area_jual']; ?></td>
                    <!-- <td><?= $item['type']; ?></td> -->
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <hr style="border: 1px solid #9A9A9A;">

        <?php if (empty($content2)): ?>

        <?php else: ?>
        <div class="pt-2" id="keteranganDailyweb">
            <?php
                    foreach ($content2 as $item2) :
                ?>
            <b
                style="color: black; font-family: Poppins; font-size:12px; font-weight:bold;"><?=  $item2['content']; ?></b>
            <?php endforeach; ?>
        </div>
        <?php endif ?>

        <br>

        <div class="pt-3">
            <div class="bg-danger" style="border-radius: 10px;">
                <p style="color: white; font-family: Poppins; font-size:12px; font-weight:bold;" class="p-2">
                    <strong>Disclaimer On</strong> <br> <i style="font-size:12px;">Pandangan diatas merupakan
                        pandangan dari PanenSAHAM, dan
                        kami tidak bertanggung jawab atas keuntungan atau kerugian yang diterima oleh investor dalam
                        bertransaksi. Semua keputusan ada di tangan investor</i>
                </p>
            </div>
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