<div class="col-lg-9">
    <?php
    if ($lvl != 'MULV002' && $lvl != 'MULV003') {
    ?>
        <div class="card mb-3">
            <div class="card-header">
                <h4 style="color: #fdc134; font-family:Poppins;">Chart<samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
                <h5 class="pt-2" style="color: #000; font-family:Poppins;">Analisa Fundamental</h5>
                <!-- <img class="pb-2 app" width="65%" alt="image" src="/public/assets/img/playstore.png"> -->
            </div>
            <div class="card-body pb-5" id="tempatgambar">
                <img id="defchartpicfa" alt="image" src="/public/assets/img/chartTA.png" style="width: 100%;">
                <div id="tempatchartfa">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body" style="background-color: #dbdbdb; border-radius:5px;">
                <form method="POST" id="showchartfa" class="needs-validation" novalidate="">
                    <div class="row pb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <select class="custom-select col-4" name="daftar" id="daftar" style="font-family:Poppins;">
                                    <!-- <option value="" disabled selected hidden>Daftar perintah</option> -->
                                    <?php
                                        foreach($cht as $c){
                                            echo '<option value="'.$c['kode_chart'].'">'.$c['deskripsi'].'</option>';
                                        }
                                    ?>
                                </select>
                                <input type="text" class="form-control col-4" name="simbol" id="simbol" placeholder="Masukkan Kode Saham" style="font-family:Poppins;" required>
                                </input>
                                <select class="custom-select col-4" name="interval" id="interval" style="font-family:Poppins;">
                                    <!-- <option value="" disabled selected hidden>Interval</option> -->
                                    <!-- <option value="05">05</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="hh">hh</option> -->
                                    <option value="dd">dd</option>
                                    <!-- <option value="ww">ww</option>
                                    <option value="mm">mm</option> -->
                                </select>
                                <button type="submit" style="width:100%;" class="boxed-save mt-2" style="font-family:Poppins;">
                                    <b style="font-family: Poppins; color:white;">Kirim Perintah</b>
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <p style="text-align:center; color:#D19200; font-family:Poppins; font-weight:bold; font-size:13px;">DAFTAR PERINTAH </p>
                            </div>
                        </div>
                        <div class="col-lg-2 text-center mt-2">
                           
                        </div>
                        <div class="col-lg-8 text-center mt-2">
                            <div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
                                <table class="table table-bordered" style="border:none; font-family:Poppins;">
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;"></td>
                                    </tr>  
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps1</b> &nbsp;&nbsp; = PBV,PER,EPS tahunan</td>
                                    </tr>   
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps2</b> &nbsp;&nbsp; = PBV,PER,EPS Kuartalan</td>
                                    </tr>   
                                    <!-- <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps3</b> &nbsp;&nbsp; = Chart PBV, PER, ROE Annual</td>
                                    </tr>    -->
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps4</b> &nbsp;&nbsp; = Rasio Profitabilitas</td>
                                    </tr>  
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps5</b> &nbsp;&nbsp; = Rasio Laba</td>
                                    </tr>  
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps7</b> &nbsp;&nbsp; = Neraca</td>
                                    </tr>  
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps8</b> &nbsp;&nbsp; = PER vs ROE</td>
                                    </tr>  
                                    <!-- <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps9</b> &nbsp;&nbsp; = Chart PBV dan ROA</td>
                                    </tr>   -->
                                    <tr style="border:none;">
                                        <td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">/ps10</b> &nbsp;&nbsp; = Tabel Keuangan</td>
                                    </tr>                                
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-2 text-center mt-2">
                       
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