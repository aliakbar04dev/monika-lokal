<div class="col-lg-9">
    <?php
    // if ($lvl != 'MULV002' && $lvl != 'MULV004') {
    if ($lvl != 'MULV004') {
    ?>
        <div class="card mb-3">
            <div class="card-header">
                <h4 style="color: #fdc134; font-family: 'Poppins';">Chart<samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
                <h5 class="pt-2" style="color: #000; font-family: 'Poppins';">Analisa Teknikal</h5>
                <!-- <img class="pb-2 app" width="65%" alt="image" src="/public/assets/img/playstore.png"> -->
            </div>
            <div class="card-body pb-5" id="tempatgambar">
                <img id="defchartpic" alt="image" src="/public/assets/img/chartTA.png" style="width: 100%;">
                <div id="tempatchart">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body" style="background-color: #dbdbdb; border-radius:5px;">
                <form method="POST" id="showchart" class="needs-validation" novalidate="">
                    <div class="row pb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <!-- <div class="col-lg-10 pt-2">
                                    <input id="commandchart" type="text" class="form-control" name="commandchart" placeholder="Input Command" required autocomplete="off">
                                </div>
                                <div class="col-lg-2 pt-2">
                                    <button type="submit" style="width:auto;" class="boxed-save">
                                        Confirm
                                    </button>
                                </div> -->
                                <select class="custom-select col-4" name="daftar" id="daftar" style="font-family:Poppins;" required>
                                    <!-- <option value="" disabled selected hidden>Pilih Perintah</option> -->
                                    <?php
                                    foreach ($cht as $c) {
                                        echo '<option value="' . $c['kode_chart'] . '">' . $c['deskripsi'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="text" class="form-control col-4" name="simbol" id="simbol" placeholder="Masukan Kode Saham" style="font-family:Poppins;" required>
                                </input>
                                <select class="custom-select col-4" name="interval" id="interval" style="font-family:Poppins;" required>
                                    <!-- <option value="" disabled selected hidden>Pilih Interval</option> -->
                                    <option value="dd">dd</option>
                                    <option value="05">05</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="hh">hh</option>
                                    <option value="ww">ww</option>
                                    <option value="mm">mm</option>
                                </select>
                                <button type="submit" style="width:100%;" class="boxed-save mt-2">
                                    <b style="font-family: Poppins; color:white;">Kirim Perintah</b>
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <p style="text-align:center; color:#D19200; font-family:Poppins; font-weight:bold; font-size:13px;">DAFTAR PERINTAH </p>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">Swing Trade Min Trend </p>
                                <hr style="border: 1px solid white; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/CMA=</b> Garis MA</td>
                                    </tr>
                                    <tr>
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/CAL=</b> Alligator</td>
                                    </tr>
                                    <tr>
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/CTL=</b> Multiple Trendline</td>
                                    </tr>
                                    <tr>
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/PSL=</b> Harmonic Pattern</td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">Swing Trend Following </p>
                                <hr style="border: 1px solid white; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/CAH=</b> Signal Buy Sell</td>
                                    </tr>
                                    <tr>
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/CAS=</b> Ichimoku</td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">Fast Trade </p>
                                <hr style="border: 1px solid white; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/CFN=</b> Frequency Analizer</td>
                                    </tr>
                                    <tr>
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/ODT=</b> One Day Trade</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">Bottom Fish </p>
                                <hr style="border: 1px solid white; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/CCO=</b> Bottom Fish</td>
                                    </tr>
                                    <tr>
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/APS=</b> Gerak Putar Saham</td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">Cycle Emiten </p>
                                <hr style="border: 1px solid white; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">Cfr=</b> Performa Saham</td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">Reversal </p>
                                <hr style="border: 1px solid white; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 50px; color:black; font-size:12px;"><b style="color: #000;">/CHA=</b> Heiken Ashi</td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <p style="font-weight: bold; color:#D30000; text-align:center; font-size:12px; font-family:Poppins;">*Untuk Pemula*</p>
                            <p style="font-weight: bold; color:#612D11; text-align:left; font-size:12px; font-family:Poppins; margin-top:-10px;">Gunakan [/Chart CAH - kode saham - DD] dan kombinasikan dengan filter /F SWB</p>
                            <div class="container" style="border: 3px solid #D19200; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">TIME INTERVAL </p>
                                <hr style="border: 1px solid #D19200; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:center; height: 30px; color:black; font-size:12px;"><b style="color: #000;">05=</b> 5 Menit</td>
                                        <td style="border:none; text-align:center; height: 30px; color:black; font-size:12px;"><b style="color: #000;">hh=</b> 1 Jam</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:center; height: 30px; color:black; font-size:12px;"><b style="color: #000;">15=</b> 15 Menit</td>
                                        <td style="border:none; text-align:center; height: 30px; color:black; font-size:12px;"><b style="color: #000;">dd=</b> 1 Hari</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:center; height: 30px; color:black; font-size:12px;"><b style="color: #000;">30=</b> 30 Menit</td>
                                        <td style="border:none; text-align:center; height: 30px; color:black; font-size:12px;"><b style="color: #000;">ww=</b> 1 Minggu</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:center; height: 30px; color:black; font-size:12px;"></td>
                                        <td style="border:none; text-align:center; height: 30px; color:black; font-size:12px;"><b style="color: #000;">mm=</b> 1 Bulan</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
    var demoTrigger = document.querySelector('.demo-trigger');

    new Drift(demoTrigger, {
        paneContainer: document.querySelector('.detail'),
        inlinePane: 900,
        inlineOffsetY: -85,
        containInline: true,
        sourceAttribute: 'href'
    });

    new Luminous(demoTrigger);
</script>