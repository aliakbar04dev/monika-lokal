<div class="col-lg-9">
    <?php
    if ($lvl != 'MULV004') {
    ?>
        <div class="card mb-3">
            <div class="card-header">
                <h4 style="color: #fdc134; font-family:Poppins;">Tabel<samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
                <h5 class="pt-2" style="color: #000; font-family:Poppins">Filter Analisa Teknikal</h5>
            </div>
            <div class="card-body">
                <div style="overflow-x:auto;">
                    <img id="defchartpic" alt="image" src="/public/assets/img/chartTA.png" style="width: 100%;">

                    <div id="tempattabel">
                    </div>
                    <!--
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th>Ticker</th>
                            <th>Date/Time</th>
                            <th>Close</th>
                            <th>Persen</th>
                            <th>Peluang</th>
                            <th>Continuation</th>
                            <th>Value</th>
                            <th>Spike Vol-1%</th>
                            <th>Spike Vol %</th>
                            <th>Stokastik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>a</td>
                            <td>b</td>
                            <td>c</td>
                            <td>d</td>
                            <td>e</td>
                            <td>f</td>
                            <td>g</td>
                            <td>e</td>
                            <td>f</td>
                            <td>g</td>
                        </tr>

                    </tbody>
                </table>-->
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body" style="background-color: #dbdbdb; border-radius:5px;">
                <form method="POST" id="showtable" class="needs-validation" novalidate="">
                    <div class="row pb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-10 pt-2">
                                    <!-- <input id="commandtable" type="text" class="form-control" name="commandtable" placeholder="Masukkan Perintah" required autocomplete="off"> -->
                                    <select class="custom-select col-12" name="commandtable" id="commandtable" style="font-family:Poppins;">
                                        <!-- <option value="" disabled selected hidden>Pilih Command</option> -->
                                        <!-- <option value="/f swb">/f swb</option>
                                        <option value="/f bulang">/f bulang</option>
                                        <option value="/f bsjp">/f bsjp</option>
                                        <option value="/f asin">/f asin</option>
                                        <option value="/f ungu">/f ungu</option>
                                        <option value="/f bpjs">/f bpjs</option>
                                        <option value="/f bull">/f bull</option>
                                        <option value="/f warkop">/f warkop</option>
                                        <option value="/f mcd">/f mcd</option>
                                        <option value="/f gps">/f gps</option>
                                        <option value="/f ps200">/f ps200</option>
                                        <option value="/f rg3">/f rg3</option>
                                        <option value="/f hold">/f hold</option>
                                        <option value="/f stoup">/f stoup</option>
                                        <option value="/f ps20">/f ps20</option>
                                        <option value="/f fan15">/f fan15</option>
                                        <option value="/f swb15">/f swb15</option>
                                        <option value="/f tektok">/f tektok</option> -->
                                        <option value="/f swb">Swing Buy Daily</option>
                                        <option value="/f bulang">Bottom Fish</option>
                                        <option value="/f bsjp">Beli Sore Jual Pagi</option>
                                        <option value="/f asin">First Candle Heiken Ashi</option>
                                        <option value="/f ungu">Potensi Boom</option>
                                        <option value="/f bpjs">Beli Pagi Jual Suka suka</option>
                                        <option value="/f bull">Filter Uptrend</option>
                                        <option value="/f warkop">Filter Adx Kombinasi</option>
                                        <option value="/f mcd">Martabak Kombinasi</option>
                                        <option value="/f gps">Filter Gerak Putar Saham</option>
                                        <option value="/f ps200">Support MA200</option>
                                        <option value="/f rg3">Potensi Teknikal Rebound</option>
                                        <option value="/f hold">Saham Layak Hold</option>
                                        <option value="/f stoup">Stokastik Up</option>
                                        <option value="/f ps20">Support MA20</option>
                                        <option value="/f fan15">Spike Freq 15 menit</option>
                                        <option value="/f swb15">Swing Buy Hourly</option>
                                        <option value="/f tektok">Spike Freq 5 menit</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 pt-2">
                                    <button type="submit" style="width:auto;" class="boxed-save">
                                        <b style="font-family:Poppins; color:white;">Kirim</b>
                                    </button>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <p style="text-align:center; color:#D19200; font-family:Poppins; font-weight:bold; font-size:13px;">DAFTAR PERINTAH </p>
                            </div>
                        </div>

                        <div class="col-lg-6 mt-2">
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">Daily </p>
                                <hr style="border: 1px solid white; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Bpjs</b> &nbsp;&nbsp; = Beli Pagi Jual Suka suka</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Bsjp </b> &nbsp;&nbsp; = Beli Sore Jual Pagi</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Bulang</b> &nbsp;&nbsp; = Bottom Fish</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Bull</b> &nbsp;&nbsp; = Filter Uptrend</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Gps</b> &nbsp;&nbsp; = Filter Gerak Putar Saham</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Mcd</b> &nbsp;&nbsp; = Martabak Kombinasi</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Asin </b> &nbsp;&nbsp; = First Candle Heiken Ashi</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Warkop</b> &nbsp;&nbsp; = Filter Adx Kombinasi</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">PS200</b> &nbsp;&nbsp; = Support MA200</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Rg3</b> &nbsp;&nbsp; = Potensi Teknikal Rebound</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Stuoup</b> &nbsp;&nbsp; = Stokastik Up</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Swb </b> &nbsp;&nbsp; = Swing Buy Daily</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Ungu </b> &nbsp;&nbsp; = Potensi Boom</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Hold</b> &nbsp;&nbsp; = Saham Layak Hold</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Ps20</b> &nbsp;&nbsp; = Support MA20</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <p style="text-align:center; color:#612D11; font-family:Poppins; font-weight:bold; font-size:13px;">Intra Day </p>
                                <hr style="border: 1px solid white; margin-top:-5px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Fan15</b> &nbsp;&nbsp; = Spike Freq 15 menit</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Swb15</b> &nbsp;&nbsp; = Swing Buy Hourly</td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">Tektok</b> &nbsp;&nbsp; = Spike Freq 5 menit</td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <p style="font-weight: bold; color:#D30000; text-align:left; font-size:12px; font-family:Poppins;">Untuk PEMULA</p>
                            <p style="color:#D30000; text-align:left; font-size:12px; font-family:Poppins; margin-top:-10px;">Gunakan /f swb dan kombinasikan dengan chart /CAH kodesaham DD</p>
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