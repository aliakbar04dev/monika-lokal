<div class="" style="background-color: #eee;">
    <div class="container  pl-3 pr-3 pb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="tittle">
                    FAQ
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php foreach ($faq as $f) : ?>
                    <div class="accordion-wrapper" style="cursor: pointer;">
                        <div class="acc-head card p-3">
                            <a class="acc font pr-3" style="font-size: 20px; color: #432C1A; "><?= $f['question']; ?></a>
                        </div>
                        <div class="acc-body">
                            <a style="font-size: 15px;"><?= $f['answered']; ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- <div class="accordion-wrapper" style="cursor: pointer;">
                    <div class="acc-head card p-3">
                        <a class="acc font pl-4 pr-3" style="font-size: 20px; color: #432C1A;">Bagaimana Cara Investasi Saham ?</a>
                    </div>
                    <div class="acc-body">
                        <a class="pl-4" style="font-size: 15px;">Ini adalah pertanyaan tentang jual beli saham yang kerap diajukan. Cara Berinvestasi saham adalah membuat rekening efek di perusahaan sekuritas</a>
                    </div>
                </div>
                <div class="accordion-wrapper" style="cursor: pointer;">
                    <div class="acc-head card p-3">
                        <a class="acc font pl-4 pr-3" style="font-size: 20px; color: #432C1A;">Bagaimana Cara Investasi Saham ?</a>
                    </div>
                    <div class="acc-body">
                        <a class="pl-4" style="font-size: 15px;">Ini adalah pertanyaan tentang jual beli saham yang kerap diajukan. Cara Berinvestasi saham adalah membuat rekening efek di perusahaan sekuritas</a>
                    </div>
                </div>
                <div class="accordion-wrapper" style="cursor: pointer;">
                    <div class="acc-head card p-3">
                        <a class="acc font pl-4 pr-3" style="font-size: 20px; color: #432C1A;">Bagaimana Cara Investasi Saham ?</a>
                    </div>
                    <div class="acc-body">
                        <a class="pl-4" style="font-size: 15px;">Ini adalah pertanyaan tentang jual beli saham yang kerap diajukan. Cara Berinvestasi saham adalah membuat rekening efek di perusahaan sekuritas</a>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</div>
<div>
    <img class="mb-4" src="<?= base_url() ?>/public/assets/img/pricing/pricing_bawah.png" style="" width="100%" height="100%">
</div>