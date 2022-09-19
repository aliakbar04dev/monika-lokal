 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahcoverinfonews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Cover Berita</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('information/newscontroller/perbaruicover', ['class' => 'formModalubahcoverinfonews']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
          <input class="form-control" type="text"  placeholder="PENG001" name="infonews_editkodeubahcover" id="infonews_editkodeubahcover" readonly/>

          <div class="form-group">
            <label class="form-control-label">Cover Berita Sebelumnya</label>
            <img id="infonews_editcovershow" width="100%"/>
          </div>
          
          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Cover Berita</label>
            <input type="file" name="infonews_editcoverubah" class="form-control" id="infonews_editcoverubah" accept=".jpg, .jpeg, .png" /></p>
            <div class="invalid-feedback bg-secondary errorInfonewseditCoverubah">testte</div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahcoverinfonews">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>