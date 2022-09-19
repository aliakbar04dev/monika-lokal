 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahsettingbanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Banner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('setting/bannercontroller/simpandata',
           ['class' => 'formModaltambahsettingbanner']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Banner</label>
                  <input class="form-control" type="text" placeholder="TBNR001" 
                        name="settingbanner_kode" id="settingbanner_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbannerKode">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Link Banner</label>
                  <input class="form-control" type="text" placeholder="<?= base_url() . '/indeks/berita' ?>" 
                        name="settingbanner_link" id="settingbanner_link" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbannerLink">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul</label>
                  <input class="form-control" type="text" placeholder="Manager Investasi global" 
                        name="settingbanner_nama" id="settingbanner_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbannertNama">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorSettingbannerDeskripsi">testte</div>
                  <textarea id="settingbanner_deskripsi" name="settingbanner_deskripsi"></textarea>
                </div>
                
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar Banner</label>
                  <input type="file" name="settingbanner_gambar" class="form-control" id="settingbanner_gambar" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback bg-secondary errorSettingbannerGambar">testte</div>

                  <label class="custom-toggle float-right">
                    <input type="checkbox" id="settingbanner_isactive" class="settingbanner_isactive" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan banner &nbsp;</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahsettingbanner">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>