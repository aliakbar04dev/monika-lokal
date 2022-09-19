<div class="col-lg-3 col-md-3">
    <div class="col-12 pb-3">
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload">
                    <i class="fas fa-cog edit"></i>
                </label>
            </div>
            <div class="avatar-preview">
                <?php
                    $ran = rand(5, 15);
                ?>
                <div class="full" id="editimagePreview" style="background-image: url(<?= (getsession('photo') != '') ? base_url(getsession('photo') . '?r=' . $ran) : base_url('/public/assets/img/avatar/avatar-1.png') ?>)">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-12 pb-4">
        <div class="list-group" id="list-tab" role="tablist">
            <button class="dalem radiusatas <?= ($title == 'Edit Profile') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('editprofile'); ?>'">
                <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold;">Edit Profile</a>
            </button>
            <button class="dalem radiusbawah <?= ($title == 'Change Password') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('userpassword'); ?>'">
                <a class="judulmenu" style="font-family: Poppins; font-size:12px; font-weight:bold;">Ubah Password</a>
            </button>
            <!-- <button class="dalem" onclick="window.location.href='#'">
                <a class="judulmenu">Notifikasi</a>
            </button> -->
            <!-- <button class="dalem radiusbawah <?= ($title == 'Integration') ? 'activee' : '' ?>" onclick="window.location.href='<?= site_url('integration'); ?>'">
                <a class="judulmenu">Integration</a>
            </button> -->
            <!--<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="" role="tab">Profile</a>
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="" role="tab">Password</a>
            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="" role="tab">Notification</a>
            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="" role="tab">Integration</a> -->
        </div>
    </div>
</div>