 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahinfonews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Information | Edit Data News & Events</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('information/newscontroller/perbaruidata', ['class' => 'formModalubahinfonews']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Kode Berita</label>
           <input class="form-control" type="text" placeholder="PENG001" name="infonews_kodeubah" id="infonews_kodeubah"
             readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorInfonewsKodeubah">test</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Judul Berita</label>
           <input class="form-control" type="text" placeholder="Harga saham terbaru" name="infonews_judulubah"
             id="infonews_judulubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorInfonewsJudulubah">testte</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Ubah Jenis Berita</label>
           <select class="form-control" id="infonews_jenispengumumanubah" name="infonews_jenispengumumanubah">
             <?php foreach($type as $item): ?>
             <option value="<?= $item['kode_jenis_pengumuman']; ?>">
               <?= $item['jenis_pengumuman']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Ubah Kategori Berita</label>
           <select class="form-control" id="infonews_kategoripengumumanubah" name="infonews_kategoripengumumanubah">
             <?php foreach($category as $item): ?>
             <option value="<?= $item['kode_kategori_pengumuman']; ?>">
               <?= $item['nama_kategori_pengumuman']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
          <label for="kode-infocategory-input" class="form-control-label">Ubah Status Berita</label>
          <select class="form-control" id="infonews_statuspengumumanubah" name="infonews_statuspengumumanubah">
            <option value="NEW">NEW</option>
            <option value="HOT">HOT</option>
          </select>
        </div>

        <div class="form-group">
          <label for="kode-infocategory-input" class="form-control-label">Ubah Status Notifikasi</label>
          <select class="form-control" id="infonews_statusnotifubah" name="infonews_statusnotifubah" required>
          <option value="">--Pilih--</option>
            <option value="0">Tidak Dikirim</option>
            <option value="1">Dikirim</option>
          </select>
          <div class="invalid-feedback bg-secondary errorInfonewsStatusNotifubah">testte</div>
        </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Isi Berita</label>
           <!-- <div id="infonews_summernote"></div> -->
           <div class="invalid-feedback bg-secondary errorInfonewsIsiubah">testte</div>
           <textarea id="infonews_isiubah" name="infonews_isiubah"></textarea>

           <br />

          <label class="custom-toggle float-right">
            <input type="checkbox" id="infonews_isactiveubah" class="infonews_isactiveubah" value="1" />
            <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
          </label>
          <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>

         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodalubahinfonews">Ubah</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>