<div class="col-lg-9">
    <?php
        if ($lvl == 'MULV001' || $lvl == 'MULV005') {
    ?>
    <div class="card mb-3">
        <div class="card-header">
            <h4 style="color: #ffd73a; font-size:14px; font-weight:bold;">Monika's Secret
                <samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp>
            </h4>
            <h4 style="color: #000; font-size:14px; font-weight:bold;">Daily Stock Watchlist
                <samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp>
            </h4>
            <h5 class="pt-2" style="color: #000; font-weight:bold; font-size:14px;">
                <!-- <?= date("d-m-Y", strtotime($tgl)) ?>  -->
                <?= date("d/m/Y") ?> 
            </h5>
        </div>
        <br>
        <div class="card-body pb-5">
            <div class="pt-2 ml-4" style="margin-top: -40px;">
                <?php foreach ($content as $item) :?>
                    <?=  $item['content']; ?>
                <?php endforeach; ?>
            </div>

            <hr style="border: 1px solid #9A9A9A;">

            <div class="pt-1">
                <div class="table-responsive text-center">
                    <table class="table table-striped table-bordered">
                        <thead style="background-color: #ffd73a;">
                            <tr>
                                <th style="color: black; font-size:12px; font-weight:bold;">Stock</th>
                                <th style="color: black; font-size:12px; font-weight:bold;">Buy Date</th>
                                <th style="color: black; font-size:12px; font-weight:bold;">Closed</th>
                                <th style="color: black; font-size:12px; font-weight:bold;">Stop Loss</th>
                                <th style="color: black; font-size:12px; font-weight:bold;">Resistance 1</th>
                                <th style="color: black; font-size:12px; font-weight:bold;">Resistance 2</th>
                                <!-- <th style="color: black; font-size:12px; font-weight:bold;">Type</th> -->
                            </tr>
                        </thead>
                        <?php foreach ($all_data as $item) : ?>
                            <tr>
                                <td style="font-size:12px; font-weight:bold;"><?= $item['stock']; ?></td>
                                <td style="font-size:12px; font-weight:bold;"><?= date("d/m/Y", strtotime($item['buy_date'])) ?></td>
                                <td style="font-size:12px; font-weight:bold;"><?= $item['closed']; ?></td>
                                <td style="font-size:12px; font-weight:bold;"><?= $item['stop_loss']; ?></td>
                                <td style="font-size:12px; font-weight:bold;"><?= $item['area_beli']; ?></td>
                                <td style="font-size:12px; font-weight:bold;"><?= $item['area_jual']; ?></td>
                                <!-- <td style="font-size:12px; font-weight:bold;"><?= $item['type']; ?></td> -->
                            </tr>
                        <?php endforeach; ?>
                    </table>
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
            </div>

            <hr style="border: 1px solid #9A9A9A;">

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

            <br>

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
</div>
<?php
    } else {
        echo $this->include('components/template_upgrade');
    }
?>
</div>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<script type="text/javascript">
    CKEDITOR.replace('keteranganDailyweb', {
        height: 300,
    });

    CKEDITOR.instances.keteranganDailyweb.config.readOnly = true;
</script>