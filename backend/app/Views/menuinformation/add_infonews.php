 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahinfonews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Information | Tambah Data News & Events</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('information/newscontroller/simpandata', ['class' => 'formModaltambahinfonews']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Kode Berita</label>
           <input class="form-control" type="text" placeholder="PENG001" readonly name="infonews_kode" id="infonews_kode" />
           <div class="invalid-feedback bg-secondary errorInfonewsKode">test</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Cover Berita</label>
           <input type="file" name="infonews_cover" class="form-control" id="infonews_cover" accept=".jpg, .jpeg, .png" required/>
           <div class="invalid-feedback bg-secondary errorInfonewsCover">testte</div>
         </div>

         <div class="form-group">
          <label for="nama-infocategory-input" class="form-control-label">Judul Berita</label>
          <input class="form-control" type="text" name="infonews_judul" id="infonews_judul" placeholder="Contoh: Optimis PANR Bertahan di Masa Pandemi"/>
          <!-- Error Validation -->
          <div class="invalid-feedback bg-secondary errorInfonewsJudul">testte</div>
        </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Jenis Berita</label>
           <select class="form-control" id="infonews_jenispengumuman" name="infonews_jenispengumuman" required>
             <option value="">--Pilih--</option>
             <?php foreach($type as $item): ?>
             <option value="<?= $item['kode_jenis_pengumuman']; ?>">
               <?= $item['jenis_pengumuman']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group" id="chooseKategoriPengumuman">
           <label for="kode-infonews-input" class="form-control-label">Kategori Berita</label>
           <select class="form-control" id="infonews_kategoripengumuman" name="infonews_kategoripengumuman" required>
           <option value="">--Pilih--</option>
             <?php foreach($category as $item): ?>
             <option value="<?= $item['kode_kategori_pengumuman']; ?>">
               <?= $item['nama_kategori_pengumuman']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

        <div class="form-group">
          <label for="kode-infocategory-input" class="form-control-label">Status Berita</label>
          <select class="form-control" id="infonews_statuspengumuman" name="infonews_statuspengumuman" required>
          <option value="">--Pilih--</option>
            <option value="NEW">NEW</option>
            <option value="HOT">HOT</option>
          </select>
          <div class="invalid-feedback bg-secondary errorInfonewsStatus">testte</div>
        </div>

        <div class="form-group">
          <label for="kode-infocategory-input" class="form-control-label">Status Notifikasi</label>
          <select class="form-control" id="infonews_statusnotif" name="infonews_statusnotif" required>
          <option value="">--Pilih--</option>
            <option value="0">Tidak Dikirim</option>
            <option value="1">Dikirim</option>
          </select>
          <div class="invalid-feedback bg-secondary errorInfonewsStatusNotif">testte</div>
        </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Isi Berita</label>
           <!-- <div id="infonews_summernote"></div> -->
           <div class="invalid-feedback bg-secondary errorInfonewsIsi">testte</div>
           <textarea id="infonews_isi" name="infonews_isi"></textarea>

           <br />

          <label class="custom-toggle float-right">
            <input type="checkbox" id="infonews_isactive" class="infonews_isactive" value="1" checked />
            <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
          </label>
          <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
         </div>

         <!-- <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
           <input type="file" name="infonews_gambar" class="form-control" id="infonews_gambar"
             accept=".jpg, .jpeg, .png" />
           <div class="invalid-feedback bg-secondary errorInfonewsGambar">testte</div>
         </div> -->

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodaltambahinfonews">Simpan</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>