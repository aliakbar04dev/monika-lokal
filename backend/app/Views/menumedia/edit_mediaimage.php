 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahmediaimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Media</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('media/imagemedcontroller/perbaruidata', ['class' => 'formModalubahmediaimage']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Media</label>
                  <input class="form-control" type="text"  placeholder="FMED001" 
                        name="mediaimage_kodeubah" id="mediaimage_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediaimageKodeubah">test</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Filter Media</label>
                  <select class="form-control" id="mediaimage_filterubah" name="mediaimage_filterubah">
                    <?php foreach($filtercode as $item): ?>
                    <option value="<?= $item['kode_filter_media']; ?>">
                        <?= $item['judul_filter']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Media</label>
                  <input class="form-control" type="text" placeholder="Gambar galeri about us" 
                        name="mediaimage_judulubah" id="mediaimage_judulubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediaimageJudulubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorMediaimageDeskripsiubah">testte</div>
                  <textarea id="mediaimage_deskripsiubah" name="mediaimage_deskripsiubah"></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahmediaimage">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>