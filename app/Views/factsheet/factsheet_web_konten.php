<div class="col-lg-9">
    <?php
        if ($lvl == 'MULV001' || $lvl == 'MULV005') {
    ?>
    <div class="card mb-3">
        <div class="card-header">
            <h4 style="color: #ffd73a; font-family: Poppins; font-weight:bold; font-size:14px;">Monika's Secret <samp
                    style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
            <h4 style="color: #000; font-family: Poppins; font-weight:bold; font-size:14px;">
                Copy Trades
                <samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp>
            </h4>
            <h5 class="pt-2" style="color: #000; font-family: Poppins; font-weight:bold; font-size:14px;">Performa Copy Trade</h5>
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
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('closedweb') ?>'">
                    <font style="color:#612D11; font-family: Poppins; font-size:12px; font-weight:bold;">Closed Position</font>
                </button>
                <button style="width:auto; background-color: #612D11; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('factsheetweb') ?>'">
                    <font style="color:#e8e5e5; font-family: Poppins; font-size:12px; font-weight:bold;">Performa Copy Trade</font>
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
                <div class="row">
                    <div class="col-lg-4">
                        <form action="factsheetperiode" method="POST">
                            <div class="form-group">
                                <?php
                                    $now = date('Y');
                                    echo '<select class="form-control" id="factsheet_tahun" name="factsheet_tahun" style="font-family: Poppins; font-size:12px; font-weight:bold;">';
                                    echo "<option value=''>Pilih Periode</option>";
                                    for ($i = date('Y'); $i >= 2019; $i--)
                                    {
                                        echo "<option value='$i'> $i </option>";
                                    }
                                    echo "</select>";
                                ?>
                            </div>
                            <button type="submit" style="background-color: #612D11;" class="boxed-save btn btn-sm">
                                <font style="color:#fff; font-weight:bold; font-family: Poppins; font-size:12px;">Tampilkan</font>
                            </button>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <div class="table-responsive text-center">
                            <table class="table table-striped table-bordered">
                                <thead style="background-color: #ffd73a;">
                                    <tr>
                                        <th style="color: black;">
                                            <strong style="font-family: Poppins; font-size:12px; font-weight:bold;">
                                                <div>Performa Copy Trade</div>
                                            </strong>
                                        </th>
                                        <th style="color: black;">
                                            <strong style="font-family: Poppins; font-size:12px; font-weight:bold;">
                                                <div>Action</div>
                                            </strong>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_data as $item) : ?>
                                        <tr>
                                            <td>
                                                <div style="font-weight:bold; font-family: Poppins; font-size:12px; color:#612D11;">MONIKA Copy Trade <?= substr($item['bulan'], 2); ?> <?= $item['tahun'] ?></div>
                                            </td>
                                            <td style="color: black; vertical-align:middle;">
                                                <?php if ($item['berkas'] == ""): ?>
                                                    -
                                                <?php else: ?>
                                                    <button onclick="window.open('<?= 'https://monika.panensaham.com/backend/public/assets/img/factsheet/'.$item['berkas'] ?>')" style="background-color: #612D11;" class="boxed-save btn btn-sm mb-2 mt-1 mr-2">
                                                        <font style="color:#fff; font-weight:bold; font-family: Poppins; font-size:12px;">Baca</font>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        </div>
    </div>
</div>
<?php
        } else {
            echo $this->include('components/template_upgrade');
        }
    ?>


</div>


