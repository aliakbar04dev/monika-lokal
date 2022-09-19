<div class="col-lg-9">
    <?php
        if ($lvl == 'MULV001' || $lvl == 'MULV005') {
    ?>
    <div class="card mb-3">
        <div class="card-header">
            <h4 style="color: #ffd73a; font-family: Poppins; font-weight:bold; font-size:14px;">Monika's Secret <samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h4 style="color: #000; font-family: Poppins; font-weight:bold; font-size:14px;">Copy Trades<samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h5 class="pt-2" style="color: #000; font-family: Poppins; font-weight:bold; font-size:14px;">Closed Position</h5>
        </div>
        <div class="card-body pb-5">
            <div style="margin-top: -20px;" class="mb-3">
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('openweb') ?>'">
                    <font style="color:#612D11; font-family: Poppins; font-size:12px; font-weight:bold;">Open Position</font>
                </button>
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('actionweb') ?>'">
                    <font style="color:#612D11; font-family: Poppins; font-size:12px; font-weight:bold;">Watchlist Action</font>
                </button>

                <button style="width:auto; background-color: #612D11; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('closedweb') ?>'">
                    <font style="color:#e8e5e5; font-family: Poppins; font-size:12px; font-weight:bold;">Closed Position</font>
                </button>
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('factsheetweb') ?>'">
                    <font style="color:#612D11; font-family: Poppins; font-size:12px; font-weight:bold;">Performa Copy Trade</font>
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
                    <table class="table table-striped table-bordered">
                        <thead style="background-color: #ffd73a;">
                            <tr>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-family: Poppins; font-size:12px; font-weight:bold;">Stock</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-family: Poppins; font-size:12px; font-weight:bold;">Buy Price</div>
                                        <div class="biru text-primary-ali" style="font-family: Poppins; font-size:12px; font-weight:bold;">Sell Price</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-family: Poppins; font-size:12px; font-weight:bold;">Buy Date</div>
                                        <div class="biru text-primary-ali" style="font-family: Poppins; font-size:12px; font-weight:bold;">Sell Date</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div class="biru text-primary-ali" style="font-family: Poppins; font-size:12px; font-weight:bold;">Profit</div>
                                        <div style="font-family: Poppins; font-size:12px; font-weight:bold;">Days Hold</div>
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                        <?php
                    foreach ($all_data as $item) :
                    ?>
                        <tr>
                            <td>
                                <div style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['stock']; ?></div>
                            </td>
                            <td>
                                <div style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['buy_price']; ?></div>
                                <div class="biru text-primary-ali" style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['sell_price']; ?></div>
                            </td>
                            <td>
                                <div style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= date('d/m/Y', strtotime($item['buy_date'])); ?></div>
                                <div class="biru text-primary-ali" style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= date('d/m/Y', strtotime($item['sell_date'])); ?></div>
                            </td>
                            <td>
                                <div style="font-weight:bold; font-family: Poppins; font-size:12px;" class="<?php 
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
                                <div style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['days_hold']; ?></div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>

            <br>
            <div class="bg-danger" style="border-radius: 10px;">
                <p style="color: white; font-family: Poppins; font-size:12px; font-weight:bold;" class="p-2">
                    <strong>Disclaimer On</strong> <br> <i style="font-size:12px;">Pandangan diatas merupakan
                        pandangan dari PanenSAHAM, dan
                        kami tidak bertanggung jawab atas keuntungan atau kerugian yang diterima oleh investor dalam
                        bertransaksi. Semua keputusan ada di tangan investor</i>
                </p>
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
    </div>
</div>
<?php
        } else {
            echo $this->include('components/template_upgrade');
        }
    ?>
</div>