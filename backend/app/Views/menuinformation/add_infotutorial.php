<!-- <script src="<?= base_url() ?>/public/assets/vendor/ckeditor/ckeditor.js"></script> -->
 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahinfotutorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tutorial</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('information/tutorialcontroller/simpandata', ['class' => 'formModaltambahinfotutorial']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Id Tutorial</label>
                  <input class="form-control" type="text"  placeholder="PENG001" readonly
                        name="infotutorial_kode" id="infotutorial_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotutorialKode">test</div>
                </div>
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kategori</label>
                  <select name="infotutorial_kategori" id="infotutorial_kategori" class="form-control" required>
                        <?php foreach($filters as $item): ?>
                        <option value="<?= $item['judul_filter']; ?>">
                            <?= $item['judul_filter']; ?>
                        </option>
                        <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Tutorial</label>
                  <input class="form-control" type="text" placeholder="Judul Tutorial" 
                        name="infotutorial_judul" id="infotutorial_judul" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotutorialJudul">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Sub Judul Tutorial</label>
                  <input class="form-control" type="text" placeholder="Sub Judul Tutorial" 
                        name="infotutorial_subjudul" id="infotutorial_subjudul" required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotutorialSubJudul">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi Tutorial</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorInfotutorialIsi">testte</div>
                  <textarea id="infotutorial_isi" name="infotutorial_isi"></textarea>
                </div>
                
                <!-- <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar Pendukung</label>
                  <input type="file" name="infotutorial_gambar" class="form-control" id="infotutorial_gambar" accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback bg-secondary errorInfotutorialGambar">testte</div>
                </div> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahinfotutorial">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>