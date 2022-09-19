<div class="col-lg-9">
    <?php
        if ($lvl == 'MULV001' || $lvl == 'MULV005') {
    ?>
    <div class="card mb-3">
        <div class="card-header">
            <h4 style="color: #fdc134;">Monika's Secret<samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h5 class="pt-2" style="color: #000;">Watchlist Data</h5>
        </div>
        <div class="card-body pb-5">
            <div class="hd">
            </div>
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-warning">
                            <tr class="head">
                                <td><strong>
                                        <div style="color: white;">Stock</div>
                                        <div style="color: white;">Market Cap</div>
                                    </strong>
                                </td>
                                <td><strong>
                                        <div style="color: white;">Buy Price</div>
                                        <div style="color: white;">Target Price</div>
                                    </strong>
                                </td>
                                <td>
                                    <strong style="color: white;">
                                        <div>Stop Loss</div>
                                        <div style="color: white;">Risk %</div>
                                    </strong>
                                </td>
                                <td>
                                    <strong style="color: white;">
                                        <div style="color: white;">Naration</div>
                                        <div style="color: white;">Action</div>
                                    </strong>
                                </td>
                            </tr>
                        </thead>
                        <?php
                            foreach ($all_data as $item) :
                            ?>
                        <tr>
                            <td>
                                <div><?= $item['stock']; ?></div>
                                <div class="biru"><?= $item['value']; ?></div>
                            </td>
                            <td>
                                <div><?= $item['buy_price']; ?></div>
                                <div class="biru"><?= $item['target_price']; ?></div>
                            </td>
                            <td>
                                <div><?= $item['stop_loss']; ?></div>
                                <div class="<?php 
                                    if (strpos($item['risk'], '+') !== false) {
                                        echo 'ijo';
                                    }	
                                    else if (strpos($item['risk'], '-') !== false) {
                                        echo 'merah';
                                    }
                                    else {
                                        echo 'biru';
                                    }
                                ?>">
                                    <!-- <?= $item['loss_profit']; ?> -->
                                </div>
                                <div class="merah"><?= $item['risk']; ?></div>
                            </td>
                            <td>
                                <div class="biru under"><?= $item['narration']; ?></div>
                                <!-- <div class="<?= $item['action'] == "BUY" ? 'ijo' : 'merah' ?>"><?= $item['action']; ?></div> -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>

            <br>
            <div class="bg-danger" style="border-radius: 10px;">
                <p style="color: white;" class="p-2">
                    <strong>Disclaimer On.</strong> <br> <i style="font-size: 14px;">Pandangan diatas merupakan
                        pandangan dari PanenSAHAM, dan
                        kami tidak bertanggung jawab atas keuntungan atau kerugian yang diterima oleh investor dalam
                        bertransaksi. Semua keputusan ada di tangan investor.</i>
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