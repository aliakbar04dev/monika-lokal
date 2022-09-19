 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahmedianewvideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Media</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open('media/videomednewcontroller/simpandata', ['class' => 'formModaltambahmedianewvideo']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Kode Video</label>
           <input class="form-control" type="text" placeholder="KMED001" readonly name="medianewvideo_kode"
             id="medianewvideo_kode" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoKode">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Kategori Video</label>
           <select class="form-control" id="medianewvideo_filter" name="medianewvideo_filter">
             <?php foreach($filtercode as $item): ?>
             <option value="<?= $item['kode_filter_media']; ?>">
               <?= $item['judul_filter']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Sub Kategori Video</label>
           <select class="form-control" id="medianewvideo_subfilter" name="medianewvideo_subfilter">
             <?php foreach($submedia as $item): ?>
             <option value="<?= $item['kode_filter_submedia']; ?>">
               <?= $item['keterangan_submedia']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Judul Video</label>
           <input class="form-control" type="text" placeholder="CARA SETOR DANA KE REKENING EFEK"
             name="medianewvideo_judul" id="medianewvideo_judul"  required/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoJudul">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Link Video</label>
           <input class="form-control" type="text" placeholder="https://www.youtube.com/embed/0u5yP1m26PA"
             name="medianewvideo_link" id="medianewvideo_link"  required/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoLink">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Durasi Video (Detik)</label>
           <input class="form-control" type="text" placeholder="168.4"
             name="medianewvideo_linkapi" id="medianewvideo_linkapi"  required/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoLinkapi">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Link Thumbnails</label>
           <input class="form-control" type="text" placeholder="https://img.youtube.com/vi/0u5yP1m26PA/sddefault.jpg"
             name="medianewvideo_thumbs" id="medianewvideo_thumbs"  required/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoThumbs">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
           <!-- <div id="infonews_summernote"></div> -->
           <div class="invalid-feedback bg-secondary errormedianewvideoDeskripsi">testte</div>
           <textarea id="medianewvideo_deskripsi" name="medianewvideo_deskripsi" required></textarea>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Is Populer</label>
           <select class="form-control" id="medianewvideo_populer" name="medianewvideo_populer" required>
             <option value="1">Populer</option>
             <option value="0">Tidak Populer</option>
           </select>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Is Berbayar</label>
           <select class="form-control" id="medianewvideo_berbayar" name="medianewvideo_berbayar" required>
             <option value="1">Berbayar</option>
             <option value="0">Gratis</option>
           </select>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodaltambahmedianewvideo">Simpan</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>