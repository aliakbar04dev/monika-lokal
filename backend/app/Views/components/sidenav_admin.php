<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand" href="admdashboard">
        <img src="https://monika.panensaham.com/public/assets/img/logo monika new.png" class="navbar-brand-img" width="120" alt="...">
      </a>
      <div class="ml-auto">
        <!-- Sidenav toggler -->
        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('/admdashboard') ?>">
              <i class="ni ni-shop text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admbillinginv') ?>">
              <i class="ni ni-collection text-orange"></i>
              <span class="nav-link-text">Invoice</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#navbar-feature" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-feature">
              <i class="ni ni-paper-diploma text-default"></i>
              <span class="nav-link-text">Features</span>
            </a>
            <div class="collapse" id="navbar-feature">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="<?= site_url('admfeaturesjenistsakti'); ?>" class="nav-link">Jenis Tabel Sakti</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admfeaturestsakti'); ?>" class="nav-link">Tabel Sakti</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admfeaturespoin'); ?>" class="nav-link">Poin Reward</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admfeaturesreff'); ?>" class="nav-link">Referal Register</a>
                </li>
                <!--   <li class="nav-item">
                    <a href="<?= site_url('admultimateaccess'); ?>" class="nav-link">Ultimate Access</a>
                  </li> -->
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-ultimate" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-ultimate">
              <i class="ni ni-diamond text-orange"></i>
              <span class="nav-link-text">Ultimate Access</span>
            </a>
            <div class="collapse" id="navbar-ultimate">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="#navbar-dailystock" class="nav-link" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="navbar-dailystock">Daily Stock</a>
                  <div class="collapse show" id="navbar-dailystock" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatedailyact'); ?>" class="nav-link ">IHSG</a>
                      </li>
                        <a href="<?= site_url('admultimatedaily'); ?>" class="nav-link ">Open Position</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatedailyclosed'); ?>" class="nav-link ">Closed Position</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatedailychart'); ?>" class="nav-link ">Article Daily Stock</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="nav-item">
                  <a href="#navbar-trailstop" class="nav-link" data-toggle="collapse" role="button" aria-expanded="true"
                    aria-controls="navbar-trailstop">Trailing Stop</a>
                  <div class="collapse show" id="navbar-trailstop" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatetrail'); ?>" class="nav-link">Open Position</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatetrailclosed'); ?>" class="nav-link">Closed Position</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatetrailact'); ?>" class="nav-link ">Article Trailing</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="nav-item">
                  <a href="#navbar-copytrade" class="nav-link" data-toggle="collapse" role="button" aria-expanded="true"
                    aria-controls="navbar-copytrade">Copy Trades</a>
                  <div class="collapse show" id="navbar-copytrade" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatewtcaction'); ?>" class="nav-link ">Watch Actions</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatewtcdata'); ?>" class="nav-link ">Watch Data</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimateopenpos'); ?>" class="nav-link ">Open Position</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimateclosepos'); ?>" class="nav-link ">Closed Position</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatefactsheet'); ?>" class="nav-link ">Fact Sheet</a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= site_url('admultimatecopyact'); ?>" class="nav-link ">Article Copy Trade</a>
                        <!-- <a href="<?= site_url('#'); ?>" class="nav-link ">Article Copy Trade</a> -->
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-examples">
              <i class="ni ni-bag-17 text-green"></i>
              <span class="nav-link-text">Package</span>
            </a>
            <div class="collapse" id="navbar-examples">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="<?= site_url('admpackagediscount') ?>" class="nav-link">
                    Discount
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admpackageprice') ?>" class="nav-link">Price</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-components">
              <i class="ni ni-single-02 text-primary"></i>
              <span class="nav-link-text">Account</span>
            </a>
            <div class="collapse" id="navbar-components">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="<?= site_url('admaccountuserlevel'); ?>" class="nav-link">Level</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admaccountmember'); ?>" class="nav-link">Member</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admaccountuser'); ?>" class="nav-link">User</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admaccountadministrator'); ?>" class="nav-link">Administrator</a>
                </li>
                <li class="nav-item">
                  <a href="#navbar-multilevel" class="nav-link" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="navbar-multilevel">Master</a>
                  <div class="collapse show" id="navbar-multilevel" style="">
                    <ul class="nav nav-sm flex-column">
                      <!-- <li class="nav-item">
                          <a href="<?= site_url('admmasterkomunitas'); ?>" class="nav-link ">Komunitas</a>
                        </li>
                        <li class="nav-item">
                          <a href="<?= site_url('admmasteranggota'); ?>" class="nav-link ">Anggota</a>
                        </li> -->
                      <li class="nav-item">
                        <a href="<?= site_url('admmasterreferal'); ?>" class="nav-link ">Referal User</a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-forms">
              <i class="ni ni-single-copy-04 text-info"></i>
              <span class="nav-link-text">Information</span>
            </a>
            <div class="collapse" id="navbar-forms">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="<?= site_url('adminfotype') ?>" class="nav-link">
                    Type
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('adminfocat') ?>" class="nav-link">
                    Category
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('adminfonews') ?>" class="nav-link">
                  News & Events</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('adminfobursaemiten') ?>" class="nav-link">
                  Bursa & Emiten IPO</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('adminfotutorial') ?>" class="nav-link">
                    Tutorial
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('adminfofaq') ?>" class="nav-link">
                    FAQ
                  </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="../forms/validation.html" class="nav-link">Events</a>
                  </li> -->
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-tables" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-tables">
              <i class="ni ni-image text-pink"></i>
              <span class="nav-link-text">Media</span>
            </a>
            <div class="collapse" id="navbar-tables">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="<?= site_url('admmediafilter'); ?>" class="nav-link">Kategori Media</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admmediasubmedia'); ?>" class="nav-link">Sub Kategori Media</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admmediaimage'); ?>" class="nav-link">Images</a>
                </li>
                <!-- <li class="nav-item">
                  <a href="<?= site_url('admmediavideo'); ?>" class="nav-link">Videos</a>
                </li> -->
                <li class="nav-item">
                  <a href="<?= site_url('admmediavideonew'); ?>" class="nav-link">Videos</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-maps" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-maps">
              <i class="ni ni-curved-next text-orange"></i>
              <span class="nav-link-text">Feedback</span>
            </a>
            <div class="collapse" id="navbar-maps">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="<?= site_url('admfeedbackquestion'); ?>" class="nav-link">Question</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admfeedbacksubscribe'); ?>" class="nav-link">Subscribe</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#navbar-career" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-tables">
              <i class="ni ni-building text-red"></i>
              <span class="nav-link-text">Career</span>
            </a>
            <div class="collapse" id="navbar-career">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="<?= site_url('admcareercategory'); ?>" class="nav-link">Category</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admcareerdepartment'); ?>" class="nav-link">Department</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admcareerlocation'); ?>" class="nav-link">Location</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admcareervacancy'); ?>" class="nav-link">Vacancy</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admcareerapplied'); ?>" class="nav-link">Applied</a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('admcareertestimoni'); ?>" class="nav-link">Testimoni</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#navbar-another" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-tables">
              <i class="ni ni-settings-gear-65"></i>
              <span class="nav-link-text">Settings</span>
            </a>
            <div class="collapse" id="navbar-another">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="<?= site_url('admsettingbanner'); ?>" class="nav-link">Banner</a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?= site_url('admsettingbenefit'); ?>" class="nav-link">Benefit</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('admsettingcustom'); ?>" class="nav-link">Custom</a>
                  </li> -->
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('login/out') ?>">
              <i class="ni ni-user-run text-primary"></i>
              <span class="nav-link-text">Logout</span>
            </a>
          </li>

        </ul>
        <!-- Divider -->
        <hr class="my-3">
      </div>
    </div>
  </div>
</nav>