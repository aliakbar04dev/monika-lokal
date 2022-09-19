<!-- <div class="col-lg-5 col-md-6">
    <div class="card">
        <div class="card-header">
            <h4>Ubah Password</h4>
        </div>
        <div class="card-body">
            <form method="POST" id="formuserpass" class="needs-validation">
                <div class="form-group">
                    <div class="d-block">
                        <label for="ex" class="control-label">Masukkan Password Lama</label>

                    </div>
                    <input id="oldpass" type="password" class="form-control" name="oldpass" tabindex="2" required>
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="new" class="control-label">Masukkan Password Baru</label>

                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                </div>

                <div class="alert alert-dark mt-4">
                    <strong>Tips untuk kata sandi yang bagus</strong>
                    <p class="att">Kata sandi sebaiknya terdiri dari minimal 4 kriteria berikut: huruf besar, huruf kecil, angka, dan simbol.</p>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="confirm" class="control-label">Konfirmasi Password Baru</label>

                    </div>
                    <input id="repeat" type="password" class="form-control" name="repeat" tabindex="2" required>
                </div>

                <button type="submit" style="width:auto;" class="boxed-save mt-3" tabindex="4">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
 -->

 <div class="col-lg-5 col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 style="font-family: Poppins; font-weight:bold;">Ubah Password</h4>
        </div>
        <div class="card-body">
            <form method="POST" id="formuserpass" class="needs-validation">

                <div class="d-block">
                    <label for="ex" class="control-label" style="font-family: Poppins; font-weight:bold;">Masukkan Password Lama
                    </label>
                </div>
                <div class="input-group mb-3">
                    <input style="font-family: Poppins; font-weight:bold; outline: none;" id="oldpass" type="password" class="form-control shadow-none" name="oldpass" tabindex="2" required>
                    <div class="input-group-append">
                        <button id="passBtnchange1" class="btn btn-outline-secondari shadow-none fas fa-eye-slash" type="button"><i class="" aria-hidden="true"></i></button>
                    </div>
                </div>

                <div class="d-block">
                    <label for="new" class="control-label" style="font-family: Poppins; font-weight:bold;">Masukkan Password Baru
                    </label>
                </div>
                <div class="input-group mb-3">
                    <input style="font-family: Poppins; font-weight:bold; outline: none;" id="password" type="password" class="form-control shadow-none" name="password" tabindex="2" required>
                    <div class="input-group-append">
                        <button id="passBtnchange2" class="btn btn-outline-secondari shadow-none fas fa-eye-slash" type="button"><i class="" aria-hidden="true"></i></button>
                    </div>
                </div>

                <div class="alert alert-dark mt-4">
                    <strong style="font-family: Poppins; font-weight:bold;">Tips untuk kata sandi yang bagus</strong>
                    <p style="font-family: Poppins; font-weight:bold;" class="att">Kata sandi sebaiknya terdiri dari minimal 4 kriteria berikut: huruf besar, huruf kecil, angka, dan simbol.</p>
                </div>

                <div class="d-block">
                    <label for="confirm" class="control-label" style="font-family: Poppins; font-weight:bold;">Konfirmasi Password Baru
                    </label>
                </div>
                <div class="input-group mb-3">
                    <input style="outline: none;" id="repeat" type="password" class="form-control shadow-none" name="repeat" tabindex="2" required>
                    <div class="input-group-append">
                        <button id="passBtnchange3" class="btn btn-outline-secondari shadow-none fas fa-eye-slash" type="button"><i class="" aria-hidden="true"></i></button>
                    </div>
                </div>

                <button type="submit" class="boxed-save mt-3" tabindex="4" style="font-family: Poppins; font-weight:bold; width:auto;">
                Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const PassBtn4 = document.querySelector('#passBtnchange1');
    PassBtn4.addEventListener('click', () => {
        const input = document.querySelector('#oldpass');
        input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
    });
    const PassBtn5 = document.querySelector('#passBtnchange2');
    PassBtn5.addEventListener('click', () => {
        const input = document.querySelector('#password');
        input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
    });
    const PassBtn6 = document.querySelector('#passBtnchange3');
    PassBtn6.addEventListener('click', () => {
        const input = document.querySelector('#repeat');
        input.getAttribute('type') === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password');
    });
    var myInput4 = document.getElementById('oldpass'),
        myIcon3 = document.getElementById('passBtnchange1');
        myIcon3.onclick = function() {
            if (myIcon3.classList.contains('fa-eye-slash')) {
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            } else {
                myInput.setAttribute('type', 'password');
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            };
        }
        myInput5 = document.getElementById('password'),
        myIcon4 = document.getElementById('passBtnchange2');
        myIcon4.onclick = function() {
            if (myIcon4.classList.contains('fa-eye-slash')) {
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            } else {
                myInput.setAttribute('type', 'password');
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            };
        }
        myInput6 = document.getElementById('repeat'),
        myIcon5 = document.getElementById('passBtnchange3');
        myIcon5.onclick = function() {
            if (myIcon5.classList.contains('fa-eye-slash')) {
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            } else {
                myInput.setAttribute('type', 'password');
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            };
        }
</script>