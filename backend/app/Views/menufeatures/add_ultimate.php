 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahfeaturesultimate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Fitur Ultimate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('features/ultimatecontroller/simpandata', ['class' => 'formModaltambahfeaturesultimate']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Filter</label>
                  <input class="form-control" type="text"  placeholder="JSAK001" 
                        name="featuresultimate_kode" id="featuresultimate_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesultimateKode">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Jenis Fitur</label>
                  <select class="form-control" id="featuresultimate_jenis" name="featuresultimate_jenis">
                    <option value="CT" selected="selected">Copy Trade</option>
                    <option value="DS">Daily Stock</option>
                    <option value="TS">Trailling Stock</option>
                  </select>
                </div>
				
				        <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Tanggal</label>
                  <input class="form-control datepicker" placeholder="Start date" type="text" 
						        value="<?= date("m/d/Y"); ?>" name="featuresultimate_tanggal" id="featuresultimate_tanggal">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenisultimateTanggal">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorFeaturesultimateIsi">testte</div>
                  <textarea id="featuresultimate_isi" name="featuresultimate_isi"></textarea>

                  <br/>
				  
				        <label class="custom-toggle float-right">
                    <input type="checkbox" id="featuresultimate_isactive" class="featuresultimate_isactive" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan Fitur &nbsp;</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahfeaturesultimate">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>