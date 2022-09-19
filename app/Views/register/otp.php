<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?= base_url() ?>/public/assets/img/favicon.png" type="image/gif" sizes="16x16">
    <title>Monika PanenSaham &mdash; Register</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/sweetalert2.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        var base_url = '<?= base_url() ?>/';
    </script>
</head>

<body style="background-color:#C1C1C1;">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="login-card col-xl-4 offset-xl-4">
                        <form method="POST" id="formregisotpverif" class="needs-validation">
                            <div class="card">
                                <a class="mt-3 ml-4" style="text-align: left;" href="" id="changeregisphone">BACK</a><br>
                                <div class="text-muted text-center">
                                    <img class="pb-5" alt="logo" src="<?= base_url() ?>/public/assets/img/ps-logo.png" width="300px" height="">
                                </div>
                                <h4 style="text-align: center;">Verifikasi Kode</h4>
                                <a class="pl-5 pr-5">Kami telah mengirimkan sms ke No Handphone anda, Masukan kode pada sms tersebut dibawah.<br>( +62 <?= $nohp ?> )</a>

                                <div class="card-body">
                                    <div>
                                        <div class="container body-content">
                                            <div>
                                                <div id="SMSArea" class="row SMSArea pb-5">
                                                    <div class="col-2">
                                                        <input type="text" id="code1" name="code1" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="smsCode text-center rounded-lg" />
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" id="code2" name="code2" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="smsCode text-center rounded-lg" />
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" id="code3" name="code3" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="smsCode text-center rounded-lg" />
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" id="code4" name="code4" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="smsCode text-center rounded-lg" />
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" id="code5" name="code5" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="smsCode text-center rounded-lg" />
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" id="code6" name="code6" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="smsCode text-center rounded-lg" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button style="width:100%;" type="submit" class="btn btn-warning" tabindex="4">
                                                        Verifikasi
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="pt-2" style="text-align: center;">Tidak menerima sms ?</div>
                                            <div style="text-align: center;"><a href="#" id="regissendotp">Kirim Ulang</a> atau <a href="#" id="changeregisphone">Ubah No Handphone</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/public/assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/popper.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/modules/moment.min.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/stisla.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/function.js?rnd=<?=rand()?>"></script>
    <script src="<?= base_url() ?>/public/assets/js/sweetalert2.min.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/public/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/public/assets/js/custom.js"></script>

    <script type="text/javascript">
        $(function() {
            var smsCodes = $('.smsCode');

            function goToNextInput(e) {
                var key = e.which,
                    t = $(e.target);
                    // Get the next input
                    
                if(key === 9 || (key >= 48 && key <= 57)){
                    sib = t.closest('div').next().find('.smsCode');
                    
                    // Tab

                    if (key === 9) {
                        console.log("===9");
                        return true;
                    }

                    /*
                    if (!sib || !sib.length) {
                        console.log("!sib || !sib.length");
                        sib = $('.smsCode').eq(0);
                        console.log(sib);
                    }*/
                    
                    sib.select().focus();
                }else if(key === 8){
                    sib = t.closest('div').prev().find('.smsCode');

                    sib.select().focus();
                }
            }

            function onKeyDown(e) {
                var key = e.which;
                // only allow tab and number
                if (key === 9 || key === 8 || (key >= 48 && key <= 57)) {
                    return true;
                }

                e.preventDefault();
                return false;
            }

            function onFocus(e) {
                $(e.target).select();
            }

            smsCodes.on('keyup', goToNextInput);
            smsCodes.on('keydown', onKeyDown);
            smsCodes.on('click', onFocus);
        })
    </script>

    <!-- <script type="text/javascript">
        $(function() {
            var smsCodes = $('.smsCode');
            function goToNextInput(e) {
                var key = e.which,
                    t = $(e.target),
                    // Get the next input
                    sib = t.closest('div').next().find('.smsCode');
                // Not allow any keys to work except for tab and number
                if (key != 9 && (key < 48 || key > 57)) {
                    console.log("!=9");
                    e.preventDefault();
                    return false;
                }
                // Tab
                if (key === 9) {
                    console.log("===9");
                    return true;
                }
                // Go back to the first one
                if (!sib || !sib.length) {
                    console.log("!sib || !sib.length");
                    sib = $('.smsCode').eq(0);
                    console.log(sib);
                }
                sib.select().focus();
            }
            function onKeyDown(e) {
                var key = e.which;
                // only allow tab and number
                if (key === 9 || (key >= 48 && key <= 57)) {
                    return true;
                }
                e.preventDefault();
                return false;
            }
            function onFocus(e) {
                $(e.target).select();
            }
            smsCodes.on('keyup', goToNextInput);
            smsCodes.on('keydown', onKeyDown);
            smsCodes.on('click', onFocus);
        })
    </script> -->
</body>

</html>