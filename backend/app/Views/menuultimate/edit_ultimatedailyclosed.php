  <!-- Modal Tambah Info -->
  <div class="modal fade" id="modalubahultimatedailyclosed" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data Daily Stock | Closed Position</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/Dailyclosedcontroller/perbaruidata', ['class' => 'formModalubahultimatedailyclosed']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
          <div class="form-group">

            <label for="nama-infocategory-input" class="form-control-label">Kode Close Position</label>
            <input class="form-control" type="text" placeholder="KUOP001" name="ultimatedailyclosed_kodeubah"
              id="ultimatedailyclosed_kodeubah" readonly />
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedKodeubah">testte</div>
          </div>

          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Kode Saham</label>
            <input class="form-control" type="text" placeholder="Contoh: TLKM" name="ultimatedailyclosed_stockubah"
              id="ultimatedailyclosed_stockubah" />
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedstockubah">testte</div>
          </div>

          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Price</label>
            <input class="form-control" type="text" placeholder="Contoh: 22.501" name="ultimatedailyclosed_buypriceubah"
              id="ultimatedailyclosed_buypriceubah" />
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedbuypriceubah">testte</div>
          </div>

          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Sell Price</label>
            <input class="form-control" type="text" placeholder="Contoh: 20.000"
              name="ultimatedailyclosed_sellpriceubah" id="ultimatedailyclosed_sellpriceubah" />
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedsellpriceubah">testte</div>
          </div>

          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Date</label>
            <input class="form-control datepicker" placeholder="Contoh: Buy Date" type="text"
              value="<?= date("m/d/Y"); ?>" name="ultimatedailyclosed_buydateubah" id="ultimatedailyclosed_buydateubah">
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedbuydateubah">testte</div>
          </div>
          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Sell Date</label>
            <input class="form-control datepicker" placeholder="Contoh: Sell Date" type="text"
              value="<?= date("m/d/Y"); ?>" name="ultimatedailyclosed_selldateubah"
              id="ultimatedailyclosed_selldateubah">
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedselldateubah">testte</div>
          </div>

          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Gain/Loss</label>
            <input class="form-control" type="text" placeholder="Contoh: 47 %" name="ultimatedailyclosed_gainlossubah"
              id="ultimatedailyclosed_gainlossubah" />
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedgainlossubah">testte</div>
          </div>

          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Target</label>
            <input class="form-control" type="text" placeholder="Contoh: 1000-1050" name="ultimatedailyclosed_targetubah"
              id="ultimatedailyclosed_targetubah" required />
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedtarget">testte</div>
          </div>

          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Hit/Miss</label>
            <select class="form-control" id="ultimatedailyclosed_hitmissubah" name="ultimatedailyclosed_hitmissubah">
              <option value="hit">
                Hit
              </option>
              <option value="miss">
                Miss
              </option>
            </select>
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedhitmissubah">testte</div>
          </div>

          <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Ubah Highest</label>
            <input class="form-control" type="text" placeholder="Contoh: 1123" name="ultimatedailyclosed_highestubah"
              id="ultimatedailyclosed_highestubah" required />
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatedailyclosedhighestubah">testte</div>

            <br />

            <label class="custom-toggle float-right">
              <input type="checkbox" id="ultimatedailyclosed_isactiveubah" class="ultimatedailyclosed_isactiveubah" value="1"
                checked />
              <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
            </label>
            <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btnmodalubahultimatedailyclosed">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
      </div>
    </div>
  </div>