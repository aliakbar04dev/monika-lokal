<!-- <script src="<?= base_url() ?>/public/assets/vendor/ckeditor/ckeditor.js"></script> -->
 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahinfotutorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Tutorial</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('information/tutorialcontroller/perbaruidata', ['class' => 'formModalubahinfotutorial']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Kode Tutorial</label>
                  <input class="form-control" type="text"  placeholder="PENG001" 
                        name="infotutorial_kodeubah" id="infotutorial_kodeubah" readonly />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotutorialKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kategori</label>
                  <select name="infotutorial_kategoriubah" id="infotutorial_kategoriubah" class="form-control" required>
                        <?php foreach($filters as $item): ?>
                        <option value="<?= $item['judul_filter']; ?>">
                            <?= $item['judul_filter']; ?>
                        </option>
                        <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">judul Tutorial</label>
                  <input class="form-control" type="text" placeholder="" 
                        name="infotutorial_judulubah" id="infotutorial_judulubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotutorialJudulubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Sub judul Tutorial</label>
                  <input class="form-control" type="text" placeholder="" 
                        name="infotutorial_subjudulubah" id="infotutorial_subjudulubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotutorialSubJudulubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi Tutorial</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorInfotutorialIsiubah">testte</div>
                  <textarea id="infotutorial_isiubah" name="infotutorial_isiubah"></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahinfotutorial">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>