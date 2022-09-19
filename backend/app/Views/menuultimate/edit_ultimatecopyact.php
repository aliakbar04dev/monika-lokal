 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaleditultimatecopyact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Article Copy Trade</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('ultimate/Copyactcontroller/perbaruidata', ['class' => 'formModaleditultimatecopyact']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body">
         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Kode Copy Article</label>
           <input class="form-control" type="text" placeholder="KDSR001" name="ultimatecopyact_kodeedit" id="ultimatecopyact_kodeedit" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatecopyactKodeedit">testte</div>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Jenis Article</label>
           <select class="form-control" id="ultimatecopyact_jenisedit" name="ultimatecopyact_jenisedit">
             <option value="Watch Actions" selected="selected">Watch Actions</option>
             <option value="Watch Data">Watch Data</option>
             <option value="Open Position">Open Position</option>
             <option value="Closed Position">Closed Position</option>
           </select>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Content</label>
           <!-- <div id="infonews_summernote"></div> -->
           <div class="invalid-feedback bg-secondary errorSettingbannerDeskripsiedit">testte</div>
           <textarea id="ultimatecopyact_deskripsiedit" name="ultimatecopyact_deskripsiedit" class="summernote"></textarea>

           <br />

           <label class="custom-toggle float-right">
             <input type="checkbox" id="ultimatecopyact_isactiveedit" class="ultimatecopyact_isactiveedit" value="1" />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-warning btnmodaleditultimatecopyact">Update</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>