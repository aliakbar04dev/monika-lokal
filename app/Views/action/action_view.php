<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/daily.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/m/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/m/js/bootstrap.min.js">
    <!-- <link href="<?= base_url() ?>/public/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/public/assets/css/responsive.bootstrap4.min.css" rel="stylesheet" /> -->
</head>
<style type="text/css">
    .cke_top
    {
        display: none !important;
    }
</style>
<body>

    <div class="containeri">
        <div class="containeri">
            <div class="row">
                <!-- <div class="col pb-1">
                    <div class="head-table">showing
                        <select id="country" name="country">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                        of 100 entries
                    </div>
                </div> -->

                <div class="col pb-1">
                    <div class="head-table float-right">
                        <!--   <a class="paginate" href="#">prev</a>
                        <a class="paginate" href="">1</a>
                        <a class="paginate" href="">2</a>
                        <a class="paginate" href="">3</a>
                        <a class="paginate" href="">4</a>
                        <a class="paginate" href="">...</a>
                        <a class="paginate" href="#">last</a> -->
                        <?= $pager->links('btaction', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-1">

            <table>
                <tr class="head">
                    <td><strong>
                            <div>Stock</div>
                            <div class="biru">Value Rp</div>
                        </strong>
                    </td>
                    <td><strong>
                            <div>Buy Price</div>
                            <div class="biru">Target Price</div>
                        </strong>
                    </td>
                    <td>
                        <strong>
                            <div>Stop Loss</div>
                            <div class="merah">Risk %</div>
                        </strong>
                    </td>
                    <td>
                        <strong>
                            <div>Story</div>
                            <!-- <div class="biru">Action</div> -->
                        </strong>
                    </td>
                </tr>
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
                                        } else if (strpos($item['risk'], '-') !== false) {
                                            echo 'merah';
                                        } else {
                                            echo 'biru';
                                        }
                                        ?>">
                            </div>
                            <div class="merah"><?= $item['risk']; ?></div>
                        </td>
                        <td>
                            <div><a href="javascript:;" class="btn-detailstoryaction" data-toggle="modal" data-target="#onomodal" data-id="<?= $item['kode_wtcaction'] ?>" style="cursor: pointer;"><u class="biru text-primary-ali under" style="font-weight: bold;"><?= $item['narration']; ?></u></a></div>
                            <!-- <div class="<?= $item['action'] == "BUY" ? 'ijo' : 'merah' ?>"><?= $item['action']; ?></div> -->
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
                <?= $item['content']; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="modal fade" id="onomodal" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSayaLabel">
                        <h2 id="stock"></h2>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea id="desc_narration1" name="desc_narration1" readonly></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="<?= base_url() ?>/public/assets/m/js/jquery.js"></script>
<script src="<?= base_url() ?>/public/assets/m/js/popper.js"></script>
<script src="<?= base_url() ?>/public/assets/m/js/bootstrap.js"></script>

<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('desc_narration1', {
        height: 400,
    });

    $(document).on('click', '.btn-detailstoryaction', function() {
        var item_id = $(this).data('id');
        // console.log(item_id);
        $.ajax({
            url: "/actionstorydetail",
            type: 'post',
            dataType: "json",
            data: {
                id: item_id
            },
            success: function(response) {
                // console.log(response);
                $('#stock').text('Stock : ' + response.success.stock);
                CKEDITOR.instances.desc_narration1.setData(response.success.desc_narration);
                $('#modalOpenStory').modal('show');
            }
        })
    })
</script>

</html>