<div class="modal fade" id="login" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-header pl-4 pr-4 pb-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="mt-5 text-muted text-center">
                    <a href="<?= site_url('/'); ?>">
                        <img alt="logo" src="<?= base_url(); ?>/public/assets/img/ps-logo.png" width="300px" height="">
                    </a>
                    <h4>Selamat Datang kembali</h4>
                    <!-- Belum Punya Akun? <a class="kuning" href="javascript:void(0);" id="daftarsekarang" >Daftar Sekarang</a> -->
                </div>

                <div class="card-body">
                    <form method="POST" id="formlogin" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <label for="emaillogin">Email / No Handphone</label>
                            <input style="outline: none;" id="emaillogin" type="email" class="form-control shadow-none" name="emaillogin" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                                Please fill in your email
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="passwordlogin" class="control-label">Password</label>
                            </div>
                            <div class="input-group mb-3">
                                <input style="outline: none;" id="passwordlogin" type="password" class="form-control shadow-none" name="passwordlogin" tabindex="2" required>
                                <div class="input-group-append">
                                    <button id="passBtn" class="btn btn-outline-secondari shadow-none fas fa-eye-slash" style="margin-top:1px solid #ADADAD;" type="button"><i class="" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Ingat Saya</label>
                                <div class="float-right">
                                    <a href="<?= site_url('/lupa'); ?>" class="kuning text-small">
                                        Lupa Password
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <button id="submitLogin" type="submit" class="boxed-trial mr-4">Masuk</button>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <table class="tg">
                                        <thead>
                                            <tr>
                                                <th class="tg-0pky">
                                                    <!-- <div class="mt-1 mr-4 ml-2"><a style="font-size: 15px;">Atau Masuk dengan</a></div> -->
                                                </th>
                                                <th class="tg-0pky">
                                                    <div class="g-signin2" data-onsuccess="onSignIn" data-width="40"></div>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- <div class="text-center mt-4 mb-3">
                        <div class="text-job text-muted">Atau Masuk Dengan</div>
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
<script>
    const PassBtn10 = document.querySelector('#passBtn');
        PassBtn10.addEventListener('click', () => {
            const input = document.querySelector('#passwordlogin');
            input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
        });
        var myInput = document.getElementById('passwordlogin'),
            myIcon = document.getElementById('passBtn');
        myIcon.onclick = function() {
            if (myIcon.classList.contains('fa-eye-slash')) {
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            } else {
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            };
        }
</script>