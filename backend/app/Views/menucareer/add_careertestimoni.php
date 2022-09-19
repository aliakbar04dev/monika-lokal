 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahcareertestimoni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Testimoni Karir</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('career/TestimoniController/simpandata', ['class' => 'formModaltambahcareertestimoni']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Id Testimoni</label>
                  <input class="form-control" type="text"  placeholder="TTSK001" readonly
                        name="careertestimoni_kode" id="careertestimoni_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama</label>
                  <input class="form-control" type="text" placeholder="Bambang Subagio" 
                        name="careertestimoni_nama" id="careertestimoni_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniNama">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Divisi</label>
                  <input class="form-control" type="text" placeholder="Seksi Humas" 
                        name="careertestimoni_divisi" id="careertestimoni_divisi" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniDivisi">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi Testimoni</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCareertestimoniContent">testte</div>
                  <textarea id="careertestimoni_content" name="careertestimoni_content" class="form-control" rows="2"></textarea>
                </div>
               
			   <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
                  <input type="file" name="careertestimoni_gambar" class="form-control" id="careertestimoni_gambar" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback bg-secondary errorCareertestimoniGambar">testte</div>
				  
				  <br/>
				  
				  <div class="float-left">
					  <label class="custom-toggle float-right">
						<input type="checkbox" id="careertestimoni_ishighlight" class="careertestimoni_ishighlight" value="1"/>
						<span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
					  </label>
					  <label for="nama-infocategory-input" class="form-control-label float-right">Highlight &nbsp;</label>
				  </div>
				  
				  <div class="float-right">
					  <label class="custom-toggle float-right">
						<input type="checkbox" id="careertestimoni_isactive" class="careertestimoni_isactive" value="1"/>
						<span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
					  </label>
					  <label for="nama-infocategory-input float-right" class="form-control-label float-right">Publish &nbsp;</label>
				  </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahcareertestimoni">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>