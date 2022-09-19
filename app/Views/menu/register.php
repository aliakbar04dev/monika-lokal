<div class="modal fade" id="register" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-header pl-4 pr-4 pb-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="col-xl-12">
                    <div class="mt-4 text-muted text-center">
                        <a href="<?= site_url('/'); ?>">
                            <img alt="logo" src="<?= base_url(); ?>/public/assets/img/ps-logo.png" width="300px" height="">
                        </a>
                        <h4>Daftar Akun</h4>
                        Sudah Punya Akun? <a href="javascript:void(0);" id="masuksekarang"><span style="color: #EAA401;">Masuk</span></a>
                        <div class="disk pt-3">Daftarkan <strong>dan dapatkan DISKON Menarik</strong> jika anda sudah bergabung<br>di komunitas dan koperasi PanenSaham</div>
                    </div>
                    <br>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" id="registrationForm">
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="form-group pt-2">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="radiomember" id="regisnonkomunitas" class="custom-control-input" value="nonkomunitas" tabindex="3">
                                                        <label class="custom-control-label" for="regisnonkomunitas">Non Member Komunitas <b style="color:#EAA400">PanenSaham</b></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group pt-2">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="radiomember" id="regiskomunitas" class="custom-control-input" value="komunitas" tabindex="3">
                                                        <label class="custom-control-label" for="regiskomunitas">Member Komunitas <b style="color:#EAA400">PanenSaham</b></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <input style="outline: none;" type="text" class="form-control mb-2 mr-sm-2" id="clientid" name="clientid" placeholder="Masukan Client ID">
                                            </div>
                                            <!-- <div class="col-lg-7">
                                                <div class="form-group pt-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="regiskoperasi" id="regiskoperasi" class="custom-control-input" value="koperasi" tabindex="3">
                                                        <label class="custom-control-label" for="regiskoperasi">Khusus Anggota KJKPI</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 pb-3">
                                                <input style="outline: none;" type="text" class="form-control" id="emailid" name="emailid" placeholder="Masukan Email/ID Anggota">
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group col-12">
                                                    <label for="nama">Nama</label>
                                                    <input style="outline: none;" id="nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group col-12">
                                                    <label for="hp">No HP</label>
                                                    <input style="outline: none;" id="hp" type="text" class="form-control" name="hp" tabindex="1" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group col-12">
                                                    <label for="kota">Kota</label>
                                                    <input style="outline: none;" id="kota" type="text" class="form-control" name="kota" tabindex="1" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group col-12">
                                                    <label for="email">Email</label>
                                                    <input style="outline: none;" id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group col-12">
                                                    <div class="d-block">
                                                        <label for="password" class="control-label">Password</label>

                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input style="outline: none;" id="password" type="password" class="form-control shadow-none" name="password" tabindex="2" required>
                                                        <div class="input-group-append">
                                                            <button id="passBtn1" class="btn btn-outline-secondari shadow-none" type="button"><i class="fas fa-eye fa-fw" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                                <div class="form-group col-12">
                                                    <div class="d-block">
                                                        <label for="repeat" class="control-label">Ulangi
                                                            Password
                                                        </label>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input style="outline: none;" id="repeat" type="password" class="form-control shadow-none" name="repeat" tabindex="2" required>
                                                        <div class="input-group-append">
                                                            <button id="passBtn2" class="btn btn-outline-secondari shadow-none" type="button"><i class="fas fa-eye fa-fw" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                                <div class="form-group col-12">
                                                    <label for="referal">Referral Code</label>
                                                    <input style="outline: none;" id="referal" type="text" class="form-control" name="referal" tabindex="1" autofocus placeholder="Optional">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                                <div class="form-group col-12 pt-4">
                                                    <a id="refcodebut" class="boxed-abu mr-4">Gunakan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="syarat" class="custom-control-input" value="accept" tabindex="3" id="syarat" required>
                                        <label class="custom-control-label" for="syarat">Anda telah
                                            menyetujui <a href="<?= site_url('termsconditions'); ?>" style="color: #EAA401;"> syarat dan ketentuan</a> yang berlaku</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <button id="submitRegis" type="submit" class="boxed-trial mr-4">Daftar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- <div class="text-center mt-4 mb-3">
                            <div class="text-job text-muted">Atau Daftar Dengan</div>
                        </div>
                        <div class="row sm-gutters">
                            <div class="col-6">
                                <a class="boxed-facebook" href="#">
                                    <li class="fab fa-facebook"></li>
                                    Facebook
                                </a>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="boxed-gmail">
                                    <li class="fab fa-google"></li> google
                                </a>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const PassBtn = document.querySelector('#passBtn1');
    PassBtn.addEventListener('click', () => {
        const input = document.querySelector('#password');
        input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
    });
    const PassBtn1 = document.querySelector('#passBtn2');
    PassBtn1.addEventListener('click', () => {
        const input = document.querySelector('#repeat');
        input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
    });
</script>