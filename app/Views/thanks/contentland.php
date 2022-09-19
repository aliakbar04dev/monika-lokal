<div class="container">
    <div class="col-lg-12">
        <center>
            
            <div class="col-lg-5 pt-5 pb-5 thk" style="background-color:#E5E5E5; border-radius:10px;">
            <div class="ceklis pb-3">
            <img style="margin-top:-25px;" width="40px" src="<?= base_url(); ?>/public/assets/img/cek.png" alt="warning">
            </div>
                <h5>Terimakasih</h5>
                <a>Terima kasih telah melakukan pemesanan paket, Selanjutnya anda dapat melakukan pengecekan <a class="bold">email</a> untuk melihat <a class="bold">Intruksi dan Nomor Pembayaran</a></a>
                <br><br>
                <div style="background-color:#55341D; color:#fff; width:50%;" class="order pt-2 pb-2 pl-1 pr-1">
                    ORDER ID : <?= $bill['kode_pembayaran'] ?>
                </div>
            </div>
            <div class="col-lg-5 mt-3">
                <div style="background-color:#EAA401; color:#fff; width:50%; border-radius:10px;" class="ttl pt-1 pb-1 mb-3">
                    Total Tagihan : <?= rupiah($bill['total']) ?>
                </div>
                <div> 
                    <a class="float-left bold"><?= $user['nama_lengkap'] ?></a><br>
                    <a class="float-left"><?= $user['no_hp'] ?></a><br>
                    <a class="float-left"><?= $user['alamat_email'] ?></a><br>
                </div>
                <hr>
                <div> 
                    <a class="float-left bold">Pembayaran</a><br>
                    <a class="float-left">
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
                        ?>
                    </a>
                    <a class="float-right">
                        <?php
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
                    </a>
                </div>
            </div>
        </center>
    </div>
</div>