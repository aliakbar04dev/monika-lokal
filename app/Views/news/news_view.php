<?= $this->extend('components/template_admin') ?>
<?= $this->section('content_admin') ?>

<style>
    .page-item .page-link {
        background-color: #fff;
        border-color: #fff;
        color: #888888;
        padding-left: 17px;
        padding-right: 17px;
        
    }
    .page-item.active .page-link {
        background-color: #FBDC8E;
        border-color: #FBDC8E;
        color: #DD9B00;
        padding-left: 17px;
        padding-right: 17px;
        
    }
</style>

<main class="body" id="main">
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <?= $this->include('menu/menu_left1'); ?>

                <?php if ($buatHP == true) : ?>
                    <div class="col-lg-12">
                        <div class="mb-3 p-3" style="background-color: #eeeeee; margin-top:-40px;">
                            <div class="header">
                                <h3 class="mb-4">
                                    News Update
                                    <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
                                    <!-- Histats.com  START  (aync)-->
                            
                                    <!-- Histats.com  END  -->
                                </h3>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h6 style="font-size: 13px; color:#000;">
                                            <!-- <a>Stock & Market Update</a> -->
                                            <!-- <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp; -->
                                            <a style="font-weight: bold; color:#DD9B00;" href="<?= base_url('news') ?>">News</a>
                                            <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                            <a  href="<?= base_url('informasibursa') ?>">Informasi Bursa</a>
                                            <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                            <a href="<?= base_url('emitenipo') ?>">Emiten IPO, Raport Emiten, Special Report</a>
                                        </h6>
                                    </div>
                                    <div class="col-lg-4">
                                        

                                        <?php if ($nm_kode == ' '): ?>
                                            <form action="news" method="get" id="searchFormNews">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="searchNews" id="searchNews" value="<?= $valueSearchNews ?>"  style=" height: 35px; border-top-left-radius:5px; border-bottom-left-radius:5px; border-color:fff;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-warning" type="button" onclick='document.getElementById("searchFormNews").submit();' style="background-color: #fdc134; border-color: #fdc134; color: #612D11;  height: 35px; border-top-right-radius:5px; border-bottom-right-radius:5px;">Cari</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php else: ?>
                                            <form action="" method="get" id="searchFormNews">
                                                <div class="input-group" style="margin-top: -20px;">
                                                    <input type="text" class="form-control" name="searchNews" id="searchNews" value="<?= $valueSearchNews ?>"  style=" height: 35px; border-top-left-radius:5px; border-bottom-left-radius:5px; border-color:fff;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-warning" type="button" onclick='document.getElementById("searchFormNews").submit();' style="background-color: #fdc134; border-color: #fdc134; color: #612D11;  height: 35px; border-top-right-radius:5px; border-bottom-right-radius:5px;">Cari</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <hr color="black" size="10" class="mt-1 mb-4">

                                <div class="mb-3">
                                    <h6 style="font-size: 13px; color:#000; font-weight:bolder;">
                                        <a>
                                            Pencarian Terkait: 
                                        </a>
                                    </h6>
                                    <form action="Newstags" method="post">
                                        <div class="table-responsive">
                                            <table>
                                                <tr>
                                                    <?php foreach ($kategoriIB as $kategoriIBrow): ?>
                                                        <th>
                                                            <?php if ($kategoriIBrow['nama_kategori_pengumuman'] == $nm_kode): ?>
                                                                <a href="<?= base_url('newstags').'/'.$kategoriIBrow['nama_kategori_pengumuman'] ?>" id="tagsIpo" class="btn-tagsbursa btn btn-sm btn-secondary pl-4 pr-4" style="border-radius:50px; background-color:#fdc134; border-color:#fdc134; color:#000; ">
                                                                    <?= $kategoriIBrow['nama_kategori_pengumuman'] ?>
                                                                </a>
                                                            <?php else: ?>
                                                                <a href="<?= base_url('newstags').'/'.$kategoriIBrow['nama_kategori_pengumuman'] ?>" id="tagsIpo" class="btn-tagsbursa btn btn-sm btn-secondary pl-4 pr-4" style="border-radius:50px; background-color:#C4C4C4; border-color:#C4C4C4; color:#000; ">
                                                                    <?= $kategoriIBrow['nama_kategori_pengumuman'] ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        </th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </table>
                                        </div>
                                    </form>
                                </div>


                                <div class="row">
                                    <?php foreach ($ipos as $ipo): ?>
                                    <div class="col-lg-6 pb-3 list-item" style="">
                                        <div class="pb-3 pt-3 pl-5 pr-3" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 8px 12px 0 rgb(0 0 0 / 20%); border: 1px solid #dcdcdc;">
                                            <div class="mb-3" style="text-align: left; overflow: hidden; padding: 0;">
                                                <img style="max-height: 150px;" alt="cover berita" src="<?= base_url().'/backend/public/assets/img/news_cms/'.$ipo['cover'] ?>">
                                            </div>
                                            <h5 class="coklat" style="color: #000; font-size: 13px;"> 
                                                <?= $ipo['judul'] ?>
                                            </h5>
                                            <a style="margin-bottom: 80px; font-size: 13px;"><?= date("d-m-Y H:i", strtotime($ipo['tgl_pengumuman'])) ?></a> <br>
                                            <a href="<?= base_url().'/newsdetail/'.$ipo['kode_pengumuman'] ?>"><b style="color: #000;  font-size: 13px; margin-right:50%;">Read More</b></a> &nbsp;&nbsp;&nbsp;


                                            <?php if ($ipo['status'] == 'NEW'): ?>
                                                <img class="mt-1" style="width: 70px;" alt="image" src="<?= base_url(); ?>/public/assets/img/new.svg">
                                            <?php elseif ($ipo['status'] == 'HOT') : ?>
                                                <img class="mt-1" style="width: 70px;" alt="image" src="<?= base_url(); ?>/public/assets/img/hot.svg">
                                            <?php else: ?>
                                                
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                    <?php if ($ipos == []): ?>

                                    <?php else: ?>
                                        <?= $pager->links('group1','default_full') ?>
                                    <?php endif; ?>

                                </div>

                                <hr color="black" size="10" class="mt-4 mb-5">

                                <div class="text-center">
                                    <img alt="image" src="<?= base_url(); ?>/public/assets/img/langgananmonikaskrg.svg" style="width: 100%;">
                                </div>

                                <div class="container">
                                    <div class="row justify-content-lg-center mt-5">
                                        <div class="col-lg-4 mt-4" style="text-align:center;">
                                            <div class="item">
                                                <div style="background-color:#412817; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px; padding-right:2%; padding-left:2%;" onclick="location.href='<?= site_url('pembelian/HPKT004') ?>'">
                                                    <br>
                                                    <h3 style="color: #FBDC8E; font-size:23px;">Best Offer</h3>
                                                    <div class="item">
                                                        <div class="" style="cursor: pointer; background-image: linear-gradient(to right, #EBCF8F, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT004') ?>'">
                                                            <div class="top">
                                                                <div class="title">
                                                                    <br>
                                                                    <h4 style="color: #757575; font-size:18px;">Ultimate</h4>
                                                                    <h4 style="color: #612D11; font-size:23px;">Rp 180.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                                    <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4> 
                                                                    <h4 style="color: #757575; font-size:15px; font-weight:bold; text-decoration: line-through; text-decoration-color: #E50000;">Rp 2.160.000 <b style="color: #757575; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                                    <h4 style="color: #D19200; font-size:20px; font-weight:bold;">Rp. 1.800.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                                    <img alt="image" src="<?= base_url(); ?>/public/assets/img/hematmerah.svg" style="width: 90px;">
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="margin-top:7%; text-align:center;">
                                            <div class="item">
                                                <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #E5E5E5, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT002') ?>'">
                                                    <div class="top">
                                                        <div class="title">
                                                            <br>
                                                            <h4 style="color: #757575; font-size:18px;">Paket TA</h4>
                                                            <h4 style="color: #612D11; font-size:23px;">Rp 90.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                            <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4>
                                                            <h4 style="color: #757575; font-size:15px; font-weight:bold; text-decoration: line-through; text-decoration-color: #E50000;">Rp 1.080.000 <b style="color: #757575; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                            <h4 style="color: #D19200; font-size:20px; font-weight:bold;">Rp. 900.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                            <img alt="image" src="<?= base_url(); ?>/public/assets/img/hematmerah.svg" style="width: 90px;">
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="margin-top:7%; text-align:center;">
                                            <div class="item">
                                                <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #E5E5E5, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT003') ?>'">
                                                    <div class="top">
                                                        <div class="title">
                                                            <br>
                                                            <h4 style="color: #757575; font-size:18px;">Paket FA</h4>
                                                            <h4 style="color: #612D11; font-size:23px;">Rp 90.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                            <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4>
                                                            <h4 style="color: #757575; font-size:15px; font-weight:bold; text-decoration: line-through; text-decoration-color: #E50000;">Rp 1.080.000 <b style="color: #757575; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                            <h4 style="color: #D19200; font-size:20px; font-weight:bold;">Rp. 900.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                            <img alt="image" src="<?= base_url(); ?>/public/assets/img/hematmerah.svg" style="width: 90px;">
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-lg-9">
                        <div class="mb-3" style="background-color: #eeeeee;">
                            <div class="header">
                                <h3 class="mb-4">
                                    News Update
                                    <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
                                    <!-- Histats.com  START  (aync)-->
                            
                                    <!-- Histats.com  END  -->
                                </h3>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h6 style="font-size: 13px; color:#000;">
                                            <!-- <a>Stock & Market Update</a> -->
                                            <!-- <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp; -->
                                            <a style="font-weight: bold; color:#DD9B00;" href="<?= base_url('news') ?>">News</a>
                                            <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                            <a  href="<?= base_url('informasibursa') ?>">Informasi Bursa</a>
                                            <samp style="border-left: 2px #000 solid; margin-left: 10px;"></samp> &nbsp;&nbsp;
                                            <a href="<?= base_url('emitenipo') ?>">Emiten IPO, Raport Emiten, Special Report</a>
                                        </h6>
                                    </div>
                                    <div class="col-lg-4">
                                        

                                        <?php if ($nm_kode == ' '): ?>
                                            <form action="news" method="get" id="searchFormNews">
                                                <div class="input-group" style="margin-top: -20px;">
                                                    <input type="text" class="form-control" name="searchNews" id="searchNews" value="<?= $valueSearchNews ?>"  style=" height: 35px; border-top-left-radius:5px; border-bottom-left-radius:5px; border-color:fff;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-warning" type="button" onclick='document.getElementById("searchFormNews").submit();' style="background-color: #fdc134; border-color: #fdc134; color: #612D11;  height: 35px; border-top-right-radius:5px; border-bottom-right-radius:5px;">Cari</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php else: ?>
                                            <form action="" method="get" id="searchFormNews">
                                                <div class="input-group" style="margin-top: -20px;">
                                                    <input type="text" class="form-control" name="searchNews" id="searchNews" value="<?= $valueSearchNews ?>"  style=" height: 35px; border-top-left-radius:5px; border-bottom-left-radius:5px; border-color:fff;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-warning" type="button" onclick='document.getElementById("searchFormNews").submit();' style="background-color: #fdc134; border-color: #fdc134; color: #612D11;  height: 35px; border-top-right-radius:5px; border-bottom-right-radius:5px;">Cari</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <hr color="black" size="10" class="mt-1 mb-4">

                                <div class="mb-3">
                                    <h6 style="font-size: 13px; color:#000; font-weight:bolder;">
                                        <a>
                                            Pencarian Terkait: 
                                        </a>
                                    </h6>
                                    <form action="Newstags" method="post">
                                        <div class="table-responsive">
                                            <table>
                                                <tr>
                                                    <?php foreach ($kategoriIB as $kategoriIBrow): ?>
                                                        <th>
                                                            <?php if ($kategoriIBrow['nama_kategori_pengumuman'] == $nm_kode): ?>
                                                                <a href="<?= base_url('newstags').'/'.$kategoriIBrow['nama_kategori_pengumuman'] ?>" id="tagsIpo" class="btn-tagsbursa btn btn-sm btn-secondary pl-4 pr-4" style="border-radius:50px; background-color:#fdc134; border-color:#fdc134; color:#000; ">
                                                                    <?= $kategoriIBrow['nama_kategori_pengumuman'] ?>
                                                                </a>
                                                            <?php else: ?>
                                                                <a href="<?= base_url('newstags').'/'.$kategoriIBrow['nama_kategori_pengumuman'] ?>" id="tagsIpo" class="btn-tagsbursa btn btn-sm btn-secondary pl-4 pr-4" style="border-radius:50px; background-color:#C4C4C4; border-color:#C4C4C4; color:#000; ">
                                                                    <?= $kategoriIBrow['nama_kategori_pengumuman'] ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        </th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </table>
                                        </div>
                                    </form>
                                </div>


                                <div class="row">
                                    <?php foreach ($ipos as $ipo): ?>
                                    <div class="col-lg-6 pb-3 list-item" style="">
                                        <div class="pb-3 pt-3 pl-5 pr-3" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 8px 12px 0 rgb(0 0 0 / 20%); border: 1px solid #dcdcdc;">
                                            <div class="mb-3" style="text-align: left; overflow: hidden; padding: 0;">
                                                <img style="max-height: 110px;" alt="cover berita" src="<?= base_url().'/backend/public/assets/img/news_cms/'.$ipo['cover'] ?>">
                                            </div>
                                            <h5 class="coklat" style="color: #000; font-size: 13px;"> 
                                                <?php if (strlen($ipo['judul']) < 50 ): ?>
                                                    <?= substr($ipo['judul'], 0, 50) ?>
                                                <?php elseif (strlen($ipo['judul']) >= 50 ): ?>
                                                    <?= substr($ipo['judul'], 0, 50) ?> ... 
                                                <?php else: ?>
                                                    error
                                                <?php endif; ?>
                                            </h5>
                                            <a style="margin-bottom: 80px; font-size: 13px;"><?= date("d-m-Y H:i", strtotime($ipo['tgl_pengumuman'])) ?></a> <br>
                                            <a href="<?= base_url().'/newsdetail/'.$ipo['kode_pengumuman'] ?>"><b style="color: #000;  font-size: 13px; margin-right:50%;">Read More</b></a> &nbsp;&nbsp;&nbsp;

                                            <?php if ($ipo['status'] == 'NEW'): ?>
                                                <img style="width: 70px; margin-top:-20px" alt="image" src="https://dev-monika-ps.cac-office.com/public/assets/img/new.svg">
                                            <?php elseif ($ipo['status'] == 'HOT') : ?>
                                                <img style="width: 70px; margin-top:-20px" alt="image" src="https://dev-monika-ps.cac-office.com/public/assets/img/hot.svg">
                                            <?php else: ?>
                                                
                                            <?php endif; ?>

                                            <br>
                                            <!-- Histats.com  START (html only)-->
                                                <a href="/viewstats/?SID=4693134&f=2" alt="web stats" target="_blank" ><div id="histatsC"><img border="0" src="//s4is.histats.com/stats/i/4693134.gif?4693134&103"></div></a>
                                            <!-- Histats.com  END  -->

                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                    <?php if ($ipos == []): ?>

                                    <?php else: ?>
                                        <?= $pager->links('group1','default_full') ?>
                                    <?php endif; ?>

                                </div>

                                <hr color="black" size="10" class="mt-4 mb-5">

                                <div class="text-center">
                                    <img alt="image" src="<?= base_url(); ?>/public/assets/img/langgananmonikaskrg.svg">
                                </div>

                                <div class="container">
                                    <div class="row justify-content-lg-center mt-5">
                                        <div class="col-lg-4" style="margin-top:7%; text-align:center;">
                                            <div class="item">
                                                <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #E5E5E5, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT002') ?>'">
                                                    <div class="top">
                                                        <div class="title">
                                                            <br>
                                                            <h4 style="color: #757575; font-size:18px;">Paket TA</h4>
                                                            <h4 style="color: #612D11; font-size:23px;">Rp 90.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                            <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4>
                                                            <h4 style="color: #757575; font-size:15px; font-weight:bold; text-decoration: line-through; text-decoration-color: #E50000;">Rp 1.080.000 <b style="color: #757575; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                            <h4 style="color: #D19200; font-size:20px; font-weight:bold;">Rp. 900.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                            <img alt="image" src="<?= base_url(); ?>/public/assets/img/hematmerah.svg" style="width: 90px;">
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="text-align:center;">
                                            <div class="item">
                                                <div style="background-color:#412817; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px; padding-right:2%; padding-left:2%;" onclick="location.href='<?= site_url('pembelian/HPKT004') ?>'">
                                                    <br>
                                                    <h3 style="color: #FBDC8E; font-size:18px;">Best Offer</h3>
                                                    <div class="item">
                                                        <div class="" style="cursor: pointer; background-image: linear-gradient(to right, #EBCF8F, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT004') ?>'">
                                                            <div class="top">
                                                                <div class="title">
                                                                    <br>
                                                                    <h4 style="color: #757575; font-size:18px;">Ultimate</h4>
                                                                    <h4 style="color: #612D11; font-size:23px;">Rp 180.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                                    <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4> 
                                                                    <h4 style="color: #757575; font-size:15px; font-weight:bold; text-decoration: line-through; text-decoration-color: #E50000;">Rp 2.160.000 <b style="color: #757575; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                                    <h4 style="color: #D19200; font-size:20px; font-weight:bold;">Rp. 1.800.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                                    <img alt="image" src="<?= base_url(); ?>/public/assets/img/hematmerah.svg" style="width: 90px;">
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="margin-top:7%; text-align:center;">
                                            <div class="item">
                                                <div class="" style="cursor: pointer; background-image: linear-gradient(180deg, #E5E5E5, #FFFFFF); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 8px;" onclick="location.href='<?= site_url('pembelian/HPKT003') ?>'">
                                                    <div class="top">
                                                        <div class="title">
                                                            <br>
                                                            <h4 style="color: #757575; font-size:18px;">Paket FA</h4>
                                                            <h4 style="color: #612D11; font-size:23px;">Rp 90.000 <b style="color: #000; font-size:15px; font-weight:bold;">/bulan</b></h4>
                                                            <h4 style="color: #000; font-size:15px; font-weight:bold; margin-top:-5px;">atau</h4>
                                                            <h4 style="color: #757575; font-size:15px; font-weight:bold; text-decoration: line-through; text-decoration-color: #E50000;">Rp 1.080.000 <b style="color: #757575; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                            <h4 style="color: #D19200; font-size:20px; font-weight:bold;">Rp. 900.000 <b style="color: #000; font-size:15px; font-weight:bold;">/tahun</b></h4>
                                                            <img alt="image" src="<?= base_url(); ?>/public/assets/img/hematmerah.svg" style="width: 90px;">
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif ?>

            </div>
    </section>
</main>

<?= $this->endSection(); ?>
<script type="text/javascript">
var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.startgif', '1,4693134,4,10050,"div#histatsC {position: absolute;top:0px;left:0px;}body>div#histatsC {position: fixed;}"']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_gif_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" alt="web stats" target="_blank" ><div id="histatsC"><img border="0" src="//s4is.histats.com/stats/i/4693134.gif?4693134&103"></div></a>
</noscript>

