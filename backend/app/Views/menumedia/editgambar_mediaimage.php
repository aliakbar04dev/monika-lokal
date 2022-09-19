 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahgambarmediaimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar Media</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('media/imagemedcontroller/perbaruigambar', 
			['class' => 'formModalubahgambarmediaimage']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <input class="form-control" type="text"  placeholder="KMED001" 
                        name="mediaimage_kodeubahgambar" id="mediaimage_kodeubahgambar" readonly/>
						
				 <div class="form-group">
                  <label class="form-control-label">Gambar sebelumnya</label>
                  <img id="mediaimage_editimg" width="100%"/>
                </div>
                
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Gambar</label>
                  <input type="file" name="mediaimage_editgambarubah" class="form-control" id="mediaimage_editgambarubah" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback bg-secondary errorMediaimageeditGambarubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahgambarmediaimage">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>