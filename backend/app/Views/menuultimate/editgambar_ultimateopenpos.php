 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahgambarultimateopenpos" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ubah PDF</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <!-- Handle Form -->
             <?= form_open_multipart('ultimate/openposcontroller/perbaruigambar', ['class' => 'formModalubahgambarultimateopenpos']); ?>
             <?= csrf_field(); ?>

             <div class="modal-body">
                 <input class="form-control" type="hidden" placeholder="KUOP001" name="ultimateopenpos_kodeubahgambar" id="ultimateopenpos_kodeubahgambar" readonly />

                 <div class="form-group">
                    <label for="nama-infocategory-input" class="form-control-label">Kode Saham</label>
                    <input class="form-control" type="text" placeholder="TLKM" name="ultimateopenpos_stockdetailgambar" id="ultimateopenpos_stockdetailgambar" readonly/>
                </div>

                 <div class="form-group">
                 <label class="form-control-label">PDF sebelumnya &nbsp; : &nbsp;</label>
                     <a id="ultimateopenpos_editimg" class="btn btn-danger btn-sm" target="_blank">Lihat PDF</a>
                 </div>

                 <div class="form-group">
                     <label for="nama-infocategory-input" class="form-control-label">Ubah PDF</label>
                     <input type="file" name="ultimateopenpos_editgambarubah" class="form-control" id="ultimateopenpos_editgambarubah" accept="application/pdf" /></p>
                     <small>Ukuran file jangan lebih dari 3 MB.</small>
                     <div class="invalid-feedback bg-secondary errorultimateopenposeditGambarubah">testte</div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                 <button type="submit" class="btn btn-primary btnmodalubahgambarultimateopenpos">Ubah</button>
             </div>

             <?= form_close(); ?>
             <!-- Handle FORM -->
         </div>
     </div>
 </div>