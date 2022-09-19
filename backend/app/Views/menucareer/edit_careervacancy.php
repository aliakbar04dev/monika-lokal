 <!-- <script src="<?= base_url() ?>/public/assets/vendor/ckeditor/ckeditor.js"></script> -->
 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahcareervacancy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Karir</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('career/VacancyController/perbaruidata', ['class' => 'formModalubahcareervacancy']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Id Karir</label>
                  <input class="form-control" type="text"  placeholder="TKAR001" readonly
                        name="careervacancy_kodeubah" id="careervacancy_kodeubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Posisi / Judul karir</label>
                  <input class="form-control" type="text" placeholder="iOS Developer" 
                        name="careervacancy_posisiubah" id="careervacancy_posisiubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyPosisiubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Departemen</label>
                  <select class="form-control" id="careervacancy_departemenubah" name="careervacancy_departemenubah">
                    <?php foreach($departemen as $item): ?>
                    <option value="<?= $item['id_departemen']; ?>">
                        <?= $item['nama_departemen']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kategori</label>
                  <select class="form-control" id="careervacancy_kategoriubah" name="careervacancy_kategoriubah">
                    <?php foreach($kategori as $item): ?>
                    <option value="<?= $item['id_kategori_pekerjaan']; ?>">
                        <?= $item['kategori_pekerjaan']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>
				
				<div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Lokasi</label>
                  <select class="form-control" id="careervacancy_lokasiubah" name="careervacancy_lokasiubah">
                    <?php foreach($lokasi as $item): ?>
                    <option value="<?= $item['id_lokasi_pekerjaan']; ?>">
                        <?= $item['lokasi_pekerjaan']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyDeskripsiubah">testte</div>
                  <textarea id="careervacancy_deskripsiubah" name="careervacancy_deskripsiubah"></textarea>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Requirement</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyRequirementubah">testte</div>
                  <textarea id="careervacancy_requirementubah" name="careervacancy_requirementubah"></textarea>
                </div>
               
			   <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Benefit</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyBenefitubah">testte</div>
                  <textarea id="careervacancy_benefitubah" name="careervacancy_benefitubah"></textarea>
				  
				  <br/>
				  
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="careervacancy_isactiveubah" class="careervacancy_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan lowongan &nbsp;</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahcareervacancy">Update</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>