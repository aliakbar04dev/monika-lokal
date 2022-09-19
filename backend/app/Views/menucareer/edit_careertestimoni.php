 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahcareertestimoni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Testimoni Karir</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('career/TestimoniController/perbaruidata', ['class' => 'formModalubahcareertestimoni']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Id Testimoni</label>
                  <input class="form-control" type="text"  placeholder="TTSK001" readonly
                        name="careertestimoni_kodeubah" id="careertestimoni_kodeubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama</label>
                  <input class="form-control" type="text" placeholder="Bambang Subagio" 
                        name="careertestimoni_namaubah" id="careertestimoni_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniNamaubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Divisi</label>
                  <input class="form-control" type="text" placeholder="Seksi Humas" 
                        name="careertestimoni_divisiubah" id="careertestimoni_divisiubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniDivisiubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi Testimoni</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniContentubah">testte</div>
                  <textarea id="careertestimoni_contentubah" name="careertestimoni_contentubah" class="form-control" rows="2"></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahcareertestimoni">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>