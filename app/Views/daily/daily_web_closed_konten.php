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
            <h4 style="color: #000; font-size:14px; font-weight:bold;">Closed Position</h4>
        </div>
        <br>
        <div class="card-body pb-5">
            <div style="margin-top: -40px;" class="mb-4">
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebihsg') ?>'">
                    <font style="color:#612D11; font-size:12px; font-weight:bold;">IHSG</font>
                </button>
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebopen') ?>'">
                    <font style="color:#612D11; font-size:12px; font-weight:bold;">Open Position</font>
                </button>
                <button style="width:auto; background-color: #612D11; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebclosed') ?>'">
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
                                        <div style="font-size:12px; font-weight:bold;">Sell Price</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-size:12px; font-weight:bold;">Buy Date</div>
                                        <div style="font-size:12px; font-weight:bold;">Sell Date</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-size:12px; font-weight:bold;">Gain/Loss</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-size:12px; font-weight:bold;">Target</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-size:12px; font-weight:bold;">Hit/Miss</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-size:12px; font-weight:bold;">Highest</div>
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
                                <div style="font-size:12px; font-weight:bold;"><?= number_format($item['buy_price'], 0, ',', '.'); ?></div>

                                <?php if($item['sell_price'] > $item['buy_price']) : ?>
                                    <div class="text-success-ali" style="font-size:12px; font-weight: bold;">
                                        <?= number_format($item['sell_price'], 0, ',', '.'); ?>
                                    </div>
                                <?php elseif ($item['sell_price'] < $item['buy_price']) : ?>
                                    <div class="text-danger-ali" style="font-size:12px; font-weight: bold;">
                                        <?= number_format($item['sell_price'], 0, ',', '.'); ?>
                                    </div>
                                <?php else : ?>
                                    <div style="font-size:12px; font-weight: bold;">
                                        <?= number_format($item['sell_price'], 0, ',', '.'); ?>
                                    </div>                                
                                <?php endif ?>

                            </td>
                            <td>
                                <div style="font-size:12px; font-weight:bold;"><?= date('d/m/Y', strtotime($item['buy_date'])); ?></div>
                                <div style="font-size:12px; font-weight:bold;"><?= date('d/m/Y', strtotime($item['sell_date'])); ?></div>
                            </td>
                            <td>
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
                                ?>">
                                    <?= $item['gain_loss']; ?>
                                </div>
                            </td>
                            <td>
                                <div style="font-size:12px; font-weight:bold;"><?= $item['target']; ?></div>
                            </td>
                            <td>
                                <div style="font-size:12px; font-weight:bold;">
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
                            <td>
                                <div style="font-size:12px; font-weight:bold;"><?= $item['highest']; ?></div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
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