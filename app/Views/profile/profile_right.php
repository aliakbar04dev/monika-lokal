    <div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <h4 style="color: #fdc134; font-family: 'Poppins'; font-weight:bold;">Profil Saya</h4>
        </div>
        <div class="card-body" id="tempatgambar">
            <div class="row pb-3">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <div class="full" id="editimagePreview" style="background-image: url(<?= (getsession('photo') != '') ? base_url(getsession('photo')) : base_url('/public/assets/img/avatar/avatar-1.png') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 pt-3">
                            <h2 style="font-family: 'Poppins'; font-weight:bold;">
                                <?= ($d['username'] != '') ? $d['username'] : 'UNKNOWN' ?>
                            </h2>
                            <h6 style="color: #D79702; margin-top: -10px; font-family: 'Poppins'; font-weight:bold;">
                                <?= $d['alamat_email'] ?>
                                <?php
                                    if($d['alamat_email'] == 'muhammadyusran95@gmail.com'){
                                        $now = date('Y-m-d');
                                        if($now > $d['trial_expire']){
                                            echo 'true | '.$now.' | '.$d['trial_expire'];
                                        }else{
                                            echo 'false';
                                        }
                                    }
                                ?>
                            </h6><br>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="d-block" style="font-family: 'Poppins'; font-weight:bold; font-size:12px;">
                                            <i class="fas fa-id-card" style="color: #D79702; font-size:15px;"></i> Bergabung dari <?= date('F Y', strtotime($d['created_at'])) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-block" style="font-family: 'Poppins'; font-weight:bold;">
                                            <i class="fab fa-firefox-browser" style="color: #D79702; font-size:17px;"></i> <?= $d['website'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- <h6>Badge</h6>
                            <div class="col-lg-12">
                                <table class="">
                                    <thead>
                                        <tr>
                                            <?php
                                            if ($d['email_anggota'] != '') {
                                            ?>
                                                <th class=""><img src="<?= base_url() ?>/public/assets/img/logo.png" width="50px" alt=""></th>
                                                <th class="">Member komunitas PanenSaham</th>
                                            <?php
                                            }

                                            if ($d['client_id_komunitas'] != '') {
                                            ?>
                                                <th class=""><img src="<?= base_url() ?>/public/assets/img/kjkpi.png" width="70px" alt=""></th>
                                                <th class="">Member komunitas PanenSaham</th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                </table>
                            </div> -->
                        </div>
                        <div class="col-lg-2">
                            <button style="width:auto; background-color: #612D11; padding:10px; float:right; font-size:10px; font-family: 'Poppins'; font-weight:bold;" class="boxed-save" onclick="window.location.href='<?= site_url('editprofile'); ?>'">
                                Ubah Profil <i class="fas fa-cog"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>