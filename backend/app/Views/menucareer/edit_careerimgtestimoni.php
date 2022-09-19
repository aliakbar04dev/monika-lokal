 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahimgcareertestimoni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar Testimoni</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('career/TestimoniController/perbaruigambar',
           ['class' => 'formModalubahimgcareertestimoni']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Testimoni</label>
                  <input class="form-control" type="text" placeholder="TTSK001" 
                        name="careertestimoniimg_kodeubah" id="careertestimoniimg_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniimgKodeubah">testte</div>
                </div>

                <div class="form-group">
                  <label class="form-control-label">Gambar sebelumnya</label>
                  <img id="careertestimoniimg_recentimg" width="100%"/>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
                  <input type="file" name="careertestimoniimg_gambarubah" class="form-control" id="careertestimoniimg_gambarubah" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback bg-secondary errorCareertestimoniimgGambarubah">testte</div>
				  
				  <br/>
				  
				  <div class="float-left">
					  <label class="custom-toggle float-right">
						<input type="checkbox" id="careertestimoniimg_ishighlightubah" class="careertestimoniimg_ishighlightubah" value="1"/>
						<span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
					  </label>
					  <label for="nama-infocategory-input" class="form-control-label float-right">Highlight &nbsp;</label>
				  </div>
				  
				  <div class="float-right">
					  <label class="custom-toggle float-right">
						<input type="checkbox" id="careertestimoniimg_isactiveubah" class="careertestimoniimg_isactiveubah" value="1"/>
						<span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
					  </label>
					  <label for="nama-infocategory-input float-right" class="form-control-label float-right">Publish &nbsp;</label>
				  </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahimgcareertestimoni">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>