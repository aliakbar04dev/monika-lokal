 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahfeaturesultimate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Fitur Ultimate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('features/ultimatecontroller/perbaruidata', ['class' => 'formModalubahfeaturesultimate']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Filter</label>
                  <input class="form-control" type="text"  placeholder="JSAK001" 
                        name="featuresultimate_kodeubah" id="featuresultimate_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesultimateKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Jenis Fitur</label>
                  <select class="form-control" id="featuresultimate_jenisubah" name="featuresultimate_jenisubah" readonly>
                    <option value="CT" selected="selected">Copy Trade</option>
                    <option value="DS">Daily Stock</option>
                    <option value="TS">Trailling Stock</option>
                  </select>
                </div>
				
				        <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Tanggal</label>
                  <input class="form-control datepicker" placeholder="Start date" type="text" 
						        value="<?= date("m/d/Y"); ?>" name="featuresultimate_tanggalubah" id="featuresultimate_tanggalubah">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenisultimateTanggalubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorFeaturesultimateIsiubah">testte</div>
                  <textarea id="featuresultimate_isiubah" name="featuresultimate_isiubah"></textarea>

                  <br/>
				  
				        <label class="custom-toggle float-right">
                    <input type="checkbox" id="featuresultimate_isactiveubah" class="featuresultimate_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan Fitur &nbsp;</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahfeaturesultimate">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>