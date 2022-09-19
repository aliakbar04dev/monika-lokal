 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahimgsettingbanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar Banner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('setting/bannercontroller/perbaruigambar',
           ['class' => 'formModalubahimgsettingbanner']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Banner</label>
                  <input class="form-control" type="text" placeholder="TBNR001" 
                        name="settingbannerimg_kodeubah" id="settingbannerimg_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbannerimgKodeubah">testte</div>
                </div>

                <div class="form-group">
                  <label class="form-control-label">Gambar sebelumnya</label>
                  <img id="settingbannerimg_recentimg" width="100%"/>
                </div>
                
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar Banner</label>
                  <input type="file" name="settingbannerimg_gambar" class="form-control" id="settingbannerimg_gambar" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback bg-secondary errorSettingbannerimgGambar">testte</div>

                  <label class="custom-toggle float-right">
                    <input type="checkbox" id="settingbannerimg_isactive" class="settingbannerimg_isactive" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan banner &nbsp;</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahimgsettingbanner">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>