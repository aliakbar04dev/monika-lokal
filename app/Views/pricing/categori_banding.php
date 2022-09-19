<section class="bg-banding d-none d-lg-block">
    <div class="container pl-3 pr-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="pt-5 mt-5 pb-5 mb-5">
                    <ul>
                        <li class="list pl-3 pr-3 pb-3 pt-3">
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th width="25%" class="none kuning teha"></th>
                                        <th width="10%" class="none kuning center teha">Basic</th>
                                        <th width="10%" class="none kuning center teha">Paket TA</th>
                                        <th width="10%" class="none kuning center teha">Paket FA</th>
                                        <th width="15%" class="yel wo putih center teha">Ultimate</th>
                                    </tr>
                                </thead>
                                <tbody>
																		<!-- <?php
										foreach($disc as $d){
											$row = '<tr>
														<th scope="row font">'.$d['jenis_member'].'</th>';
											
											$numItems = count($paket);
											$i = 0;
											foreach($paket as $p){
												$i++;
												$class = 'center';
												$isi = 'FREE';
												
												if($p['kode_user_level'] == 'MULV002'){
													$class .= ' ijo';
												}else if($p['kode_user_level'] == 'MULV005'){
													$class .= ' yel putih center';
													if ($i = 4)
													{
														$class .= 'yel putih center';
													}
													else
													{
														$class .= 'yel ow putih center';
													}
													/* if(++$i === $numItems - 1) {
														$class .= 'yel putih center';
													}
													else
													{
														$class .= 'yel ow putih center';
													} */
												}
												
												if($p['harga_paket'] > 0){
													if($d['kode_jenis_member'] == 'JMBR001'){
														$isi = rupiah($p['harga_paket']).'/bulan';
													}else if($d['kode_jenis_member'] == 'JMBR002'){
														$isi = rupiah($p['harga_koperasi']).'/bulan';
													}else if($d['kode_jenis_member'] == 'JMBR003'){
														$isi = rupiah($p['harga_komunitas']).'/bulan';
													}else if($d['kode_jenis_member'] == 'JMBR004'){
														$isi = rupiah($p['harga_dual']).'/bulan';
													}
												}

												$row .= '<th class="'.$class.'">'.$isi.'</th>';
											}
											
											$row .= '</tr>';
											
											echo $row;
										}
									
									?> -->
									
									<!--
                                    <tr>
                                        <th scope="row font">Member Baru</th>
                                        <th class="center ijo">FREE</th>
                                        <th class="center">Rp.200.000/bulan</th>
                                        <th class="center">Rp.250.000/bulan</th>
                                        <th class="yel putih center">Rp.350.000/bulan</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Anggota Koperasi Panen Saham</th>
                                        <th class="center ijo">FREE</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="yel putih center">Rp.150.000/bulan</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Member Komunitas Panen Saham</th>
                                        <th class="center ijo">FREE</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="yel putih center">Rp.150.000/bulan</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Member Komunitas & Anggota Koperasi Panen Saham</th>
                                        <th class="center ijo">FREE</th>
                                        <th class="center">Rp.60.000/bulan</th>
                                        <th class="center">Rp.60.000/bulan</th>
                                        <th class="yel ow putih center">Rp.120.000/bulan</th>
                                    </tr>-->
                                    <tr>
                                        <th scope="row font">Harga Baru</th>
                                        <th class="center ijo">FREE</th>
                                        <th class="center">Rp.90.000/bulan</th>
                                        <th class="center">Rp.90.000/bulan</th>
                                        <th class="yel ow putih center">Rp.180.000/bulan</th>
                                    </tr>
                                    <!-- <tr>
                                        <th scope="row">Anggota Koperasi Panen Saham</th>
                                        <th class="center ijo">FREE</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="yel putih center">Rp.150.000/bulan</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Member Komunitas Panen Saham</th>
                                        <th class="center ijo">FREE</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="yel putih center">Rp.150.000/bulan</th>
                                    </tr> -->
                                    <!-- <tr>
                                        <th scope="row">Member Komunitas PanenSaham</th>
                                        <th class="center ijo">FREE</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="center">Rp.75.000/bulan</th>
                                        <th class="yel ow putih center">Rp.150.000/bulan</th>
                                    </tr> -->
                                </tbody>
                            </table>
                            <!-- <a class="boxed-disable" style="font-size: 20px;">Diskon Harga</a>
                            <a class="pl-4 teha">Dapatkan harga yang menarik dengan bergabung dengan kami di <a class="teha" style="color: #D79702;">Komunitas PanenSaham</a>
                            </a> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-banding d-sm-none">
    <div class="container pl-3 pr-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <h3 class="center kuning pb-3">Bandingkan Harga</h3>
                </div>
                <div class="kartu">
                    <div class="pt-3 pl-3 pr-3 pb-3">
                        <h5 class="center pb-4 pt-2">Member Baru</h5>
                        <div class="col-xl-12">
                            <div class="row center">
                                <div class=" col-5">
                                    <p class="center">Basic</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="ijo center">FREE</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center">Paket TA</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left">Rp.200.000/bulan</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center">Paket FA</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left">Rp.250.000/bulan</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center kuning bold">Ultimate</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center kuning bold">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left kuning bold">Rp.350.000/bulan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-12 pt-3">
                <div class="kartu">
                    <div class="pt-3 pl-3 pr-3 pb-3">
                        <h5 class="center pb-4 pt-2">Anggota Koperasi Panen Saham</h5>
                        <div class="col-xl-12">
                            <div class="row center">
                                <div class=" col-5">
                                    <p class="center">Basic</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="ijo center">FREE</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center">Paket TA</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left">Rp.75.000/bulan</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center">Paket FA</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left">Rp.75.000/bulan</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center kuning bold">Ultimate</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center kuning bold">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left kuning bold">Rp.150.000/bulan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 pt-3">
                <div class="kartu">
                    <div class="pt-3 pl-3 pr-3 pb-3">
                        <h5 class="center pb-4 pt-2">Member Komunitas Panen Saham</h5>
                        <div class="col-xl-12">
                            <div class="row center">
                                <div class=" col-5">
                                    <p class="center">Basic</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="ijo center">FREE</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center">Paket TA</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left">Rp.75.000/bulan</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center">Paket FA</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left">Rp.75.000/bulan</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center kuning bold">Ultimate</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center kuning bold">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left kuning bold">Rp.150.000/bulan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-12 pt-3">
                <div class="kartu">
                    <div class="pt-3 pl-3 pr-3 pb-3">
                        <h5 class="center pb-4 pt-2">Member Komunitas & Anggota Koperasi Panen Saham</h5>
                        <div class="col-xl-12">
                            <div class="row center">
                                <div class=" col-5">
                                    <p class="center">Basic</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="ijo center">FREE</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center">Paket TA</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left">Rp.75.000/bulan</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center">Paket FA</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left">Rp.75.000/bulan</p>
                                </div>
                                <div class=" col-5">
                                    <p class="center kuning bold">Ultimate</p>
                                </div>
                                <div class=" col-1">
                                    <p class="center kuning bold">:</p>
                                </div>
                                <div class="col-5">
                                    <p class="float-left kuning bold">Rp.150.000/bulan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 pt-3">
                <div class="kartu">

                    <div class="pt-3 pl-3 pr-3 pb-3">
                        <a class="boxed-disable" style="font-size: 20px;">Diskon Harga</a>
                        <br>
                        <br>
                        <a class="pt-4 teha">Dapatkan harga yang menarik dengan bergabung dengan kami di <a class="teha" style="color: #D79702;">Komunitas PanenSaham</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>