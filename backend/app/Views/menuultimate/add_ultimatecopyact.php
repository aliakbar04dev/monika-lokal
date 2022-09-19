 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimatecopyact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Tambah Article Copy Trade</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('ultimate/copyactcontroller/simpandata',
           ['class' => 'formModaltambahultimatecopyact']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body">
         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Kode Copy Article</label>
           <input class="form-control" type="text" placeholder="KDSR001" name="ultimatecopyact_kode"
             id="ultimatecopyact_kode" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatecopyactKode">testte</div>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Jenis Article</label>
           <select class="form-control" id="ultimatecopyact_jenis" name="ultimatecopyact_jenis">
             <option value="Watch Actions" selected="selected">Watch Actions</option>
             <option value="Watch Data">Watch Data</option>
             <option value="Open Position">Open Position</option>
             <option value="Closed Position">Closed Position</option>
           </select>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Content</label>
           <!-- <div id="infonews_summernote"></div> -->
           <div class="invalid-feedback bg-secondary errorSettingbannerDeskripsi">testte</div>
           <textarea id="ultimatecopyact_deskripsi" name="ultimatecopyact_deskripsi"></textarea>

           <br />

           <label class="custom-toggle float-right">
             <input type="checkbox" id="ultimatecopyact_isactive" class="ultimatecopyact_isactive" value="1" />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodaltambahultimatecopyact">Simpan</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>