<div class="col-lg-9">
    <?php
        if ($lvl == 'MULV001' || $lvl == 'MULV005') {
    ?>
    <div class="card mb-2">
        <div class="card-header">
            <h4 style="color: #ffd73a; font-family: Poppins; font-weight:bold; font-size:14px;">Monika's Secret <samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h4 style="color: #000; font-family: Poppins; font-weight:bold; font-size:14px;">Copy Trades<samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h5 class="pt-2" style="color: #000; font-family: Poppins; font-weight:bold; font-size:14px;">Watchlist Action</h5>
        </div>
        <div class="card-body pb-5">
            <div style="margin-top: -20px;" class="mb-3">
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('openweb') ?>'">
                    <font style="color:#612D11; font-family: Poppins; font-size:12px; font-weight:bold;">Open Position</font>
                </button>
                <button style="width:auto; background-color: #612D11; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('actionweb') ?>'">
                    <font style="color:#e8e5e5; font-family: Poppins; font-size:12px; font-weight:bold;">Watchlist Action</font>
                </button>
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('closedweb') ?>'">
                    <font style="color:#612D11; font-family: Poppins; font-size:12px; font-weight:bold;">Closed Position</font>
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
                                        <div class="biru text-primary-ali" style="font-family: Poppins; font-size:12px; font-weight:bold;">Value Rp</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-family: Poppins; font-size:12px; font-weight:bold;">Buy Price</div>
                                        <div class="biru text-primary-ali" style="font-family: Poppins; font-size:12px; font-weight:bold;">Target Price</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-family: Poppins; font-size:12px; font-weight:bold;">Stop Loss</div>
                                        <div class="merah text-danger-ali" style="font-family: Poppins; font-size:12px; font-weight:bold;">Risk %</div>
                                    </strong>
                                </th>
                                <th style="color: black;">
                                    <strong>
                                        <div style="font-family: Poppins; font-size:12px; font-weight:bold;">Story</div>
                                        <!-- <div class="biru text-primary-ali">Action</div> -->
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
                                <div class="biru text-primary-ali" style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['value']; ?></div>
                            </td>
                            <td>
                                <div style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['buy_price']; ?></div>
                                <div class="biru text-primary-ali" style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['target_price']; ?>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['stop_loss']; ?></div>
                                <div class="<?php 
                                    if (strpos($item['risk'], '+') !== false) {
                                        echo 'ijo text-success-ali';
                                    }	
                                    else if (strpos($item['risk'], '-') !== false) {
                                        echo 'merah text-danger-ali';
                                    }
                                    else {
                                        echo 'biru text-primary-ali';
                                    }
                                ?>">
                                </div>
                                <div class="merah text-danger-ali" style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['risk']; ?></div>
                            </td>
                            <td>
                                <div><a href="javascript:;" class="btn-detailstoryaction" data-id="<?= $item['kode_wtcaction'] ?>" style="cursor: pointer;"><u class="biru text-primary-ali under" style="font-weight:bold; font-family: Poppins; font-size:12px;"><?= $item['narration']; ?></u></a></div>
                                <!-- <div class="<?= $item['action'] == "BUY" ? 'ijo text-success-ali' : 'merah text-danger-ali' ?>"><?= $item['action']; ?></div> -->
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
            <div class="pt-2" id="keteranganActionweb">
                <?php
				foreach ($content as $item) :
			?>
                    <b style="color: black; font-family: Times New Roman;"><?=  $item['content']; ?></b>
                <?php endforeach; ?>
            </div>

            <div class="modal fade" id="modalOpenStory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><h2 id="stock"></h2> </h5>
                            <button type="button" data-dismiss="modal" class="boxed-save btn-sm" style="width:auto; background-color: rgba(255, 0, 0, 0.8); border-radius:50px; padding:10px; margin-top:-11px;">
                                <font style="color:#fff;">Close</font>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea id="desc_narration" name="desc_narration"></textarea>
                        </div>
                    </div>
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
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script type="text/javascript">

    CKEDITOR.replace('desc_narration', {
        height: 400,
    });

    CKEDITOR.replace('keteranganActionweb', {
        height: 400,
    });

    CKEDITOR.instances.desc_narration.config.readOnly = true;
    CKEDITOR.instances.keteranganActionweb.config.readOnly = true;


    $(document).on('click', '.btn-detailstoryaction', function(){
        var item_id = $(this).data('id');
        // console.log(item_id);
        $.ajax({
            url: "/actionstorydetail",
            type: 'post',
            dataType: "json",
            data: {
                id: item_id
            },
            success: function(response){
                $('#stock').text('Stock : ' + response.success.stock);
                CKEDITOR.instances.desc_narration.setData(response.success.desc_narration);
                
                $('#modalOpenStory').modal('show');
            }
        })
    })

</script>
