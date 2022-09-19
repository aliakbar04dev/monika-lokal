<div class="col-lg-9">
    <?php
    if ($lvl != 'MULV002' && $lvl != 'MULV003') {
    ?>
        <div class="card mb-3">
            <div class="card-header">
                <h4 style="color: #fdc134;">Chart<samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
                <h5 class="pt-2" style="color: #000;">Fundamental Analysis</h5>
                <!-- <img class="pb-2 app" width="65%" alt="image" src="/public/assets/img/playstore.png"> -->
            </div>
            <div class="card-body pb-5" id="tempatgambar">
                <img id="defchartpic" alt="image" src="/public/assets/img/chartTA.png" style="width: 100%;">
                <div id="tempatchart">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body" style="background-color: #C1C1C1; border-radius:5px;">
                <form method="POST" id="showchartfa" class="needs-validation" novalidate="">
                    <div class="row pb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-10 pt-2">
                                    <input id="commandchart" type="text" class="form-control" name="commandchart" placeholder="Input Command" required autocomplete="off">
                                </div>
                                <div class="col-lg-2 pt-2">
                                    <button type="submit" style="width:auto;" class="boxed-save">
                                        Confirm
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 pt-4">
                            <samp>Daftar Perintah :</samp><br>
                            <div class="row">
                                <div class="col-lg-3 pt-2">
                                    <span>/ps1 = Chart PBV, PER, EPS Annual</span><br>
                                    <span>/ps2 = Chart PBV, PER, EPS Quartal</span><br>
                                    <span>/ps3 = Chart PBV, PER, ROE Annual</span><br>
                                    <span>/ps4 = Chart ROE, NPM, OPM, OCF</span><br>
                                    <span>/ps5 = Chart BVPS, EPS, Fwd EPS, RPS</span><br>
                                </div>
                                <div class="col-lg-4 pt-2">
                                    <span>/ps7 = Chart Total Asset, Total Liabilitas, Total Equity, DER</span><br>
                                    <span>/ps8 = Chart PER dan ROE</span><br>
                                    <span>/ps9 = Chart PBV dan ROA</span><br>
                                    <span>/ps10 = Chart PER dan Tabel Keuangan</span><br>
                                </div>
                                <div class="col-lg-5 pt-2">
                                    <div class="alert alert-dark">
                                        <samp>Contoh Perintah :</samp><br>
                                        <div class="col-lg-12">
                                            <samp>/ps1 UNTR = Chart PBV, PER, EPS Annual UNTR Daily
                                            </samp><br>
                                            <!-- <samp>/cah15 untr = Chart UNTR 15 menit</samp><br>
                                            <samp>/cah30 untr = Chart UNTR 30 menit</samp><br>
                                            <samp>30m = 30 menit</samp><br>
                                            <samp>/cahhh untr = Chart UNTR Hourly</samp><br>
                                            <samp>/cahdd untr = Chart UNTR Daily</samp><br>
                                            <samp>/cahww untr = Chart UNTR Weekly</samp><br>
                                            <samp>/cahmm untr = Chart UNTR Monthly</samp><br> -->
                                        </div>
                                    </div>
                                    <!-- <p class="att">Use both upper dan lowercase characters include at lease one
                                        symbol
                                        (#&^%$^^%etc) Don't use
                                        dictionary words</p> -->
                                    <!-- 
                                    <strong>Note : </strong>
                                    <samp>
                                        /cah tlkm w
                                    </samp><br>
                                    <samp>
                                        Keterangan : req chart cah, kode saham tlkm, interval weekly
                                    </samp> -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-12">
                            <samp>Daftar Interval :</samp><br>
                            <div class="row">
                                <div class="col-lg-3 pt-2">
                                    <span>/"Perintah"05 = 5 Menit</span><br>
                                    <span>/"Perintah"15 = 15 Menit</span><br>
                                    <span>/"Perintah"30 = 30 Menit</span><br>
                                </div>
                                <div class="col-lg-4 pt-2">
                                    <span>/"Perintah"hh = Hourly</span><br>
                                    <span>/"Perintah"dd = Daily</span><br>
                                    <span>/"Perintah"ww = Weekly</span><br>
                                    <span>/"Perintah"mm = Mountly</span><br>
                                </div>
                            </div>
                        </div> -->
                    </div>
            </div>
            </form>

        </div>
</div>
<?php
    } else {
        echo $this->include('components/template_upgrade');
    }
?>
</div>
<script>
    /*
    var demoTrigger = document.querySelector('.demo-trigger');

    new Drift(demoTrigger, {
        paneContainer: document.querySelector('.detail'),
        inlinePane: 900,
        inlineOffsetY: -85,
        containInline: true,
        sourceAttribute: 'href'
    });

    new Luminous(demoTrigger);*/
</script>