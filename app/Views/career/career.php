<?= $this->extend('components/template_menu') ?>

<?= $this->section('content_menu') ?>
<link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/career.css">

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>
<?= $this->include('career/m_career'); ?>
<section class="satu d-none d-lg-block">
    <div class="container pt-5 pb-5">
        <div class="row ">
            <img width="100%" src="<?= base_url(); ?>/public/assets/img/career/ban.png">
        </div>
    </div>
</section>
<section class="dua d-none d-lg-block">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-12">
                <center>
                    <img width="25%" src="<?= base_url(); ?>/public/assets/img/career/fly.png">
                    <h3 class="mt-5">Kami adalah perusahaan yang bergerak di bidang investasi</h3>
                </center>
            </div>
        </div>
    </div>
</section>
<section class="tiga d-none d-lg-block">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <center>
                                    <p style="font-size: 20px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus illum veniam, ratione dignissimos hic id quod facere sunt odio sint dolores provident, doloremque, modi quae voluptatem ab illo porro optio? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam itaque maiores incidunt nulla ullam in similique neque, cum voluptatem praesentium vitae nihil architecto, sint inventore eius et sed ipsam iste? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus tempore ducimus odio facere quo minus consectetur perferendis neque! Temporibus repellat iure eum nisi alias officiis consequatur, magnam facilis ipsa quibusdam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur quos nihil labore, commodi possimus excepturi exercitationem provident soluta nemo quis? Deleniti delectus dolores suscipit rem impedit id fugit non deserunt! Lorem ipsum dolor sit, amet consectetur adipisicing elit. <br> Expedita harum veniam recusandae illo eaque ratione nostrum optio eum ex facere temporibus dignissimos officia, delectus suscipit, fugit, voluptate rem? Odio, ullam.</p>
                                    <h3 class="mt-5">Are you the one ?</h3>
                                    <button style="width:auto;" class="boxed-save mt-3" tabindex="4">
                                        Bergabung dengan kami
                                    </button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pl-4 pr-4 empat d-none d-lg-block">
    <div class="container pt-5 pb-5">
        <div class="row ">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="nyaman">
                            <center>
                                <img class="mt-5 mb-5" width="25%" src="<?= base_url(); ?>/public/assets/img/zona1.png">
                                <h3>Value 1</h3>
                                <p class="ml-5 mr-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, natus. Omnis molestias eaque ipsa aliquam? Doloremque, quas facere! Numquam sed tempore enim perspiciatis. Consectetur veniam, eligendi dolor ad laborum quas.</p>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="zona">
                            <center>
                                <img class="mt-4 mb-5" width="25%" src="<?= base_url(); ?>/public/assets/img/zona2.png">
                                <h3>Value 2</h3>
                                <p class="ml-5 mr-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed expedita excepturi doloremque obcaecati saepe voluptatibus tempora necessitatibus, aperiam vel odit, voluptates provident vero minus. Nesciunt amet iusto quidem nostrum quibusdam?</p>
                                <a href="<?= base_url('/newreg'); ?>" class="boxed-cok mb-2 mb-5">Register Sekarang</a>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="nyaman">
                            <center>
                                <img class="mt-5 mb-5" width="25%" src="<?= base_url(); ?>/public/assets/img/zona3.png">
                                <h3>Value 3</h3>
                                <p class="ml-5 mr-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt repellat aut iusto aliquam non sit consectetur eaque odio numquam inventore. Eligendi tempora reprehenderit error optio molestias alias nam dolor quos!</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="lima d-none d-lg-block">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-12 pl-4 pl-lg-5 pr-lg-1 d-flex align-items-stretch">
                    <div class="contentt d-flex flex-column justify-content-center">
                        <h3 style="color:#614D12;" class="pb-4" data-aos="fade-in" align="center" data-aos-delay="100">Keuntungan Bergabung
                        </h3>
                        <div class="row pt-5">
                            <div class="col-md-4 icon-box" data-aos="fade-up">
                                <img style="width:45px; height:45px;" src="<?= base_url(); ?>/public/assets/img/cekijo.png" alt="">
                                <a class="pl-2" style="font-size:17px;" href="#"><strong>User Friendly</strong></a>
                                <p class="pl-5 ml-2">Tampilan aplikasi yang sangat mudah untuk digunakan</p>
                            </div>
                            <div class="col-md-4 icon-box" data-aos="fade-up">
                                <img style="width:45px; height:45px;" src="<?= base_url(); ?>/public/assets/img/cekijo.png" alt="">
                                <a class="pl-2" style="font-size:17px;" href="#"><strong>Fitur Lengkap</strong></a>
                                <p class="pl-5 ml-2">Dapatkan fitur yang lengkap dan terbaik yang dapat diakses di
                                    platform mobile</p>
                            </div>
                            <div class="col-md-4 icon-box" data-aos="fade-up">
                                <img style="width:45px; height:45px;" src="<?= base_url(); ?>/public/assets/img/cekijo.png" alt="">
                                <a class="pl-2" style="font-size:17px;" href="#"><strong>Cepat & Ringan</strong></a>
                                <p class=" pl-5 ml-2">Rasakan sensasi trading yang cepat dan ringan dengan batuan
                                    tools
                                    dari kamu
                                </p>
                            </div>
                            <div class="col-md-4 icon-box" data-aos="fade-up">
                                <img style="width:45px; height:45px;" src="<?= base_url(); ?>/public/assets/img/cekijo.png" alt="">
                                <a class="pl-2" style="font-size:17px;" href="#"><strong>Swift & Smooth</strong></a>
                                <p class=" pl-5 ml-2">Transisi aplikasi yang halus dan kemudahan untuk Anda</p>
                            </div>
                            <div class="col-md-4 icon-box" data-aos="fade-up">
                                <img style="width:45px; height:45px;" src="<?= base_url(); ?>/public/assets/img/cekijo.png" alt="">
                                <a class="pl-2" style="font-size:17px;" href="#"><strong>Cepat & Ringan</strong></a>
                                <p class=" pl-5 ml-2">Rasakan sensasi trading yang cepat dan ringan dengan batuan
                                    tools
                                    dari kamu
                                </p>
                            </div>
                            <div class="col-md-4 icon-box" data-aos="fade-up">
                                <img style="width:45px; height:45px;" src="<?= base_url(); ?>/public/assets/img/cekijo.png" alt="">
                                <a class="pl-2" style="font-size:17px;" href="#"><strong>Swift & Smooth</strong></a>
                                <p class=" pl-5 ml-2">Transisi aplikasi yang halus dan kemudahan untuk Anda</p>
                            </div>
                        </div>
                        <br>
                    </div>
                </div><!-- End .content-->
            </div>
        </div>
    </div>
