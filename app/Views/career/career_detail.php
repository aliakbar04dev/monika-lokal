<?= $this->extend('components/template_menu') ?>

<?= $this->section('content_menu') ?>
<link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/career.css">

<?= $this->include('menu/register'); ?>
<?= $this->include('menu/login'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>

<section class="">
    <div class="container pt-5 pb-5">
        <div class="row ">
            <img width="100%" src="<?= base_url(); ?>/public/assets/img/career/ban.png">
        </div>
    </div>
</section>
<section class="pb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 style="color:#55341D; text-align:center;" class="pb-4" data-aos="fade-in" data-aos-delay="100"><?= $detail['karir'] ?>
                </h2>
                <h5 align="center"><?= $detail['nama_departemen'] ?> <a style="color: #E79900;">&#8226;</a> <?= $detail['lokasi_pekerjaan'] ?> <a style="color: #E79900;">&#8226;</a> <?= $detail['kategori_pekerjaan'] ?></h5>
            </div>
            <div class="container">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <div class="container">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#overview" role="tab">
                                                    Overview
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#aplication" role="tab">
                                                    Aplications
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <!-- Tab panes -->
                                        <div class="tab-content text-left">
                                            <div class="tab-pane active" id="overview" role="tabpanel">
                                                <div class="pl-5">
                                                    <h5 style="color: #E79900;">Description</h5>
                                                    <!-- <a style="color: #E79900;">&#9654;</a>  segitiga kuning --> 
                                                    <p><?= $detail['deskripsi_karir'] ?></p>
                                                    <!-- <p><a style="color: #E79900;">&#9654;</a> Design and Build applications for the iOS platform</p> -->
                                                    <!--<br>
                                                    <h5 style="color: #E79900;">Requirements</h5>
                                                    <p><a style="color: #E79900;">&#9654;</a> Proficiens with Swift and Cocoa Touch</p>-->
                                                    <br>
                                                    <h5 style="color: #E79900;">Requirement</h5>
                                                    <!-- <a style="color: #E79900;">&#9654;</a>  segitiga kuning --> 
                                                    <p><?= $detail['requirement'] ?></p>
                                                    <br>
                                                </div>
                                                <div class="kotak">
                                                    <div class="ml-3 mr-3 mt-3 mb-3">
                                                        <h5 style="color: #E79900;">Benefits</h5>
														<p><?= $detail['benefit_karir']; ?></p>
                                                        <!-- <p><a style="color: #E79900;">&#9654;</a> Supportive teammates</p> -->
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div>
                                                    <a class="apply" data-toggle="tab" href="#aplication" role="tab">Apply this Job</a>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="aplication" role="tabpanel">
                                                <div class="col-lg-12">
													<form method="POST" class="needs-validation" id="applycarrerForm">
														<div class="row">
															<input class="form-conti" id="idkarir" name="idkarir" type="hidden" value="<?= $detail['id_karir']; ?>" required>
															<input class="form-conti" id="calling_code" name="calling_code" type="hidden">
															<div class="col-lg-12 pb-3">
																<div class="col-lg-12">
																	<h5 class="float-left" style="color: #E79900; font-style: italic;">Personal Information</h5>
																	<div class="box-tools pull-right">
																		<a style="font-style:italic;">Clear </a>
																		<a style="cursor:pointer;" class="btn-xs">
																			<i class="fa fa-trash" style="font-size:20px; color:#F74C4C;" id="resetformkarir"></i>
																		</a>
																	</div>
																</div>
															</div>
															<div class="col-lg-12 pb-3">
																<label class="labelin pb-3">Phone</label>
																<div class="col-lg-12">
																	<input class="form-conti" id="phone" name="phone" type="tel" required>
																	<span id="valid-msg" class="hide">Valid</span>
																	<span id="error-msg" class="hide">Invalid number</span>
																</div>
															</div>
															<div class="col-lg-12 pb-3">
																<label class="labelin pb-3">Email</label>
																<div class="col-lg-12">
																	<input class="form-conti" id="emailkarir" name="emailkarir" type="email" required>
																</div>
															</div>
															<div class="col-lg-6 pb-3">
																<label class="labelin pb-3">First Name</label>
																<div class="col-lg-12">
																	<input class="form-conti" id="firstname" name="firstname" type="text" required>
																</div>
															</div>
															<div class="col-lg-6 pb-3">
																<label class="labelin pb-3">Last Name</label>
																<div class="col-lg-12">
																	<input class="form-conti" id="lastname" name="lastname" type="text" required>
																</div>
															</div>
															<div class="col-lg-12 pb-3">

															</div>
															<div class="col-lg-12 pb-3">
																<section>
																	<div class="container">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<div class="preview-zone hidden">
																						<div class="box box-solid">
																							<div class="box-header with-border pb-4">
																								<h5 class="float-left" style="color: #E79900; font-style: italic;">Resume</h5>
																								<div class="box-tools pull-right">
																									<a style="font-style:italic;">Clear </a>
																									<a style="cursor:pointer;" class="btn-xs remove-preview">
																										<i class="fa fa-trash" style="font-size:20px; color:#F74C4C;"></i>
																									</a>
																								</div>
																							</div>
																							<div class="box-body"></div>
																						</div>
																					</div>
																					<div class="dropzone-wrapper">
																						<div class="dropzone-desc">
																							<i class="fa fa-upload" style="font-size:36px"></i>
																							<p>Upload file or drag and drop here</p>
																						</div>
																						<input type="file" name="file_karir" class="dropzone" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.rar">
																					</div>
																				</div>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-md-12">
																				<div>
																					<button id="submitKarir" type="submit" class="boxed-trial mr-4">Submit Aplications</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</section>
															</div>
														</div>
													</form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var telInput = $("#phone"),
        errorMsg = $("#error-msg"),
        validMsg = $("#valid-msg");

    // initialise plugin
    telInput.intlTelInput({

        allowExtensions: true,
        formatOnDisplay: true,
        autoFormat: true,
        autoHideDialCode: true,
        autoPlaceholder: true,
        defaultCountry: "auto",
        ipinfoToken: "yolo",

        nationalMode: false,
        numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
        preventInvalidNumbers: true,
        separateDialCode: true,
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
    });

    var reset = function() {
		$("#calling_code").val(telInput.intlTelInput("getSelectedCountryData").dialCode);
        telInput.removeClass("error");
        errorMsg.addClass("hide");
        validMsg.addClass("hide");
    };

    // on blur: validate
    telInput.blur(function() {
        reset();
        if ($.trim(telInput.val())) {
            if (telInput.intlTelInput("isValidNumber")) {
                validMsg.removeClass("hide");
            } else {
                telInput.addClass("error");
                errorMsg.removeClass("hide");
            }
        }
    });

    // on keyup / change flag: reset
    telInput.on("keyup change", reset);

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                size = input.files[0].size;

                if(size > 50000){
                    console.log(input.files[0]);
                    var htmlPreview =
                        '<img width="200" src="' + e.target.result + '" />' +
                        '<p>' + input.files[0].name + '</p>';
                    var wrapperZone = $(input).parent();
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                    wrapperZone.removeClass('dragover');
                    previewZone.removeClass('hidden');
                    boxZone.empty();
                    boxZone.append(htmlPreview);
                }else{
                    Swal.fire('Maksimum file size limit reached', 'Maksimum File Size is 50 MB', 'warning');
                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function reset(e) {
        e.wrap('<form>').closest('form').get(0).reset();
        e.unwrap();
    }

    $(".dropzone").change(function() {
        readFile(this);
    });

    $('.dropzone-wrapper').on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });

    $('.dropzone-wrapper').on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });

    $('.remove-preview').on('click', function() {
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        var previewZone = $(this).parents('.preview-zone');
        var dropzone = $(this).parents('.form-group').find('.dropzone');
        boxZone.empty();
        previewZone.addClass('hidden');
        reset(dropzone);
    });
	
	$('#resetformkarir').on('click', function() {
		var form = $(this);
		form.trigger("reset");
	});
	
	$('.apply').click(function (e) {
		var tab = '#aplication';
		$('li > a[href="' + tab + '"]').tab("show");
	});
</script>

<?= $this->endSection(); ?>