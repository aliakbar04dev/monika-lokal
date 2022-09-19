<?= $this->extend('components/template_menu') ?>

<?= $this->section('content_menu') ?>
<link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/career.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/notif.css">
<style>
    .nav-tabse .nav-item.show .nav-link, .nav-tabse .nav-link.active {
        background: #d49400;
        border-bottom: 2px solid #d49400;
    }
</style>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>
<section style="background-color:#F5F6F8;">
    <div class="loading_overlay">
        <div class="loading_logo">
            <img id="loading" width="200px" src="<?= base_url('/public/assets/img/loading.png') ?>" />
        </div>
    </div>
    <div class="container pt-5 pb-3">
        <div class="row ">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <div class="breadcrumb">
                        <div class="breadcrumb-item"><a href="#">Home</a></div>
                        <div aria-current="page" class="breadcrumb-item active">Pembelian Paket</div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-8">
                    <!-- tinggal ganti display aja dah jadi none atau show-->
                    <div style="display:show;">
                        <div class="black-header pb-4 pt-4 pl-4 pr-4" style="background-color: #55341d;">
                            <div class="">
                                <div class="imgBox">
                                    <div class="action">
                                    <div class="waricon" onclick="warningToggle();">
                                    <img class="float-right" width="30px" src="<?= base_url(); ?>/public/assets/img/warn.png" alt="warning">
                                    </div>
                                    <div class="isian">
                                        <ul class="hor"> 
                                            <li class="wrkun"><img class="float-right" width="45px" src="<?= base_url(); ?>/public/assets/img/ser.png" alt="warning"></li>
                                            <li class="wrput">
                                                <center>
                                                <a>Data diri wajib diisi dengan sebenar-benarnya<br>
                                                <a class="gotit" onclick="warningToggle();">Mengerti</a></a>
                                                </center>
                                            </li>
                                        </ul>
                                    </div>
                                    </div>
                                    <script>
                                        function warningToggle() {
                                            const tonggleWarning = document.querySelector('.isian');
                                            tonggleWarning.classList.toggle('active')
                                        }
                                    </script>
                                </div>
                                <div style="color:#fff; font-size:15px;" id="infologoutdiv"><?= ($loginpemb != 'Yes')? '1. Informasi Kamu':'1. Logout' ?></div>
                            </div>
                        </div>
                            <div class="white-body pb-4 pt-4 pl-4 pr-4" style="<?= ($loginpemb != 'Yes')? '':'display:none'?>" id='regislogindiv'>
                                <nav>
                                    <div class="nav nav-tabse col-lg-13" id="nav-tab" role="tablist">
                                        <a class="tap nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false"><font style="font-size: 15px;">Login</font></a>
                                        <a class="tap nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true"><font style="font-size: 15px;">Register</font></a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="pt-4 pb-4" align="center">Login menggunakan jejaring Sosial</div>
                                        <form method="POST" class="needs-validation" id="loginpembelianform">
                                            <input type="hidden" id="loginkodepaket" name="kodepaket" value="<?=$kodepaket?>">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <center>
                                                    <table class="tg">
                                                    <thead>
                                                            <tr>
                                                                <th class="tg-0pky">
                                                                <div class="g-signin2" data-onsuccess="onPembelianLogin" data-width="40"></div>
                                                                </th>
                                                                <th class="tg-0pky"><a href="<?= $authURL ?>"><img class="ml-2 pt-1" style="cursor:pointer;" width="30px" id="loginwithfacebook" src="<?= base_url('/public/assets/img/fb.png'); ?>" alt="facebook"></a>
                                                            </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    </center>
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                </div>
                                                <div class="col-lg-12">
                                                    <hr class="hr-text pt-4 pb-4" data-content="OR">
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" style="text-transform: lowercase" id="emaillogin" name="emaillogin" class="form-conti" placeholder="Masukan email" required>
                                                        <div class="invalid-feedback bg-secondary errorEmail">testte</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" id="passwordlogin" name="passwordlogin" class="form-conti" placeholder="Masukan Password" required>
                                                        <div class="invalid-feedback bg-secondary errorPhone">testte</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                </div>
                                                <div class="col-lg-12 pt-3">
                                                    <button type="submit" style="width:100%;" class="boxed-log float-right" tabindex="4" id="btnsend">
                                                        Login
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="pt-4 pb-4" align="center">Register menggunakan jejaring Sosial</div>
                                        <form method="POST" class="needs-validation" id="registerpembelianform">
                                            <input type="hidden" id="regiskodepaket" name="kodepaket" value="<?=$kodepaket?>">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!--
                                                    <button type="submit" class="boxed-google" tabindex="4">
                                                        Google
                                                    </button>
                                                    -->
                                                    <center>
                                                    <table class="tg">
                                                    <thead>
                                                            <tr>
                                                                <th class="tg-0pky">
                                                                <div class="g-signin2" data-onsuccess="onPembelianRegis" data-width="40"></div>
                                                                </th>
                                                                <th class="tg-0pky"><a href="<?= $regisurl ?>"><img class="ml-2 pt-1" style="cursor:pointer;" width="30px" id="regiswithfacebook" src="<?= base_url('/public/assets/img/fb.png'); ?>" alt="facebook"></a></a>
                                                            </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    </center>
                                                    
                                                </div>
                                                <div class="col-lg-6">
                                                    <!--<button type="submit" class="boxed-fb" tabindex="4">
                                                        FB
                                                    </button>-->
                                                    
                                                </div>
                                                <div class="col-lg-12">
                                                    <hr class="hr-text pt-4 pb-4" data-content="OR">
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" style="text-transform: lowercase" id="nama" name="nama" class="form-conti" placeholder="masukan nama" value="<?= ($fbregis == 'Yes')? $fb_fullname:'' ?>" required>
                                                        <div class="invalid-feedback bg-secondary errorEmail">testte</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Kota / Domisili</label>
                                                        <input type="text" id="kota" name="kota" class="form-conti" placeholder="masukan kota" required>
                                                        <div class="invalid-feedback bg-secondary errorPhone">testte</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" style="text-transform: lowercase" id="email" name="email" class="form-conti" placeholder="masukan email" value="<?= ($fbregis == 'Yes')? $fb_email:'' ?>" required>
                                                        <div class="invalid-feedback bg-secondary errorEmail">testte</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>No Hp</label>
                                                        <input type="text" id="nohp" name="nohp" class="form-conti" placeholder="masukan no hp" required>
                                                        <div class="invalid-feedback bg-secondary errorPhone">testte</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" style="text-transform: lowercase" id="password" name="password" class="form-conti" placeholder="masukan password" required>
                                                        <div class="invalid-feedback bg-secondary errorEmail">testte</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Konfirmasi Password</label>
                                                        <input type="password" id="repeat" name="repeat" class="form-conti" placeholder="konfirmasi password" required>
                                                        <div class="invalid-feedback bg-secondary errorPhone">testte</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                </div>
                                                <div class="col-lg-12 pt-3">
                                                    <button type="submit" style="width:100%;" class="boxed-log" tabindex="4" id="btnsend">
                                                        Register
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="white-body pb-4 pt-4 pl-4 pr-4" style="<?= ($loginpemb == 'Yes')? '':'display:none;'?>text-align: center;" id='logoutdiv'>
                                <a href="/pemblogout" class="boxed-cok mb-2">Logout</a>
                            </div>
                    </div>

                    <!-- tinggal ganti display aja dah jadi none atau show-->
                    <div style="<?= ($loginpemb == 'Yes')? '':'display:none'?>" id="infoandadiv">
                        <div class="black-header pb-4 pt-4 pl-4 pr-4" style="background-color: #55341d;">
                            <div class="">
                            <div class="imgBox">
                                    <div class="action">
                                    <div class="waricon" onclick="warningToggle();">
                                    <img class="float-right" width="30px" src="<?= base_url(); ?>/public/assets/img/warn.png" alt="warning">
                                    </div>
                                    <div class="isian">
                                        <ul class="hor"> 
                                            <li class="wrkun"><img class="float-right" width="45px" src="<?= base_url(); ?>/public/assets/img/ser.png" alt="warning"></li>
                                            <li class="wrput">
                                                <center>
                                                <a>Data diri wajib diisi dengan sebenar-benarnya<br>
                                                <a class="gotit" onclick="warningToggle();">Mengerti</a></a>
                                                </center>
                                            </li>
                                        </ul>
                                    </div>
                                    </div>
                                    <script>
                                        function warningToggle() {
                                            const tonggleWarning = document.querySelector('.isian');
                                            tonggleWarning.classList.toggle('active')
                                        }
                                    </script>
                                </div>
                                <div style="color:#fff; font-size:15px;">2. Informasi Kamu</div>
                            </div>
                        </div>
                        <div class="white-body pb-4 pt-4 pl-4 pr-4">
                        <div class="pb-4 cubam" align="left">Hallo <a style="font-weight: bold;" id="userfullname"><?= ($loginpemb == 'Yes')? $fullname:'*Nama User*' ?></a>, detail informasi Kamu :</div>
                        <table>
                            <tr>
                                <td width="200px">
                                    <div class="cubam">Email</div>
                                    <div class="cubam">No Handphone</div>
                                    <!--<div class="cubam">Username</div>-->
                                </td>
                                <td>
                                    <div class="cubam">: <a id="useremail"><?= ($loginpemb == 'Yes')? $email:'*Alamat Email*' ?></a></div>
                                    <div class="cubam">: <a id="userphone"><?= ($loginpemb == 'Yes')? $nohp:'*No Handphone*' ?></a></div>
                                    <!--<div class="cubam">: <a id="userfullname">*Username*</a></div>-->
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div>

                    <div class="black-header pb-4 pt-4 pl-4 pr-4 mt-4" style="background-color: #55341d;">
                                <div   div class="imgBox">
                                    <div class="action">
                                    <div class="waricon" onclick="warningToggle1();">
                                    <img class="float-right" width="30px" src="<?= base_url(); ?>/public/assets/img/warn.png" alt="warning">
                                    </div>
                                    <div class="isian1">
                                        <ul class="hor"> 
                                            <li class="wrkun"><img class="float-right" width="45px" src="<?= base_url(); ?>/public/assets/img/ser.png" alt="warning"></li>
                                            <li class="wrput">
                                                <center>
                                                <a>Pilih paket sesuai dengan yang anda inginkan<br>
                                                <a class="gotit" onclick="warningToggle1();">Mengerti</a></a>
                                                </center>
                                            </li>
                                        </ul>
                                    </div>
                                    </div>
                                    <script>
                                        function warningToggle1() {
                                            const tonggleWarning = document.querySelector('.isian1');
                                            tonggleWarning.classList.toggle('active')
                                        }
                                    </script>
                                </div>
                        <div style="color:#fff; font-size:15px;" id="orderkamudiv"><?= ($loginpemb == 'Yes')? '3. Order Kamu':'2. Order Kamu' ?></div>
                    </div>
                    <div class="white-body pb-4 pt-4 pl-4 pr-4">
                        <div class="row pb-4 pt-4">
                            <div class="col-lg-6">
                                <select name="pilihpaket" id="pilihpaket" class="pembelian-select">
                                    <?php
                                        foreach($paket as $p){
                                            if($p['kode_harga_paket'] != 'HPKT001'){
                                                $select = '';
                                                if($p['kode_harga_paket'] == $d['kode_harga_paket']){
                                                    $select = 'selected';
                                                }
                                                echo '<option value="'.$p['kode_harga_paket'].'" '.$select.'>'.$p['title'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <select name="pilihplan" id="pilihplan" class="pembelian-select">
                                    <option value="bulan">Per Bulan - <?=rupiah($d['harga_paket'])?></option>
                                    <option value="tahun">Per Tahun - <?=rupiah($d['harga_paket_tahunan'])?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="black-header pb-4 pt-4 pl-4 pr-4 mt-4" style="background-color: #55341d;">
                        <div style="color:#fff; font-size:15px;" id="discmemberdiv"><?= ($loginpemb == 'Yes')? '4. Diskon Member Dan Referal':'3. Diskon Member Dan Referal' ?></div>
                    </div>
                    <div class="white-body pb-4 pt-4 pl-4 pr-4">
                        <div class="row pb-4 pt-4">
                            <div class="col-lg-12">
                                <!-- <div class="green">Pilih sudah menjadi member untuk mendapatkan potongan harga member (Tidak Wajib)</div>

                                <div class="radio">
                                    <input id="member" name="member" type="radio" value="member" checked>
                                    <label for="radio-1" class="radio-label">Sudah menjadi member komunitas panenSAHAM</label>
                                </div>

                                <form method="POST" class="needs-validation" id="memberpembelianform">
                                    <div class="row">
                                       <div class="col-lg-2 mt-2" align="center">Email</div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <input type="hidden" id="membercheck" name="membercheck" value="<?= ($loginpemb == 'Yes' && $member != '')? 'true':'false' ?>">
                                                <input type="text" id="emailanggotapembelian" name="emailanggotapembelian" class="form-conti" placeholder="Masukan email yang terdaftar" value="<?= ($loginpemb == 'Yes' && $member != '')? $member:'' ?>" required>
                                                <div class="invalid-feedback bg-secondary errorPhone">testte</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <?php
                                                if($loginpemb != 'Yes' || ($loginpemb == 'Yes' && $member == '')){
                                            ?>
                                                <button type="submit" id="submitmemberpembelianform" style="width:100%; display:show;" class="boxed-log float-right" tabindex="4" id="btnsend">
                                                    Tambahkan
                                                </button>
                                            <?php
                                                }
                                            ?>
                                            <img id="successmember" style="<?= ($loginpemb == 'Yes' && $member != '')? '':'display:none' ?>" width="40px" src="<?= base_url(); ?>/public/assets/img/cen.png" alt="sc">
                                        </div>
                                    </div>
                                </form>
                                
                                <?php
                                    if($loginpemb != 'Yes' || ($loginpemb == 'Yes' && $member == '')){
                                ?>
                                    <div class="radio" id="nonmemberdiv">
                                        <input id="nonmember" name="member" value="nonmember" type="radio">
                                        <label for="radio-2" class="radio-label">Belum menjadi member</label>
                                    </div>
                                <?php
                                    }
                                ?> -->
                                
                                <div class="green">Masukan kode referal jika anda mempunyai kode referal (Tidak Wajib)</div>
                                <form method="POST" class="needs-validation" id="refcodepembelianform">
                                    <div class="row pt-4">
                                        <div class="col-lg-2 mt-2" align="center">Kode Referal</div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <input type="text" id="pembrefcode" name="pembrefcode" class="form-conti" placeholder="Masukan kode referal" value="<?= ($loginpemb == 'Yes' && $refcode != '')? $refcode:'' ?>" required>
                                                <div class="invalid-feedback bg-secondary errorPhone">testte</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                        <?php
                                            if($loginpemb != 'Yes' || ($loginpemb == 'Yes' && $refcode == '')){
                                        ?>
                                            <button type="submit" id="submitrefcodepembelianform" style="width:100%;" class="boxed-log float-right" tabindex="4" id="btnsend">
                                                Tambahkan
                                            </button>
                                        <?php
                                            }
                                        ?>
                                            <img id="successrefcode" style="<?= ($loginpemb == 'Yes' && $refcode != '')? '':'display:none' ?>" width="40px" src="<?= base_url(); ?>/public/assets/img/cen.png" alt="sc">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                            </div>
                        </div>
                    </div>
                    <div class="black-header pb-4 pt-4 pl-4 pr-4 mt-4" style="background-color: #55341d;">
                                <div   div class="imgBox">
                                    <div class="action">
                                    <div class="waricon" onclick="warningToggle2();">
                                    <img class="float-right" width="30px" src="<?= base_url(); ?>/public/assets/img/warn.png" alt="warning">
                                    </div>
                                    <div class="isian2">
                                        <ul class="hor"> 
                                            <li class="wrkun"><img class="float-right" width="45px" src="<?= base_url(); ?>/public/assets/img/ser.png" alt="warning"></li>
                                            <li class="wrput">
                                                <center>
                                                <a>Pilih salah satu untuk melakukan pembayaran<br>
                                                <a class="gotit" onclick="warningToggle2();">Mengerti</a></a>
                                                </center>
                                            </li>
                                        </ul>
                                    </div>
                                    </div>
                                    <script>
                                        function warningToggle2() {
                                            const tonggleWarning = document.querySelector('.isian2');
                                            tonggleWarning.classList.toggle('active')
                                        }
                                    </script>
                                </div>
                        <div style="color:#fff; font-size:15px;" id="carapembayarandiv"><?= ($loginpemb == 'Yes')? '5. Cara Pembayaran':'4. Cara Pembayaran' ?></div>
                    </div>
                    <div class="white-body pb-4 pt-4 pl-4 pr-4 mb-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="green">Pilih metode pembayaran</div>
                                <div class="radio">
                                    <input id="radio-3" name="tipepay" type="radio" checked>
                                    <label for="radio-3" class="radio-label">Transfer ATM Bersama / Virtual Account / Indomaret / Credit Card / Go-Pay</label>
                                </div>
                                <!-- <div class="radio">
                                    <input id="radio-4" name="tipepay" type="radio">
                                    <label for="radio-4" class="radio-label">QRIS</label>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="white-body pb-4 pt-4 pl-4 pr-4 mb-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="POST" class="needs-validation" id="pembelianform">
                                    <input type="hidden" id="kodepaket" name="kodepaket" value="<?=$kodepaket?>">
                                    <h3>Rangkuman Order</h3>
                                    <hr>
                                    <h5 class="float-right" id="normalprice"><?= rupiah($d['harga_paket']) ?></h5>
                                    <div style="color:#6B6B6B; font-weight:bold;"><?= $d['title'] ?></div>
                                    <br>
                                    <div style="color:#6B6B6B; font-weight:bold;">Pilihan penagihan</div>
                                    <div class="pl-4 pt-2" id="">Per Bulan - <a id='normalprice2' ><?=rupiah($d['harga_paket'])?></a></div>
                                    <br>
                                    <div style="color:#6B6B6B; font-weight:bold;">Pilihan pembayaran</div>
                                    <div class="pl-4 pt-2">Transfer ATM Bersama / Virtual Account / Indomaret / Credit Card / Go-Pay</div>
                                    <br>
                                    <div id="discBox" style="<?= ($loginpemb == 'Yes' && $refcode != '')? '':'display:none' ?>">
                                        <h5 class="float-right" style="text-decoration: line-through red;" id="normalprice3"><?=rupiah($d['harga_paket'])?></h5>
                                        <div style="color:#6B6B6B; font-weight:bold;">Diskon Member</div>
                                        <div class="pl-4 pt-2">Member komunitas & koperasi
                                            <h5 class="float-right" id="discMember"><?= rupiah($d['harga_koperasi']) ?></h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="float-right" id="admin">Rp. 5.000</h5>
                                    <div style="color:#6B6B6B; font-weight:bold;">Biaya Admin</div>
                                    <br>
                                    <h5 class="float-right" id="totalPrice"><?= ($loginpemb == 'Yes' && $refcode != '')? rupiah($d['harga_koperasi']+5000):rupiah($d['harga_paket']+5000)?></h5>
                                    <div style="color:#6B6B6B; font-weight:bold;">TOTAL</div>
                                    <br>
                                    <div class="form-check">
                                        <input style="width:20px;" class="form-check-input" type="checkbox" value="true" name="termsagree" id="termsagree" required>
                                        <label class="form-check-label pl-2" for="defaultCheck1">
                                            Saya telah membaca dan menyetujui <a href="<?= site_url('termsconditions'); ?>" style="text-decoration: underline;"> syarat dan ketentuan</a>
                                        </label>
                                    </div>
                                    <button type="submit" style="width:30%;" class="boxed-log float-right" tabindex="4" id="btnsend">
                                        Next
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<?= $this->endSection(); ?>