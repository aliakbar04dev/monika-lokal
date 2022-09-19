 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahinfobursaemiten" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Information | Edit Data Bursa & Emiten</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('information/bursaemitencontroller/perbaruidata', ['class' => 'formModalubahinfobursaemiten']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
         <div class="form-group">
           <label for="kode-infobursaemiten-input" class="form-control-label">Ubah Kode Berita</label>
           <input class="form-control" type="text" placeholder="PENG001" name="infobursaemiten_kodeubah"
             id="infobursaemiten_kodeubah" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorinfobursaemitenKodeubah">test</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Judul Berita</label>
           <input class="form-control" type="text" name="infobursaemiten_judulubah" id="infobursaemiten_judulubah" />
           <div class="invalid-feedback bg-secondary errorinfobursaemitenJudulubah">testte</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Ubah Jenis Berita</label>
           <select class="form-control" id="infobursaemiten_jenispengumumanubah"
             name="infobursaemiten_jenispengumumanubah">
             <option value="">--Pilih--</option>
             <?php foreach($type as $item): ?>
             <option value="<?= $item['kode_jenis_pengumuman']; ?>">
               <?= $item['jenis_pengumuman']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
           <label for="kode-infobursaemiten-input" class="form-control-label">Ubah Kategori Berita</label>
           <select class="form-control" id="infobursaemiten_kategoripengumumanubah"
             name="infobursaemiten_kategoripengumumanubah">
             <option value="">--Pilih--</option>
             <?php foreach($category as $item): ?>
             <option value="<?= $item['kode_kategori_pengumuman']; ?>">
               <?= $item['nama_kategori_pengumuman']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
          <label for="kode-infocategory-input" class="form-control-label">Ubah Status Berita</label>
          <select class="form-control" id="infobursaemiten_statuspengumumanubah" name="infobursaemiten_statuspengumumanubah">
          <option value="">--Pilih--</option>
            <option value="NEW">NEW</option>
            <option value="HOT">HOT</option>
          </select>
        </div>

        <div class="form-group">
          <label for="kode-infocategory-input" class="form-control-label">Status Notifikasi</label>
          <select class="form-control" id="infobursaemiten_statusnotifubah" name="infobursaemiten_statusnotifubah" required>
          <option value="">--Pilih--</option>
            <option value="0">Tidak Dikirim</option>
            <option value="1">Dikirim</option>
          </select>
          <div class="invalid-feedback bg-secondary errorinfobursaemitenStatusNotifubah">testte</div>
        </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Isi Berita <b class="text-danger">(Opsional)</b></label>
           <div class="invalid-feedback bg-secondary errorinfobursaemitenIsiubah">testte</div>
           <textarea id="infobursaemiten_isiubah" name="infobursaemiten_isiubah"></textarea>

           <br />

           <label class="custom-toggle float-right">
             <input type="checkbox" id="infobursaemiten_isactiveubah" class="infobursaemiten_isactiveubah" value="1"/>
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>

         </div>

       </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodalubahinfobursaemiten">Ubah</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>