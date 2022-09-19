<div class="col-lg-9">
    <div>
        <ul>
            <li class="white-header pb-3 pt-4 pl-4 -r-4">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="kuning"><?= $title; ?></h5>
                        </div>
                        <div class="col-lg-6 text-right">
                            <a href="<?= base_url('billing') ?>" class="boxed-bil">Kembali</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="white-body pb-4 pt-4 pl-4 pr-4">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Status Pembayaran</h5>
                            <div>
                                <?php
									if($bill['status_pembayaran'] == 'payment'){
										echo 'Menunggu Pembayaran';
									}else{
										echo ucfirst($bill['status_pembayaran']);
									}
								?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5>Informasi Pembayaran</h5>
                            <div>Virtual Account/ATM/Bank Transfer</div>
                            <div>
                                <?php
                                    if($bill['pay_method'] == 'bank_transfer'){
                                        echo 'Bank Transfer';
                                    }else if($bill['pay_method'] == 'bca_klikpay'){
                                        echo 'BCA Klikpay';
                                    }else if($bill['pay_method'] == 'credit_card'){
                                        echo 'Credit Card';
                                    }else if($bill['pay_method'] == 'danamon_online'){
                                        echo 'Danamon Online';
                                    }else if($bill['pay_method'] == 'echannel'){
                                        echo 'E-Channel';
                                    }else{
                                        echo ucfirst($bill['pay_method']);
                                    }

                                    if($bill['bank'] != ''){
                                        echo strtoupper(' '.$bill['bank']);
                                    }

                                    if($bill['bank_code'] != ''){
                                        echo ' '.$bill['bank_code'];
                                    }

                                    if($bill['number_code'] != ''){
                                        echo ' '.$bill['number_code'];
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Referal Code</h5>
                            <div><?= $bill['kode_referal'] ?></div>
                        </div>
                        <div class="col-lg-6">
                            <h5>Tanggal Pembayaran Berakhir</h5>
                            <div><?= $bill['expire_date'] ?></div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="white-body pb-4 pt-4 pl-4 pr-4">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Nama Paket</h5>
                            <div><?= $bill['nama_paket'] ?></div>
                            <div>
                                <?php
                                    if($bill['langganan'] == 'bulan'){
                                        echo '1 Bulan';
                                    }else if($bill['langganan'] == 'tahun'){
                                        echo '1 Tahun';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5>&nbsp;</h5>
                            <div>
                                <?php
                                    if($bill['service_charge'] != ''){
                                        echo rupiah($bill['harga_paket']);
                                    }else{
                                        $h = $bill['harga_paket'];
                                        $p = (int)$h - 5000;

                                        echo rupiah($p);
                                    }
                                ?>
                            </div>
                            <div>
                                <?php
                                    if($bill['langganan'] == 'bulan'){
                                        echo '1 Bulan';
                                    }else if($bill['langganan'] == 'tahun'){
                                        echo '1 Tahun';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <div>Biaya Layanan</div>
                        </div>
                        <div class="col-lg-6">
                            <div>Rp. 5.000</div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="white-content pb-4 pt-4 pl-4 pr-4">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Total</h5>
                        </div>
                        <div class="col-lg-6">
                            <div><?= rupiah($bill['total']) ?></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>