 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahinfocategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('information/categorycontroller/perbaruidata', ['class' => 'formModalubahinfocategory']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Kategori Pengumuman</label>
                  <input class="form-control" type="text"  placeholder="KTPM001" 
                        name="infocategory_kodeubah" id="infocategory_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfocategoryKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama Kategori Pengumuman</label>
                  <input class="form-control" type="text" placeholder="HOT" 
                        name="infocategory_namaubah" id="infocategory_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfocategoryNamaubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Jenis Pengumuman</label>
                  <select class="form-control" id="infocategory_jenispengumumanubah" name="infocategory_jenispengumumanubah">
                    <?php foreach($type as $item): ?>
                    <option value="<?= $item['kode_jenis_pengumuman']; ?>">
                        <?= $item['jenis_pengumuman']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnmodalbatalinfocategory" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahinfocategory">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>