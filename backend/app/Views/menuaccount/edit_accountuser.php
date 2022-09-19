 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahaccountuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Ubah Data User</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('account/usercontroller/perbaruidata', ['class' => 'formModalubahaccountuser']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body">
         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Kode User</label>
           <input class="form-control" type="text" placeholder="MULV001" name="accountuser_kodeubah"
             id="accountuser_kodeubah" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorAccountuserKodeubah">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Kode Referal</label>
           <input class="form-control" type="text" name="accountuser_kodereferal"
             id="accountuser_kodereferal"/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorAccountuserKodereferal">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Username</label>
           <input class="form-control" type="text" name="accountuser_username"
             id="accountuser_username"/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorAccountuserUsername">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Nama Lengkap</label>
           <input class="form-control" type="text" name="accountuser_nmlengkap"
             id="accountuser_nmlengkap"/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorAccountuserNmlengkap">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Email</label>
           <input class="form-control" type="email" name="accountuser_email"
             id="accountuser_email"/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorAccountuserEmail">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">No. HP</label>
           <input class="form-control" type="number" name="accountuser_nohp"
             id="accountuser_nohp" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorAccountuserNohp">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Kota</label>
           <input class="form-control" type="text" name="accountuser_kota"
             id="accountuser_kota"/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorAccountuserNohp">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">level User</label>
           <select class="form-control" id="accountuser_kodelevel" name="accountuser_kodelevel">
             <?php foreach($level as $item): ?>
             <option value="<?= $item['kode_user_level']; ?>">
               <?= $item['nama_level']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Jenis Member</label>
           <select class="form-control" id="accountuser_jenismember" name="accountuser_jenismember">
             <?php foreach($member as $item): ?>
             <option value="<?= $item['kode_jenis_member']; ?>">
               <?= $item['jenis_member']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Expire Date</label>

           <input class="form-control datepicker" placeholder="Expire date" type="text" name="accountuser_changedate"
             id="accountuser_changedate">
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorAccountuserlevelNamaubah">testte</div>
         </div>

         <div class="form-group">
           <label class="custom-toggle float-right">
             <input type="checkbox" id="accountuser_changepass" class="accountuser_changepass" value="1" />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Change Password Request
             &nbsp;</label>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodalubahaccountuser">Ubah</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>