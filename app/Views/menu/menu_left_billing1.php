<div class="col-lg-3 col-md-3">
    <div class="col-12 pb-4 background-color">
        <button class="collapsible radiusatas">
            <i class="fas fa-file-invoice" style="color:#fdc134;"></i><a class="judulmenu bold" style="font-family: 'Poppins'; font-weight:bold; font-size:12px;">BILLING</a>
        </button>
        <div class="content" style="max-height: 117px;">
            <button onclick="window.location.href='<?= site_url('package'); ?>'" class="dalem <?= ($title == 'My Pakage') ? 'activee' : '' ?>">
                <a class="judulmenu" style="font-family: 'Poppins'; font-weight:bold; font-size:12px;">Paket Saya</a>
            </button>
            <button onclick="window.location.href='<?= site_url('billing'); ?>'" class="dalem radiusbawah <?= ($title == 'Billing') ? 'activee' : '' ?>">
                <a class="judulmenu" style="font-family: 'Poppins'; font-weight:bold; font-size:12px;">Invoice</a>
            </button>
            <!--
            <button onclick="window.location.href='<?= site_url('addfunds'); ?>'" class="dalem radiusbawah <?= ($title == 'Add Funds') ? 'activee' : '' ?>">
                <a class="judulmenu">Add Funds</a>
            </button>-->
        </div>
    </div>
    <!-- <div class="col-12 pb-4 background-color">
        <button class="collapsible radiusatas">
            <i class="fas fa-sliders-h" style="color:#fdc134;"></i><a class="judulmenu bold">STATUS FILTER</a>
        </button>
        <div class="content" style="max-height: 234px;">
            <button onclick="window.location.href='<?= site_url('paid'); ?>'" class="dalem <?= ($title == 'Paid') ? 'activee' : '' ?>">
                <i class="far fa-circle" style="color:<?= ($title == 'Paid') ? '#fff;' : '#fdc134;' ?>"></i><a class="judulmenu">Sudah dibayar</a>
            </button>
            <button onclick="window.location.href='<?= site_url('unpaid'); ?>'" class="dalem <?= ($title == 'Unpaid') ? 'activee' : '' ?>">
                <i class="far fa-circle" style="color:<?= ($title == 'Unpaid') ? '#fff;' : '#fdc134;' ?>"></i><a class="judulmenu">Belum Dibayar</a>
            </button>
            <button onclick="window.location.href='<?= site_url('cancel'); ?>'" class="dalem radiusbawah <?= ($title == 'Cancelled') ? 'activee' : '' ?>">
                <i class="far fa-circle" style="color:<?= ($title == 'Cancelled') ? '#fff;' : '#fdc134;' ?>"></i><a class="judulmenu">Cancel</a>
            </button>
            
            <button class="dalem radiusbawah">
                <i class="far fa-circle" style="color:#fdc134; size:40px;"></i><a class="judulmenu">Refunded</a>
            </button>
			
        </div>
    </div> -->
</div>