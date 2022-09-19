<div class="col-lg-9">
    <div>
        <ul>
            <li class="white-header pb-3 pt-4 pl-4 -r-4">
                <a class="float-right pr-4"><?= ($usr['username'] != '')? '@'.$usr['username']:'' ?></a>
                <h5 class="kuning pt-1"><?= $title; ?></h5>
            </li>
            <li class="white-content pb-4 pt-4 pl-4 -r-4">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">Anggota Komunitas PanenSaham</div>
                        <div class="col-6">
                            <label class="custom-switch" style="cursor: pointer;">
                                <input id="connect_komu" name="connect_komu" type="checkbox" class="custom-switch-input" value="<?= ($usr['client_id_komunitas'] != '')? 'connected':'' ?>" <?= ($usr['client_id_komunitas'] != '')? 'checked':'' ?>>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="komu_stats"><?= ($usr['client_id_komunitas'] != '')? 'Connected':'Not Connected' ?></span>
                            </label>
                        </div>
                    </div>
                </div>
            <!-- </li>
            <li class="white-content pb-4 pt-4 pl-4 -r-4">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">Anggota Koperasi PanenSaham (KJKPI)</div>
                        <div class="col-6">
                            <label class="custom-switch" style="cursor: pointer;">
                                <input id="connect_kope" name="connect_kope" type="checkbox" class="custom-switch-input" value="<?= ($usr['email_anggota'] != '')? 'connected':'' ?>" <?= ($usr['email_anggota'] != '')? 'checked':'' ?>>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="kope_stats"><?= ($usr['email_anggota'] != '')? 'Connected':'Not Connected' ?></span>
                            </label>
                        </div>
                    </div>
                </div>
            </li> -->
        </ul>
    </div>
</div>

<div class="modal fade" id="komunitasmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-header pl-4 pr-4 pb-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="mt-5 text-muted text-center">
                    <img alt="logo" src="<?= base_url(); ?>/public/assets/img/ps-logo.png" width="300px" height=""><br>
                    Masukan Client ID anda.
                </div>

                <div class="card-body">
                    <form method="POST" id="connectkomu_form" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <input id="clientid" type="text" class="form-control" name="clientid" tabindex="1" placeholder="Contoh Client ID M*****" required autofocus>
                        </div>

                        <div class="form-group">
                            <button style="width:100%;" type="submit" class="btn btn-warning" tabindex="4">
                                Connect
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="anggotamodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-header pl-4 pr-4 pb-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="mt-5 text-muted text-center">
                    <img alt="logo" src="<?= base_url(); ?>/public/assets/img/ps-logo.png" width="300px" height=""><br>
                    Masukan Alamat Email yang terdaftar di Koperasi PanenSaham (KJKPI)
                </div>

                <div class="card-body">
                    <form method="POST" id="connectkope_form" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <input id="emailid" type="text" class="form-control" name="emailid" tabindex="1" placeholder="Email/ID Anggota yang terdaftar" required autofocus>
                        </div>

                        <div class="form-group">
                            <button style="width:100%;" type="submit" class="btn btn-warning" tabindex="4">
                                Connect
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>