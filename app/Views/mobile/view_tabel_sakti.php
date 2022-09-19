<?= $this->extend('components/template_mobile') ?>
<?= $this->section('content_admin') ?>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">


                <div class="col-lg-12 pb-4">
                    <div>
                        <ul>
                            <li class="white-header pb-3 pt-4 pl-4 -r-4">
                                <a class="float-right pr-4"></a>
                                <h5 class="kuning pt-1"><?= $title; ?></h5>
                            </li>
                            <li class="white-content pb-5 pt-4 pl-0 pr-0">
                                <div class="col-lg-12">
                                    <form method="POST" id="formtablem">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-block pt-2">
                                                    <label for="ex" class="control-label float-left pl-3">Jenis Tabel</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div tabindex="2">
                                                    <select class="custom-select" name="jnstable" id="jnstable" data-placeholder="Select box" required>
                                                        <?php
                                                        foreach ($jns as $j) {
                                                            echo '<option value="' . $j->kode_jenis_tsakti . '">' . $j->jenis_t_sakti . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="d-block pt-2">
                                                    <label for="startdate" class="control-label float-left pl-3">Tanggal Dari</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="date" id="startdate" class="form-control" name="startdate" tabindex="2" required>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="d-block pt-2">
                                                    <label for="enddate" class="control-label float-left pl-3">Sampai</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="date" id="enddate" class="form-control" name="enddate" tabindex="2" required>
                                            </div>
                                            <div class="col-lg-12 pt-4">
                                                <button type="submit" style="width:100%;" class="boxed-mob" tabindex="4">
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12 pb-4">
                    <div>
                        <ul>
                            <li class="white-header pb-3 pt-4 pl-4 -r-4">
                                <a class="float-right pr-4"></a>
                                <h5 class="kuning pt-1">Hasil</h5>
                            </li>
                            <li id="tempattabel" class="white-content pb-5 pt-4 pl-0 pr-0">
                                <div id="tablesaktiresultm" class="col-lg-12">

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>