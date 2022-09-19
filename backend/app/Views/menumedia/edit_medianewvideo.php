 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahmedianewvideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Ubah Data Media</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open('media/videomednewcontroller/perbaruidata', ['class' => 'formModalubahmedianewvideo']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
         <div class="form-group">
           <label for="kode-infocategory-input" class="form-control-label">Kode Video</label>
           <input class="form-control" type="text" placeholder="KMED001" name="medianewvideo_kodeubah"
             id="medianewvideo_kodeubah" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoKodeubah">test</div>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Kategori Video</label>
           <select class="form-control" id="medianewvideo_filterubah" name="medianewvideo_filterubah">
             <?php foreach($filtercode as $item): ?>
             <option value="<?= $item['kode_filter_media']; ?>">
               <?= $item['judul_filter']; ?>
             </option>
             <?php endforeach ?>
           </select>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Sub Kategori Video</label>
           <select class="form-control" id="medianewvideo_subfilterubah" name="medianewvideo_subfilterubah">
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
             name="medianewvideo_judulubah" id="medianewvideo_judulubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoJudulubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Link Video</label>
           <input class="form-control" type="text" placeholder="https://www.youtube.com/embed/0u5yP1m26PA"
             name="medianewvideo_linkubah" id="medianewvideo_linkubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoLinkubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Durasi Video (Detik)</label>
           <input class="form-control" type="text" placeholder="168.4"
             name="medianewvideo_linkapiubah" id="medianewvideo_linkapiubah"  required/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoLinkapiubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Link Thumbnails</label>
           <input class="form-control" type="text" placeholder="https://img.youtube.com/vi/0u5yP1m26PA/sddefault.jpg"
             name="medianewvideo_thumbsubah" id="medianewvideo_thumbsubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errormedianewvideoThumbsubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
           <!-- <div id="infonews_summernote"></div> -->
           <div class="invalid-feedback bg-secondary errormedianewvideoDeskripsiubah">testte</div>
           <textarea id="medianewvideo_deskripsiubah" name="medianewvideo_deskripsiubah"></textarea>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Is Populer</label>
           <select class="form-control" id="medianewvideo_populerubah" name="medianewvideo_populerubah" required>
             <option value="1">Populer</option>
             <option value="0">Tidak Populer</option>
           </select>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Is Berbayar</label>
           <select class="form-control" id="medianewvideo_berbayarubah" name="medianewvideo_berbayarubah" required>
             <option value="1">Berbayar</option>
             <option value="0">Gratis</option>
           </select>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodalubahmedianewvideo">Ubah</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>