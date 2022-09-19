 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahpackageprice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Harga Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('package/pricecontroller/simpandata', ['class' => 'formModaltambahpackageprice']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Harga Paket</label>
                  <input class="form-control" type="text" placeholder="HPKT001" readonly
                        name="packageprice_kode" id="packageprice_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricekode">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User Level</label>
                  <select class="form-control" id="packageprice_kodeuser" name="packageprice_kodeuser">
                    <?php foreach($usrlevel as $item): ?>
                    <option value="<?= $item['kode_user_level']; ?>">
                        <?= $item['nama_level']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Non Member Bulanan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_harganonmemberbulanan" id="packageprice_harganonmemberbulanan" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpnonmemberbulanan" id="packageprice_hargatmpnonmemberbulanan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapriceharganonmemberbulanan">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Koperasi Bulanan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargakoperasibulanan" id="packageprice_hargakoperasibulanan" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpkoperasibulanan" id="packageprice_hargatmpkoperasibulanan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargakoperasibulanan">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Komunitas Bulanan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargakomunitasbulanan" id="packageprice_hargakomunitasbulanan" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpkomunitasbulanan" id="packageprice_hargatmpkomunitasbulanan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargakomunitasbulanan">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Keduanya Bulanan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargamemberdualbulanan" id="packageprice_hargamemberdualbulanan" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpmemberdualbulanan" id="packageprice_hargatmpmemberdualbulanan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargamemberdualbulanan">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Non Member Tahunan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_harganonmembertahunan" id="packageprice_harganonmembertahunan" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpnonmembertahunan" id="packageprice_hargatmpnonmembertahunan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapriceharganonmembertahunan">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Koperasi Tahunan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargakoperasitahunan" id="packageprice_hargakoperasitahunan" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpkoperasitahunan" id="packageprice_hargatmpkoperasitahunan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargakoperasitahunan">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Komunitas Tahunan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargakomunitastahunan" id="packageprice_hargakomunitastahunan" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpkomunitastahunan" id="packageprice_hargatmpkomunitastahunan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargakomunitastahunan">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Keduanya Tahunan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargamemberdualtahunan" id="packageprice_hargamemberdualtahunan" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpmemberdualtahunan" id="packageprice_hargatmpmemberdualtahunan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargamemberdualtahunan">test</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Poin Paket</label>
                  <input class="form-control" type="text" pattern="[-+]?\d*" placeholder="0" 
                        name="packageprice_poin" id="packageprice_poin" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricepoin">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Durasi Paket</label>
                  <select class="form-control" id="packageprice_durasi" name="packageprice_durasi">
                    <?php for($i = 1; $i <= 12; $i++): ?>
                    <option value="<?= $i; ?>">
                        <?= $i; ?>
                    </option>
                    <?php endfor ?>
                  </select>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Level</label>
                  <input class="form-control" type="text" placeholder="Basic" 
                        name="packageprice_level" id="packageprice_level" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagepricelevel">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <textarea class="form-control" rows="3" name="packageprice_deskripsi" 
                        id="packageprice_deskripsi"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagepricedeskripsi">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Fitur paket</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorInfonewsIsi">testte</div>
                  <textarea id="packageprice_fitur" name="packageprice_fitur"></textarea>
				  
				  <br/>
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="packageprice_isactive" class="packageprice_isactive" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan Paket &nbsp;</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahpackageprice">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>