<div class="col-lg-9">
    <?php
        if ($lvl == 'MULV001' || $lvl == 'MULV005') {
    ?>
    <div class="card mb-3">
        <div class="card-header">
            <h4 style="color: #ffd73a; font-size:14px; font-weight:bold;">Monika's Secret
                <samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp>
            </h4>
            <h4 style="color: #000; font-size:14px; font-weight:bold;">Daily Stock
                <samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp>
            </h4>
            <h4 style="color: #000; font-size:14px; font-weight:bold;">Open Position</h4>
        </div>
        <br>
        <div class="card-body pb-5">
            <div style="margin-top: -40px;" class="mb-4">
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebihsg') ?>'">
                    <font style="color:#612D11; font-size:12px; font-weight:bold;">IHSG</font>
                </button>
                <button style="width:auto; background-color: #612D11; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebopen') ?>'">
                    <font style="color:#e8e5e5; font-size:12px; font-weight:bold;">Open Position</font>
                </button>
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebclosed') ?>'">
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
                                <th style="color: black; font-size:12px; font-weight:bold;">
                                    Resistance 1
                                </th>
                                <th style="color: black; font-size:12px; font-weight:bold;">
                                    Resistance 2
                                </th>
                                <th style="color: black;">
                                    <div style="font-size:12px; font-weight:bold;">Stop Loss (SL)</div>
                                    <div style="font-size:12px; font-weight:bold;">% Jarak Ke SL</div>
                                </th>
                            </tr>
                        </thead>
                        <?php
                            foreach ($all_data as $item) :
                        ?>
                        <tr>
                            <td style="font-size:12px; font-weight:bold;">
                                <?= $item['stock']; ?>
                                <br>
                                <?= date('d/m/Y', strtotime($item['buy_date'])); ?>
                            </td>
                            <td style="font-size:12px; font-weight:bold;">
                                <?= number_format($item['buy_price'], 0, ',', '.'); ?>
                                <br>
                                <?php if($item['closed'] > $item['buy_price']) : ?>
                                    <div class="text-success-ali" style="font-weight: bold;">
                                        <?= number_format($item['closed'], 0, ',', '.'); ?>
                                    </div>
                                <?php elseif ($item['closed'] < $item['buy_price']) : ?>
                                    <div class="text-danger-ali" style="font-weight: bold;">
                                        <?= number_format($item['closed'], 0, ',', '.'); ?>
                                    </div>
                                <?php else : ?>
                                    <div style="font-weight: bold;">
                                        <?= number_format($item['closed'], 0, ',', '.'); ?>
                                    </div>                                
                                <?php endif ?>
                            </td>
                            <td style="font-size:12px; font-weight:bold;">
                                <div style="font-size:12px; font-weight:bold;" class="<?php 
                                    if (strpos($item['gain_loss'], '+') !== false) {
                                        echo 'ijo text-success-ali';
                                    }	
                                    else if (strpos($item['gain_loss'], '-') !== false) {
                                        echo 'merah text-danger-ali';
                                    }
                                    else {
                                        echo 'biru';
                                    }
                                    ?>"
                                >
                                    <?= $item['gain_loss']; ?>
                                </div>
                            </td>
                            <td style="font-size:12px; font-weight:bold;"><?= $item['area_beli']; ?></td>
                            <td style="font-size:12px; font-weight:bold;"><?= $item['area_jual']; ?></td>
                            <td style="font-size:12px; font-weight:bold;">
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