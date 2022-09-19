(function ($) {
	$.fn.inputFilter = function (inputFilter) {
		return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			}
		});
	};
}(jQuery));

function show_loading() {
	var ini = $(".loading_overlay");

	ini.css("display", "block");
	ini.css("opacity", 1);
}

function hide_loading() {
	var ini = $(".loading_overlay");
	var val = 0;

	let fadeEffect = setInterval(() => {
		if (ini.css("opacity") > 0) {
			val = ini.css("opacity");
			val -= 0.1;
			ini.css("opacity", val);
		} else {
			clearInterval(fadeEffect)
			ini.css("display", "none");
		}
	}, 100)
}

function currency(val) {
	return val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

function readURL(input) {
	$('#editimagePreview').css('background-image', 'url(' + base_url + input + ')');
	$('#smallprofil').attr("src", base_url + input);
	$('#editimagePreview').hide();
	$('#smallprofil').hide();
	$('#editimagePreview').fadeIn(650);
	$('#smallprofil').fadeIn(650);
}

function calctotalprice(val) {
	var disc = '';
	var discVal = '';
	var price = '';

	if(val == 'tahun' || val == 'bulan'){
		price = $('#' + val + 'val').attr('value');
	}else{
		price = $('#bulanval').attr('value');
	}

	if (val == 'tahun') {
		$('#price').text(currency(price));
		
		$('#paketlainnya').attr({
			'disabled': 'disabled'
		});
		
		if ($('#diskon').length) {
			$('#befdisc').text('Rp. ' + currency(price));
			discVal = $('#disctahun').attr('value');
			disc = price - discVal;
			price = discVal;
			$('#afterdisc').text(currency(disc));
		}

		var admin = parseInt(price)+5000;
		var total = currency(admin);

		$('#bultah').text('Tahunan');
		$('#bultah2').text('Tahun');
		$('#tblth').text('thn');
		$('#total').text(total);
	} else if (val == 'bulan') {
		$('#price').text(currency(price));

		$('#paketlainnya').attr({
			'disabled': 'disabled'
		});

		if ($('#diskon').length) {
			$('#befdisc').text('Rp. ' + currency(price));
			discVal = $('#discbulan').attr('value');
			disc = price - discVal;
			price = discVal;
			$('#afterdisc').text(currency(disc));
		}

		var admin = parseInt(price)+5000;
		var total = currency(admin);

		$('#bultah').text('Bulanan');
		$('#bultah2').text('Bulan');
		$('#tblth').text('bln');
		$('#total').text(total);
	}else if(val == 'tigabulan'){
		price = price * 3;

		$('#price').text(currency(price));

		if ($('#diskon').length) {
			$('#befdisc').text('Rp. ' + currency(price));
			discVal = $('#discbulan').attr('value')*3;
			disc = price - discVal;
			price = discVal;
			$('#afterdisc').text(currency(disc));
		}

		var admin = parseInt(price)+5000;
		var total = currency(admin);

		$('#bultah').text('Bulanan');
		$('#bultah2').text('Bulan');
		$('#tblth').text('bln');
		$('#total').text(total);
	}else if(val == 'enambulan'){
		price = price * 6;

		$('#price').text(currency(price));

		if ($('#diskon').length) {
			$('#befdisc').text('Rp. ' + currency(price));
			discVal = $('#discbulan').attr('value')*6;
			disc = price - discVal;
			price = discVal;
			$('#afterdisc').text(currency(disc));
		}

		var admin = parseInt(price)+5000;
		var total = currency(admin);

		$('#bultah').text('Bulanan');
		$('#bultah2').text('Bulan');
		$('#tblth').text('bln');
		$('#total').text(total);
	}
}

function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function checkPassword() {
	if ($('#password').val() != $('#repeat').val()) {
		return false;
	} else {
		return true;
	}
}

function failmessage(readyState) {
	if (readyState == 4) {
		Swal.fire('Sorry,', 'Data Not Found', 'error');
		// HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
	}
	else if (readyState == 0) {
		Swal.fire('Connection Error', "Can't establish a connection to the server, please check your internet connection", 'error');
		// Network error (i.e. connection refused, access denied due to CORS, etc.)
	}
	else {
		Swal.fire('Failed to get Data', 'Failed to get data, please contact administrator', 'error');
	}
}

function gettherightprice(){
	var memstat = $('#membercheck').val();
	var paket = $('#pilihpaket').val();
	var plan = $('#pilihplan').val();

	$.ajax({
		url: base_url + 'getrightprice',
		type: 'POST',
		dataType: 'JSON',
		data: {
			paket: paket,
			plan: plan,
			memstat : memstat,
		},
		beforeSend: function () {
			show_loading();
		}
	}).done(function (res) {
		hide_loading();

		if (res.success == 1) {
			$('#normalprice').text(res.harga);
			$('#normalprice2').text(res.harga);
			$('#normalprice3').text(res.harga);
			$('#discMember').text(res.diskon);

			if(res.diskon != ''){
				$('#totalPrice').text(res.total);
				$('#discBox').show();
			}else{
				$('#totalPrice').text(res.total);
			}
			
		} else {
			Swal.fire(res.reason, res.description, 'error');
		}
	}).fail(function (XMLHttpRequest, textStatus, errorThrown) {

		hide_loading();
		failmessage(XMLHttpRequest.readyState);
	});
}

function onSignIn(googleUser) {
	var id_token = googleUser.getAuthResponse().id_token;
	var auth2 = gapi.auth2.getAuthInstance();

	$.ajax({
		url: base_url + 'logingooglecalback',
		type: 'POST',
		dataType: 'JSON',
		data: {
			id_token: id_token,
		},
		beforeSend: function () {
			show_loading();
		}
	}).done(function (res) {
		hide_loading();

		if (res.success == 1) {
			window.location.replace(base_url);
		} else {
			if (res.success == 5) {
				Swal.fire(res.reason, res.description, 'success');
				window.location.replace('verifikasi');
			}else if (res.success == 6){
				Swal.fire(res.reason, res.description, 'success');
				window.location.replace('registrationotp');
			}else{
				Swal.fire(res.reason, res.description, 'error');
			}
		}

    	auth2.signOut();
	}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    	auth2.signOut();

		hide_loading();
		failmessage(XMLHttpRequest.readyState);
	});
}

