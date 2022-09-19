<div class="col-lg-9 col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 style="color: #fdc134; font-family: Poppins;  font-weight:bold;">Edit Profile</h4>
            <samp style="color: #bababa; font-family: Poppins; font-weight:bold;"><?= ($d['username'] != '') ? '@' . $d['username'] : '' ?></samp>
        </div>
        <div class="card-body">
            <form method="POST" id="profilupdate" action="#" class="needs-validation">
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="ex" class="control-label float-right" style="font-family: Poppins;  font-weight:bold;">Username</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <input id="username" style="border-radius: 10px; font-family: Poppins; font-weight:bold;" type="text" class="form-control" name="username" tabindex="2" value="<?= $d['username'] ?>" placeholder="Min 8 Karakter dan Maksimum 12 Karakter (One time Only)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="ex" class="control-label float-right" style="font-family: Poppins;  font-weight:bold;">Email</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <input id="email" style="border-radius: 10px; font-family: Poppins; font-weight:bold;" type="text" class="form-control" name="email" tabindex="2" value="<?= $d['alamat_email'] ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="ex" class="control-label float-right" style="font-family: Poppins;  font-weight:bold;">Bio</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <textarea id="mybio" style="font-family: Poppins; font-weight:bold;" class="form-control" name="mybio" maxlength="160"><?= $d['tentang_saya'] ?></textarea>
                                <label for="mybio" class="control-label" style="border-radius: 10px; font-family: Poppins; font-weight:bold;">Tentang diri anda tidak lebih dari 160 Karakter</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="ex" class="control-label float-right" style="font-family: Poppins;  font-weight:bold;">Lokasi</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <select class="custom-select" name="location" id="location" style="border-radius: 10px; font-family: Poppins; font-weight:bold;">
                                    <?php
                                    foreach ($loc as $l) {
                                        $select = '';

                                        if ($d['kota'] == $l->nama) {
                                            $select = 'selected';
                                        }

                                        echo '<option value="' . $l->nama . '" ' . $select . '>' . $l->nama . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="ex" class="control-label float-right" style="font-family: Poppins;  font-weight:bold;">Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <select class="custom-select" name="gender" id="gender" style="border-radius: 10px; font-family: Poppins; font-weight:bold;">
                                    <option value="Man" <?= ($d['jenis_kelamin'] == 'Man') ? 'selected' : '' ?>>Pria</option>
                                    <option value="Woman" <?= ($d['jenis_kelamin'] == 'Woman') ? 'selected' : '' ?>>Wanita</option>
                                </select>
                                <!--
                                <div id="b" class="wrapper-dropdown-b float-left" tabindex="2">
                                    <span>Not Set</span>
                                    <ul class="dropdown">
                                        <li><a href="Man">Man</a></li>
                                        <li><a href="Woman">Woman</a></li>
                                    </ul>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="ex" class="control-label float-right" style="font-family: Poppins;  font-weight:bold;">Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="col-lg-8 float-left">
                                <select class="custom-select col-3" name="day" id="day" style="border-radius: 10px; font-family: Poppins; font-weight:bold;">
                                    <option value="" disabled selected hidden>Hari</option>
                                    <?php
                                    $day = ($d['tanggal_lahir'] != '0000-00-00') ? date('j', strtotime($d['tanggal_lahir'])) : 0;

                                    for ($i = 1; $i <= 31; $i++) {
                                        $select = '';

                                        if ($i == $day) {
                                            $select = 'selected';
                                        }
                                        echo '<option value="' . $i . '" ' . $select . '>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                                <select class="custom-select col-3" name="month" id="month" style="border-radius: 10px; font-family: Poppins; font-weight:bold;">
                                    <option value="" disabled selected hidden>Bulan</option>
                                    <?php
                                    $mon = ($d['tanggal_lahir'] != '0000-00-00') ? date('F', strtotime($d['tanggal_lahir'])) : '';

                                    foreach ($month as $m) {
                                        $select = '';

                                        if ($m == $mon) {
                                            $select = 'selected';
                                        }

                                        echo '<option value="' . $m . '" ' . $select . '>' . $m . '</option>';
                                    }
                                    ?>
                                </select>
                                <select class="custom-select col-3" name="year" id="year" style="border-radius: 10px; font-family: Poppins; font-weight:bold;">
                                    <option value="" disabled selected hidden>Tahun</option>
                                    <?php
                                    $year = ($d['tanggal_lahir'] != '0000-00-00') ? date('Y', strtotime($d['tanggal_lahir'])) : 0;
                                    $now = date('Y');

                                    for ($i = 1900; $i <= $now; $i++) {
                                        $select = '';

                                        if ($i == $year) {
                                            $select = 'selected';
                                        }
                                        echo '<option value="' . $i . '" ' . $select . '>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="website" class="control-label float-right" style="font-family: Poppins;  font-weight:bold;">Website Kamu</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <input id="website" style="border-radius: 10px; font-family: Poppins; font-weight:bold;" type="text" class="form-control" name="website" tabindex="2" value="<?= $d['website'] ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="phone" class="control-label float-right" style="font-family: Poppins;  font-weight:bold;">No Handphone</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="input-group mb-3">
                                    <input type="text" style="border-radius: 10px; font-family: Poppins; font-weight:bold;" class="form-control" name="phone" id="phone" placeholder="Recipient's username" value="<?= $d['no_hp'] ?>" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled>
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-secondari" style="border-radius: 10px; font-family: Poppins; font-weight:bold;" onclick="location.href='<?= base_url('/changephone'); ?>';">Ubah No Handphone</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block pt-2">
                                    <label for="address" class="control-label float-right" style="font-family: Poppins; font-weight:bold;">Alamat</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <textarea id="address" style="border-radius: 10px; font-family: Poppins; font-weight:bold;" class="form-control" name="address"><?= $d['alamat'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="d-block">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <button type="submit" class="boxed-save" tabindex="4" style="border-radius: 10px; font-family: Poppins; font-weight:bold; width:auto;">
                                Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="register" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-header pl-4 pr-4 pb-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="col-xl-12">
                    <div class="mt-4 text-muted text-center">
                        <img alt="logo" src="<?= base_url(); ?>/public/assets/img/ps-logo.png" width="300px" height="">
                        <h4 style="font-size: 25px;">Verifikasi SMS</h4>
                        <div class="disk pt-3">Kami akan mengirimkan kode konfirmasi ke No Handphone anda. Masukan nomer No Handphone yang anda daftarkan Contoh +62 81234567890</div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>