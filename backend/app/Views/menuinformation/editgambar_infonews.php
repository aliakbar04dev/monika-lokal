 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahgambarinfonews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar Pengumuman</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('information/newscontroller/perbaruigambar', ['class' => 'formModalubahgambarinfonews']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
          <input class="form-control" type="text"  placeholder="PENG001" name="infonews_editkodeubah" id="infonews_editkodeubah" readonly/>

          <div class="form-group">
            <label class="form-control-label">Gambar sebelumnya</label>
            <img id="infonews_editimg" width="100%"/>
          </div>
          
          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Gambar</label>
            <input type="file" name="infonews_editgambarubah" class="form-control" id="infonews_editgambarubah" accept=".jpg, .jpeg, .png" /></p>
            <div class="invalid-feedback bg-secondary errorInfonewseditGambarubah">testte</div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahgambarinfonews">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>