function onRegis(googleUser) {
	var id_token = googleUser.getAuthResponse().id_token;
	var auth2 = gapi.auth2.getAuthInstance();

	$.ajax({
		url: base_url + 'googlecalback',
		type: 'POST',
		dataType: 'JSON',
		data: {
			id_token: id_token,
		},
		beforeSend: function () {
			show_loading();
		}
	}).done(function (res) {
		hide_loading();
		$("#notifregis").hide();

		if (res.success == 1) {
			window.location.replace('regiscallback');
		} else {
			$("html, body").animate({scrollTop: 0}, 100);
			$("#notifregis").text( res.description);
			$("#notifregis").show();
		}

    	auth2.signOut();
	}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    	auth2.signOut();

		hide_loading();
		failmessage(XMLHttpRequest.readyState);
	});
}

function onPembelianLogin(googleUser) {
	var id_token = googleUser.getAuthResponse().id_token;
	var auth2 = gapi.auth2.getAuthInstance();
	var kodepaket = $('#loginkodepaket').val();

	$.ajax({
		url: base_url + 'pembeliangooglecalback',
		type: 'POST',
		dataType: 'JSON',
		data: {
			id_token: id_token,
			kodepaket : kodepaket,
		},
		beforeSend: function () {
			show_loading();
		}
	}).done(function (res) {
		hide_loading();

		if (res.success == 1) {
			$("#infologoutdiv").text('1. Logout');
			$("#regislogindiv").hide();
			$("#logoutdiv").show();
			$("#infoandadiv").show();
			$("#orderkamudiv").text('3. Order Kamu');
			$("#discmemberdiv").text('4. Diskon member dan Referal');
			$("#carapembayarandiv").text('5. Cara Pembayaran');

			$("#userfullname").text(res.nama);
			$("#useremail").text(res.email);
			$("#userphone").text(res.nohp);
			$("#membercheck").val('false');

			if(res.member != ''){
				$("#nonmemberdiv").remove();
				$("#submitmemberpembelianform").remove();
				$("#successmember").show();
				$("#discbox").show();
				$("#membercheck").val('true');
				$("#emailanggotapembelian").val(res.member);
			}

			if(res.koderef != ''){
				$("#submitrefcodepembelianform").remove();
				$("#successrefcode").show();
				$("#pembrefcode").val(res.koderef);
			}

			gettherightprice();
		} else {
			if (res.success == 5) {
				Swal.fire(res.reason, res.description, 'success');
				window.location.replace('verifikasi');
			}else if (res.success == 6){
				Swal.fire(res.reason, res.description, 'success');
				window.location.replace('registrationotp');
			}else{
				Swal.fire(res.reason, res.description, 'error');
			}
		}

		auth2.signOut();
	}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
		auth2.signOut();

		hide_loading();
		failmessage(XMLHttpRequest.readyState);
	});
}