</section>
<section class="enam d-none d-lg-block">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-md-12 pl-4 pl-lg-5 pr-lg-1 d-flex align-items-stretch">
                <div class="col-md-12 contentt d-flex flex-column justify-content-center">
                    <h2 style="color:#55341D;" class="pb-4" data-aos="fade-in" align="center" data-aos-delay="100">We're Hiring!
                    </h2>
                    <div class="container">
                        <div class="col-lg-12">
                            <div class="row pb-3">
                                <div class="col-lg-12 pseudo-search">
                                    <input id="searchjob" type="text" placeholder="Search Job.." autofocus required>
                                    <i class="fa fa-search" type="submit"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-lg-3">
                            <select id="searchlok" class="form-select" aria-label="Default select example">
                                <option selected value="">Lokasi</option>
                                <?php
                                    foreach ($lokasi as $l) {
                                        echo '<option value="' . $l['lokasi_pekerjaan'] . '">' . $l['lokasi_pekerjaan'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select id="searchdept" class="form-select" aria-label="Default select example">
                                <option selected value=''>Department</option>
                                <?php
                                    foreach ($depart as $l) {
                                        echo '<option value="' . $l['nama_departemen'] . '">' . $l['nama_departemen'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select id="searchwork" class="form-select" aria-label="Default select example">
                                <option selected value=''>Work Type</option>
                                <?php
                                    foreach ($kategori as $l) {
                                        echo '<option value="' . $l['kategori_pekerjaan'] . '">' . $l['kategori_pekerjaan'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label class="switch">
                                <input id="remonly" type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-lg-2">
                            <div class="pt-2">
                                <a>Remote Only</a>
                            </div>
                        </div>
                    </div>
                    <table id="joblist" class="table table-striped">
                        <tbody>
                            <?php
                                foreach ($karir as $l) {
                                    echo '<tr>
                                        <td class="karjob"><a href="'.site_url('detail').'/'.$l['id_karir'].'">'.$l['karir'].'</a><td>
                                        <td class="depjob">'.$l['nama_departemen'].'<td>
                                        <td class="locjob">'.$l['lokasi_pekerjaan'].'<td>
                                        <td class="katjob">'.$l['kategori_pekerjaan'].'<td>
                                    </tr>';
                                }
                            ?>
                            <!--<tr>
                                <th width="5%" scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td width="10%"><button onclick="window.location='<?= site_url('detail'); ?>';" style="width:auto;" class="boxed-save" tabindex="4">
                                        detailnya disini
                                    </button>
                                </td>
                            </tr>-->
                        </tbody>
                    </table>
                    <center>
                        <div><button onclick="window.location='<?= site_url('list'); ?>';" style="width:auto;" class="boxed-save mt-3" tabindex="4">
                                Bergabung dengan kami
                            </button>
                        </div>
                    </center>
                </div>
                <br>
            </div>
        </div><!-- End .content-->
    </div>
</section>
<section class="lapan d-none d-lg-block">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-12">
                <center>
                    <iframe class="vid" src="https://iframe.videodelivery.net/688a3a040febfe2ff6d6380bdf33c364" style="border: none;" allow="accelerometer; gyroscope; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe>
                </center>
            </div>
        </div><!-- End .content-->
    </div>
</section>
<section class="tujuh d-none d-lg-block">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-12">
                <h3 style="color:#ffffff; font-size:30px;" class="pb-4" data-aos="fade-in" align="center" data-aos-delay="100">Testimonial
                </h3>
                <div class="row">
                    <?php
                        foreach ($testi as $l) {
                            $style = '';

                            if($l['is_highlight'] > 0){
                                $style = 'style="background-image: linear-gradient(to bottom right, #5C2D10, #c06c17);"';
                            }

                            echo '<div class="col-lg-4">
                                    <div class="zona" '.$style.'>
                                        <center>
                                            <img class="mt-5 mb-5 radius" width="30%" src="'.base_url().$l['foto'].'">
                                            <h3>'.$l['nama'].'</h3>
                                            <a style="color: #D2A907;">'.$l['divisi'].'</a>
                                            <p class="ml-5 mr-5 pb-5">'.$l['testimoni'].'</p>
                                        </center>
                                    </div>
                                </div>';
                        }
                    ?>
                    <!--
                    <div class="col-lg-4 pt-3">
                        <div class="zona">
                            <center>
                                <img class="mt-5 mb-5 radius" width="30%" src="<?= base_url(); ?>/public/assets/img/user.jpg">
                                <h3>Jessica Johnson</h3>
                                <a style="color: #D2A907;">Seksi Humas</a>
                                <p class="ml-5 mr-5 pb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, natus. Omnis molestias eaque ipsa aliquam? Doloremque, quas facere! Numquam sed tempore enim perspiciatis. Consectetur veniam, eligendi dolor ad laborum quas.</p>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="zona pt-4" style="background-image: linear-gradient(to bottom right, #5C2D10, #c06c17);">
                            <center>
                                <img class="mt-5 mb-5 radius" width="30%" src="<?= base_url(); ?>/public/assets/img/user.jpg">
                                <h3 style="color: #fff;">John Doe</h3>
                                <a style="color: #fff;">Seksi Humas</a>
                                <p style="color: #fff;" class="ml-5 mr-5 pb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed expedita excepturi doloremque obcaecati saepe voluptatibus tempora necessitatibus, aperiam vel odit, voluptates provident vero minus. Nesciunt amet iusto quidem nostrum quibusdam?</p>

                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-3">
                        <div class="zona">
                            <center>
                                <img class="mt-5 mb-5 radius" width="30%" src="<?= base_url(); ?>/public/assets/img/user.jpg">
                                <h3>Jonathan Strauss</h3>
                                <a style="color: #D2A907;">Seksi Humas</a>
                                <p class="ml-5 mr-5 pb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt repellat aut iusto aliquam non sit consectetur eaque odio numquam inventore. Eligendi tempora reprehenderit error optio molestias alias nam dolor quos!</p>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="zona">
                            <center>
                                <img class="mt-5 mb-5 radius" width="30%" src="<?= base_url(); ?>/public/assets/img/user.jpg">
                                <h3>Jessica Johnson</h3>
                                <a style="color: #D2A907;">Seksi Humas</a>
                                <p class="ml-5 mr-5 pb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, natus. Omnis molestias eaque ipsa aliquam? Doloremque, quas facere! Numquam sed tempore enim perspiciatis. Consectetur veniam, eligendi dolor ad laborum quas.</p>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="zona">
                            <center>
                                <img class="mt-5 mb-5 radius" width="30%" src="<?= base_url(); ?>/public/assets/img/user.jpg">
                                <h3>John Doe</h3>
                                <a style="color: #D2A907;">Seksi Humas</a>
                                <p class="ml-5 mr-5 pb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed expedita excepturi doloremque obcaecati saepe voluptatibus tempora necessitatibus, aperiam vel odit, voluptates provident vero minus. Nesciunt amet iusto quidem nostrum quibusdam?</p>

                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="zona">
                            <center>
                                <img class="mt-5 mb-5 radius" width="30%" src="<?= base_url(); ?>/public/assets/img/user.jpg">
                                <h3>Jonathan Strauss</h3>
                                <a style="color: #D2A907;">Seksi Humas</a>
                                <p class="ml-5 mr-5 pb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt repellat aut iusto aliquam non sit consectetur eaque odio numquam inventore. Eligendi tempora reprehenderit error optio molestias alias nam dolor quos!</p>
                            </center>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="col-lg-12 d-none d-lg-block">
        <div class="row">
            <div class="col-lg-6 pl-0 pr-0">
                <div class="embed-responsive embed-responsive-16by9"><iframe width="50%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.851637563683!2d106.89615431427221!3d-6.150617995546817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f547ab657a83%3A0xf10d3a3df71e1ffd!2sRadio%20PanenSaham!5e0!3m2!1sid!2sid!4v1608213559639!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="col-lg-6 tengahin">
                <div class="row tengahin">
                    <div class="contentt d-flex flex-column justify-content-center">
                        <h3 style="color:#69330F; " data-aos="fade-in" align="left" data-aos-delay="100">Komunitas PanenSaham
                        </h3>
                        <p style="font-size: 15px;"><strong>Gading bukit indah</strong> blok A No 27 Kelapa Gading Barat, Kelapa Gading Jakarta Utara 14240</p>
                        <div class="row pt-5">
                            <div class="col-md-6 icon-box" data-aos="fade-up">
                                <a class="" style="font-size:16px; color:#A4A4A4;" href="#"><strong>Customer Service</strong></a>
                                <p style="font-size:16px;">support.monika@panensaham.com<br>021-45852710<br>021-45852711</p>
                            </div>
                            <!-- <div class="col-md-6 icon-box" data-aos="fade-up">
                                <a class="" style="font-size:16px; color:#A4A4A4;" href="#"><strong>Customer Support</strong></a>
                                <p style="font-size:16px;">support.aps@panensaham.com<br>021-45852711</p> -->
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>