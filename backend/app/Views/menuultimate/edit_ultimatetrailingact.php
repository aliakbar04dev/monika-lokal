 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahultimatetrailingact" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Article Trailing Stop</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('ultimate/trailingactcontroller/perbaruidata', ['class' => 'formModalubahultimatetrailingact']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body">
         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Kode Trailing Article</label>
           <input class="form-control" type="text" placeholder="KDSR001" name="ultimatetrailingact_kodeubah"
             id="ultimatetrailingact_kodeubah" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatetrailingactKodeubah">testte</div>
         </div>
         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Jenis Article</label>
           <select class="form-control" id="ultimatetrailingact_jenisubah" name="ultimatetrailingact_jenisubah">
             <option value="Open Position" selected="selected">Open Position</option>
             <option value="Closed Position">Closed Position</option>
           </select>
         </div>
         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Content</label>
           <div class="invalid-feedback bg-secondary errorSettingbannerDeskripsiubah">testte</div>
           <textarea id="ultimatetrailingact_deskripsiubah" name="ultimatetrailingact_deskripsiubah"></textarea>
           <br />
           <label class="custom-toggle float-right">
             <input type="checkbox" id="ultimatetrailingact_isactiveubah" class="ultimatetrailingact_isactiveubah" name="ultimatetrailingact_isactiveubah" value="1" />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-warning btnmodalubahultimatetrailingact">Update</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>