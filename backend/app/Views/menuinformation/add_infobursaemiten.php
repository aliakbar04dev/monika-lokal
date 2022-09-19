 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahinfobursaemiten" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Information | Tambah Data Bursa & Emiten</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('information/bursaemitencontroller/simpandata', ['class' => 'formModaltambahinfobursaemiten']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
         <div class="form-group">
           <label for="kode-infobursaemiten-input" class="form-control-label">Kode Berita</label>
           <input class="form-control" type="text" placeholder="PENG001" readonly name="infobursaemiten_kode"
             id="infobursaemiten_kode"  required/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorinfobursaemitenKode">test</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Judul Berita</label>
           <input class="form-control" type="text" placeholder="Contoh: Optimis PANR Bertahan di Masa Pandemi" name="infobursaemiten_judul" id="infobursaemiten_judul" required/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorinfobursaemitenJudul">testte</div>
         </div>

         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Jenis Berita</label>
           <select class="form-control" id="infobursaemiten_jenispengumuman" name="infobursaemiten_jenispengumuman" required>
             <option value="">--Pilih--</option>
             <?php foreach($type as $item): ?>
             <option value="<?= $item['kode_jenis_pengumuman']; ?>">
               <?= $item['jenis_pengumuman']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group" id="chooseKategoriPengumuman">
           <label for="kode-infobursaemiten-input" class="form-control-label">Kategori Berita</label>
           <select class="form-control" id="infobursaemiten_kategoripengumuman" name="infobursaemiten_kategoripengumuman" required>
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
          <select class="form-control" id="infobursaemiten_statuspengumuman" name="infobursaemiten_statuspengumuman" required>
            <option value="">--Pilih--</option>
            <option value="NEW">NEW</option>
            <option value="HOT">HOT</option>
          </select>
          <div class="invalid-feedback bg-secondary errorinfobursaemitenStatus">testte</div>
        </div>

        <div class="form-group">
          <label for="kode-infocategory-input" class="form-control-label">Status Notifikasi</label>
          <select class="form-control" id="infobursaemiten_statusnotif" name="infobursaemiten_statusnotif" required>
          <option value="">--Pilih--</option>
            <option value="0">Tidak Dikirim</option>
            <option value="1">Dikirim</option>
          </select>
          <div class="invalid-feedback bg-secondary errorinfobursaemitenStatusNotif">testte</div>
        </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Isi Berita <b class="text-danger">(Opsional)</b></label>
           <textarea id="infobursaemiten_isi" name="infobursaemiten_isi"></textarea>
           <div class="invalid-feedback bg-secondary errorinfobursaemitenIsi">testte</div>
         </div>

         <!-- <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Gambar <b class="text-danger">(Opsional)</b></label>
           <input type="file" name="infobursaemiten_gambar" class="form-control" id="infobursaemiten_gambar"
             accept=".jpg, .jpeg, .png" /></p>
           <div class="invalid-feedback bg-secondary errorinfobursaemitenGambar">testte</div>
         </div> -->

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Berkas PDF <b class="text-danger">(Opsional, Maks. Ukuran File 5 Mb)</b></label>
           <input type="file" name="infobursaemiten_berkas" class="form-control" id="infobursaemiten_berkas" accept=".pdf"/></p>
           <div class="invalid-feedback bg-secondary errorinfobursaemitenBerkas">testte</div>

           <br />

           <label class="custom-toggle float-right">
             <input type="checkbox" id="infobursaemiten_isactive" class="infobursaemiten_isactive" value="1" checked />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>

         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodaltambahinfobursaemiten">Simpan</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>