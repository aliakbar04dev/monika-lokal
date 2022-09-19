 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahgambarinfobursaemiten" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <!-- Handle Form -->
             <?= form_open_multipart('information/bursaemitencontroller/perbaruigambar', 
            ['class' => 'formModalubahgambarinfobursaemiten']); ?>
             <?= csrf_field(); ?>

             <div class="modal-body">
                 <input class="form-control" type="hidden" placeholder="PENG001" name="infobursaemiten_editkodeubah"
                     id="infobursaemiten_editkodeubah" readonly />

                 <div class="form-group">
                     <label class="form-control-label">Gambar sebelumnya</label>
                     <img id="infobursaemiten_editimg" width="30%" />
                 </div>

                 <div class="form-group">
                     <label for="nama-infocategory-input" class="form-control-label">Ubah Gambar (Opsional)</label>
                     <input type="file" name="infobursaemiten_editgambarubah" class="form-control"
                         id="infobursaemiten_editgambarubah" accept=".jpg, .jpeg, .png" /></p>
                     <div class="invalid-feedback bg-secondary errorinfobursaemiteneditGambarubah">testte</div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                 <button type="submit" class="btn btn-primary btnmodalubahgambarinfobursaemiten">Ubah</button>
             </div>

             <?= form_close(); ?>
             <!-- Handle FORM -->
         </div>
     </div>
 </div>