 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahmediavideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Media</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('media/videomedcontroller/perbaruidata', ['class' => 'formModalubahmediavideo']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Video</label>
                  <input class="form-control" type="text"  placeholder="KMED001" 
                        name="mediavideo_kodeubah" id="mediavideo_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediavideoKodeubah">test</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Filter Video</label>
                  <select class="form-control" id="mediavideo_filterubah" name="mediavideo_filterubah">
                    <?php foreach($filtercode as $item): ?>
                    <option value="<?= $item['kode_filter_media']; ?>">
                        <?= $item['judul_filter']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Link Video</label>
                  <input class="form-control" type="text" placeholder="https://www.youtube.com/embed/0u5yP1m26PA" 
                        name="mediavideo_linkubah" id="mediavideo_linkubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediavideoLinkubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Link Thumbnails</label>
                  <input class="form-control" type="text" placeholder="https://img.youtube.com/vi/0u5yP1m26PA/sddefault.jpg" 
                        name="mediavideo_thumbsubah" id="mediavideo_thumbsubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediavideoThumbsubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Video</label>
                  <input class="form-control" type="text" placeholder="CARA SETOR DANA KE REKENING EFEK" 
                        name="mediavideo_judulubah" id="mediavideo_judulubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediavideoJudulubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorMediavideoDeskripsiubah">testte</div>
                  <textarea id="mediavideo_deskripsiubah" name="mediavideo_deskripsiubah"></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahmediavideo">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>