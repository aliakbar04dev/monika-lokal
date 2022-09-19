 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalexportuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('account/usercontroller/getexcel', ['class' => 'formModalexportexceluser']); ?>
        <?= csrf_field(); ?>
          <div class="modal-body">
                  <div class="form-group">
                  <label class="form-control-label">Masukkan Password</label>
                      <input type="password" class="form-control" placeholder="***" name="password" required>
                  </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-success" style="margin-top: -50px;">Kirim</button>
          </div>
        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>