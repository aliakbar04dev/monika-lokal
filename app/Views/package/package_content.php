<div class="col-lg-9">
    <div>
        <ul>
            <li class="white-header pb-3 pt-4 pl-4 -r-4">
                <h5 class="kuning" style="font-family: 'Poppins'; font-weight:bold;"><?= $title; ?></h5>
            </li>
            <li class="white-content pb-4 pt-4 pl-4 pr-4">
            <div id="tempattabel">
            <table id="example" style="font-size:12px;" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Nama Paket</th>
                                <th>Total</th>
                                <th>Paket Exp.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($pkg as $p){
                            ?>
                                <tr>
                                    <td><?= (($p['nama_paket'] != '')? $p['nama_paket']:"-") ?></td>
                                    <td><?= $p['alias_level'] ?></td>
                                    <td><?= (($p['harga_paket'] != '')? rupiah($p['harga_paket']):"-") ?></td>
                                    <td>
                                        <?php 
                                            if($p['kode_user_level'] == 'MULV001'){
                                                echo $p['trial_expire'];
                                            }else if($p['kode_user_level'] == 'MULV002'){
                                                echo '-';
                                            }else{
                                                echo $p['exp_date'];
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($p['kode_user_level'] != 'MULV001' && $p['kode_user_level'] != 'MULV002'){
                                        ?>
                                            <?php
                                                if($p['tipe'] == 'nontemp'){
                                            ?>
                                                    <a type="button" style="width:auto; font-size:11px;" class="boxed-bil" tabindex="4" id="delete<?= $p['tipe'] ?>">
                                                        Hapus Paket
                                                    </a>
                                                    <a type="button" style="width:auto; font-size:11px;" class="boxed-bil" tabindex="4" href="<?= site_url('/extendpackage/'.$p['kode_harga_paket']); ?>">
                                                        Perpanjang Paket
                                                    </a>
                                            <?php
                                                }
                                            ?>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
    </div>
</div>