 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahpackageprice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Harga Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('package/pricecontroller/perbaruidata', ['class' => 'formModalubahpackageprice']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Harga Paket</label>
                  <input class="form-control" type="text" placeholder="HPKT001" 
                        name="packageprice_kodeubah" id="packageprice_kodeubah" readonly />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricekodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User Level</label>
                  <select class="form-control" id="packageprice_kodeuserubah" name="packageprice_kodeuserubah">
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
                        name="packageprice_harganonmemberbulananubah" id="packageprice_harganonmemberbulananubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpnonmemberbulananubah" id="packageprice_hargatmpnonmemberbulananubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapriceharganonmemberbulananubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Koperasi Bulanan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargakoperasibulananubah" id="packageprice_hargakoperasibulananubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpkoperasibulananubah" id="packageprice_hargatmpkoperasibulananubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargakoperasibulananubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Komunitas Bulanan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargakomunitasbulananubah" id="packageprice_hargakomunitasbulananubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpkomunitasbulananubah" id="packageprice_hargatmpkomunitasbulananubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargakomunitasbulananubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Keduanya Bulanan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargamemberdualbulananubah" id="packageprice_hargamemberdualbulananubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpmemberdualbulananubah" id="packageprice_hargatmpmemberdualbulananubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargamemberdualbulananubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Non Member Tahunan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_harganonmembertahunanubah" id="packageprice_harganonmembertahunanubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpnonmembertahunanubah" id="packageprice_hargatmpnonmembertahunanubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapriceharganonmembertahunanubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Koperasi Tahunan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargakoperasitahunanubah" id="packageprice_hargakoperasitahunanubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpkoperasitahunanubah" id="packageprice_hargatmpkoperasitahunanubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargakoperasitahunanubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Komunitas Tahunan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargakomunitastahunanubah" id="packageprice_hargakomunitastahunanubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpkomunitastahunanubah" id="packageprice_hargatmpkomunitastahunanubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargakomunitastahunanubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Member Keduanya Tahunan</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargamemberdualtahunanubah" id="packageprice_hargamemberdualtahunanubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpmemberdualtahunanubah" id="packageprice_hargatmpmemberdualtahunanubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricehargamemberdualtahunanubah">test</div>
                </div>
				
		            <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Poin Paket</label>
                  <input class="form-control" type="text" pattern="[-+]?\d*" placeholder="0" 
                        name="packageprice_poinubah" id="packageprice_poinubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricepoinubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Durasi Paket</label>
                  <select class="form-control" id="packageprice_durasiubah" name="packageprice_durasiubah">
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
                        name="packageprice_levelubah" id="packageprice_levelubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagepricelevelubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <textarea class="form-control" rows="3" name="packageprice_deskripsiubah" 
                        id="packageprice_deskripsiubah"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagepricedeskripsiubah">testte</div>
                </div>
				
				        <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Fitur paket</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorPackagepricefiturubah">testte</div>
                  <textarea id="packageprice_fiturubah" name="packageprice_fiturubah"></textarea>
				  
				          <br/>
				          <label class="custom-toggle float-right">
                    <input type="checkbox" id="packageprice_isactiveubah" class="packageprice_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan Paket &nbsp;</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahpackageprice">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>