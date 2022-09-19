<?= $this->extend('components/template_menu') ?>

<?= $this->section('content_menu') ?>

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>

<style>
    #page-about {
        padding-top: 50px;
        padding-bottom: 50px;
        position: relative;
    }

    #page-about::before {
        content: '';
        background: url('public/assets/img/landing/bg-pricing.jpg') no-repeat;
        width: 100%;
        height: 330px;
        background-size: cover;
        position: absolute;
        background-position: bottom;
        top: 30%;
        transform: translate(0, -50%);
    }

    .text-yellow {
        color: #d79702;
    }
</style>

<?php
    use CodeIgniter\HTTP\UserAgent;
    $this->request = \Config\Services::request();
    $agent = $this->request->getUserAgent();
    $mobile = $agent->isMobile();
?>

<?php if ($mobile == true): ?>
    <div id="page-about" style="font-family: 'Poppins';">
        <div class="container">
            <div class="row">
                <div class="col-lg-5" style="text-align: center;">
                    <img src="<?php echo base_url('public/assets/img/about-us/foto-about.png') ?>" alt="" style="width: 80%;">
                </div>
                <div class="col-lg-7 content-left p-4" style="text-align: center;">
                    <div class="text-center">
                        <h1 class="text-yellow" style="font-family: 'Poppins'; font-weight: bold;">TENTANG MONIKA</h1>
                    </div>

                    <p style="font-family: 'Poppins';">MONIKA adalah aplikasi yang membuat belajar anda lebih simple, santai
                        dan tenang dalam menjalani bisnis dipasar modal.</p>

                    <p class="text-yellow" style="font-family: 'Poppins'; font-weight: bold;">"Dia akan setia menemani anda
                        sepanjang hari"</p>

                    <p style="font-family: 'Poppins';">Memberikan informasi chart, screening dan alert secara realtime. dan
                        membuat anda serasa memiliki asisten pribadi dalam bisnis pasar modal ditengah-tengah kesibukan anda
                        sehari-hari.</p>
                </div>
                
            </div>
        </div>
    </div>
<?php else: ?>
    <div id="page-about" style="font-family: 'Poppins';">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 content-left wow fadeInLeft" data-wow-delay="0.2s" style="text-align: left;">
                    <div class="text-center">
                        <h1 class="text-yellow" style="font-family: 'Poppins'; font-weight: bold; margin-top:15%;">TENTANG MONIKA</h1>
                    </div>

                    <p style="font-family: 'Poppins';">MONIKA adalah aplikasi yang membuat belajar anda lebih simple, santai
                        dan tenang dalam menjalani bisnis dipasar modal.</p>

                    <p class="text-yellow" style="font-family: 'Poppins'; font-weight: bold;">"Dia akan setia menemani anda
                        sepanjang hari"</p>

                    <p style="font-family: 'Poppins';">Memberikan informasi chart, screening dan alert secara realtime. dan
                        membuat anda serasa memiliki asisten pribadi dalam bisnis pasar modal ditengah-tengah kesibukan anda
                        sehari-hari.</p>
                </div>
                <div class="col-lg-5 wow fadeInRight" data-wow-delay="0.4s" style="text-align: left;">
                    <img src="<?php echo base_url('public/assets/img/about-us/foto-about.png') ?>" alt=""
                        style="width: 80%;">
                </div>
            </div>
        </div>
    </div>
<?php endif ?>


<?= $this->endSection(); ?>