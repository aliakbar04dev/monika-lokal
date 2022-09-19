<div class="col-lg-6">
    <div class="cilok">
        <h4>About us</h4>
    </div>
    <p><b style="color:#EAA401;">MONIKA</b> adalah aplikasi yang membuat belajar anda lebih simple, santai dan tenang dalam
        menjalani bisnis dipasar modal.</p>
    <h5><span style="color: #EAA401;">"Dia akan setia menemani anda sepanjang hari"</span></h5>
    <p>Memberikan informasi chart, screening dan alert secara realtime. dan membuat anda serasa
        memiliki asisten pribadi dalam bisnis pasar modal ditengah-tengah kesibukan anda sehari-hari.
    </p>
    <div class="row">
        <?php foreach ($about as $ab) : ?>
            <div class="col-md-6">
                <img src="<?= $ab['link_media']; ?>" width="100%">
            </div>
        <?php endforeach; ?>
        <!-- <div class="col-md-6">
            <img src="<?= base_url(); ?>/public/assets/img/about-us/asis-gambar2.png" width="100%" class="img-fluid">
        </div>
        <div class="col-md-6">
            <img src="<?= base_url(); ?>/public/assets/img/about-us/asis-gambar3.png" width="100%" class="img-fluid">
        </div>
        <div class="col-md-6">
            <img src="<?= base_url(); ?>/public/assets/img/about-us/asis-gambar4.png" width="100%" class="img-fluid">
        </div> -->
    </div>
</div>