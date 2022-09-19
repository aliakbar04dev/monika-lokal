 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaleditultimatefactsheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Update Data Factsheet</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('ultimate/factsheetcontroller/perbaruidata', ['class' => 'formModaleditultimatefactsheet']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
         <div class="form-group">
           <label for="kode-ultimatefactsheet-input" class="form-control-label">Kode Factsheet</label>
           <input class="form-control" type="text" placeholder="PENG001" readonly name="ultimatefactsheet_kodeubah" id="ultimatefactsheet_kodeubah" required/>
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatefactsheetKodeubah">test</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Untuk Bulan</label>
           <select class="form-control" id="ultimatefactsheet_bulanubah" name="ultimatefactsheet_bulanubah" required>
            <option value="">--Pilih Bulan--</option>
              <?php
                $bulan = array("01Januari","02Februari","03Maret","04April","05Mei","06Juni","07Juli","08Agustus","09September","10Oktober","11November","12Desember");
                $jlh_bln = count($bulan);
                for($c=0; $c<$jlh_bln; $c+=1){
                    echo"<option value='$bulan[$c]'> ".substr($bulan[$c], 2)." </option>";
                }
              ?>
           </select>
           <div class="invalid-feedback bg-secondary errorultimatefactsheetBulanubah">test</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Untuk Tahun</label>
            <?php
              $now=date('Y');
              echo '<select class="form-control" id="ultimatefactsheet_tahunubah" name="ultimatefactsheet_tahunubah" required>';
              echo "<option value=''>--Pilih Tahun--</option>";
              for ($i = date('Y'); $i >= 2019; $i--)
              {
                  echo "<option value='$i'> $i </option>";
              }
              echo "</select>";
            ?>
           </select>
           <div class="invalid-feedback bg-secondary errorultimatefactsheetTahunubah">test</div>

           <br />

           <label class="custom-toggle float-right">
             <input type="checkbox" id="ultimatefactsheet_isactiveubah" class="ultimatefactsheet_isactiveubah" value="1" checked />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-warning btnmodaleditultimatefactsheet">Update</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>