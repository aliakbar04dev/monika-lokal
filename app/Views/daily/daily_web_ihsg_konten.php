<div class="col-lg-9">
    <?php
        if ($lvl == 'MULV001' || $lvl == 'MULV005') {
    ?>
    <div class="card mb-3">
        <div class="card-header">
            <h4 style="color: #ffd73a; font-size:14px; font-weight:bold;">Monika's Secret
                <samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp>
            </h4>
            <h4 style="color: #000; font-size:14px; font-weight:bold;">Daily Stock
                <samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp>
            </h4>
            <h4 style="color: #000; font-size:14px; font-weight:bold;">IHSG</h4>
        </div>
        <br>
        <div class="card-body pb-5">
            <div style="margin-top: -40px;" class="mb-4">
                <button style="width:auto; background-color: #612D11; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebihsg') ?>'">
                    <font style="color:#e8e5e5; font-size:12px; font-weight:bold;">IHSG</font>
                </button>
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebopen') ?>'">
                    <font style="color:#612D11; font-size:12px; font-weight:bold;">Open Position</font>
                </button>
                <button style="width:auto; background-color: #e8e5e5; border-radius:50px;" class="boxed-save mb-2 mt-1 mr-2"
                    onclick="window.location.href='<?= base_url('dailywebclosed') ?>'">
                    <font style="color:#612D11; font-size:12px; font-weight:bold;">Closed Position</font>
                </button>
            </div>

            <div class="pt-2 ml-1" style="margin-top: -10px;">
                <?php foreach ($content as $item) :?>
                    <?=  $item['content']; ?>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>
<?php
    } else {
        echo $this->include('components/template_upgrade');
    }
?>
</div>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<script type="text/javascript">
    CKEDITOR.replace('keteranganDailyweb', {
        height: 300,
    });

    CKEDITOR.instances.keteranganDailyweb.config.readOnly = true;
</script>