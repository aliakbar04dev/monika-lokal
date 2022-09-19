 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahpdfultimatefactsheet" tabindex="-1" role="dialog"
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
             <?= form_open_multipart('ultimate/factsheetcontroller/perbaruipdf', ['class' => 'formModalubahpdfultimatefactsheet']); ?>
             <?= csrf_field(); ?>

             <div class="modal-body">
                 <input class="form-control" type="hidden" placeholder="PENG001" name="ultimatefactsheet_editkodeubahpdf" id="ultimatefactsheet_editkodeubahpdf" readonly />

                 <div class="form-group">
                     <label class="form-control-label">PDF sebelumnya &nbsp; : &nbsp;</label>
                     <a id="ultimatefactsheet_show" class="btn btn-danger btn-sm" target="_blank">Lihat PDF</a>
                 </div>

                 <div class="form-group">
                     <label for="nama-infocategory-input" class="form-control-label">Ubah PDF</label>
                     <input type="file" name="ultimatefactsheet_berkasubah" class="form-control" id="ultimatefactsheet_berkasubah" accept="application/pdf" required/></p>
                     <div class="invalid-feedback bg-secondary errorultimatefactsheetBerkasubah">testte</div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                 <button type="submit" class="btn btn-primary btnmodalubahpdfultimatefactsheet">Ubah</button>
             </div>

             <?= form_close(); ?>
             <!-- Handle FORM -->
         </div>
     </div>
 </div>