 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahmediaimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Media</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('media/imagemedcontroller/simpandata', ['class' => 'formModaltambahmediaimage']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Media</label>
                  <input class="form-control" type="text"  placeholder="KMED001" readonly
                        name="mediaimage_kode" id="mediaimage_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediaimageKode">test</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Filter Media</label>
                  <select class="form-control" id="mediaimage_filter" name="mediaimage_filter">
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
                        name="mediaimage_judul" id="mediaimage_judul" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediaimageJudul">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorMediaimageDeskripsi">testte</div>
                  <textarea id="mediaimage_deskripsi" name="mediaimage_deskripsi"></textarea>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
                  <input type="file" name="mediaimage_gambar" class="form-control" id="mediaimage_gambar" accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback bg-secondary errorMediaimageGambar">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahmediaimage">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>