function onPembelianRegis(googleUser) {
	var id_token = googleUser.getAuthResponse().id_token;
	var auth2 = gapi.auth2.getAuthInstance();
	var kodepaket = $('#regiskodepaket').val();

	$.ajax({
		url: base_url + 'regispembeliangooglecalback',
		type: 'POST',
		dataType: 'JSON',
		data: {
			id_token: id_token,
		},
		beforeSend: function () {
			show_loading();
		}
	}).done(function (res) {
		hide_loading();

		if (res.success == 1) {
			$('#nama').val(res.fullname);
			$('#email').val(res.email);
		} else {
			Swal.fire(res.reason, res.description, 'error');
		}

    	auth2.signOut();
	}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
    	auth2.signOut();

		hide_loading();
		failmessage(XMLHttpRequest.readyState);
	});
}

function searchJob(){
	var cari = $("#searchjob").val().toLowerCase();
	var loc = $("#searchlok").val().toLowerCase();
	var dept = $("#searchdept").val().toLowerCase();
	var type = $("#searchwork").val().toLowerCase();
	var remonly = $('#remonly').is(":checked");

	if(cari != '' || loc != '' || dept != '' || type != '' || remonly){
		$("#joblist tr").filter(function() {
			var result = 0;
			var ini = $(this);
			
			if(cari != ''){
				if(!(ini.find("td.karjob").text().toLowerCase().indexOf(cari) > -1)){
					result += 1;
				}
			}

			if(loc != ''){
				if(!(ini.find("td.locjob").text().toLowerCase().indexOf(loc) > -1)){
					result += 1;
				}
			}

			if(dept != ''){
				if(!(ini.find("td.depjob").text().toLowerCase().indexOf(dept) > -1)){
					result += 1;
				}
			}

			if(type != ''){
				if(!(ini.find("td.katjob").text().toLowerCase().indexOf(type) > -1)){
					result += 1;
				}
			}

			if(remonly){
				if(!(ini.find("td.katjob").text().toLowerCase().indexOf('Remote') > -1)){
					result += 1;
				}
			}

			//console.log(ini.find("td.karjob").text().toLowerCase().indexOf(cari) > -1);
			//console.log('Pencarian : '+$(this).find("td.karjob").text().toLowerCase()+' || '+$(this).find("td.karjob").text().toLowerCase().indexOf(cari)+' || '+result);

			if(result > 0){
				ini.toggle(false);		
			}else{
				ini.toggle(true);
			}
			
		});
	}else{
		$("#joblist tr").show();
	}
}

function removepickarir(){
	var ini = $('.remove-preview');
	
	var boxZone = ini.parents('.preview-zone').find('.box-body');
    var previewZone = ini.parents('.preview-zone');
    var dropzone = ini.parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
	dropzone.wrap('<form>').closest('form').get(0).reset();
    dropzone.unwrap();
}

