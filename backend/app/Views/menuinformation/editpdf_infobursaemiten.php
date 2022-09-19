 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahpdfinfobursaemiten" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ubah Berkas PDF</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <!-- Handle Form -->
             <?= form_open_multipart('information/bursaemitencontroller/perbaruipdf', ['class' => 'formModalubahpdfinfobursaemiten']); ?>
             <?= csrf_field(); ?>

             <div class="modal-body">
                 <input class="form-control" type="hidden" placeholder="PENG001" name="infobursaemiten_editkodeubahpdf" id="infobursaemiten_editkodeubahpdf" readonly />

                 <div class="form-group">
                     <label class="form-control-label">PDF sebelumnya &nbsp; : &nbsp;</label>
                     <a id="infobursaemiten_editpdf" class="btn btn-danger btn-sm" target="_blank">Lihat PDF</a>
                 </div>

                 <div class="form-group">
                     <label for="nama-infocategory-input" class="form-control-label">Ubah PDF</label>
                     <input type="file" name="infobursaemiten_editpdfubah" class="form-control"
                         id="infobursaemiten_editpdfubah" accept="application/pdf" /></p>
                     <div class="invalid-feedback bg-secondary errorinfobursaemiteneditPdfubah">testte</div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                 <button type="submit" class="btn btn-primary btnmodalubahpdfinfobursaemiten">Ubah</button>
             </div>

             <?= form_close(); ?>
             <!-- Handle FORM -->
         </div>
     </div>
 </div>