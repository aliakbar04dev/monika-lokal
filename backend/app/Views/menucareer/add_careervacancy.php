 <!-- <script src="<?= base_url() ?>/public/assets/vendor/ckeditor/ckeditor.js"></script> -->
 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahcareervacancy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karir</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('career/VacancyController/simpandata', ['class' => 'formModaltambahcareervacancy']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Id Karir</label>
                  <input class="form-control" type="text"  placeholder="TKAR001" readonly
                        name="careervacancy_kode" id="careervacancy_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Posisi / Judul karir</label>
                  <input class="form-control" type="text" placeholder="iOS Developer" 
                        name="careervacancy_posisi" id="careervacancy_posisi" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyPosisi">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Departemen</label>
                  <select class="form-control" id="careervacancy_departemen" name="careervacancy_departemen">
                    <?php foreach($departemen as $item): ?>
                    <option value="<?= $item['id_departemen']; ?>">
                        <?= $item['nama_departemen']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kategori</label>
                  <select class="form-control" id="careervacancy_kategori" name="careervacancy_kategori">
                    <?php foreach($kategori as $item): ?>
                    <option value="<?= $item['id_kategori_pekerjaan']; ?>">
                        <?= $item['kategori_pekerjaan']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>
				
				<div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Lokasi</label>
                  <select class="form-control" id="careervacancy_lokasi" name="careervacancy_lokasi">
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
                  <div class="invalid-feedback bg-secondary errorCareervacancyDeskripsi">testte</div>
                  <textarea id="careervacancy_deskripsi" name="careervacancy_deskripsi"></textarea>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Requirement</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyRequirement">testte</div>
                  <textarea id="careervacancy_requirement" name="careervacancy_requirement"></textarea>
                </div>
               
			   <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Benefit</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCareervacancyBenefit">testte</div>
                  <textarea id="careervacancy_benefit" name="careervacancy_benefit"></textarea>
				  
				  <br/>
				  
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="careervacancy_isactive" class="careervacancy_isactive" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan lowongan &nbsp;</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahcareervacancy">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>