$(document).ready(function () {

	if ($.fn.DataTable) {
		$('#tablesaktiresult').DataTable({
			"order": [],
		});
	}

	$("html").mouseover(function() {
		if ( $.isFunction($.fn.getNiceScroll) ) {
			$("html").getNiceScroll().resize();
		}
	});

	$(document).on('click', '#daftarsekarang', function () {
		$('#register').modal('toggle');
		$('#login').modal('hide');
	});

	$(document).on('click', '#masuksekarang', function () {
		$('#login').modal('toggle');
		$('#register').modal('hide');
	});

	$(document).on('change', '#regiskomunitas', function () {
		if ($(this).checked) {
			$("#clientid").prop('required', true);
		} else {
			$("#clientid").prop('required', false);
		}
	});

	$(document).on('change', '#regiskoperasi', function () {
		if ($(this).checked) {
			$("#emailid").prop('required', true);
		} else {
			$("#emailid").prop('required', false);
		}
	});

	$(document).on('keyup', '#email', function () {
		var val = $(this).val();
		var input = this;

		if (!isEmail(val)) {
			this.setCustomValidity('Please Insert Valid Email !!');
		} else {
			$.ajax({
				url: base_url + 'email_check',
				type: 'POST',
				dataType: 'JSON',
				data: {
					email: val,
				},
				beforeSend: function () {

				}
			})
				.done(function (res) {
					if (res.valid) {
						input.setCustomValidity('');
					} else {
						input.setCustomValidity('Email Already Registered!!');
					}
				})
				.fail(function (XMLHttpRequest, textStatus, errorThrown) {
					failmessage(XMLHttpRequest.readyState);
				});
		}
	});

	$(document).on('keyup', '#searchjob', function () {
		searchJob();
	});

	$(document).on('change', '#searchlok, #searchdept, #searchwork', function(){
		searchJob();
	});
	
	$(document).on('change', '#remonly', function(){
		searchJob();
	});

	$(document).on('keyup', '#repeat, #password', function () {
		if (checkPassword()) {
			$("#repeat").get(0).setCustomValidity('');
			$("#password").get(0).setCustomValidity('');
		} else {
			$("#repeat").get(0).setCustomValidity('Password Missmatch');
			$("#password").get(0).setCustomValidity('Password Missmatch');
		}
	});

	$(document).on('click', '#markallread', function () {
		var list = [];

		$('#nav-home li').each(function () {
			var ini = $(this);

			if (ini.hasClass("noread")) {
				var itemId = ini.attr('id');
				ini.removeClass("noread");

				list.push({
					itemId: itemId,
				});
			}
		});

		$('#nav-profile li').each(function () {
			var ini = $(this);

			if (ini.hasClass("noread")) {
				var itemId = ini.attr('id');
				ini.removeClass("noread");

				list.push({
					itemId: itemId,
				});
			}
		});

		$('#ntftotal').remove();

		if (list.length > 0) {
			$.ajax({
				url: base_url + 'markallread',
				type: 'POST',
				dataType: 'JSON',
				data: {
					list: list,
				},
				beforeSend: function () {

				}
			})
				.done(function (res) {
					if (res.success == 1) {

					} else {

					}
				})
				.fail(function (XMLHttpRequest, textStatus, errorThrown) {

				});
		}
	});

	$(document).on('click', '#refcodebut', function () {
		var ini = $(this);
		var ref = $('#referal').val();

		$.ajax({
			url: base_url + 'refcode',
			type: 'POST',
			dataType: 'JSON',
			data: {
				ref: ref,
			},
			beforeSend: function () {

			}
		})
			.done(function (res) {
				if (res.success == 1) {
					$("#refcodebut").hide();
					$("#okelogo").show();
					Swal.fire(res.reason, res.description, 'success');
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {

			});
	});

	$(document).on('submit', '#registrationForm', function (e) {
		e.preventDefault();
		var ini = $(this);
		// gtag('event', 'conversion', {'send_to': 'AW-382841180/unZZCIjL7eUCENzixrYB'});

		$.ajax({
			url: base_url + 'daftar_baru',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				$("#notifregis").hide();
				if (res.success == 1) {
					/*
					$("#registrationForm")[0].reset();
					$("#notifregis").text( res.description);
					$("#notifregis").show();
					*/
					//Swal.fire(res.reason, res.description, 'success');
					window.location.replace(base_url+'verifikasi');
				} else {
					$("html, body").animate({scrollTop: 0}, 100);
					$("#notifregis").text( res.description);
					$("#notifregis").show();
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#autoregistrationForm', function (e) {
		e.preventDefault();
		var ini = $(this);
		// gtag('event', 'conversion', {'send_to': 'AW-382841180/unZZCIjL7eUCENzixrYB'});

		$.ajax({
			url: base_url + 'autoregister',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#autoregistrationForm")[0].reset();
					//Swal.fire(res.reason, res.description, 'success');
					window.location.replace(base_url+'verifikasi');
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#formregisphone', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'otpregisphone',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				//Swal.fire(res.reason, res.description, 'success');
				window.location.replace('registrationotp');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('submit', '#formregisotpverif', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'registrationotpverif',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				//Swal.fire(res.reason, res.description, 'success');
				//window.location.replace(base_url);
				Swal.fire(res.reason, res.description, 'success')
				.then(function() {
					window.location.replace(base_url);
				});
			} else if(res.success == 2){
				//Swal.fire(res.reason, res.description, 'success');
				//window.location.replace(base_url+'/pembelian/'+res.kodepaket);
				Swal.fire(res.reason, res.description, 'success')
				.then(function() {
					//router.push("/")
					window.location.replace(base_url+'/pembelian/'+res.kodepaket);
				});
			}else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('click', '#regissendotp', function(){
		
		
		$.ajax({
			url: base_url + 'regissendotp',
			type: 'POST',
			dataType: 'JSON',
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				Swal.fire(res.reason, res.description, 'success');
				gtag('event', 'conversion', {'send_to': 'AW-382841180/unZZCIjL7eUCENzixrYB'});
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});

		return false;
	});

	$(document).on('click', '#changeregisphone', function(){

		$.ajax({
			url: base_url + 'changeregisphone',
			type: 'POST',
			dataType: 'JSON',
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				window.location.replace('verifikasi');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});

		return false;
	});

	$(document).on('submit', '#formlogin', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'login',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					window.location.replace(base_url);
				} else {
					if (res.success == 5) {
						Swal.fire(res.reason, res.description, 'success');
						window.location.replace('verifikasi');
					}else if (res.success == 6){
						Swal.fire(res.reason, res.description, 'success');
						window.location.replace('registrationotp');
					}else{
						Swal.fire(res.reason, res.description, 'error');
					}
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#formforget', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'forgetpass',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					Swal.fire(res.reason, res.description, 'success').then((value) => {
						window.location.replace(base_url);
					});
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#changepass', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'submitforgetpass',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					Swal.fire(res.reason, res.description, 'success').then((value) => {
						window.location.replace(base_url);
					});
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#formuserpass', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'submituserpass',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					ini.trigger("reset");
					Swal.fire(res.reason, res.description, 'success');
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});


	$(document).on('submit', '#showchart', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'showchart',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempatchart").empty();
					$("#tempatchart").append(res.result);
				} else {
					$("#tempatchart").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});
	
	$(document).on('submit', '#showchartfa', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'showchartfa',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpicfa").hide();
					$("#tempatchartfa").empty();
					$("#tempatchartfa").append(res.result);
				} else {
					$("#tempatchartfa").empty();
					$("#defchartpicfa").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});
	
	$(document).on('submit', '#mshowchart', function (e) {
		e.preventDefault();
		var ini = $(this);
		$.ajax({
			url: base_url + 'mshowchart',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempatchart").empty();
					$("#tempatchart").append(res.result);
				} else {
					$("#tempatchart").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#showtable', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'showtable',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempattabel").empty();
					$("#tempattabel").append(res.result);
					$('#tempattabel table').DataTable();
				} else {
					$("#tempattabel").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});
	
	$(document).on('submit', '#showtablefa', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'showtablefa',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempattabel").empty();
					$("#tempattabel").append(res.result);
					$('#tempattabel table').DataTable();
				} else {
					$("#tempattabel").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});
	
	$(document).on('submit', '#mshowtable', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'mshowtabel',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempattabel").empty();
					$("#tempattabel").append(res.result);
					$('#tempattabel table').DataTable();
				} else {
					$("#tempattabel").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});
	
	$(document).on('submit', '#mshowtablefa', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'mshowtabelfa',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempattabel").empty();
					$("#tempattabel").append(res.result);
					$('#tempattabel table').DataTable();
				} else {
					$("#tempattabel").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$('#langganan').on('change', function() {
		var val = $(this).val();
		calctotalprice(val);
	});

	if($('#langganan').length){
		$('#langganan').trigger('change');
	}

	$(document).on('submit', '#formpembayaran', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'processpayment',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					var orderid = res.orderid;

					snap.pay(res.token, {
						onSuccess: function (result) {
							Swal.fire('Payment Success!', 'payment success!', 'success').then((value) => {
								window.location.replace(base_url+'thankyou/'+orderid);
							});
						},
						onPending: function (result) {
							Swal.fire('Payment Pending!', 'wating your payment!', 'warning').then((value) => {
								window.location.replace(base_url+'thankyou/'+orderid);
							});
						},
						onError: function (result) {
							Swal.fire('Payment Failed!', 'payment failed!', 'error');
						},
						onClose: function () {
							Swal.fire('Payment Canceled!', 'you closed the popup without finishing the payment', 'warning');
						}
					});
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#formtable', function (e) {
		e.preventDefault();
		var ini = $(this);

		var start = $('#startdate').val();
		var finish = $('#enddate').val();

		if ((start && finish) && (new Date(start) <= new Date(finish))) {
			$.ajax({
				url: base_url + 'getdatasakti',
				type: 'POST',
				dataType: 'JSON',
				data: ini.serialize(),
				beforeSend: function () {
					show_loading();
				}
			})
				.done(function (res) {
					hide_loading();
					if (res.success == 1) {
						$('#tablesaktiresult').DataTable().destroy();
						$('#tablesaktiresult').DataTable().clear().draw();
						$('#tablesaktiresult').DataTable().rows.add($(res.data)).draw();
					} else {
						$('#tablesaktiresult').DataTable().destroy();
						$('#tablesaktiresult').DataTable().clear().draw();
						Swal.fire(res.reason, res.description, 'error');
					}
				})
				.fail(function (XMLHttpRequest, textStatus, errorThrown) {
					hide_loading();
					failmessage(XMLHttpRequest.readyState);
				});
		} else {
			Swal.fire('Date Invalid', 'Silahkan isi tanggal terlebih dahulu', 'error');
		}
	});

	$(document).on('submit', '#formtablem', function (e) {
		e.preventDefault();
		var ini = $(this);

		var start = $('#startdate').val();
		var finish = $('#enddate').val();

		if ((start && finish) && (new Date(start) <= new Date(finish))) {
			$.ajax({
				url: base_url + 'getdatasaktim',
				type: 'POST',
				dataType: 'JSON',
				data: ini.serialize(),
				beforeSend: function () {
					show_loading();
				}
			})
				.done(function (res) {
					hide_loading();
					if (res.success == 1) {
						// $('#tablesaktiresult').DataTable().destroy();
						// $('#tablesaktiresult').DataTable().clear().draw();
						// $('#tablesaktiresult').DataTable().rows.add($(res.data)).draw();
						document.getElementById("tablesaktiresultm").innerHTML += res.data;
					} else {
						// $('#tablesaktiresult').DataTable().destroy();
						// $('#tablesaktiresult').DataTable().clear().draw();
						Swal.fire(res.reason, res.description, 'error');
					}
				})
				.fail(function (XMLHttpRequest, textStatus, errorThrown) {
					hide_loading();
					failmessage(XMLHttpRequest.readyState);
				});
		} else {
			Swal.fire('Date Invalid', 'Silahkan isi tanggal terlebih dahulu', 'error');
		}
	});

	$(document).on('click', '#tabledownload', function (e) {
		e.preventDefault();
		var ini = $(this);

		var file = ini.attr('value');

		window.location.href = base_url + '/backend/public/assets/files/tabel_sakti/' + file;
	});

	$(document).on('keyup paste', '#mybio', function () {
		var ini = $(this);

		ini.val(ini.val().substring(0, 160));
		var tlength = ini.val().length;
		remain = 160 - parseInt(tlength);
		$('#mybio').text(remain);
	});

	$(document).on('keyup paste', '#username', function () {
		var ini = $(this);
		var input = this;

		ini.inputFilter(function (value) {
			return /^[A-z0-9]*$/i.test(value);
		});

		if (ini.val().length > 7) {
			ini.val(ini.val().substring(0, 12));
			var tlength = ini.length;
			var remain = 12 - parseInt(tlength);
			$('#username').text(remain);
			var val = ini.val();

			$.ajax({
				url: base_url + 'username_check',
				type: 'POST',
				dataType: 'JSON',
				data: {
					username: val,
				},
				beforeSend: function () {

				}
			}).done(function (res) {
				if (res.valid) {
					input.setCustomValidity('');
				} else {
					input.setCustomValidity('Username Already Registered!!');
				}
			}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
				failmessage(XMLHttpRequest.readyState);
			});
		} else {
			input.setCustomValidity('At least 8 Character');
		}
	});

	$(document).on('submit', '#profilupdate', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'updateprofil',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				Swal.fire(res.reason, res.description, 'success');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('submit', '#formchangephone', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'otpphonechange',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				Swal.fire(res.reason, res.description, 'success');
				window.location.replace('phoneotp');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('submit', '#formotpverif', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'formotpverif',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				Swal.fire(res.reason, res.description, 'success').then((value) => {
					window.location.replace('editprofile');
				});
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('click', '#resendotp', function(){
		//donothing
		$.ajax({
			url: base_url + 'resendotp',
			type: 'POST',
			dataType: 'JSON',
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				Swal.fire(res.reason, res.description, 'success');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});

		return false;
	});

	$(document).on('submit', '#applycarrerForm', function (e) {
		e.preventDefault();
		var form = $(this);
		var ini = new FormData(this);
		
		$.ajax({
			url: base_url + 'submitkarir',
			type: 'POST',
			dataType: 'JSON',
			cache: false,
			contentType: false,
			processData: false,
			data: ini,
			beforeSend: function () {
				show_loading();
			}
		})
		.done(function (res) {
			hide_loading();
			if (res.success == 1) {
				form.trigger("reset");
				removepickarir();
				Swal.fire(res.reason, res.description, 'success');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		})
		.fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('change', '#imageUpload', function (e) {
		var file_data = $('#imageUpload').prop('files')[0];
		var form_data = new FormData();
		form_data.append('file', file_data);

		$.ajax({
			url: base_url + 'updatephoto',
			type: 'POST',
			dataType: 'JSON',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				readURL(res.path);
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('change', '#connect_komu', function () {
		var ini = $(this);
		var val = ini.val();

		if (ini.is(':checked')) {
			if (val == '') {
				$('#komunitasmodal').modal('toggle');
			}
		}else{
			Swal.fire({
				title: "Ganti ID?",
				text: "Apakah anda yakin untuk mengganti Email Komunitas?",
				icon: "warning",
				showCancelButton: true,
				dangerMode: true,
			}).then((result) => {
				if (result.value) {
					$('#komunitasmodal').modal('toggle');
				}else{
					$('#connect_komu').prop('checked', true);
				}
			});
		}
	});

	$('#komunitasmodal').on('hide.bs.modal', function () {
		var val = $('#connect_komu').val();

		if (val != '') {
			$('#connect_komu').prop('checked', true);
		}else{
			$('#connect_komu').prop('checked', false);
		}
	});

	$(document).on('submit', '#connectkomu_form', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'komuconnect',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				$('#connect_komu').val('connected');
				$('#komu_stats').text('Connected');
				$('#connect_komu').prop('checked', true);

				Swal.fire(res.reason, res.description, 'success');
				$('#komunitasmodal').modal('toggle');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('change', '#connect_kope', function () {
		var ini = $(this);
		var val = ini.val();

		if (ini.is(':checked')) {
			if (val == '') {
				$('#anggotamodal').modal('toggle');
			}
		}
	});

	$('#anggotamodal').on('hidden.bs.modal', function () {
		var val = $('#connect_kope').val();

		if (val == '') {
			$('#connect_kope').prop('checked', false);
		}
	})

	$(document).on('submit', '#connectkope_form', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'kopeconnect',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				$('#connect_kope').val('connected');
				$('#kope_stats').text('Connected');
				$('#anggotamodal').modal('toggle');

				Swal.fire(res.reason, res.description, 'success');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('click', '#deletenontemp', function(){
		//donothing
		$.ajax({
			url: base_url + 'deletenontemp',
			type: 'POST',
			dataType: 'JSON',
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				Swal.fire(res.reason, res.description, 'success').then((value) => {
					window.location.replace(base_url+"package");
				});
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});

		return false;
	});

	$(document).on('change', '#pilihpaket', function () {
		var val = $(this).val();

		$.ajax({
			url: base_url + 'getpaketprice',
			type: 'POST',
			dataType: 'JSON',
			data: {
				kodepaket: val,
			},
			beforeSend: function () {
				$('#pilihplan').find('option').remove();
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				$('#pilihplan').append('<option value="bulan">Per Bulan - '+res.bulanan+'</option>');
				$('#pilihplan').append('<option value="tahun">Per Tahun - '+res.tahunan+'</option>');
				$('#pilihplan').niceSelect('update');
				gettherightprice();
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('change', '#pilihplan', function () {
		gettherightprice();
	});

	$(document).on('submit', '#loginpembelianform', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'loginpembelian',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				$("#infologoutdiv").text('1. Logout');
				$("#regislogindiv").hide();
				$("#logoutdiv").show();
				$("#infoandadiv").show();
				$("#orderkamudiv").text('3. Order Kamu');
				$("#discmemberdiv").text('4. Diskon member dan Referal');
				$("#carapembayarandiv").text('5. Cara Pembayaran');

				$("#userfullname").text(res.nama);
				$("#useremail").text(res.email);
				$("#userphone").text(res.nohp);
				$("#membercheck").val('false');

				if(res.member != ''){
					$("#membercheck").val('true');
					$("#nonmemberdiv").remove();
					$("#submitmemberpembelianform").remove();
					$("#successmember").show();
					$("#emailanggotapembelian").val(res.member);
				}

				if(res.koderef != ''){
					$("#submitrefcodepembelianform").remove();
					$("#successrefcode").show();
					$("#pembrefcode").val(res.koderef);
				}

				gettherightprice();
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('submit', '#registerpembelianform', function (e) {
		e.preventDefault();
		var ini = $(this);
		
		$.ajax({
			url: base_url + 'pembelianregis',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				Swal.fire(res.reason, res.description, 'success');
				window.location.replace(base_url+'registrationotp');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('submit', '#memberpembelianform', function (e) {
		e.preventDefault();
		var ini = $(this);
		var email = $("#useremail").text();

		if(email == '*Alamat Email*'){
			Swal.fire('Not Logged In', 'Please log in first', 'error');
		}else{
			$.ajax({
				url: base_url + 'memberpembeliansubmit',
				type: 'POST',
				dataType: 'JSON',
				data: ini.serialize(),
				beforeSend: function () {
					show_loading();
				}
			}).done(function (res) {
				hide_loading();
				if (res.success == 1) {
					Swal.fire(res.reason, res.description, 'success');

					$("#membercheck").val('true');
					$("#nonmemberdiv").remove();
					$("#submitmemberpembelianform").remove();
					$("#successmember").show();

					gettherightprice();
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
		}
	});

	$(document).on('submit', '#refcodepembelianform', function (e) {
		e.preventDefault();
		var ini = $(this);
		var email = $("#useremail").text();

		if(email == '*Alamat Email*'){
			Swal.fire('Not Logged In', 'Please log in first', 'error');
		}else{
			$.ajax({
				url: base_url + 'refcodepembeliansubmit',
				type: 'POST',
				dataType: 'JSON',
				data: ini.serialize(),
				beforeSend: function () {
					show_loading();
				}
			}).done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#submitrefcodepembelianform").remove();
					$('#successrefcode').show();
					Swal.fire(res.reason, res.description, 'success');
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
		}
	});

	$(document).on('submit', '#pembelianform', function (e) {
		e.preventDefault();
		var ini = $(this);
		var email = $("#useremail").text();

		if(email == '*Alamat Email*'){
			Swal.fire('Not Logged In', 'Please log in first', 'error');
		}else{
			var data = ini.serializeArray();
			var paket = $('#pilihpaket').val();
			var plan = $('#pilihplan').val();
			data.push({name: "paket", value: paket},{name: "plan", value: plan});

			$.ajax({
				url: base_url + 'pembelianpayment',
				type: 'POST',
				dataType: 'JSON',
				data: $.param(data),
				beforeSend: function () {
					show_loading();
				}
			}).done(function (res) {
				hide_loading();
				if (res.success == 1) {
					var orderid = res.orderid;

					snap.pay(res.token, {
						onSuccess: function (result) {
							Swal.fire('Payment Success!', 'payment success!', 'success').then((value) => {
								window.location.replace(base_url+'thankyou/'+orderid);
							});
						},
						onPending: function (result) {
							Swal.fire('Payment Pending!', 'wating your payment!', 'warning').then((value) => {
								window.location.replace(base_url+'thankyou/'+orderid);
							});
						},
						onError: function (result) {
							Swal.fire('Payment Failed!', 'payment failed!', 'error');
						},
						onClose: function () {
							Swal.fire('Payment Canceled!', 'you closed the popup without finishing the payment', 'warning');
						}
					});
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
		}
	});
});

//awal contact
$(document).ready(function () {
	$('.Formcontact').submit(function (e) {
		e.preventDefault();

		$.ajax({
			type: "post",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: "json",
			beforeSend: function () {
				$('#btnsend').prop('disabled', true);
				$('#btnsend').html('<i class="fa fa-spin fa-spinner"></i> Processing');
			},
			complete: function () {
				$('#btnsend').prop('disabled', false);
				$('#btnsend').html('Simpan');
			},
			success: function (response) {
				if (response.error) {

				}
				else {
					Swal.fire(
						'Pemberitahuan',
						response.success.data,
						'success',
					).then(function () {
						/* $('#nama').val('');
						$('#email').val('');
						$('#phone').val(''); */
						window.location.href = response.success.link;
					});
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	});
});
//ahir

//awal Subscribe
$(document).ready(function () {
	$('.formSubscribe').submit(function (e) {
		e.preventDefault();

		$.ajax({
			type: "post",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: "json",
			beforeSend: function () {
				$('#btn_subscribe').prop('disabled', true);
				$('#btn_subscribe').html('<i class="fa fa-spin fa-spinner"></i> Processing');
			},
			complete: function () {
				$('#btn_subscribe').prop('disabled', false);
				$('#btn_subscribe').html('Simpan');
			},
			success: function (response) {
				if (response.error) {
					Swal.fire(
						'Pemberitahuan',
						response.error.input_subscribe,
						'error',
					).then(function () {
						/* $('#nama').val('');
						$('#email').val('');
						$('#phone').val(''); */
						//window.location.href = response.success.link;
					});
				}
				else {
					Swal.fire(
						'Pemberitahuan',
						response.success.subscribe_footer,
						'success',
					).then(function () {
						$('#input_subscribe').val('');
						/* $('#email').val('');
						$('#phone').val(''); */
					});
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	});
});
//ahir Subscribe



